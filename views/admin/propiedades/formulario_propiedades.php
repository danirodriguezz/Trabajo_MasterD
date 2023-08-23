<fieldset>
    <legend>Infomación General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titutlo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">
    
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
    <?php if($propiedad->imagen):?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de propiedad" class="imagen-small">
    <?php endif ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
    type="number" 
    id="habitaciones" 
    name="habitaciones" 
    value="<?php echo s($propiedad->habitaciones); ?>" 
    placeholder="Número Habitaciones" 
    min="1" 
    max="10">

    <label for="wc">Baños:</label>
    <input 
    type="number" 
    id="wc" 
    name="wc" 
    placeholder="Número Baños" 
    value="<?php echo s($propiedad->wc); ?>" 
    min="1" 
    max="10">

    <label for="estacionamiento">Estacionamiento:</label>
    <input 
    type="number" 
    id="estacionamiento" 
    name="estacionamiento" 
    value="<?php echo s($propiedad->estacionamiento); ?>" 
    placeholder="Número Estacionamiento" 
    min="1" 
    max="10">
</fieldset>
