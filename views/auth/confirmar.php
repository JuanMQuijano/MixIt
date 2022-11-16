<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor-sm confirmar">
    <h1>Confirma tu cuenta</h1>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php echo $confirmar ? '
    <a href="/" class="boton">Iniciar Sesión</a>' : ''; ?>
</div>