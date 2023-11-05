<?php

namespace Coderwise\Viauy\libs;

class Controlador
{
  public $datos;
  public function __construct()
  {
  }

  protected function validarValorVacio($valor)
  {
    return isset($valor) && !empty($valor);
  }

  protected function validarNumero($valor)
  {
    return (bool) preg_match("/^(\d){0,}$/", $valor);
  }

  protected function respuestaError($mensaje)
  {
    echo json_encode([
      "status" => "error",
      "error" => $mensaje
    ]);
  }

  protected function respuestaSuccess($datos, $mensaje)
  {
    $respuesta = (object) array("status" => "success");

    if (isset($datos)) $respuesta->data = $datos;

    if (isset($mensaje)) $respuesta->message = $mensaje;

    echo json_encode($respuesta);
  }

  function cargarVista($vistaRuta, $datos = null, $ext = "php")
  {
    $this->datos = $datos;
    $ruta = "src/vista/{$vistaRuta}.{$ext}";
    require_once $ruta;
  }
}
