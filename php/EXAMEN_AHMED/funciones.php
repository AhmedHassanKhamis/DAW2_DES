<?php

function imprimirArray($array)
{
    for ($i = 0; $i < count($array); $i++) {
        print_r($array[$i]);
        print_r(', ');
    }
}

function imprimirDiccionario($array)
{
    foreach ($array as $key => $value) {
    }
}

?>