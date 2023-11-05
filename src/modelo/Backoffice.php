<?php

namespace Coderwise\Viauy\Modelo;

// Dependencias
use Coderwise\Viauy\libs\Conexion;

class BackOffice
{
  public static function agregarLinea($datos)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "INSERT INTO lineas (nombre, IdServicio, IDruta, DuracionViaje, Precio) VALUES (:nombre, :id_servicio, :id_ruta, :duracion, :precio)";
    $consulta = $pdo->prepare($sql);

    $consulta->execute($datos);

    return true;
  }

  public static function editarLinea($datos)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "UPDATE lineas SET nombre = :nombre, IdServicio = :id_servicio, IDruta = :id_ruta, DuracionViaje = :duracion, Precio = :precio WHERE id=:id";
    $consulta = $pdo->prepare($sql);

    $consulta->execute($datos);

    return true;
  }

  public static function eliminarLinea($datos)
  {
    $id = (int) $datos["id"];
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "DELETE FROM lineas WHERE id=:id";

    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':id', $id, \PDO::PARAM_INT);
    $consulta->execute();

    return true;
  }

  public static function detalleLinea($id)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "SELECT nombre, IdServicio AS id_servicio, IDruta AS id_ruta, DuracionViaje AS duracion_viaje, Precio AS precio FROM lineas WHERE id=:id";

    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id, \PDO::PARAM_INT);
    $consulta->execute();

    $linea = $consulta->fetch(\PDO::FETCH_ASSOC);
    return $linea;
  }

  public static function obtenerFiltros()
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql_rutas = "SELECT IDruta AS id, CONCAT(origen, ' - ', destino) AS nombre FROM rutas";
    $consulta_rutas = $pdo->prepare($sql_rutas);
    $consulta_rutas->execute();

    $sql_servicios = "SELECT IdServicio AS id, CONCAT(HoraSalida, ' - ', HoraLlegada, ' - ', Fecha) AS nombre FROM servicios";
    $consulta_servicios = $pdo->prepare($sql_servicios);
    $consulta_servicios->execute();


    $rutas = $consulta_rutas->fetchAll(\PDO::FETCH_ASSOC);
    $servicios = $consulta_servicios->fetchAll(\PDO::FETCH_ASSOC);

    return [
      "rutas" => $rutas,
      "servicios" => $servicios
    ];
  }

  public static function cargarTabla()
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "SELECT l.id, COALESCE(l.nombre, 'N/A') AS Nombre, CONCAT(s.HoraSalida, ' - ', s.HoraLlegada, ' - ', s.Fecha) AS servicio, CONCAT(r.Origen, ' - ', r.Destino) AS ruta, l.DuracionViaje, l.Precio 
    FROM lineas AS l
    INNER JOIN servicios AS s 
    ON s.IdServicio = l.IdServicio
    INNER JOIN rutas AS r 
    ON r.IDruta = l.IDruta";
    $consulta = $pdo->prepare($sql);

    $consulta->execute();

    $datos = $consulta->fetchAll(\PDO::FETCH_ASSOC);

    return $datos;
  }
};
