<?php


if(!isset($_SESSION)){
    session_start();
}
$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Bienes Raices</title>
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php"><img src="/build/img/logo.svg" alt="Bienes Raices"> </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Dark mode">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth) { ?>
                            <a href="cerrar-sesion.php">Cerrar sesión</a>
                        <?php }; ?>
                    </nav>
                </div>
            </div>
            <?php if($inicio==true) { ?>
                <h1>Venta de Casas y Departamentos</h1>
            <?php } ?>
        </div>
    </header>