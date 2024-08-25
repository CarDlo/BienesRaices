<fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Título</label>
            <input type="text" placeholder="Título Propiedad" id="titulo" name="titulo" value="<?php echo s( $propiedad->titulo); ?>">

            <label for="precio">Precio</label>
            <input type="number" placeholder="Precio Propiedad" id="precio" name="precio" value="<?php echo s( $propiedad->precio ); ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            <?php if( $propiedad->imagen ): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-actualizar">
            <?php endif; ?>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo s( $propiedad->descripcion ); ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" placeholder="Ej: 3" id="habitaciones" min="1" max="9" name="habitaciones" value="<?php echo s( $propiedad->habitaciones ); ?>">

            <label for="wc">Baños</label>
            <input type="number" placeholder="Ej: 3" id="wc" min="1" max="9" name="wc" value="<?php echo s( $propiedad->wc ); ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" placeholder="Ej: 3" id="estacionamiento" min="1" max="9" name="estacionamiento" value="<?php echo s( $propiedad->estacionamiento ); ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
      
        </fieldset>