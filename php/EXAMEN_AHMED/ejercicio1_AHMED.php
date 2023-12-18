<?php

/**
 * E1.php 
 * Dentro de los 50 primeros números naturales, encontrar la
 * sucesión de aquellos que son impares y además no son múltiplos 
 * de 3 ni de 5. Imprimirlos usando print_r o echo.
 */
include("funciones.php");

$impares = [];
$x = 0;

for ($i = 0; $i <= 50; $i++) {
    if (($i % 2 != 0) && ($i % 3 != 0) && ($i % 5 != 0)) {
        $impares[$x] = $i;
        $x++;
    }
}
print_r('array con las condiciones propuestas: ');
imprimirArray($impares);
