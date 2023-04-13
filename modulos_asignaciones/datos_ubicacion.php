<?php
require_once("../conexion/conexion.php");
//query para mostrar datos del dropdown

    $orden = $_GET['orden'];
    // $opcion_selec = $_GET['orden'];
    if ($_GET['tipo'] == 'envio') {
        $opcion = 'envio_modulos';
        $campo = 'envio';
    } elseif ($_GET['tipo'] == 'devolucion') {
        $opcion = 'retorno_modulos';
        $campo = 'retorno';
    }

    $query = 'SELECT * FROM header_' . $opcion . ' WHERE Id_h' . $campo . '=' . $orden;
    //echo $query;

    $resultado = $conexion->query($query);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
           // $fila['envioa'] = $plazas[$fila['envioa']];
           // $fila['ubicacion'] = $plazas[$fila['ubicacion']];
            $dato[] = array('ubicacion' => $fila['ubicacion'], 'envioa' => $fila['envioa'], 'fecha' => $fila['fechaenvio'], 'usuarioenvia' => $fila['usuario'], 'usuariorecibe' => $fila['recibe'], 'tipo' => "devolucion");
        }
    } else {
        $dato[] = array('ubicacion' => "", 'envioa' => "", 'fecha' => "", 'usuarioenvia' => "", 'usuariorecibe' => "");
    }
    echo json_encode($dato);
