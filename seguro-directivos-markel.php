<?php
/*
Plugin Name: Seguro Directivos y Administradores con Markel sin API
Text Domain: seguro-do-markel
Plugin URI:  https://ariseweb.es
Description: Tarificación y contratación del seguro D&O de Zurich sin API
Version:     1.0
Author:      Ariseweb
Author URI:  https://ariseweb.es
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


//Añadimos el autoload de composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
   require __DIR__ . '/vendor/autoload.php';
}


// Definición de constantes básicas del plugin
define('SDOPZ_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SDOPZ_PLUGIN_URL', plugins_url('/', __FILE__));


define('SDOPZ_TEMPLATE_LANDING_PRODUCTO', 'templates/landing-producto-template.php');
define('SDOPZ_TEMPLATE_EMAIL', 'templates/plantilla-email.php');
define('SDOPZ_INSU_PRODUCT_ID', '3');
define('SDOPZ_PRODUCTO_NOMBRE', "Seguro Directivos y Administradores");


//CONSTANTES A DEFINIR ANTES DE LA ACTIVACIÓN
define('SDOPZ_SLUG_LANDING_PRODUCTO', 'seguros-directivos-administradores');
define('SDOPZ_PRODUCT_ID_WORDPRESS', 2251);  //ID del post  en wordpress que corresponde con el desarrollo.
define('SDOPZ_IMAGEN_PLUGIN', SDOPZ_PLUGIN_URL."/img/img-seguro-do.svg");  //No es necesario. Puede utilizarse el que viene por defecto
define('SDOPZ_CODIGO_MEDIADOR', 4648);


//CONSTANTES DE LLEIDA NET PARA FIRMAR DIGITALMENTE
define('URL_API_ILEIDA_START_SDOPZ', 'https://api.lleida.net/cs/v1/start_signature');
define('URL_API_ILEIDA_GET_SDOPZ', 'https://api.lleida.net/cs/v1/get_document');
define('URL_API_ILEIDA_VSIGN_SDOPZ', 'https://api.lleida.net/cs/v1/get_signature_status');

define('API_USER_ILEIDA_SDOPZ', 'ibrok');
define('API_PASS_ILEIDA_SDOPZ', '}Tn,V9quqP');


//Requerimos archivos con las funcionalidades propias del plugin.
require_once SDOPZ_PLUGIN_PATH .'utils/functions-plugin.php';

//Requerimos archivos con las funcionalidades de crear un proyecto.
require_once SDOPZ_PLUGIN_PATH .'templates/proyectos_pdf/template-proyecto-v2.php';
require_once SDOPZ_PLUGIN_PATH .'utils/generacion-proyecto.php';

//Requerimos archivos con las funcionalidades de completar el pdf (poliza) y crear la firma.
require_once SDOPZ_PLUGIN_PATH .'utils/functions-firma.php';
require_once SDOPZ_PLUGIN_PATH .'api/status-firma.php';
require_once SDOPZ_PLUGIN_PATH .'api/obtener-pdf.php';
require_once SDOPZ_PLUGIN_PATH .'api/firma-api.php';




//Hook activación insuguru
function SDOPZ_insu_activar_plugin_insuguru() {

   // Obtener el basename del plugin
   $plugin_basename = plugin_basename(__FILE__);
   insu_activar_plugin_insuguru($plugin_basename, SDOPZ_INSU_PRODUCT_ID);

   SDOPZ_register_endpoints();
   flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'SDOPZ_insu_activar_plugin_insuguru');



//Hook desactivación insuguru
function SDOPZ_insu_desactivar_plugin_insuguru() {

   $plugin_basename = plugin_basename(__FILE__);
   insu_desactivar_plugin_insuguru($plugin_basename, SDOPZ_INSU_PRODUCT_ID);

   flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'SDOPZ_insu_desactivar_plugin_insuguru');



// Verificación de plugins requeridos
function SDOPZ_check_required_plugins() {
   $required_plugins = [
      'seo-by-rank-math/rank-math.php' => 'Rank Math SEO',
      'asegura-core/asegura-core.php' => 'Asegura Core',
      'insuguru-wp-plugin/insuguru-wp-plugin.php' => 'Insuguru Plugin',
      'turnstile-asegura-security/turnstile-asegura-security.php' => 'Turnstyle Security'
   ];

   $missing_plugins = [];

   foreach ($required_plugins as $plugin => $name) {
      if (!is_plugin_active($plugin)) {
         $missing_plugins[] = $name;
      }
   }

   // Verificar si Composer está instalado y si el archivo composer.json existe
   $composer_json_path = plugin_dir_path(__FILE__) . 'composer.json';
   if (!file_exists($composer_json_path)) {
      $missing_plugins[] = 'Composer y dependencias de Composer';
   } else {
      // Verificar si Composer está disponible en el servidor
      exec('composer --version', $output, $return_var);
      if ($return_var !== 0) {
         $missing_plugins[] = 'Composer no está instalado en el servidor';
      } else {
         // Ejecutar Composer install
         exec('composer install', $output, $return_var);
         if ($return_var !== 0) {
            wp_die(
               __('No se pudieron instalar las dependencias de Composer. Verifique su instalación de Composer.', 'text-domain'),
               __('Error en Composer', 'text-domain'),
               array('back_link' => true)
            );
         }
      }
   }

   if (!empty($missing_plugins)) {
      deactivate_plugins(plugin_basename(__FILE__));
      wp_die(
         sprintf(__('Este plugin requiere los siguientes plugins: %s. Por favor, actívalos o instálalos primero.', 'text-domain'), implode(', ', $missing_plugins)),
         __('Plugins requeridos no encontrados', 'text-domain'),
         array('back_link' => true)
      );
   }
}



/*******   Redirección de la plantilla del CPT para que se muestre la definida por este plugin ************/
function SDOPZ_redirect_cpt_template($template) {

   global $post;

   if (!$post || !is_singular('productos')) return $template;

   $is_slug_correct = isset($post->post_name) && $post->post_name == SDOPZ_SLUG_LANDING_PRODUCTO;

   if ($post->post_type == 'productos' && $is_slug_correct) {
      $custom_template = plugin_dir_path(__FILE__) . SDOPZ_TEMPLATE_LANDING_PRODUCTO;
      if (file_exists($custom_template)) return $custom_template;
      else error_log('La plantilla personalizada SDOPZ_TEMPLATE_LANDING_PRODUCTO no se encuentra.');
   }

   return $template;
}

