<?php

namespace PhpOffice;

error_reporting(E_ALL);
require_once("conexion.php");

include "autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
//use PhpOffice\PhpSpreadsheet\Style\Font;

//if(!empty($_POST)){
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//Setting name
$today = date("Ymd");
$filename = "reporte_envios.xls";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$filtro = "";
if (isset($_POST['buscar'])) {
    if (isset($_POST['dato'])) {
        $dato = $_POST['dato'];
        $filtro .= " fechaenvio='$dato'";
    }
}
if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------ubicacion actual de envios
$query = "SELECT * FROM ubicaciones where tipo='r'";

$resultado = $conexion->query($query);
$ubicacion_actual = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ubicacion_actual[$row['Id_ubicacion']] = $row['nombre_lugar'];
        // echo $fila['nombre_lugar'];
    }
}
//------------
//--------------envioa tipo m o tipo p
$query = "SELECT * FROM ubicaciones where tipo in ('cz','d') ";

$resultado = $conexion->query($query);

$envioa = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $envioa[$row['Id_ubicacion']] = $row['nombre_lugar'];
    }
}

//-----------
//-------destinatario--------
$query = "SELECT * FROM usuarios";

$resultado = $conexion->query($query);
$destinatario = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $destinatario[$row['Id_usuario']] = $row['nombre_empleado'];
        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
    }
}
//-----------
//-------remitente--------
$query = "SELECT * FROM usuarios";

$resultado = $conexion->query($query);
$remitente = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $remitente[$row['Id_usuario']] = $row['nombre_empleado'];
        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
    }
}
//-----------


$query = "SELECT * FROM header_envio_modulos " . $filtro . " order by fechaenvio desc,Id_henvio desc";
//$query = "SELECT ubicaciones_modulos.Id_ubic_mod,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;

//la ubicacion actual es municipios o plazas tipo "m" o "p"
//echo $query;
$resultado = $conexion->query($query);


if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}

// Crear un objeto Spreadsheet de PhpSpreadsheet

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Escribir los encabezados en la primera fila
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Ubicación de envio');
$sheet->setCellValue('C1', 'Destino');
$sheet->setCellValue('D1', 'Fecha');
$sheet->setCellValue('E1', 'Remitente');
$sheet->setCellValue('F1', 'Destinatario');
$sheet->setCellValue('G1', 'Testigo');

// Escribir los datos en las filas siguientes
$fila = 2;
while ($filaDatos = mysqli_fetch_array($resultado)) {

    $id = $filaDatos['Id_henvio'];

    $filaDatos['ubicacion_actual'] = $ubicacion_actual[$filaDatos['ubicacion']];
    $filaDatos['envioa'] = $envioa[$filaDatos['envioa']];
    $filaDatos['usuario'] = $remitente[$filaDatos['usuario']];
    $filaDatos['recibe'] = $destinatario[$filaDatos['recibe']];

    $sheet->setCellValue('A' . $fila, $filaDatos['Id_henvio']);
    $sheet->setCellValue('B' . $fila, $filaDatos['ubicacion_actual']);
    $sheet->setCellValue('C' . $fila, $filaDatos['envioa']);
    $sheet->setCellValue('D' . $fila, $filaDatos['fechaenvio']);
    $sheet->setCellValue('E' . $fila, $filaDatos['usuario']);
    $sheet->setCellValue('F' . $fila, $filaDatos['recibe']);
    $sheet->setCellValue('G' . $fila, $filaDatos['testigo']);
    $fila++;
}

//$spreadsheet->getActiveSheet()->mergeCells("B2:C2");
/*$spreadsheet
    ->getActiveSheet()
    ->getStyle("A1:F1")
    ->getBorders()
    ->getOutline()
    ->setBorderStyle(Border::BORDER_THIN)
    ->setColor(new Color('00000000'));*/
$spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
    ],
]);

// Ajustar ancho de todas las columnas automáticamente
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
//Saving 
$writer = new Xlsx($spreadsheet);
#$writer->save('hello world.xlsx');
$writer->save('php://output');
/*}
else{
    echo "no data posted";
}*/
