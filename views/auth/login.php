<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor login">
    <h1>Inicia Sesión</h1>
    <form class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <div class="campo">
            <label for="email">Correo</label>
            <input type="email" name="correo" id="email" placeholder="Ingresa Tú Correo" value="<?php echo $usuario->correo; ?>">
        </div>

        <div class="campo">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="password" id="contraseña" placeholder="Ingresa Tú Contraseña">
        </div>

        <input type="submit" value="Iniciar Sesión">

        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </form>
</div>