<?php



use Coderwise\Viauy\libs\Controlador;
use Coderwise\Viauy\Modelo\Login;

class Login_Controller extends Controlador
{
  public function ingresar()
  {
    try {
      $usuario = $_POST['usuario'];
      $pwd = $_POST['pwd'];


      $resp = Login::ingresar($usuario, $pwd);

      if ($resp === "true") {

        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION['nombre_usuario'] = $usuario;
        require 'src/vista/index/index.php';
      }else 
      {
        $_SESSION['error_login'] = "errorUserCode:3303";
        require 'src/vista/login/login.php';
      }
        
        exit;
    } catch (\Throwable $th) {}
  }

  public function loginBackoffice()
  {
    header('Content-Type: application/json');

    try {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $respuesta = Login::loginBackoffice($email, $password);

      if (!$respuesta) return;

      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      $_SESSION['id_user'] = $respuesta["IDAdm"];
      $_SESSION['type_account'] = "1";

      //return  "Se ha iniciado sesion exitosamente";
      return $this->respuestaSuccess(null, "Se ha iniciado sesion exitosamente");
    } catch (\Throwable $th) {
      echo $th;
      $this->respuestaError("Error al iniciar sesion.");
    }
  }
  public function vista_login()
  {
    require 'src/vista/login/login.php';
  }

  public function vista_backoffice_login()
  {
    $this->cargarVista("dashboard_admin/backoffice-login");
  }

  public function vista_register()
  {
    require 'src/vista/login/register.php';
  }

  public function logout()
  {
    session_destroy();
    require 'src/vista/index/index.php';
  }

  public function logout_backoffice()
  {
    session_destroy();
    $this->vista_backoffice_login();
  }

  public function registrar()
  {
    try {
      $usuario = $_POST['email'];
      $pwd = $_POST['password'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $edad = $_POST['edad'];


      $resp = Login::register($usuario, $pwd, $nombre, $apellido, $edad);

      if ($resp) {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        $_SESSION['nombre_usuario'] = $usuario;

        require 'src/vista/index/index.php';
        exit;
      } else {
        echo $resp;
      }
    } catch (\Throwable $th) {
      echo "quep?" . $th;
    }
  }
}
