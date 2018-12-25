<?php
	require("../../../connect/config.php");

	$idServicio = $_REQUEST["idServicio"];
	$sql = "SELECT nombre FROM servicios WHERE id_servicio= ".$idServicio;

	$query = $cn->query($sql);
	$fetch = $query->fetch_assoc();

?>
<table border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td>nombre: </td>
		<td><input type="text" id="nombre" value="<?php echo $fetch["nombre"]; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2"><button class="crudUpdatServicio" id="<?php echo $idServicio;?>">Actualizar Servicio</button>
		</td>	
	</tr>
</table>