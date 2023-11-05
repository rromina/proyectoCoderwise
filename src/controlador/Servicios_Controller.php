    <?php

    use Coderwise\Viauy\libs\Controlador;
    use Coderwise\Viauy\Modelo\Servicios;

    class Servicios_Controller extends Controlador
    {
        public function consulta_travel()
        {
            try {
                $origen = $_POST['origen'];
                $destino = $_POST['destino'];

                $resp = Servicios::busqueda_travel($origen, $destino);
        
                $resultados = json_decode($resp, true);

                require 'src/vista/servicios/servicios.php';
            } catch (\Throwable $th) {
            }
        }
    }
