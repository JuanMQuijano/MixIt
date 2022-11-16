<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor mis-publicaciones">
    <a href="/crear-publicacion" class="boton">Crear Publicación</a>
    <h1>Mis Publicaciones</h1>

    <div class="prendas">
        <?php if (!$prendas) { ?>
            <h1>Aún no tienes publicaciones, crea una!</h1>
            <?php } else {
            foreach ($prendas as $prenda) { ?>
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
                        <a href="/actualizar-publicacion?url=<?php echo $prenda->url; ?>" class="boton">Actualizar</a>
                        <form method="post">
                            <input type="hidden" name="url" value="<?php echo $prenda->url; ?>">
                            <input type="submit" value="Eliminar" class="boton eliminar">
                        </form>
                    </div>

                </div>
        <?php }
        } ?>
    </div>
</div>