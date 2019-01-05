<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
// Include config file
require_once "../connect/config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($cn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($cn);
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SOEF</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/animate.css">
  <link rel="stylesheet" type="text/css" href="../css/flexslider.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="../js/selectProfesion.js"></script>  
</head>

<body onload="getServicios()">
  <!--header-->
  <header class="main-header" id="header">
    <!--<div class="bg-color">-->
      <!--nav-->
      <nav class="nav navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                <span class="fa fa-bars"></span>
              </button>

              <a href="#" class="navbar-brand" onclick="getServicios()">SOEF</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mynavbar">
              <ul class="nav navbar-nav">
                <li><a href="#header">HOME</a></li>
                <li><a href="#feature">¿Que somos?</a></li>
                <li><a href="#portfolio">Servicios</a></li>
                <li><a href="#contact">Contáctenos</a></li>
                <li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!--/ nav-->
            <div class="flexslider">
              <ul class="slides">
                <li>
                  <img src="../img/image.jpg" alt="">
                  <section class="flex-caption">
                    <p>Soluciones</p>
                  </section>
                  <li>
                  <img src="../img/oficina.jpg" alt="">
                  <section class="flex-caption">
                  <p>Eficientes</p>
                  </section>
                </li>
                <li>
                  <img src="../img/object.png" alt="">
                  <section class="flex-caption">
                    <p>¡ a tu alcance !</p>
                  </section>
                </li>
              </ul>
            </div>
        <!--<div class="container text-center">
        <div class="wrapper wow fadeInUp delay-05s">
          <h2 class="top-title">Soluciones</h2>
          <h3 class="title" id="titlehome">Eficientes</h3>
          <h4 class="sub-title">¡ a tu alcance !</h4>
        </div>
        </div>-->
  </header>
  <!--/ header-->
  <!---->
  <section id="cta-1">
    <div class="container">
      <div class="row">
        <div class="cta-info text-center">
          <h3>
            <h2>“Le da las herramientas necesarias para que encuentre los servicios que necesita”</h2>
          </h3>
        </div>
      </div>
    </div>
  </section>
  <!---->
  <!---->
  <?php

    $servicios = "SELECT servicios.nombre, servicios.id_servicio
                  FROM servicios";

    $queryServicios = $cn->query($servicios);


  ?>
    <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="section-title">
            <h2 class="head-title">Algunos de nuestros servicios</h2>
            <hr class="botm-line">
            <p class="sec-para">Le presentamos algunos de los servicios que aquí podra encontrar y que usted 
            puede contrartar con los mejores recursos humanos de la ciudad.</p>
          </div>
        </div>
        <div class="col-md-9 col-sm-12">
          <?php while($fetch = $queryServicios->fetch_assoc()) { ?>
          <div class="col-md-4 col-sm-6 padding-right-zero">
              <div class="portfolio-box design">
              <h2><?php echo $fetch["nombre"]; ?></h2>
              <?php

                $profesiones = "SELECT profesion.nombre as profesiones
                FROM profesion 
                WHERE id_servicio =".$fetch["id_servicio"];

                $queryProfesion = $cn->query($profesiones);                

                while($fetch2 = $queryProfesion->fetch_assoc()) {

                  echo "<br>".$fetch2["profesiones"]."<br>";
                }

              ?>
              </div>
              <div class="portfolio-box design">
              
              </div>
          </div>
          <?php } ?>
        </div>
      <!-- <div class="col-md-9 col-sm-12">
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port01.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port02.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port03.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port04.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port05.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div class="col-md-4 col-sm-6 padding-right-zero">
            <div class="portfolio-box design">
              <img src="../img/port06.jpg" alt="" class="img-responsive">
            </div>
          </div>
        </div>-->
      </div>
    </div>
  </section>

  <!---->
    <section class="section-padding parallax bg-image-2 section wow fadeIn delay-08s" id="cta-2" style="height: 350px!important;">
    <div class="container">
      <div class="row">
        <div class="col-md-4" id="serviciosList"></div> 
        <div class="col-md-4" id="profesionesList"></div> 
        <div class="col-md-4" id="personasList"></div>
      </div>
    </div>
  </section>
  <!---->

  <section id="feature" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-3 wow fadeInLeft delay-05s">
          <div class="section-title">
            <img src="../img/logo.jpeg" class="img-responsive img-rounded" id="logoIndex">
            <hr class="botm-line">
            <p class="sec-para">Le da las herramientas necesarias para que encuentre el personal adecuado para cumplir con las labores que usted requiere.</p>
          </div>
        </div>
        <div class="col-md-9">
          <div class="col-md-6 wow fadeInRight delay-02s">
            <div class="icon">
              <i class="fa fa-lightbulb-o"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">Misión</h3>
              <p class="txt-para">Ofrecer a nuestros clientes el personal capacitado, para que realicen la labor que ellos necesiten, de una manera fácil, rápida y segura.</p>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight delay-02s">
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">Visión</h3>
              <p class="txt-para">Ser la empresa de servicios de personal  más confiable y utilizada en el departamento de Boyacá, brindando las mejores soluciones a nuestros clientes. </p>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight delay-04s">
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">Objetivo</h3>
              <p class="txt-para">La empresa “SOEF” le da las herramientas necesarias al cliente, ya sea una persona natural o jurídica, para que encuentre el personal  adecuado para cumplir ciertas funciones,  este personal lo puede encontrar a través de la página web, o si lo desea puede contratar personal de la empresa “SOEF”.</p>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight delay-04s">
            <div class="icon">
              <i class="fa fa-user-check"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">Servicios</h3>
              <p class="txt-para">Ofrecemos el servicio de la página web para que los clientes encuentren personal  para trabajos cortos, de una manera fácil, rápida y segura. También “SOEF” presta el servicio de meseros, aseadoras, staff, animadores, entre otros.</p>
            </div>
          </div>
         <!-- <div class="col-md-6 wow fadeInRight delay-06s">
            <div class="icon">
              <i class="fa fa-lightbulb-o"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">High Coversion</h3>
              <p class="txt-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula felis euismod semper. </p>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight delay-06s">
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="icon-text">
              <h3 class="txt-tl">Save Tons of Time</h3>
              <p class="txt-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula felis euismod semper. </p>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding wow fadeInUp delay-05s" id="contact">
    <div class="container">
      <div class="row white">
        <div class="col-md-8 col-sm-12">
          <div class="section-title">
            <h2 class="head-title black">Contáctenos</h2>
            <hr class="botm-line">
            <p class="sec-para black">Dejanos saber tus comentarios, opiniones y necesidades o si necesitas recibir una asesoría completa sobre alguno de nuetros servicios. </p>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <div class="col-md-4 col-sm-6" style="padding-left:0px;">
            <h3 class="cont-title">Escríbenos!</h3>
            <div id="sendmessage">Nuestro mensaje ha sido enviado. Gracias</div>
            <div id="errormessage"></div>
            <div class="contact-info">
              <form action="" method="post" role="form" class="contactForm">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Por favor ingrese al menos 4 caractere" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico" data-rule="email" data-msg="
                   Por favor introduzca una dirección de correo electrónico válida" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="
                    Por favor ingrese al menos 8 caracteres al asunto" />
                  <div class="validation"></div>
                </div>

                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="por favor escriba su" placeholder="mensaje"></textarea>
                  <div class="validation"></div>
                </div>
                <button type="submit" class="btn btn-send">Enviar</button>
              </form>
            </div>

          </div>
          <div class="col-md-4 col-sm-6">
            <h3 class="cont-title">Más información</h3>
            <div class="location-info">
              <p class="white"><span aria-hidden="true" class="fa fa-map-marker"></span>Cra 10 n 52-06 Tunja - Boyacá</p>
              <p class="white"><span aria-hidden="true" class="fa fa-phone"></span>Teléfono: 310-649-31-04</p>
              <p class="white"><span aria-hidden="true" class="fa fa-envelope"></span>Email: <a href="" class="link-dec">info@soef.com.co</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-icon-container hidden-md hidden-sm hidden-xs">
              <span aria-hidden="true" class="fas fa-users"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <label id="zoe"></label>
  <!---->
  <!---->
  <footer class="" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 footer-copyright">
          © Bethany Theme - All rights reserved
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bethany
            -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
        <div class="col-sm-5 footer-social">
          <div class="pull-right hidden-xs hidden-sm">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--Ventana Modal-->
  <div class="container">
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                      <label>Username</label>
                       <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                      <span class="help-block"><?php echo $username_err; ?></span>
                  </div>    
                  <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control">
                      <span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Login">
                  </div>
                  <p>¿No tienes una cuenta? <a href="registro.php">Regístrate ahora</a>.</p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="registro()">Registrate</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
      </div>
    </div>
  </div>


  <!--contact ends-->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/myscript.js"></script>
  <script src="../js/wow.js"></script>
  <script src="../js/custom.js"></script>
  <script src="../js/redireccion.js"></script>
  <script src="../contactform/contactform.js"></script>
  <script src="../js/jquery.flexslider.js"></script>
  <script src="../js/selectProfesion.js"></script>
</body>
</html>
