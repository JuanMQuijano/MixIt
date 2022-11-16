<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "apellido", "correo", "password", "token", "confirmado"];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Debes ingresar un nombre';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'Debes Ingresar un apellido';
        }
        if (!$this->correo) {
            self::$alertas['error'][] = 'Debes ingresar un correo';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'Debes ingresar una contraseña';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña tiene que tener más de 6 digitos';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->correo) {
            self::$alertas['error'][] = 'Debes ingresar un correo';
        }

        return self::$alertas;
    }

    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'Debes ingresar una contraseña';
        }

        return self::$alertas;
    }

    public function validarLogin()
    {
        if (!$this->correo) {
            self::$alertas['error'][] = 'Debes ingresar un correo';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'Debes ingresar una contraseña';
        }

        return self::$alertas;
    }

    public function hashearPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generarToken()
    {
        $this->token = uniqid();
    }
}
