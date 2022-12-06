<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" placeholder="nombre" name="nombre" value="<?php echo $servicio->nombre ?? 'nombre'; ?>" />

</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input type="text" id="precio" placeholder="precio" name="precio" value="<?php echo $servicio->precio ?? 'precio';  ?>" />
</div>