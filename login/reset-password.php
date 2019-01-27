<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

   require_once "../connect/config.php";
   
   $xxx = $_SESSION["id"];
   
   $sql = "SELECT id_rol FROM users WHERE id = $xxx";
   
   if (!$resultado = $cn->query($sql)) {
       // ¡Oh, no! La consulta falló. 
       echo "Lo sentimos, este sitio web está experimentando problemas.";
       // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
       // cómo obtener información del error
       echo "Error: La ejecución de la consulta falló debido a: \n";
       echo "Query: " . $sql . "\n";
       echo "Errno: " . $cn->errno . "\n";
       echo "Error: " . $cn->error . "\n";
   
       exit;
   
   }else{
   
     while($row = $resultado->fetch_assoc()) {
   
         $id_rol = $row["id_rol"];
     }
   
   }
   /*proceso para pintar la imagen de la persona*/
   $datosUser = "SELECT personas.id_persona
                 FROM personas
                 INNER JOIN users ON users.id = personas.id
                 WHERE personas.id = $xxx";
   
   $result = $cn->query($datosUser);
   
   $id = null;

   while($row = $result->fetch_assoc()) {
   
       $id = $row["id_persona"];
   }     
   
// Include config file
require_once "../connect/config.php";   

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($cn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($cn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Soef - Restablecer contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
        <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
        <title>Restablecer la contraseña</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/flexslider.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
 <style type="text/css">
            body {
                font: 14px sans-serif;
            }
            
            .wrapper {
                width: 350px;
                padding: 20px;
            }
        </style>
</head>
<body>
            <!--nav-->
        <nav class="nav navbar-default navbar-fixed-top">
            <div class="container">
                <div class="col-md-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                            <span class="fa fa-bars"></span>
                        </button>
                        <a href="index.html" class="navbar-brand">SOEF</a>
                    </div>
                    <br>
                    <br>
                   <div class="collapse navbar-collapse navbar-right" id="mynavbar">
                  <h3><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>&nbsp;&nbsp;Bienvenido a SOEF&nbsp;<a href="logout.php" class="card-link"></h3><a href="logout.php"><b>Cerrar sesión</b></a>
                  </a>
               </div>

                </div>
            </div>
        </nav>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form">
                    <div class="login100-form-avatar">
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

                      echo "<img src='$file' class='container-login100'>";

                             }
                     }

                     ?>s
                        
                    </div>

                     

                    <span class="login100-form-title p-t-20 p-b-45">
                       <?php echo htmlspecialchars($_SESSION["username"]); ?>
                    </span>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn">
                            Cambiar
                        </button>
                    </div>
                    <br>
                    <br>
                    <div class="text-center w-full">
                        <a class="txt1" href="http://localhost/soef/login/registro.php">
                            Cambie de contraseña periodicamente!                     
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="" id="footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 footer-copyright">
              © Bethany Theme - All rights reserved
              <div class="credits">
                Designed by yvcastiblanco frodriguez 
              </div>
            </div>
            <div class="col-sm-5 footer-social">
              <div class="pull-right hidden-xs hidden-sm">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    
    

    
<!--===============================================================================================-->  
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="../js/main.js"></script>

</body>
</html>