<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["login"] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo MasterD</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logotipo" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="barras del menu responsive">
                </div>
                <nav class="navegacion">
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Noticias</a>
                    <?php if (isAuth()) : ?>
                        <a href="/citaciones">Citaciones</a>
                    <?php endif ?>
                    <a href="/login">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="43" height="43" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>
                    </a>

                    <?php if ($auth) : ?>
                        <a href="/logout" class="boton-rojo-margin0">Cerrar sesión</a>
                    <?php endif ?>
                    <?php if (isAdmin()) : ?>
                        <a href="/admin" class="boton-verde-margin0">Administrar</a>
                    <?php endif ?>
                </nav>
            </div> <!-- barra -->
            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos</h1>
            <?php } ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Noticias</a>
                <a href="/citaciones">Citaciones</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos Reservados <?php echo date("Y"); ?> &copy;</p>
    </footer>
    <script src="/build/js/app.js"></script>
</body>

</html>