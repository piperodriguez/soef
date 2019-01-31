<?php
	require("../../../connect/config.php");

	$idServicio = $_REQUEST["idServicio"];
	$sql = "SELECT nombre FROM servicios WHERE id_servicio= ".$idServicio;

	$query = $cn->query($sql);
	$fetch = $query->fetch_assoc();

?>
<div class="col-md-offset-7 well" style="background-color: lightgray;">
	<div class="form-group">
		<label for="nombre">Nombre:</label>		
		<input type="text" id="nombre" value="<?php echo $fetch["nombre"]; ?>">		
	</div>

		<button class="crudUpdatServicio btn btn-danger" id="<?php echo $idServicio;?>">Actualizar Servicio</button>
</div>
		