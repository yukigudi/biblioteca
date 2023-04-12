<?php
require_once("../conexion/conexion.php");

//query para mostrar los modulos deacuerdo a la ubicacion
/*if (isset($_GET['ubicacion_actual'])) {
    $ubicacion_actual = $_GET['ubicacion_actual'];
   
   $query = 'SELECT ubicaciones_modulos.modulo_Id as Id_libro, libros.Titulo as Titulo, SUM(subquery.cantidad) as cantidad FROM ubicaciones_modulos LEFT JOIN libros ON ubicaciones_modulos.modulo_Id = libros.Id_libro LEFT JOIN ( SELECT modulo_Id, SUM(cantidad) as cantidad FROM ubicaciones_modulos WHERE ubicacion_Id = ' .$_GET['ubicacion_actual']. ' GROUP BY modulo_Id ) as subquery ON ubicaciones_modulos.modulo_Id = subquery.modulo_Id WHERE ubicaciones_modulos.ubicacion_Id = ' .$_GET['ubicacion_actual']. ' AND subquery.cantidad > 0 AND libros.Activo=1 GROUP BY ubicaciones_modulos.modulo_Id ORDER BY libros.Titulo';

    $resultado = $conexion->query($query);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = array('id' => $fila['Id_libro'], 'titulo' => $fila['Titulo'], 'cantidad' => $fila['cantidad']);
        }
      //  echo json_encode($datos);
    } else {
        $datos[] = array('id' => "", 'titulo' => "", 'cantidad' => "");
    }
    echo json_encode($datos);
    //}
}*/
if (isset($_GET['orden'])) {
    $orden = $_GET['orden'];
    //$query = "SELECT * FROM header_recibido_modulos WHERE orden=$orden";
    $query = "SELECT header_recibido_modulos.fecha,header_envio_modulos.ubicacion ,header_envio_modulos.envioa FROM header_recibido_modulos inner join header_envio_modulos on header_envio_modulos.Id_henvio=header_recibido_modulos.orden WHERE header_recibido_modulos.orden=$orden";

    //$query = 'SELECT * FROM header_' . $opcion . ' WHERE Id_h' . $campo . '=' . $orden;
    //echo $query;

    $resultado = $conexion->query($query);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // $fila['envioa'] = $plazas[$fila['envioa']];
            // $fila['ubicacion'] = $plazas[$fila['ubicacion']];
            $dato[] = array('ubicacion' => $fila['envioa'], 'envioa' => $fila['ubicacion'], 'fecha' => $fila['fechaenvio'], 'usuarioenvia' => $fila['usuario'], 'usuariorecibe' => $fila['recibe'], 'tipo' => "devolucion");
        }
    } else {
        $dato[] = array('ubicacion' => "", 'envioa' => "", 'fecha' => "", 'usuarioenvia' => "", 'usuariorecibe' => "");
    }
    echo json_encode($dato);
}
