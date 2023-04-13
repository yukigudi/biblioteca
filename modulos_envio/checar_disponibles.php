<?php
require_once("../conexion/conexion.php");


$ubicacion_actual = $_GET['ubicacion_actual'];
$modulo = $_GET['modulo'];


//checa cantidad en la ubicacion actual para enviar
$query = 'SELECT cantidad, MAX(ubicaciones_modulos.fecha) as fecha_maxima FROM ubicaciones_modulos  where modulo_Id=' . $modulo . ' and cantidad>0 and ubicacion_Id=' . $ubicacion_actual.' GROUP BY modulo_Id';


$resultado = $conexion->query($query);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    $disponibles = $fila['cantidad'];
   
} else {
    $disponibles = 0;
}
$datos[] = array('disponibles' => $disponibles);

echo json_encode($datos);


