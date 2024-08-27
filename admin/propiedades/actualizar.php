<?php

use App\propiedad;

    require '../../includes/app.php';
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    estaAutenticado();

    $id = $_GET['id'];

    if(!filter_var($id, FILTER_VALIDATE_INT)) {
    header('Location: /admin/');
    exit;
    }

    //obteenr datos de propiedad
    $propiedad = propiedad::find($id);
    



    //consultar para tener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $consultaVendedores = mysqli_query($db, $consulta);

    //Arreglo con mensajes de error
    $errores = propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //asignar atributos
        $args = [];
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //debugear($propiedad);
        //Validacion subida de archivos
        $errores = $propiedad->validar();
        
        //generar nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        //subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el array de errores este vacio
        if(empty($errores)) {

 
            $query = "UPDATE propiedades SET ";
            $query .= "titulo = '$titulo', ";
            $query .= "precio = '$precio', ";
            $query .= "imagen = '$nombreImagen', ";
            $query .= "descripcion = '$descripcion', ";
            $query .= "habitaciones = '$habitaciones', ";
            $query .= "wc = '$wc', ";
            $query .= "estacionamiento = '$estacionamiento', ";
            $query .= "vendedores_id = '$vendedorId' ";
            $query .= "WHERE id = $id";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                //redireccionar al usuario
                header('Location: /admin?mensaje=2');
            }

        }


    }




    incluirTemplate('header');
?>

<main class="contenedor seccion"> 
    <h1>Actualizar propiedad</h1>
    <a href="/admin/index.php"><input type="submit" value="Volver" class="boton-verde"></a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>