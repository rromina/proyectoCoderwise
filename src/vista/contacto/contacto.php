<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ViaUY</title>

  <!-- CSS contacto website -->
  <link rel="stylesheet" href="public/css/style.css">

  <!-- fontAwesome dependences -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require 'src/vista/menu.php'; ?>


    <div class="main contacto-background">
          <div class="contacto">
              <h2>Contactanos</h2>
              <div class="contacto-box">
                  <p>Contactate con nosotros por aqui</p>
                  <div class="form-email">
                      <form action="">
                          <div class="name-secondname">
                              <div class="form-section">
                                  <label for="">Nombre *</label>
                                  <input type="text" required>
                              </div>
                              <div class="form-section">
                                  <label for="">Correo *</label>
                                  <input type="text" required>
                              </div>
                          </div>
                          <div class="form-section">
                              <label for="">Asunto *</label>
                              <input class="asunto" type="text" required>
                          </div>
                          <div class="form-textarea">
                              <label for="">Mensaje *</label>
                              <textarea name="" id="" cols="70" rows="10" required style="resize: none;"></textarea>
                          </div>
                          <input class="search" type="submit">
                          
                      </form>
                      <div class="contacto-section-box">
                          <div class="contacto-section">
                              <h3>Email</h3>
                              <p>viauy@gmail.com.uy</p>
                          </div>
                          <div class="contacto-section">
                              <h3>Teléfono</h3>
                              <p>+(598) 2248-6539</p>
                          </div>
                          <div class="contacto-section">
                              <h3>Dirección</h3>
                              <p>Lorem ipsum dolor sit amet</p>
                              <p>Lorem ipsum dolor sit amet</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


  <?php require 'src/vista/footer.php'; ?>
</body>

<!-- JS contacto website -->
<script src="public/js/index.js"></script>
<script src="public/js/scroll-control.js"></script>

</html>