<?php 
$templateEmail = '
<style>
    body, li {
        color: #004481;
    }
    h2, h4,h6{
    	color: #009696;
    }
    li {
        margin: 10px 0;
    }
    h6{
    	font-size:14px;
    }
    .no-fsg{
    	list-style:none;
    	padding-left:0;
    }
</style>
<h2>Solicitud Seguro de Accidentes</h2>
<h4>Condiciones seguro</h4>
<ul>
    <li><strong>Póliza seleccionada:</strong> '.IDA_poliza_selected($_SESSION['poliza'])['nombre'].'</li>
    <li><strong>Precio proporcionado al cliente:</strong> '.IDA_poliza_selected($_SESSION['poliza'])['precio'].' €/año'.'</li>
</ul>
<h4>Datos del asegurado</h4>
<h6>Riesgo asegurado</h6>
<ul>
<li><strong>Profesión: </strong>'.obtener_informacion_profesion($profesion)->profesion.'</li>
<li><strong>Riesgo asociado a la profesión: </strong>'.obtener_informacion_profesion($profesion)->riesgo.'</li>
<li><strong>¿Realiza algún tipo de trabajo manual? : </strong>'.$actividad_maual.'</li>';

if ($actividad_maual == 'si') {
    $templateEmail .= '<li><strong>Tipo de trabajo manual que realiza: </strong>'.$descr_trabajo_manual.'</li>';
}

$templateEmail .= '<li><strong>¿Ha padecido o padece algún tipo de enfermedad cardiaca? : </strong>'.$enf_cardiaca.'</li>';

if ($enf_cardiaca == 'si') {
    $templateEmail .= '<li><strong>Información detallada acerca de la enfermedad cardiaca: </strong>'.$enf_cardiaca_descript.'</li>';
}

$templateEmail .= '<li><strong>¿Tiene algún tipo de enfermedad grave o minusvalía? : </strong>'.$enf_grave.'</li>';

if ($enf_grave == 'si') {
    $templateEmail .= '<li><strong>Información detallada acerca de tus problemas de salud y/o minusvalía: </strong>'.$enf_grave_desctip.'</li>';
}

$templateEmail .= '</ul>
<h6>Datos personales:</h6>
<ul>
    <li><strong>Nombre:</strong> '.ucfirst($nombre_asegurado).'</li>
    <li><strong>Apellidos:</strong> '.ucfirst($apellidos_asegurado).'</li>
    <li><strong>Código Postal:</strong> '.$codigo_postal_asegurado.'</li>
    <li><strong>Provincia:</strong> '.IDA_obtenerNombreProvincia($provincia_asegurado).'</li>
    <li><strong>Población:</strong> '.$poblacion_asegurado.'</li>
    <li><strong>Dirección:</strong> '.$direccion_asegurado.'</li>
    <li><strong>NIF/CIF/NIE:</strong> '.$identificador_asegurado.'</li>
    <li><strong>Email:</strong> '.$email_asegurado.'</li>
    <li><strong>Teléfono:</strong> '.$telefono_asegurado.'</li>
    <li><strong>Fecha nacimiento:</strong> '.$fecha_nacimiento_asegurado.'</li>
    <li><strong>Fecha efecto seguro:</strong> '.$fecha_efecto_solicitada_asegurado.'</li>
    <li><strong>Cuenta Bancaria:</strong> '.$iban_asegurado.'</li>
</ul>';

// Verificamos si existe al menos un valor en la variable $nombre_tomador
if (!empty($nombre_tomador)) {
    $templateEmail .= '<h4>Datos del tomador</h4>
    <ul>
        <li><strong>Nombre:</strong> '.ucfirst($nombre_tomador).'</li>
        <li><strong>Apellidos:</strong> '.ucfirst($apellidos_tomador).'</li>
        <li><strong>Código Postal:</strong> '.$codigo_postal_tomador.'</li>
        <li><strong>Población:</strong> '.ucfirst($poblacion_tomador).'</li>
        <li><strong>Dirección:</strong> '.ucfirst($direccion_tomador).'</li>
        <li><strong>Identificador:</strong> '.$identificador_tomador.'</li>
    </ul>';
}else{
	$templateEmail .= '<h4>Datos del tomador</h4> <p>Los datos del tomador son iguales a los del asegurado</p>';
}

// Verificamos si existe al menos un valor en la variable 
if (!empty($beneficiarios)) {
    $templateEmail .= '<h4>Beneficiarios del seguro:</h4>';
    
    // Iteramos sobre cada beneficiario
    foreach ($beneficiarios as $clave => $beneficiario) {
        $templateEmail .= '<ul><li class="no-fsg"><h6>Beneficiario '.$clave.'</h6></li><li><strong>Nombre:</strong> ' . ucfirst($beneficiario["nombre"]) . '</li>
        <li><strong>NIF:</strong> ' . $beneficiario["nif"] . '</li>
        <li><strong>Porcentaje:</strong> ' . $beneficiario["porcentaje"] . '%</li></ul>';
    }
} else {
    $templateEmail .= '<h4>Beneficiarios del seguro:</h4> <p>No se han proporcionado beneficiarios para la póliza.</p>';
}


?>
