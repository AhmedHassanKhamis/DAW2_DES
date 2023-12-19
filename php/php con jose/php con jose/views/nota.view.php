<?php
require 'partials/cabecera.php';
require 'partials/nav.php';
require 'partials/hero.php';
?>

<div class="p-3">
    <a href="notas" class="link-primary">Volver a la lista de notas</a>
<p class="mt-3"><?= $nota['contenido']?></p>
</div>

<?php
require 'partials/pie.php';
?>