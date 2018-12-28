<?php
	require("../../../connect/config.php");

	$idProfesion = $_REQUEST["idProfesion"];
	$nombre = $_REQUEST["nombre"];
	$servicio = $_REQUEST["servicio"];


	$sql="UPDATE profesion SET nombre='".$nombre."', id_servicio='".$servicio."' WHERE id_profesion= ".$idProfesion;
	$cn->query($sql);
?>