add_filter('single_template', 'SDOPZ_redirect_cpt_template');





/**
 * Registramos los endpoints basados en las páginas
 */
function SDOPZ_register_endpoints() {
   // Listado de páginas del plugin
    require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   foreach ($SDOPZ_paginas as $pagina) {
      add_rewrite_endpoint($pagina['slug'], EP_ROOT);
   }
}

add_action('init', 'SDOPZ_register_endpoints');



/**
 * Ruta del endpoint y carga de plantilla
 */
function SDOPZ_endpoint_template() {
   global $wp;

   // Listado de páginas del plugin
   require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   foreach ($SDOPZ_paginas as $pagina) {
      if (isset($wp->query_vars[$pagina['slug']])) {
            // Cargar la plantilla específica para cada endpoint
            $template_path = plugin_dir_path(__FILE__) . 'templates/' . $pagina['slug'] . '.php';

            if (file_exists($template_path)) {
               include $template_path;
            } else {
               // Plantilla por defecto si no existe el archivo específico
               echo '<h1>' . esc_html($pagina['title']) . '</h1>';
               echo '<p>' . esc_html($pagina['content']) . '</p>';
               echo $template_path;
            }

            exit;
        }
    }
}
add_action('template_redirect', 'SDOPZ_endpoint_template');




/****** 
 * METADATOS Y DEMÁS EN RANKMATH 
 * ****/
function SDOPZ_rankmath_title( $title ) {
   global $wp;

   // Listado de páginas del plugin
   require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   foreach ( $SDOPZ_paginas as $pagina ) {
      if ( isset( $wp->query_vars[$pagina['slug']] ) ) {
         // Si se ha definido meta_title en el array, lo usamos; 
         // en caso contrario usamos 'title' como fallback
         if ( !empty( $pagina['meta_title'] ) ) {
            return $pagina['meta_title'];
         }
         return $pagina['title'];
      }
   }

   return $title;
}

