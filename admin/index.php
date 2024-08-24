<?php
    require '../includes/app.php';
    estaAutenticado();
    use App\Propiedad;

    //implementar metodo para traer las propiedades
    $propiedades = Propiedad::all();

    debugear($propiedades);

    //mensaje condicional
    $mensaje = $_GET['mensaje'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            //Eliminar archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resultadoDelete = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultadoDelete);
            unlink('../imagenes/' . $propiedad['imagen']);

            $query = "DELETE FROM propiedades WHERE id = $id";
            $resultadoDelete = mysqli_query($db, $query);
            if($resultadoDelete){
                header('Location: /admin/?mensaje=3');
            }

        }
    }


    incluirTemplate('header');
?>

<main class="contenedor seccion"> 
    <h1>Administrador</h1>

    <?php if( intval($mensaje)===1 ) { ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php }elseif( intval($mensaje)===2 ) { ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php }elseif( intval($mensaje)===3 ) { ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
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
                <th><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></th>
                <th>$<?php echo $propiedad['precio']; ?></th>
                <th>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad['id'];?>">
                        <input type="submit" value="Eliminar" class="boton-rojo-block">
                    </form>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>

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