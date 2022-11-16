<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor tabla">

    <h1>
        Carrito <?php echo isset($_SESSION) ? 'de ' . $_SESSION['nombre'] : ''; ?>
    </h1>
    <table>
        <?php if (!$prendas) {
            include_once __DIR__ . '/../templates/alertas.php';
        } else { ?>
            <tr>
                <th>Nombre</th>
                <th class="mostrar">Descripcion</th>
                <th>Imagen</th>
                <th class="mostrar">Talla</th>
                <th class="mostrar">Tipo</th>
                <th>Precio</th>
                <th></th>
            </tr>

            <?php foreach ($prendas as $prenda) { ?>
                <tr>
                    <td><?php echo $prenda->nombre; ?></td>
                    <td class="mostrar"><?php echo $prenda->descripcion; ?></td>
                    <td><img src="/build/imgPrendas/<?php echo $prenda->imagen; ?>" alt="Imagen Prenda"></td>
                    <td class="mostrar"><?php echo $prenda->talla; ?></td>
                    <td class="mostrar"><?php echo $prenda->tipo; ?></td>
                    <td><?php echo $prenda->precio; ?></td>
                    <td>

                        <form method="post">
                            <input type="hidden" name="idCompra" value="<?php echo $prenda->idCompra; ?>">
                            <input type="image" value="Eliminar" class="boton eliminar" src="/build/img/trash.webp">
                        </form>

                    </td>
                </tr>
        <?php }
        } ?>
    </table>

    <?php
    if ($prendas) {
        $acum = 0;
        foreach ($prendas as $prenda) {
            $acum += $prenda->precio;
        }
    ?>
        <h1>Total a Pagar: $<?php echo $acum; ?></h1>
        <button class="boton-pagar" id="boton-pagar">Finalizar Compra</button>
    <?php } ?>
</div>