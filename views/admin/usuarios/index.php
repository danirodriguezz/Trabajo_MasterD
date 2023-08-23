<main class="contenedor seccion">
    <h1>Administrador de Usuarios y Citas</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta correcto"><?php echo s($mensaje) ?></p>
    <?php }
    }
    ?>
    <div class="acciones">
        <div class="propiedades-noticias">
            <a href="/admin/usuarios/crear" class="boton boton-verde">Nueva Usuario</a>
            <a href="/admin/citas/crear" class="boton boton-amarillo-inline-block">Asignar Cita</a>
        </div>
        <div class="usuarios">
            <a href="/admin" class="boton boton-verde">Volver</a>
        </div>
    </div>

    <h2>Usuarios</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->id; ?></td>
                    <td><?php echo $usuario->nombre; ?></td>
                    <td><?php echo $usuario->apellido; ?></td>
                    <td><?php echo $usuario->email; ?></td>
                    <td>
                        <form method="POST" action="/admin/usuarios/eliminar">
                            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            <input type="hidden" name="tipo" value="user">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/usuarios/actualizar?id=<?php echo $usuario->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Administradores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuariosAdmin as $usuarioAdmin) : ?>
                <?php
                if ($idUser != $usuarioAdmin->id) :
                ?>
                    <tr>
                        <td><?php echo $usuarioAdmin->id; ?></td>
                        <td><?php echo $usuarioAdmin->nombre; ?></td>
                        <td><?php echo $usuarioAdmin->apellido; ?></td>
                        <td><?php echo $usuarioAdmin->email; ?></td>
                        <td>
                            <form method="POST" action="/admin/usuarios/eliminar">
                                <input type="hidden" name="id" value="<?php echo $usuarioAdmin->id; ?>">
                                <input type="hidden" name="tipo" value="admin">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                            </form>
                            <a href="/admin/usuarios/actualizar?id=<?php echo $usuarioAdmin->id; ?>" class="boton-amarillo">Actualizar</a>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Citas</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID del usuario</th>
                <th>Fecha de la Cita</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita) : ?>
                <tr>
                    <td><?php echo $cita->id; ?></td>
                    <td><?php echo $cita->idUser ?></td>
                    <td><?php echo $cita->fecha_cita; ?></td>
                    <td>
                        <form method="POST" action="/admin/citas/eliminar">
                            <input type="hidden" name="id" value="<?php echo $cita->id ?>">
                            <input type="hidden" name="tipo" value="noticia">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/citas/actualizar?id=<?php echo $cita->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>