<?php
require 'database.php';
$config = require('config.php');
$seccion = 'Crear nueva nota';

$autor = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errores = [];

    
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);

    if (strlen($titulo) < 4) {
        $errores['titulo'] = "Al menos 4 caracteres";
    }
    if(strlen($contenido) < 4){
        $errores['contenido'] = "Al menos 4 caracteres";
    }

    if (strlen($contenido) > 255) {
        $errores['contenido'] = "te pasaste de caracteres(255)";
    }
    
    if (empty($errores)) {
        $res = consultaSegura("INSERT INTO notas (titulo, contenido, id_autor) values (:titulo, :contenido, :autor)", ["titulo" => $titulo, "contenido" => $contenido, "autor" => $autor] ,$config);
    }




}


// $notas = consulta("select * from notas where id_autor={$autor};",$config)->fetchAll();

require 'views/notas-crear.view.php';