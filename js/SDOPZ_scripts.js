$ = jQuery.noConflict();


// Verificar si es un dispositivo móvil con tamaño de pantalla menor a 1024 px
function SDOPZ_esDispositivoMovil() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && window.innerWidth < 1024;
}

function convertirFormatoFecha(fecha) {
    const partesFecha = fecha.split('-');
    // Asegura que se devuelva en formato yyyy-mm-dd
    return partesFecha[2] + '-' + partesFecha[1] + '-' + partesFecha[0];
}


//Contador para que la verificación de firma no funcione indefinidamente
let contadorVerificacionesFirma = 0;

function SDOPZ_verificarEstadoTransaccion(request_id, signature_id, signatory_id, razon_social) {

    if (contadorVerificacionesFirma < 150) {
        contadorVerificacionesFirma++;
        //Obtengo datos del form
        let formData = new FormData();
        //seteo accion de wordpress
        formData.append("action", "SDOPZ_verifica_status_proc_firma");
        formData.append("request_id", request_id);
        formData.append("signature_id", signature_id);
        formData.append("signatory_id", signatory_id);
        formData.append("razon_social", razon_social);


        $.ajax({
            url: miAjax.ajaxurl, // WordPress AJAX handler URL
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
                const { data } = response;

                if (response.success) {
                    const { status } = data;
                    if (!status) {
                        setTimeout(() => {

                            SDOPZ_verificarEstadoTransaccion(request_id, signature_id, signatory_id, razon_social)
                        }, 2000);
                    } else {
                        let codigoint = parseInt(status);
                        if (codigoint >= 101 && codigoint != 900) {
                            contadorVerificacionesFirma = 0;

                            Swal.fire({
                                title: 'Error!',
                                text: 'Se genero un error 1 desconocido para terminar de contratar tu seguro.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {

                            const policy_data_sdopz = sessionStorage.getItem('policy_data_sdopz');
                            insu_registrar_contract(policy_data_sdopz,signature_id);
                            window.location.href = `/agradecimiento-seguro-sdopz`
                        }
                    }

                } else {
                    contadorVerificacionesFirma = 0;

                    Swal.fire({
                        title: 'Error!',
                        text: 'Se genero un error 2 desconocido para terminar de contratar tu seguro.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr, status, error) {
                contadorVerificacionesFirma = 0;

                Swal.fire({
                    title: 'Error!',
                    text: 'Se genero un error 3 desconocido para terminar de contratar tu seguro.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    } else {
        contadorVerificacionesFirma = 0;
        Swal.fire({
            title: 'Error!',
            text: 'Has agotado el tiempo de espera para la firma del documento.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}



function collectFormData() {
    try {

        const form = document.getElementById('form-contract-do');

        //Aquí añadimos cualquier tipo de data que no esté en el form como por ejemplo sessionStorage
        const data = {};

        // Recorremos todos los elementos del formulario
        for (let element of form.elements) {
            if (element instanceof Node) {

                // Para inputs de tipo radio, solo recogemos el seleccionado
                if (element.type === 'radio' && !element.checked) {
                    continue;
                }

                if (element.type === 'checkbox') {
                    data[element.name] = element.checked;
                    continue;
                }    

                // Añadimos el valor al objeto de datos
                data[element.name] = element.value;
            }
        }

        return data;

    } catch (error) {
        console.log(error);
        return null;
    }
}


// Función para el funcionamiento de las pantalls en el formulario
function updateClassesOnStep(steps) {

    var currentStep = $('div[id^="step-form-anim-"]:visible').attr('id');
    var currentStepNumber = parseInt(currentStep.replace('step-form-anim-', ''));

    if (steps.includes(currentStepNumber)) {
        $('.bloque-sin-left').addClass('principal-left');
        $('.box-aside-multistp').addClass('d-block');
        $('.box-aside-multistp').removeClass('d-none');
    } else {
        $('.bloque-sin-left').removeClass('principal-left');
        $('.box-aside-multistp').addClass('d-none');
        $('.box-aside-multistp').removeClass('d-block');
    }
}


/************** VALIDACIÓN DE FORMULARIOS *************/
// Función para validar todos los campos
function validarCamposEnDiv(div) {
    // Configuración global de jQuery Validate
    $.extend($.validator.messages, {
        required: "Este campo es obligatorio",
        email: "Introduce un correo electrónico válido",
        number: "Introduce un número válido",
        maxlength: $.validator.format("No más de {0} caracteres"),
        minlength: $.validator.format("Introduce al menos {0} caracteres"),
        rangelength: $.validator.format("Introduce un valor entre {0} y {1} caracteres"),
        range: $.validator.format("Introduce un valor entre {0} y {1}"),
        max: $.validator.format("Introduce un valor menor o igual a {0}"),
        min: $.validator.format("Introduce un valor mayor o igual a {0}")
    });

    // Obtener el formulario que contiene el div
    var form = $(div).closest("form");

    // Inicializar jQuery Validate sobre el formulario
    form.validate({
        rules: {
            razon_social: {
                required: true,
                maxlength: 125
            },
            name: {
                required: true,
                maxlength: 100
            },
            apellidos: {
                required: true,
                maxlength: 150
            },
            codigo_postal: {
                required: true,
                validCodigoPostal: true
            },
            provincia: {
                selectRequired: true
            },
            direccion: {
                required: true,
                maxlength: 200
            },
            poblacion: {
                required: true,
                maxlength: 100
            },
            identificador: {
                required: true,
                validIdentificador: true
            },
            email: {
                required: true,
                email: true
            },
            telefono: {
                required: true,
                validTelefono: true
            },
            profesion: {
                required: true
            },
            enf_grave_desctip: {
                required: true
            },
            iban: {
                required: true,
                validIBAN: true
            },
            password: {
                required: true
            },
            numeroAsegurados: {
                required: true,
                min: 1,
                max: 10
            },
            fecha_nacimiento: {
                required: true
            },
            sector_empresa: {
                selectRequired: true
            }
        },
        messages: {
            razon_social: {
                required: "Completa este campo",
                maxlength: "No más de 125 caracteres"
            },
            name: {
                required: "Completa este campo",
                maxlength: "No más de 100 caracteres"
            },
            apellidos: {
                required: "Completa este campo",
                maxlength: "No más de 150 caracteres"
            },
            codigo_postal: {
                required: "Completa este campo",
                validCodigoPostal: "Introduce un Código Postal válido"
            },
            provincia: {
                selectRequired: "Selecciona una opción"
            },
            sector_empresa: {
                selectRequired: "Selecciona una opción"
            },
            direccion: {
                required: "Completa este campo",
                maxlength: "No más de 200 caracteres"
            },
            poblacion: {
                required: "Completa este campo",
                maxlength: "No más de 100 caracteres"
            },
            identificador: {
                required: "Completa este campo",
                validIdentificador: "Introduce un DNI, NIE o CIF válido"
            },
            email: {
                required: "Completa este campo",
                email: "Introduce un email válido"
            },
            telefono: {
                required: "Completa este campo",
                validTelefono: "Introduce un número de teléfono móvil válido"
            },
            profesion: {
                required: "Completa este campo"
            },
            enf_grave_desctip: {
                required: "Completa este campo"
            },
            iban: {
                required: "Completa este campo",
                validIBAN: "Introduce un IBAN válido"
            },
            password: {
                required: "Completa este campo"
            },
            numeroAsegurados: {
                required: "Completa este campo",
                min: "Mínimo 1 asegurado",
                max: "Máximo 10 asegurados"
            },
            fecha_nacimiento: {
                required: "Completa este campo"
            }
        },
        errorPlacement: function (error, element) {
            if (element.hasClass('select2-hidden-accessible')) {
                error.insertAfter(element.next('.select2-container'));
            } else if (element.is(":radio") || element.is(":checkbox")) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    // Validar solo los campos dentro del div
    var campos = $(div).find("input, textarea, select");
    var esValido = true;

    campos.each(function () {
        if (!$(this).valid()) {
            esValido = false;
        }
    });

    return esValido;
}



/************ FUNCIONES PROPIAS DEL PLUGIN ******************/
function removeVariaciones() {
    $('.valores-rango-indemnizacion .val-range').show();
    $('#lista-values-indemn').removeClass('cuatro_lements cinco_lements tres_lements');
    $('#indemnizacion_slider').attr('max', '6');
}


// Calcula el precio del RC en función de la facturación y la cobertura de indemnización
function SDOPZ_obtenerPrecio(facturacion, limiteIndemnizacion) {
    // Tabla de primas actualizada:
    // - facturación 1 → Hasta 5 M (columna 1)
    // - facturación 2 → 5–10 M (columna 2)
    // - facturación 3 → 10–15 M (columna 2)
    // - facturación 4 → 15–30 M (columna 3)
    // - facturación 5 → 30–50 M (columna 4)
    // - facturación 6 → > 50 M (columna 4)
    const tabla = {
        1: {1: 362, 2: 567, 3: 693, 4: 872, 5: 1050, 6: 1313},
        2: {1: 441, 2: 683, 3: 819, 4: 1029, 5: 1208, 6: 1533},
        3: {1: 441, 2: 683, 3: 819, 4: 1029, 5: 1208, 6: 1533},
        4: {1: 509, 2: 788, 3: 977, 4: 1313, 5: 1575, 6: 1964},
        5: {1: 646, 2: 956, 3: 1260, 4: 1554, 5: 1733, 6: 2142},
        6: {1: 646, 2: 956, 3: 1260, 4: 1554, 5: 1733, 6: 2142}
    };

    const fila = tabla[facturacion];
    if (!fila) return "-";
    const precio = fila[limiteIndemnizacion];
    return (precio != null ? precio : "-");
}


// Calcula la diferencia de precio de cada nivel de indemnización respecto al seleccionado
function obtenerDiffPrecio(facturacion, indemnizacion) {
    const tabla = {
        1: {1: 362, 2: 567, 3: 693, 4: 872, 5: 1050, 6: 1313},
        2: {1: 441, 2: 683, 3: 819, 4: 1029, 5: 1208, 6: 1533},
        3: {1: 441, 2: 683, 3: 819, 4: 1029, 5: 1208, 6: 1533},
        4: {1: 509, 2: 788, 3: 977, 4: 1313, 5: 1575, 6: 1964},
        5: {1: 646, 2: 956, 3: 1260, 4: 1554, 5: 1733, 6: 2142},
        6: {1: 646, 2: 956, 3: 1260, 4: 1554, 5: 1733, 6: 2142}
    };

    const fila = tabla[facturacion] || {};
    const precioSel = fila[indemnizacion];
    const diffs = [];

    for (let i = 1; i <= 6; i++) {
        if (fila[i] == null) {
            diffs.push("-");
        } else if (i === indemnizacion) {
            diffs.push(0);
        } else {
            diffs.push(fila[i] - precioSel);
        }
    }
    return diffs;
}


// Etiquetas para el slider de facturación (1–6)
function SDOPZ_valor_facturacion(valor) {
    switch (valor) {
        case '1': return "Hasta 5.000.000 €";
        case '2': return "Entre 5.000.001 € y 10.000.000 €";
        case '3': return "Entre 10.000.001 € y 15.000.000 €";
        case '4': return "Entre 15.000.001 € y 30.000.000 €";
        case '5': return "Entre 30.000.001 € y 50.000.000 €";
        case '6': return "Más de 50.000.000 €";
        default:  return "Valor no definido";
    }
}


// Etiquetas para el slider de indemnización (1–6)
function SDOPZ_valor_indemnizacion(valor) {
    switch (valor) {
        case '1': return "400.000 €";
        case '2': return "800.000 €";
        case '3': return "1.200.000 €";
        case '4': return "1.600.000 €";
        case '5': return "2.000.000 €";
        case '6': return "3.000.000 €";
        default:  return "Valor no definido";
    }
}


function actualizaPrecioPolizaRC(valorIndem, facturacion_anual) {
    let precioPoliza = SDOPZ_obtenerPrecio(facturacion_anual, valorIndem)

    $('#coste_seguro').html(precioPoliza)
    $('#resp-incid-1').html(SDOPZ_valor_facturacion(facturacion_anual))
    $('.validngm').html(SDOPZ_valor_indemnizacion(valorIndem))
    $('#indemnizacion_value_rc').text(SDOPZ_valor_indemnizacion(valorIndem))

    $('#facturacion_anual').val(facturacion_anual)
    $('#facturacion_slider').val(facturacion_anual)

    $('#limite_indemnizacion').val(valorIndem)
    $('#indemnizacion_slider').val(valorIndem)

    $('#precio_poliza_do').val(precioPoliza)
}


// Función para actualizar los valores adicionales
function actualizarValoresAdicionales() {
    // Verificar si el ancho de la ventana es mayor que 768 píxeles (puedes ajustar este valor)
    if ($(window).width() > 768) {
        let facturacion = $('#facturacion_slider').val();
        let indemnizacion = $('#indemnizacion_slider').val();

        $('.valores-rango-indemnizacion .val-range').each(function (index) {
            // Calcula el precio para cada valor de indemnización basado en la facturación actual
            let precios = obtenerDiffPrecio(facturacion, indemnizacion);
            // Obtén el valor absoluto del precio[index]
            let valorAbsoluto = Math.abs(precios[index]);
            // Determina si mostrar el símbolo '+' o '-'
            let simbolo = (precios[index] >= 0) ? "+" : "-";
            // Actualiza el texto de los valores adicionales
            $(this).find('.sum-adic').text("(" + simbolo + valorAbsoluto + " €)");
        });
    }
}

function scrollToTop() {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
}


$(document).ready(function () {


    //Ocultamos el loader
    $('#loader-simple').attr('style', 'display: none !important;');

    //Subir arriba la página
    scrollToTop()


    //Mostramos un mensaje indicando que se realizarán múltiples preguntas pero que durará poco
    $('#show-steps-advice').click(function(event) {
        Swal.fire({
            title: 'Importante',
            text: 'A continuación deberás responder a varias preguntas para poder contratar tu seguro. No tardarás más de 2 minutos.',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    });


    // Si estamos en la página que se realiza la firma de la plantilla
    // Establecemos la página actual para condicionales
    let path = window.location.pathname;
    let page = path.replaceAll('/', '');
    let url_producto = miAjax.url_producto;

    if (page === 'firma-seguro-do-sdopz') {
        let request_id = sessionStorage.getItem('request_id');
        let signature_id = sessionStorage.getItem('signature_id');
        let signatory_id = sessionStorage.getItem('signatory_id');
        let razon_social = sessionStorage.getItem('razon_social');

        if (!request_id || !signature_id || !signatory_id) {
            Swal.fire({
                title: 'Información faltante',
                text: 'Por favor, vuelve a completar tu solicitud, o si lo prefieres, contacta con nosotros vía telefónica, a través del correo electrónico o directamente a través de nuestro formulario de contacto.',
                icon: 'warning',
                confirmButtonText: 'De acuerdo'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url_producto;
                }
            });
        } else {
            SDOPZ_verificarEstadoTransaccion(request_id, signature_id, signatory_id, razon_social);
        }
    }

    if (page === 'agradecimiento-seguro-sdopz') {

        let email_asegurado = sessionStorage.getItem('email');
        let link_poliza_firmada = sessionStorage.getItem('url_poliza');
        let request_id = sessionStorage.getItem('request_id');
        let signature_id = sessionStorage.getItem('signature_id');
        let signatory_id = sessionStorage.getItem('signatory_id');
        let razon_social = sessionStorage.getItem('razon_social');
        let name_asegurado = sessionStorage.getItem('name_asegurado');

        // Comprobar si ya existe el sessionStorage 'envioadoMailDO'
        let envioadoMailDO = sessionStorage.getItem('envioadoMailDO');

        if (!envioadoMailDO) {
            // Si no existe, ejecutamos el AJAX
            $.ajax({
                url: miAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'SDOPZ_enviar_correo_poliza_cliente',
                    email_asegurado: email_asegurado
                },
                timeout: 5000,
                success: function (response) {
                    if (response.success) {
                        // Segunda solicitud AJAX para programar el correo a la compañía
                        $.ajax({
                            url: miAjax.ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'SDOPZ_enviar_correo_poliza_compania',
                                email_asegurado: email_asegurado,
                                link_poliza: link_poliza_firmada,
                                request_id: request_id,
                                signature_id: signature_id,
                                signatory_id: signatory_id,
                                name_asegurado
                            },
                            timeout: 15000,
                            success: function (response2) {
                                if (response2.success) {                           
                                    // Registrar el sessionStorage 'envioadoMailDO' con 1 minuto de vida
                                    sessionStorage.setItem('envioadoMailDO', 'true');
                                    setTimeout(function () {
                                        sessionStorage.removeItem('envioadoMailDO');
                                    }, 70000); // 60000ms = 1 minuto
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'No se pudo programar el envío del correo a la compañía. Por favor, ponte en contacto con nosotros.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Error en la solicitud para programar el envío del correo a la compañía. Por favor, ponte en contacto con nosotros.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se pudo enviar el correo al cliente. Por favor, ponte en contacto con nosotros.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error en la solicitud para enviar el correo al cliente. Por favor, ponte en contacto con nosotros.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function () {
                    $('#enviarCorreoBtn').prop('disabled', false); // Re-enable the button
                }
            });
        } 

    }



    //Si existe pantallad de un solo precio la definimos aquí
    let pantallaPrecio = "";

    if (pantallaPrecio) {
        const stepFormAnim = $('#step-form-anim-' + pantallaPrecio);

        if (stepFormAnim.length > 0 && stepFormAnim.css('display') !== 'none') {
            $('body').addClass('fondo-body-verde');
        } else {
            $('body').removeClass('fondo-body-verde');
        }
    }

    function isValidIban(iban) {
        // Elimina los espacios en blanco
        iban = iban.replace(/\s+/g, '');

        // Expresión regular básica para validar el formato del IBAN
        const ibanPattern = /^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/;

        if (!ibanPattern.test(iban)) {
            return false; // Formato inválido
        }

        return true; // El IBAN es válido
    }



    //FUNCIONALIDAD DEL PASO FINAL DEL FORMULARIO
    const sgPasoAct = $('#sg-paso-17');

    function toggleButtonFinalStep() {
        var isCondChecked = $('#suscripcion_cond').is(':checked');
        var isDatosChecked = $('#declaracion_datos').is(':checked');
        var iban = $('#iban').val();
        var hasInvalidFields = iban === '' || !isValidIban(iban);

        if (isCondChecked && isDatosChecked && !hasInvalidFields) {
            sgPasoAct.addClass('btn-next-form btn-next-paso-asg').removeClass('disabled');
        } else {
            sgPasoAct.removeClass('btn-next-form btn-next-paso-asg').addClass('disabled');
        }
    }


    // Añadir el evento click para mostrar SweetAlert si el botón está deshabilitado
    sgPasoAct.on('click', function (e) {

        var isDisabled = sgPasoAct.prop('disabled'); // Verificar si el botón tiene el atributo disabled

        var isDisabled = sgPasoAct.hasClass('disabled');
        var iban = $('#iban').val();
        var hasInvalidFields = iban === '' || !isValidIban(iban);

        if (isDisabled || hasInvalidFields) {
            e.preventDefault(); // Prevenir la acción por defecto del botón si está deshabilitado
            Swal.fire({
                title: '',
                text: hasInvalidFields ? 'Por favor, complete todos los campos correctamente.' : 'Por favor, acepta los términos y condiciones junto con la conformidad de la información para continuar.',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        } else {
            let dataForm = collectFormData();
            insu_patch_lead(dataForm.suscripcion_pub);

            // Muestra el loader
            $('#loader-simple').show();

            // Ejecuta el AJAX
            $.ajax({
                url: miAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'SDOPZ_procesar_poliza',
                    ...dataForm
                },
                success: function (response) {
                    if (response.success) {

                        // Guardar información de respuesta_firma en sessionStorage
                        const respuestaFirma = response.data.respuesta.firmaResponse;

                        sessionStorage.setItem('request_id', respuestaFirma.request_id);
                        sessionStorage.setItem('signature_id', respuestaFirma.signature_id);
                        sessionStorage.setItem('signatory_id', respuestaFirma.signatory_id);

                        sessionStorage.setItem('url_poliza', response.data.respuesta.url_proyecto);

                        // Data usuario
                        sessionStorage.setItem('razon_social', dataForm.razon_social);
                        sessionStorage.setItem('email', dataForm.email_repre);//
                        sessionStorage.setItem('name_asegurado', dataForm.nombre_repre);
                        insu_registrar_proyecto(response.data.respuesta.url_proyecto);

                        sessionStorage.setItem('policy_data_sdopz', JSON.stringify(dataForm));


                        // Redirigir a otra página
                        window.location.href = '/firma-seguro-do-sdopz/';

                    } else {
                        // Mostrar sweet alert
                        console.log('Ha fallado');
                    }
                },
                error: function (err) {
                    console.log(err);
                },
                complete: function () {
                    // Oculta el loader cuando la solicitud AJAX ha terminado
                    $('#loader-simple').hide();
                }
            });
        }
    });

    // Vincular el cambio del checkbox y validación de campos a la función de toggle
    $('#suscripcion_cond, #declaracion_datos').on('change', toggleButtonFinalStep);
    $('#iban').on('input change', toggleButtonFinalStep);




    /********* FUNCIONAMIENTO DE LAS PANTALLAS DEL FORMULARIO  *****/
    //Definimos las pantallas con aside
    let pantallasConAside = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];


    // Inicialmente, mostrar solo el primer paso y ocultar los botones de volver si estamos en el primer paso
    $('div[id^="step-form-anim-"]').hide();
    $('#step-form-anim-1').show();
    $('.link-paso-atras').hide();


    // Inicialmente, mostrar solo el primer paso y ocultar los botones de volver si estamos en el primer paso
    $('div[id^="step-form-anim-"]').hide();
    $('#step-form-anim-1').show();
    $('.link-paso-atras').hide();


    // Función para determinar el siguiente paso basado en las respuestas
    function getNextStep(currentStep) {
        let nextStep = currentStep.next('div[id^="step-form-anim-"]');

        /******** AQUÍ SE INTRODUCEN LAS CONDICIONES BAJO LAS CUALES SE SALTAN PANTALLAS ***********/
        // if (currentStep.is('#step-form-anim-5') && $('input[name="sufrido-ciberataque"]:checked').val() == '0') {
        //     return $('#step-form-anim-7');
        // }

        // Añadir más condiciones aquí según sea necesario...
        return nextStep;
    }

    // Función para determinar el paso anterior basado en el historial
    function getPreviousStep() {
        return $('#' + stepHistory.pop());
    }

    // Variable para guardar el historial de pasos
    let stepHistory = [];


    // Manejar el botón de siguiente
    $('.btn-next-form').click(async function (event) {
        event.preventDefault();

        // Verificar si el botón tiene la clase btn-rosa
        if ($(this).hasClass('btn-rosa')) {
            return; // Salir si tiene la clase btn-rosa
        }

        var currentStep = $(this).closest('div[id^="step-form-anim-"]');
        var isvalidaPantalla = validarCamposEnDiv(currentStep);
        var nextStep = await getNextStep(currentStep);

        var currentPasoLinea = $('.steps_asegura_forms.active');
        var nextStepPasoLinea = currentPasoLinea.next('.steps_asegura_forms');

        if (nextStep.length && isvalidaPantalla) {
            stepHistory.push(currentStep.attr('id')); // Guardar el paso actual en el historial

            currentStep.fadeOut(250, function () {
                nextStep.fadeIn(250);

                currentPasoLinea.removeClass('active');
                nextStepPasoLinea.addClass('active');

                updateClassesOnStep(pantallasConAside);
            });

            $('.link-paso-atras').show();

            scrollToTop();
        }
    });

    // Manejar el botón de atrás
    $('.link-paso-atras').click(function (event) {
        event.preventDefault();

        var currentStep = $('div[id^="step-form-anim-"]:visible');
        var prevStep = $('#' + stepHistory.pop()); // Obtener el paso anterior del historial

        var actualPasoLinea = $('.steps_asegura_forms.active');
        var anteriorStepPasoLinea = actualPasoLinea.prev('.steps_asegura_forms');

        if (prevStep.length) {
            currentStep.fadeOut(250, function () {
                prevStep.fadeIn(250);

                actualPasoLinea.removeClass('active');
                anteriorStepPasoLinea.addClass('active');

                updateClassesOnStep(pantallasConAside);
            });

            if (stepHistory.length === 0) {
                $('.link-paso-atras').hide();
            }
        }

        //Borramos la seleccion de tipo de ataque sufrido
        $('#tipo-ataque-sufrido').val(null).trigger('change');
    });



    // Llamar la función inicialmente si estamos en la url del formulario
    if (page == "contratacion-seguro-do-sdopz") {
        updateClassesOnStep(pantallasConAside);
    }


    //Fecha de inicio de cobertura con airdatepicker
    const today = new Date();

    const localeEs = {
        days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
        daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'],
        today: 'Hoy',
        clear: 'Cancelar',
        dateFormat: 'dd-MM-yyyy',  // Cambiar el formato de fecha aquí
        timeFormat: 'hh:ii',
        firstDay: 1
    };


    // Calcula la fecha máxima seleccionable inicio cobertura (2 meses posteriores al día actual)
    const maxDate = new Date();
    maxDate.setMonth(today.getMonth() + 2);

    // Inicializar el datepicker con la fecha de mañana
    new AirDatepicker('#fecha_efecto_solicitada', {
        dateFormat: 'dd-MM-yyyy', // Asegúrate de que este formato coincida con el formateo deseado
        isMobile: true,
        autoClose: true,
        locale: localeEs,
        startDate: today,
        minDate: today, // Establecer la fecha mínima a hoy,
        maxDate: maxDate // Fecha máxima seleccionable (2 meses posteriores)
    });


    const twoYearsAgo = new Date();
    twoYearsAgo.setFullYear(twoYearsAgo.getFullYear() - 2);

    // Inicializar AirDatepicker en el campo de constitución
    new AirDatepicker('#fecha_constitucion_empresa', {
       locale: localeEs,
       dateFormat: 'dd-MM-yyyy',
       isMobile: true,
       autoClose: true,
       maxDate: today,       // No permitir futuras a hoy
       startDate: today,     // Calendario comienza en hoy
       onSelect: function (formattedDate, date, inst) {
            let fecha_constitucion = new Date(convertirFormatoFecha($("#fecha_constitucion_empresa").val()));

            if (fecha_constitucion > twoYearsAgo) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Antigüedad insuficiente',
                    text: 'La empresa debe tener al menos dos años de antigüedad para contratar este seguro.'
                }).then(() => {
                    // limpia el campo y el picker
                    $('#fecha_constitucion_empresa').val('');
                    // Mostrar el modal de contacto
                    $('#ModalLlamarLateral').modal('show');
                    // Cerrar SweetAlert
                    Swal.close();
                });
            }
        }
    });


    // Captura el evento change en todos los radios con valor "si"
   $('input[type=radio][value="si"]').on('change', function() {
      var $siRadio = $(this);
      if ($siRadio.is(':checked')) {
         var name = $siRadio.attr('name');

         Swal.fire({
            icon: 'warning',
            title: 'No cumples con los requisitos',
            text: 'En ese caso, no podemos ofrecerte una solución online. Por favor, solicita que te contactemos en el siguiente formulario.'
         }).then(function() {
            // Marcar el "No" correspondiente
            $('input[name="' + name + '"][value="no"]').prop('checked', true);
            // Mostrar el modal de contacto
            $('#ModalLlamarLateral').modal('show');
            // Cerrar SweetAlert
            Swal.close();
         });
      }
   });



    //Registramos el lead
    $('#regist-lead-step').click(async function (event) {
        // Muestra el loader
        $('#loader-simple').show();
        await insu_registrar_lead();
        let precioSeguro = $('#coste_seguro').html()
        await insu_registrar_rate(precioSeguro)
        $('#loader-simple').attr('style', 'display: none !important;');

    });


    //Código para mostrar el aside en móvil para mostrar el desplegable con el precio y demás info:
    let isRotated = false;

    // Aseguramos que el documento esté cargado completamente antes de buscar los elementos
    // Creamos una función para ejecutar cuando se hace clic en el elemento con la clase 'show-dt'
    $('.show-dt').on('click', function () {
        // Verificamos si ya se ha realizado la rotación
        if (isRotated) {
            // Si ya está rotado, volvemos a la posición inicial
            $(this).css('transform', '');
            // Utilizamos la función animate de jQuery para crear una transición suave
            $('.aside-resumen').animate({
                'opacity': 0,
                'top': '100vh'
            }, 500, function () {
                $(this).css('display', 'none');
            });
            isRotated = false;
        } else {
            // Si no está rotado, lo rotamos 180 grados
            $(this).css('transform', 'rotate(360deg)');
            // Ajustamos la posición inicial antes de mostrar el elemento
            $('.aside-resumen').css({
                'display': 'block',
                'position': 'fixed',
                'top': '100vh',
                'left': '0',
                'opacity': 1
            });
            // Utilizamos la función animate de jQuery para crear una transición suave
            $('.aside-resumen').animate({
                'opacity': 1,
                'top': '0'
            }, 500);
            isRotated = true;
        }
    });



    // Ejecutar solo en dispositivos móviles con tamaño de pantalla menor a 1024 px
    if (SDOPZ_esDispositivoMovil()) {
        // Funcionamiento tabs movil comparativa polizass
        $('#tabItem1-tab').addClass('active');
    }

    //Ajustamos el valor del slider al valor elegido del input
    $('#indemnizacion_slider').val($('#limite_indemnizacion').val())


    //Si se modifica el importe de la indemnización se cambia el precio
    $('#indemnizacion_slider').change(function (event) {
        let valorIndem = $('#indemnizacion_slider').val();
        let facturacion_anual = $('#facturacion_anual').val()

        actualizaPrecioPolizaRC(valorIndem, facturacion_anual)
    });

    //Si se modifica el importe de la factura se cambia el precio
    $('#facturacion_slider').change(function (event) {
        let valorIndem = $('#indemnizacion_slider').val();
        let facturacion_anual = $('#facturacion_anual').val()

        actualizaPrecioPolizaRC(valorIndem, facturacion_anual)
    });


    const $rangeValue = $('#rangeValue');

    $('#customRange').change(function (event) {
        $('#rangeValue').text($('#customRange').val());
    });

    /************ FUNCIONALIDAD RANGE *********/
    jQuery('#facturacion_slider').on('input', function () {
        const value = $(this).val();
        const optionText = $('#facturacion_anual option[value=' + value + ']').text();
        jQuery('#facturacion_slider_label').text(optionText);
        jQuery('#facturacion_anual').val(value).niceSelect('update');
    });

    jQuery('#indemnizacion_slider').on('input', function () {
        const value = $(this).val();
        const optionText = $('#limite_indemnizacion option[value=' + value + ']').text();
        jQuery('#indemnizacion_slider_label').text(optionText);
        jQuery('#limite_indemnizacion').val(value).niceSelect('update');
    });


    //Iniciamos la tabla seleccionando unos valores predefinidos
    actualizaPrecioPolizaRC('3', '3');



    // Evento change para el slider de facturación
    $('#facturacion_slider').on('change', function () {

        if ($(this).val() == 6) {
            Swal.fire({
                title: 'Atención',
                text: 'Para facturaciones superiores a 50 millones, por favor póngase en contacto con nuestra oficina vía correo electrónico o teléfono.',
                icon: 'warning',
                confirmButtonText: 'Ok',
                preConfirm: function () {
                    actualizaPrecioPolizaRC('3', '3');

                    removeVariaciones()

                    $('.valores-rango-indemnizacion .val-range:last-child').hide();
                    $('#lista-values-indemn').addClass('cinco_lements');
                    $('#indemnizacion_slider').attr('max', '5');
                    $('#ModalLlamarLateral').modal('show');
                }
            });
            return; // Detiene la ejecución del código subsiguiente
        }


        actualizarValoresAdicionales();

    });

    // Evento change para el slider de indemnización
    $('#indemnizacion_slider').on('change', function () {
        let valorIndem = $(this).val();
        let facturacion_anual = $('#facturacion_anual').val();
        actualizaPrecioPolizaRC(valorIndem, facturacion_anual);

        actualizarValoresAdicionales();
    });

    // Inicializa los valores adicionales al cargar la página
    actualizarValoresAdicionales();
});


