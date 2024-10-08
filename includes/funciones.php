<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
//define ('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');



function incluirTemplate($nombre , $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}
function estaAutenticado() : bool {
    //session_start();
    $auth = $_SESSION['login'] ?? false;
    if(!$auth) {
        return true;
    }else{
        return false;
    }
}
function debugear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//escapa el html
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
