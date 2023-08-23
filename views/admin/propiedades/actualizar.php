<main class="contenedor seccion">
        <h1>Actualiza la Propiedad</h1>
        <!-- Alerta de errores -->
        <?php include_once __DIR__ . "/../../templates/alertas.php"?>
        <a href="/admin" class="boton boton-verde">Volver</a>
        <!-- Fin Alerta Errores -->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . "/formulario_propiedades.php"?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
</main>