<?php
    require 'includes/funciones.php';

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