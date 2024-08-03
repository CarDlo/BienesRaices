<?php
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email">
                <label for="tel">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="tel">
            </fieldset>
            <fieldset>
                <legend>Mensaje</legend>
                <textarea></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre Propiedad</legend>
                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="vende">Vende</option>
                    <option value="compra">Compra</option>
                </select>
                <label for="presupuesto">Presupuesto</label>
                <input type="number" placeholder="Tu Presupuesto" id="presupuesto">
            </fieldset>
            <fieldset>
                <legend>Información sobre Propiedad</legend>
                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" name="email" id="contactar-email">
                    
                </div>
                <p>Si eligio teléfono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>


<?php
    incluirTemplate('footer');
?>