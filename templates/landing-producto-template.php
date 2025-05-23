<?php
/**
 * Template para los servicios que se ofrecen
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$producto = get_queried_object();
get_header();

$fondo_coberturas = get_field('color_fondo_coberturas');
$fondo_z_libre = get_field('color_zona_libre');
$fondo_ventajas = get_field('color_fondo_puntos_dolor');
$fondo_faqs = get_field('color_fondo_faqs');
$fondo_adjuntos = get_field('color_fondo_docs_adjuntos');

if ($fondo_faqs == "verde") {
	$classfa = "siropesr";
}else{
	$classfa = "";
}


?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main product-temp comp-polizas-rs" role="main">

			<div class="container container ps-4 pe-4">
				<section id="top-do-box" class="franja">
					<div class="d-flex flex-row flex-wrap align-items-center align-items-md-center justify-items-between">
						<div class="col-12 col-md-6 text-start" id="text-val-b">
							<header>
								<h1 class="h1-servicios"><?php the_title(); ?></h1>
							</header>
							<h3 class="color-verde"><?= esc_html(get_field('subtitulo')); ?></h3>
	                        <div class="mb-2">
	                            <?= wp_kses_post(get_field('texto_presentacion')); ?>
	                        </div>

	                        <div class="price-inter mb-4">Desde 362 <span class="mini-moneda">€ al año</span></div>

	                        <div class="d-flex">
	                        	<div>
	                        		<a href="#form_datos_select_productos" class="btn btn-rosa me-3">Calcular precio</a>
	                        	</div>
	                        	<div>
	                        		<a href="#"  data-bs-toggle="modal" data-bs-target="#ModalLlamarLateral" class="btn btn-secondary">¿Te llamamos?</a>
	                        	</div>
	                        </div>
						</div>
						<div class="col-12 col-md-6 m-auto" id="img-producto">
							<?php 
								$imagen_cat = get_the_post_thumbnail('','entry-image',array( 'class' => 'img-responsive' ,'title' => get_the_title()));
								echo $imagen_cat;
							 ?>
						</div>
					</div>
				</section>
			</div>

			<div class="container comp-coberturas mt-2">
				<div class="franja pb-0 pt-0">
					<h2 class="title-pol-disp mb-3">Tu seguro de Responsabilidad Civil de Administradores y Altos Cargos.</h2>
					<p class="mb-3">Seguridad en cada decisión, respaldo en cada paso.</p>
				</div>
				<?php 
					if (wp_is_mobile()) {
					    require SDOPZ_PLUGIN_PATH. '/parts/coberturas-mobile.php';
					} else {
					    require SDOPZ_PLUGIN_PATH. '/parts/coberturas-desktop.php';
					}
				?>

			
				<div id="cond-generales" class="d-flex mt-3 justify-content-center align-items-start">
					<div class="cond-gen-box">
						<a class="color-azul bold" target="_blank" href="<?= SDOPZ_PLUGIN_URL; ?>/archivos/D&O Condicionado General.pdf"><img class="down-condi" src="<?= SDOPZ_PLUGIN_URL; ?>/img/download_icon.svg'); ?>" alt="Mostrar y ocultar info"> Condiciones particulares</a>
					</div>
				</div>

				<small class="color-azul mt-4 d-block text-center ps-1 pe-1">*Las coberturas, extensiones de cobertura, exclusiones y resto de condiciones contenidas en esta oferta son meramente un extracto del condicionado de aplicación ofrecido por Markel. En caso de cualquier duda de interpretación, prevalecerá siempre lo contenido en la póliza emitida.</small>
			</div>

			</div>

			<div class="container-fluid verde-franja mt-5">
				<!-- Incluimos la sección 3 iconos -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-iconos.php'); ?>							
			</div>

			<div class="container-fluid">
				<!-- Incluimos la sección de contenido libre -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-contenido-libre.php'); ?>
			</div>

			<div class="container-fluid" style="background:<?= ColorHexC($fondo_coberturas); ?>">
				<!-- Incluimos la sección coberturas -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-coberturas.php'); ?>	
			</div>

			<div class="container-fluid" style="background:<?= ColorHexC($fondo_z_libre); ?>">
				<!-- Incluimos la sección coberturas -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-zona-libre.php'); ?>	
			</div>

			<div class="container-fluid" style="background:<?= ColorHexC($fondo_ventajas); ?>">
				<!-- Incluimos la sección ventajas -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-ventajas.php'); ?>
			</div>

			<div class="container-fluid <?= $classfa; ?>" style="background:<?= ColorHexC($fondo_faqs); ?>">
				<!-- Incluimos la sección faqs -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-faqs.php'); ?>	
			</div>

			<div class="container-fluid" style="background:<?= ColorHexC($fondo_adjuntos); ?>">
				<!-- Incluimos la sección docs.adjuntos -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-adjuntos.php'); ?>
			</div>

			<div class="container-fluid">
				<!-- Incluimos la sección docs.adjuntos -->
				<?php include(get_template_directory() .'/parts/parts-productos/part-prod-vinculados.php'); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_footer();



