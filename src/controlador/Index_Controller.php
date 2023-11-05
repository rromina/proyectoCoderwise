<?php

use Coderwise\Viauy\libs\Controlador;


class Index_Controller extends Controlador
{
  public function index()
  {
    $this->cargarVista("index/index");
  }

  public function contacto()
  {
    $this->cargarVista("contacto/contacto");
  }

  public function empresa()
  {
    $this->cargarVista("empresa/empresa");
  }

  public function noticias()
  {
    $this->cargarVista("noticias/noticias");
  }

  //////////////////////////////////////////////

  public function backoffice_editar()
  {
    $this->cargarVista("dashboard_admin/backoffice-editar");
  }

  public function backoffice_eliminar()
  {
    $this->cargarVista("dashboard_admin/backoffice-eliminar");
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
}
