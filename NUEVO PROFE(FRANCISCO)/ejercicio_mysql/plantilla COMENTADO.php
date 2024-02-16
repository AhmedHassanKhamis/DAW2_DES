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
// importo variables
require('variables.php');

// establezco conexion 
$conexion = new mysqli($server, $user, $password, $bbdd);

// recojo errores
$error = $conexion->connect_errno;

// comrpuebo errores
if ($error != null) {

	// en caso de que si se muestra por pantalla el codigo
	echo "<p>Error $error conectando a la base de datos: $conexion->connect_error</p>";

	// luego se cierra el chiringuito
	die();

	// si no explota nada entonces sigo el programa
} else {

	// consulta para los objetos de las tiendas
	$productos = $conexion->query('select nombre_corto,cod from producto')->fetch_all();

	// facilitando el proceso
	$nombre_corto = array_column($productos, 0);
	$id_producto = array_column($productos, 1);

	// compruebo que no haya una conexion anterior y comienzo sesion
	if (!isset($_SESSION['id_producto'])) {
		session_start();
	}
	// compruebo la existencia de los distintos valores en los arrays independientes y con solo tener uno sigo
	if (isset($_POST['submit']) || isset($_SESSION['producto']) || isset($_POST['modificar']) || isset($_SESSION['id_producto'])) {

		// en caso de exito y encontrar uno se procede a traer los datos del producto
		$consulta = $conexion->query('select tienda.nombre,stock.unidades,stock.tienda from stock,tienda where tienda.cod = stock.tienda and stock.producto="' . (isset($_POST["producto"]) ? $_POST['producto'] : $_SESSION['id_producto']) . '"')->fetch_all();

		// haciendome la vida mas facil
		$tienda = array_column($consulta, 0);
		$stock = array_column($consulta, 1);
		$tienda_id = array_column($consulta, 2);

		// compruebo que el usuario ha solicitado un producto
		if (isset($_POST['producto'])) {

			// defino mis variables de sesion y las relleno(alguna con consulta)
			$_SESSION['id_producto'] = $_POST['producto'];
			$_SESSION['nombre_corto'] = array_column($conexion->query('select nombre_corto from producto where cod="' . $_POST['producto'] . '"')->fetch_all(), 0)[0];
		}

		// compruebo que el usuario haya modificado algun valor
		if (isset($_POST['modificar'])) {

			// lanzo los datos actualizados
			for ($i = 0; $i < count($tienda_id); $i++) {
				$conexion->query('update stock set unidades=' . $_POST[$tienda_id[$i]] . ' where tienda=' . $tienda_id[$i] . " and producto='" . $_SESSION['id_producto'] . "'");
			}

			// relanzo mi pagina para refrescar los valores de abajo y que no se queden con los de la anterior consulta
			header("Refresh:0");
		}
	}
	// cierro conexion
	$conexion->close();
}
?>

<!-- comienza el html -->
<!DOCTYPE html>
<html lang="en">

<!-- cabecera -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>STOCK</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<!-- cuerpo o mondongo -->
<body>
	<main>
		<!-- seccion donde se seleciona el producto deseado -->
		<h1>PRODUCTO</h1>
		<!-- formulario para consultar datos del producto deseado -->
		<form action='#' method='post'>
			<!-- seccion para seleccionar el producto -->
			<select name='producto' class="form-select">
				<!-- valor por defecto para dar accesibilidad y facilidad de uso al usuario final -->
				<option value="<?= (isset($_POST["producto"]) ? $_POST['producto'] : $_SESSION['id_producto']) ?>"
					default>
					<?php
					// comprobamos si ya se hizo anteriormente una consulta y manejamos en base a eso
					if ($_SESSION['nombre_corto']) {
						print_r($_SESSION['nombre_corto']);
					} else {
						print_r("Selecciona una opcion....");
					}
					?>
				</option>
				<?php
				// rellenamos el select con valores de la tabla producto
				for ($i = 0; $i < count($nombre_corto); $i++) {
					print_r("<option value='" . $id_producto[$i] . "'>" . $nombre_corto[$i] . "</option>");
				}
				?>
			</select>
			<br>
			<!-- boton para lanzar la consulta -->
			<input class="btn btn-secondary" type='submit' name='submit' value="Consultar 🔎">
		</form>
		<hr>

		<!-- seccion de modificacion y lectura de datos(PRESPECTIVA DE CLIENTE) -->
		<h2>STOCK EN TIENDA</h2>
		<!-- otro formulario como no jeje -->
		<form action="#" method="post">
			<div>
				<p><b>TIENDA</b></p>
				<!-- boton para lanzar la modificacion -->
				<input class="btn btn-success" type="submit" name="modificar" value="GUARDAR 💾">
				<p><b>UNIDADES</b></p>
			</div>
			<?php
			// imprimo los mismos producto de distintas tiendas de forma relacionada y con un input number para modificar los datos
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