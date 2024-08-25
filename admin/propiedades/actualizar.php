<?php

use App\propiedad;

    require '../../includes/app.php';

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

        $errores = $propiedad->validar();

        //Revisar que el array de errores este vacio
        if(empty($errores)) {

            $carpetaImagenes = '../../imagenes/';
            //crear carpeta
            if(!is_dir('../../imagenes')) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';
            if($imagen['name']) {
                unlink($carpetaImagenes . $propiedad['imagen']);
                            //subir la imagen
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
                
            }else {
                $nombreImagen = $propiedad['imagen'];
            }
            //subida de archivos




            //insertar en la base de datos
           /* $query = "INSERT INTO propiedades (titulo, precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedores_id)
            VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId')";
            $resultado = mysqli_query($db, $query);*/

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