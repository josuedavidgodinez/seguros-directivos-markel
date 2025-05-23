
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
			width: 60px;
			height: 60px;
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
		.col-15{
			flex: 0 0 auto;
        	width: 8%;
        	margin:0 1.5%;
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
	            <img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-cobertura-1.svg'?>" alt="Datos de la empresa">
	            Datos de la empresa
	        </div>          
	    </div>

	    <div class="row my-4 ml-1 pt-2">
	        <div class="col">
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Razón social asas:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $nombre_repre ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">CIF:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $cif_data ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Fecha de constitución:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $fecha_constitucion ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Actividades de la empresa (incluídas las filiales):</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= nl2br( esc_html( $actividad_descript ) ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Facturación anual (incluídas las filiales):</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $facturacion_data ); ?> €
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Dirección:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( 
	                        $direccion_completa
	                        . ', ' . $codigo_postal
	                        . ' '  . $poblacion
	                        . ' (' . SDOPZ_obtenerNombreProvincia($provincia) . ')'
	                    ); ?>
	                </div>
	            </div>
	        </div>          
	    </div>

	    <div class="row bg-primary-solid ml-4 pt-1">
	        <div class="col text-white text-uppercase pl-5">
	            <img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-cobertura-1.svg'?>" alt="Datos del representante">
	            Datos representante
	        </div>          
	    </div>

	    <div class="row my-4 ml-1 pt-2">
	        <div class="col">
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Nombre y apellidos:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( ucwords( "{$nombre_repre} {$apellido_repre}" ) ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Cargo:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $cargo_repre ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Teléfono:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $telefono_repre ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">NIF/NIE:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $identificador_repre ); ?>
	                </div>
	            </div>
	            <div class="row mb-1 pb-1">
	                <div class="col-4 pt-1">Correo electrónico:</div>
	                <div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">
	                    <?= esc_html( $email_repre ); ?>
	                </div>
	            </div>
	        </div>          
	    </div>
	</section>
	
	<div style="margin-top: 485px">
	<?php
		$page = 2;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>



	<div style="page-break-after:always;"></div>
	<!-- PÁG 2 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-5.svg'?>" alt="Garantías y capitales asociados">
				Garantías y capitales asociados
			</div>			
		</div>
		<div class="row my-4 ml-1 pt-2">
			<div class="col" >
			    <?=$contenido_tabla?>
    			</div>			
		</div>
	</section>
	<div style="margin-top: 155px">
	<?php
		$page = 3;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>




	<div style="page-break-after:always;"></div>
	<!-- PÁG 3 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
	    <div class="row bg-primary-solid ml-4 pt-1">
	        <div class="col text-white text-uppercase pl-5">
	            <img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/3 D Drawaing.svg' ?>" alt="Ejemplos">
	            Ejemplos de lo que este seguro haría por ti
	        </div>            
	    </div>

	    <div class="row mt-5 mb-4 ml-1 pt-2">
	        <!-- Ejemplo 1: Sanciones administrativas -->
	        <div class="card bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Burning Money 1.svg'?>" alt="Sanciones administrativas">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Sanciones administrativas
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Si la autoridad impone una multa de hasta 300.000 €, cubrimos el importe para que no afecte al patrimonio personal de tus directivos.
	                </div>
	            </div>
	        </div>

	        <!-- Ejemplo 2: Gastos de defensa -->
	        <div class="card bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Law Book.svg'?>" alt="Gastos de defensa">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Gastos de defensa
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Honorarios de abogados y peritos sin límite de sublímite, para reclamar o defenderse en juicio ante cualquier reclamación civil.
	                </div>
	            </div>
	        </div>

	        <!-- Ejemplo 3: Protección de datos -->
	        <div class="card last bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Folder Search 4.svg'?>" alt="Protección de datos">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Protección de datos
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Hasta 100.000 € para cubrir sanciones y costes de notificación si se vulnera la información sensible de la empresa.
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row mb-4 ml-1 pt-2">
	        <!-- Ejemplo 4: Asistencia psicológica -->
	        <div class="card bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Psychologist 10.svg'?>" alt="Asistencia psicológica">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Asistencia psicológica
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Sesiones con un especialista hasta un máximo de 120.000 €, para gestionar el estrés tras una investigación o procedimiento legal.
	                </div>
	            </div>
	        </div>

	        <!-- Ejemplo 5: Deshonestidad de empleados -->
	        <div class="card bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Stress Employee 3.svg'?>" alt="Deshonestidad de empleados">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Deshonestidad de empleados
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Cobertura hasta 100.000 € si un directivo sufre pérdidas por fraude interno o malversación.
	                </div>
	            </div>
	        </div>

	        <!-- Ejemplo 6: Reembolso a la Entidad -->
	        <div class="card last bg-light border-light">
	            <div class="row p-3">
	                <div class="card-title pt-2 px-2 d-flex">
	                    <div class="card-image">
	                        <img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Money Cash Bag.svg'?>" alt="Reembolso a la Entidad">
	                    </div>
	                    <div class="card-title align-self-center font-weight-bold h5 mx-2 my-auto">
	                        Reembolso a la Entidad
	                    </div>
	                </div>
	                <div class="col-12 font-weight-light mt-3">
	                    Si el directivo debe compensar a la compañía por un error profesional, se cubrirá el reembolso sin sublímite.
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<div style="margin-top: 465px">
	 <?php
		$page = 4;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>


	<div style="page-break-after:always;"></div>
	<!-- PÁG 4 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-7.svg'?>" alt="Condiciones de contratación">
				Condiciones de contratación
			</div>			
		</div>
		<div class="row my-4 ml-1 pt-2 mb-5">
			<div class="col mb-5" >
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Período de cobertura:</div>

					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">Del <span class="font-weight-normal"><?=$fecha_efecto_solicitada?></span> al <span class="font-weight-normal"><?=$fecha_final_cobertura_mod?></span></div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Periodicidad de pago:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light">Anual</div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Importe primer recibo:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"><?=$precio_base?> €/año</div>
				</div>
				<div class="row mb-1 pb-1">
					<div class="col-4 pt-1">Prima total anual:</div>
					<div class="col-8 pt-1 bg-primary-transparent-1 text-secondary font-weight-light"><?=$precio_base?> €/año</div>
				</div>
			</div>			
		</div>
		<div class="row my-5 ml-3 pt-3 px-2 bg-light">
			<div class="col font-weight-light font-small">
				<p>Este documento no es una póliza y por tanto no vincula contractualmente a la Correduria. <?= WPCONFIG_NAME_EMPRESA; ?> se compromete a mantener el precio indicado en este proyecto hasta el <?= $fecha_al_anio_format; ?>, siempre que los datos utilizados para la cotización no varíen y puedan ser contrastados documentalmente.</p>
				<p>La aceptación y el inicio de la cobertura se producirá en el momento en que se formalice la correspondiente póliza de seguro y se haga efectivo el pago del primer recibo por parte del Tomador.</p>
				<p>Para más información, puede consultar si lo desea la Nota Informativa Previa a la contratación y el IPID.</p>
			</div>
		</div>
	</section>

	<section class="container mt-5">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-8.svg'?>">
				¿Por qué elegir <?= WPCONFIG_NAME_EMPRESA; ?> ?
			</div>			
		</div>
		<div class="row">
			<div class="col-4 text-center p-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/tres-mares-icon-why-1.svg'?>" alt="Seguros para aquello que necesites" class="mb-2 why-icon">
				<h4 class="font-weight-bold">Seguros para aquello que necesites</h4>
				<p class="text-dark font-weight-light">Desde un seguro de vida a uno para tu nueva nave espacial</p>
			</div>
			<div class="col-4 text-center p-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Rectangle 24.png'?>" alt="Seguros para aquello que necesites" class="mb-2 why-icon">
				<h4 class="font-weight-bold">Las mejores opciones entre las que elegir</h4>
				<p class="text-dark font-weight-light">Colaboramos con las compañías más importantes del mercado</p>
			</div>
			<div class="col-4 text-center p-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/tres-mares-icon-why-3.svg'?>" alt="Seguros para aquello que necesites" class="mb-2 why-icon">
				<h4 class="font-weight-bold">Gestionamos tus siniestros</h4>
				<p class="text-dark font-weight-light">Peleamos para que tus intereses estén bien protegidos</p>
			</div>
		</div>
	</section>
	<div style="margin-top: 172px">
	 <?php
		$page = 5;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>


	<div style="page-break-after:always;"></div>
	<!-- PÁG 5 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-9.svg'?>" alt="Compromisos <?= WPCONFIG_NAME_EMPRESA; ?>">
				Compromisos <?= WPCONFIG_NAME_EMPRESA; ?>
			</div>			
		</div>
		<div class="row">
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/tres-mares-icon-compromiso-1.svg'?>" alt="Las mejores compañías de seguros" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">1</h3>
				<h4 class="font-weight-bold">Las mejores compañías de seguros</h4>
				<p class="text-dark font-weight-light">Te facilitamos la decisión de elegir una compañía de seguros. Trabajamos solo con aseguradoras top.</p>
			</div>
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/tres-mares-icon-compromiso-2.svg'?>" alt="Cambia de correduría sin cambiar de compañía" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">2</h3>
				<h4 class="font-weight-bold">Cambia de correduría sin cambiar de compañía</h4>
				<p class="text-dark font-weight-light">Te ayudamos con tus seguros independientemente de con quien tengas tus  pólizas.</p>
			</div>
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/tres-mares-icon-compromiso-3.svg'?>" alt="Ahorro más allá de lo económico" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">3</h3>
				<h4 class="font-weight-bold">Ahorro más allá de lo económico</h4>
				<p class="text-dark font-weight-light">Queremos lo mejor para ti. Por eso luchamos porque tus intereses prevalezcan.</p>
			</div>
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Problem Solving 1.svg'?>" alt="Compartimos intereses" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">4</h3>
				<h4 class="font-weight-bold">Compartimos intereses</h4>
				<p class="text-dark font-weight-light">Desde un seguro de vida a uno para tu nueva nave espacial.</p>
			</div>
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Businessman Card 3.svg'?>" alt="Te ahorramos a investigar" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">5</h3>
				<h4 class="font-weight-bold">Te ahorramos a investigar</h4>
				<p class="text-dark font-weight-light">No dejamos de analizar e indagar sobre garantías y coberturas para ofrecerte lo mejor de lo mejor en tu póliza.</p>
			</div>
			<div class="col-4 text-center px-5 pt-5">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/Going Onwards With Optimism 5.svg'?>" alt="Te ayudamos a vivir mejor" class="mb-4 compromiso-icon" >
				<h3 class="font-weight-bold text-danger h2">6</h3>
				<h4 class="font-weight-bold">Te ayudamos a vivir mejor</h4>
				<p class="text-dark font-weight-light">Luchamos para que disfrutes una vida tranquila, protegido frente a viento y marea.</p>
			</div>
		</div>
	</section>

	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-10.svg'?>" alt="Compañías con las que colaboramos">
				Compañías con las que colaboramos
			</div>			
		</div>
		<div class="row mt-4 justify-content-center">
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/logogenerali.svg'?>" alt="Generali Seguros" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/logoaxa.svg'?>" alt="Axa" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/zurich-logo-asd.svg'?>" alt="Zurich" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/sanitas-en-color.svg'?>" alt="Sanitas" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/catalana-occidente-Convertido.svg'?>" alt="Catalana Occidente" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/dkv-color-af.svg'?>" alt="DKV" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/caser-seguros-Convertido-1.svg'?>" alt="Caser" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/allianz-2-1-1.svg'?>" alt="Allianz" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/adeslas-colorsdg.svg'?>" alt="Adeslas" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/mapfre-logo-1.svg'?>" alt="Mapfre" class="img-fluid">
			</div>			
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/pelayo-Convertido.svg'?>" alt="Pelayo" class="img-fluid">
			</div>
			<div class="col-15">
				<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/liberty-seguros-Convertido.svg'?>" alt="Liberty Seguros" class="img-fluid">
			</div>
		</div>
	</section>
	<div style="margin-top: 5px">
	 <?php
		$page = 6;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>

	<div style="page-break-after:always;"></div>
	<!-- PÁG 6 -->
	<?php
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/header.php' );
	 ?>
	<section class="container mt-4">
		<div class="row bg-primary-solid ml-4 pt-1">
			<div class="col text-white text-uppercase pl-5">
				<img class="icon-facts" src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/accidentes-icon-section-10.svg'?>" alt="Información previa">
				Información previa
			</div>			
		</div>
		<div class="row my-5">
			<div class="col">
				<span class="text-primary">¿En qué consiste este tipo de seguro?</span>
				<span class="font-weight-light text-dark">Este seguro ofrece protección integral ante incidentes cibernéticos para autónomos y pymes, incluyendo daños a sistemas, interrupción del negocio, responsabilidades legales y ciberdelincuencia.</span>
			</div>
		</div>
		<div class="row pt-5 pb-2 border-top border-semitransparent">
			<div class="col-6 border-right border-semitransparent pr-5">
				<h4 class="text-center font-weight-bold text-primary">¿Qué se asegura?</h4>

				<div class="d-flex flex-row mt-5">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png'?>" alt="check" style="width: 18px;">
					</div>
					<div class="mt-1">
						<h6>Respuesta ante incidentes cibernéticos</h6>
						<p class="text-dark font-weight-light font-small">Asistencia inmediata, análisis forense, comunicación de crisis y defensa legal.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png'?>" alt="check" style="width: 18px;">
					</div>
					<div class="mt-1">
						<h6>Vulneración de privacidad</h6>
						<p class="text-dark font-weight-light font-small">Cobertura de los costes de notificación y gestión tras una filtración de datos, tanto propios como de terceros.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png'?>" alt="check" style="width: 18px;">
					</div>
					<div class="mt-1">
						<h6>Daños a sistemas e interrupción del negocio</h6>
						<p class="text-dark font-weight-light font-small">Reparación de sistemas y compensación por pérdida de beneficios durante la interrupción de la actividad.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png'?>" alt="check" style="width: 18px;">
					</div>
					<div class="mt-1">
						<h6>Ciberdelincuencia</h6>
						<p class="text-dark font-weight-light font-small">Cobertura ante extorsión cibernética, fraude por transferencia de fondos y robo de identidad digital.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png'?>" alt="check" style="width: 18px;">
					</div>
					<div class="mt-1">
						<h6>Responsabilidad civil y sanciones</h6>
						<p class="text-dark font-weight-light font-small">Responsabilidad por daños a terceros y multas derivadas de investigaciones regulatorias.</p>
					</div>
				</div>

			</div>

			<div class="col-6 pl-5">
				<h4 class="text-center font-weight-bold text-danger">¿Qué No se asegura?</h4>

				<div class="d-flex flex-row mt-5">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/block.svg'?>" alt="block" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">Robos de cuentas fiduciarias, fondos personales, hacking telefónico o phishing si no se contrata la extensión de cobertura.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/block.svg'?>" alt="block" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">Actos intencionados por parte de altos directivos ejecutivos.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/block.svg'?>" alt="block" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">Costes de hardware, daños materiales o lesiones corporales.</p>
					</div>
				</div>

				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/block.svg'?>" alt="block" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">Incidentes conocidos con anterioridad a la contratación del seguro.</p>
					</div>
				</div>

				<h4 class="text-center font-weight-bold text-dark mt-5 pt-5 border-top border-semitransparent">¿Existen restricciones en lo que respecta a la cobertura?</h4>

				<div class="d-flex flex-row mt-5">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/alert.svg'?>" alt="Alerta" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">El seguro solo cubre los incidentes descubiertos y notificados durante el período de vigencia de la póliza.</p>
					</div>
				</div>
				<div class="d-flex flex-row mt-3">
					<div class="mr-4">
						<img src="<?= SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/alert.svg'?>" alt="Alerta" style="width: 18px;">
					</div>
					<div class="mt-1">
						<p class="text-dark font-weight-light font-small">No cubre fallos en la infraestructura principal de internet.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div style="margin-top: 195px">
	 <?php
		$page = 7;
	 	include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	 ?>
	</div>

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
	         <h6 class="text-primary">Las cosas, claras.</h6>
	         <p class="font-weight-light">
	            Este presupuesto ha sido emitido por <?php echo WPCONFIG_NAME_EMPRESA; ?>, con CIF B39524087 y con domicilio en <?php echo WPCONFIG_DIRECCION_EMPRESA; ?>, inscrita en el Registro de la Dirección General de Seguros y Fondos de Pensiones con el número [J2457]. Puede consultar nuestra inscripción en el registro en la página web de la DGSFP: <a href="https://dgsfp.mineco.gob.es/">https://dgsfp.mineco.gob.es/</a>.
	         </p>
	         <p class="font-weight-light">
	            La comercialización de este producto de <strong>Ciberseguro</strong>, la realiza <?php echo WPCONFIG_NAME_EMPRESA; ?> como entidad colaboradora de <strong>Asegura Broker Network Correduría de Seguros</strong>, con CIF B10945665 y con domicilio en Calle Castro nº 50, 6º D 38006 – Santa Cruz de Tenerife, inscrita en el Registro de la Dirección General de Seguros y Fondos de Pensiones con el número [J4466].
	         </p>
	         <p class="font-weight-light">
	            Este presupuesto tiene carácter meramente informativo y no constituye una oferta en firme ni el inicio de un contrato de seguro. Las condiciones definitivas estarán sujetas a la aceptación de la compañía aseguradora correspondiente.
	         </p>
	         <p class="font-weight-light">
	            De conformidad con el Reglamento (UE) 2016/679 (Reglamento General de Protección de Datos) y la Ley Orgánica 3/2018 de Protección de Datos Personales y garantía de los derechos digitales, le informamos de que los datos proporcionados serán tratados con la finalidad de gestionar el presente presupuesto. El responsable del tratamiento de los datos es <?php echo WPCONFIG_NAME_EMPRESA; ?>. Puede ejercer sus derechos de acceso, rectificación, supresión, oposición, limitación y portabilidad mediante comunicación escrita a <?php echo WPCONFIG_MAIL_EMPRESA; ?> o en <?php echo WPCONFIG_DIRECCION_EMPRESA; ?>.
	         </p>
	         <p class="font-weight-light">
	            Si tiene alguna discrepancia o incidencia relacionada con nuestros servicios, puede dirigirse a nuestro Departamento de Atención al Cliente en <?php echo WPCONFIG_MAIL_EMPRESA_PARA_PUBLICO; ?> o llamando al <?php echo WPCONFIG_TELEFONO_EMPRESA; ?>.
	         </p>
	         <p class="font-weight-light">
	            Si no hemos satisfecho sus demandas o expectativas, puede dirigir su queja o reclamación por escrito a nuestro Servicio de Atención al Cliente (Aunna Broker Correduría de Seguros) con dirección en Calle Doctor Fleming nº 53, 28036 – Madrid y email atencionalcliente@aunnaasociacion.es.
	         </p>
	         <p class="font-weight-light">
	            Dicho servicio resolverá las quejas o reclamaciones a la mayor brevedad. Asimismo, tiene derecho a presentar una reclamación ante el Servicio de Reclamaciones de la Dirección General de Seguros y Fondos de Pensiones, si lo considera oportuno.
	         </p>
	         <p class="font-weight-light">
	            Este presupuesto será válido durante un plazo de [15] días a partir de la fecha de emisión, salvo modificaciones en las condiciones generales y particulares de las aseguradoras involucradas.
	         </p>
	         <p class="font-weight-light">Legislación y condiciones aplicables:</p>
	         <ul>
	            <li>Ley 50/80 de Contrato de Seguro, de 8 de octubre.</li>
	            <li>Ley 20/2015 de 14 de julio de Ordenación, Supervisión y Solvencia de las Entidades Aseguradoras y Reaseguradoras.</li>
	            <li>Ley 7/2004, de 29 de octubre, en lo relativo a la regulación del estatuto legal del Consorcio de Compensación de Seguros.</li>
	            <li>Cualquier otra norma que durante la vigencia de la póliza pueda ser aplicable.</li>
	            <li>Las coberturas de la póliza se regirán por las condiciones particulares, generales, y especiales en su caso, de la póliza de seguro.</li>
	         </ul>
	      </div>
	   </div>
	</section>
	<div style="margin-top: 125px">
	   <?php
	      $page = 8;
	      include( SDOPZ_PLUGIN_PATH . 'templates/proyectos_pdf/parts/footer.php' );
	   ?>
	</div>

	

	 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
