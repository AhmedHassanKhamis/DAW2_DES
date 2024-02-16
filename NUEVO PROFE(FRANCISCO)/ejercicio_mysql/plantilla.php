<!-- REALIZADO POR AHMED HASSAN KHAMIS
#########################################
###			  PRIMERA PARTE			  ###
#########################################
crea una página web en la que se muestre el stock existente de un determinado producto en cada una de las tiendas. 
Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página.
Puedes usar como base los siguientes ficheros.

#########################################
###			  SEGUNDA PARTE			  ###
#########################################
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
if ($error != null) {
	echo "<p>Error $error conectando a la base de datos: $conexion->connect_error</p>";
	die();
} else {
	$productos = $conexion->query('select nombre_corto,cod from producto')->fetch_all();
	$nombre_corto = array_column($productos, 0);
	$id_producto = array_column($productos, 1);
	if (!isset($_SESSION['id_producto'])) {
		session_start();
	}
	if (isset($_POST['submit']) || isset($_SESSION['producto']) || isset($_POST['modificar']) || isset($_SESSION['id_producto'])) {
		$consulta = $conexion->query('select tienda.nombre,stock.unidades,stock.tienda from stock,tienda where tienda.cod = stock.tienda and stock.producto="' . (isset($_POST["producto"]) ? $_POST['producto'] : $_SESSION['id_producto']) . '"')->fetch_all();
		$tienda = array_column($consulta, 0);
		$stock = array_column($consulta, 1);
		$tienda_id = array_column($consulta, 2);
		if (isset($_POST['producto'])) {
			$_SESSION['id_producto'] = $_POST['producto'];
			$_SESSION['nombre_corto'] = array_column($conexion->query('select nombre_corto from producto where cod="' . $_POST['producto'] . '"')->fetch_all(), 0)[0];
		}
		if (isset($_POST['modificar'])) {
			for ($i = 0; $i < count($tienda_id); $i++) {
				$conexion->query('update stock set unidades=' . $_POST[$tienda_id[$i]] . ' where tienda=' . $tienda_id[$i] . " and producto='" . $_SESSION['id_producto'] . "'");
			}
			header("Refresh:0");
		}
	}
	$conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>STOCK</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<main>
		<h1>PRODUCTO</h1>
		<form action='#' method='post'>
			<select name='producto' class="form-select">
				<option value="<?= (isset($_POST["producto"]) ? $_POST['producto'] : $_SESSION['id_producto']) ?>"
					default>
					<?php
					if ($_SESSION['nombre_corto']) {
						print_r($_SESSION['nombre_corto']);
					} else {
						print_r("Selecciona una opcion....");
					}
					?>
				</option>
				<?php
				for ($i = 0; $i < count($nombre_corto); $i++) {
					print_r("<option value='" . $id_producto[$i] . "'>" . $nombre_corto[$i] . "</option>");
				}
				?>
			</select>
			<br>
			<input class="btn btn-secondary" type='submit' name='submit' value="Consultar 🔎">
		</form>
		<hr>
		<h2>STOCK EN TIENDA</h2>
		<form action="#" method="post">
			<div>
				<p><b>TIENDA</b></p>
				<input class="btn btn-success" type="submit" name="modificar" value="GUARDAR 💾">
				<p><b>UNIDADES</b></p>
			</div>
			<?php
			if (isset($_POST['producto']) || isset($_SESSION['id_producto'])) {
				for ($i = 0; $i < count($tienda); $i++) {
					print_r("<div><p>" . $tienda[$i] . "</p><input class='form-number' type='number' name='" . $tienda_id[$i] . "' min='0' value='" . $stock[$i] . "'></div>");
				}
			}
			?>
		</form>
	</main>
</body>

</html>