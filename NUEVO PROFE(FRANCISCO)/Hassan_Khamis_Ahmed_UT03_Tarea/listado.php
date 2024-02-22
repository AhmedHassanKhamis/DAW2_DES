<!-- codigo realizado por Ahmed Hassan Khamis -->
<?php
try {
    // seccion de creacion de objeto para conexion a base y consultas
    $conexion = new PDO('mysql:host=localhost;dbname=dwes', 'php', 'php');
    $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
    // seccion donde ya comprobada la conexion se hace la peticion de las familias y en caso de ser solicitado los productos
    if ($version) {
        $familias = $conexion->query("SELECT * FROM familia");
        $familias_assoc = $familias->fetchAll(PDO::FETCH_ASSOC);
        if (isset($_POST["submit"])) {
            $productos = $conexion->query("select cod,nombre_corto,pvp,familia from producto where familia='" . $_POST['familia'] . "'");
            $productos_assoc = $productos->fetchAll(PDO::FETCH_ASSOC);


            // esto es innecesario pero lo hago para que tenga coherencia la pagina
            $categoria = $conexion->query("select nombre from familia where cod='" . $_POST['familia'] . "'");
            $categoria = $categoria->fetch(PDO::FETCH_COLUMN,0);
        }
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
    <title>Listado</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>LISTADO DE PRODUCTOS</h1>
        <h4>clasificado por familias</h4>
    </header>
    <aside>
    <form action="#" method="post">
            <label for="familia">Familia</label>
            <select name="familia" id="familia">
                <option value="#" default>Selecciona una opcion....</option>
                <?php
                // imprimo las opciones
                for ($i = 0; $i < count($familias_assoc); $i++) {
                    print_r('<option value ="' . $familias_assoc[$i]["cod"] . '">' . $familias_assoc[$i]["nombre"] . '</option>');
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Mostrar productos">
        </form>
        <hr>

    </aside>
    <main>
        <h2>Productos de la familia <?= $categoria ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // imprimo los productos
                if (isset($_POST['familia'])) {
                    for ($i = 0; $i < count($productos_assoc); $i++) {
                        print_r("<tr>");
                        print_r('<td>' . $productos_assoc[$i]["nombre_corto"] . '</td><td>' . $productos_assoc[$i]["pvp"] . '</td><td><button><a href="editar.php?cod=' . $productos_assoc[$i]["cod"] . '">Editar ✏</a></button></td>');
                        print_r("</tr>");
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>