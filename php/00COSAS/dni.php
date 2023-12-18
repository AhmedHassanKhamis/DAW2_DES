<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    if (isset($_POST["submit"])) {
        $numero = $_POST["number"];
        $resultado = calcularDni($numero);
    }else {
        $resultado = "no has introducido un dni";
    }

    function calcularDni($numero){
        $letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
        $posicion = $numero % 23;
        return $letras[$posicion];
    }
?>
<body>
    <form action=""method ="post">

    <label>numeros dni:
    <input type="number" name="number">
    </label>
    <input type="submit" name="submit" value="calcular">
    </form>
    <h1><?= $resultado; ?></h1>
</body>
</html>