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
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(80, 10, 'Registro de Recibidos ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
//$pdf->cell(15, 10, 'Orden', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->cell(50, 10, 'Envia', 1, 0, 'C', 0);
$pdf->cell(50, 10, 'Recibe', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Envia de', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Lugar recibe', 1, 0, 'C', 0);



$pdf->SetFont('Arial', 'I', 8);


$filtro = "";
if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];
    $filtro .= " header_recibido_modulos.fechaenvio='$dato'";
}

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------ubicacion actual de envios
$query = "SELECT * FROM ubicaciones";

$resultado = $conexion->query($query);
$ubicaciones = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ubicaciones[$row['Id_ubicacion']] = $row['nombre_lugar'];
        // echo $fila['nombre_lugar'];
    }
}
//------------

//-------nombre usuarios--------
$query = "SELECT * FROM usuarios";

$resultado = $conexion->query($query);
$usuario = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $usuario[$row['Id_usuario']] = $row['nombre_empleado'];
        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
    }
}
//-----------

//SELECT header_envio_modulos.*,header_recibido_modulos.* FROM `header_recibido_modulos` left join header_envio_modulos on header_recibido_modulos.orden=header_envio_modulos.Id_henvio;
$query = "SELECT header_recibido_modulos.Id_hrecibido,header_recibido_modulos.orden,header_recibido_modulos.fecha,header_envio_modulos.usuario as envia,header_recibido_modulos.usuario as recibe,header_recibido_modulos.testigo,header_envio_modulos.ubicacion,header_recibido_modulos.ubicacion_actual FROM `header_recibido_modulos` left join header_envio_modulos on header_recibido_modulos.orden=header_envio_modulos.Id_henvio " . $filtro . " order by header_recibido_modulos.fechaenvio desc,header_recibido_modulos.Id_hrecibido desc";
//$query = "SELECT * FROM header_recibido_modulos " . $filtro . " order by fechaenvio desc,Id_hrecibido desc";
$resultado = $conexion->query($query);

while ($row = $resultado->fetch_assoc()) {
    // $row['regresara'] = $regresara[$row['regresara']];

    $pdf->Ln(10);
    $pdf->cell(15, 10, $row['Id_hrecibido'], 1, 0, 'C', 0);
    // $pdf->cell(15, 10, $row['orden'], 1, 0, 'C', 0);
    $pdf->cell(30, 10, $row['fecha'], 1, 0, 'C', 0);
    $pdf->cell(50, 10, mb_convert_encoding($usuario[$row['envia']], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(50, 10, mb_convert_encoding($usuario[$row['recibe']], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($row['testigo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($ubicaciones[$row['ubicacion']], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($ubicaciones[$row['ubicacion_actual']], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
}
$pdf->Output();
