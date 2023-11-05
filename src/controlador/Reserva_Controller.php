<?php

use Coderwise\Viauy\libs\Controlador;
use Coderwise\Viauy\Modelo\Reserva;

class Reserva_Controller extends Controlador
{
    public function reserva()
    {
        header('Content-Type: application/json');

        try {
            $nombre_user = $_POST['nombre_user'];
            $id_servicio = $_POST['id_servicio'];
            $fecha_reserva = $_POST['fecha_reserva'];

            $resp = Reserva::reserva_pasaje($nombre_user, $id_servicio, $fecha_reserva);

            if ($resp) {
                $respuesta = ["mensaje" => "exito"];
            } else {
                $respuesta = ["error" => "error"];
            }
            echo json_encode($respuesta);
        } catch (\Throwable $th) {
            return "error";
        }
    }

    public function asiento() 
    {
        //header('Content-Type: application/json');

        $idOmnibus = $_GET['idOmnibus'];
        $idServicio = $_GET['idServicio'];

        $id_usuario = Reserva::id_user($_SESSION['nombre_usuario']);
        //$this->cargarVista("asientos/asientos");
        require 'src/vista/asientos/asientos.php';
    }

    public function pasaje() 
    {
        //header('Content-Type: application/json');

        $idOmnibus = $_GET['idOmnibus'];
        $idServicio = $_GET['idServicio'];
        $idUsuario = $_GET['id_usuario'];
        $numAsiento = $_GET['numAsiento'];
        $fechaActual = date("Y-m-d H:i:s");

        $resp = Reserva::reserva_pasaje($idUsuario, $idServicio, $idOmnibus, $numAsiento, $fechaActual);

        if($resp===1)
        {
            $msj = "reserva completada con exito";
        }else 
        {
            $msj = null;
        }

        require 'src/vista/index/index.php';
    }
}
