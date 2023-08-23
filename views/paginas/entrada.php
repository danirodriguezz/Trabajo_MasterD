<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $noticia->titulo ?></h1>
        <picture>
            <img src="imagenes/<?php echo $noticia->imagen?>" alt="Imagen de Blog">
        </picture>
        <p>Escrito el: <span><?php echo $noticia->fecha ?></span> por: <span>Admin</span></p>
        <p><?php echo $noticia->texto ?></p>
</main>