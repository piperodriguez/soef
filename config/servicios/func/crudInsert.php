<?php
	require("../../../connect/config.php");

	$nombre = $_REQUEST["nombre"];
 
$sql = "INSERT INTO servicios( nombre)
 VALUES('".$nombre."')";

	$cn->query($sql);
?>
