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
$filename = "reporte_inventarios.xls";
$CntDisposition = "Content-Disposition: attachment;filename=\"";
$CntDisposition = $CntDisposition . $today . "\"_" . $filename . ".xlsx";
header($CntDisposition);
header('Cache-Control: max-age=0');

$filtro = "";
    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= " fecha='$dato'";
    }

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}


$query = "SELECT ubicaciones_modulos.Id_ubic_mod,ubicaciones_modulos.fecha,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;


$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}

// Crear un objeto Spreadsheet de PhpSpreadsheet

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Escribir los encabezados en la primera fila
$sheet->setCellValue('A1', 'Módulo');
$sheet->setCellValue('B1', 'Ubicación');
$sheet->setCellValue('C1', 'Cantidad');
$sheet->setCellValue('D1', 'Nivel');
$sheet->setCellValue('E1', 'Material');
$sheet->setCellValue('F1', 'Estado');
$sheet->setCellValue('G1', 'Fecha');

// Escribir los datos en las filas siguientes
$fila = 2;
while ($filaDatos = mysqli_fetch_array($resultado)) {
    $sheet->setCellValue('A' . $fila, $filaDatos['Titulo']);
    $sheet->setCellValue('B' . $fila, $filaDatos['ubicacion_actual']);
    $sheet->setCellValue('C' . $fila, $filaDatos['Copias']);
    $sheet->setCellValue('D' . $fila, $filaDatos['nivel']);
    $sheet->setCellValue('E' . $fila, $filaDatos['material']);
    $sheet->setCellValue('F' . $fila, $filaDatos['estado']);
    $sheet->setCellValue('G' . $fila, $filaDatos['fecha']);
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
