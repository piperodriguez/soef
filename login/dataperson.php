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

        $resultado = 0;
      $errors = '';


  if($_SERVER["REQUEST_METHOD"] == "POST"){


      if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0){
        // validamos ke la imagen exista y ke no tenga errores 
        $errors = "Ha ocurrido un error"; 
      }else{

          $permitidos = array("image/jpeg"); // declaramos un array para almacenar las extenxiones permitidas png, gif ecetera
          $limite_kb = 16384; 

            if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){ 

              $id_usuario = $_POST["usuario"];    
              $barrio = $_POST["barrio"];
              $nombre = $_POST["nombre"];
              $apellido = $_POST["apellido"];
              $email = $_POST["email"];
              $celular = $_POST["celular"];
              $info_img = pathinfo($_FILES['imagen']['name']); // resivimos la imagen$nombre

              /*
              print_r($id_usuario);

              print_r($apellido);

              print_r($barrio);

              print_r($nombre);

              print_r($email);

              print_r($celular);

              print_r($info_img);

            */

              $query = "INSERT INTO personas (id_persona, id, id_barrio, nombre, apellido, celular, email) 
                        VALUES (null, $id_usuario, $barrio,'$nombre','$apellido','$celular','$email')";
       
              // realizamos la consulta de insercion almacenda en la variable $query
              $resultado = $cn->query($query);


              $idimg = $cn->insert_id;


              print_r($idimg);

              $img = $idimg.'.'.$info_img['extension'];

              print_r($img);

              $tmp_name = $_FILES['imagen']['tmp_name'];

              $dir_subida = "photos/";

              move_uploaded_file($tmp_name, $dir_subida.$img);

        }else{
          $errors = "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
        }

    }
}

/*consulta para verigicar que el usuario ya se registro*/

$x = $_SESSION["id"];

$data ="SELECT users.id, personas.id_persona
FROM personas
INNER JOIN users ON users.id = personas.id
WHERE personas.id = $x";
$result = $cn->query($data);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
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
     <img src="../img/logo.jpeg" class="float-right">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a class="dataPerson" href="#">Datos |</a></li>
      <li><a class="resetPassword" href="#">Cambiar de Contraseña |</a></li>
      <li><a class="continuar" href="#">Curriculum |</a></li>
    </ul>
  </div>
</nav>


<?php

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              /*echo "id ->".$row["id"]."<br>";
              echo "id_persona ->".$row["id_persona"];*/
              $numid = $row["id_persona"];
              
              if ($numid != null) {
?>
<div class="container contenedor">
      <h1>Registro  65% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
      <br>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:65%">
            65% Complete 
          </div>
        </div>
      <label>Ya casi puedes publicar tus experiendia :</label>
      <a class="continuar2" href="#"> <button class="btn btn-default">Curriculum</button></a>
</div>
<?php
                
              }
              
          }

      } else {
?>
<h4>Registro  10% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">
      10% Complete
    </div>
  </div>
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
      <label class="control-label col-sm-2" for="celular"># Celular:</label>
      <div class="col-sm-10"> 
        <input type="text" class="form-control" id="celular" name="celular" placeholder="Enter Number phone">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-sm-2" for="barrio">Barrio:</label>
      <div class="col-sm-offset-2 col-sm-10">
        <select class="form-control" id="barrio" name="barrio">
          <option>Selecciona tu barrio</option>
          <?php while ($valores = mysqli_fetch_array($query)) {?>
              <option value="<?php echo $valores["id_barrio"];?>"><?php echo $valores["nombre"]; ?></option>
          <?php } ?>
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
<?php
         // echo "No se ejecuto la consulta";
      }
?>

</body>
</html>