<?php
   // Initialize the session
   session_start();
   
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location: index.php");
     exit;
   }
  $fecha = date("Y/m/d");
   require_once "../connect/config.php";
   
   $xxx = $_SESSION["id"];
   
   $sql = "SELECT id_rol FROM users WHERE id = $xxx";
   
   if (!$resultado = $cn->query($sql)) {
       // ¡Oh, no! La consulta falló. 
       echo "Lo sentimos, este sitio web está experimentando problemas.";
       // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
       // cómo obtener información del error
       echo "Error: La ejecución de la consulta falló debido a: \n";
       echo "Query: " . $sql . "\n";
       echo "Errno: " . $cn->errno . "\n";
       echo "Error: " . $cn->error . "\n";
   
       exit;
   
   }else{
   
     while($row = $resultado->fetch_assoc()) {
   
         $id_rol = $row["id_rol"];
     }
   
   }
   /*proceso para pintar la imagen de la persona*/
   $datosUser = "SELECT personas.id_persona
                 FROM personas
                 INNER JOIN users ON users.id = personas.id
                 WHERE personas.id = $xxx";
   
   $result = $cn->query($datosUser);
   
   $id = null;

   while($row = $result->fetch_assoc()) {
   
       $id = $row["id_persona"];
   }     
   
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Bienvenido a Soef</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
   </head>
   <body>
      <!--nav-->
      <nav class="nav navbar-default navbar-fixed-top">
         <div class="container">
            <div class="col-md-12">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                  <span class="fa fa-bars"></span>
                  </button>
                  <a href="index.html" class="navbar-brand">SOEF</a>
               </div>

                  <?php
                     $extension = array('JPG','png','jpeg');
                     
                     foreach ($extension as $key => $value) {
                     
                     $img = $id.".".$value;
                     $file = 'photos/'.$img;
                     
                     if (is_readable($file)) {
                               
                     /*
                      * is_readable esta funcion sirve para validar qwue existe 
                      * un archivo
                     */
                     
                      echo "<img src='$file' class='rounded-circle' id='profile'>";
                     
                     
                             }
                     }
                     
                     ?>

                  <div class="collapse navbar-collapse navbar-right" id="mynavbar">
                  <h3><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>&nbsp;&nbsp;Bienvenido a SOEF&nbsp;<a href="logout.php" class="card-link"></h3><a href="logout.php"><b>Cerrar sesión</b></a>
                  </a>
               </div>
            </div>
         </div>
      </nav>

      <!---->
      <br>
      <br>
      <br>     
      <div class="centro">
         <img src="../img/team-banner2.jpg" class="img-fluid" alt="Responsive image">
      </div>

      <!---->
      <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="section-title">
                  <?php if ($id_rol ==1) {
              echo '<a href="../config/servicios/index.php"><button type="button" class="btn btn-danger btn-lg">Configuraciones</button></a>';
            }else{
              //echo "nada";
            } 
      ?>
          </div>
        </div>

      
    <div class="col-md-9 col-sm-12">
      <a href="myprofile.php"><button type="button" class="btn btn-success btn-lg">Mi Cuenta</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-default btn-lg"> Completar registro</button></a>
      <a href="reset-password.php"><button type="button" class="btn btn-warning btn-lg">Cambiar Contraseña</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-primary btn-lg">Ofertas Laborales</button></a>   
        </div>
      </div>
    </div>
  </section>

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
                        <img src="../img/espera.jpg" alt="" class="img-responsive">
                     </div>
                  </div>
                  <!--<div class="col-md-4 col-sm-6 padding-right-zero">
                     <div class="portfolio-box design">
                        <img src="../img/port02.jpg" alt="" class="img-responsive">
                     </div>
                  </div>-->
                  <div class="col-md-4 col-sm-6 padding-right-zero">
                     <div class="portfolio-box design">
                        <img src="../img/espera.jpg" alt="" class="img-responsive">
                     </div>
                  </div>
                  <!--<div class="col-md-4 col-sm-6 padding-right-zero">
                     <div class="portfolio-box design">
                        <img src="../img/port04.jpg" alt="" class="img-responsive">
                     </div>
                  </div>-->
                  <div class="col-md-4 col-sm-6 padding-right-zero">
                     <div class="portfolio-box design">
                        <img src="../img/espera.jpg" alt="" class="img-responsive">
                     </div>
                  </div>
                 <!--<div class="col-md-4 col-sm-6 padding-right-zero">
                     <div class="portfolio-box design">
                        <img src="../img/port06.jpg" alt="" class="img-responsive">
                     </div>
                  </div>-->
               </div>
            </div>
         </div>
      </section>

    <footer class="" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 footer-copyright">
          
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bethany
            -->
            © InnoWeb - <?= $fecha;?>
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

      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
   </body>
</html>