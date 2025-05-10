<?php
function SDOPZ_template_generacion_proyecto(
    $telefono_asegurado,
    $email_asegurado,
    $facturacion_anual,
    $limite_indeminzacion,
    $precio_base,
    $razon_social,
    $cif_data,
    $direction_completa,
    $cp_data,
    $nombre_provincia,
    $facturacion_data,
    $forma_pago_data,
    $cuenta_banc_data,
    $anos_activ,
    $sociedades_filiales_data,
    $titulos_deduda_data,
    $seguro_filiales_data,
    $fondos_propios_sup,
    $benf_dos_anos,
    $activo_sup_pasivo,
    $patrimonio_negativo,
    $exp_regulador_data,
    $audit_filial_dta,
    $inv_autoridad_data,
    $recl_cobertura_data,
    $actividad_descript,
    $sectores_prohi_conf
){
    if($forma_pago_data='Semestral'){
        $precio_base = $precio_base/2;
    }
    // Obtener la fecha de hoy en el formato deseado
    $fecha_hoy = date("d/m/Y");

    return <<<EOF
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
                src: url('fonts/Fieldwork-Geo-Regular.ttf') format("truetype");
                font-style: normal; 
                font-weight: thin; 
            }

            @font-face { 
                font-family: 'Fieldwork'; 
                src: url('fonts/Fieldwork-GeoThin.ttf') format("truetype");
                font-style: normal; 
                font-weight: normal; 
            }

            @font-face { 
                font-family: 'Fieldwork';
                src: url('fonts/Fieldwork-Geo-Bold.ttf') format("truetype"); 
                font-style: normal;
                font-weight: bold; 
            }
            body {color:#004481; font-family: 'Fieldwork', sans-serif; font-style: normal; }
            .text-primary {color:#009696 !important;}
            .text-secondary {color:#333 !important;}
            .text-danger {color:#ff2f76 !important;}
            .border {border-color:#004481 !important}
            .border-primary {border-color:#009696 !important;}
            .border-danger {border-color:#ff2f76 !important;}

            .font-small {font-size:0.8rem;}
            .font-smaller {font-size:0.6rem ;}
            .font-weight-semibold {font-weight: 600 !important;}
            .bg-primary-transparent-1 {background: #00969610;}
            .bg-primary-transparent-2 {background: #00969620;}
            .border-width-custom-1 {border-width: 2px !important;}
            .border-width-custom-2 {border-width: 3px !important;}
            .border-semitransparent {border-color:#00969630 !important;}
        </style>
    </head>
    <body>
        <!--PÁG 1 -->
        <div class="container">
            <div class="row justify-content-center my-5 pt-5">
                <div class="col-3">
                    <img src="img/logo-3mares-1.svg" alt="Nombre Empresa Seguros">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                    <h1 class="font-weight-bold text-center mb-5">Proyecto de seguro de Accidentes</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                    <p class="text-danger mb-0 font-small">Tomador:</p>
                    <p class="text-primary font-weight-bold h5">$razon_social</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                    <img src="img/streamlinehq-solving-problem-1-product-400.svg">
                </div>
            </div>
            <div class="row justify-content-center pb-5">
                <div class="col-5 font-weight-bold text-center">
                    <p class="mb-0">$direction_completa</p>
                    <p class="mb-0"><a href="mailto:sanchezansede@sanchezansede.com" class="text-primary">sanchezansede@sanchezansede.com</a></p>
                    <p class="mb-0">981 140 166</p>
                    <p class="text-primary">$telefono_asegurado</p>
                </div>
            </div>
            <div class="row mt-5 pt-5 justify-content-center">
                <div class="col-9">
                    <p class="text-secondary font-smaller text-center">Coberturas y servicios sujetos a los términos y condiciones aplicables al seguro que elijas. Este presupuesto se ha realizado a partir de la información que nos has facilitado, incluida tu historia siniestral, y no tiene valor contractual. </p>
                </div>
            </div>
        </div>
        <!--PÁG 2 -->
        <div class="container">
            <div class="row header">
                <div class="col-9">
                    <p class="font-smaller mb-0"><span class="font-weight-bold">Proyecto del seguro</span>: $razon_social</p>
                    <p class="font-smaller mb-0"><span class="font-weight-bold">Fecha</span>: $fecha_hoy</p>
                    <p class="font-smaller mb-0"><span class="font-weight-bold">Validez del proyecto</span>: XX días</p>
                </div>
                <div class="col-3">
                    <img src="img/logo-3mares-1.svg" alt="Nombre Empresa Seguros" class="img-fluid">
                </div>
            </div>
            <div class="row my-5">
                <div class="col ml-2">
                    <h2 class="font-weight-bold h5 border border-primary rounded border-width-custom-1 py-2 px-3 mb-4 bg-primary-transparent-2">Datos mediador:</h2>
                    <div class="row m-1">
                        <div class="col-3">
                            <p class="font-weight-bold">Entidad aseguradora: </p>
                        </div>
                        <div class="col-9">
                            <p>Plus Ultra, Seguros Generales y Vida, S.A. de Seguros y Reaseguros, Sociedad Unipersonal</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Sede social:  </p>
                        </div>
                        <div class="col-9">
                            <p>Plaza de las Cortes, 8. 28014 (Madrid)</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Tipo de mediador: </p>
                        </div>
                        <div class="col-9">
                            <p>Corredor</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Nombre:  </p>
                        </div>
                        <div class="col-9">
                            <p>SANCHEZ ANSEDE,SL</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Dirección: </p>
                        </div>
                        <div class="col-9">
                            <p>RDA. Nelle, 85</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Teléfono: </p>
                        </div>
                        <div class="col-9">
                            <p>981272187</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Localidad:</p>
                        </div>
                        <div class="col-9">
                            <p>A CORUÑA</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col ml-2">
                    <h2 class="font-weight-bold h5 border border-primary rounded border-width-custom-1 py-2 px-3 mb-4 bg-primary-transparent-2">Datos del asegurado:</h2>
                    <div class="row m-1">
                        <div class="col-3">
                            <p class="font-weight-bold">Tomador: </p>
                        </div>
                        <div class="col-9">
                            <p>$razon_social</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">CIF/NIF:  </p>
                        </div>
                        <div class="col-9">
                            <p>$cif_data</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Dirección tomador: </p>
                        </div>
                        <div class="col-9">
                            <p>$direction_completa</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Actividad profesional:  </p>
                        </div>
                        <div class="col-9">
                            <p>$actividad_descript</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Teléfono: </p>
                        </div>
                        <div class="col-9">
                            <p>$telefono_asegurado</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col ml-2">
                    <h2 class="font-weight-bold h5 border border-primary rounded border-width-custom-1 py-2 px-3 mb-4 bg-primary-transparent-2">Propuesta:</h2>
                    <div class="row m-1">
                        <div class="col-3">
                            <p class="font-weight-bold">Forma de pago: </p>
                        </div>
                        <div class="col-9">
                            <p>$forma_pago_data</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Prima neta social de la póliza:  </p>
                        </div>
                        <div class="col-9">
                            <p>$precio_base €</p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Impuestos: </p>
                        </div>
                        <div class="col-9">
                            <p></p>
                        </div>
                        <div class="col-3">
                            <p class="font-weight-bold">Prima total: </p>
                        </div>
                        <div class="col-9">
                            <p class="font-weight-bold text-danger">".($precio_base)." €</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end my-5">
                <div class=" border border-primary bg-primary-transparent-1" style="border-radius: 20px 0 0 0;padding-right: 250px;">
                    <p class="font-weight-bold my-4 mx-5 h5"><span class="text-primary">Dedicamos tiempo a tu</span> <span class="text-danger">tranquilidad</span>
                </div>
            </div>
            <div class="row footer pt-3 border-top border-primary border-width-custom-2">
                <div class="col-10">
                    <p class="font-smaller mb-0 text-center">Sánchez Ansede Correduría de seguros. CIF B70347414. Inscrita en el R.M. de Coruña / Tomo 3465 / Folio 41 / Ins. 1 / Hoja c-49208 Registro D.G.S. J2995. Concertados seguros de Responsabilidad Civil y Caucion conforme a legalidad vigente</p>
                </div>
                <div class="col-2">
                    <p class="font-smaller mb-0 text-center">Página x de Y</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    EOF;
}