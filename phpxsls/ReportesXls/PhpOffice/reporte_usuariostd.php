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
$filename = "reporte_usuariostecnicodocente";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$niveles = array(
    'administrador' => 'Administrador',
    'responsable_estatal' => 'Responsable Estatal',
    'coordinadorzona' => 'Coordinador de Zona',
    'tecnicodocente' => 'Técnico docente'
);

$filtro = "";

    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= "AND Nombre_empleado LIKE '%$dato%'";
    }

if (isset($_GET['nivel']) && ($_GET['nivel']) != "") {
    $nivel = $_GET['nivel'];
    $filtro .= "AND nivel='$nivel' ";
}


$query = "SELECT * FROM usuarios WHERE Activo=1 and nivel='tecnicodocente' " . $filtro;
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
$titulo='Técnico Docente';
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
$sheet->setCellValue('B10', 'Usuario');
$sheet->setCellValue('C10', 'Nombre');
$sheet->setCellValue('D10', 'Fecha alta');
$sheet->setCellValue('E10', 'Nivel de usuario');
$sheet->setCellValue('F10', 'Correo');


// Escribir los datos en las filas siguientes
$fila = 11;
while ($filaDatos = mysqli_fetch_array($resultado)) {
    $sheet->setCellValue('A' . $fila, $filaDatos['Id_usuario']);
    $sheet->setCellValue('B' . $fila, $filaDatos['Nombre_usuario']);
    $sheet->setCellValue('C' . $fila, $filaDatos['nombre_empleado']);
    $sheet->setCellValue('D' . $fila, $filaDatos['fecha']);
    $sheet->setCellValue('E' . $fila, $filaDatos['nivel']);
    $sheet->setCellValue('F' . $fila, $filaDatos['correo']);

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
