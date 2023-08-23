<?php foreach($noticias as $noticia):?>
<!-- Entrada blog -->
<article class="entrada-blog">
    <div class="imagen">
        <picture>
            <img loading="lazy" src="imagenes/<?php echo $noticia->imagen ?>" alt="Imagen entrada blog">
        </picture>
    </div>
    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $noticia->id ?>">
            <h4><?php echo $noticia->titulo ?></h4>
            <p>Escrito el: <span><?php echo $noticia->fecha ?></span> por: <span>Admin</span></p>
            <p class="texto-entrada-descripcion"><?php echo $noticia->texto ?></p>
        </a>
    </div>
</article>
<!-- Fin entrada blog -->
<?php endforeach ?>