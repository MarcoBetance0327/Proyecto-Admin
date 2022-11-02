<!--
    @MARCO BETANCE
    Aquí se encuentra el formulario, se le agregan los valores de la base de datos, si existe información 
    guardada entonces los mostrara, al igual primero se sanitiza los textos introducidos para evitar inyección 
    de código que pueda perjudicar el sistema
-->

<fieldset class="form-crear">
    <label for="nombre">Nombre del Proveedor</label>
    <input type="text" placeholder="Nombre" id="nombre" name="proveedor[nombre]" class="input-info"  required value="<?php echo s($proveedor->nombre); ?>">

    <label for="precio">Teléfono</label>
    <input type="number" placeholder="Telefono" min="30" id="inventario" name="proveedor[telefono]" class="input-info" required value="<?php echo s($proveedor->telefono); ?>">

    <label for="precio">Dirección</label>
    <input type="text" placeholder="Dirección" min="30" id="precio" name="proveedor[direccion]" class="input-info" required value="<?php echo s($proveedor->direccion); ?>">

    <!--<label for="tipo">Tipo de Sushi</label>
    <select name="comidas[tipo]" id="tipo">
        <option selected value="">-- Seleccione --</option>
        <option value="empanizado">Empanizado</option>
        <option value="tropical">Tropical</option>
        <option value="frio">Frio</option>
    </select> -->
</fieldset>