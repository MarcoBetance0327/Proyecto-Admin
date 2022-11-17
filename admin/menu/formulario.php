<fieldset class="form-crear">
    <label for="nombre">Nombre del Producto</label>
    <input type="text" placeholder="Nombre" id="nombre" name="producto[nombre]" class="input-info"  required value="<?php echo s($producto->nombre); ?>">

    <label for="precio">Inventario</label>
    <input type="number" placeholder="Inventario" id="inventario" name="producto[inventario]" class="input-info" required value="<?php echo s($producto->inventario); ?>">

    <label for="precio">Precio</label>
    <input type="number" placeholder="Precio" id="precio" name="producto[precio]" class="input-info" required value="<?php echo s($producto->precio); ?>">

    <label for="codigo">Código de Barras</label>
    <input type="number" placeholder="Código" id="codigo" name="producto[codigo]" class="input-info"  required value="<?php echo s($producto->codigo); ?>">

    <label for="proveedor">Proveedor</label>
    <select name="producto[id_proveedor]" id="id_proveedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($proveedores as $proveedor) { ?>
            <option <?php echo $producto->id_proveedor === $proveedor->id ? 'selected' : '' ?> value="<?php echo s($proveedor->id); ?>"><?php echo s($proveedor->nombre)?>
        <?php  } ?>
    </select> 
</fieldset>