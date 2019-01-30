<?php 
require("../../connect/config.php");
$CantidadMostrar=7;
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
$TotalReg = $cn->query("SELECT * FROM barrios");
$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
$consultavistas ="SELECT nombre, id_barrio FROM barrios ORDER BY nombre ASC
                  LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
$consulta=$cn->query($consultavistas);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Listado de Barrios</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/paginacion.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Soef</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="../../login/index.php">Inicio</a></li>
	      <li><a href="../servicios/index.php">Servicios</a></li>
	      <li><a href="../Usuarios/listUsers.php">Lista de personas Registradas</a></li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
		<div class="header">
			<h3>Listado Barrios</h3>
		</div>
		<div class="wrapper">
		<b>La cantidad de resgistro se dividio a:</b><?=$TotalRegistro;?>para mostrar de a <?=$CantidadMostrar;?> registros
		<table class="table">
			<tr>
				<th>Nombre</th>
			</tr>
			<?php while ($lista=$consulta->fetch_row()) { print_r($lista);?>
			<tr>
				<td>
					<?=$lista[0];?>
				</td>
			<td>
				<button class="updateBarrio btn btn-default" id="<?php echo $lista[1]; ?>">
					Editar Barrio
				</button>
			</td>
			</tr>
			<?php } ?>
		</table>
			<?php    
    //Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
  
	echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){
           echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }else {
     	  	echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }     		
     	}
     }

	echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">▶</a></li></ul>";
  

?>
			<div class="options">
			<!--con la clase insertAuto es llamada del archivo core.js-->
				<button class="insertBarrio btn btn-success">nuevo barrio</button>
			</div>
			<div class="formularios"></div>
		</div>
	</div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/coreBarrios.js"></script>
</body>
</html>

