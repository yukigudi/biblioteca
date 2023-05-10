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
$filename = "reporte_detalleenvios";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$filtro = "";


    if (isset($_GET['id'])) {
        $dato = $_GET['id'];
        $filtro .= " Id_henvio='$dato'";
    }

if ($filtro) {
   // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}
//------firmas
$query = "SELECT h.*, u1.nombre_empleado as nombre_usuario1, u2.nombre_empleado as nombre_usuario2 FROM header_envio_modulos h JOIN usuarios u1 ON h.usuario = u1.Id_usuario JOIN usuarios u2 ON h.recibe = u2.Id_usuario where h.Id_henvio='$dato'";

$resultado = $conexion->query($query);
//$firmas = array();

if ($resultado->num_rows > 0) {
    $firma = $resultado->fetch_assoc();
    //$firmas[$row['Id_usuario']] = $row['nombre_empleado'];
}
$query = "SELECT * FROM envio_modulos INNER join libros on envio_modulos.titulo=libros.Id_libro " . $filtro;

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
$titulo = ' Detalle de envio ' . $dato;
$sheet->getStyle('D5:D6')->applyFromArray([
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
$sheet->setCellValue('D5', 'Reporte' . $titulo);
$sheet->setCellValue('D6', date("d/m/Y, g:i a"));

// Escribir los encabezados en la primera fila
$sheet->setCellValue('A10', 'Código');
$sheet->setCellValue('B10', 'Módulo');
$sheet->setCellValue('C10', 'Cantidad');
$sheet->setCellValue('D10', 'Nivel');
$sheet->setCellValue('E10', 'Estado');
$sheet->setCellValue('F10', 'Material');


// Escribir los datos en las filas siguientes
$fila = 11;
$filaFin = $fila;
while ($filaDatos = mysqli_fetch_array($resultado)) {

    $sheet->setCellValue('A' . $filaFin, $filaDatos['codigo']);
    $sheet->setCellValue('B' . $filaFin, $filaDatos['Titulo']);
    $sheet->setCellValue('C' . $filaFin, $filaDatos['cantidad']);
    $sheet->setCellValue('D' . $filaFin, $filaDatos['nivel']);
    $sheet->setCellValue('E' . $filaFin, $filaDatos['estado']);
    $sheet->setCellValue('F' . $filaFin, $filaDatos['material']);
  
    $filaFin++;
}

$sheet->setCellValue('B' . $filaFin+5, '______________________');
$sheet->setCellValue('C' . $filaFin+5, '______________________');
$sheet->setCellValue('D' . $filaFin+5, '______________________');
$sheet->setCellValue('B' . $filaFin+6, $firma['nombre_usuario1']);
$sheet->setCellValue('C' . $filaFin+6, $firma['nombre_usuario1']);
$sheet->setCellValue('D' . $filaFin+6, ' ');
$sheet->setCellValue('B' . $filaFin+7, 'Responsable de entrega');
$sheet->setCellValue('C' . $filaFin+7, 'Coordinador de zona');
$sheet->setCellValue('D' . $filaFin+7, 'Jefe de departamento de planeación');

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
