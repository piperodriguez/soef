<?php
  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
  }

  require_once "../../connect/config.php";

  $validar = "SELECT concat(nombre,' ',apellido) as nombre, celular, email FROM personas";

  $data = $cn->query($validar);	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<title>Listado de Usuarios Registrados</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/>
</head>
<body>
<nav class="navbar navbar-inverse">
   <div class="container-fluid">
      <div class="navbar-header">
         <a class="navbar-brand" href="#">Soef</a>
      </div>
      <ul class="nav navbar-nav">
         <li><a href="../../login/index.php">Inicio</a></li>
         <li><a href="../servicios/index.php">Servicios</a></li>
         <li  class="active"><a href="../Usuarios/listUsers.php">Lista de personas Registradas</a></li>
      </ul>
   </div>
</nav>
<div class="container">
   <table id="listPerson" class="table" style="width:100%">
      <thead>
         <tr>
            <th>Nombre</th>
            <th>Celular</th>
            <th>Email</th>
         </tr>
      </thead>
      <tbody>
         <?php while ($validacion = $data->fetch_array()) { ?>
         <tr>
            <td><?=$validacion["nombre"]?></td>
            <td><?=$validacion["celular"]?></td>
            <td><?=$validacion["email"]?></td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
</div>
	<script src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    	$('#listPerson').DataTable();
		} );
	</script>
</body>
</html>