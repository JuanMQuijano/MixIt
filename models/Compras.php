<?php

namespace Model;

class Compras extends ActiveRecord
{
    protected static $tabla = "compras";
    protected static $columnasDB = ["id", "idUsuario", "idPrenda", "confirmado"];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->idPrenda = $args['idPrenda'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
}
