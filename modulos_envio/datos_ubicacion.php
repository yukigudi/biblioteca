<?php
require_once("../conexion/conexion.php");

//query para mostrar los modulos deacuerdo a la ubicacion
if (isset($_GET['ubicacion_actual'])) {
    $ubicacion_actual = $_GET['ubicacion_actual'];
    //7 - id de la Bodega grande
   // if ($ubicacion_actual == '7') {
       // $query = 'SELECT * FROM libros where Activo=1 and copias>0 order by Titulo asc';
       $query = 'SELECT *, MAX(ubicaciones_modulos.fecha) as fecha_maxima FROM ubicaciones_modulos left join libros on ubicaciones_modulos.modulo_Id=libros.Id_libro where ubicaciones_modulos.ubicacion_Id='.$ubicacion_actual.' AND libros.Activo=1 and ubicaciones_modulos.cantidad>0 GROUP BY libros.Id_libro order by Titulo asc';
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $datos[] = array('id' => $fila['Id_libro'], 'titulo' => $fila['Titulo'], 'cantidad' => $fila['cantidad']);
            }
           
        }else{
            $datos[] = array('id' => "", 'titulo' => "", 'cantidad' => "");
        }
        echo json_encode($datos);
    //}
}
?>
