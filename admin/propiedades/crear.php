<?php

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedor = 1;

        //insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio,descripcion,habitaciones,wc,estacionamiento,vendedores_id)
        VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$vendedor')";
        $resultado = mysqli_query($db, $query);


    }



    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion"> 
    <h1>Crear propiedad</h1>
    <a href="/BienesRaices/admin/index.php"><input type="submit" value="Volver" class="boton-verde"></a>
    <form class="formulario" method="POST" action="/BienesRaices/admin/propiedades/crear.php">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Título</label>
            <input type="text" placeholder="Título Propiedad" id="titulo" name="titulo">

            <label for="precio">Precio</label>
            <input type="number" placeholder="Precio Propiedad" id="precio" name="precio">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" placeholder="Ej: 3" id="habitaciones" min="1" max="9" name="habitaciones">

            <label for="wc">Baños</label>
            <input type="number" placeholder="Ej: 3" id="wc" min="1" max="9" name="wc">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" placeholder="Ej: 3" id="estacionamiento" min="1" max="9" name="estacionamiento">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="vendedores" id="vendedor">
                <option value="">-- Seleccione --</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton-verde">
    </form>
</main>
<?php
    incluirTemplate('footer');
?>