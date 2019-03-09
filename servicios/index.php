<?php 
	require_once "../connect/config.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">	
	<title>Servicios Soef</title>
	<script src="../js/jquery.min.js"></script>
<script src="../js/selectProfesion.js"></script>
</head>
<body onload="getServicios()">
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


</body>
</html>