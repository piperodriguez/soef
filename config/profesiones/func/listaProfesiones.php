<?php

	require("../../../connect/config.php");
	$sql = "SELECT profesion.nombre as profesiones, servicios.nombre as servicio, profesion.id_profesion
			FROM profesion
			INNER JOIN servicios ON servicios.id_servicio = profesion.id_servicio";
	$query = $cn->query($sql);


?>
<table class="table">
	<thead>
		<tr>
			<th>Servicio</th>
			<th>Profesion</th>
		</tr>	
	</thead>
	<?php while($fetch = $query->fetch_assoc()) { ?>
	<tbody>
		<tr>
			<td><?=$fetch["servicio"];?></td>
			<td><?=$fetch["profesiones"];?></td>
			<td>
				<button class="updateprofesion btn btn-default" id="<?php echo $fetch["id_profesion"]; ?>">
					Editar Profesion
				</button>
				<button class="crudDeleteProfesion btn btn-default" id="<?php echo $fetch["id_profesion"];?>">Borrar Servicio</button>
			</td>
		</tr>
	</tbody>
	<?php } ?>
</table>