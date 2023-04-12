<?php
require_once("../conexion/conexion.php");
//query para mostrar datos del dropdown
if (isset($_GET['ubicacion'])) {
    $ubicacion = $_GET['ubicacion'];
  
    $query = "SELECT * FROM usuarios WHERE activo=1 and nivel='tecnicodocente' and ubicacion=$ubicacion";

    $resultado = $conexion->query($query);

        if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
           
            $dataTecnico[] = array('d' => $fila['Id_usuario'], 'nombre' => $fila['nombre_empleado']);
           
        }

        echo json_encode($dataTecnico);
       
    }
   
} 
?>