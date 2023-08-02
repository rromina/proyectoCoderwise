<?php

use Leandro\app\libs\Controlador;


class Contacto_Controller extends Controlador
{
  public function contacto()
  {
   
    $this->cargarVista("contacto/contacto");
  }
}
