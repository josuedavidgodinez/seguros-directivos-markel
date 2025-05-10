<?php require_once SDOPZ_PLUGIN_PATH . 'parts/datos-polizas-coberturas.php'; ?>

<div class="text-start franja franja-forms-viajes pt-1 pb-3">
    <div class="d-flex justify-content-end align-items-start flex-wrap">

        <div class="tab-content">
            <?php foreach ($nombre as $index => $nombre_poliza): ?>
            <div class="tab-pane fade<?= $index === 0 ? ' show active' : ''; ?>" id="tabItem<?= $index + 1; ?>" role="tabpanel">
                <div class="card-viaje-option">
                    <div class="d-flex justify-content-start align-items-start justify-content-center name-price-inter">
                        <div class="text-center">
                            <div class="icono-viaje">
                                <img src="<?= $imagenes_polizas[$index]; ?>" alt="">
                            </div>
                            <div class="name-prod-viaje"><?= $nombre_poliza; ?></div>
                            <div class="price-inter" id="precio_<?= $index + 1; ?>"><?= $precios[$index]; ?> <span class="mini-moneda"><?= $anotaciones_precio[$index]; ?></span></div>
                            <a href="/contratacion-seguro-do-sdopz/" id="btn_precio_<?= $index + 1; ?>" class="btn btn-primary acc-selector">Contratar ahora</a>
                            <small class="poliza-small-advice color-azul"><?= $anotacion_poliza[$index]; ?></small>
                        </div>  
                    </div>                              
                </div>

                <h3 class="accordion-header" id="heading<?= $index + 1; ?>">
                    <button class="accordion-button no-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index + 1; ?>" aria-expanded="true" aria-controls="collapse<?= $index + 1; ?>">Coberturas más importantes</button>
                </h3>

                <div class="accordion-collapse collapse show" aria-labelledby="heading<?= $index + 1; ?>" data-bs-parent="#miAcordeon">
                    <div class="accordion-body">
                        <?php 
                            foreach ($coberturas as $cobertura) {
                                if ($cobertura['titulo']) {
                                    echo '<table class="table_cob_viajes">';
                                    echo '<tbody>';
                                    echo '<tr>';
                                    echo '<td class="text-start tam3_tab">' . $cobertura['titulo'] . '</td>';
                                    if($cobertura['titulo'] != 'Extorsión Cibernética'){
                                        echo '<td class="text-center valor_cobertura_viajes">' . $cobertura['valores'][$index] . '</td>';
                                    }else{
                                        echo '<td class="text-center"> - </td>';
                                    }
                                    echo '</tr>';
                                    echo '</tbody>';
                                    echo '</table>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>