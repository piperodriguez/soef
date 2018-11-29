<?php

	$cn = new mysqli("localhost","root","","soef");

	mysqli_query($cn,"set character set utf8");

	if(mysqli_connect_errno()){

		echo 'Conexion Fallida : ', mysqli_connect_error();

		exit();
	}
	
?>