<?php
	require_once "../connect/config.php";
	
	$id_profesion = $_GET['id_profesion'];
	
	$query = "SELECT id_persona, concat(nombre,' ',apellido) as nombre
			  FROM personas 
			  WHERE id_profesion = '$id_profesion' ORDER BY nombre";
	$resultado=$cn->query($query);

?>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<div class="container">
		<div class="alert alert-success">
  			<strong>Personal Disponible!</strong> 
		</div>
		<table class="table table-hover">
			<thead>
			<tr class="bg-brimary">
				<th>Persona</th>
				<th>Solicitar Servicio</th>
			</tr>
			</thead>
			<tbody>
			<?php while($row = $resultado->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $row['nombre']; ?></td>
				<td id="persona">					
					<a href="../includes/detallePersona.php?id_persona=<?=$row['id_persona'];?>">
					 <button class="btn"><i class="fa fa-briefcase"></i></button>
					</a>
				</td>
			</tr>
			<?php }?>
			</tbody>
		</table>

	</div>
