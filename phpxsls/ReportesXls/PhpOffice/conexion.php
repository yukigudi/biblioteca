<?php
	$conexion = mysqli_connect("localhost","root","");
	mysqli_select_db($conexion,"biblioteca");
	$conexion->set_charset("UTF8");
?>