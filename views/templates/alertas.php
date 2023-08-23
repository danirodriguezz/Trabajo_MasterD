<!-- Notificacion de Alertas -->
<?php
foreach($errores as $key => $mensajes) {
    foreach($mensajes as $mensaje) {
        ?>
        <div class="alerta <?php echo $key?>">
            <?php echo $mensaje;?>
        </div>
        <?php
    }
}
?>