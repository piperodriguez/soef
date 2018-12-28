|<?php
	require("../../../connect/config.php");
	
	$servicio = $_REQUEST["id_servicio"];

	$nombre = $_REQUEST["nombre"];


 
	$sql = "INSERT INTO profesion(id_servicio,nombre)VALUES('".$servicio."','".$nombre."')";

	$cn->query($sql);
?>
