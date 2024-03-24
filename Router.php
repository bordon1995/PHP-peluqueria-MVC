<?php

namespace MVC;

class Router
{
    public $rutas_Session = ['/admin', '/mis-citas'];
    public $rutasGET = array();
    public $rutasPOST = array();

    public function get($url, $funcion)
    {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->rutasPOST[$url] = $funcion;
    }

    public function urlSession()
    {
        $getUrlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $resultado = in_array($getUrlActual, $this->rutas_Session);

        if ($resultado) {
            session_start();

            if (!empty($_SESSION)) {
                $this->getFunction($getUrlActual);
            } else {
                header('Location:/');
            }
        } else {
            $this->getFunction($getUrlActual);
        }
    }

    public function getFunction($getUrlActual)
    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $funcion = $this->rutasGET[$getUrlActual]  ?? null;
        } else {
            $funcion = $this->rutasPOST[$getUrlActual]  ?? null;
        };

        if (isset($funcion)) {
            call_user_func($funcion, $this);
        } else {
            echo 'pagina no encontrada';
        }
    }

    public function render($view, $arsg = [])
    {
        foreach ($arsg as $key => $value) {
            $$key = $value;
        };

        ob_start();
        require __DIR__ . '/views/propiedades' . $view . '.php';
        $contenido = ob_get_clean();

        require __DIR__ . '/views/layout.php';
    }
}
