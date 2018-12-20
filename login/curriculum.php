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

  $data ="SELECT users.id, personas.id_persona, personas.nombre, personas.direccion
  FROM personas
  INNER JOIN users ON users.id = personas.id
  WHERE personas.id = $x";
  $result = $cn->query($data);

  while($row = $result->fetch_assoc()) {

      $id = $row["id_persona"];
      $nombre = $row["nombre"];
      $direccion = $row["direccion"];
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
</head>
<body>

  <div class="container">
    <?php
  if ($direccion > 0) {
}  
  
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
            <button type="submit" class="btn btn-success">Completar el registro</button>
          </div>
          </form> 
      </div>
    </div>
  </div>

<?php

}else{
  echo "registro completadp";
}


 if($_SERVER["REQUEST_METHOD"] == "POST"){

      $direccion = $_POST["direccion"];
      $formacion = $_POST["formacion"];
      $experiencia = $_POST["experiencia"];


      $sql = "UPDATE personas set direccion = '".$direccion."' , formacion = '".$formacion."', experiencia = '".$experiencia."' where id_persona = '".$id."'";

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
