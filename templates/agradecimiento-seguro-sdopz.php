<?php 
    $path = __DIR__ . '/..';
    require_once  $path .'/utils/transient-services.php';
    require_once  $path .'/utils/correos-services.php';

    ignore_user_abort(true); // El script sigue aunque el usuario cierre el navegador
    set_time_limit(0); // Evita que el script se detenga por timeout

    $signature_id = $_GET['signature_id'];
    $signatory_id = $_GET['signatory_id'];
    //obtenemos transient
    $respuesta_transient=SDOPZ_get_transient_service($signature_id);
    if(!is_null($respuesta_transient['respuesta'])){
    $datos_transient=$respuesta_transient['respuesta'];


    //registramos en Insuguru
    $respuesta_insuguru=insu_contratacion_insuguru($datos_transient, $datos_transient->INSU_WP_ARISE_RATE, null, null  , $signature_id);
    error_log('respuesta_insuguru: '. json_encode($respuesta_insuguru));
    

    //enviamos correo a la compañia con documento firmado
    $request_correo_compania=get_object_vars($datos_transient);
    $respuesta_correo_compania = SDOPZ_enviar_correo_poliza_companias_callback_service($request_correo_compania);
    error_log('respuesta_correo_compania: '. json_encode($respuesta_correo_compania));


    //envio de correo al cliente
    $respuesta_correo_cliente = SDOPZ_enviar_correo_poliza_callback_service($request_correo_compania);
    
    error_log('respuesta_correo_cliente: '. json_encode($respuesta_correo_cliente));
    }
    get_header();

 ?>


<div id="primary" class="content-area viajes-inter" style="margin-top:-40px;">
<main id="main" class="site-main product-temp" role="main">

    <div class="container-mini-tarif-viajes">
        <img class="img-sgviajes thabnks-step" src="<?= AC_PLUGIN_URL."/img/gracias_1.svg"; ?>">

        <h2 class="title-viajes">¡Todo listo! La solicitud ha sido procesada correctamente.</h2>
        <p><i>Muchas gracias por confiar en <?= WPCONFIG_NAME_EMPRESA; ?>.</i></p>
        <div class="card-forms">
            
            <p>Hemos enviado a tu correo una <b>copia de la solicitud de seguro D&O,</b> y en breve nos pondremos en contacto contigo. </p>

            <p>Recuerda revisar tu bandeja de entrada (y, por si acaso, la <b>carpeta de spam</b>).</p>

            <p><b>Importante:</b> La cobertura de seguro sólo comenzará tras la confirmación por parte de Markel, previo análisis satisfactorio de este Cuestionario.</p>
            
            <a href="/listado-seguros/" class="btn btn-primary btn-rosa btn-viajes mt-4">Ver otros seguros</a>
        </div>
    </div>


<?php
get_footer();
?>