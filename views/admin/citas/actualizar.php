<main class="contenedor seccion">
    <a href="/admin/usuarios" class="boton boton-verde">Volver</a>   
    <form class="formulario"  method="post">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Usuario</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="usuario" value="<?php echo $usuarioLogin->usuario ?>" disabled>
            <label for="mensaje">Motivo de la Cita:</label>
            <textarea id="mensaje" name="motivo_cita" ><?php echo $cita->motivo_cita ?></textarea>
            <label for="fecha">Fecha de la Cita</label>
            <input type="date" id="fecha" name="fecha_cita" value="<?php echo $cita->fecha_cita ?>">
        </fieldset>
        <input type="submit" value="Actualizar Cita" class="boton-verde">
    </form>
</main>
