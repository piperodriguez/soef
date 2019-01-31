<?php
  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
  }
  $fecha = date("Y/m/d");

  require_once "../../connect/config.php";

  $cook = $_SESSION["id"];

  $validar = "SELECT personas.id, personas.id_persona
              FROM personas
              INNER JOIN users ON users.id = personas.id
              WHERE personas.id = $cook";

  $result = $cn->query($validar);

  while($row = $result->fetch_assoc()) {

      $id = $row["id_persona"];

  }

  $fecha = date("Y/m/d");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Listado de Servicios</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <style type="text/css">
    .linea
    {
      display: inline-block;
    }
    #servicios{
      margin-top: 10%;
    }

#footer2 {
    background-color: #191919;
    padding: 20px 0px;
    position: fixed;
    bottom: 0;
    width: 100%;
}
  </style>
  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>  
</head>
<body>
	      <nav class="nav navbar-default navbar-fixed-top">
         <div class="container">
            <div class="col-md-12">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                  <span class="fa fa-bars"></span>
                  </button>
                  <a href="../../login/welcome.php" class="navbar-brand">SOEF</a>
               </div>

                  <?php
                     $extension = array('JPG','png','jpeg');
                     
                     foreach ($extension as $key => $value) {
                     
                     $img = $id.".".$value;
                     $file = '../../login/photos/'.$img;
                     
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
	<div class="container" id="servicios">
		<div class="header well">
      <button type="submit" class="services btn btn-primary">Servicios <i class="fas fa-balance-scale"></i></button>
      <button type="submit" class="profesion btn btn-primary">Profesiones <i class="fas fa-briefcase"></i></button>
      <button type="submit" class="listBarrio btn btn-primary">Barrios <i class="fas fa-user-friends"></i></button>
      <button type="submit" class="listUser btn btn-primary">Usuarios Registrados <i class="fas fa-user-friends"></i></button>
      <button class="insertServicio btn btn-success" style="float: right !important;">Nuevo Servicio <i class="fas fa-plus-square"></i></button>
		</div>
	</div>
  <div class="container">
      <div class="contenido">
        <h2>Listado de Servicios</h3>
        <i class="fas fa-balance-scale fa-5x col-md-offset-1"></i>
      </div>
      <div class="formularios"></div>
  </div>
    <footer id="footer2">
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
<script src="../../js/coreServicios.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $(".services").click(function(){
      location.reload();
    });

    $(".profesion").click(function(){
      window.location.href = "../profesiones/index.php";
    });

    $(".listUser").click(function(){
      window.location.href = "../Usuarios/listUsers.php";
    });

    $(".listBarrio").click(function(){
      window.location.href = "../barrios/index.php";
    });
  });
</script>
</body>
</html>