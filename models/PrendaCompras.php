<?php

namespace Model;

class PrendaCompras extends ActiveRecord
{
    protected static $tabla = "prendas";
    protected static $columnasDB = ["id", "nombre", "descripcion", "imagen", "talla", "tipo", "precio", "url", "idUsuario", "idCompra"];

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
        $this->idCompra = $args['idCompra'] ?? '';
    }
}
