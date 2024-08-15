<?php
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    $id = $_GET['id'];

    if(!filter_var($id, FILTER_VALIDATE_INT)) {
    header('Location: /admin/');
    exit;
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // consulta para tener los datos d ela propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = " . $id;
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);




    //consultar para tener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $consultaVendedores = mysqli_query($db, $consulta);

    //Arreglo con mensajes de error
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedores_id'];
    $imagenPropiedad = $propiedad['imagen'];

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
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Título</label>
            <input type="text" placeholder="Título Propiedad" id="titulo" name="titulo" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" placeholder="Precio Propiedad" id="precio" name="precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="No tiene Imagen"  class="imagen-actualizar">

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
            <select name="vendedor" id="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($consultaVendedores)) : ?>
                    <option <?php echo $vendedor['id'] === $vendedorId ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </fieldset>
        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>