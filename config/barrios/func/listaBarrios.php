<!--<?php

	require("../../../connect/config.php");

	$sql = "SELECT barrios.nombre, barrios.id_barrio
			FROM barrios";

	$query = $cn->query($sql);

?>
<table class="table">
	<thead>
		<tr>
			<th>Nombre Barrio</th>
		</tr>	
	</thead>
	<?php while($fetch = $query->fetch_assoc()) { ?>
	<tbody id="myTable">
		<tr>
			<td><?=$fetch["nombre"];?></td>
			<td>
				<button class="updateBarrio btn btn-default" id="<?php echo $fetch["id_barrio"]; ?>">
					Editar Barrio
				</button>
			</td>
		</tr>
	</tbody>
	<?php } ?>
</table>
-->