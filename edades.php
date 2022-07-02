<?php
//PRUEBA SISCOTEL JOSÉ MARTÍNEZ

//SCRIPT PARA SER EJECUTADO POR CONSOLA

//variables para generacion de array de datos obtenidos en el bucle
$data_temp = "";
$data = "";
//variables para generacion de array de datos obtenidos en el bucle

//bucle para lectura de datos y obtener edades de los usuarios
for ($i=1; $i < 3; $i++) {
        $edad = readline("Ingresar Edad Usuario $i: ");
        $edad = intval($edad);
        if ($edad == "0") {
           echo "Ingresar solo números \n";
           $i--;
   }  
   else {
      if ($data != "") {
        $arraytemp = [$edad];
        $data_temp = array_merge($data, $arraytemp);
        $data = $data_temp;
}
else {
        $data = [$edad];
}
}    
}
//bucle para lectura de datos y obtener edades de los usuarios

//condicionales para mostrar resultados requeridos
if ($data[0] > $data[1]) {
   $diferencia = $data[0] - $data[1];
   echo "Edad mayor $data[0], diferencia $diferencia";   
}
else {
  $diferencia = $data[1] - $data[0];
  echo "Edad mayor $data[1], diferencia $diferencia";  
}
//condicionales para mostrar resultados requeridos