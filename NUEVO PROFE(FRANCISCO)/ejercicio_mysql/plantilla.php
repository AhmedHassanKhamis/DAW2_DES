<!-- Crea una página web en la que se muestre el stock existente de un determinado producto en cada una de las tiendas. 
Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página.
 Puedes usar como base los siguientes ficheros.
 -->


<?php 
require('variables.php');

$conexion = new mysqli($server,$user,$password,$bbdd);
$error = $conexion->connect_errno;
if ($error != null) {
     echo "<p>Error $error conectando a la base de datos: $conexion->connect_error</p>";
     exit();
}else{

	$tablas = array_column($conexion->query('select nombre_corto from producto')->fetch_all(),0);
	if (isset($_POST['submit'])) {
		$tienda = array_column($conexion->query('select tienda.nombre,stock.unidades from stock,tienda,producto where tienda.cod = stock.tienda and producto.cod = stock.producto and producto.nombre_corto="'.$_POST['producto'] .'"')->fetch_all(),0);
		$stock = array_column($conexion->query('select tienda.nombre,stock.unidades from stock,tienda,producto where tienda.cod = stock.tienda and producto.cod = stock.producto and producto.nombre_corto="'.$_POST['producto'] .'"')->fetch_all(),1);
	}
	$conexion->close();
}


print_r("<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>

<head>
	<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
	<title>Plantilla para Ejercicios Tema 3</title>
	<link href='dwes.css' rel='stylesheet' type='text/css'>
</head>

<body>

		<h1>PRODUCTO: </h1>
		<form id='form_seleccion' action='' method='post'>
			<select name='producto' id='producto'>
			");
			for ($i=1;$i <= count($tablas);$i++) {
				print_r("<option value='".$tablas[$i]."'>".$tablas[$i]."</option>");
			}
			
			print_r("
			</select>
			<input type='submit' name='submit'>
		</form>
		<hr>
		<h2>STOCK EN TIENDA</h2>
		<table>
    <thead>
      <tr>
        <th>Tienda</th>
        <th>Unidades</th>
      </tr>
    </thead>
    <tbody align='center'>");
	for ($i=0; $i < count($tienda); $i++) { 
		print_r("<tr><td>".$tienda[$i]."</td><td>".$stock[$i]."</td></tr>");
	}
	print_r("
    </tbody>
  </table>
</body>
</html>");
?>