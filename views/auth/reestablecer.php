<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor olvide">
    <h1>Reestablecer contraseña</h1>
    <p>Ingresa una nueva contraseña</p>

    <form class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if ($mostrar) { ?>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Ingresa Tú Contraseña">
            </div>

            <input type="submit" value="Actualizar Contraseña">
        <?php } ?>
    </form>
</div>