<?php
	require_once "../connect/config.php";
	
	$id_profesion = $_GET['id_profesion'];
	
	echo 'Selecciona Una Persona: <select class="form-control" name="cbx_localidad" id="cbx_localidad">';
	
	$query = "SELECT id_persona, nombre
			  FROM personas 
			  WHERE id_profesion = '$id_profesion' ORDER BY nombre";
	
	if($resultado=$cn->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['id_persona']; ?>"><?php echo $row['nombre']; ?></option>
		
		<?php
		}
	}
	echo '</select>';
?>