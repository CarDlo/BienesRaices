<?php
require 'includes/app.php';
function incluirTemplate($nombre , $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}