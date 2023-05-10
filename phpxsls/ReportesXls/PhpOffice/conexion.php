<?php
date_default_timezone_set('America/Mazatlan');
$conexion = mysqli_connect("localhost", "root", "");
mysqli_select_db($conexion, "biblioteca");
$conexion->set_charset("UTF8");
