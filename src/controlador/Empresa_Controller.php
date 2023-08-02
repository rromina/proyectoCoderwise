<?php

use Leandro\app\libs\Controlador;


class Empresa_Controller extends Controlador
{
  public function empresa()
  {
   
    $this->cargarVista("empresa/empresa");
  }
}
