<?php
    require '../../includes/app.php';

    use App\propiedad;


    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }
    //Base de datos

    $db = conectarDB();

    //consultar para tener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $consultaVendedores = mysqli_query($db, $consulta);

    //Arreglo con mensajes de error
    $errores = propiedad::getErrores();

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $propiedad = new propiedad($_POST);
        $errores = $propiedad->validar();
       


        //Revisar que el array de errores este vacio
        if(empty($errores)) {

            $propiedad->guardar();



            $imagen = $_FILES['imagen'];
    

            //subida de archivos
            $carpetaImagenes = '../../imagenes/';
            //crear carpeta
            if(!is_dir('../../imagenes')) {
            mkdir($carpetaImagenes);
            }

            //subir la imagen
            $nombreImagen = '';
            if($imagen['name']) {
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }


            //insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedores_id)
            VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId')";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                //redireccionar al usuario
                header('Location: /admin?mensaje=1');
            }

        }


    }




    incluirTemplate('header');
?>

<main class="contenedor seccion"> 
    <h1>Crear propiedad</h1>
    <a href="/admin/index.php"><input type="submit" value="Volver" class="boton-verde"></a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Título</label>
            <input type="text" placeholder="Título Propiedad" id="titulo" name="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" placeholder="Precio Propiedad" id="precio" name="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" placeholder="Ej: 3" id="habitaciones" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños</label>
            <input type="number" placeholder="Ej: 3" id="wc" min="1" max="9" name="wc" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" placeholder="Ej: 3" id="estacionamiento" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="vendedores_id" id="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($consultaVendedores)) : ?>
                    <option <?php echo $vendedor['id'] === $vendedorId ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>