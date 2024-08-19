<?php
    require 'includes/app.php';

    incluirTemplate('header');
?>
    <main class="contenedor seccion">
    <?php
            $limit = 9;
            include 'includes/templates/anuncios.php';
        ?>

    </main>
<?php
    incluirTemplate('footer');
?>