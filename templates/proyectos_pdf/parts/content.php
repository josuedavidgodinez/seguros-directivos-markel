
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<title>Plantilla PDF Presupuesto Seguro</title>
	<style type="text/css">
		 @font-face { 
            font-family: 'Fieldwork'; 
            src: url('<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/fonts/Fieldwork-Geo-Regular.ttf'?>') format("truetype");
            font-style: normal; 
            font-weight: normal; 
        }

        @font-face { 
            font-family: 'Fieldwork'; 
			src: url('<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/fonts/Fieldwork-GeoThin.ttf'?>') format("truetype");
            font-style: normal; 
            font-weight: 200; 
        }

        @font-face { 
            font-family: 'Fieldwork';
			src: url('<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/fonts/Fieldwork-Geo-Bold.ttf'?>') format("truetype");
            font-style: normal;
            font-weight: bold; 
        }
        body {color:#004481; font-family: 'Fieldwork', sans-serif; font-style: normal; }
		.text-primary {color:#009696 !important;}
		.text-secondary {color:#777 !important;}
		.text-danger {color:#ff2f76 !important;}
		.border {border-color:#004481 !important}
		.border-primary {border-color:#009696 !important;}
		.border-danger {border-color:#ff2f76 !important;}

		.font-small {font-size:0.8rem;}
		.font-smaller {font-size:0.6rem ;}
		.font-weight-semibold {font-weight: 600 !important;}
		.bg-primary-solid {background: #009696 !important;}
		.bg-primary-transparent-1 {background: #00969610;}
		.bg-primary-transparent-2 {background: #00969620;}
		.border-width-custom-1 {border-width: 2px !important;}
		.border-width-custom-2 {border-width: 3px !important;}
		.border-semitransparent {border-color:#00969630 !important;}
		.card-image img{
			width: 54.6px;
			height: 61.6px;
		}

		.icon-facts {
  			width: 52.2px;
			height: 52.2px;
		    position: absolute;
		    left: -1.5rem;
		    top: -1.2rem;
			background-repeat: no-repeat;
		}

		.why-icon{
			width: 90px;
			height: 90px;
		}

		.compromiso-icon{
			width: 100px;
			height: 100px;
		}

		.plan-selected {
			border-right: 2px solid #FF2F76 !important;
			border-left: 2px solid #FF2F76 !important;
		}
		.plan-selected.first {
		    background: #FF2F76;
		    padding-top: 5px;
		    border-radius: 8px 8px 0 0;
		    border: 2px solid #FF2F76;
		}
		.plan-selected.last {
			border-bottom: 2px solid #FF2F76;
			padding-bottom: 24px !important;
			border-radius: 0 0 8px 8px;
		}
		table {border-collapse: separate;}
		
		.card {
		    width: 31.3333% !important;
		    margin-right: 3%;
		}
		.card.last {
			margin-right: 0;
		}
	</style>
</head>
<body>
	<div style="page-break-after:always;"></div>
	<!-- PÁG 1 -->
	 <?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-cobertura-1.svg'?>" alt="Datos del asegurado">
				Datos del asegurado
			</div>			
		</div>
		<div class="row my-4 ml-1 pt-2">
			<div class="col" >
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Nombre y apellidos:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas </div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">NIF:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas </div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Dirección:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas </div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Teléfono:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas</div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Correo electrónico:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas</div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Fecha de nacimiento:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"> sadfsadfas </div>
				</div>
			</div>			
		</div>
	</section>

	<div style="page-break-after:always;"></div>
	<!-- PÁG 7 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-12.svg'?>" alt="Anotaciones legales">
				Algunas anotaciones legales que deberías leer
			</div>			
		</div>
		<div class="row my-5">
			<div class="col">
				<h6 class="text-primary">NOTA INFORMATIVA SOBRE COLABORACION EN DISTRIBUCION</h6>
				<p class="font-weight-light"></p>

				<p class="font-weight-light">
				  Que conforme a la normativa de distribución de seguros y reaseguros privados se informa que para el contrato de seguro ofrecido/propuesto por IBROK 2010, CORREDURIA DE SEGUROS S.L. actúa bajo responsabilidad de AUNNA BROKER CORREDURIA DE SEGUROS S.L.U. 100% participada de AUNNA ASOCIACION DE EMPRESARIOS CORREDORES DE SEGUROS. Siendo AUNNA BROKER quien figura como mediador en el contrato bajo la clave que tiene asignada en la Aseguradora.
				</p>

				<p class="font-weight-light">
				  IBROK 2010, CORREDURIA DE SEGUROS S.L. con clave autorizada J-0071-CAC, mantiene una relación mercantil de colaboración con AUNNA BROKER CORREDURIA DE SEGUROS S.L.U., sita en C/ Doctor Fleming 53, 28036 - Madrid y con C.I.F. B87345070, dedicada a la actividad de correduría de seguros y autorizada por la Dirección General de Seguros y Fondos de Pensiones con la clave J3310 y correctamente inscrita en el Registro administrativo de distribuidores de seguros, que puede Vd. comprobar en la página web de la Dirección General de Seguros y Fondos de Pensiones: <a href="http://www.dgsfp.mineco.es">www.dgsfp.mineco.es</a>.
				</p>

				<p class="font-weight-light">
				  AUNNA BROKER tiene suscrita póliza de Responsabilidad Civil Profesional Hispania Global Underwriting, agencia de suscripción, y dispone de capacidad financiera legalmente establecida. Cumple todos los requisitos referidos a la honorabilidad profesional y comercial exigibles a su órgano de administración y a la persona responsable de la distribución.
				</p>

				<p class="font-weight-light">
				  AUNNA BROKER cuenta con un departamento de atención al cliente externalizado, encargado de atender y resolver sus quejas y reclamaciones, a través de AUNNA ASOCIACION DE EMPRESARIOS CORREDORES DE SEGUROS, cuyos datos son los siguientes: AUNNA DEPARTAMENTO DE ATENCION AL CLIENTE, C/ Doctor Fleming 53, 28036 Madrid, email atencionalcliente@aunnaasociacion.es, telf. 910 339 615.
				</p>

				<p class="font-weight-light">
				  Para los contratos suscritos en colaboración con AUNNA BROKER, ambas corredurías han establecido el tratamiento de sus datos de carácter personal como corresponsables del tratamiento de datos, de conformidad con lo previsto en el art. 26.1 del Reglamento (UE) 2016/679, teniendo usted derecho a solicitar a ambos la política de tratamiento de datos y el ejercicio de sus derechos.
				</p>

				<p class="font-weight-light">
				  Los corredores/corredurías de seguros son los únicos profesionales facultados para asesorarle desde la más estricta independencia e imparcialidad, respecto de las entidades aseguradoras. Es por ello que las ofertas que sometemos a su consideración han sido basadas en un análisis objetivo, consistente en analizar de forma generalizada un número suficiente de contratos de seguros ofrecidos por entidades aseguradoras que operan en el mercado, considerando que corresponde a su petición dentro de una valoración de méritos para buscar una correcta cobertura a sus requerimientos y necesidades.
				</p>

				<p class="font-weight-light">
				  El corredor/correduría informa igualmente al cliente del contenido del artº 21 de la Ley 50/1980, de Contrato de Seguro, de forma tal que las comunicaciones que el mediador curse a la aseguradora surtirán los mismos efectos como si las realizara el propio interesado (tomador).
				</p>

				<p class="font-weight-light">
				  Mediante el presente escrito, y en méritos del principio de autonomía de la voluntad de las partes, el cliente otorga consentimiento expreso y autoriza al corredor/correduría para que éste pueda solicitar cotizaciones, modificar o rescindir los contratos de seguros en vigor y mediar y celebrar en su nombre nuevos contratos de seguro, para la mejor protección de los derechos del cliente.
				</p>

			</div>
		</div>
	</section>
	<div style="margin-top: 105px">
	 <?php
		$page = 9;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>
	 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
