<?php
require 'funciones.php';
require 'config\database.php';
require __DIR__ . '/../vendor/autoload.php';

$db = conectarDB();

use App\propiedad;


propiedad::setDB($db);