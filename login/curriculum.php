<?php
	session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
	}
  
  require_once "../connect/config.php";
  
  $x = $_SESSION["id"];
  $y = $_SESSION["username"];
  $fecha = date("Y/m/d");

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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Curriculum</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  <style type="text/css">
      .navbar-inverse .navbar-nav>li>a {
          color: white;
      }
      .nav>li>a {   
          padding-top: 26px;
          font-size: 18px;
      }
  </style>
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
      <br>
      <br>
      <br>
      <br>
      <br>
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

  <?php }else{ ?>  
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2>Completa tu curriculum</h2>
        <p>Para compartir tus servicios laborales:</p>
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
        <h4>Completando información laboral : <small><i><?=$nombre.' '.$fecha;?></i></small></h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  class="form" method="POST">
          <div class="form-group">
            <?php $query = $cn->query("SELECT * FROM profesion"); ?>
            <label for="profesion">Profesión</label>        
            <select class="form-control" id="profesion" name="profesion">
              <option>Selecciona tu profesión</option>
              <?php while ($valores = mysqli_fetch_array($query)) {?>
              <option value="<?php echo $valores["id_profesion"];?>"><?php echo $valores["nombre"]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="direccion">Dirección</label>  
            <input type="text" class="form-control" name="direccion" placeholder="Ingresa tu Dirección">
          </div>
          <div class="form-group">
            <label for="formacion">Formación Académica</label>
            <textarea class="form-control" rows="5" name="formacion" placeholder="Ingresa tu formación académica"></textarea>        
          </div>
          <div class="form-group">
            <label for="experiencia">Experiencia Laboral</label>        
            <textarea class="form-control" rows="5" name="experiencia" placeholder="Ingresa tu experiencia laboral"></textarea> 
          </div>
          <div class="form-group">
            <label>Disponibilidad de tiempo en Horas</label>
            <select name="timeDisponible" class="form-control">
              <option></option>
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
            <button class="btn btn-default">Guardar</button>
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
      $profesion = $_POST["profesion"];

      $sql = "UPDATE personas set direccion = '".$direccion."' , formacion = '".$formacion."', experiencia = '".$experiencia."', tiempo_disponible = '".$time."', id_profesion = '".$profesion."' where id_persona = '".$id."'";

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
