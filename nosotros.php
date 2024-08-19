<?php
    require 'includes/app.php';

    incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Conoce sobre nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio dolore sunt, sit vitae, quibusdam debitis tempore quam illum libero ipsum veritatis tenetur doloremque exercitationem quas. Voluptatibus impedit similique suscipit ab?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odio porro sit repellendus beatae magnam laudantium qui distinctio recusandae, quisquam unde omnis, iure at doloremque accusantium voluptas quasi hic cum!</p>
            </div>
        </div>
    </main>
    <section class="contenedor">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
        </div>
    </section>
<?php
    incluirTemplate('footer');
?>