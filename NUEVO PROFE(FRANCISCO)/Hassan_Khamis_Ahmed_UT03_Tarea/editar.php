<?php
try {
    // seccion de creacion de objeto para conexion a base y consultas
    $conexion = new PDO('mysql:host=localhost;dbname=dwes', 'php', 'php');
    $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
    // seccion donde ya comprobada la conexion se hace la peticion de los datos del producto seleccionado en la anterior pagina
    if ($version) {
        $producto = $conexion->query("SELECT cod,nombre_corto,nombre,descripcion,pvp FROM producto where cod='".$_GET["cod"]."'");
        $producto_assoc = $producto->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // tipica excepcion
        throw new Exception("Error intentando conectar a la base de datos", 1);
    }
} catch (Exception $e) {
    echo "Se ha producido el siguiente error: " . $e->getMessage();
}

?>
<!-- parte html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Edicion de un producto</h1>
    </header>
    <main>
        <form action="actualizar.php" method="post" id="editar">
            <input type="hidden" name="oculto" value="<?= $producto_assoc[0]["cod"] ?>" hidden>
            <label for="nombre_corto"><b>Nombre corto:</b></label>
            <input type="text" name="nombre_corto" id="nombre_corto" value="<?= $producto_assoc[0]["nombre_corto"] ?>">
            <label for="nombre"><b>Nombre:</b></label>
            <input type="text" name="nombre" id="nombre" value="<?= $producto_assoc[0]["nombre"] ?>">
            <label for="descripcion"><b>Descripción:</b></label>
            <textarea name="descripcion" id="descripcion" cols="30"
                rows="10"><?= $producto_assoc[0]["descripcion"] ?></textarea>
            <label for="precio"><b>PVP:</b></label>
            <input type="number" name="precio" id="precio" value="<?= $producto_assoc[0]["pvp"] ?>">
            <div>
                <input type="submit" name="submit" value="actualizar">
                <button><a href="listado.php">Cancelar</a></button>
            </div>
        </form>
    </main>
</body>

</html>