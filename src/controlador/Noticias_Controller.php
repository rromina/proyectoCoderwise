<?php

use Leandro\app\libs\Controlador;


class Noticias_Controller extends Controlador
{
  public function noticias()
  {
   
    $this->cargarVista("noticias/noticias");
  }
}
