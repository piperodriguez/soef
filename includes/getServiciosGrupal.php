<?php
	require_once "../connect/config.php";
	
	echo 'Selecciona Un Servicio : <select onChange="getProfesionGrupal(this.value);" class="form-control" name="cbx_estado" id="cbx_estado">';
	
	$query = "select id_servicio, nombre from servicios order by nombre;";

	?>
	<option></option>
	<?php
	if($resultado=$cn->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['id_servicio']; ?>">
		<?php echo $row['nombre']; ?>
		</option>
		
		<?php
		}
	}
	echo '</select>';
?>