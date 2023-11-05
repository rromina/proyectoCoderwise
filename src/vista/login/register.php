<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>
<body>
    <?php require 'src/vista/menu.php'; ?>

    <div class="main inicio">
    <form id="register" class="register login" method="POST" action="<?php echo URL . "?c=Login&m=registrar"; ?>">
            <div class="space icon-login-box">
                <img class="icon-login" src="img/logos-png/icon-login.png" alt="">
                <h3 class="title-login-movil">Registrate</h3>
            </div>
            <div class="content-login space">
                <div class="title-login">
                    <h3>Registrate</h3>
                </div>
                <label class="register-titles" for="">Nombre y Apellido</label>
                <div class="name-register margin-bottom">
                    
                    <div class="input-box">
                        <i class="fa-solid fa-user icons-flex"></i>
                        <input required class="left-input" type="text" placeholder="Nombre" oninput="validarInput(event)" value="" name="nombre">
                    </div>
                    <div class="input-box">
                        <i class="fa-solid fa-user icons-flex"></i>
                        <input required type="text" placeholder="Apellido" oninput="validarInput(event)" value="" name="apellido">
                    </div>
                </div>

                <label class="register-titles" for="">Documento</label>
                <div class="input-box margin-bottom">
                    <i class="fa-solid fa-address-card"></i>
                    <input required type="number" placeholder="CI/DNI" name="edad">
                </div>


                <label class="register-titles" for="">Correo y Contraseña</label>
                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>
                    <input required type="email" placeholder="Ingrese su email" name="email">
                </div>
                <div class="name-register">
                    <div class="input-box" style="margin-bottom: 0;">
                        <i class="fa-solid fa-lock icons-flex"></i>
                        <input style="margin-bottom: 10px;" id="password" required class="left-input margin-bottom" type="password" placeholder="Contraseña" oninput="validarPassword(event); validarConfirmacion()" value="" name="password">
                    </div>
                    <div class="input-box" style="margin-bottom: 0;">
                        <i class="fa-solid fa-lock icons-flex"></i>
                        <input style="margin-bottom: 10px;" class=" margin-bottom" id="confirm-password" required type="password" placeholder="Confirme contraseña" oninput="validarConfirmacion()" value="" name="password">
                    </div>
                </div>
                <div class="alerts-register">
                    <p id="match-message" class="warning-message" style="opacity: 0;">• Las contraseñas no coinciden</p>
                    <p id="warning-length" class="warning-message" style="opacity: 0;">• La contraseña debe contener 6 caracteres y un caracter especial [0-9!@#$%^&*(),.?":{}|<>] como minimo</p>
                </div>
                </div>
            <div class="continue">
                <button type="submit">Registrarte</button>
            </div>
        </form>
    </div>
    
    <?php require 'src/vista/footer.php'; ?>
    <script src="public/js/index.js"></script>

    <script>
        window.addEventListener('scroll', function() {
            let navbar = document.getElementById('fixed-color');
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
            if (scrollTop > 0) {
            navbar.classList.add('fixed');
            } else {
            navbar.classList.remove('fixed');
            }
        });
    </script>
</body>
</html>