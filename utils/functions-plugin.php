<?php 

//Función que en función de la selección de indemnización máxima devuelve el valor real
function SDOPZ_valor_indemnizacion($valor){
   switch ($valor) {
      case '1':
         return "300.000 €";
         break;
      
      case '2':
         return "600.000 €";
         break;

      case '3':
         return "1.000.000 €";
         break;

      case '4':
         return "1.500.000 €";
         break;

      case '5':
         return "2.000.000 €";
         break;

      case '6':
         return "2.000.000 €";
         break;
   }
}



//Función que en función de la selección de facturación anual devuelve el valor real
function SDOPZ_valor_facturacion($valor){
   switch ($valor) {
      case '1':
         return "Hasta 1.000.000 €";
         break;
      
      case '2':
         return "Hasta 5.000.000 €";
         break;

      case '3':
         return "Hasta 10.000.000 €";
         break;

      case '4':
         return "Hasta 30.000.000 €";
         break;

      case '5':
         return "Hasta 50.000.000 €";
         break;

      case '6':
         return "Más de 50.000.000 €";
         break;
   }
}



/**
 * Calcula el precio del RC y devuelve el nombre de la variable a marcar según la tabla.
 * @param int $facturacion Índice de facturación (1-6)
 * @param int $limiteIndemnizacion Índice de límite de indemnización (1-6)
 * @return array ['precio' => int, 'campo' => string]
 */
function SDOPZ_obtenerPrecioYCampo($facturacion, $limiteIndemnizacion) {
    // Tabla de primas
    $tabla = [
        1 => [1 => 362, 2 => 567, 3 => 693, 4 => 872, 5 => 1050, 6 => 1313],
        2 => [1 => 441, 2 => 683, 3 => 819, 4 => 1029, 5 => 1208, 6 => 1533],
        3 => [1 => 441, 2 => 683, 3 => 819, 4 => 1029, 5 => 1208, 6 => 1533],
        4 => [1 => 509, 2 => 788, 3 => 977, 4 => 1313, 5 => 1575, 6 => 1964],
        5 => [1 => 646, 2 => 956, 3 => 1260, 4 => 1554, 5 => 1733, 6 => 2142],
        6 => [1 => 646, 2 => 956, 3 => 1260, 4 => 1554, 5 => 1733, 6 => 2142]
    ];

    // Mapeo de campos para cada celda de la tabla
    $campos = [
        1 => ['x_362E', 'x_567E', 'x_693E', 'x_872E', 'x_1050E', 'x_1313aE'],
        2 => ['x_441E', 'x_683E', 'x_819E', 'x_1029E', 'x_1208E', 'x_1533E'],
        3 => ['x_441E', 'x_683E', 'x_819E', 'x_1029E', 'x_1208E', 'x_1533E'],
        4 => ['x_509E', 'x_788E', 'x_977E', 'x_1313bE', 'x_1575E', 'x_1964E'],
        5 => ['x_646E', 'x_956E', 'x_1260E', 'x_1554E', 'x_1733E', 'x_2142E'],
        6 => ['x_646E', 'x_956E', 'x_1260E', 'x_1554E', 'x_1733E', 'x_2142E']
    ];

    if (
        isset($tabla[$facturacion][$limiteIndemnizacion]) &&
        isset($campos[$facturacion][$limiteIndemnizacion - 1])
    ) {
        return [
            'precio' => $tabla[$facturacion][$limiteIndemnizacion],
            'campo'  => $campos[$facturacion][$limiteIndemnizacion - 1]
        ];
    }

    return [
        'precio' => null,
        'campo'  => null
    ];
}


function SDOPZ_obtenerNombreProvincia($idSelect) {
    // Definimos un array asociativo con los códigos de las provincias y sus nombres
    $provincias = [
      "01" => "Álava",
      "02" => "Albacete",
      "03" => "Alicante",
      "04" => "Almería",
      "33" => "Asturias",
      "05" => "Ávila",
      "06" => "Badajoz",
      "08" => "Barcelona",
      "09" => "Burgos",
      "10" => "Cáceres",
      "11" => "Cádiz",
      "39" => "Cantabria",
      "12" => "Castellón",
      "13" => "Ciudad Real",
      "14" => "Córdoba",
      "16" => "Cuenca",
      "17" => "Gerona",
      "18" => "Granada",
      "19" => "Guadalajara",
      "20" => "Guipúzcoa",
      "21" => "Huelva",
      "22" => "Huesca",
      "07" => "Islas Balears",
      "23" => "Jaén",
      "15"=> "La Coruña",
      "26" => "La Rioja",
      "35" => "Las Palmas",
      "24" => "León",
      "25" => "Lérida",
      "27" => "Lugo",
      "28" => "Madrid",
      "29" => "Málaga",
      "30" => "Murcia",
      "31" => "Navarra",
      "32" => "Orense",
      "34" => "Palencia",
      "36" => "Pontevedra",
      "37" => "Salamanca",
      "38" => "Santa Cruz de Tenerife",
      "40" => "Segovia",
      "41" => "Sevilla",
      "42" => "Soria",
      "43" => "Tarragona",
      "44" => "Teruel",
      "45" => "Toledo",
      "46" => "Valencia",
      "47" => "Valladolid",
      "48" => "Vizcaya",
      "49" => "Zamora",
      "50" => "Zaragoza"
   ];
   
   return $provincias[$idSelect];
}

