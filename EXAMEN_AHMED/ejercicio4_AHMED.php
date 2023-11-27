<?php

/**
 * E4.php
 * Dado un array de 30 stories, crear una forma(GET) con html para seleccionar 
 * una sublista.
 * a) Usar dos inputs, "left" y "right" de tipo number correspondientes al 
 * número de story.
 * b) Validar los inputs e informar al usuario si no son correctos.
 */

include("funciones.php");
$biggerArray = array(
    "Story0", "Story1", "Story2", "Story3", "Story4", "Story5", "Story6",
    "Story7", "Story8", "Story9", "Story10", "Story11", "Story12", "Story13", "Story14", "Story15",
    "Story16", "Story17", "Story18", "Story19", "Story20", "Story21", "Story22", "Story23",
    "Story24", "Story25", "Story26", "Story27", "Story28", "Story29"
);

$longitud = null;
if (isset($_GET["submit"])) {
    // handler 1
    if ($_GET["left"] < 0 || $_GET["right"] < 0) {
        print_r("<li style='color:red;'>has metido numeros negativos y no mola!!!!!!</li><br>");
        $_GET["left"] = $_GET["left"]  * -1;
        $_GET["right"] = $_GET["right"] * -1;
    }
    // handler 2
    if ($_GET["left"] > $_GET["right"]) {
        print_r("<li style='color:red;'>Al intentar meter los numeros al reves, yo te hago el cambiazo para que te sea facil!!!!!!</li><br>");
        $longitud = $_GET["left"] - $_GET["right"];
        $_GET["left"]  = $_GET["right"];
    }
    // handler 3
    if ($_GET["left"] < 0 || $_GET["right"] > 30) {
        print_r("<li style='color:red;'>metelos en su rango correspondiente!!!!!!</li><br>");
    }
    $longitud = $_GET["right"] - $_GET["left"];
    $resultado =  array_slice($biggerArray, $_GET["left"], $longitud);
    print_r("<h1>Resultado</h1>");
    imprimirArray($resultado);
    print_r("<hr>");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E4</title>
</head>

<body>
    <h1>Bienvenido al substractor de historias</h1>
    <h5>elija una desde el 0 al 30 sin miedo!</h5>
    <!-- Form - get -->
    <form action="" method="get">
        <label>Desde: <input type="number" name="left"></label>
        <label>Hasta: <input type="number" name="right"></label>
        <input type="submit" name="submit">
    </form>
</body>

</html>