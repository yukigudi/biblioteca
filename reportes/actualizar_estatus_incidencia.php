<?php
ini_set('display_errors', 1);
require_once("conexion/conexion.php");
$id = $_POST["id"];
$orden = $_POST["orden"];


// Actualizar el estatus de la cita en la base de datos  
$queryupdate = 'UPDATE citas SET cita_status=' . $selectedOptionstatus . ' WHERE id=' . $id;
$res = $conexion->query($queryupdate);
//echo $queryupdate;
if ($res === TRUE) {
    // Si la actualizacion fue exitosa, devolver una respuesta JSON con éxito = true
    $response = array('success' => true);
    echo json_encode($response);
} else {
    // Si la actualizacion falló, devolver una respuesta JSON con éxito = false y un mensaje de error
    $response = array('success' => false, 'message' => "Error: " . $conn->error);
    echo json_encode($response);
}
$query = 'SELECT * from citas where id=' . $id;
//echo $query;
$resultado = $conexion->query($query);
$citas = array();
if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();
    $cita = array();

    $cita['id'] = $fila['id'];
    $cita['estatus'] = $fila['cita_status'];

    $citas[] = $cita;

    echo json_encode(array('citas' => $citas));
} else {
    echo json_encode(array('citas' => ""));
}
/*"En progreso": Verde (#2ecc71)
"Terminado": Amarillo (#f1c40f)
"Agendado": Azul claro (#3498db)
"Cancelado": Gris (#95a5a6)*/
