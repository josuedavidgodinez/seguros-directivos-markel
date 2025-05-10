<?php
    function SDOPZ_obtener_documento_firmado_por_URL($requestId, $signatureId, $signatoryId, $razon_social) {
        
        $url = URL_API_ILEIDA_GET_SDOPZ;
        $user = API_USER_ILEIDA_SDOPZ;
        $password = API_PASS_ILEIDA_SDOPZ;


        $fileGroup = 'signature_biometric'; // Asegúrate de especificar el grupo de archivos correcto si es necesario
    
        // Cuerpo de la solicitud
        $body = array(
            'request' => 'GET_DOCUMENT',
            'request_id' => $requestId,
            'user' => $user,
            'signature_id' => $signatureId,
            'signatory_id' => $signatoryId,
            'file_group' => $fileGroup,
            'password' => $password,
        );
    
        // Configuración de los argumentos para wp_remote_post
        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ),
            'body' => json_encode($body),
            'timeout' => '45',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
        );


        // Realizar la solicitud POST
        $response = wp_remote_post($url, $args);
    
        // Verificar y manejar la respuesta
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL", "Algo salió mal: $error_message", 2);
            return null;
        } else {

            $response_body = wp_remote_retrieve_body($response);
            $response_code = wp_remote_retrieve_response_code($response);
    
            if ($response_code == 200) {
                // Decodificar el cuerpo de la respuesta
                $response_data = json_decode($response_body, true);
    
                if (isset($response_data['document']['file'][0]['file_url'])) {
                    $file_url = $response_data['document']['file'][0]['file_url'];
    
                    $timestamp = time();
                    // Aquí puedes descargar el documento usando la URL
                    $nombrepdf = $razon_social ."-".$timestamp.".pdf";
                    $file_path = SDOPZ_PLUGIN_PATH. 'archivos/polizas-firmadas/'. $nombrepdf;


                    if (SDOPZ_downloadDocument($file_url, $file_path)) {
                        return $file_path;
                    } else {
                        insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL", "Error al descargar el documento.", 2);
                    }
                } else {
                    insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL","No se encontró la URL del documento en la respuesta.", 2);
                    return null;
                }
            } else {
                insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL","Respuesta inesperada: Código de estado $response_code", 2);
                return null;
            }
        }
    }
    
    function SDOPZ_downloadDocument($url, $path) {
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Asegúrate de configurar adecuadamente la verificación SSL en producción
	    $data = curl_exec($ch);
	    $error = curl_error($ch);
	    curl_close($ch);

	    if ($data === false || $error) {
	        insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL", "Error descargando el documento: $error", 2);
	        return false;
	    }

	    // Verificar si se pudo escribir el archivo
	    if (file_put_contents($path, $data) === false) {
	        insu_registrar_error_insuguru("SDOPZ_obtener_documento_firmado_por_URL", "Error al escribir el archivo en el disco.", 2);
	        return false;
	    }

	    return true;
	}
