<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <!-- Alerta de errores -->
    <?php if ($_GET["resultado"]) : ?>
        <div class="alerta correcto">
            Todo ha salido correctamente Inicia Sesion
        </div>
    <?php endif ?>
    <?php
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Usuario y Password</legend>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" placeholder="Tu nombre de Usuario" id="usuario">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton-verde">
    </form>

    <div class="accion">
        <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
    </div>
</main>