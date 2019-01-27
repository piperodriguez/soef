<?php
  /*Codigo necesarrio para verificar la autenticación*/ 
  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
  }

  require_once "../connect/config.php";

  $usuario = $_SESSION["id"];

  $validar = "SELECT users.id, experiencia, direccion, formacion, tiempo_disponible, id_profesion,
              nombre, apellido, celular, email
              FROM personas
              INNER JOIN users ON users.id = personas.id
              WHERE personas.id = $usuario";

  $data = $cn->query($validar);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Completando Registro</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
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
<?php 
  
  $dato1 = null;
  $dato6 = null;


  while ($validacion = $data->fetch_array()) {

        $dato1 = $validacion["experiencia"];
        $dato2 = $validacion["direccion"];
        $dato3 = $validacion["formacion"];
        $dato4 = $validacion["tiempo_disponible"];
        $dato5 = $validacion["id_profesion"];

        $dato6 = $validacion["nombre"];
        $dato7 = $validacion["apellido"];
        $dato8 = $validacion["celular"];
        $dato9 = $validacion["email"];

    }

 ?> 
 <?php 

  if ($dato6 == null || $dato7 == null || $dato8 == null || $dato9 == null) {
    
    /* si entra en este if signfica que necesita formulario*/
 ?>
<nav class="navbar navbar-inverse">
   <div class="container-fluid">
      <div class="navbar-header">
         <img src="../img/logo.jpeg" class="float-right">
      </div>
      <ul class="nav navbar-nav">
         <li><a href="index.php">Home</a></li>
         <li><a href="dataperson.php">Datos |</a></li>
      </ul>
   </div>
</nav>
<div class="container">
   <h4>Registro  10% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
   <div class="progress">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">
         10% Complete
      </div>
   </div>
   <hr>
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
         <?php $query = $cn->query("SELECT * FROM barrios"); ?>
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
  }else if($dato1 == null || $dato2 == null || $dato3 == null || $dato4 == null || $dato5 == null){
    /*necesita curriculum*/
 ?>
 

<nav class="navbar navbar-inverse">
   <div class="container-fluid">
      <div class="navbar-header">
         <img src="../img/logo.jpeg" class="float-right" style="margin-right: 30px;">
      </div>
   </div>
</nav>
<div class="container contenedor">
   <h1>Registro  65% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
   <br>
   <div class="progress">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:65%">
         65% Complete 
      </div>
   </div>
   <label>Ya casi puedes publicar tus experiendia :</label>
   <a href="curriculum.php"> <button class="btn btn-default">Curriculum</button></a>     
</div>


 <?php   
  }else{
/*registro al 100%*/
?>


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
<div class="container contenedor">
   <h1>Registro  100% de <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
   <br>
   <div class="progress">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:100%">
         100% Complete 
      </div>
   </div>
   <label>registro completado :</label>
   <a href="index.php"> <button class="btn btn-default">Home</button></a>
</div>


<?php
  }
 ?> 
          
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php

  $resultado = 0;
  $errors = '';

  if($_SERVER["REQUEST_METHOD"] == "POST"){

      if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0){
        // validamos ke la imagen exista y ke no tenga errores 
        $errors = "Ha ocurrido un error";

      }else{

        $permitidos = array('image/jpeg','image/jpg','image/gif','image/png');
        /* declaramos un array para almacenar las extenxiones permitidas png, gif etc ..*/ 
        $limite_kb = 16384;
        /*Definimos el tamaño maximo de la imagen*/
        if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){

              $id_usuario = $_POST["usuario"];    
              $barrio = $_POST["barrio"];
              $nombre = $_POST["nombre"];
              $apellido = $_POST["apellido"];
              $email = $_POST["email"];
              $celular = $_POST["celular"];
              $info_img = pathinfo($_FILES['imagen']['name']);

              $query = "INSERT INTO personas (id_persona, id, id_barrio, nombre, apellido, celular, email) 
                        VALUES (null, $id_usuario, $barrio,'$nombre','$apellido','$celular','$email')";
              $resultado = $cn->query($query);

              $idimg = $cn->insert_id;
              /*La funcion insert_id permite traer el utlimo registro insertado*/
              $img = $idimg.'.'.$info_img['extension'];

              $tmp_name = $_FILES['imagen']['tmp_name'];

              $dir_subida = "photos/";

              move_uploaded_file($tmp_name, $dir_subida.$img);

              echo "<script>location.href ='curriculum.php';</script>";


        }else{
          $errors = "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes"; 
        }


      }

  }
?>