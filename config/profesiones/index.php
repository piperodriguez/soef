<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Listado de Profesiones</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Soef</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="../../login/index.php">Inicio</a></li>
	      <li><a href="../servicios/index.php">Servicios</a></li>
	      <li><a href="../Usuarios/listUsers.php">Lista de personas Registradas</a></li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
		<div class="header">
			<h3>Listado de Profesiones</h3>
		</div>
		<div class="wrapper">
			<div class="contenido"></div>
			<div class="options">
			<!--con la clase insertAuto es llamada del archivo core.js-->
				<button class="insertServicio btn btn-success">nueva Profesion</button>
			</div>
			<div class="formularios"></div>
		</div>
	</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/coreProfesiones.js"></script>
</body>
</html>