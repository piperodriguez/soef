<?php
    // Initialize the session
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>

   <!---->
    <div class="page-header1">
     <nav class="nav nav-pills flex-column flex-sm-row">
      <img src="../img/logo.jpeg" class="float-right">
      <div class="card">
      <div class="card-body">
      <h3>Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>&nbsp;&nbsp;Bienvenido a SOEF&nbsp;<a href="logout.php" class="card-link"><br>Cerrar sesión</h3></a>
      </div>
      </div>
      </nav>
    </div>

   <!---->     
  <div class="centro">
        <img src="../img/team-banner2.jpg" class="img-fluid" alt="Responsive image">
  </div>
   
  <!---->
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
   <div class="button-center">
      <br>
      <br>
      <a href="Welcome.php"><button type="button" class="btn btn-secondary btn-lg">Home</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-secondary btn-lg">Mi Cuenta</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-secondary btn-lg">Cambiar Contraseña</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-secondary btn-lg">Ofertas Laborales</button></a> 
      <a href="logout.php"><button type="button" class="btn btn-secondary btn-lg">Cerrar sesión</button></a>    
  </div>
  </nav>

  <!---->
    <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="section-title">
            <h2 class="head-title">Busquedas recomendadas para ti</h2>
            <hr class="botm-line">
            <p class="sec-para">Algunos de los empleos que te puedan interesar</p>
          </div>
        </div>
        <div class="col-md-9 col-sm-12">
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
        </div>
      </div>
    </div>
  </section>

  <!----->

  <section class="section-padding parallax bg-image-2 section wow fadeIn delay-08s" id="cta-2">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="cta-txt">
            <h3>Para mas informacion contactanos</h3>
            <p>




            </p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <a href="#" class="btn btn-submit">info@soef.com.co</a>
          <a href="#" class="btn btn-submit">(57)310-649-3104</a>
        </div>
      </div>
    </div>
  </section>

<footer class="blockquote-footer" id="footer">
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
</body>
</html>