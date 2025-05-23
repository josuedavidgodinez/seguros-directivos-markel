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
    $fecha_efecto_solicitada,
    $cargo_repre,
    $nombre_repre,
    $apellido_repre,
    $identificador_repre,
    $email_repre,
    $telefono_repre 
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


    // 1. Crear DateTime desde la cadena con formato día-mes-año
    $fecha_efecto = DateTime::createFromFormat('d-m-Y', $fecha_efecto_solicitada);
    if (!$fecha_efecto) {
        // Manejo de error si el formato es inválido
        throw new Exception('Formato de fecha inválido, espera dd-mm-YYYY');
    }

    // 2. Clonar la fecha para no modificar el original (opcional)
    $fecha_final_cobertura = clone $fecha_efecto;

    // 3. Sumar un año
    $fecha_final_cobertura->modify('+1 year');

    // 4. Formatear en d/m/Y
    $fecha_final_cobertura_mod = $fecha_final_cobertura->format('d/m/Y');


    $top_page = 8;

    ob_start();
    include __DIR__ . '/parts/frontpage.php';
    include __DIR__ . '/parts/content.php';
    $contenido_proyecto = ob_get_clean();


    // Return the final assembled HTML
    return $contenido_proyecto;
}