add_filter( 'rank_math/frontend/title', 'SDOPZ_rankmath_title', 10, 1 );


/**
 * Cambiar la Meta Description en Rank Math
 */
function SDOPZ_rankmath_description( $description ) {
   global $wp;

   // Listado de páginas del plugin
   require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   foreach ( $SDOPZ_paginas as $pagina ) {
      if ( isset( $wp->query_vars[$pagina['slug']] ) ) {
         if ( !empty( $pagina['meta_description'] ) ) {
            return $pagina['meta_description'];
         }
      }
   }

   return $description;
}

add_filter( 'rank_math/frontend/description', 'SDOPZ_rankmath_description', 10, 1 );



/**
 * Cambiar la meta "robots" (index/noindex)
 */
function SDOPZ_rankmath_robots( $robots ) {
   global $wp;

   // Listado de páginas del plugin
   require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   foreach ( $SDOPZ_paginas as $pagina ) {
      if ( isset( $wp->query_vars[$pagina['slug']] ) ) {
         // Si el array marca 'indexable' como false, devolvemos array('noindex','nofollow')
         if ( !$pagina['indexable'] ) {
            return array( 'noindex', 'nofollow' );
         }
      }
   }

   // En caso contrario, devolvemos el array original que nos llegue
   return $robots;
}

add_filter( 'rank_math/frontend/robots', 'SDOPZ_rankmath_robots', 10, 1 );



/******* Encolado de estilos y scripts necesarios para el plugin ********/
function SDOPZ_check_required_page() {
   global $wp;

   // Listado de páginas del plugin
   require SDOPZ_PLUGIN_PATH .'utils/paginas-crear-caracteristicas.php';

   $is_required_page = false;

   // Recorre cada slug de la lista y comprueba si existe en $wp->query_vars
   foreach ($SDOPZ_paginas as $pagina) {
      if ( isset($wp->query_vars[$pagina['slug']]) ) {
         $is_required_page = true;
         break;
      }
   }

   return $is_required_page;
}



