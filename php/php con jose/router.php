<?php


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$rutas = [

    "/" => "controllers/inicio.php",
    "/notas" => "controllers/notas.php",
    "/info" => "controllers/info.php",
    "/contacto" => "controllers/contacto.php"
];


function routerToController($rutas, $uri){
    if (array_key_exists($uri, $rutas)) {
        require $rutas[$uri];
    }else {
        abortar();
    }
}


function abortar($codigo=404) {
    http_response_code($codigo);
    require "views/{$codigo}.php";
    die();
}


routerToController($rutas, $uri);