<?php
require 'partials/cabecera.php';
require 'partials/nav.php';
require 'partials/hero.php';
require 'partials/pie.php';
?>

<div>
    <ul class="list-group m-3">
        <?php foreach ($notas as $nota) : ?>
            <li class="list-group-item">
                <a href="nota?id=<?= $nota['id'] ?>" class="primary-link">
                    <?= $nota['titulo']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>