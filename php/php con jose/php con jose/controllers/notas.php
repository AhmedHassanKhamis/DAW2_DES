<?php
require 'database.php';
$config = require('config.php');
$seccion = 'Mis notas';

$autor = 1;

$notas = consulta("select * from notas where id_autor={$autor};",$config)->fetchAll();

require 'views/notas.view.php';