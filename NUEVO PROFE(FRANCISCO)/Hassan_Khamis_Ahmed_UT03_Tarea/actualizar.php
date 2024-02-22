<?php
try {
    // lo mismo
    $conexion = new PDO('mysql:host=localhost;dbname=dwes', 'php', 'php');
    $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
    if ($version) {
        if (isset($_POST["submit"])) {
            $conexion->exec("update producto set nombre_corto='" . $_POST["nombre_corto"] . "',nombre='" . $_POST["nombre"] . "',descripcion='" . $_POST["descripcion"] . "',pvp=" . $_POST["precio"] . " where cod='" . $_POST["oculto"] . "'");
        }
        header("Location: listado.php");
        die();
    } else {
        throw new Exception("Error intentando conectar a la base de datos", 1);
    }
} catch (Exception $e) {
    echo "Se ha producido el siguiente error: " . $e->getMessage();
}

?>
