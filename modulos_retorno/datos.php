<?php
require_once("../conexion/conexion.php");
//query para mostrar datos del dropdown de ordenes solo "ordenes recibidas" de la ubicacion seleccionada
if (isset($_GET['opcion'])) {
    $ubicacion_actual = $_GET['opcion'];
  
   // $query = "SELECT * FROM header_recibido_modulos WHERE ubicacion_actual=$ubicacion_actual order by fecha desc limit 20";
    $query = "SELECT header_recibido_modulos.Id_hrecibido,header_recibido_modulos.fecha,header_envio_modulos.ubicacion, header_envio_modulos.envioa FROM header_recibido_modulos inner join header_envio_modulos on header_envio_modulos.Id_henvio=header_recibido_modulos.orden WHERE ubicacion_actual=$ubicacion_actual order by fecha desc limit 20";
    //echo $query;
    $resultado = $conexion->query($query);

    $queryPlazas = "SELECT Id_ubicacion, nombre_lugar FROM ubicaciones";
   
    $resultPlazas = $conexion->query($queryPlazas);

    // Crea un array para almacenar los resultados de las plazas
    $plazas = array();

    // Almacena los resultados de las plazas en el array
    while ($row = mysqli_fetch_assoc($resultPlazas)) {
        $plazas[$row['Id_ubicacion']] = $row['nombre_lugar'];
    }

    // Crea un array para almacenar los resultados de los envíos
    $datos = array();
   
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $fila['envioa'] = $plazas[$fila['envioa']];
            $fila['ubicacion'] = $plazas[$fila['ubicacion']];
            $datos[] = array('Id' => $fila['Id_hrecibido'], 'ubicacion' => $fila['ubicacion'], 'envioa' => $fila['envioa'], 'fecha' => $fila['fecha']);
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
    /*if ($_GET['tipo'] == 'envio') {
        $opcion = 'envio_modulos';
        $campo = 'envio';
    } elseif ($_GET['tipo'] == 'devolucion') {
        $opcion = 'retorno_modulos';
        $campo = 'retorno';
    }*/

    $query = 'SELECT libros.Id_libro as Id_libro,libros.Titulo,recibido_modulos.cantidad as cantidad FROM recibido_modulos LEFT JOIN libros on libros.Id_libro=recibido_modulos.titulo WHERE Id_hrecibido="' . $orden . '" AND recibido_modulos.cantidad>0 AND libros.Activo=1 order by Id_hrecibido asc';
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
}/*elseif (isset($_GET['tipo_ubicaciones'])) {

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
}*/