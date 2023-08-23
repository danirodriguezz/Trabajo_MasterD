<main class="contenedor seccion resumen-propiedad">
        <h1><?php echo $propiedad->titulo; ?></h1>
            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de Anuncio">
        <p class="precio"><?php echo $propiedad->precio; ?> &nbsp; &euro;</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de caracteristicas">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
        </ul>
        <p>
            <?php echo $propiedad->descripcion; ?>
        </p>
</main>