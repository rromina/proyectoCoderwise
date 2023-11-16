<?PHP 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ViaUY</title>

        <!-- CSS inicio website --> 
        <link rel="stylesheet" href="public/css/style.css">

        <!-- fontAwesome dependences -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
    <?php require 'src/vista/menu.php'; ?>
    <?php 
        if(isset($_SESSION['reserva']) && $_SESSION['reserva']===true)
        {
            $datosPasaje = $_SESSION['datosPasaje'];
            

            try {
                $mail = new PHPMailer();

                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
    
                //configuracion de cuenta
                $mail->Username = 'paradise5425@gmail.com';
                $mail->Password = 'lvpw hllh xvdf uumg';
                $mail->setFrom('paradise5425@gmail.com', 'Viauy');
    
                //destinatario
                $mail->addAddress($datosPasaje['correoUsuario'], 'cliente viauy');
    
                $mail->Body = "Confirmamos que su reserva de pasaje ha sido registrada con exito.<br><br>Datos de reserva:<br>asiento: " . $datosPasaje['numAsiento'] . "<br>fecha reserva: " . $datosPasaje['fechaActual'] . "<br>correo reserva: " . $datosPasaje['correoUsuario'] . "<br>identificador omnibus: " . $datosPasaje['idOmnibus'] ."<br><br><br>Muchas gracias por confiar en nosotros.";
    
                $mail->Subject = 'reserva de pasaje en viauy';
                $mail->AltBody = 'reserva de pasaje en viauy';
                
                $mail->SMTPDebug = 0;
    
                if( $mail->send())
                {
                    echo '<script>Swal.fire({position: "top-end",icon: "success",title: "Reserva confirmada con exito",showConfirmButton: false,timer: 4500});</script>';
                    unset($_SESSION['datosPasaje']);
                    unset($_SESSION['reserva']);
                }else 
                {
                    echo "<script>console.error(Hubo un error al enviar el correo: " . $mail->ErrorInfo . ");</script>";
                }

            }catch (Exception $e) 
            {
                echo "Error al enviar el correo: " . $mail->ErrorInfo;
            }
            
        }
    ?>

    <!-- inicio website --> 
    <div class="main inicio">
            <div class="travel">
                <h1>¿A dónde quieres ir?</h1>
                <div class="travel-select">
                    <h2>Compra tu pasaje</h2>
                    <div class="travel-buttons">
                        <button class="buttons" id="go" style="background-color: #E79115;">solo ida</button>
                        <button class="buttons" id="back">ida / vuelta</button>
                    </div>
                    <form class="pasaje" action="<?php echo URL . "?c=Servicios&m=consulta_travel"; ?>" method="POST">
                        <div class="input-travel-box">
                            <div class="input-travel">
                                <label for="">Origen</label>
                                <div class="icon-input-travel">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <input type="text" placeholder="Indique punto de origen" name="origen" required>
                                </div>
                                
                            </div>
                            <div class="input-travel">
                                <label for="">Destino</label>
                                <div class="icon-input-travel">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <input type="text" placeholder="Indique punto de destino" name="destino" required>
                                </div>
                                
                            </div>
                            <div class="input-travel">
                                <label for="">Fecha de Ida</label>
                                <div class="icon-input-travel">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="date" class="icon-none" required>
                                </div>
                                
                            </div>
                            <div class="input-travel" id="day-back">
                                <label for="">Fecha de Regreso</label>
                                <div class="icon-input-travel">
                                    <i id="icon-position" class="fa-solid fa-calendar-days"></i>
                                    <input id="input-back" type="date" class="icon-none" placeholder="fecha">
                                </div>
                                
                            </div>
                            <div class="input-travel">
                                <label for="">Cantidad de Asientos</label>
                                <div class="icon-input-travel">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <select name="departamentos" id="amount-seatings">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <input class="travel-search search" type="submit" value="Buscar">
                    </form>
                    
                </div>
            </div>

        </div>

        <div class="main2">
            <div class="content-main2">
                <h2>Servicios</h2>
                <hr>
                <div class="services-box">
                    <div class="services">
                        <i class="fa-solid fa-bus-simple services-icon" style="color: #141414;"></i>
                        <h3>Transporte</h3>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                            Iure officia consequatur sapiente delectus ratione nihil
                            sunt dolorem assumenda harum. Animi debitis possimus, 
                            aspernatur quas accusantium magni doloremque assumenda 
                            molestiae blanditiis.
                        </p>
                    </div>

                    <div class="services">
                        <i class="fa-regular fa-clock services-icon" style="color: #141414;"></i>
                        <h3>Horarios</h3>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                            Iure officia consequatur sapiente delectus ratione nihil
                            sunt dolorem assumenda harum. Animi debitis possimus, 
                            aspernatur quas accusantium magni doloremque assumenda 
                            molestiae blanditiis.
                        </p>
                    </div>

                    <div class="services">
                        <i class="fa-regular fa-money-bill-1 services-icon" style="color: #141414;"></i>
                        <h3>Costos</h3>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                            Iure officia consequatur sapiente delectus ratione nihil
                            sunt dolorem assumenda harum. Animi debitis possimus, 
                            aspernatur quas accusantium magni doloremque assumenda 
                            molestiae blanditiis.
                        </p>
                    </div>
                </div>
            </div>


            <div class="content-two-main2">
                <h2>Viajes Destacados</h2>
                <hr>
                <div class="city-box">
                    <div class="city">
                        <img src="public/img/montevideo.jpg" class="img-city" alt="">
                        <h3>Montevideo</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Eaque quia natus suscipit aliquid beatae, corporis similique 
                            molestiae optio a voluptates consequuntur sed saepe nihil 
                            ratione ab alias temporibus accusamus dolor.
                        </p>
                    </div>
                    <div class="city">
                        <img src="public/img/colonia.jpg" class="img-city" alt="">
                        <h3>Colonia</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Eaque quia natus suscipit aliquid beatae, corporis similique 
                            molestiae optio a voluptates consequuntur sed saepe nihil 
                            ratione ab alias temporibus accusamus dolor.
                        </p>
                    </div>
                    <div class="city">
                        <img src="public/img/atlantida.jpg"  class="img-city" alt="">
                        <h3>Canelones</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Eaque quia natus suscipit aliquid beatae, corporis similique 
                            molestiae optio a voluptates consequuntur sed saepe nihil 
                            ratione ab alias temporibus accusamus dolor.
                        </p>
                    </div>
                    <div class="city">
                        <img src="public/img/punta-del-este.avif" class="img-city" alt="">
                        <h3>Maldonado</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                            Eaque quia natus suscipit aliquid beatae, corporis similique 
                            molestiae optio a voluptates consequuntur sed saepe nihil 
                            ratione ab alias temporibus accusamus dolor.
                        </p>
                    </div>
                </div>

            </div>


            <div class="content-three-main2">
                <h2>¡Tu primera opción en transporte!</h2>
            </div>


            
        </div>
        
        <?php require 'src/vista/footer.php'; ?>
    </body>

    <!-- JS inicio website -->
    <script src="public/js/index.js"></script>
    <script src="public/js/reserva.js"></script>
    <script src="public/js/scroll-control.js"></script>

</html>