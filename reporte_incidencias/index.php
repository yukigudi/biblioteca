
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
$pdf->Image('../images/logo1.png', 10, 8, 20);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(80, 10, 'Registro de Inventarios - ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
//$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
$pdf->cell(25, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->cell(35, 10, 'Usuario envia', 1, 0, 'C', 0);
$pdf->cell(35, 10, 'Usuario recibe', 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación envio', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Ubicación destino', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(70, 10, 'Detalle incidencia', 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Estatus', 1, 0, 'C', 0);
$pdf->cell(25, 10, mb_convert_encoding('Fecha solución', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);

$pdf->SetFont('Arial', 'I', 7);

$status = array(
    0 => 'No resuelto',
    1 => 'Resuelto'
);

$filtro = "";

    if (isset($_POST['dato'])) {
        $dato = $_POST['dato'];
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
while ($fila = $resultado->fetch_assoc()) {

    $fila['deubicacion'] = $ubicacion[$fila['deubicacion']];
    $fila['aubicacion'] = $ubicacion[$fila['aubicacion']];
    $fila['usuarioenvio'] = $remitente[$fila['usuarioenvio']];
    $fila['usuariorecibio'] = $destinatario[$fila['usuariorecibio']];

    //$pdf->Ln(10);
    $pdf->cell(25, 10, $fila['fecha'], 1, 0, 'C', 0);
    $pdf->cell(35, 10, mb_convert_encoding($fila['usuarioenvio'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(35, 10, mb_convert_encoding($fila['usuariorecibio'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(20, 10, $fila['testigo'], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $fila['deubicacion'], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $fila['aubicacion'], 1, 0, 'C', 0);
    $pdf->cell(70, 10, $fila['detalle'], 1, 0, 'C', 0);
    $pdf->cell(20, 10, $status[$fila['status']], 1, 0, 'C', 0);
    $pdf->cell(25, 10, $fila['fecha_solucion'], 1, 1, 'C', 0);
}
$pdf->Output();
