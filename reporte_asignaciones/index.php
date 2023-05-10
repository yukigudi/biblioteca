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
$pdf->SetFont('Arial', 'B', 10);
$pdf->Image('../images/logo2.png', 15, 8, 20);
//$pdf->Image('../LogoISEJA_Negro.png', 10, 10, 50, 50);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(80, 10, 'Registro de Asignaciones ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
//$pdf->cell(15, 10, 'Orden', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Usuario', 1, 0, 'C', 0);
$pdf->cell(50, 10, mb_convert_encoding('Ubicación', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(50, 10, 'Tipo', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Orden', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->cell(38, 10, mb_convert_encoding('Fecha asignación', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);



$pdf->SetFont('Arial', 'I', 8);


$filtro = "";

if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];
    $filtro .= " fechaasignacion='$dato'";
}

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------ubicacion actual de envios
$query = "SELECT * FROM ubicaciones";

$resultado = $conexion->query($query);
$ubicacion = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ubicacion[$row['Id_ubicacion']] = $row['nombre_lugar'];
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


$query = "SELECT * FROM header_asignacion_modulos " . $filtro . " order by fechaasignacion desc,Id_hasignacion desc";
$resultado = $conexion->query($query);

while ($row = $resultado->fetch_assoc()) {
    $row['ubicacion'] = $ubicacion[$row['ubicacion']];
    $row['envioa'] = $envioa[$row['envioa']];
    $row['usuario'] = $remitente[$row['usuario']];

    $pdf->Ln(10);
    $pdf->cell(15, 10, $row['Id_hasignacion'], 1, 0, 'C', 0);
    $pdf->cell(30, 10, mb_convert_encoding($row['usuario'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(50, 10, mb_convert_encoding($row['ubicacion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(50, 10, $row['tipo'], 1, 0, 'C', 0);
    $pdf->cell(38, 10, $row['orden'], 1, 0, 'C', 0);
    $pdf->cell(38, 10, $row['testigo'], 1, 0, 'C', 0);
    $pdf->cell(38, 10, $row['fechaasignacion'], 1, 0, 'C', 0);
}
$pdf->Output();
