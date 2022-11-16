<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor olvide">
    <h1>¿Olvidaste tu contraseña?</h1>
    <p>Ingresa tu correo para recibir instrucciones</p>

    <form class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <div class="campo">
            <label for="email">Correo</label>
            <input type="email" name="correo" id="email" placeholder="Ingresa Tú Correo">
        </div>

        <input type="submit" value="Recuperar Contraseña">

    </form>
</div>