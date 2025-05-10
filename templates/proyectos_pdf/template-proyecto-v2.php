<?php

function SDOPZ_template_generacion_proyecto(
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
) {


    $html_eleccion_polizas = "";
    ob_start();
    include __DIR__ . '/parts/table-options.php';
    $contenido_tabla = ob_get_clean();

    // Obtener la fecha de hoy en el formato deseado
    $fecha_hoy = date("d/m/Y");

    $fecha_al_anio = new DateTime();
    // Añadir 15 días
    $fecha_al_anio->modify('+15 days');
    // Formatear la fecha en el formato d/m/Y
    $fecha_al_anio_format = $fecha_al_anio->format('d/m/Y');


    $top_page = 8;

    ob_start();
    include __DIR__ . '/parts/frontpage.php';
    include __DIR__ . '/parts/content.php';
    $contenido_proyecto = ob_get_clean();


    // Return the final assembled HTML
    return $contenido_proyecto;
}
