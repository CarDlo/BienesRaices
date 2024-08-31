<?php
    require '../../includes/app.php';

    use App\propiedad;

    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }
    //Base de datos

    $db = conectarDB();

    $propiedad = new propiedad();

    //consultar para tener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $consultaVendedores = mysqli_query($db, $consulta);

    //Arreglo con mensajes de error
    $errores = propiedad::getErrores();



    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $propiedad = new propiedad($_POST['propiedad']);

        //debugear($_FILES['propiedad']);

        //generar nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        //setear la imagen

       //debugear($_FILES['propiedad']['tmp_name']['imagen']);

        //debugear($_FILES['propiedad']['tmp_name']['imagen']);

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }



        //validar
        $errores = $propiedad->validar();
        //debugear($errores);

        //Revisar que el array de errores este vacio
        if(empty($errores)) {

            

            //crear carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //guardar en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $resultado=$propiedad->guardar();
           //debugear($resultado);
            
           //redireccionar al usuario
           header('Location: /admin?mensaje=1');
            

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
        

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>