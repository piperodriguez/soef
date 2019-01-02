<?php

require_once "../connect/config.php";

echo 'Selecciona Servicio : <select onChange="getServicios(this.value);" name="cbx_servicios" id="cbx_servicios">';

$query = "SELECT id_servicio, nombre FROM servicios order by nombre";

?>
<option></option>
	<?php
	if($resultado=$cn->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{

			print_r($row);
		?>
		<option value="<?php echo $row['id_servicio']; ?>">
		<?php echo $row['nombre']; ?>
		</option>
		
		<?php
		}
	}
	echo '</select>';
?>