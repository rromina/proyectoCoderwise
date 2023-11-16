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
    <div id="cont_reservas"></div>
    <br>
    <br>

        <div class="panel">
   
            <div class="news-create">
                <h1>Crear Noticia</h1>
                <form id="crearNoticiaForm">
                    <div class="news-input">
                        <label for="">Titulo</label>
                        <input type="text" name="Titulo">
                    </div>
                    <div class="news-input">
                        <label for="">Adjunta una imagen</label>
                        <input type="text" placeholder="url de imagen" name="Imagen">
                    </div>
                    <div class="news-input">
                        <label for="">Descripción</label>
                        <textarea name="Descripcion" id="" cols="30" rows="10" style="resize: none;"></textarea>
                    </div>

                    <input type="hidden" name="Fecha" id="Fecha">
                    <input type="hidden" name="ID_Adm" value="<?php echo $_SESSION['id_user']; ?>">

                    <div class="button-box">
                        <input value="Crear" onclick="crearNoticia();">
                    </div>
                </form>
            </div>

            
        </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?PHP echo "<script>const BASE_URL = '" . URL . "';</script>"; ?>
    <script src="public/js/backoffice_noticia.js"></script>

</body>
</html>



<style>

    /* Estilos para la tabla */
    .tabla-reservas {
    border-collapse: collapse;
    width: 100%;
    }

    /* Estilos para las celdas de la cabecera */
    .tabla-reservas th {
    background-color: #f2f2f2;
    font-weight: bold;
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
    }

    /* Estilos para las celdas de datos */
    .tabla-reservas td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
    }

    /* Estilos para las filas impares (opcional) */
    .tabla-reservas tr:nth-child(odd) {
    background-color: #f9f9f9;
    }
</style>