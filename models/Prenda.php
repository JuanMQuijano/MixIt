<?php

namespace Model;

class Prenda extends ActiveRecord
{
    protected static $tabla = "prendas";
    protected static $columnasDB = ["id", "nombre", "descripcion", "imagen", "talla", "tipo", "precio", "url", "idUsuario"];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->talla = $args['talla'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->idUsuario = $args['idUsuario'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Debes ingresar un nombre';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][] = 'Debes ingresar una descripcion';
        }
        if (!$this->imagen) {
            self::$alertas['error'][] = 'Debes seleccionar una imagen';
        }
        if (!$this->talla) {
            self::$alertas['error'][] = 'Debes Ingresar una talla';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'Debes Ingresar una precio';
        }
        if (!$this->tipo) {
            self::$alertas['error'][] = 'Debes seleccionar un tipo de prenda';
        }
        return self::$alertas;
    }

    public function generarUrl()
    {
        $this->url = md5(uniqid());
    }
}
