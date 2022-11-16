<?php

namespace Controllers;

use MVC\Router;
use Model\Prenda;
use Intervention\Image\ImageManagerStatic as Image;

class DashboardController
{
    public static function index(Router $router)
    {
        isNotLogged();

        $prendas = Prenda::belongsTo('idUsuario', $_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenda = Prenda::where('url', $_POST['url']);
            $prenda->eliminar();

            header('Location: /mis-prendas');
        }

        $router->render(
            'dashboard/index',
            [
                'titulo' => 'Mis publicaciones',
                'prendas' => $prendas
            ]
        );
    }

    public static function crear_publicacion(Router $router)
    {
        isNotLogged();

        $alertas = [];
        $prenda = new Prenda();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenda->sincronizar($_POST);

            //Generamos un nombre único para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".webp";

            //Setear la imagen
            if ($_FILES['imagen']['tmp_name']) {
                //Realiza un resize a la imagen con intervention
                $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $prenda->setImagen($nombreImagen);
            }

            $alertas = $prenda->validar();

            if (empty($alertas)) {
                //Si una carpeta existe o no
                if (!is_dir(CARPETA_IMAGENES)) {
                    //Si no existe, crearla
                    mkdir(CARPETA_IMAGENES);
                }

                //Guarda la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                $prenda->generarUrl();
                $prenda->idUsuario = $_SESSION['id'];
                $prenda->guardar();

                header('Location: /mis-prendas');
            }
        }

        $alertas = Prenda::getAlertas();
        $router->render('dashboard/crear-publicacion', [
            'titulo' => 'Crear Publicacion',
            'alertas' => $alertas,
            'prenda' => $prenda
        ]);
    }

    public static function actualizar_publicacion(Router $router)
    {
        isNotLogged();

        $alertas = [];

        $url = $_GET['url'];

        if (!$url) header('Location: /mis-prendas');

        $prenda = Prenda::where('url', $url);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenda->sincronizar($_POST);
            //Generamos un nombre único para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".webp";

            //Setear la imagen
            if ($_FILES['imagen']['tmp_name']) {
                //Realiza un resize a la imagen con intervention
                $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $prenda->setImagen($nombreImagen);
            }

            /*** SUBIDA DE ARCHIVOS ***/

            //Si una carpeta existe o no
            if (!is_dir(CARPETA_IMAGENES)) {
                //Si no existe, crearla
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la bd
            if ($prenda->guardar()) {
                header('Location: /mis-prendas');
            }
        }

        $router->render('dashboard/actualizar', [
            'titulo' => 'Actualizar Publicación',
            'alertas' => $alertas,
            'prenda' => $prenda
        ]);
    }
}
