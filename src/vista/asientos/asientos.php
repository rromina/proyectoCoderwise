<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/pago.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ViaUY Asientos</title>
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
                        <div class="asiento as1" onclick="reservarAsiento(1)">1</div>
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
                        <div class="asiento as16" onclick="reservarAsiento(16)">16</div>
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
                <button id="mostrarPago" class="asiento-continuar">Continuar</button>
            </div>
            
            
        </div>


        <div id="overlay">
            <div class="pago oculto" id="pago" onclick="detenerPropagacion(event)">
                <div id="content">
                    <i class="fa-solid fa-xmark" id="cerrar" onclick="ocultarOverlay()"></i>
                    <div>
                        <h3>Ingrese su tarjeta</h3>
                    </div>
                    <div class="form-pago">
                        <div class="pago-label">
                            <label for="">Nombre</label>
                            <input type="text" id="titular" placeholder="Ingrese nombre titular de la tarjeta">
                        </div>
                        <div class="pago-label">
                            <label for="">Número</label>
                            <input id="tarjeta" type="text" maxlength="16" placeholder="Ingrese número de tarjeta">
                        </div>
                        <div class="fecha-cvv">
                            <div class="pago-label">
                                <label for="">Fecha Vto.</label>
                                <input type="date" name="" id="venc-card" placeholder="fecha de vencimiento">
                            </div>
                            
                            <div class="pago-label">
                                <label for="">Código Seg.</label>
                                <input type="text" maxlength="3" name="" id="cvv" placeholder="CVV">
                            </div>
                        </div>
                        <button id="conf_compra" class="confirmar-compra">Confirmar Compra</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


  <?php require 'src/vista/footer.php'; ?>

  <script src="public/js/index.js"></script>
  <script src="public/js/compra.js"></script>

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

    let idOmnibus = <?php echo $idOmnibus; ?>;
    let idServicio = <?php echo $idServicio; ?>;
    let id_usuario = <?php echo $id_usuario; ?>;
    let asiento;

    function reservarAsiento(numAsiento) 
    {
       
        const x = document.querySelector(".as" + numAsiento); 
        x.classList.toggle('seleccionado');
        asiento = numAsiento;
    }


    const tarjeta = document.querySelector("#tarjeta");
    const cvv = document.querySelector("#cvv");

    tarjeta.addEventListener("input", function() {
        this.value = this.value.replace(/[^\d]/g, ''); 
    });

    cvv.addEventListener("input", function() {
        this.value = this.value.replace(/[^\d]/g, ''); 
    });

    confirm.addEventListener("click", () => {
        const titular = document.querySelector("#titular");
        const vencCard = document.querySelector("#venc-card");

        if (!titular.value || !esNumeroTarjetaValido(tarjeta.value) || !validarCVV(cvv.value) || !vencCard.value) {
            alert("Faltan campos por llenar o los datos son inválidos.");
        } else {
            window.location.href = '<?php echo URL; ?>?c=Reserva&m=pasaje&idOmnibus=' + idOmnibus + '&idServicio=' + idServicio + '&id_usuario=' + id_usuario + '&numAsiento=' + asiento;
        }
    });

    function esNumeroTarjetaValido(numeroTarjeta) {
        return /^\d{16}$/.test(numeroTarjeta);
    }

    function validarCVV(cvv) {
        return /^\d{3}$/.test(cvv);
    }


</script>

</body>
</html>
