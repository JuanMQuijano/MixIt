<?php

namespace Controllers;

use Model\Prenda;
use Model\Compras;
use Model\PrendaCompras;
use MVC\Router;

class CarritoController
{
    public static function index(Router $router)
    {
        isNotLogged();
        $alertas = [];

        $sql = "SELECT p.id, p.nombre, p.descripcion, p.imagen, ";
        $sql .= "p.talla, p.tipo, p.precio, p.url, p.idUsuario, ";
        $sql .= "c.id as idCompra FROM prendas as p INNER JOIN compras as c ";
        $sql .= "ON p.id = c.idPrenda WHERE c.idUsuario = " . $_SESSION['id'];

        $prendas = PrendaCompras::SQL($sql);

        if (!$prendas) $alertas = PrendaCompras::setAlerta('error', 'Aún no tienes productos agregados');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenda = Compras::find($_POST['idCompra']);

            $prenda->eliminarCarrito();

            header('Location: /carrito');
        }

        $alertas = PrendaCompras::getAlertas();
        $router->render('carrito/index', [
            'titulo' => 'Carrito',
            'alertas' => $alertas,
            'prendas' => $prendas
        ]);
    }

    public static function prenda(Router $router)
    {
        $alertas = [];
        $url = $_GET['url'];

        if (!$url) header('Location: /');

        $prenda = Prenda::where('url', $url);

        $carrito = new Compras();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_SESSION['id'])) {
                $alertas = Compras::setAlerta('error', 'Debes Iniciar Sesión');
            } else {
                $carrito->idUsuario = $_SESSION['id'];
                $carrito->idPrenda = $prenda->id;

                $carrito->guardar();

                $alertas = Compras::setAlerta('exito', 'Producto agregado al carrito');
            }
        }

        $alertas = Compras::getAlertas();
        $router->render('carrito/prenda', [
            'login' => $_SESSION['login'] ?? false,
            'titulo' => $prenda->nombre,
            'alertas' => $alertas,
            'prenda' => $prenda
        ]);
    }
}
