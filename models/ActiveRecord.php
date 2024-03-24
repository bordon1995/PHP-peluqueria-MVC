<?php

namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $tableName;
    protected static $tablaDB = array();
    protected static $validacion = array();

    public static function setDataBase($conectionDB)
    {
        self::$db = $conectionDB;
    }

    public static function setValidacion($key, $value)
    {
        self::$validacion[$key] = $value;
    }

    public static function getValidacion()
    {
        return self::$validacion;
    }

    public function getAtributos()
    {
        $atributos = array();

        foreach (static::$tablaDB as $tabla) {
            if ($tabla === 'id') continue;
            $atributos[$tabla] = $this->$tabla;
        };

        return $atributos;
    }

    public function setAtributos($_post)
    {
        foreach (static::$tablaDB as $tabla) {
            foreach ($_post as $key => $value) {
                if ($tabla === $key) {
                    $this->$tabla = $value;
                };
            };
        };
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->getAtributos();

        foreach ($atributos as $key => $value) {
            $atributos[$key] = self::$db->escape_string($value);
        };

        return $atributos;
    }

    public static function validarFormulario($_post)
    {
        foreach ($_post as $key => $value) {
            if ($value === '') {
                self::$validacion['input'] = 'Todos los campos son obligatorios';
            } else {
                if ($key === 'correo') {
                    if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                        self::$validacion['gmail'] = 'El email ingresado no es valido';
                    };
                };
            };
        };
    }

    public static function getUsuario($tipo, $campo)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE $tipo = '$campo';";
        $resultado = self::queryBD($query);

        if ($resultado) {
            return array_pop($resultado);
        } else {
            return $resultado;
        };
    }

    public static function getAll()
    {
        $query = "SELECT * FROM " . static::$tableName . ";";
        $resultado = self::queryBD($query);

        if ($resultado) {
            return $resultado;
        };
    }

    public static function guardarDB($array)
    {
        $query = "INSERT INTO " . static::$tableName . " ( ";
        $query .= join(', ', array_keys($array));
        $query .=  " ) VALUES ('";
        $query .= join("','", array_values($array));
        $query .= "' ) ;";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function actualizarDB($object)
    {

        $array = array();
        foreach ($object as $key => $value) {
            $array[] = "{$key}='{$value}'";
        };

        $query = "UPDATE " . static::$tableName . " SET ";
        $query .= join(',', $array);
        $query .=  " WHERE id = " . $object->id . ";";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function deleteDB($where, $id)
    {
        $query = "DELETE FROM " . static::$tableName . " WHERE $where = $id ;";
        $respuesta = self::$db->query($query);

        if ($respuesta) {
            $query = "DELETE FROM citas WHERE id = $id ; ";
            self::$db->query($query);
        };
    }

    public static function getCitas()
    {
        $query = "
        SELECT citas.id,citas.fecha,citas.hora,CONCAT(cliente.nombre,' ',cliente.apellido) as cliente,CONCAT(servicios.nombre) as servicio ,servicios.precio FROM citas LEFT OUTER JOIN cliente ON citas.cliente_id = cliente.id
        LEFT OUTER JOIN citasservicios ON citasservicios.citas_id = citas.id
        LEFT OUTER JOIN servicios ON servicios.id = citasservicios.servicios_id;";

        $resultado = self::queryBD($query);

        return $resultado;
    }

    protected static function queryBD($query)
    {
        $resultado = self::$db->query($query);

        if ($resultado->num_rows !== 0) {
            while ($registro = $resultado->fetch_assoc()) {
                $array[] = self::getObject($registro);
            };

            // $resultado->free();

            return $array;
        };

        return false;
    }

    protected static function getObject($object)
    {
        $cliente = new static;

        foreach ($object as $key => $value) {
            if (property_exists($cliente, $key)) {
                $cliente->$key = $value;
            };
        };

        return $cliente;
    }
}
