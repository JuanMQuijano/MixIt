<?php include_once __DIR__ . '/templates/header.php'; ?>

<div class="banner">
    <div class="banner-content">
        <p>Vende y compra tú estilo</p>
        <p>A tú estilo</p>
    </div>
</div>

<div class="contenedor mis-publicaciones">
    <h1>Ultimas Publicaciones</h1>
    <div class="prendas">
        <?php foreach ($prendas as $prenda) { ?>
            <div class="prenda">
                <img src="/build/imgPrendas/<?php echo $prenda->imagen; ?>" alt="Imagen Prenda">

                <h1><?php echo $prenda->nombre; ?></h1>
                <p><?php echo $prenda->descripcion; ?></p>

                <div class="clear">
                    <p>Talla: <?php echo $prenda->talla; ?></p>
                    <p>Tipo: <?php echo $prenda->tipo; ?></p>
                    <p>Precio: $<?php echo $prenda->precio; ?></p>
                </div>

                <div class="acciones">
                    <a href=""></a>
                    <a href="/prenda?url=<?php echo $prenda->url; ?>" class="boton ver">Ver</a>
                </div>

            </div>
        <?php
        } ?>
    </div>
</div>
</div>