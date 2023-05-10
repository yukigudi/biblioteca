
<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, mb_convert_encoding('Pagína ', 'ISO-8859-1', 'UTF-8') . $this->PageNo() . '', 0, 0, 'C');
    }
}

require_once("../conexion/conexion.php");

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);
$pdf->Image('../images/logo2.png', 15, 8, 20);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(80, 10, 'Registro de Incidencias - ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
//$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
$pdf->cell(25, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Usuario envia', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Usuario recibe', 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación envio', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación destino', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Estatus', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Fecha solución', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(70, 10, 'Detalle incidencia', 1, 1, 'C', 0);


$pdf->SetFont('Arial', 'I', 7);

$status = array(
    0 => 'No resuelto',
    1 => 'Resuelto'
);

$filtro = "";

if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];
    $filtro .= " DATE(fecha)='$dato'";
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
function getDetalleHeight($detalle)
{
    $maxWidth = 70;
    $charPerLine = 56;
    $charCount = strlen($detalle);
    $lineCount = ceil($charCount / $charPerLine);
    $cellHeight = 5;
    $extraHeight = 10 + ($lineCount - 1) * 15;
    if ($lineCount > 1) {
        $extraHeight = ($lineCount - 1) * $cellHeight;
    } else {
        $extraHeight =  10;
    }
    return $extraHeight;
}
$query = "SELECT * FROM incidencias " . $filtro . " order by fecha desc";

$resultado = $conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {
    $detalle = $fila['detalle'];
    $detalleHeight = getDetalleHeight($detalle);
    $fila['deubicacion'] = $ubicacion[$fila['deubicacion']];
    $fila['aubicacion'] = $ubicacion[$fila['aubicacion']];
    $fila['usuarioenvio'] = $remitente[$fila['usuarioenvio']];
    $fila['usuariorecibio'] = $destinatario[$fila['usuariorecibio']];
    $totalHeight = $detalleHeight; // 5 es la altura de las otras celdas

    $pdf->cell(25, $totalHeight, $detalleHeight.'-'.$fila['fecha'], 0, 0, 'C', 0);
    $pdf->cell(30, $totalHeight, mb_convert_encoding($fila['usuarioenvio'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', 0);
    $pdf->cell(30, $totalHeight, mb_convert_encoding($fila['usuariorecibio'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', 0);
    $pdf->cell(20, $totalHeight, $fila['testigo'], 0, 0, 'C', 0);
    $pdf->cell(25, $totalHeight, $fila['deubicacion'], 0, 0, 'C', 0);
    $pdf->cell(25, $totalHeight, $fila['aubicacion'], 0, 0, 'C', 0);
    $pdf->cell(20, $totalHeight, $status[$fila['status']], 0, 0, 'C', 0); // colocar la celda de estado aquí
    $pdf->cell(25, $totalHeight, $fila['fecha_solucion'], 0, 0, 'C', 0);
    $pdf->MultiCell(70, $detalleHeight, $detalle, 0, 'J', "");
}
$pdf->Output();
