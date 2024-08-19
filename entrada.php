<?php
    require 'includes/app.php';

    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Anuncio casa">
        </picture>
        <P class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></P>
        <div class="resumen-propiedad">


            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolores, saepe sapiente exercitationem maxime laboriosam quos, cum provident iure sit velit, fugiat rem corporis facilis enim repellat consequatur quam assumenda.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, quia quas blanditiis adipisci dolorum, esse id pariatur accusamus laborum voluptatem ratione suscipit, sunt possimus recusandae et ut eaque. Similique, doloribus.consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
        </div>
    </main>
<?php
    incluirTemplate('footer');
?>