<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use Model\Prenda;
use MVC\Router;

class LoginController
{

    public static function index(Router $router)
    {
        $prendas = Prenda::all();

        $router->render('index', [
            'login' => '',
            'titulo' => 'Las mejores prendas en el mejor lugar',
            'prendas' => $prendas,
            'script' => '<script src="/build/js/app.js"></script>'
        ]);
    }

    public static function iniciar_sesion(Router $router)
    {
        isLogged();

        $alertas = [];
        $auth = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->sincronizar($_POST);

            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                $usuario = Usuario::where('correo', $auth->correo);
                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'Email No Encontrado o No Ha Confirmado Su Cuenta');
                } else {
                    if (password_verify($auth->password, $usuario->password)) {
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['login'] = true;
                        $_SESSION['nombre'] = $usuario->nombre;

                        header('Location: /');
                    } else {
                        $alertas = Usuario::setAlerta('error', 'Contraseña Incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'login' => true,
            'alertas' => $alertas,
            'titulo' => 'Inicar Sesión',
            'usuario' => $auth,
            'script' => '<script src="/build/js/app.js"></script>'
        ]);
    }

    public static function registrar(Router $router)
    {
        isLogged();

        $alertas = [];
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $otherUser = Usuario::where('correo', $usuario->correo);

                if (!$otherUser) {

                    $usuario->hashearPassword();
                    $usuario->generarToken();

                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    header('Location: /mensaje');
                } else {
                    $alertas = Usuario::setAlerta('error', 'El correo ya se encuentra registrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/register', [
            'login' => true,
            'titulo' => 'Crear Cuenta',
            'alertas' => $alertas,
            'usuario' => $usuario,
            'script' => '<script src="/build/js/app.js"></script>'
        ]);
    }

    public static function mensaje(Router $router)
    {
        $alertas = [];
        $alertas = Usuario::setAlerta('exito', 'Hemos enviado un correo para que confirmes tu cuenta');
        $alertas = Usuario::getAlertas();
        $router->render('auth/mensaje', [
            'titulo' => 'Registro Exitoso',
            'login' => false,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $confirmar = false;
        $token = $_GET['token'];

        if (!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if ($usuario) {
            $usuario->token = '';
            $usuario->confirmado = 1;
            $usuario->guardar();

            $alertas = Usuario::setAlerta('exito', 'Cuenta Confirmada Exitosamente');
            $confirmar = true;
        } else {
            $alertas = Usuario::setAlerta('error', 'Token invalido o ya caducó');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar Cuenta',
            'login' => false,
            'alertas' => $alertas,
            'confirmar' => $confirmar
        ]);
    }

    public static function olvide(Router $router)
    {
        isLogged();
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('correo', $usuario->correo);

                if ($usuario && $usuario->confirmado === "1") {
                    $usuario->generarToken();
                    $usuario->guardar();

                    $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $email->olvidePassword();

                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide', [
            'login' => true,
            'titulo' => 'Olvidé mi Password',
            'alertas' => $alertas,
            'script' => '<script src="/build/js/app.js"></script>'
        ]);
    }

    public static function reestablecer(Router $router)
    {
        isLogged();
        $alertas = [];
        $token = $_GET['token'];
        $mostrar = true;

        if (!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
            $mostrar = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                $usuario->hashearPassword();

                $usuario->token = '';

                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /iniciar-sesion');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/reestablecer', [
            'login' => true,
            'titulo' => 'Reestablece tu contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function cerrar_sesion()
    {
        $_SESSION = [];

        header('Location: /');
    }
}
