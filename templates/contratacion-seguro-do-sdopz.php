<?php
	get_header();

	//echo do_shortcode('[turnstile_protect]');

	//Botonos de volver y salir
	require( SDOPZ_PLUGIN_PATH . 'parts/salir-proceso.php' ) ;
	//Pantalla de loading 
	require( SDOPZ_PLUGIN_PATH . 'parts/loader-simple.php' ) ;

	require( SDOPZ_PLUGIN_PATH . 'parts/modal-sectores-excluidos.php' ) 
?>



<div id="primary" class="content-area viajes-inter">
	<main id="main" class="site-main product-temp" role="main">

		<!-- COMIENZA BLOQUE IZQUIERDO -->
		<div class="bloque-sin-left principal-left">

			<div class="container-mini-tarif-viajes">

				<!-- COMIENZA EL FORMULARIO -->
				<form id="form-contract-do" action="#" method="POST" class="form-validado multistep-asg" novalidate>

					<img class="img-sgviajes" src="<?= SDOPZ_IMAGEN_PLUGIN; ?>" alt="Calcula el precio de tu <?= SDOPZ_PRODUCTO_NOMBRE; ?>">
					<?php 
						// Incluir el archivo desde la carpeta "parts"
						include( SDOPZ_PLUGIN_PATH . 'parts/steps-form.php' );
					?>	



					<!-- PANTALLA 1 -->
					<div id="step-form-anim-1">

						<h2 class="title-viajes ">Calcula el precio de tu seguro de RC Directivos</h2>
						<p class="mb-0">Selecciona tu <b>facturación</b> y el <b>límite máximo de indemnización</b> en caso de siniestro.</p>

						<div class="text-start franja franja-forms-multstp">
							
							<div class="card-forms range-do-sec">								
								<div class="col-12">
									<label for="facturacion_anual" class="form-label">Facturación anual  <img src=" <?= SDOPZ_PLUGIN_URL; ?>img/icono-info.svg" class="icono-info-class" data-toggle="tooltip" title="Última facturación declarada de tu empresa en millones de €"></label> 
									<!-- Tu select original, lo ocultamos con la clase 'd-none' -->
									<select name="facturacion_anual" id="facturacion_anual" class="niceselect form-control d-none" autocomplete="off" required>
									    <option value= 1>Hasta 5.000.000 €</option>
									    <option value= 2>Entre 5.000.001 € y 10.000.000 €</option>
									    <option value= 3>Entre 10.000.001 € y 15.000.000 €</option>
									    <option value= 4 selected>Entre 15.000.001 € y 30.000.000 €</option>
									    <option value= 5>Entre 30.000.001 € y 50.000.000 €</option>
									    <option value= 6>Más de 50.000.000 €</option>
									</select>

									<div class="contiene-range-slider">
										<div class="valores-rango-facturacion ">
											<div class="d-flex justify-content-between numeraciones-range text-start">
												<div class="val-range">5M</div>
												<div class="val-range">10M </div>
												<div class="val-range">15M </div>
												<div class="val-range">30M </div>
												<div class="val-range">50M</div>
												<div class="val-range">+50M</div>
											</div>
										</div>

										<input type="range" class="form-range" id="facturacion_slider" min="1" max="6" step="1" value="3">
										<span id="facturacion_slider_label" class="value-slider-botom">Hasta 15.000.000 €</span>
									</div>
								</div>

								<div class="col-12 mt-5">

									<!-- Almacenamos el valor del precio de la póliza  -->
									<input type="hidden" name="precio_poliza_do" id="precio_poliza_do">

									<label for="limite_indemnizacion" class="form-label">Límite de indemnización <img src=" <?= SDOPZ_PLUGIN_URL; ?>img/icono-info.svg" class="icono-info-class" data-toggle="tooltip" title="Cantidad máxima que te indemnizarán en caso de un siniestro expresada en €."></label>
									<select name="limite_indemnizacion" id="limite_indemnizacion" class="d-none form-control" autocomplete="off" placeholder="¿Cuál es el país más lejano de tu viaje?" required>
										<option value= 1>400.000 €</option>
										<option value= 2>800.000 €</option>
										<option value= 3 selected>1.200.000 €</option>
										<option value= 4>1.600.000 €</option>
										<option value= 5>2.000.000 €</option>
										<option value= 6>3.000.000 €</option>
									</select>

									<div class="contiene-range-slider">
										<div class="valores-rango-indemnizacion">
											<div class="d-flex justify-content-between numeraciones-range text-start" id="lista-values-indemn"> 
												<div class="val-range">400k <span class="sum-adic"></span></div>
												<div class="val-range">800k  <span class="sum-adic"></span></div>
												<div class="val-range">1.2M  <span class="sum-adic"></span></div>
												<div class="val-range">1.6M <span class="sum-adic"></span></div>
												<div class="val-range">2M <span class="sum-adic"></span></div>
												<div class="val-range">3M <span class="sum-adic"></span></div>
											</div>
										</div>

										<input type="range" class="form-range" id="indemnizacion_slider" min="1" max="6" step="1" value="3">
										<span id="indemnizacion_slider_label" class="value-slider-botom">1.200.000 €</span>
									</div>
											
								</div>	

							</div>

							<div class="d-flex box-next-step-asg justify-content-center"> 
								<div class="btn btn-primary btn-next-form btn-next-paso-asg" id="show-steps-advice">Siguiente paso</div>
							</div>

						</div>

					</div>
					<!-- FIN PANTALLA 1 -->

					<!-- PANTALLA 2 -->
						<div id="step-form-anim-2">
						   <h2 class="txt-reduced">
						      ¿Tienen con Markel el seguro de Responsabilidad Civil de Administradores y Altos Cargos la Entidad solicitante, alguna Filial o Participada, o alguno de sus Administradores o Altos Cargos?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q1_markel" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q1_markel" class="form-check-input" id="q1_markel_si" value="si" required>
						                  <label for="q1_markel_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q1_markel" class="form-check-input" id="q1_markel_no" value="no" required checked>
						                  <label for="q1_markel_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 2 -->

						<!-- PANTALLA 3 -->
						<div id="step-form-anim-3">
						   <h2 class="txt-reduced">
						      ¿Es el Pasivo Corriente de la Entidad solicitante o de alguna Filial superior al Activo Corriente?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q2_pasivo_corriente" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q2_pasivo_corriente" class="form-check-input" id="q2_pasivo_corriente_si" value="si" required>
						                  <label for="q2_pasivo_corriente_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q2_pasivo_corriente" class="form-check-input" id="q2_pasivo_corriente_no" value="no" required checked>
						                  <label for="q2_pasivo_corriente_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 3 -->

						<!-- PANTALLA 4 -->
						<div id="step-form-anim-4">
						   <h2 class="txt-reduced">
						      En los últimos 12 meses, ¿la Entidad solicitante o alguna de sus Filiales o Participadas han estado en situación de insolvencia o en concurso de acreedores, han tenido patrimonio neto negativo, o se han visto obligadas a realizar alguna de las medidas correctoras de desequilibrio patrimonial que establece la Ley de Sociedades de Capital u otra legislación aplicable?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q3_insolvencia" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q3_insolvencia" class="form-check-input" id="q3_insolvencia_si" value="si" required>
						                  <label for="q3_insolvencia_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q3_insolvencia" class="form-check-input" id="q3_insolvencia_no" value="no" required checked>
						                  <label for="q3_insolvencia_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 4 -->

						<!-- PANTALLA 5 -->
						<div id="step-form-anim-5">
						   <h2 class="txt-reduced">
						      ¿Cotiza en Bolsa o en algún otro mercado de valores la Entidad solicitante o alguna Filial, o ha anunciado una emisión u oferta pública de venta de valores la solicitante o alguna Filial?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q4_bolsa" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q4_bolsa" class="form-check-input" id="q4_bolsa_si" value="si" required>
						                  <label for="q4_bolsa_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q4_bolsa" class="form-check-input" id="q4_bolsa_no" value="no" required checked>
						                  <label for="q4_bolsa_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 5 -->

						<!-- PANTALLA 6 -->
						<div id="step-form-anim-6">
						   <h2 class="txt-reduced">
						      ¿Tiene la Entidad solicitante o alguna Filial radicados en Estados Unidos y/o Canadá algún tipo de activo, Filial o Participada, valores, acciones, obligaciones, deuda, fondos propios o papel comercial?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q5_us_canada" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q5_us_canada" class="form-check-input" id="q5_us_canada_si" value="si" required>
						                  <label for="q5_us_canada_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q5_us_canada" class="form-check-input" id="q5_us_canada_no" value="no" required checked>
						                  <label for="q5_us_canada_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 6 -->

						<!-- PANTALLA 7A -->
						<div id="step-form-anim-7a">
						   <h2 class="txt-reduced">
						      Durante los últimos 2 años, ¿ha sufrido la Entidad solicitante o alguna Filial algún cambio de control accionarial?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q6a_cambio_control" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q6a_cambio_control" class="form-check-input" id="q6a_cambio_control_si" value="si" required>
						                  <label for="q6a_cambio_control_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q6a_cambio_control" class="form-check-input" id="q6a_cambio_control_no" value="no" required checked>
						                  <label for="q6a_cambio_control_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 7A -->

						<!-- PANTALLA 7B -->
						<div id="step-form-anim-7b">
						   <h2 class="txt-reduced">
						      Durante los últimos 2 años, ¿ha sufrido la Entidad solicitante o alguna Filial alguna fusión, compra o venta?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q6b_propuesta" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q6b_propuesta" class="form-check-input" id="q6b_propuesta_si" value="si" required>
						                  <label for="q6b_propuesta_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q6b_propuesta" class="form-check-input" id="q6b_propuesta_no" value="no" required checked>
						                  <label for="q6b_propuesta_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 7B -->

						<!-- PANTALLA 8 -->
						<div id="step-form-anim-8">
						   <h2 class="txt-reduced">
						    	Indique si la Entidad solicitante, alguna Filial o Participada, o alguna de las personas para las que se solicita este seguro se ha visto en los últimos 5 años afectada por una Reclamación en su contra o por una investigación por parte de cualquier autoridad competente, si ha sido inhabilitada como Administrador, si está afectada por algún proceso penal, o si existe algún hecho o circunstancia que razonablemente pueda dar lugar a una Reclamación contra cualquiera de las citadas personas o entidades.
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q7_reclamacion" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q7_reclamacion" class="form-check-input" id="q7_reclamacion_si" value="si" required>
						                  <label for="q7_reclamacion_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q7_reclamacion" class="form-check-input" id="q7_reclamacion_no" value="no" required checked>
						                  <label for="q7_reclamacion_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 8 -->

						<!-- PANTALLA 9 -->
						<div id="step-form-anim-9">
						   <h2 class="txt-reduced">
						    	Indique si la Entidad solicitante o alguna Filial ha visto denegada alguna solicitud de seguro o renovación, o si se le ha anulado un seguro similar o se ha supeditado a condiciones especiales.
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q8_denegada" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q8_denegada" class="form-check-input" id="q8_denegada_si" value="si" required>
						                  <label for="q8_denegada_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q8_denegada" class="form-check-input" id="q8_denegada_no" value="no" required checked>
						                  <label for="q8_denegada_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 9 -->

						<!-- PANTALLA 10 -->
						<div id="step-form-anim-10">
						   <h2 class="txt-reduced">
						      ¿Cumple los requisitos previstos en el Reglamento General de Protección de Datos – UE 2016/679 (RGPD) o se le ha supeditado a condiciones especiales?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q9_rgpd" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q9_rgpd" class="form-check-input" id="q9_rgpd_si" value="si" required>
						                  <label for="q9_rgpd_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q9_rgpd" class="form-check-input" id="q9_rgpd_no" value="no" required checked>
						                  <label for="q9_rgpd_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 10 -->

						<!-- PANTALLA 11 -->
						<div id="step-form-anim-11">
						   <h2 class="txt-reduced">
						      ¿Realiza actividades en alguno de estos sectores: financiero, capital-riesgo, banca, seguros, aéreo, biotecnológico, clubs deportivos, construcción o inmobiliario; y administraciones y organismos públicos?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q11_sectores_prohibidos" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q11_sectores_prohibidos" class="form-check-input" id="q11_sectores_prohibidos_si" value="si" required>
						                  <label for="q11_sectores_prohibidos_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q11_sectores_prohibidos" class="form-check-input" id="q11_sectores_prohibidos_no" value="no" required checked>
						                  <label for="q11_sectores_prohibidos_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 11 -->

						<!-- PANTALLA 12 -->
						<div id="step-form-anim-12">
						   <h2 class="txt-reduced">
						      ¿Tiene conocimiento de alguna investigación o ha sido sancionado por la Agencia Española de Protección de Datos?
						   </h2>
						   <div class="text-start franja franja-forms-multstp">
						      <div class="card-forms">
						         <div class="row g-4">
						            <label for="q10_aepd" class="form-label label_radio_buttons"></label>
						            <div class="d-flex justify-content-center boxi-rb flex-wrap flex-md-nowrap two-points-multsp m-auto">
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q10_aepd" class="form-check-input" id="q10_aepd_si" value="si" required>
						                  <label for="q10_aepd_si">Sí</label>
						               </div>
						               <div class="radio-button-container text-start col-md-6 col-12">
						                  <input type="radio" name="q10_aepd" class="form-check-input" id="q10_aepd_no" value="no" required checked>
						                  <label for="q10_aepd_no">No</label>
						               </div>
						            </div>
						         </div>
						      </div>
						      <div class="d-flex box-next-step-asg justify-content-center">
						         <div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
						      </div>
						   </div>
						</div>
						<!-- FIN PANTALLA 12 -->

						<!-- PANTALLA 13 -->
						<div id="step-form-anim-13">
							<h2 class="txt-reduced">Indica las actividades de la solicitante y sus filiales:</h2>
							<div class="text-start franja franja-forms-multstp">	
								<div class="card-forms">
									<div class="col-md-12">
										<label for="actividad" class="form-label"></label>
										<input type="textarea" class="form-control" name="actividad" id="actividad" maxlength="400" placeholder="Diseño y desarrollo de aplicaciones web." required>
									</div>
								</div>
								<div class="d-flex box-next-step-asg justify-content-center"> 
									<div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
								</div>
							</div>
						</div>
						<!-- FIN PANTALLA 13 -->

						<!-- PANTALLA 14 -->
						<div id="step-form-anim-14">
							<h2 class="title-viajes">Datos tomador</h2>
							<p class="mb-0">Introduce la información de la empresa tomadora</p>

							<div class="text-start franja franja-forms-multstp">	
								<div class="card-forms">
									<div class="row g-4">

										<div class="col-12 col-md-6">
											<label for="razon_social" class="form-label">Razón social</label>
											<input type="text" class="form-control name-vrf insulead-razon-social" name="razon_social" maxlength="100" placeholder="Ejemplo: Compañía S.A" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="identificador" class="form-label">CIF</label>
											<input type="text" class="form-control cif-vrf insulead-identificacion" name="identificador" id="identificador" placeholder="Ejemplo: 12345678X" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="fecha_constitucion_empresa" class="form-label">Fecha de constitución</label>
											<input type="text" class="form-control" name="fecha_constitucion_empresa" id="fecha_constitucion_empresa" placeholder="Selecciona una fecha" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="codigo_postal" class="form-label">Código Postal</label>
											<input type="number" class="form-control codigo_postal_vrf insulead-codigo-postal" name="codigo_postal" id="codigo_postal" placeholder="Ejemplo: 28001" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="provincia" class="form-label">Provincia</label>
											<select name="provincia" id="provincia" class="select2 form-control provincia_vrf insulead-provincia" required>
												<option selected disabled value="">Selecciona tu provincia</option>
												<option value="01">Álava</option>
												<option value="02">Albacete</option>
												<option value="03">Alicante</option>
												<option value="04">Almería</option>
												<option value="33">Asturias</option>
												<option value="05">Ávila</option>
												<option value="06">Badajoz</option>
												<option value="08">Barcelona</option>
												<option value="09">Burgos</option>
												<option value="10">Cáceres</option>
												<option value="11">Cádiz</option>
												<option value="39">Cantabria</option>
												<option value="12">Castellón</option>
												<option value="13">Ciudad Real</option>
												<option value="14">Córdoba</option>
												<option value="16">Cuenca</option>
												<option value="17">Gerona</option>
												<option value="18">Granada</option>
												<option value="19">Guadalajara</option>
												<option value="20">Guipúzcoa</option>
												<option value="21">Huelva</option>
												<option value="22">Huesca</option>
												<option value="07">Islas Balears</option>
												<option value="23">Jaén</option>
												<option value="15">La Coruña</option>
												<option value="26">La Rioja</option>
												<option value="35">Las Palmas</option>
												<option value="24">León</option>
												<option value="25">Lérida</option>
												<option value="27">Lugo</option>
												<option value="28">Madrid</option>
												<option value="29">Málaga</option>
												<option value="30">Murcia</option>
												<option value="31">Navarra</option>
												<option value="32">Orense</option>
												<option value="34">Palencia</option>
												<option value="36">Pontevedra</option>
												<option value="37">Salamanca</option>
												<option value="38">Santa Cruz de Tenerife</option>
												<option value="40">Segovia</option>
												<option value="41">Sevilla</option>
												<option value="42">Soria</option>
												<option value="43">Tarragona</option>
												<option value="44">Teruel</option>
												<option value="45">Toledo</option>
												<option value="46">Valencia</option>
												<option value="47">Valladolid</option>
												<option value="48">Vizcaya</option>
												<option value="49">Zamora</option>
												<option value="50">Zaragoza</option>
											</select>
										</div>

										<div class="col-12 col-md-6">
											<label for="poblacion" class="form-label">Localidad</label>
											<input type="text" class="form-control insulead-poblacion" name="poblacion" id="poblacion" maxlength="100" placeholder="Ejemplo: Madrid" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="dirección" class="form-label">Dirección</label>
											<input type="text" class="form-control insulead-direccion" name="dirección" id="dirección" maxlength="100" placeholder="Ejemplo: Calle Gran Vía 22 - 2º B" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="facturacion_data" class="form-label">Facturación total incluídas sus Filiales en el último año</label>
											<input type="number" class="form-control" name="facturacion_data" id="facturacion_data" placeholder="Ejemplo: 500000" required>
										</div>

									</div>
								</div>

								<div class="d-flex box-next-step-asg justify-content-center"> 
									<div class="btn btn-primary btn-next-form btn-next-paso-asg">Siguiente paso</div>
								</div>
							</div>
						</div>
						<!-- FIN PANTALLA 14 -->

						<!-- PANTALLA 15 -->
						<div id="step-form-anim-15">
							<h2 class="title-viajes">Representante legal</h2>
							<div class="text-start franja franja-forms-multstp">	
								<div class="card-forms">

									<div class="row g-4">

										<div class="col-12 col-md-6">
											<label for="cargo_repre" class="form-label">Cargo</label>
											<input type="text" class="form-control" name="cargo_repre" maxlength="100" placeholder="Ejemplo: CEO" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="nombre_repre" class="form-label">Nombre</label>
											<input type="text" class="form-control name-vrf insulead-nombre" name="nombre_repre" maxlength="100" placeholder="Ejemplo: Juan" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="apellido_1_repre" class="form-label">Primer apellido</label>
											<input type="text" class="form-control apellidos-vrf insulead-apellidos" name="apellido_1_repre" maxlength="150" placeholder="Ejemplo: Pérez" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="apellido_2_repre" class="form-label">Segundo apellido</label>
											<input type="text" class="form-control apellidos-vrf insulead-apellidos" name="apellido_2_repre" maxlength="150" placeholder="Ejemplo: López" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="identificador_repre" class="form-label">NIF/NIE</label>
											<input type="text" class="form-control identificador-vrf" name="identificador_repre" id="identificador_repre" placeholder="Ejemplo: 12345678X" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="email_repre" class="form-label">Email</label>
											<input type="email" class="form-control email-vrf" name="email_repre" id="email_repre" placeholder="Ejemplo: mail@gmail.com" required>
										</div>

										<div class="col-12 col-md-6">
											<label for="telefono_repre" class="form-label">Teléfono Móvil</label>
											<input type="tel" class="form-control telefono-vrf" name="telefono_repre" id="telefono_repre" placeholder="Ejemplo: 655 123 456" required>
										</div>
										
									</div>
								</div>

								<div class="d-flex box-next-step-asg justify-content-center"> 
									<div class="btn btn-primary btn-next-form btn-next-paso-asg" id="regist-lead-step">Siguiente paso</div>
								</div>

							</div>
						</div>
						<!-- FIN PANTALLA 15 -->

						<!-- PANTALLA 16 -->
						<div id="step-form-anim-16">
							<h2 class="title-viajes">Fecha efecto seguro</h2>

							<div class="text-start franja franja-forms-multstp">	
								<div class="card-forms">					
									<div class="row g-4 d-flex justify-content-center">
									    <div class="col-12 col-md-6">
											<label for="fecha_efecto_solicitada" class="form-label"></label>
											<input type="text" class="form-control" name="fecha_efecto_solicitada" id="fecha_efecto_solicitada" placeholder="Selecciona una fecha" required>
										</div>

									</div>

								</div>

								<div class="d-flex box-next-step-asg justify-content-center"> 
									<div class="btn btn-primary btn-next-form btn-next-paso-asg" id="sg-paso-5">Siguiente paso</div>
								</div>

							</div>	
						</div>
						<!-- FIN PANTALLA 16 -->

						<!-- PANTALLA 17 -->
						<div id="step-form-anim-17">
							<h2 class="title-viajes">Datos de pago de tu seguro</h2>
							<div class="text-start franja franja-forms-multstp">	
								<div class="card-forms">

									<div class="row g-4">
										<div class="col-12 mb-4">
											<label for="cuenta_banc_data" class="form-label">IBAN</label>
											<input type="text" class="form-control iban-vrf" name="cuenta_banc_data" id="iban"  placeholder="Ejemplo: ES21 1465 0100 72 2030876293" required>
										</div>	

										<div class="col-12 form-check form-switch">
											<input type="checkbox" id="suscripcion_cond" class="form-check-input" name="suscripcion_cond" checked>
									    	<label for="suscripcion_cond">He leído y acepto la Información Precontractual y el Contrato del Seguro (incluidas las cláusulas limitativas destacadas en negrita), los Términos y Condiciones de Contratación a Distancia y la Política de Privacidad</label><br><br>
										</div>

										<div class="col-12 form-check form-switch">
											<input type="checkbox" id="declaracion_datos" class="form-check-input" name="declaracion_datos" checked>
									    	<label for="declaracion_datos">Declaras que son exactos los datos que has facilitado, siendo responsable de las inexactitudes de los mismos, de acuerdo con el artículo 10 de la Ley de Contrato de Seguro, estando obligado a comunicar a la Entidad Aseguradora cualquier variación que se produzca durante la vigencia del seguro.</label><br><br>
										</div>

										<div class="col-12 form-check form-switch">
											<input type="checkbox" id="suscripcion_pub" class="form-check-input" name="suscripcion_pub" checked>
									    	<label for="suscripcion_pub">Acepto el envío de publicidad incluso por medios electrónicos, una vez terminada la relación contractual.</label><br><br>
										</div>
									</div>
								</div>

								<div class="d-flex box-next-step-asg justify-content-center"> 
									<div id="sg-paso-17" class="btn btn-primary btn-rosa disabled">Finalizar la contratación</div>
								</div>

							</div>
						</div>
						<!-- FIN PANTALLA 17 -->

					</form>
					<!-- FIN FORM -->

					<div class="mult-mini-footer">
						<?php 
							//Footer viajes
							require(SDOPZ_PLUGIN_PATH . 'parts/mini-footer.php');
						 ?>
					</div>

			</div>
			<!-- FIN container-mini-tarif-viajes -->

		</div>
		<!-- FIN BLOQUE IZQUIERDO -->


		<div class="box-aside-multistp d-none">
			<?php 
				require( SDOPZ_PLUGIN_PATH . 'parts/aside.php' ) ;
			?>
		</div>

<?php 
	get_footer();