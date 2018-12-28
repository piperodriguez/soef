<?php
	require("../../../connect/config.php");

	$idProfesion = $_REQUEST["idProfesion"];

	$sql = "SELECT nombre, id_servicio FROM profesion WHERE id_profesion= ".$idProfesion;

	$query = $cn->query($sql);
	$fetch = $query->fetch_assoc();

?>
<table border="1" cellpadding="5" cellspacing="0">
	<tr>
		<td>Servicio:</td>
		<td>
			<?php 
				$queryServicios= mysqli_query($cn, "SELECT id_servicio, nombre FROM servicios");
				$fetchServicios= mysqli_fetch_assoc($queryServicios);
			?>
			<select name="servicio" id="servicio">
				<?php do{ ?>
				<option value="<?php echo $fetchServicios["id_servicio"];?>"
				
				<?php if(!strcmp($fetchServicios["id_servicio"], $fetch["id_servicio"])) { ?>selected<?php } ?>><?php echo $fetchServicios["nombre"]; ?></option>
				<?php } while($fetchServicios = mysqli_fetch_array($queryServicios));?>
		    </select>
		</td>
	</tr>
	<tr>
		<td>Profesion: </td>
		<td>
			<input type="text" id="nombre" value="<?php echo $fetch["nombre"]; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2"><button class="crudUpdateProfesion" id="<?php echo $idProfesion;?>">Actualizar Profesion</button>
		</td>	
	</tr>
</table>