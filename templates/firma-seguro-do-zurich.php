<?php 

get_header(); 

?>

<div id="primary" class="content-area viajes-inter">
    <main id="main" class="site-main product-temp" role="main">

        <div class="container-mini-tarif-viajes">

            <!-- Formulario -->
            <form action="#" method="POST" class="form-validado multistep-asg">

                <img class="img-sgviajes thabnks-step" src="<?= AC_PLUGIN_URL."/img/firma.svg"; ?>">


                <h2 class="title-viajes"><?php _e('Te hemos enviado un SMS a tu móvil.', 'seguro-do-markel'); ?></h2> 

                <div class="card-forms">
                    
                    <p><?php _e('¡Estás solo a un paso de finalizar la contratación de tu seguro! Hemos enviado un <b>sms y un correo electrónico</b> para que <b>firmes tu póliza digitalmente.</b> Esperaremos a que lo hagas para poder finalizar el proceso.', 'seguro-do-markel'); ?></p>

                    <p><?php _e('Tan solo <b>te llevará 2 minutos</b>, y tras la firma, tendrás tu póliza confirmada.', 'seguro-do-markel'); ?></p>
                    
                    <img class="img-animada-reloj mb-4" src="<?= AC_PLUGIN_URL; ?>/img/loader.svg" alt="Tan sólo unos segundos." width="100px;">

                    <p class="alert alert-danger"><?php _e('Una vez firmes el documento, esta página se recargará de manera automática.', 'seguro-do-markel'); ?></p>
                </div>  

            </form>
        </div>

            

        <?php 
        // Footer viajes
        require(SDOPZ_PLUGIN_PATH . 'parts/mini-footer.php');
        get_footer();
    
