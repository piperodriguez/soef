<?php
	session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
	}

  require_once "../connect/config.php";

	$fecha = date("Y/m/d");

  $query = $cn->query("SELECT * FROM barrios");


  $sql2 = "SELECT nombre FROM personas";
  $result=$cn->query($sql2);
  $row = $result->fetch_assoc();




  if($_SERVER["REQUEST_METHOD"] == "POST"){


    $id_usuario = $_POST["usuario"];    
    $barrio = $_POST["barrio"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $celular = $_POST["celular"];

    /*imagen*/
    if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0)
    {
      echo "Ha ocurrido un error."; 
    }else{

          $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");

          $limite_kb = 16384;

         if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024)
         {
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            $tipo = $_FILES['imagen']['type'];
            $fp = fopen($imagen_temporal, 'r+b');
            $data = fread($fp, filesize($imagen_temporal));
            fclose($fp);
            $data = mysqli_real_escape_string($cn,$data);

            $sql = "INSERT INTO personas (id_persona, id_usuario, id_barrio, nombre, apellido, celular, emai, imagen, tipo_imagen)VALUES(null,$id_usuario,$barrio,'$nombre','$apellido','$celular','$email','$data', '$tipo')";

            $resultado = mysqli_query($cn,$sql);

            if (!$resultado) {
              echo "Error de BD, no se pudo consultar la base de datos";
              echo "Error MySQL: ' . mysqli_error()";
              //exit;
            }else{
              echo "exito";
            }

         }else{

            echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
         }
    }

  }


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
	<script src="../js/redireccion.js"></script>  	
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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SOEF</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a class="dataPerson" href="#">Datos |</a></li>
      <li><a class="resetPassword" href="#">Cambiar de Contraseña |</a></li>
    </ul>
  </div>
</nav>
<h4>Bienvenido</h4>
    <p><?php echo htmlspecialchars($_SESSION["username"]); ?> ...</p>
<div class="container contenedor">
<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="usuario" value="<?php echo $_SESSION["id"];?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nombre">Nombre:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="apellido">Apellido:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su apellido">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="celular"># Ceuluar:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="celular" name="celular" placeholder="Enter Number phone">
    </div>
  </div>
  <div class="form-group">
    <label  class="control-label col-sm-2" for="barrio">Barrio:</label>
    <div class="col-sm-offset-2 col-sm-10">
      <select class="form-control" id="barrio" name="barrio">
        <option>Selecciona tu barrio</option>
        <?php

        while ($valores = mysqli_fetch_array($query)) {

          ?>


            <option value="<?php echo $valores["id_barrio"];?>"><?php echo $valores["nombre"]; ?></option>

        <?php
            
          }

        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen" class="form-control" />
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger active">Submit</button>
    </div>
  </div>
</form>
</div>

</body>
</html>