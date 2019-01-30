<?php
	require("../../../connect/config.php");

	$idBarrio = $_REQUEST["idBarrio"];

	$sql = "SELECT nombre FROM barrios WHERE id_barrio= ".$idBarrio;

	$query = $cn->query($sql);
	$fetch = $query->fetch_assoc();

?>
<table>
	<tr>Barrio</tr>
	<td><input type="text" id="nombre" value="<?=$fetch['nombre']?>"></td>
	<button class="crudUpdateBarrio" id="<?=$idBarrio;?>">Actualizar</button>
</table>