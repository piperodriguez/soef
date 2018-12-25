<?php

	require("../../../connect/config.php");
	$sql = "SELECT *
			FROM servicios";
	$query = $cn->query($sql);


?>
<table class="table">
	<thead>
		<tr>
			<th>Nombre</th>
		</tr>	
	</thead>
	<?php while($fetch = $query->fetch_assoc()) { ?>
	<tbody>
		<tr>
			<td><?=$fetch["nombre"];?></td>
			<td>
				<button class="updateServicio btn btn-default" id="<?php echo $fetch["id_servicio"]; ?>">Editar Servicio</button>
				<button class="crudDeleteServicio btn btn-default" id="<?php echo $fetch["id_servicio"];?>">Borrar Servicio</button>
			</td>
		</tr>
	</tbody>
	<?php } ?>
</table>