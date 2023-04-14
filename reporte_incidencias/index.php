<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require('fpdf.php');
require_once("../conexion/conexion.php");

$status = array(
    0 => 'No resuelto',
    1 => 'Resuelto'
);
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
        $this->SetFont('Arial', 'I', 7);
        // Número de página
        //$this->Cell(0,10,utf8_decode('Pagína ').$this->PageNo().'',0,0,'C');
        $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo(), 0, 0, 'C');
    }
}


$query1 = "SELECT * FROM incidencias";
$resultado = $conexion->query($query1);

//------ubicacion 
$query = "SELECT * FROM ubicaciones";

$resu = $conexion->query($query);
$ubicacion = array();
if ($resu->num_rows > 0) {
    while ($fil = $resu->fetch_assoc()) {
        $ubicacion[$fil['Id_ubicacion']] = $fil['nombre_lugar'];
    }
}


//-----------
//-------remitente--------
$query = "SELECT * FROM usuarios";

$res = $conexion->query($query);
$remitente = array();
if ($res->num_rows > 0) {
    while ($fila = $res->fetch_assoc()) {
        $remitente[$fila['Id_usuario']] = $fila['nombre_empleado'];
    }
}
//-----------

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);
$pdf->Image('../images/logo1.png', 10, 8, 20);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(50, 10, 'Registro de incidencias', 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
$pdf->cell(25, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->cell(35, 10, 'Usuario envia', 1, 0, 'C', 0);
$pdf->cell(35, 10, 'Usuario recibe', 1, 0, 'C', 0);
//$pdf->cell(20, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación envio', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación destino', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(70, 10, 'Detalle incidencia', 1, 0, 'C', 0);
$pdf->cell(25, 10, 'Estatus', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Fecha solución', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);


$pdf->SetFont('Arial', 'I', 7);

while ($row = $resultado->fetch_assoc()) {
    $usuarioenvio = $remitente[$row['usuarioenvio']];
    $usuariorecibio = $remitente[$row['usuariorecibio']];
    $deubicacion = $ubicacion[$row['deubicacion']];
    $aubicacion = $ubicacion[$row['aubicacion']];
    //$pdf->Ln(10);
    $pdf->cell(15, 10, $row['Id_incidencia'], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $row['fecha'], 1, 0, 'C', 0);
    $pdf->cell(35, 10, mb_convert_encoding($usuarioenvio, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(35, 10, mb_convert_encoding($usuariorecibio, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    //$pdf->cell(20, 10, $row['testigo'], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $deubicacion, 1, 0, 'C', 0);
    $pdf->cell(25, 10, $aubicacion, 1, 0, 'C', 0);
    $pdf->cell(70, 10, $row['detalle'], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $status[$row['status']], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $row['fecha_solucion'], 1, 0, 'C', 0);
}
$pdf->Output();
