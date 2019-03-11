<?php
	require_once "../connect/config.php";
	
	$id_servicio = $_GET['id_servicio'];
	
	echo 'Selecciona profesion : <select onChange="getPersonas(this.value);" class="form-control" name="cbx_municipio" id="cbx_municipio">';
	echo "<option></option>";
	
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


