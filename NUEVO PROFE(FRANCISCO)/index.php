<?php
/*
Enunciado.
Debes programar una aplicación para mantener una pequeña agenda en una única página web programada en PHP
sin acceso a base de datos o persistencia de cualquier tipo.

La agenda almacenará únicamente dos datos de cada persona: su nombre y un número de teléfono:
no podrá haber nombres repetidos en la agenda.

En la parte superior de la página web se mostrará el contenido de la agenda que tenga en cada momento.
En la parte inferior debe figurar un sencillo formulario con dos cuadros de texto, uno para el nombre y otro para el número de teléfono.

Cada vez que se envíe el formulario:

-Si el nombre está vacío, se mostrará una advertencia.
-Si el nombre que se introdujo no existe en la agenda, y el número de teléfono no está vacío, se añadirá a la agenda.
-Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el número de teléfono anterior.
-Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono,
se eliminará de la agenda la entrada correspondiente a ese nombre.
*/

// Variables
error_reporting(E_ERROR);
ini_set('display_errors', '1');
echo $_POST['agenda'];
if (!isset($_POST['agenda'])) {
    $_POST['agenda'] = ";";
}
// Array asociativo con los Datos
$agenda = [];
$contactos = explode(";", $_POST['agenda']);
for ($i = 0; $i < count($contactos); $i++) {
    $campos = [];
    $campos = explode("-", $contactos[$i]);
    $agenda[$campos[0]] = $campos[1];
}

if (isset($_POST['enviar']) && $_POST['nombre'] != "" && $_POST['telefono'] != "") {
    $agenda[$_POST['nombre']] =  $_POST['telefono'];
}elseif (isset($_POST['enviar']) && $_POST['nombre'] != "" && $_POST['telefono'] == "") {
    unset($agenda[$_POST['nombre']]);
}else{
    $_POST['agenda'] .= "";
}



print_r("<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <style>
      body {
        margin: 30px;
      }
      form{
        width: fit-content;
        padding: 10px;
        display: flex;
        flex-direction: column;
      }
      "); if (isset($_POST['enviar']) && $_POST['nombre'] == "") {
      print_r("input[type='text'] {
        border-color:red;
      }");
    }
    print_r("
      span {
        color:red;
      }
    </style>
</head>
<body>
    <h1>Agenda</h1>
    <table>
    <tr><th>NOMBRE</th><th>TELEFONO</th></tr>
");
$_POST['agenda']="";
foreach ($agenda as $key => $value) {
    $_POST['agenda'] .= $key . "-" . $value . ";";
    if ($key) {
        print_r("<tr><td>" . $key . "</td><td>" . $value . "</td></tr>");
    }
}
print_r("</table>
    <hr>
    <h2>Agregar Contacto</h2>
    <form action='' method='post' style='border: 1px solid black;'>
        <label for='nombre'>Nombre:");
if (isset($_POST['enviar']) && $_POST['nombre'] == "") {
    print_r('<span>RELLENA ESTE CAMPO</span>');
}
print_r("</label>
        <input id='nombre' name='nombre' type='text' placeholder='Introduce nombre aqui...'>
        <br>
        <br>
        <label for='telefono'>Telefono:</label>
        <input id='telefono' name='telefono' type='number' min=1 placeholder='Introduce telefono aqui...'>
        <br>
        <br>
        <input type='text' id='agenda' name='agenda' value=" . $_POST['agenda'] . " hidden>
        <input id='enviar' name='enviar' type='submit' value='Enviar'>
    </form>
</body>
</html>");
