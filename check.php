<?php 

if (isset($_POST["INSPARMS"])) {
	if (valparm($_POST) == false) {
		$data = ["error"=> 1,"msg"=>"Error, revisar campos"];
		echo json_encode($data);
		exit;
	}
	else {
		$_POST = sanparm($_POST);
		add_people($_POST);
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$data = ["error"=> 0,"msg"=>"Gracias $nombre $apellido por su información <a href='registro.csv'>Ver Registros</a>"];
		echo json_encode($data);
		exit;
	}
} 
else {
	$data = ["error"=> 1,"msg"=>"Error en envío de datos"];
		echo json_encode($data);
		exit;
}

//FUNCION GENERADOR CSV SOLICITADA
function add_people($data, $delimitador = ';', $encapsulador = '"') {
	extract($data);
	$arrdata[0] = ['Nombre', 'Apellido', 'Cedula', 'Correo', 'Descripcion'];
	$arrdata[1] = [$nombre, $apellido, $cedula, $correo, $descripcion];
	$file_handle = fopen('registro.csv','a');
	foreach ($arrdata as $linea) {
		fputcsv($file_handle, $linea, $delimitador, $encapsulador);
	}
	rewind($file_handle);
	fclose($file_handle);
}
//FUNCION GENERADOR CSV SOLICITADA

//FUNCIONES PARA VALIDACION Y SATINIZADO DE DATOS
function sanparm ($PARMS) {	
	$PARMSAN = "";
	$SANPARM = "";
	foreach ($PARMS as $key => $value) {
		$value = trim(strip_tags($value));
		$value = str_replace(" ", "", $value);
		if ($PARMSAN != "") {
			$arraytemp = [$key => $value];
			$SANPARM = array_merge($PARMSAN, $arraytemp);
			$PARMSAN = $SANPARM;
		}
		else {
			$PARMSAN = [$key => $value];
		}
	}
	return $SANPARM;
}
function valparm($PARMS) {
	foreach ($PARMS as $key => $value) {
		if ($value == "" || $value == null) {
			$varmsg = false;
			break;
		}
		else {
			$varmsg = true;
		}
	}
	return $varmsg;
} 
//FUNCIONES PARA VALIDACION Y SATINIZADO DE STRING
?>