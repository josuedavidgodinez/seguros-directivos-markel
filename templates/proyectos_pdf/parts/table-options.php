<?php

// Generar dinámicamente las filas del encabezado
$html_eleccion_polizas = "";
$tipo_poliza = 1;


for ($i = 1; $i <= 3; $i++) {
    if ($i == $tipo_poliza) {
        $html_eleccion_polizas .= "<td class='text-white text-center font-small plan-selected first'>Tu elección</td>";
    } else {
        $html_eleccion_polizas .= "<td></td>";
    }
}

// Definir los planes
$plans = [
    1 => ['name' => 'Classic', 'price' => $precio_base, 'imagen' => SDOPZ_PLUGIN_URL.'templates/proyectos_pdf/img/accidentes-icon-cobertura-1.svg']
];

// Filas y valores de la tabla con las 15 coberturas más relevantes
$rows = [
    'Coberturas D&O' => [
        [
            'text'   => 'Reembolso a la Entidad',
            'values' => [
                '<img src="' . SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png" alt="check" style="width: 14px;">'
            ]
        ],
        [
            'text'   => 'Gastos de Defensa',
            'values' => [
                '<img src="' . SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png" alt="check" style="width: 14px;">'
            ]
        ],
        [
            'text'   => 'Gastos de Representación Legal',
            'values' => [
                '<img src="' . SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png" alt="check" style="width: 14px;">'
            ]
        ],
        [
            'text'   => 'Gastos de Extradición',
            'values' => [
                '<img src="' . SDOPZ_PLUGIN_URL . 'templates/proyectos_pdf/img/check-1.png" alt="check" style="width: 14px;">'
            ]
        ],
        [
            'text'   => 'Gastos de Publicidad',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Gastos de Gerencia de Riesgos',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Sanciones Administrativas',
            'values' => ['300.000 €']
        ],
        [
            'text'   => 'Gastos del Aval Concursal',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Gastos del Aval en Evitación del Embargo Preventivo',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Inhabilitación Profesional (máx. 5.000 €/mes, 12 meses)',
            'values' => ['60.000 €']
        ],
        [
            'text'   => 'Gastos de Emergencia',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Gastos de Privación de Bienes',
            'values' => ['300.000 €']
        ],
        [
            'text'   => 'Abogados Internos',
            'values' => ['400.000 €']
        ],
        [
            'text'   => 'Gastos de Asistencia Psicológica',
            'values' => ['120.000 €']
        ],
        [
            'text'   => 'Gastos de Defensa en Prevención de Riesgos Laborales',
            'values' => ['120.000 €']
        ]
    ]
];

    
?>
<style>

    .icon-poliza{
            width: 45px;
            height: 45px;
        }
</style>

<table class="comparison-table w-100">
    <thead>
        <tr>
            <td></td>
            <?= $html_eleccion_polizas ?>
        </tr>
        <tr class="text-center">
            <th width="75%"></th>
            <?php foreach ($plans as $index => $plan): ?>
                <th width="25%" class="plan-title">
                    <img src="<?= $plan['imagen'] ?>" class="icon-poliza mb-2">
                    <br>
                    <span class="text-primary font-weight-normal"><?= $plan['name'] ?></span>
                    <br>
                    <span class="h5 font-weight-bold"><?= $plan['price'] ?> <span class="h6">€/año</span></span>
                </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $section => $entries): ?>
            <tr>
                <td class="pt-3 pb-2" colspan="4">
                    <span class="text-primary text-uppercase h5"><?= $section ?></span>
                </td>
            </tr>
            <?php foreach ($entries as $entry): ?>
                <tr>
                    <td class="pb-3"><?= $entry['text'] ?></td>
                    <?php foreach ($entry['values'] as $index => $value): ?>
                        <td class="text-center font-weight-light pb-2 <?= ($index + 1) == $tipo_poliza ? 'plan-selected' : '' ?>">
                            <?= $value ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
