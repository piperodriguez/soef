<?php
	session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
	}

	$fecha = date("Y/m/d");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		p{
  			font-size:20px;
  		}
		a.nav-link {
		    font-size: 16px !important;
		}
  	</style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <a class="navbar-brand" href="welcome.php">
    <img src="../img/logo.jpeg" alt="Logo" style="width:50px;">
  </a>
  ...
    <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>
</nav>
<div class="media">
  <img src="../img/img_avatar1.png" class="align-self-start mr-3" style="width:60px">
  <div class="media-body">
    <h4>Bienvenido</h4>
    <p><?php echo htmlspecialchars($_SESSION["username"]); ?> ...</p>
  </div>
</div>


<div class="container mt-3">
  <h2>Llena tu curriculum</h2>
  <p>Completa la información para compartir tus servicios laborales:</p>
  <div class="media border p-3">
    <img src="../img/img_avatar3.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
    <div class="media-body">
      <h4>Juan Felipe <small><i>Posted on <?=$fecha;?></i></small></h4>
      <p>Aqui va el formulario de la hoja de vida sweet</p>      
    </div>
  </div>
</div>
	
</div>


</body>
</html>
