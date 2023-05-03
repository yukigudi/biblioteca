<?php

namespace PhpOffice;

error_reporting(E_ALL);
require_once("conexion.php");

include "autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
//use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
//use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


//if(!empty($_POST)){
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//Setting name
$today = date("Ymd");
$filename = "reporte_devoluciones";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$filtro = "";

    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= " fechaenvio='$dato'";
    }

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------ubicacion actual de envios
$query = "SELECT * FROM ubicaciones";

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
$query = "SELECT * FROM ubicaciones";

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


$query = "SELECT * FROM header_retorno_modulos " . $filtro . " order by fechaenvio desc,Id_hretorno desc";
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
// Agrega la imagen a la hoja de trabajo activa
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('logo2.png'); // put your path and image here
$drawing->setCoordinates('A1');
$drawing->setWidth(150);
$drawing->setHeight(150);
//$drawing->setOffsetX(110);
//$drawing->setRotation(25);
//$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(45);
$drawing->setWorksheet($spreadsheet->getActiveSheet());
// Establecer el estilo de la celda que contiene el título
$titulo='Devoluciones';
$sheet->getStyle('D5')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 16,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
]);

// Escribir el título en la celda H2
$sheet->setCellValue('D5', 'Reporte '.$titulo);

// Escribir los encabezados en la primera fila
$sheet->setCellValue('A10', 'ID');
$sheet->setCellValue('B10', 'Ubicación de envio');
$sheet->setCellValue('C10', 'Destino');
$sheet->setCellValue('D10', 'Fecha');
$sheet->setCellValue('E10', 'Remitente');
$sheet->setCellValue('F10', 'Destinatario');
$sheet->setCellValue('G10', 'Testigo');

// Escribir los datos en las filas siguientes
$fila = 11;
while ($filaDatos = mysqli_fetch_array($resultado)) {

    $id = $filaDatos['Id_henvio'];

    $filaDatos['ubicacion'] = $ubicacion_actual[$filaDatos['ubicacion']];
    $filaDatos['envioa'] = $envioa[$filaDatos['envioa']];
    $filaDatos['usuario'] = $remitente[$filaDatos['usuario']];
    $filaDatos['recibe'] = $destinatario[$filaDatos['recibe']];


    $sheet->setCellValue('A' . $fila, $filaDatos['Id_hretorno']);
    $sheet->setCellValue('B' . $fila, $filaDatos['ubicacion']);
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
$spreadsheet->getActiveSheet()->getStyle('A10:G10')->applyFromArray([
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
