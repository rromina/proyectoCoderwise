<header id="fixed-color">
    <?php echo '<a href="' . URL . '" id="link-icon-main" class="link-icon-main"><img class="icon-main" id="icon-main" src="public/img/logos-png/icon-main.png" alt=""></a>';?>
    <?php echo '<a href="'. URL . '" class="link-icon-movil"><img class="icon-movil" id="icon-main-movil" src="public/img/logos-png/icon-login.png" alt=""></a> ';?>
    
    <nav>
        <ul>
            <li>
              <a href="<?php echo URL;?>?c=Index&m=index"> 
                <div class="nav-icons">
                  <i class="fa-solid fa-house"></i>
                  Inicio
                </div>
              </a>
            </li>
            <li>
              <a href="<?php echo URL;?>?c=Index&m=empresa"> 
                <div class="nav-icons">
                  <i class="fa-solid fa-bus-simple"></i>
                  Empresa
                </div>
              </a>
            </li>
            <li>
              <a href="<?php echo URL;?>?c=Index&m=contacto">
                <div class="nav-icons">
                  <i class="fa-solid fa-phone"></i>
                  Contacto
                </div>
              </a>
            </li>
            <li>
              <a href="<?php echo URL;?>?c=Index&m=noticias">
                <div class="nav-icons">
                  <i class="fa-solid fa-newspaper"></i>
                  Noticias
                </div>
              </a>
            </li>

            <?php  
              if (session_status() == PHP_SESSION_NONE) session_start(); 
              if (isset($_SESSION['nombre_usuario'])) {
                echo '<br><br><li><a href="' . URL . '?c=Login&m=logout"><div class="nav-icons"><i class="fa-solid fa-right-from-bracket"></i>Cerrar Sesion</div></a></li>';
              }
            ?>
          </ul>

    </nav>
    <div class="icons-box">
        <div class="idiomas">
            <select class="language">
                <option class="option" value="es">ESP</option>
                <option class="option" value="en">ENG</option>
            </select>
            <i class="fa-solid fa-earth-americas icons-nolinks"></i>
        </div>
      
        <?php  
          if (session_status() == PHP_SESSION_NONE) session_start(); 
          if (isset($_SESSION['nombre_usuario'])) {
            $usuario = $_SESSION['nombre_usuario'];
            echo '<i class="fa-solid fa-user" style="font-size: 30px; margin-left: 35px"></i><p style="color: white; font-size: 20px; user-select: none;"> &nbsp;&nbsp;| ' . $usuario . '</p>';
          } else {
              echo '<a href="' . URL . '?c=Login&m=vista_login"><i class="fa-solid fa-user"></i></a>';
          }
        ?>

        <i class="fa-solid fa-bars" id="menu"></i>
    </div>
</header>