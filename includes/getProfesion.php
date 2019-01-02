<?php
	require_once "../connect/config.php";
	
	$id_servicio = $_GET['id_servicio'];
	
	echo 'Selecciona Profesion : <select onChange="" name="id_servicio" id="id_servicio">';
	
	$query = "SELECT id_profesion, nombre FROM profesion WHERE id_servicio = '$id_servicio' ORDER BY nombre";
	
	if($resultado=$cn->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['id_profesion']; ?>"><?php echo $row['nombre'];?></option>
		
		<?php
		}
	}
	echo '</select>';
?>