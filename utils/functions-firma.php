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

   //Se inicializan los inputs vacios para las preguntas
   $q1_markel_si = "";
   $q2_pasivo_corriente_si  = "";
   $q3_insolvencia_si  = "";
   $q4_bolsa_si  = "";
   $q5_us_canada_si  = "";
   $q6a_cambio_control_si  = "";
   $q6b_propuesta_si  = "";
   $q7_reclamacion_si  = "";
   $q8_denegada_si  = "";
   $q9_rgpd_si  = "";
   $q10_aepd_si  = "";

   $q1_markel_no = "";
   $q2_pasivo_corriente_no  = "";
   $q3_insolvencia_no  = "";
   $q4_bolsa_no  = "";
   $q5_us_canada_no  = "";
   $q6a_cambio_control_no  = "";
   $q6b_propuesta_no  = "";
   $q7_reclamacion_no  = "";
   $q8_denegada_no  = "";
   $q9_rgpd_no  = "";
   $q10_aepd_no  = "";
   
   //Escribe X segun la informacion desde front
   if($q1_markel == "si"){
      $q1_markel_si = "X";
   } else if($q1_markel == "no"){
      $q1_markel_no = "X";
   }
   if($q2_pasivo_corriente == "si"){
      $q2_pasivo_corriente_si = "X";
   } else if($q2_pasivo_corriente == "no"){
      $q2_pasivo_corriente_no = "X";
   }

   if($q3_insolvencia == "si"){
      $q3_insolvencia_si = "X";
   } else if($q3_insolvencia == "no"){
      $q3_insolvencia_no = "X";
   }

   if($q4_bolsa == "si"){
      $q4_bolsa_si = "X";
   } else if($q4_bolsa == "no"){
      $q4_bolsa_no = "X";
   }

   if($q5_us_canada == "si"){
      $q5_us_canada_si = "X";
   } else if($q5_us_canada == "no"){
      $q5_us_canada_no = "X";
   }

   if($q6a_cambio_control == "si"){
      $q6a_cambio_control_si = "X";
   } else if($q6a_cambio_control == "no"){
      $q6a_cambio_control_no = "X";
   }

   if($q6b_propuesta == "si"){
      $q6b_propuesta_si = "X";
   } else if($q6b_propuesta == "no"){
      $q6b_propuesta_no = "X";
   }

   if($q7_reclamacion == "si"){
      $q7_reclamacion_si = "X";
   } else if($q7_reclamacion == "no"){
      $q7_reclamacion_no = "X";
   }

   if($q8_denegada == "si"){
      $q8_denegada_si = "X";
   } else if($q8_denegada == "no"){
      $q8_denegada_no = "X";
   }

   if($q9_rgpd == "si"){
      $q9_rgpd_si = "X";
   } else if($q9_rgpd == "no"){
      $q9_rgpd_no = "X";
   }

   if($q10_aepd == "si"){
      $q10_aepd_si = "X";
   } else if($q10_aepd == "no"){
      $q10_aepd_no = "X";
   }

   //Inicializa los valores para los inputs
   $x362E = "";
   $x567E = "";
   $x693E = "";
   $x872E = "";
   $x1050E = "";
   $x1313aE = "";
   
   $x441E = "";
   $x683E = "";
   $x819E = "";
   $x1029E = "";
   $x1208E = "";
   $x1533E = "";

   $x509E = "";
   $x788E = "";
   $x977E = "";
   $x1313bE = "";
   $x1575E = "";
   $x1964E = "";

   $x646E = "";
   $x956E = "";
   $x1260E = "";
   $x1554E = "";
   $x1733E = "";
   $x2142E = "";
   
   //Establece la X correspondiente a la tabla en la pagina 2
   switch ($precio_base) {
      case 362: $x362E = "X"; break;
      case 567: $x567E = "X"; break;
      case 693: $x693E = "X"; break;
      case 872: $x872E = "X"; break;
      case 1050: $x1050E = "X"; break;
      case 1313: $x1313aE = "X"; break;

      case 441: $x441E = "X"; break;
      case 683: $x683E = "X"; break;
      case 819: $x819E = "X"; break;
      case 1029: $x1029E = "X"; break;
      case 1208: $x1208E = "X"; break;
      case 1533: $x1533E = "X"; break;

      case 509: $x509E = "X"; break;
      case 788: $x788E = "X"; break;
      case 977: $x977E = "X"; break;
      //case 13131: $x1313bE = "X"; break; // Usar lógica especial si se repite pendiente de modificar
      case 1575: $x1575E = "X"; break;
      case 1964: $x1964E = "X"; break;

      case 646: $x646E = "X"; break;
      case 956: $x956E = "X"; break;
      case 1260: $x1260E = "X"; break;
      case 1554: $x1554E = "X"; break;
      case 1733: $x1733E = "X"; break;
      case 2142: $x2142E = "X"; break;
   }

  
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
         'q1_markel_si'                      => $q1_markel_si,
         'q2_pasivo_corriente_si'            => $q2_pasivo_corriente_si,
         'q3_insolvencia_si'                 => $q3_insolvencia_si,
         'q4_bolsa_si'                       => $q4_bolsa_si,
         'q5_us_canada_si'                   => $q5_us_canada_si,
         'q6a_cambio_control_si'             => $q6a_cambio_control_si,
         'q6b_propuesta_si'                  => $q6b_propuesta_si,
         'q7_reclamacion_si'                 => $q7_reclamacion_si,
         'q8_denegada_si'                    => $q8_denegada_si,
         'q9_rgpd_si'                        => $q9_rgpd_si,
         'q10_aepd_si'                       => $q10_aepd_si,

         'q1_markel_no'                      => $q1_markel_no,
         'q2_pasivo_corriente_no'            => $q2_pasivo_corriente_no,
         'q3_insolvencia_no'                 => $q3_insolvencia_no,
         'q4_bolsa_no'                       => $q4_bolsa_no,
         'q5_us_canada_no'                   => $q5_us_canada_no,
         'q6a_cambio_control_no'             => $q6a_cambio_control_no,
         'q6b_propuesta_no'                  => $q6b_propuesta_no,
         'q7_reclamacion_no'                 => $q7_reclamacion_no,
         'q8_denegada_no'                    => $q8_denegada_no,
         'q9_rgpd_no'                        => $q9_rgpd_no,
         'q10_aepd_no'                       => $q10_aepd_no,
         
         //'q11_sectores_prohibidos'        => strtoupper($q11_sectores_prohibidos),

         'x_362E'           => $x362E,
         'x_567E'           => $x567E,
         'x_693E'           => $x693E,
         'x_872E'           => $x872E,
         'x_1050E'          => $x1050E,
         'x_1313aE'         => $x1313aE,
         'x_441E'           => $x441E,
         'x_683E'           => $x683E,
         'x_819E'           => $x819E,
         'x_1029E'          => $x1029E,
         'x_1208E'          => $x1208E,
         'x_1533E'          => $x1533E,
         'x_509E'           => $x509E,
         'x_788E'           => $x788E,
         'x_977E'           => $x977E,
         'x_1313bE'         => $x1313bE,
         'x_1575E'          => $x1575E,
         'x_1964E'          => $x1964E,
         'x_646E'           => $x646E,
         'x_956E'           => $x956E,
         'x_1260E'          => $x1260E,
         'x_1554E'          => $x1554E,
         'x_1733E'          => $x1733E,
         'x_2142E'          => $x2142E,

         //'notificaciones'          => $,

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





