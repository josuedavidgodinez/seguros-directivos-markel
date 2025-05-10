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



function SDOPZ_obtenerPrecio($facturacion, $limiteIndemnizacion) {
   // Definimos la tabla de precios
   $precios = [
      1 => [1 => 399, 2 => 540, 3 => 715, 4 => "-", 5 => "-", 6 => "-"],
      2 => [1 => 455, 2 => 615, 3 => 815, 4 => 1060, 5 => "-", 6 => "-"],
      3 => [1 => 540, 2 => 730, 3 => 965, 4 => 1255, 5 => 1570, 6 => "-"],
      4 => [1 => 625, 2 => 845, 3 => 1120, 4 => 1455, 5 => 1825, 6 => 2450],
      5 => [1 => 760, 2 => 1015, 3 => 1350, 4 => 1750, 5 => 2190, 6 => 2940],
      6 => [1 => 760, 2 => 1015, 3 => 1350, 4 => 1750, 5 => 2190, 6 => 2940],
   ];

   return $precios[$facturacion][$limiteIndemnizacion]; 
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

