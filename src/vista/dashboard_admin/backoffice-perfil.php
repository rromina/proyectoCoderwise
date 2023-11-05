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
            <div class="perfil-photo">
                <div class="photo">
                    <img src="https://tork.news/__export/1662648345608/sites/tork/img/2022/09/08/seat_lexn_version1662648326027.jpg_773999222.jpg" alt="">
                </div>

                <div class="photo-text">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam 
                        praesentium saepe optio illo cupiditate nostrum repudiandae corrupti 
                        deserunt ducimus distinctio facere eaque, nihil dolore? Illo aliquam 
                        eligendi numquam sit cumque.
                    </p>
                </div>
            </div>
            <div class="perfil-info">
                <p>Cedula: 54773452</p>
                <p>ID: 97467356</p>
                <p>Tel: 092546874</p>
            </div>
        </div>
    </main>
</body>
</html>