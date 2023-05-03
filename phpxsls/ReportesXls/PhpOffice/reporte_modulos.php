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
$filename = "reporte_modulos";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$filtro = "";

$filtro = " AND Activo=1 ";

    if (isset($_GET['dato']) && ($_GET['dato']) != "") {
        $dato = $_GET['dato'];
        $filtro .= " AND Titulo LIKE '$dato%'";
    }

if (isset($_GET['codigo']) && ($_GET['codigo']) != "") {
    $codigo = $_GETT['codigo'];
    $filtro .= " AND codigo LIKE '$codigo%'";
}
if (isset($_GET['nivel']) && ($_GET['nivel']) != "") {
    $nivel = $_GET['nivel'];
    $filtro .= " AND nivel='$nivel' ";
}
if (isset($_GET['material']) && ($_GET['material']) != "") {
    $material = $_GET['material'];
    $filtro .= " AND material='$material' ";
}
if (isset($_GET['estado']) && ($_GET['estado']) != "") {
    $estado = $_GET['estado'];
    $filtro .= " AND estado='$estado' ";
}
if ($filtro) {
    $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}


$query = "SELECT * FROM libros " . $filtro;
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
$titulo='Módulos';
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
$sheet->setCellValue('A10', 'Código');
$sheet->setCellValue('B10', 'Titulo');
$sheet->setCellValue('C10', 'Cantidad');
$sheet->setCellValue('D10', 'Nivel');
$sheet->setCellValue('E10', 'Material');
$sheet->setCellValue('F10', 'Estado');

// Escribir los datos en las filas siguientes
$fila = 11;
while ($filaDatos = mysqli_fetch_array($resultado)) {
    $sheet->setCellValue('A' . $fila, $filaDatos['codigo']);
    $sheet->setCellValue('B' . $fila, $filaDatos['Titulo']);
    $sheet->setCellValue('C' . $fila, $filaDatos['Copias']);
    $sheet->setCellValue('D' . $fila, $filaDatos['nivel']);
    $sheet->setCellValue('E' . $fila, $filaDatos['material']);
    $sheet->setCellValue('F' . $fila, $filaDatos['estado']);
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
$spreadsheet->getActiveSheet()->getStyle('A10:F10')->applyFromArray([
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