function SDOPZ_consejos_enqueue_styles() {

   if (SDOPZ_check_required_page()) {

      if (!wp_style_is('sweetalert2-css', 'enqueued')) {
         wp_enqueue_style('sweetalert2-css', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css');
      }

      if (!wp_style_is('SDOPZ_styles', 'enqueued')) {
         wp_enqueue_style('SDOPZ_styles', plugin_dir_url(__FILE__) . 'css/SDOPZ_estilos.css', array(), '1.0');
      }
   }

   if (get_post_field('post_name', get_post()) == SDOPZ_SLUG_LANDING_PRODUCTO) {
      if (!wp_style_is('SDOPZ_css-landing', 'enqueued')) {
         wp_enqueue_style('SDOPZ_css-landing', plugin_dir_url(__FILE__) . 'css/SDOPZ_estilos_template.css', array(), '1.0');
      }
   }
}

add_action('wp_enqueue_scripts', 'SDOPZ_consejos_enqueue_styles', 100);




function SDOPZ_api_plugin_enqueue_scripts() {

   if (SDOPZ_check_required_page()) {
      insu_encolar_script_insuguru(SDOPZ_INSU_PRODUCT_ID);

      if (!wp_script_is(SDOPZ_SLUG_LANDING_PRODUCTO.'-script', 'enqueued')) {
         wp_enqueue_script(SDOPZ_SLUG_LANDING_PRODUCTO.'-script', plugins_url('/js/SDOPZ_scripts.js', __FILE__), array('jquery'), '1.0', true);
         wp_localize_script(SDOPZ_SLUG_LANDING_PRODUCTO.'-script', 'miAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'url_producto' => SDOPZ_SLUG_LANDING_PRODUCTO,
         ));
      }

      if (!wp_script_is('moment-js', 'enqueued')) {
         wp_enqueue_script('moment-js', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array(), '2.29.1', true);
      }

      if (!wp_script_is('sweetalert2-js', 'enqueued')) {
         wp_enqueue_script('sweetalert2-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), '11.0.17', false);
      }
   }

   if (get_post_field('post_name', get_post()) == SDOPZ_SLUG_LANDING_PRODUCTO) {
      if (!wp_script_is('js-landing', 'enqueued')) {
         wp_enqueue_script('js-landing', plugins_url('/js/SDOPZ_script_landing_producto.js', __FILE__), array('jquery'), '1.0', true);
      }
   }
}

add_action('wp_enqueue_scripts', 'SDOPZ_api_plugin_enqueue_scripts');






/******** AJAX PROCESA LA GENERACIÓN DEL PROYECTO, CUMPLIMENTACIÓN DE LA PÓLIZA Y SU FIRMA ************/
function SDOPZ_procesar_poliza() {
   // Inicializa el array de respuesta
   $response = [];

   // Comprueba que al menos el email del asegurado venga
   if ( ! isset( $_POST['email_repre'] ) || empty( $_POST['email_repre'] ) ) {
      $response['error'] = __( 'No se han recibido datos del formulario', 'seguro-do-markel' );
      return wp_send_json_error( [
         'errores'   => [],
         'respuesta' => $response,
      ] );
   }

   // --- Sanitize y asigna todos los inputs nuevos ---
   $facturacion_anual         = sanitize_text_field( $_POST['facturacion_anual'] ?? '' );
   $precio_base               = sanitize_text_field( $_POST['precio_poliza_do'] ?? '' );
   $limite_indemnizacion      = sanitize_text_field( $_POST['limite_indemnizacion'] ?? '' );
   $razon_social              = sanitize_text_field( $_POST['razon_social'] ?? '' );
   $cif_data                  = sanitize_text_field( $_POST['identificador'] ?? '' );
   $fecha_constitucion        = sanitize_text_field( $_POST['fecha_constitucion_empresa'] ?? '' );
   $codigo_postal             = sanitize_text_field( $_POST['codigo_postal'] ?? '' );
   $provincia                 = sanitize_text_field( $_POST['provincia'] ?? '' );
   $poblacion                 = sanitize_text_field( $_POST['poblacion'] ?? '' );
   $direccion_completa        = sanitize_text_field( $_POST['dirección'] ?? '' );
   $facturacion_data          = sanitize_text_field( $_POST['facturacion_data'] ?? '' );
   $forma_pago_data           = sanitize_text_field( $_POST['forma_pago_data'] ?? '' );
   $cuenta_banc_data          = sanitize_text_field( $_POST['cuenta_banc_data'] ?? '' );
   // Respuestas a las nuevas preguntas
   $q1_markel                 = sanitize_text_field( $_POST['q1_markel'] ?? '' );
   $q2_pasivo_corriente       = sanitize_text_field( $_POST['q2_pasivo_corriente'] ?? '' );
   $q3_insolvencia            = sanitize_text_field( $_POST['q3_insolvencia'] ?? '' );
   $q4_bolsa                  = sanitize_text_field( $_POST['q4_bolsa'] ?? '' );
   $q5_us_canada              = sanitize_text_field( $_POST['q5_us_canada'] ?? '' );
   $q6a_cambio_control        = sanitize_text_field( $_POST['q6a_cambio_control'] ?? '' );
   $q6b_propuesta             = sanitize_text_field( $_POST['q6b_propuesta'] ?? '' );
   $q7_reclamacion            = sanitize_text_field( $_POST['q7_reclamacion'] ?? '' );
   $q8_denegada               = sanitize_text_field( $_POST['q8_denegada'] ?? '' );
   $q9_rgpd                   = sanitize_text_field( $_POST['q9_rgpd'] ?? '' );
   $q10_aepd                  = sanitize_text_field( $_POST['q10_aepd'] ?? '' );
   $q11_sectores_prohibidos   = sanitize_text_field( $_POST['q11_sectores_prohibidos'] ?? '' );
   $actividad_descript        = sanitize_textarea_field( $_POST['actividad'] ?? '' );
   // Fechas y consentimiento
   $fecha_efecto_solicitada   = sanitize_text_field( $_POST['fecha_efecto_solicitada'] ?? '' );
   $suscripcion_cond          = isset( $_POST['suscripcion_cond'] );
   $declaracion_datos         = isset( $_POST['declaracion_datos'] );
   $suscripcion_pub           = isset( $_POST['suscripcion_pub'] );
   // Datos del representante
   $cargo_repre               = sanitize_text_field( $_POST['cargo_repre'] ?? '' );
   $nombre_repre              = sanitize_text_field( $_POST['nombre_repre'] ?? '' );
   $apellido_repre            = trim( sanitize_text_field( ( $_POST['apellido_1_repre'] ?? '' ) . ' ' . ( $_POST['apellido_2_repre'] ?? '' ) ) );
   $identificador_repre       = sanitize_text_field( $_POST['identificador_repre'] ?? '' );
   $email_repre               = sanitize_email( $_POST['email_repre'] ?? '' );
   $telefono_repre            = sanitize_text_field( $_POST['telefono_repre'] ?? '' );

   $nombre_provincia_asegurado = SDOPZ_obtenerNombreProvincia( $provincia );

   // --- Genera proyecto PDF ---
   $url_proyecto_producto = SDOPZ_Generar_proyecto_PDF(
      $facturacion_anual,
      $limite_indemnizacion,
      $precio_base,
      $razon_social,
      $cif_data,
      $direccion_completa,
      $codigo_postal,
      $provincia,
      $facturacion_data,
      $forma_pago_data,
      $cuenta_banc_data,
      $q1_markel,
      $q2_pasivo_corriente,
      $q3_insolvencia,
      $q4_bolsa,
      $q5_us_canada,
      $q6a_cambio_control,
      $q6b_propuesta,
      $q7_reclamacion,
      $q8_denegada,
      $q9_rgpd,
      $q10_aepd,
      $q11_sectores_prohibidos,
      $actividad_descript,
      $fecha_constitucion,
      $poblacion,
      $fecha_efecto_solicitada
   );

   // --- Genera PDF final y firma electrónica ---
   $firmaResponse = SDOPZ_Cumplimentacion_firma_poliza_PDF(
      $facturacion_anual,
      $limite_indemnizacion,
      $precio_base,
      $razon_social,
      $cif_data,
      $direccion_completa,
      $codigo_postal,
      $provincia,
      $facturacion_data,
      $forma_pago_data,
      $cuenta_banc_data,
      $q1_markel,
      $q2_pasivo_corriente,
      $q3_insolvencia,
      $q4_bolsa,
      $q5_us_canada,
      $q6a_cambio_control,
      $q6b_propuesta,
      $q7_reclamacion,
      $q8_denegada,
      $q9_rgpd,
      $q10_aepd,
      $q11_sectores_prohibidos,
      $actividad_descript,
      $fecha_constitucion,
      $poblacion,
      $fecha_efecto_solicitada,
      $cargo_repre,
      $nombre_repre,
      $apellido_repre,
      $identificador_repre,
      $email_repre,
      $telefono_repre,
      $suscripcion_cond,
      $declaracion_datos,
      $suscripcion_pub
   );

   error_log(json_encode($firmaResponse));

   // Comprueba éxito de firma
   if ( $firmaResponse 
        && isset( $firmaResponse['request_id'], $firmaResponse['signature_id'], $firmaResponse['signatory_id'] ) ) {
      $response['success']       = true;
      $response['url_proyecto']  = $url_proyecto_producto;
      $response['firmaResponse'] = $firmaResponse;
      wp_send_json_success( [
         'errores'   => [],
         'respuesta' => $response,
      ] );
   } else {
      $response['error'] = __( 'No se pudo completar el proceso de firma.', 'seguro-do-markel' );
      wp_send_json_error( [
         'errores'   => [],
         'respuesta' => $response,
      ] );
   }
}

add_action( 'wp_ajax_SDOPZ_procesar_poliza', 'SDOPZ_procesar_poliza' );
add_action( 'wp_ajax_nopriv_SDOPZ_procesar_poliza', 'SDOPZ_procesar_poliza' );




//PETICIÓN AJAX PARA COMPROBAR MEDIANTE AJAX EL ESTADO DE UNA PETICIÓN DE FIRMA DIGITAL CON LLEIDA NET
function SDOPZ_statusFirma() {
   $signature_id = $_POST['signature_id'];
   $request_id = $_POST['request_id'];
   $signatory_id = $_POST['signatory_id'];
   $razon_social = $_POST['razon_social'];

   $respuesta = SDOPZ_obtener_estado_firma($request_id, $signature_id);

   $statusbool = array(); 

   if (isset($respuesta['status']) && $respuesta['status'] === 'Success') {
      if (isset($respuesta['signature_status']) && $respuesta['signature_status'] === 'signed') {
         $statusbool['status'] = true;
         wp_send_json_success($statusbool);

      } else {
         $statusbool['status'] = false;
         wp_send_json_success($statusbool);
      }
   }else {
      insu_registrar_error_insuguru("SDOPZ_statusFirma", "No se encontró información del firmante.", SDOPZ_INSU_PRODUCT_ID);
      wp_send_json_error();
   }
}

add_action('wp_ajax_SDOPZ_verifica_status_proc_firma', 'SDOPZ_statusFirma');
add_action('wp_ajax_nopriv_SDOPZ_verifica_status_proc_firma', 'SDOPZ_statusFirma');




// FUNCIÓN PARA ENVIAR EL CORREO DE CONFIRMACIÓN AL USUARIO
function SDOPZ_EnvioCorreoPoliza_cliente($email_asegurado) {
   // Definición de headers
   $headers = array(
      'Content-Type: text/html; charset=UTF-8',
      'From: ' . sanitize_email(WPCONFIG_MAIL_EMPRESA),
      'Reply-To: ' . sanitize_email(WPCONFIG_MAIL_EMPRESA),
   );

   // Asunto del correo
   $asunto = "Póliza Seguro D&O - " . WPCONFIG_NAME_EMPRESA;

   ob_start();

   $template_path = SDOPZ_PLUGIN_PATH .'templates/plantilla-email.php';

   if (file_exists($template_path)) {
      require_once $template_path;
   } else {
      return false;
   }

   $mensaje = ob_get_clean();

   // Enviar el correo
   $wp_mail_result = wp_mail($email_asegurado, $asunto, $mensaje, $headers);

   // Registro de errores si ocurre algún problema
   if (!$wp_mail_result) {
      $error_message = 'Error al enviar correos a: ' . json_encode(array(
         'email_asegurado' => $email_asegurado,
         'correo_correduria' => WPCONFIG_MAIL_EMPRESA
      ));

      insu_registrar_error_insuguru("SDOPZ_EnvioCorreoPoliza", $error_message, SDOPZ_INSU_PRODUCT_ID);

      wp_send_json_error('Error al enviar el correo.');

      return false;
   }

   wp_send_json_success('Correo enviado exitosamente.');

   return true;
}


// Callback para enviar el correo vía AJAX
function SDOPZ_enviar_correo_poliza_callback() {
   // Verifica que los parámetros se hayan pasado correctamente
   if (isset($_POST['email_asegurado'])) {

      $email_asegurado = sanitize_email($_POST['email_asegurado']);

      // Llama a la función para enviar el correo
      $resultado = SDOPZ_EnvioCorreoPoliza_cliente($email_asegurado);

      if ($resultado) {
         wp_send_json_success('Correo enviado exitosamente.');
      } else {
         wp_send_json_error('Error al enviar el correo.');
      }
   } else {
      wp_send_json_error('Datos faltantes.');
   }

   wp_die();
}

add_action('wp_ajax_SDOPZ_enviar_correo_poliza_cliente', 'SDOPZ_enviar_correo_poliza_callback');
add_action('wp_ajax_nopriv_SDOPZ_enviar_correo_poliza_cliente', 'SDOPZ_enviar_correo_poliza_callback');





/********** CÓDIGO PARA ENVIAR EL CORREO DE SOLICITUD DE CONTRATACIÓN A LA COMPÁÑÍA Y UNA COPIA A LA CORREDURÍA **********/
function SDOPZ_EnvioCorreoPolizaCompania($email_asegurado, $link_poliza) {
   // Definición de headers
   $headers = array(
      'Content-Type: text/html; charset=UTF-8',
      'From: ' . sanitize_email(WPCONFIG_MAIL_EMPRESA),
      'Reply-To: ' . sanitize_email(WPCONFIG_MAIL_EMPRESA),
   );


   //ENVIAR CORREO A LA CORREDURÍA Y A LA COMPAÑIA 
   // $correos_reciben_confirmación = ['soporte@aunnabroker.es','suscripcion@aunnabroker.es',WPCONFIG_MAIL_EMPRESA];
   $correos_reciben_confirmación = array('rilo1982@hotmail.com','admin@ariseweb.es', 'godinezjosue@hotmail.com');

   // Asunto del correo
   $asunto1 = "Nueva contratación Seguro de Accidentes AIG- " . WPCONFIG_NAME_EMPRESA;

   ob_start();

   require_once SDOPZ_PLUGIN_PATH .'templates/template-mail-compania.php';
   
   $mensaje1 = ob_get_clean();

   $wp_mail_result2 = wp_mail($correos_reciben_confirmación, $asunto1, $mensaje1, $headers);


   // Registro de errores si ocurre algún problema
   if (!$wp_mail_result2) {

      insu_registrar_error_insuguru("SDOPZ_EnvioCorreoPolizaCompania", "Error al enviar correo: " . json_encode($wp_mail_result), SDOPZ_INSU_PRODUCT_ID);

      wp_send_json_error('Error al enviar el correo.');
        return false;
   }

   wp_send_json_success('Correo enviado exitosamente.');

   return true;
}



// Función que será ejecutada por el cron job
function SDOPZ_enviar_correo_poliza_cron($email_asegurado,$signature_id,$request_id, $signatory_id ,$nombre_asegurado) {

   // Obtener el documento firmado
   $file_path = SDOPZ_obtener_documento_firmado_por_URL($request_id, $signature_id, $signatory_id, $nombre_asegurado);

   // Obtener el directorio base de wp-content
   $wp_content_dir = WP_CONTENT_DIR; // Ruta absoluta a 'wp-content'
   $wp_content_url = content_url();  // URL completa a 'wp-content'

   // Reemplaza la ruta del sistema con la URL correcta del sitio dinámicamente
   $file_url = str_replace($wp_content_dir, $wp_content_url, $file_path);

   insu_patch_contratacion_insuguru($file_url,$signature_id);

   // Enviar el correo
   $resultado = SDOPZ_EnvioCorreoPolizaCompania($email_asegurado, $file_url);

   if (!$resultado) {
      error_log('Error al enviar el correo a ' . $email_asegurado);
   } 
}

// Asociar la función al hook del cron
add_action('SDOPZ_enviar_correo_poliza_evento', 'SDOPZ_enviar_correo_poliza_cron',10, 5);


// Callback para enviar el correo vía AJAX
function SDOPZ_enviar_correo_poliza_companias_callback() {
   // Verifica que los parámetros se hayan pasado correctamente
   if (isset($_POST['email_asegurado'], $_POST['link_poliza'], $_POST['signature_id'], $_POST['request_id'], $_POST['signatory_id'], $_POST['name_asegurado'])) {
      // sanitizar inputs
      $email_asegurado = sanitize_email($_POST['email_asegurado']);
      $link_poliza = sanitize_text_field($_POST['link_poliza']);
      $signature_id = intval($_POST['signature_id']); // asegúrate de que sea numérico
      $request_id = intval($_POST['request_id']);     // lo mismo aquí
      $signatory_id = intval($_POST['signatory_id']);
      $nombre_asegurado = sanitize_text_field($_POST['name_asegurado']);

      // Programar el cron job para enviar el correo en 1 minutos
      $time_to_execute = time() + 60; // 60 segundos = 1 minutos


  

      // Programar evento único, pasando los datos necesarios como argumento
      wp_schedule_single_event($time_to_execute, 'SDOPZ_enviar_correo_poliza_evento', array(
         'email_asegurado' => $email_asegurado,
         'signature_id' => $signature_id,
         'request_id' => $request_id,
         'signatory_id' => $signatory_id,
         'nombre_asegurado' => $nombre_asegurado
      ));

      wp_send_json_success('El correo será enviado en 2 minutos.');
   } else {
      wp_send_json_error('Datos faltantes.');
   }

   wp_die();
}

add_action('wp_ajax_SDOPZ_enviar_correo_poliza_compania', 'SDOPZ_enviar_correo_poliza_companias_callback');
add_action('wp_ajax_nopriv_SDOPZ_enviar_correo_poliza_compania', 'SDOPZ_enviar_correo_poliza_companias_callback');