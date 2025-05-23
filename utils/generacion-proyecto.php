<?php 

//GENERACIÓN DEL PROYECTO DEL PRODUCTO 
use Knp\Snappy\Pdf as SnappyPdf;

function SDOPZ_Generar_proyecto_PDF(
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
   $telefono_repre 
){
   $timestamp = time();
   $nombrepdf = sanitize_file_name($razon_social . '_' . $timestamp . '.pdf');

   // Generar el HTML utilizando la plantilla
   $html = SDOPZ_template_generacion_proyecto(
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
      $telefono_repre 
   );

   // Inicializar Snappy
   $snappy = new SnappyPdf('/usr/bin/wkhtmltopdf'); // Verifica esta ruta en tu servidor

   	// Obtener la ruta de la carpeta dentro del plugin
   	$plugin_dir = dirname(plugin_dir_path(__FILE__), 1); 
	$pdf_dir = $plugin_dir . '/archivos/proyectos/';


   // Crear la carpeta si no existe
   if (!file_exists($pdf_dir)) {
      wp_mkdir_p($pdf_dir);
   }

   // Definir la ruta completa del PDF
   $pdf_path = $pdf_dir . $nombrepdf;

   // Generar el PDF desde HTML y guardarlo en el sistema de archivos
   try {
      $snappy->generateFromHtml($html, $pdf_path);
      $pdf_url = SDOPZ_PLUGIN_URL. 'archivos/proyectos/' . $nombrepdf;
      return $pdf_url;

   } catch (Exception $e) {
      insu_registrar_error_insuguru("SDOPZ_Generar_proyecto_PDF", "Error generando PDF: " . $e->getMessage(), SDOPZ_INSU_PRODUCT_ID);

      return false;
   }
}


