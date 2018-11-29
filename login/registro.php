<?php
	require_once "../connect/config.php";
	//Definir variables e inicializar con valores vacíos.
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    // Validate username
	    if(empty(trim($_POST["username"]))){
	        $username_err = "Ingrese un nombre de usuario.";
	    } else{
	        // Prepare a select statement
	        $sql = "SELECT id FROM users WHERE username = ?";
	        
	        if($stmt = mysqli_prepare($cn, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_username);
	            
	            // Set parameters
	            $param_username = trim($_POST["username"]);
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                /* store result */
	                mysqli_stmt_store_result($stmt);
	                
	                if(mysqli_stmt_num_rows($stmt) == 1){
	                    $username_err = "Este nombre de usuario ya está en uso.";
	                } else{
	                    $username = trim($_POST["username"]);
	                }
	            } else{
	                echo "Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
	            }
	        }
	         
	        // Close statement
	        mysqli_stmt_close($stmt);
	    }

	    

	    // Validate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Por favor ingrese la contraseña.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "La contraseña debe tener minimo 6 caracteres";
	    } else{
	        $password = trim($_POST["password"]);
	    }

	    // Validate confirm password
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Por favor confirma tu contraseña";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "Las contraseñas no coinciden";
	        }
	    }

	    // Check input errors before inserting in database
	    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

	    	//$correo = $_POST["email"];
	    	
	       // $fecha_grab = date("Y-M-D") ;

	        // Prepare an insert statement
	        
	        $id_rol = 2;

	        $sql = "INSERT INTO users (id , id_rol, username, password) VALUES ('', $id_rol, ?, ?)";
	         
	        if($stmt = mysqli_prepare($cn, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
	            
	            // Set parameters
	            $param_username = $username;
	            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                // Redirect to login page
	                header("location: index.php");
	            } else{
	                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
	            }
	        }
	         
	        // Close statement
	        mysqli_stmt_close($stmt);
	    }
	      

 		mysqli_close($cn);

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro de usuarios</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>

  <!--header-->
  <header class="main-header2" id="header">
    <div class="bg-color">
      <!--nav-->
      <nav class="nav navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
                <span class="fa fa-bars"></span>
              </button>

              <a href="../index.php" class="navbar-brand">SOEF</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mynavbar">
              <ul class="nav navbar-nav">
                <li><a href="#header">HOME</a></li>
                <li><a href="#feature">¿Que somos?</a></li>
                <li><a href="#portfolio">Servicios</a></li>
                <li><a href="#contact">Contáctenos</a></li>
                <li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!--/ nav-->
    </div>
  </header>
  <!--/ header-->
	<div class="container">
    	<div class="row">
    		<div class="col-md-6">
    			<img src="../img/logo.jpeg" class="img-responsive img-rounded">
    		</div>
    		<div class="col-md-5 col-md-offset-1" id="cajaRegistro">
				<center>
					<h1 id="titleRegister">Registrate</h1>
    				<i class="fa fa-user-circle fa-5x"></i>
    			</center>
		    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<!--<div class="form-group">
						<label class="control-label col-sm-6" for="email">Email:</label>
						<input type="email" name="email" class="form-control">
					</div>
				-->
					<div class="form-group"> 
						<label class="control-label col-sm-6" for="username">Nombre de usuario</label>
						<input type="text" name="username" class="form-control" value="<?php echo $username;?>">
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6" for="password">Password:</label> 
						<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group  <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<label class="control-label col-sm-6" for="password">Password:</label> 
						<input type="password" name="confirm_password" class="form-control" alue="<?php echo $confirm_password; ?>">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-2">
							<input type="submit" class="btn btn-default" value="Completar Registro" id="btnformuser">
							<input type="reset" class="btn btn-default" value="Reset">
						</div>
					</div>
				</form>		
    		</div>
    	</div>
		<p>Ya estas registrado ? <a href="../index.php">Ingresa aquí</a>.</p>
	</div>
	<footer class="" id="footer">
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-7 footer-copyright">
	          © Bethany Theme - All rights reserved
	          <div class="credits">
	            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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
	<script src="../js/jquery.min.js"></script>
</body>
</html>