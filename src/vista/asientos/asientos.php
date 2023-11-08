<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Empresa</title>
</head>
<body>

<?php require 'src/vista/menu.php'; ?>


    <div class="main inicio">
        <div class="asientos-content">
            <h2>Elige tu asiento</h2>
            <div class="referencias-asientos">
                <div class="referencias">
                    <div class="referencias-titulo">
                        <h3>Referencias</h3>
                    </div>
                    <div class="referencias-content">
                        <div class="referencias-icons">
                            <div class="libre asiento">1</div>
                            <div class="ocupado asiento">1</div>
                            <div class="seleccionado asiento">1</div>
                            <div class="no-disponible asiento">1</div>
                        </div>
                        <div class="tipos-referencias">
                            <p>Libre</p>
                            <p>Ocupado</p>
                            <p>Seleccionado</p>
                            <p>No disponible</p>
                        </div>

                    </div>
                </div>
                <div class="bus-asientos">
                    <div class="lado-izquierdo asiento-posicion">
                        <div id="asientooo" class="asiento as1" onclick="reservarAsiento(1)">1</div>
                        <div class="asiento as2" onclick="reservarAsiento(2)">2</div>
                        <div class="asiento as5" onclick="reservarAsiento(5)">5</div>
                        <div class="asiento as6" onclick="reservarAsiento(6)">6</div>
                        <div class="asiento as9" onclick="reservarAsiento(9)">9</div>
                        <div class="asiento as10" onclick="reservarAsiento(10)">10</div>
                        <div class="asiento as13" onclick="reservarAsiento(13)">13</div>
                        <div class="asiento as14" onclick="reservarAsiento(14)">14</div>
                        <div class="asiento as17" onclick="reservarAsiento(17)">17</div>
                        <div class="asiento as18" onclick="reservarAsiento(18)">18</div>
                        <div class="asiento as21" onclick="reservarAsiento(21)">21</div>
                        <div class="asiento as22" onclick="reservarAsiento(22)">22</div>
                        <div class="asiento as25" onclick="reservarAsiento(25)">25</div>
                        <div class="asiento as26" onclick="reservarAsiento(26)">26</div>
                        <div class="asiento as29" onclick="reservarAsiento(29)">29</div>
                        <div class="asiento as30" onclick="reservarAsiento(30)">30</div>
                        <div class="asiento as33" onclick="reservarAsiento(33)">33</div>
                        <div class="asiento as34" onclick="reservarAsiento(34)">34</div>
                    </div>


                    <div class="lado-derecho asiento-posicion">
                        <div class="asiento as3" onclick="reservarAsiento(3)">3</div>
                        <div class="asiento as4" onclick="reservarAsiento(4)">4</div>
                        <div class="asiento as7" onclick="reservarAsiento(7)">7</div>
                        <div class="asiento as8" onclick="reservarAsiento(8)">8</div>
                        <div class="asiento as11" onclick="reservarAsiento(11)">11</div>
                        <div class="asiento as12" onclick="reservarAsiento(12)">12</div>
                        <div class="asiento as15" onclick="reservarAsiento(15)">15</div>
                        <div class="asiento as15" onclick="reservarAsiento(16)">15</div>
                        <div class="asiento as19" onclick="reservarAsiento(19)">19</div>
                        <div class="asiento as20" onclick="reservarAsiento(20)">20</div>
                        <div class="asiento as23" onclick="reservarAsiento(23)">23</div>
                        <div class="asiento as24" onclick="reservarAsiento(24)">24</div>
                        <div class="asiento as27" onclick="reservarAsiento(27)">27</div>
                        <div class="asiento as28" onclick="reservarAsiento(28)">28</div>
                        <div class="asiento as31" onclick="reservarAsiento(31)">31</div>
                        <div class="asiento as32" onclick="reservarAsiento(32)">32</div>
                        <div class="asiento as35" onclick="reservarAsiento(35)">35</div>
                        <div class="asiento as36" onclick="reservarAsiento(36)">36</div>
                    </div>
                </div>
            </div>
            
            <div class="asiento-buttons">
                <input id="tarjeta" type="number" class="asiento-continuar" placeholder="ingrese numero de tarjeta" style="font-size:11px;color:black!important;width:250px;text-align:center;">
                <button id="conf_compra" class="asiento-atras" >confirmar compra</button>
                <!--<button class="asiento-continuar">Continuar</button>-->
            </div>
            
            
        </div>
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


    <script>

    const confirm = document.querySelector("#conf_compra");

    // Variables PHP
    var idOmnibus = <?php echo $idOmnibus; ?>;
    var idServicio = <?php echo $idServicio; ?>;
    var id_usuario = <?php echo $id_usuario; ?>;
    var asiento;

    // Función para redirigir a la URL con los parámetros
    function reservarAsiento(numAsiento) 
    {
       
        const x = document.querySelector(".as" + numAsiento); 
        x.style.backgroundColor = "#e79115";
        asiento = numAsiento;
    }

    confirm.addEventListener("click", ()=> 
    {
        const tarjeta = document.querySelector("#tarjeta");
        if(esNumeroTarjetaValido(tarjeta.value))
        {
            window.location.href = '<?php echo URL; ?>?c=Reserva&m=pasaje&idOmnibus=' + idOmnibus + '&idServicio=' + idServicio + '&id_usuario=' + id_usuario + '&numAsiento=' + asiento;
        }else 
        {
            alert("numero de tarjeta inválido")
        }
    })


    function esNumeroTarjetaValido(numeroTarjeta) 
    {
        numeroTarjeta = numeroTarjeta.replace(/[-\s]/g, '');

        if (!/^\d+$/.test(numeroTarjeta)) return false;


        var digitos = numeroTarjeta.split('').map(Number).reverse();

        var suma = 0;
        for (var i = 0; i < digitos.length; i++) {
            var digito = digitos[i];
            if (i % 2 === 1) {
                digito *= 2;
                if (digito > 9) {
                    digito -= 9;
                }
            }
            suma += digito;
        }

        return suma % 10 === 0;
    }


    </script>

</body>
</html>