<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php 
            if($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado));
                if($mensaje) { ?>
                    <p class="alerta correcto"><?php echo s($mensaje) ?></p> 
                    <?php }
                } 
        ?>
        <div class="acciones">
            <div class="propiedades-noticias">
                <a href="/admin/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
                <a href="/admin/noticias/crear" class="boton boton-amarillo-inline-block">Nueva Noticia</a>
            </div>
            <div class="usuarios">
                <a href="/admin/usuarios" class="boton boton-verde">Usuarios</a>
            </div>
        </div>
        
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $propiedades as $propiedad ): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de Propiedad" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio; ?>&nbsp; &euro;</td>
                    <td>
                        <form method="POST" action="/admin/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Noticias</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $noticias as $noticia ): ?>
                <tr>
                    <td><?php echo $noticia->id; ?></td>
                    <td><?php echo $noticia->titulo ?></td>
                    <td><img src="../imagenes/<?php echo $noticia->imagen; ?>" alt="Imagen de Noticia" class="imagen-tabla"></td>
                    <td><?php echo $noticia->fecha; ?></td>
                    <td>
                        <form method="POST" action="/admin/noticias/eliminar">
                            <input type="hidden" name="id" value="<?php echo $noticia->id ?>">
                            <input type="hidden" name="tipo" value="noticia">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                        <a href="/admin/noticias/actualizar?id=<?php echo $noticia->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>