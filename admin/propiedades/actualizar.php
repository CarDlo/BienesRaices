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
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }
        if(!$precio) {
            $errores[] = "Elige un precio";
        }
        if(strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria";
        }
        if(!$habitaciones) {
            $errores[] = "Elige el número de habitaciones";
        }
        if(!$wc) {
            $errores[] = "Elige el número de baños";
        }
        if(!$estacionamiento) {
            $errores[] = "Elige el número de estacionamiento";
        }
        if(!$vendedorId) {
            $errores[] = "Elige el vendedor";
        }


        //Validar por tamaño (1mb max)
        $medida = 100000000;
        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }

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