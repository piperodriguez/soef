<?php

	require("../../../connect/config.php");
	$sql = "SELECT *
			FROM servicios";
	$query = $cn->query($sql);


?>
<div class="well col-md-6">
	<table class="table table-hover">
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
					<button class="updateServicio btn btn-warning" id="<?php echo $fetch["id_servicio"]; ?>">Editar Servicio</button>
					<!--<button class="crudDeleteServicio btn btn-default" id="<?php echo $fetch["id_servicio"];?>">Borrar Servicio</button>-->
				</td>
			</tr>
		</tbody>
		<?php } ?>
	</table>
</div>