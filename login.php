<?php
require 'includes/app.php';

$db = conectarDB();

$errores=[];
//autenticar el usuario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
//Sanitizando los datos
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if(!$password) {
        $errores[] = "El password es obligatorio";
    }

    if(empty($errores)) {
        //revisar si el usuario existe

        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
        if($resultado->num_rows) {
            //revisar si el password es correcto

            $usuario = mysqli_fetch_assoc($resultado);
            $auth = password_verify($password, $usuario['password']);
            if($auth) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['email'] = $usuario['email'];
                header('Location: /admin');
            } else {
                $errores[] = "El password es incorrecto";
            }

        } else {
            $errores[] = "El usuario no existe";
        }

}
}

//incluye header

    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado"> 
    <h1>Iniciar Sesión</h1>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="" >
    <fieldset>
                <legend>Email y password</legend>

                <label for="email">E-mail</label>
                <input name="email" type="email" placeholder="Tu E-mail" id="email" required>
                <label for="password">Password</label>
                <input name="password" type="password" placeholder="Tu Password" id="password" required>
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>