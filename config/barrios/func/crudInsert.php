|<?php
	require("../../../connect/config.php");
	

	$nombre = $_REQUEST["nombre"];

 	$id_ciudad = 1;

	$sql = "INSERT INTO barrios(id_ciudad,nombre)VALUES('".$id_ciudad."','".$nombre."')";

	$cn->query($sql);
?>
