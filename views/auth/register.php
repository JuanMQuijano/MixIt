<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="contenedor register">
    <h1>Crea Tu cuenta</h1>
    <form class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Ingresa Tú Nombre" value="<?php echo $usuario->nombre; ?>">
        </div>

        <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Ingresa Tú Apellido" value="<?php echo $usuario->apellido; ?>">
        </div>

        <div class="campo">
            <label for="email">Correo</label>
            <input type="email" name="correo" id="email" placeholder="Ingresa Tú Correo" value="<?php echo $usuario->correo; ?>">
        </div>

        <div class="campo">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="password" id="contraseña" placeholder="Ingresa Tú Contraseña">
        </div>

        <div class="campo">
            <label for="contraseña2">Confirma la Contraseña</label>
            <input type="password" name="password2" id="contraseña2" placeholder="Ingresa Nuevamente Contraseña">
        </div>

        <input type="submit" value="Crear Cuenta">

        <div class="acciones">
            <a href="/iniciar-sesion">¿Ya tienes cuenta? Inicia Sesión</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </form>
</div>