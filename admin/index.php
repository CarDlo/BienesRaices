<?php
    
    //importar conexion
    require '../includes/config/database.php';
    $db = conectarDB();
    //escribir el query
    $query = "SELECT * FROM propiedades";

    //consultar la base de datos
    $resultado = mysqli_query($db, $query);
    //mensaje condicional
    $mensaje = $_GET['mensaje'] ?? null;

    require '../includes/funciones.php';
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
        <?php while($propiedad = mysqli_fetch_assoc($resultado)) { ?>


            <tr>
                <th><?php echo $propiedad['id']; ?></th>
                <th><?php echo $propiedad['titulo']; ?></th>
                <th><img src="/BienesRaices/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></th>
                <th>$<?php echo $propiedad['precio']; ?></th>
                <th>
                    <a href="propiedades/actualizar.php?id=1" class="boton-verde-block">Actualizar</a>
                    <a href="propiedades/eliminar.php?id=1" class="boton-amarillo-block">Eliminar</a>
                </th>
            </tr>

        <?php } ?>
        </tbody>
    </table>



</main>
<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>