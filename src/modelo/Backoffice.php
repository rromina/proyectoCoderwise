<?php

namespace Coderwise\Viauy\Modelo;

// Dependencias
use Coderwise\Viauy\libs\Conexion;

class BackOffice
{

  public static function usuarioActual($id_usuario)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "SELECT * FROM administradores WHERE IDAdm = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':id', $id_usuario, \PDO::PARAM_INT);
    $consulta->execute();

    $datos = $consulta->fetch();

    return $datos;
  }

  public static function agregarLinea($datos)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "INSERT INTO lineas (nombre, IdServicio, IDruta, DuracionViaje, Precio) VALUES (:nombre, :id_servicio, :id_ruta, :duracion, :precio)";
    $consulta = $pdo->prepare($sql);

    $consulta->execute($datos);

    return true;
  }

  public static function crearNoticia($Titulo, $Descripcion, $Imagen, $Fecha, $ID_Adm)
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "INSERT INTO Noticias (Titulo, Descripcion, Imagen, Fecha, ID_Adm) VALUES (:Titulo, :Descripcion, :Imagen, :Fecha, :ID_Adm)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':Titulo', $Titulo, \PDO::PARAM_INT);
    $consulta->bindParam(':Descripcion', $Descripcion, \PDO::PARAM_INT);
    $consulta->bindParam(':Imagen', $Imagen, \PDO::PARAM_INT);
    $consulta->bindParam(':Fecha', $Fecha, \PDO::PARAM_INT);
    $consulta->bindParam(':ID_Adm', $ID_Adm, \PDO::PARAM_INT);

    $consulta->execute();

    return true;
  }

  public static function editarLinea($datos)
  {
    $conexion = Conexion::getConexion();

    $pdo = $conexion->getPdo();

    $sql = "UPDATE Lineas SET nombre = :nombre, IdServicio = :id_servicio, IDruta = :id_ruta, DuracionViaje = :duracion, Precio = :precio WHERE IDlinea=:id";
    $consulta = $pdo->prepare($sql);

    $consulta->execute($datos);

    return true;
  }
  
  public static function obtenerReservas()
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "SELECT * FROM reserva";
    $consulta = $pdo->query($sql);
    $reservas = $consulta->fetchAll(\PDO::FETCH_ASSOC);
    $reservasJson = json_encode($reservas);

    return $reservasJson;
  }

  public static function obtenerUsuarios()
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "SELECT * FROM usuarios";
    $consulta = $pdo->query($sql);
    $reservas = $consulta->fetchAll(\PDO::FETCH_ASSOC);
    $reservasJson = json_encode($reservas);

    return $reservasJson;
  }


  public static function cargarNoticias()
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "SELECT * FROM Noticias";
    $consulta = $pdo->query($sql);
    $reservas = $consulta->fetchAll(\PDO::FETCH_ASSOC);
    $reservasJson = json_encode($reservas);

    return $reservasJson;
  }

  public static function eliminarLinea($id)
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    // Elimina las paradas relacionadas con la línea
    $sqlParadas = "DELETE FROM paradas WHERE IDlinea = :id";
    $consultaParadas = $pdo->prepare($sqlParadas);
    $consultaParadas->bindParam(':id', $id, \PDO::PARAM_INT);
    $consultaParadas->execute();

    // Elimina la línea
    $sqlLinea = "DELETE FROM lineas WHERE IDlinea = :id";
    $consultaLinea = $pdo->prepare($sqlLinea);
    $consultaLinea->bindParam(':id', $id, \PDO::PARAM_INT);
    $consultaLinea->execute();

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

    $sql = "SELECT l.IDlinea, COALESCE(l.nombre, 'N/A') AS Nombre, CONCAT(s.HoraSalida, ' - ', s.HoraLlegada, ' - ', s.Fecha) AS servicio, CONCAT(r.Origen, ' - ', r.Destino) AS ruta, l.DuracionViaje, l.Precio 
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
