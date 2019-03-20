<?php 
	require_once "../connect/config.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<title>Servicios Soef</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
	<script src="../js/jquery.min.js"></script>
<script src="../js/selectProfesiongrupal.js"></script>

</head>
<body onload="getServiciosgrupal()">

  <nav class="nav navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                <span class="fa fa-bars"></span>
              </button>

              <a href="../index.php" class="navbar-brand">SOEF</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mynavbar">
              <ul class="nav navbar-nav">
                <li><a href="http://localhost/soef/login/index.php">HOME</a></li>
                <li><a href="http://localhost/soef/login/registro.php">Registrate</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!--/ nav-->
      <br>
  <br>
  <br>
  <br>
  <br>
  <br>
        <center><img src="../img/image20.jpg" class="img-fluid" alt="Responsive image"></center>
  
  <br>
  <br>
  <br>
  <br>
    <div class="container">
      <div class="row">
        <div class="col-md-4" id="serviciosListgrupal"></div> 
        <div class="col-md-4" id="profesionesListgrupal"></div> 
        <div class="col-md-12" id="gridPersonas"></div>
      </div>
      <div class="container" id="DetallePersona">
        
      </div>
    </div>
  <br>
  <br>
  <br>
</script>
</body>
</html>