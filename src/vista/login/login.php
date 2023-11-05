<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>

<body>
    <?php require 'src/vista/menu.php'; ?>


    <div class="main inicio">
        <form id="register" class="register login" method="POST" action="<?php echo URL . "?c=Login&m=ingresar"; ?>">
            <div class="space icon-login-box">
                <img class="icon-login" src="img/logos-png/icon-login.png" alt="">
                <h3 class="title-login-movil">Iniciar Sesión</h3>
            </div>
            <div class="content-login space">
                <div class="title-login">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="user_inp" required type="email" placeholder="Ingrese su email" name="usuario">
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input id="pass_inp" required type="password" placeholder="Ingrese su contraseña" name="pwd">
                </div>
            </div>
            <div class="continue space">
                <div class="remember">
                    <div>
                        <input type="checkbox">
                        <label for="">Recuerdame</label>
                    </div>

                    <div>
                        <a href="">Olvide mi contraseña</a>
                    </div>
                </div>

                <button type="submit">Ingresar</button>
            </div>
            <div class="register-here space">
                <p>¿No tienes una cuenta? <a href=<?php echo URL . "?c=Login&m=vista_register" ?>>Registrate aquí</a></p>
            </div>
        </form>
    </div>

    <?php require 'src/vista/footer.php'; ?>

    <script src="public/js/index.js"></script>
    <script src="public/js/login.js"></script>

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