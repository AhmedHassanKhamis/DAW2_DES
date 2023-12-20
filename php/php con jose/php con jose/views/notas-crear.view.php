<?php
require 'partials/cabecera.php';
require 'partials/nav.php';
require 'partials/hero.php';
?>

<form class="p-3" method="post">
    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo de la nota a crear" value="<?= $titulo ?? ''?>">
        <?php if (isset($errores['titulo'])) : ?> 
            <p class="fs-6 text-danger mt-2"><?= $errores['titulo']?></p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="contenido" class="form-label">Contenido</label>
        <textarea class="form-control" id="contenido"  name="contenido" rows="3" placeholder="Escriba aqui su nota"><?= $contenido ?? ''?></textarea>
        <?php if (isset($errores['contenido'])) : ?> 
            <p class="fs-6 text-danger mt-2"><?= $errores['contenido']?></p>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php

require 'partials/pie.php';
?>