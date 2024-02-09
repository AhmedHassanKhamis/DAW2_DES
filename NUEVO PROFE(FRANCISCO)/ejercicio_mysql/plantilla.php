<!-- Crea una página web en la que se muestre el stock existente de un determinado producto en cada una de las tiendas. 
Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página.
 Puedes usar como base los siguientes ficheros.
 -->


<?php 
require_once('variables.php');

$conexion = new mysqli($server,$user,$password,$bbdd);
$error = $conexion->connect_errno;
if ($error != null) {
     echo "<p>Error $error conectando a la base de datos: $conexion->connect_error</p>";
     exit();
}else{

	$tablas = $dwes->query('show tables');
	print_r($tablas);
	$dwes->close();
}



print_r("<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>

<head>
	<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
	<title>Plantilla para Ejercicios Tema 3</title>
	<link href='dwes.css' rel='stylesheet' type='text/css'>
</head>

<body>

	<div id='encabezado'>
		<h1>Ejercicio: </h1>
		<form id='form_seleccion' action='' method='post'>
			<select name='producto' id='producto'>
			");
			foreach ($producto as $key => $value) {
				print_r("<option value='$value'>$value</option>");
			}
			
			print_r("
			</select>
		</form>
	</div>

	<div id='contenido'>
		<h2>Contenido</h2>
	</div>

	<div id='pie'>
	</div>
</body>

</html>");
?>