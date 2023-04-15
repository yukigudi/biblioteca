<?php
//cuando recibo_modulos ya sea por envio o devolucion se genera la incidencia si no viene completo
//en recibido_modulos se guarda si se recibio completo o no
//se guarda en header_recibido_modulos el tipo(envio o devolucion), el id de la orden y se genera un id de orden recibida.


//para arreglar la incidencia tengo que tener el Id_hrecibido de header_recibido_modulos para editar recibido_modulos y cambiar el campo recibecompleto=1
//el id de la incidencia para cambiar el estatus de la incidencia

ini_set('display_errors', 1);
require_once("../conexion/conexion.php");
$id_incidencia = $_POST["id"];
$orden = $_POST["orden"];
$tipo = $_POST["tipo"];
$fecha = date("y-m-d");
$fecha_actual = date("y-m-d");
if ($_POST['tipo'] == 'envio') {
    $opcion = 'header_envio_modulos';
    //    $tipo="";
} elseif ($_POST['tipo'] == 'devolucion') {
    $opcion = 'header_retorno_modulos';
    //  $filtro = ' WHERE tipo IN ("p","m")';
}

$query = 'SELECT header_envio_modulos.ubicacion,header_envio_modulos.envioa,header_recibido_modulos.* FROM header_envio_modulos left join header_recibido_modulos on header_envio_modulos.Id_henvio=header_recibido_modulos.orden where header_recibido_modulos.orden=' . $orden;

echo $query;
$resultado = $conexion->query($query);
$fila = $resultado->fetch_assoc();

$orden_recibido = $fila['Id_hrecibido'];
$ubicacion = $fila['ubicacion'];
$ubicacion_envio = $fila['envioa'];

//falta afinar consultas-------------
$queryupdate = 'UPDATE recibido_modulos SET recibecompleto=1, fecha_actualizacion = NOW() WHERE Id_hrecibido=' . $orden_recibido . ' AND recibecompleto=0';
//echo $queryupdate;
$res = $conexion->query($queryupdate);
//echo $queryupdate;
if ($res === TRUE) {
    // Si la actualizacion fue exitosa, devolver una respuesta JSON con éxito = true y se ejecutaran mas consultas

    $querymodulos = "SELECT Id_hrecibido, titulo, cantidad FROM recibido_modulos WHERE recibecompleto = 1 AND Id_hrecibido=' . $orden_recibido . ' AND (fecha_actualizacion BETWEEN DATE_SUB(NOW(), INTERVAL 1 SECOND) AND NOW())";
    $resultadomodulos = $conexion->query($query);
    //actualizo ubicaciones_modulos

    //checar si existe en la ubicacion

    /*APARTIR DE AQUI VA EL WHILE DE LOS MODULOS ACTUALIZADOS RECIENTEMENTE */
    if ($resultadomodulos->num_rows > 0) {
        while ($filamodulos = $resultadomodulos->fetch_assoc()) {
            $modulo = $filamodulos['titulo'];
            $cantidad = $filamodulos['cantidad'];
            //-----------------------
            $query = "SELECT cantidad, ubicacion_Id FROM ubicaciones_modulos WHERE ubicacion_Id IN ($ubicacion, $ubicacion_envio) AND modulo_Id = $modulo AND cantidad > 0";
            echo $query . "</br>";
            $resultado = $conexion->query($query);
            //-----------------------------
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {

                    $cantidad_actualizada = $fila['cantidad'] - $cantidad;
                    if ($fila['ubicacion_Id'] == $ubicacion_envio) {
                        //aqui checa si hay registro de la ubicacionactual
                        $querydetalle4 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_actualizada, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $modulo ";
                        $verificar4 = $conexion->query($querydetalle4);
                        echo 'querydetalle4 ' . $querydetalle4 . '<br>';
                        if (!$verificar4) {
                            echo "Error en la consulta: " . $conexion->error;
                        }
                    } else {
                        $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($modulo, $ubicacion_envio, $cantidad, '$fecha_actual')";
                        $verificar3 = $conexion->query($querydetalle3);
                        echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                    }

                    if ($fila['ubicacion_Id'] == $ubicacion) {
                        //aqui encuentra -  $regresara 
                        $cantidad_nueva = $fila['cantidad'] + $cantidad;
                        $querydetalle3 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_nueva, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $modulo";
                        $verificar3 = $conexion->query($querydetalle3);
                        echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                        if (!$verificar3) {
                            echo "Error en la consulta: " . $conexion->error;
                        }
                    } else {
                        $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($modulo, $ubicacion, $cantidad, '$fecha_actual')";
                        $verificar3 = $conexion->query($querydetalle3);
                        echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                    }
                }
            }
        }
    }
    // }



    $queryupdate = 'UPDATE incidencias SET status=1, fecha_solucion="' . $fecha . '" WHERE Id_incidencia=' . $id_incidencia;
    //echo $queryupdate;
    // Actualizar el estatus de la cita en la base de datos  
    //$queryupdate = 'UPDATE citas SET cita_status=' . $selectedOptionstatus . ' WHERE id=' . $id;
    $response = $conexion->query($queryupdate);

    if ($response === TRUE) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Si la actualizacion falló, devolver una respuesta JSON con éxito = false y un mensaje de error
        $response = array('success' => false, 'message' => "Error: " . $conn->error);
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'message' => "Error: " . $conn->error);
    echo json_encode($response);
}

/*"En progreso": Verde (#2ecc71)
"Terminado": Amarillo (#f1c40f)
"Agendado": Azul claro (#3498db)
"Cancelado": Gris (#95a5a6)*/
