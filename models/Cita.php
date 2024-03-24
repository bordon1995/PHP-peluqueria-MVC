<?php

namespace Model;

class Cita extends ActiveRecord
{
    protected static $tableName = 'citas';
    protected static $tablaDB = ['id', 'fecha', 'hora', 'cliente_id'];

    public $id;
    public $fecha;
    public $hora;
    public $cliente_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->cliente_id = $args['cliente_id'] ?? '';
    }
}
