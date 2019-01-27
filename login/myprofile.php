<?php

    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: index.php");
    exit;

    }

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

    $x = $_SESSION["id"];

    $fecha = date("Y/m/d");

    $data ="SELECT
           users.id,
           personas.id_persona,
           CONCAT(personas.nombre,' ',personas.apellido) as nombre,
           personas.direccion,
           personas.formacion,
           personas.experiencia,
           personas.celular,
           personas.email,
           barrios.nombre as barrio,
           ciudad.nombre as ciudad,
           profesion.nombre as profesion
           FROM personas
           INNER JOIN users ON users.id = personas.id
           INNER JOIN barrios ON barrios.id_barrio = personas.id_barrio
           INNER JOIN ciudad ON ciudad.id_ciudad = barrios.id_ciudad
           INNER JOIN profesion ON profesion.id_profesion = personas.id_profesion
           WHERE personas.id = $x";

    $result = $cn->query($data);

      while($row = $result->fetch_assoc()) {

          $id = $row["id_persona"];
          $nombre = $row["nombre"];
          $direccion = $row["direccion"];
          $formacion = $row["formacion"];
          $experiencia = $row["experiencia"];
          $celular = $row["celular"];
          $email = $row["email"];
          $barrio = $row["barrio"];
          $ciudad = $row["ciudad"];
          $profesion = $row["profesion"];

      }
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Perfil</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css/myprofile.css">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <style type="text/css">
         .navbar-inverse .navbar-nav>li>a {
         color: white;
         }
         .nav>li>a {   
         padding-top: 26px;
         font-size: 18px;
         }
      </style>
   </head>
   <body>
      <!--<nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="navbar-header">
               <img src="../img/logo.jpeg" class="float-right" style="margin-right: 30px;">
            </div>
            <ul class="nav navbar-nav">
               <li><a href="index.php">Home |</a></li>
               <li><a href="dataperson.php">Datos |</a></li>
               <li><a href="curriculum.php">Curriculum |</a></li>
            </ul>
         </div>
      </nav>-->

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
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
          <section class="section-padding wow fadeInUp delay-02s" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="section-title">
                  <?php if ($id_rol ==1) {
              echo '<a href="../config/servicios/index.php"><button type="button" class="btn btn-secondary btn-lg">Configuraciones</button></a>';
            }else{
              //echo "nada";
            } 
      ?>
          </div>
        </div>

      
    <div class="col-md-9 col-sm-12">
      <a href="myprofile.php"><button type="button" class="btn btn-secondary btn-lg">Mi Cuenta</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-secondary btn-lg"> Completar registro</button></a>
       <a href="curriculum.php"><button type="button" class="btn btn-secondary btn-lg">Hoja de Vida</button></a>
      <a href="reset-password.php"><button type="button" class="btn btn-secondary btn-lg">Cambiar Contraseña</button></a>
      <a href="dataperson.php"><button type="button" class="btn btn-secondary btn-lg">Ofertas Laborales</button></a>   
        </div>
      </div>
    </div>
  </section>
      <div class="container emp-profile">
         <form method="post">
            <div class="row">
               <div class="col-md-4">
                  <div class="profile-img">
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
                                  echo "<img src='$file'  style=''height:200px;>";
                                }
                        }

                    ?>
       
                     <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="profile-head">
                     <h5>
                        <?= $nombre; ?>
                     </h5>
                     <h6>
                        <?= $fecha; ?>
                     </h6>
                     <!--<p class="proile-rating">RANKINGS : <span>8/10</span></p>-->
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Experiencia |</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tiempo Disponible</a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-2">
                  <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil"/>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="profile-work">
                     <p>INFORMACIÓN DE CONTACTO</p>
                     <a href="">Ciudad: <?= $ciudad;?></a><br/>
                     <a href="">Barrio: <?= $barrio;?></a><br/>
                     <a href="">Celular: <?= $celular;?></a><br/>
                     <a href="">Email: <?= $email;?> </a><br/>
                     <p>INFORMACIÓN LABORAL</p>
                     <a href="">Profesión: <?= $profesion;?> </a><br/>
                     <a href="">Web Developer</a><br/>
                     <a href="">WordPress</a><br/>
                     <a href="">WooCommerce</a><br/>
                     <a href="">PHP, .Net</a><br/>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="tab-content profile-tab" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                           <div class="col-md-6">
                              <label>User Id</label>
                           </div>
                           <div class="col-md-6">
                              <p>Kshiti123</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Name</label>
                           </div>
                           <div class="col-md-6">
                              <p>Kshiti Ghelani</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Email</label>
                           </div>
                           <div class="col-md-6">
                              <p>kshitighelani@gmail.com</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Phone</label>
                           </div>
                           <div class="col-md-6">
                              <p>123 456 7890</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Profession</label>
                           </div>
                           <div class="col-md-6">
                              <p>Web Developer and Designer</p>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                           <div class="col-md-6">
                              <label>Experience</label>
                           </div>
                           <div class="col-md-6">
                              <p>Expert</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Hourly Rate</label>
                           </div>
                           <div class="col-md-6">
                              <p>10$/hr</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Total Projects</label>
                           </div>
                           <div class="col-md-6">
                              <p>230</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>English Level</label>
                           </div>
                           <div class="col-md-6">
                              <p>Expert</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Availability</label>
                           </div>
                           <div class="col-md-6">
                              <p>6 months</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <label>Your Bio</label><br/>
                              <p>Your detail description</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
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
   </body>
</html>