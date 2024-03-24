<?php

namespace Model;

class CitasServicios extends ActiveRecord
{
    protected static $tableName = 'citasservicios';
    protected static $tablaDB = ['id', 'citas_id', 'servicios_id'];

    public $id;
    public $citas_id;
    public $servicios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citas_id = $args['citas_id'] ?? '';
        $this->servicios_id = $args['servicios_id'] ?? '';
    }
}
