<?php 
	require_once "../connect/config.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<title>Servicios Soef</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/jquery.min.js"></script>
<script src="../js/selectProfesion.js"></script>
</head>
<body onload="getServicios()">
  <!---->
    
    <div class="container">
      <div class="row">
        <div class="col-md-4" id="serviciosList"></div> 
        <div class="col-md-4" id="profesionesList"></div> 
        <div class="col-md-4" id="personasList"></div>
      </div>
    </div>
  <!---->


</body>
</html>