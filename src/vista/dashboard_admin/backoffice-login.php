<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice ViaUY</title>
    <link rel="stylesheet" href="public/css/backoffice-login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="backoffice-content">
        <img src="img/logos-png/Viauy-9.png" alt="" width="50%" height="10%">
        <h3>Inicia Sesión</h3>
        <form>
            <div class="login-input">
                <label for="">ID de Usuario</label>
                <input type="email" id="email" placeholder="Ingrese su ID de usuario">
            </div>
            <div class="login-input">
                <label for="">Contraseña</label>
                <input type="password" id="password" placeholder="Ingrese su contraseña">
            </div>
            <div class="input-check-box">
                <div class="input-check-content">
                    <input type="checkbox">
                    <label for="">Recuerdame</label>
                </div>
                <div class="input-check-box">
                    <a href="">Olvide mi contraseña</a>
                </div>
            </div>
            <span class="texto-error"></span>
            <div class="input-submit">
                <input id="login_backoffice" type="button" value="Inciar Sesión">
            </div>
        </form>
    </div>

    <?PHP echo "<script>const BASE_URL = '" . URL . "';</script>"; ?>
    <script src="public/js/library.js"></script>
    <script src="public/js/backoffice-login.js"></script>
</body>

</html>