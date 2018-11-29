<?php
    // Initialize the session
    session_start();
 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.  Bienvenido a SOEF</h1>
        <?php echo htmlspecialchars($_SESSION["id"]); ?>
    </div>
    <div class="container">
      <h2>Opciones</h2>
      <div class="list-group">
        <a href="dataperson.php" class="list-group-item list-group-item-success"><h3>Mi Cuenta</h3> <br><i class="fa fa-user fa-4x"></i></a>
        <a href="profile.php" class="list-group-item list-group-item-info"><h3>Información Laboral</h3> <br><i class="fa fa-briefcase fa-4x"></i></a>
        <a href="logout.php" class="list-group-item list-group-item-danger"><h3>Salir</h3> <br><i class="fa fa-blind fa-4x"></i></a>
      </div>
    </div>
</body>
</html>