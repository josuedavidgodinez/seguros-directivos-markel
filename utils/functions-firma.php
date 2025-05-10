<?php 

//CUMPLIMENTACIÓN DEL PDF CON LOS DATOS DE LA PÓLIZA A FIRMAR
use mikehaertl\pdftk\Pdf as MikeheartSDOPZ;

function SDOPZ_Cumplimentacion_firma_poliza_PDF(
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
   ){

   $directorioGuardado = SDOPZ_PLUGIN_PATH. '/archivos/polizas-cumplimentadas/'; 

   $timestamp = time();
   $nombrepdf = $razon_social . "-". $timestamp . '.pdf';
   $rutaCompletaPDF = $directorioGuardado . $nombrepdf;

   $fecha_def = date("Y-m-d");
   
 
   $pdf = new MikeheartSDOPZ( SDOPZ_PLUGIN_PATH . '/templates/Contrato_Markel_DO_template.pdf' );

   $result = $pdf
      ->fillForm([
         // Encabezado
         'entidad_solicitante'           => $razon_social,
         'CIF'                            => $cif_data,
         'fecha_constitucion'             => $fecha_constitucion,
         'direccion'                      => $direccion_completa,
         'localidad'                      => $poblacion,
         'provincia'                      => SDOPZ_obtenerNombreProvincia( $provincia ),
         'codigo_postal'                  => $codigo_postal,
         'actividades_solicitante'        => $actividad_descript,
         'facturacion_ultimo_ano'         => $facturacion_data,

         // Cuestionario D&O
         'q1_markel_si'                      => strtoupper($q1_markel),
         'q2_pasivo_corriente_si'            => strtoupper($q2_pasivo_corriente),
         'q3_insolvencia_si'                 => strtoupper($q3_insolvencia),
         'q4_bolsa_si'                       => strtoupper($q4_bolsa),
         'q5_us_canada_si'                   => strtoupper($q5_us_canada),
         'q6a_cambio_control_si'             => strtoupper($q6a_cambio_control),
         'q6b_propuesta_si'                  => strtoupper($q6b_propuesta),
         'q7_reclamacion_si'                 => strtoupper($q7_reclamacion),
         'q8_denegada_si'                    => strtoupper($q8_denegada),
         'q9_rgpd_si'                        => strtoupper($q9_rgpd),
         'q10_aepd_si'                       => strtoupper($q10_aepd),
         
         //'q11_sectores_prohibidos'        => strtoupper($q11_sectores_prohibidos),
         //'ex_check'                       => true,

         // Datos de firma y efecto
         'fecha_efecto'                   => $fecha_efecto_solicitada,
         'IBAN'                           => $cuenta_banc_data,
         'firma_nombre'                   => trim("$nombre_repre $apellido_repre"),
         'firma_cargo'                    => $cargo_repre,
         'firma_fecha'                    => $fecha_def,

         // Otros campos obligatorios
         'mediador'                       => 'ACAMBIAR',
         'fecha_poliza'                   => $fecha_def,

   ])->needAppearances()->saveAs($rutaCompletaPDF);

   if ($result === false) {
      $error = $pdf->getError();

      insu_registrar_error_insuguru("SDOPZ_Cumplimentacion_firma_poliza_PDF", "No se ha podido completar la cumplimentación del contrato con los datos recogidos en el formulario. El error devuelto:".$error, SDOPZ_INSU_PRODUCT_ID);

      return false;
   }else{

      $firmaResponse=[];

      //Llama a la función para iniciar el proceso de firma y captura la respuesta
       $firmaResponse = SDOPZ_iniciar_proceso_firma($email_repre, $telefono_repre, $nombre_repre, $apellido_repre, $nombrepdf, $identificador_repre);

      // Verifica si la respuesta incluye un request_id
      if (isset($firmaResponse['request_id'])) {

         return $firmaResponse;
         
      } else {
         insu_registrar_error_insuguru("SDOPZ_iniciar_proceso_firma", "No se pudo obtener el request_id de la respuesta de iniciar proceso de firma.", SDOPZ_INSU_PRODUCT_ID);
         return null;
      }

      return null;
   }
    
   return null;
}





