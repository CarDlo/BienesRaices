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

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <th>Titulo</th>
                <th><img src="/BienesRaices/imagenes/9459b34cbf8166b040e680139acdf8f4.jpg" class="imagen-tabla"></th>
                <th>10000</th>
                <th>
                    <a href="propiedades/actualizar.php?id=1" class="boton-verde-block">Actualizar</a>
                    <a href="propiedades/eliminar.php?id=1" class="boton-amarillo-block">Eliminar</a>
                </th>
            </tr>
        </tbody>
    </table>



</main>
<?php
    incluirTemplate('footer');
?>