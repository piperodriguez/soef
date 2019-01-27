<!DOCTYPE html>
<html lang="es">
<head>
	<title>Listado de Servicios</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
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
	<div class="container">
		<div class="header">
			<h3>Listado de Servicios</h3>
		</div>
		<div class="wrapper">
			<div class="contenido"></div>
			<div class="options">
			<!--con la clase insertAuto es llamada del archivo core.js-->
				<button class="insertServicio btn btn-success">nuevo Servicio</button>
			</div>
			<div class="formularios"></div>
		</div>
	</div>

<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/coreServicios.js"></script>
</body>
</html>