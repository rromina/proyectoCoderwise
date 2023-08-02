<header id="fixed-color">
    <a href="index.html" id="link-icon-main" class="link-icon-main"><img class="icon-main" id="icon-main" src="public/img/logos-png/icon-main.png" alt=""></a>
    <a href="index.html" class="link-icon-movil"><img class="icon-movil" id="icon-main-movil" src="public/img/logos-png/icon-login.png" alt=""></a> 
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
              <a href="<?php echo URL;?>?c=Empresa&m=empresa"> 
                <div class="nav-icons">
                  <i class="fa-solid fa-bus-simple"></i>
                  Empresa
                </div>
              </a>
            </li>
            <li>
              <a href="<?php echo URL;?>?c=Contacto&m=contacto">
                <div class="nav-icons">
                  <i class="fa-solid fa-phone"></i>
                  Contacto
                </div>
              </a>
            </li>
            <li>
              <a href="<?php echo URL;?>?c=Noticias&m=noticias">
                <div class="nav-icons">
                  <i class="fa-solid fa-newspaper"></i>
                  Noticias
                </div>
              </a>
            </li>
            
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
        
        <a href="login.html"><i class="fa-solid fa-user"></i></a>
        <i class="fa-solid fa-bars" id="menu"></i>
    </div>
</header>