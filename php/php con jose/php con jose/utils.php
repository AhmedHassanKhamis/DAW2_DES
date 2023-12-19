<?php 

function mostrar($valor) {
    echo "<pre>";
    var_dump($valor);
    echo "</pre>";
    die();
}


function esLaUrl($url){
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $url;
}