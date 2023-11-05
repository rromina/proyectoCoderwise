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
                <h1>Gestionar Noticias</h1>
            </div>
            <div class="bus-lineas">
                <div class="lineas">
                    <h2>Titulo Noticia</h2>
                    <div class="checkbox-box">
                        <label for="">Eliminar</label>
                        <input type="checkbox" name="" id="">
                    </div>  
                </div>


                <div class="lineas">
                    <h2>Titulo Noticia</h2>
                    <div class="checkbox-box">
                        <label for="">Eliminar</label>
                        <input type="checkbox" name="" id="">
                    </div>  
                </div>


                <div class="lineas">
                    <h2>Titulo Noticia</h2>
                    <div class="checkbox-box">
                        <label for="">Eliminar</label>
                        <input type="checkbox" name="" id="">
                    </div>  
                </div>


                <div class="lineas">
                    <h2>Titulo Noticia</h2>
                    <div class="checkbox-box">
                        <label for="">Eliminar</label>
                        <input type="checkbox" name="" id="">
                    </div>  
                </div>
                <div class="button-box">
                    <button>Confirmar</button>
                </div>
            </div>
            <hr>
            <div class="news-create">
                <h1>Crear Noticia</h1>
                <form action="">
                    <div class="news-input">
                        <label for="">Titulo</label>
                        <input type="text">
                    </div>
                    <div class="news-input">
                        <label for="">Adjunta una imagen</label>
                        <input type="file">
                    </div>
                    <div class="news-input">
                        <label for="">Descripción</label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="button-box">
                        <input type="submit" value="Crear">
                    </div>
                </form>
            </div>

            
        </div>
    </main>
</body>
</html>