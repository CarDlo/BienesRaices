<?php
    require '../includes/funciones.php';
    $mensaje = $_GET['mensaje'] ?? null;
    incluirTemplate('header');
?>

<main class="contenedor seccion"> 
    <h1>Administrador</h1>

    <?php if( intval($mensaje)===1 ) { ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php } ?>

    <a href="propiedades/crear.php"><input type="submit" value="Nueva Propiedad" class="boton-verde"></a>
</main>
<?php
    incluirTemplate('footer');
?>