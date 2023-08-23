<main class="contenedor seccion">
    <h2>Llene el Formulario de Citas</h2>
    <?php
    include_once __DIR__ . "/../../templates/alertas.php";
    ?>
    <form class="formulario" method="post">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Usuario</label>
            <select name="idUser" id="usuario">
                <option value="" disabled selected>-- Selecione --</option>
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?php echo $usuario->idUser ?>"><?php echo $usuario->usuario ?></option>
                <?php endforeach ?>
            </select>
            <label for="mensaje">Motivo de la Cita:</label>
            <textarea id="mensaje" name="motivo_cita"><?php echo $cita->motivo_cita ?></textarea>
            <label for="fecha">Fecha de la Cita</label>
            <input type="date" id="fecha" name="fecha_cita" min="<?php echo date("Y-m-") . date("d") + 1; ?>" value="<?php echo $cita->fecha_cita ?>">
        </fieldset>
        <input type="submit" value="Pedir Cita" class="boton-verde">
    </form>
</main>