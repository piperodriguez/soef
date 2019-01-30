<?php
	require("../../../connect/config.php");

	$idBarrio = $_REQUEST["idBarrio"];
	$nombre = $_REQUEST["nombre"];


	$sql="UPDATE barrios SET nombre='".$nombre."' WHERE id_barrio= ".$idBarrio;
	$cn->query($sql);
?>