<!-- Crea una página web en la que se muestre el stock existente de un determinado producto en cada una de las tiendas. 
Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página.
 Puedes usar como base los siguientes ficheros.


SEGUNDA PARTE

A partir de la página web obtenida en el ejercicio anterior,
 añade la opción de modificar el número de unidades del producto en cada una de las tiendas.
  Utiliza una consulta preparada para la actualización de registros en la tabla stock. 
  No es necesario tener en cuenta las tareas de inserción (no existían unidades anteriormente)
   y borrado (si el número final de unidades es cero).


 -->


<?php
require('variables.php');

$conexion = new mysqli($server, $user, $password, $bbdd);
$error = $conexion->connect_errno;
$tablas = array_column($conexion->query('select nombre_corto from producto')->fetch_all(), 0);

if ($error != null) {
	echo "<p>Error $error conectando a la base de datos: $conexion->connect_error</p>";
	exit();
	die();
} else {

	$tienda = null;
	$stock = null;
	$tienda_id = null;
	if ($_SESSION['producto'] == null || $_SESSION['producto'] == "") {
		session_start();
	}

	if (isset($_POST['submit']) || ($_SESSION["producto"] != null && $_SESSION["producto"] != "")) {
		$consulta =  $conexion->query('select tienda.nombre,stock.unidades,stock.tienda from stock,tienda,producto where tienda.cod = stock.tienda and producto.cod = stock.producto and producto.nombre_corto="' . (isset($_POST["producto"]) ? $_POST['producto'] : $_SESSION['producto']) . '"')->fetch_all();
		$tienda = array_column($consulta, 0);
		$stock = array_column($consulta, 1);
		if (isset($_POST['producto'])) {
			$_SESSION['producto'] = $_POST['producto'];
		}
	}
	if (isset($_POST['modificar'])) {
		$consulta_2 =  $conexion->query('select tienda.nombre,stock.unidades,stock.tienda from stock,tienda,producto where tienda.cod = stock.tienda and producto.cod = stock.producto and producto.nombre_corto="' . $_SESSION['producto'] . '"')->fetch_all();
		$tienda = array_column($consulta_2, 0);
		$stock = array_column($consulta_2, 1);
		$tienda_id = array_column($consulta_2, 2);

		for ($i = 0; $i < count($tienda_id); $i++) {
			$auxiliar = "tienda".$tienda_id[$i];
			// $conexion->query('update stock set unidades=' . $_POST[$auxiliar] . ' where tienda=' . $auxiliar)->fetch_all();
			print_r('update stock set unidades=' . $_POST[$auxiliar] . ' where tienda=' . $auxiliar."<br>");
		}
	}
	$conexion->close();
}

?>
<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
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
			<option value="<?= $_POST['producto'] ?>" default>
				<?php
				if ($_POST['producto']) {
					print_r($_POST['producto']);
				} else if($_SESSION['producto']) {
					print_r($_SESSION['producto']);
				}else{
					print_r("Selecciona una opcion....");
				}
				?>
			</option>
			<?php
			for ($i = 1; $i <= count($tablas); $i++) {
				print_r("<option value='" . $tablas[$i] . "'>" . $tablas[$i] . "</option>");
			}
			?>
		</select>
		<input type='submit' name='submit'>
	</form>
	<hr>
	<h2>STOCK EN TIENDA</h2>
	<form action="" method="post">
		<table>
			<thead>
				<tr>
					<th>Tienda</th>
					<th>Unidades</th>
				</tr>
			</thead>
			<tbody align='center'>
				<tr>
					<td colspan="2"><input style="width:100%;height:100%;" type="submit" name="modificar" value="modificar"></td>
				</tr>
				<?php
				if (isset($_POST['producto']) || isset($_SESSION['producto'])) {
					for ($i = 0; $i < count($tienda); $i++) {
						print_r("<tr><td>" . $tienda[$i] . "</td><td><input type='number' name='tienda" . $tienda_id[$i] . "' min='0' value='" . $stock[$i] . "'></td></tr>");
					}
				}
				?>
			</tbody>
		</table>
	</form>
</body>

</html>