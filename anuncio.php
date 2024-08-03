<?php
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada.jpg" alt="Anuncio casa">
        </picture>

        <div class="resumen-propiedad">

            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p>3</p>
                </li>
                <li>    
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>    
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                    <p>4</p>
                </li>   
            </ul>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita dolores, saepe sapiente exercitationem maxime laboriosam quos, cum provident iure sit velit, fugiat rem corporis facilis enim repellat consequatur quam assumenda.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, quia quas blanditiis adipisci dolorum, esse id pariatur accusamus laborum voluptatem ratione suscipit, sunt possimus recusandae et ut eaque. Similique, doloribus.consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
        </div>
    </main>
<?php
    incluirTemplate('footer');
?>