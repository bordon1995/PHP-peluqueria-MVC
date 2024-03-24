<?php

namespace Model;

class MisCitas extends ActiveRecord
{
    protected static $tableName = 'citasservicios';
    protected static $tablaDB = ['id', 'fecha', 'hora', 'cliente', 'servicio', 'precio'];

    public $id;
    public $fecha;
    public $hora;
    public $cliente;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}
