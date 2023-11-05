<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/backoffice-panel.css">
</head>

<body class="backoffice-panel">
    <header>
        <img src="img/logos-png/Viauy-backoffice.png" width="20%" height="10%" alt="">

        <?php require 'src/vista/menu_backoffice.php'; ?>

    </header>
    <main>
        <div class="panel">
            <div class="title-panel">
                <h1>Detalle Linea</h1>
            </div>
            <form id="form_backoffice_editar" action="" class="editar-linea">
                <div class="news-input">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div class="news-input">
                    <label for="">Servicio</label>
                    <select id="servicios" class="select">
                        <option value="">SELECCIONAR</option>
                    </select>
                </div>
                <div class="news-input">
                    <label for="">Ruta</label>
                    <select id="rutas" class="select">
                        <option value="">SELECCIONAR</option>
                    </select>
                </div>
                <div class="news-input">
                    <label for="">Duración Viaje (horas)</label>
                    <input id="duracion_viaje" type="text" placeholder="Duración Viaje" required>
                </div>
                <div class="news-input">
                    <label for="">Precio</label>
                    <input id="precio" type="text" placeholder="Precio" required>
                </div>
                <div class="texto-error">
                </div>
                <div class="button-box-editar">
                    <button id="editar_linea" type="button">Actualizar</button>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="public/js/library.js"></script>
    <script src="public/js/backoffice-detalle-linea.js"></script>
</body>

</html>