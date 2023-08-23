<main class="contenedor seccion">
        <h1>Pida Una Cita</h1>
        <?php if($mensaje) {
                echo "<p class = 'alerta correcto'>" . $mensaje . "</p>";
            }?>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de Contacto">
        </picture>
        <h2>Llene el formulario de Contacto</h2>
        <?php 
            include_once __DIR__ . "/../templates/alertas.php";
        ?>
        <form class="formulario" action="/citaciones" method="post">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Usuario</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="usuario" value="<?php echo $_SESSION["usuario"] ?? ""?>" disabled>
                <label for="mensaje">Motivo de la Cita:</label>
                <textarea id="mensaje" name="motivo_cita" ><?php echo $cita->motivo_cita ?></textarea>
                <label for="fecha">Fecha de la Cita</label>
                <input type="date" id="fecha" name="fecha_cita" min="<?php  echo date("Y-m-") . date("d")+1; ?>" value="<?php echo $cita->fecha_cita ?>">
            </fieldset>
            <input type="submit" value="Pedir Cita" class="boton-verde">
        </form>
</main>