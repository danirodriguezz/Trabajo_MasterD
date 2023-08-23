<?php 
    $fehchaActual = new DateTime(date("Y-m-d"));
?>

<main class="contenedor seccion">
    <h1>Tu Perfil</h1>
    <?php 
        if($_GET["resultado"]) {
            $mensaje = mostrarNotificacion(intval($_GET["resultado"]));
            if($mensaje) { ?>
                <p class="alerta correcto"><?php echo s($mensaje) ?></p> 
                <?php }
        } 
    ?>
    <picture>
            <source srcset="build/img/encuentra.webp" type="image/webp">
            <source srcset="build/img/encuentra.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/encuentra.jpg" alt="Imagen de Contacto">
    </picture>
    <div class="informacion-usuario">
        <div class="columna">
            <p>Nombre: <span><?php echo $usuario->nombre?></span></p>
            <p>Apellido: <span><?php echo $usuario->apellido?></span></p>
            <p>Email: <span><?php echo $usuario->email?></span></p>
        </div>
        <div class="columna">
            <p>Telefono: <span><?php echo $usuario->telefono?></span></p>
            <p>Fecha de Nacimiento: <span><?php echo $fechaFormateada?></span></p>
            <p>Direccion: <span><?php echo $usuario->direccion?></span></p>
        </div>
    </div>
    <div class="actualizar">
        <a href="/perfil/actualizar" class="boton-amarillo-inline-block">Actualiza Tus Datos</a>
    </div>
    <section class="citas">
        <h2>Tus Citas</h2>

        <div class="citas-pendientes">
            <h3>Tus Citas Pendientes</h3>
            <?php foreach($citas as $cita):?>
                <?php 
                    $fechaCita = new DateTime($cita->fecha_cita);
                    if($fechaCita >= $fehchaActual):
                ?>
                    <?php 
                        $timestamp = strtotime($cita->fecha_cita);
                        $fechaFormateada = date("d-m-Y", $timestamp);
                    ?>
                    <p class="fechaCita"><span>Fecha de la Cita:</span> <?php echo $fechaFormateada ?></p>
                    <p class="motivoCita"><span>Motivo de la Cita:</span> <?php echo $cita->motivo_cita ?></p>
                    <div class="acciones">
                        <a href="/citaciones/actualizar?id=<?php echo $cita->id ?>" class="boton-amarillo">Actualizar</a>
                        <form action="/citaciones/eliminar" method="POST" class="formulario-perfil">
                            <input type="hidden" name="id" value="<?php echo $cita->id ?>"">
                            <input type="submit" class="boton-rojo-block" value="Eliminar Cita">
                        </form>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="citas-pasadas">
            <h3>Tus Citas Pasadas</h3>
            <p class="descripcion-cita">Estas Citas ya no las puedes eliminar</p>
            <?php foreach($citas as $cita):?>
                <?php 
                    $fechaCita = new DateTime($cita->fecha_cita);
                    if($fechaCita < $fehchaActual):
                ?>
                    <?php 
                        $timestamp = strtotime($cita->fecha_cita);
                        $fechaFormateada = date("d-m-Y", $timestamp);
                    ?>
                    <p class="fechaCita"><span>Fecha de la Cita:</span> <?php echo $fechaFormateada ?></p>
                    <p class="motivoCita"><span>Motivo de la Cita:</span> <?php echo $cita->motivo_cita ?></p>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </section>
</main>