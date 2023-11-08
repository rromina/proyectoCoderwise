<?php

namespace Coderwise\Viauy\Modelo;

use stdClass;
use PDO;
use PDOException;
use Coderwise\Viauy\libs\Conexion;

class Reserva
{
    public function __construct()
    {
    }


    public static function reserva_pasaje($idUsuario, $idServicio, $idOmnibus, $numAsiento, $fechaActual)
    {
        try {
            $conexion = Conexion::getConexion();
            $pdo = $conexion->getPdo();

            // Realizar insert en la tabla reserva
            $sql = "INSERT INTO Reserva (CodAsiento, IdOmnibus, IdServicio, IDUsuario, Fecha_Reserva) VALUES (:ca, :ido, :ids, :idu, :fr)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ca', $numAsiento);
            $stmt->bindParam(':ido', $idOmnibus); 
            $stmt->bindParam(':ids', $idServicio);
            $stmt->bindParam(':idu', $idUsuario); 
            $stmt->bindParam(':fr', $fechaActual);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public static function id_user($email)
    {
        try {
            $conexion = Conexion::getConexion();
            $pdo = $conexion->getPdo();

            // Obtener IDUsuario en base a su email
            $sql = "SELECT IDUsuario FROM usuarios WHERE Email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $id_usuario = $stmt->fetchColumn(); 

            return $id_usuario;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public static function email_user($id)
    {
        try {
            $conexion = Conexion::getConexion();
            $pdo = $conexion->getPdo();

            // Obtener IDUsuario en base a su email
            $sql = "SELECT Email FROM usuarios WHERE IDUsuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $email = $stmt->fetchColumn(); 

            return $email;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    
}
