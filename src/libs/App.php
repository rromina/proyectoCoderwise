<?php

namespace Coderwise\Viauy\libs;


class App
{
  public static function iniciar()
  {


    session_start();
    $nombreControlador = $_GET['c'] ?? "index";
    $metodo = $_GET['m'] ?? "index";
    $controlador = ucfirst($nombreControlador) . "_Controller";

    $controllerPath = 'src/controlador/' . $controlador . ".php";
    require_once $controllerPath;
    $controller = new $controlador();
    $controller->{$metodo}();
  }
}
