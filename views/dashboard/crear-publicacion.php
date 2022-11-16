<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor register crear">
    <h1>Crear Publicación</h1>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingresa Un Nombre" value="<?php echo $prenda->nombre; ?>">
        </div>

        <div class="campo">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Ingresa Una Descripcion" value="<?php echo $prenda->descripcion; ?>">
        </div>

        <div class="campo">
            <label for="imagen">Imagen</label>
            <input type="file" accept="image/png, image/jpeg" name="imagen" id="imagen">
        </div>

        <div class="campo">
            <label for="talla">Talla</label>
            <input type="text" name="talla" id="talla" placeholder="Ingresa Una Talla" value="<?php echo $prenda->talla; ?>">
        </div>


        <div class="campo">
            <label for="tipo">Tipo de Prenda</label>
            <select name="tipo" id="tipo">
                <option value="" selected disabled>SELECCIONA UN TIPO DE PRENDA</option>
                <option value="camisa">CAMISA</option>
                <option value="pantalon">PANTALON</option>
                <option value="zapatos">ZAPATOS</option>
                <option value="chaqueta">CHAQUETA</option>
                <option value="hoodie">HOODIE</option>
            </select>
        </div>

        <div class="campo">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Ingresa Un Precio" value="<?php echo $prenda->precio; ?>">
        </div>

        <input type="submit" value="Crear Publicación">
    </form>
</div>