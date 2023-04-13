<?php
require_once("../conexion/conexion.php");
//query para mostrar datos del dropdown
if (isset($_GET['opcion'])) {
    $opcion_selec = $_GET['opcion'];
  //  $filtro="";
    if ($_GET['opcion'] == 'envio') {
        $opcion = 'header_envio_modulos';
    //    $tipo="";
    } elseif ($_GET['opcion'] == 'devolucion') {
        $opcion = 'header_retorno_modulos';
      //  $filtro = ' WHERE tipo IN ("p","m")';
    }
    $query = "SELECT * FROM " . $opcion . " WHERE activo=1 order by fecha desc limit 20";

    $resultado = $conexion->query($query);


    $queryPlazas = "SELECT Id_ubicacion, nombre_lugar FROM ubicaciones" . $filtro;
    //$resultPlazas = mysqli_query($conn, $queryPlazas);
    $resultPlazas = $conexion->query($queryPlazas);

    // Crea un array para almacenar los resultados de las plazas
    $plazas = array();

    // Almacena los resultados de las plazas en el array
    while ($row = mysqli_fetch_assoc($resultPlazas)) {
        $plazas[$row['Id_ubicacion']] = $row['nombre_lugar'];
    }

    // Crea un array para almacenar los resultados de los envíos
    $datos = array();
    if ($opcion_selec == "devolucion") {
        $opcion_selec = "retorno";
    }
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $fila['envioa'] = $plazas[$fila['envioa']];
            $fila['ubicacion'] = $plazas[$fila['ubicacion']];
            $datos[] = array('Id' => $fila['Id_h' . $opcion_selec], 'ubicacion' => $fila['ubicacion'], 'envioa' => $fila['envioa'], 'fecha' => $fila['fecha']);
            //$datosenvio[]=$fila['envioa'];
        }

        echo json_encode($datos);
        // echo json_encode($datosenvio);
        //$RESP['ubicacion_actual']=$fila['envioa'];
    }
    //echo $query;
} elseif (isset($_GET['orden'])) {

    //query para mostrar los modulos

    $orden = $_GET['orden'];
    // $opcion_selec = $_GET['orden'];
    if ($_GET['tipo'] == 'envio') {
        $opcion = 'envio_modulos';
        $campo = 'envio';
    } elseif ($_GET['tipo'] == 'devolucion') {
        $opcion = 'retorno_modulos';
        $campo = 'retorno';
    }

    $query = 'SELECT libros.Id_libro as Id_libro,libros.Titulo,' . $opcion . '.cantidad as cantidad FROM ' . $opcion . ' LEFT JOIN libros on libros.Id_libro=' . $opcion . '.titulo WHERE Id_h' . $campo . '="' . $orden . '" AND ' . $opcion . '.cantidad>0 AND libros.Activo=1  order by Id_' . $campo . ' asc';
    //echo $query;

    $resultado = $conexion->query($query);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {

            $datos[] = array('id' => $fila['Id_libro'], 'titulo' => $fila['Titulo'], 'cantidad' => $fila['cantidad']);
        }
        echo json_encode($datos);
    } else {
        $datos[] = array('id' => "", 'titulo' => "", 'cantidad' => "");
    }
}elseif (isset($_GET['tipo_ubicaciones'])) {

    //falta afinar... aqui me quede
    $opcion_selec = $_GET['opcion'];
    $filtro="";
    if ($_GET['opcion'] == 'envio') {
        $opcion = 'header_envio_modulos';
        $tipo="";
    } elseif ($_GET['opcion'] == 'devolucion') {
        $opcion = 'header_retorno_modulos';
        $filtro = ' WHERE tipo IN ("p","m") order by Id_ubicacion asc';
    }
    $queryPlazas = "SELECT Id_ubicacion, nombre_lugar,tipo FROM ubicaciones" . $filtro;
    //$resultPlazas = mysqli_query($conn, $queryPlazas);
    $resultPlazas = $conexion->query($queryPlazas);

    // Crea un array para almacenar los resultados de las plazas
    $plazas = array();

    // Almacena los resultados de las plazas en el array
    while ($row = mysqli_fetch_assoc($resultPlazas)) {
        $plazas[$row['Id_ubicacion']] = $row['nombre_lugar'];
    }

    // Crea un array para almacenar los resultados de los envíos
    $datos = array();
    if ($opcion_selec == "devolucion") {
        $opcion_selec = "retorno";
    }
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $fila['envioa'] = $plazas[$fila['envioa']];
            $fila['ubicacion'] = $plazas[$fila['ubicacion']];
            $datos[] = array('Id' => $fila['Id_ubicacion'], 'ubicacion' => $fila['nombre_lugar'], 'tipo' => $fila['tipo']);
            //$datosenvio[]=$fila['envioa'];
        }

        echo json_encode($datos);

}
}