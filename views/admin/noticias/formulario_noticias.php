<fieldset>
    <legend>Infomación General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titutlo Noticia" value="<?php echo s($noticia->titulo); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
    <?php if($noticia->imagen):?>
        <img src="/imagenes/<?php echo $noticia->imagen ?>" alt="Imagen de noticia" class="imagen-small">
    <?php endif ?>

    <label for="descripcion">texto:</label>
    <textarea id="descripcion" name="texto"><?php echo s($noticia->texto); ?></textarea>
</fieldset>
