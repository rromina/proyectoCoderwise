<?php

use Coderwise\Viauy\libs\Controlador;
use Coderwise\Viauy\Modelo\BackOffice;

class Backoffice_Controller extends Controlador
{
  #region rutas
  public function backoffice_agregar()
  {
    $this->cargarVista("dashboard_admin/backoffice-agregar");
  }

  public function backoffice_detalle_linea()
  {
    $this->cargarVista("dashboard_admin/backoffice-detalle-linea");
  }

  public function backoffice_editar()
  {
    $this->cargarVista("dashboard_admin/backoffice-editar");
  }

  public function backoffice_estadisticas()
  {
    $this->cargarVista("dashboard_admin/backoffice-estadisticas");
  }

  public function backoffice_gestion()
  {
    $this->cargarVista("dashboard_admin/backoffice-gestion");
  }

  public function backoffice_perfil()
  {
    $this->cargarVista("dashboard_admin/backoffice-perfil");
  }

  public function backoffice_noticias()
  {
    $this->cargarVista("dashboard_admin/backoffice-noticias");
  }
  #endregion

  private function validarPayloadLinea($datos)
  {
    $errores = array();
    if (!$datos) return $errores;

    if (!$this->validarValorVacio($datos["nombre"])) {
      $errores["nombre"] = "El campo nombre es obligatorio";
    }

    if (!$this->validarValorVacio($datos["id_servicio"])) {
      $errores["servicio"] = "El campo servicio es obligatorio";
    }

    if ($this->validarValorVacio($datos["id_servicio"]) && !$this->validarNumero($datos["servicio"])) {
      $errores["servicio_number"] = "El campo servicio debe ser numerico";
    }

    if (!$this->validarValorVacio($datos["id_ruta"])) {
      $errores["ruta"] = "El campo ruta es obligatorio";
    }

    if ($this->validarValorVacio($datos["id_ruta"]) && !$this->validarNumero($datos["ruta"])) {
      $errores["ruta_number"] = "El campo ruta debe ser numerico";
    }

    if (!$this->validarValorVacio($datos["duracion"])) {
      $errores["duracion"] = "El campo duracion es obligatorio";
    }

    if (!$this->validarValorVacio($datos["precio"])) {
      $errores["precio"] = "El campo precio es obligatorio";
    }

    if ($this->validarValorVacio($datos["precio"]) && !$this->validarNumero($datos["precio"])) {
      $errores["precio_number"] = "El campo precio debe ser numerico";
    }

    return $errores;
  }

  public function agregarLinea()
  {
    header("Content-Type: application/json");
    try {
      $datos = $_POST;
      $errores = $this->validarPayloadLinea($datos);
      if (count($errores) > 0) return $this->respuestaError($errores);

      $respuesta = BackOffice::agregarLinea($datos);

      if (!$respuesta) throw new Exception("Error agregando linea");

      $this->respuestaSuccess(null, "True");
    } catch (\Exception $e) {
      $this->respuestaError("Error al agregar la linea");
    }
  }

  public function editarLinea()
  {
    header("Content-Type: application/json");
    try {
      $datos = $_POST;
      $errores = $this->validarPayloadLinea($datos);

      if (count($errores) > 0) return $this->respuestaError($errores);

      $respuesta = BackOffice::editarLinea($datos);

      if (!$respuesta) throw new Exception("Error agregando linea");

      $this->respuestaSuccess(null, "True");
    } catch (\Exception $e) {
      echo $e;
      $this->respuestaError("Error al editar la linea");
    }
  }
  public function verDetalle()
  {
    header("Content-Type: application/json");

    try {
      $datos = $_POST;
      $errores = array();

      if (!$this->validarValorVacio($datos["id"])) {
        $errores["id"] = "El campo id es obligatorio";
      }

      if (count($errores) > 0) return $this->respuestaError($errores);

      $linea = Backoffice::detalleLinea($datos["id"]);

      return $this->respuestaSuccess($linea, "Detalle linea");
    } catch (\Exception $e) {
      echo $e;
      $this->respuestaError("Error al obtener la linea");
    }
  }

  public function eliminarLinea()
  {
    header("Content-Type: application/json");

    try {
      $datos = $_POST;
      $errores = array();

      if (!$this->validarValorVacio($datos["id"])) {
        $errores["id"] = "El campo id es obligatorio";
      }

      if (count($errores) > 0) return $this->respuestaError($errores);

      Backoffice::eliminarLinea($datos);

      return $this->respuestaSuccess(null, "La linea se ha eliminado exitosamente");
    } catch (\Exception $e) {
      echo $e;
      $this->respuestaError("Error al eliminar la linea");
    }
  }

  public function obtenerFiltros()
  {
    header("Content-Type: application/json");
    $filtros = BackOffice::obtenerFiltros();

    return $this->respuestaSuccess($filtros, "Filtros");
  }

  public function cargarTabla()
  {
    header("Content-Type: application/json");
    $datos = BackOffice::cargarTabla();

    return $this->respuestaSuccess($datos, "Tabla");
  }
}
