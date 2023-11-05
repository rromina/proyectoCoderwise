<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ViaUY</title>

  <!-- CSS contacto website -->
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/servicios.css">

  <!-- fontAwesome dependences -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require 'src/vista/menu.php'; ?>

    <div class="main inicio">
      <div class="contacto">
        <h2>Servicios</h2>
        
        <table class="lineas">
          <thead>
            <tr>
              <th scope="col" class="th"><h3>Salida</h3></th>
              <th scope="col" class="th"><h3>Llegada</h3></th>
              <th scope="col" class="th"><h3>Duración</h3></th>
              <th scope="col" class="th"><h3>Precio</h3></th>
            </tr>
          </thead>

          <tbody>
            <?php 
              if ($resultados !== null)
              {
                  foreach ($resultados as $resultado) 
                  {
                    echo "<tr>";
                    echo "<td>". $resultado['HoraSalida'] . "hs</td>";
                    echo "<td>". $resultado['HoraLlegada'] . "hs</td>";
                    echo "<td>" . $resultado['DuracionViaje'] . "</td>";
                    echo "<td>$" . $resultado['Precio'] . "</td>";
                    echo "<td><a href='" . URL . "?c=Reserva&m=asiento&idOmnibus=" . $resultado['IdOmnibus'] . "&idServicio=" . $resultado['IdServicio'] . "'><button class='search'>reservar pasaje</button></a></td>";
                    echo "</tr>";
                  }
              } else {
                  echo "No se encontraros lineas que contengan una ruta con el origen y destino indicado.";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    
  <?php require 'src/vista/footer.php'; ?>
</body>

<!-- JS contacto website -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="public/js/reserva.js"></script>

<script src="public/js/index.js"></script>
<script src="public/js/scroll-control.js"></script>

</html>