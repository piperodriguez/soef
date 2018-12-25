<?php
	session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
	}

	$fecha = date("Y/m/d");
  
  require_once "../connect/config.php";
  
  $x = $_SESSION["id"];
  $y = $_SESSION["username"];

  $data ="SELECT users.id, personas.id_persona, personas.nombre, personas.direccion, personas.formacion, personas.experiencia
  FROM personas
  INNER JOIN users ON users.id = personas.id
  WHERE personas.id = $x";
  $result = $cn->query($data);

  while($row = $result->fetch_assoc()) {

      $id = $row["id_persona"];
      $nombre = $row["nombre"];
      $direccion = $row["direccion"];
      $formacion = $row["formacion"];
      $experiencia = $row["experiencia"];


  }  


$img = $id.'.JPG';


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     <img src="../img/logo.jpeg" class="float-right">
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="dataperson.php">Datos |</a></li>
      <li><a href="curriculum.php">Curriculum |</a></li>
    </ul>
  </div>
</nav>
  <div class="container">


    <?php
  if ($direccion != null || $formacion != null || $experiencia != null) {
    ?>
<div class="container contenedor">
      <h1>Registro  100% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
      <br>
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
            100% Complete 
          </div>
        </div>
      <label>registro completado :</label>
      <a href="index.php"> <button class="btn btn-default">Home</button></a>
</div>
    <?php
        
}else{

  
?>  
    <div class="row">
      <div class="col-md-8">
        <h2>Llena tu curriculum</h2>
        <p>Completa la información para compartir tus servicios laborales:</p>
        <img src="photos/<?=$img?>" alt="<?=$y;?>" class="rounded-circle" id="profile">
        <h4>Completando información laboral : <small><i><?=$nombre.' '.$fecha;?></i></small></h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  class="form" method="POST">
          <div class="form-group">
            <label for="direccion">Dirección</label>  
            <input type="text" class="form-control" name="direccion" placeholder="Dirección">
          </div>
          <div class="form-group">
            <label for="formacion">Formación Académica</label>
            <textarea class="form-control" rows="5" name="formacion"></textarea>        
          </div>
         <!-- <div class="form-group">
            <label for="profesion">Profesión</label>        
            <input type="text" required class="form-control" name="profesion" placeholder="Profesión">
          </div>
        -->
          <div class="form-group">
            <label for="experiencia">Experiencia Laboral</label>        
            <textarea class="form-control" rows="5" name="experiencia"></textarea> 
          </div>
          <div class="form-group">
            <label>Disponibilidad de tiempo en Horas</label>
            <select name="timeDisponible" class="form-control">
              <option value="1">1 hora</option>
              <option value="2">2 horas</option>
              <option value="3">3 horas</option>
              <option value="4">4 horas</option>
              <option value="5">5 horas</option>
              <option value="6">6 horas</option>
              <option value="7">7 horas</option>
              <option value="8">8 horas</option>
            </select>
          </div>
            <button>Guardar</button>
          </form> 
      </div>
    </div>
  </div>

<?php
 
}
 



 if($_SERVER["REQUEST_METHOD"] == "POST"){

      $direccion = $_POST["direccion"];
      $formacion = $_POST["formacion"];
      $experiencia = $_POST["experiencia"];
      $time = $_POST["timeDisponible"];


      $sql = "UPDATE personas set direccion = '".$direccion."' , formacion = '".$formacion."', experiencia = '".$experiencia."', tiempo_disponible = '".$time."' where id_persona = '".$id."'";

      $ejecutar = $cn->query($sql);

     if ($ejecutar == true) {

      header( "Refresh:5; url=welcome.php", true, 303);
?>
<div class="container">
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
        100% Complete 
    </div>
  </div>
    <div class="alert alert-info">
      <strong>Gracias por completar su registro!</strong> Puede publicar sus servicios <a href="#" class="alert-link">Aqui</a>.
    </div>   
</div>
<?php
     }else{
      echo "paila";
     }
}

?>

</body>
</html>
