<?php include_once __DIR__ . '/../templates/header.php'; ?>


<div class="contenedor-sm alertaprenda">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
</div>

<div class="contenedor prenda">
    <img src="/build/imgPrendas/<?php echo $prenda->imagen; ?>" alt="Imagen Prenda">

    <div>
        <h1><?php echo $prenda->nombre; ?></h1>
        <p><span>Descripción: </span><?php echo $prenda->descripcion; ?></p>
        <p><span>Talla: </span><?php echo $prenda->talla; ?></p>
        <p><span>Tipo de Prenda: </span><?php echo $prenda->tipo; ?></p>
        <p><span>Precio: </span><?php echo $prenda->precio; ?></p>

        <form method="POST">
            <input class="boton" type="submit" value="Agregar Al Carrito">
        </form>
    </div>
</div>