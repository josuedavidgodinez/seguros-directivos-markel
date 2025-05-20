// Este archivo es para todo el js relativo a la landing principal del producto
$ = jQuery.noConflict();

$(document).ready(function () {

    $('.btn_seleccion_opt_ciber_secundario').on('click', function () {

        const btnSecundario = $(this);
        let id_disparo = btnSecundario.data('disparo_id');

        $(`#${id_disparo}`).trigger('click');
    });

    $('.acc-selector').on('click', function (e) {
        e.preventDefault(); // Evita redirección inmediata por el href
        const urlDestino = $(this).data('url');
        if (urlDestino) {
            window.location.href = urlDestino;
        }
    });


});