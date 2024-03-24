<?php

namespace Model;

class Servicios extends ActiveRecord
{
    protected static $tableName = 'servicios';
    protected static $tablaDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}
