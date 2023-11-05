<?php

namespace Coderwise\Viauy\Modelo;

use stdClass;
use PDOException;
use Coderwise\Viauy\libs\Conexion;

class Login
{
  public function __construct()
  {
  }


  public static function ingresar($user, $pwd)
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "SELECT * FROM usuarios WHERE email = :e AND Contraseña = :c";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':e', $user);
    $stmt->bindParam(':c', $pwd);
    $stmt->execute();

    $usuarioEncontrado = $stmt->fetch();

    if ($usuarioEncontrado) {
      return "true";
    } else {
      return "false";
    }
  }

  public static function register($usuario, $pwd, $nombre, $apellido, $edad)
  {
    $conexion = Conexion::getConexion();
    $pdo = $conexion->getPdo();

    $sql = "INSERT INTO usuarios (email, contraseña, nombre, apellido, edad) VALUES (:usuario, :contrasena, :nombre, :apellido, :edad)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $pwd);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':edad', $edad);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
