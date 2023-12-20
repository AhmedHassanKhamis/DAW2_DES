<?php
require 'partials/cabecera.php';
require 'partials/nav.php';
require 'partials/hero.php';
?>

<div>
    <ul class="list-group m-3">
        <?php foreach ($notas as $nota) : ?>
            <li class="list-group-item">
                <a href="nota?id=<?= $nota['id'] ?>" class="primary-link">
                    <?= htmlspecialchars($nota['titulo']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/notas/crear" type="button" class="btn btn-primary mt-3 mx-3">Crear nota...</a>
</div>

<?php

require 'partials/pie.php';
?>