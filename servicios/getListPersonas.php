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
<script src="../js/selectProfesiongrupal.js"></script>
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">

</head>
<body onload="getServiciosgrupal()">
    <div class="container">
      <div class="row">
        <div class="col-md-4" id="serviciosListgrupal"></div> 
        <div class="col-md-4" id="profesionesListgrupal"></div> 
        <div class="col-md-12" id="gridPersonas"></div>
      </div>
      <div class="container" id="DetallePersona">
        
      </div>
    </div>

</script>
</body>
</html>