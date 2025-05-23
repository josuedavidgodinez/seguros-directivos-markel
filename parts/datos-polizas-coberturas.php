<?php

// Variables a pasar del producto
$nombre               = ['ProLíder'];
$imagenes_polizas     = [SDOPZ_PLUGIN_URL . "/img/Treasure Check 1.svg"];
$precios              = ["<span class='desde-val'>Desde</span> 362"];
$anotaciones_precio   = ["€/año"];
$anotacion_poliza     = [""];
$url_condicionado     = "";

// Coberturas (top 20)
$coberturas = [
    [
        'titulo' => 'Responsabilidad Civil de Administradores y Altos Cargos',
        'valores' => ['Sin sublímite']
    ],
    [
        'titulo' => 'Gastos de Defensa',
        'valores' => ['Sin sublímite']
    ],
    [
        'titulo' => 'Reembolso a la Entidad',
        'valores' => ['Sin sublímite']
    ],
    [
        'titulo' => 'Fianzas civiles',
        'valores' => ['Sin sublímite']
    ],
    [
        'titulo' => 'Gastos de constitución de fianzas penales',
        'valores' => ['Sin sublímite']
    ],
    [
        'titulo' => 'Sanciones administrativas',
        'valores' => ['Máximo 300.000 €']
    ],
    [
        'titulo' => 'Gastos del aval concursal',
        'valores' => ['Máximo 400.000 €']
    ],
    [
        'titulo' => 'Gastos del aval en evitación del embargo preventivo',
        'valores' => ['Máximo 400.000 €']
    ],
    [
        'titulo' => 'Inhabilitación profesional',
        'valores' => ['Máx. 60.000 € (5.000 €/mes, 12 meses)']
    ],
    [
        'titulo' => 'Gastos de privación de bienes',
        'valores' => ['Máximo 300.000 €']
    ],
    [
        'titulo' => 'Gastos de emergencia',
        'valores' => ['Máximo 400.000 €']
    ],
    [
        'titulo' => 'Gastos de asistencia psicológica',
        'valores' => ['Máximo 120.000 €']
    ],
    [
        'titulo' => 'Gastos en materia de prevención de riesgos laborales',
        'valores' => ['Máximo 120.000 €']
    ],
    [
        'titulo' => 'Gastos de defensa de personas vinculadas',
        'valores' => ['Máximo 120.000 €']
    ],
    [
        'titulo' => 'Gastos en materia reguladora',
        'valores' => ['Máximo 120.000 €']
    ],
    [
        'titulo' => 'Deshonestidad de empleados',
        'valores' => ['Máximo 100.000 €']
    ],
    [
        'titulo' => 'Gastos de defensa por responsabilidad penal corporativa',
        'valores' => ['Máximo 300.000 €']
    ],
    [
        'titulo' => 'Gastos de defensa en reclamaciones por homicidio empresarial',
        'valores' => ['Máximo 300.000 €']
    ],
    [
        'titulo' => 'Protección de datos',
        'valores' => ['Máximo 100.000 €']
    ],
    [
        'titulo' => 'Gastos legales de un accionista por acción social de responsabilidad',
        'valores' => ['Máximo 300.000 €']
    ],
];

$class_width = count($nombre) === 2 ? 'second-width' : 'third-width';
