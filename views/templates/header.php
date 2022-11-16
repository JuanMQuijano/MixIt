<header>
    <div class="clear">
        <h1><a href="/">Mix-It</a></h1>

        <div id="btnMenu" class="btnMenu"></div>
    </div>

    <nav id="navBar">
        <?php echo isset($_SESSION['login']) ? '        
        <a href="/mis-prendas">Vende</a>        
        <a href="/carrito"><img src="/build/img/carrito.webp" alt="Icono Carrito"></a>
        <a href="/cerrar-sesion">Cerrar Sesión</a>
        ' : ($login ? '     
        <a href="/">Inicio</a>
                <a href="">Hombre</a>
                <a href="">Mujer</a>
        ' :
            '
            <a href="">Hombre</a>
            <a href="">Mujer</a>
            <a href="/iniciar-sesion">Iniciar Sesión</a>
            <a href="/crear-cuenta">Registrarse</a>
        '); ?>
    </nav>
</header>