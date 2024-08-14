<?php

//importar conexion

require 'includes/config/database.php';
$db = conectarDB();

//crear un email usuario

$email = 'correo@example.com';
$password = '123456';

//hash password
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//query para crear usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash')";
mysqli_query($db, $query);

echo $query;
