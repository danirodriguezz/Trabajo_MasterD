<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <?php include "iconos.php"?>
</main>
<section class="seccion contenedor">
    <h2>Casas Y Departamentos en Venta </h2>
    <?php
        include "listado.php";
    ?>
    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuntra la casa de tus sueños</h2>
    <p>Llena el formulario para pedir cita con un asesor</p>
    <a href="/citaciones" class="boton-amarillo-inline-block">Pide Cita</a>
</section>
<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <?php 
            include_once __DIR__ . "/listado-noticias.php";
        ?>
    </section>
    <section class="testimoniales">
        <h3>Testimonios</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una exelente forma, muy buena atención y la casa que me ofrecieron cumple todas mis expectativas
            </blockquote>
            <p>- Daniel Rodriguez Alonso</p>
        </div>
    </section>
</div>