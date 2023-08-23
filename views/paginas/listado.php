<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio">
        
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo;?></h3>
            <p class="contenido-anuncio-descripcion"><?php echo $propiedad->descripcion;?></p>
            <p class="precio"><?php echo $propiedad->precio;?>&nbsp; &euro;</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad->wc;?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad->habitaciones;?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono de caracteristicas">
                    <p><?php echo $propiedad->estacionamiento;?></p>
                </li>
            </ul>
            <a href="/propiedad?id=<?php echo $propiedad->id;?>" class="boton boton-amarillo">
                Ver propiedad
            </a>
        </div><!-- contenido-anuncio -->
    </div><!--anuncio-->
    <?php endforeach;?>
</div><!--contenedor-anuncios-->