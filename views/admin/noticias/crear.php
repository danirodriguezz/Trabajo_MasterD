<main class="contenedor seccion">
        <h1>Crear Una Noticia</h1>
        <!-- Alerta de errores -->
        <?php include_once __DIR__ . "/../../templates/alertas.php"?>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <!-- Fin Alerta Errores -->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . "/formulario_noticias.php"?>
            <input type="submit" value="Crear Noticia" class="boton boton-verde">
        </form>
</main>