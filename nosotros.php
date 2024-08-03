<?php
    $inicio = false;
    include './includes/templates/header.php';
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
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.htm">Nosotros</a>
                <a href="anuncios.html">Anuncios</a>
                <a href="blog.html">Blog</a>
                <a href="contacto.html">Contacto</a>
            </nav>
            <p class="copyright">Todos los Derechos Reservados 2024 &copy;</p>
        </div>
    </footer>
    <script src="build/js/bundle.min.js"></script>
</body>
</html>