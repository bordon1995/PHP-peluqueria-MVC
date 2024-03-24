<?php

namespace Controllers;

use Model\Servicios;
use Model\CitasServicios;
use Model\Cita;

class ApiController
{
    public static function all()
    {
        $resultado = Servicios::getAll();
        echo json_encode($resultado);
    }

    public static function save()
    {
        $cita = new Cita($_POST);
        $array = $cita->sanitizarAtributos();
        $resultado = $cita::guardarDB($array);
        if ($resultado) {
            $cita_id = Cita::getUsuario('cliente_id', $cita->cliente_id);
            $servicio_id = explode(',', $_POST['servicios']);
            foreach ($servicio_id as $servicio) {
                $args =
                    [
                        'citas_id' => $cita_id->id,
                        'servicios_id' => $servicio
                    ];

                $servicios = new CitasServicios($args);
                $array = $servicios->sanitizarAtributos();
                $resultado = $servicios::guardarDB($array);
            };
        };

        $res = ['body' => $servicio];
        echo json_encode($res);
    }
}
