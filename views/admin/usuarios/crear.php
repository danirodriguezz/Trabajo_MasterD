<main class="contenedor seccion contenido-centrado">
    <h1>Crea un Usuario</h1>
    <?php include_once __DIR__ . "/../../templates/alertas.php" ?>
    <a href="/admin/usuarios" class="boton boton-verde">Volver</a>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Informacion del Usuario</legend>
            <label for="nombre">Nombre <span class="campo-obligatorio">*</span></label>
            <input type="text" name="nombre" placeholder="Tu nombre" id="nombre" value="<?php echo $usuario->nombre ?? "" ?>">
            <label for="apellido">Apellido <span class="campo-obligatorio">*</span></label>
            <input type="text" name="apellido" placeholder="Tu Apellido" id="apellido" value="<?php echo $usuario->apellido ?? "" ?>">
            <label for="email">E-mail <span class="campo-obligatorio">*</span></label>
            <input type="email" name="email" placeholder="Tu E-mail" id="email" value="<?php echo $usuario->email ?? "" ?>">
            <label for="telefono">Teléfono <span class="campo-obligatorio">*</span></label>
            <input type="number" name="telefono" placeholder="Tu número de Teléfono" id="telefono" value="<?php echo $usuario->telefono ?? "" ?>">
            <label for="fecha">Fecha de Nacimiento <span class="campo-obligatorio">*</span></label>
            <input type="date" name="fecha_nacimiento" placeholder="Tu Fecha de Nacimiento" id="fecha" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $usuario->fecha_nacimiento ?? "" ?>">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" placeholder="Tu Direccion" id="direccion" value="<?php echo $usuario->direccion ?? "" ?>">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo">
                <option value="" disabled selected>-- Selecione --</option>
                <option value="masculino" <?php if ($usuario->sexo === "masculino") echo "selected" ?>>Masculino</option>
                <option value="femenino" <?php if ($usuario->sexo === "femenino") echo "selected" ?>>Femenino</option>
            </select>
        </fieldset>
        <fieldset>
            <legend>Informacion para Iniciar Sesion</legend>
            <label for="usuario">Nombre de Usuario <span class="campo-obligatorio">*</span></label>
            <input type="text" name="usuario" placeholder="Escribe un nombre de usuario" id="usuario" value="<?php echo $usuario_login->usuario ?? "" ?>">
            <label for="password">Paswword <span class="campo-obligatorio">*</span></label>
            <input type="password" name="password" placeholder="Escribe una Contraseña" id="password">
            <label for="rol">Tipo de Usuario &nbsp;(<span class="notificaciones">Si no elige ninguno se le asignara el rol de usuario</span>)</label>
            <select name="rol" id="rol">
                <option value="" disabled selected>-- Selecione --</option>
                <option value="user" <?php if ($usuario_login->rol === "user") echo "selected" ?> >Usuario</option>
                <option value="admin" <?php if ($usuario_login->rol === "admin") echo "selected" ?> >Administrador</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Cuenta" class="boton-verde">
    </form>
</main>