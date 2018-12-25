<?php
	require("../../../connect/config.php");
	$idServicio = $_REQUEST["idServicio"];
	$nombre = $_REQUEST["nombre"];


	$sql="UPDATE servicios SET nombre='".$nombre."' WHERE id_servicio= ".$idServicio;
	$cn->query($sql);
?>