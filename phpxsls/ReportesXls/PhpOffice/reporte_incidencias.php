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
$filename = "reporte_incidencias.xls";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$status = array(
    0 => 'No resuelto',
    1 => 'Resuelto'
);
$filtro = "";

    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= " fecha='$dato'";
    }

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}
$query = "SELECT * FROM usuarios";

$resultado = $conexion->query($query);
$remitente = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $remitente[$row['Id_usuario']] = $row['nombre_empleado'];
        $destinatario[$row['Id_usuario']] = $row['nombre_empleado'];
    }
}

$query = "SELECT * FROM ubicaciones ";

$resultado = $conexion->query($query);
$ubicacion = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ubicacion[$row['Id_ubicacion']] = $row['nombre_lugar'];
        // echo $fila['nombre_lugar'];
    }
}

$query = "SELECT * FROM incidencias " . $filtro . " order by fecha desc";

$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}

// Crear un objeto Spreadsheet de PhpSpreadsheet

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Escribir los encabezados en la primera fila
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Fecha');
$sheet->setCellValue('C1', 'Remitente');
$sheet->setCellValue('D1', 'Destinatario');
$sheet->setCellValue('E1', 'Testigo');
$sheet->setCellValue('F1', 'Ubicación de envio');
$sheet->setCellValue('G1', 'Ubicación de destino');
$sheet->setCellValue('H1', 'Detalle de incidencia');
$sheet->setCellValue('I1', 'Estatus');
$sheet->setCellValue('J1', 'Fecha Resuelto');

// Escribir los datos en las filas siguientes
$fila = 2;
while ($filaDatos = mysqli_fetch_array($resultado)) {
    $deubicacion = $ubicacion[$filaDatos['deubicacion']];
    $aubicacion = $ubicacion[$filaDatos['aubicacion']];
    $usuarioenvio = $remitente[$filaDatos['usuarioenvio']];
    $usuariorecibio = $destinatario[$filaDatos['usuariorecibio']];

    $sheet->setCellValue('A' . $fila, $filaDatos['Id_incidencia']);
    $sheet->setCellValue('B' . $fila, $filaDatos['fecha']);
    $sheet->setCellValue('C' . $fila, $usuarioenvio);
    $sheet->setCellValue('D' . $fila, $usuariorecibio);
    $sheet->setCellValue('E' . $fila, $filaDatos['testigo']);
    $sheet->setCellValue('F' . $fila, $deubicacion);
    $sheet->setCellValue('G' . $fila, $aubicacion);
    $sheet->setCellValue('H' . $fila, $filaDatos['detalle']);
    $sheet->setCellValue('I' . $fila, $status[$filaDatos['status']]);
    $sheet->setCellValue('J' . $fila, $filaDatos['fecha_solucion']);
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
$spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray([
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
