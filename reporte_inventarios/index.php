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
        $this->SetFont('Arial', 'I', 7);
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
$pdf->Cell(80, 10, 'Registro de Inventarios - ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(20, 10, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(42, 10, mb_convert_encoding('Módulo', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(42, 10, mb_convert_encoding('Ubicación', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(15, 10, 'Cantidad', 1, 0, 'C', 0);
$pdf->cell(28, 10, 'Nivel', 1, 0, 'C', 0);
$pdf->cell(28, 10, 'Material', 1, 0, 'C', 0);
$pdf->cell(28, 10, 'Estado', 1, 0, 'C', 0);
$pdf->cell(28, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->SetFont('Arial', 'I', 7);


$filtro = "";

if (isset($_GET['dato']) && ($_GET['dato']) != "") {
    $dato = $_GET['dato'];
    $filtro .= " AND fecha='$dato'";
}

if (isset($_GET['codigo']) && ($_GET['codigo']) != "") {
    $codigo = $_GET['codigo'];
    $filtro .= " AND libros.codigo LIKE '$codigo%'";
}
if (isset($_GET['nivel']) && ($_GET['nivel']) != "") {
    $nivel = $_GET['nivel'];
    $filtro .= " AND libros.nivel='$nivel' ";
}
if (isset($_GET['ubicacion']) && ($_GET['ubicacion']) != "") {
    $ubicacion = $_GET['ubicacion'];
    $filtro .= " AND ubicaciones.Id_ubicacion='$ubicacion' ";
}
if (isset($_GET['estado']) && ($_GET['estado']) != "") {
    $estado = $_GET['estado'];
    $filtro .= " AND libros.estado='$estado' ";
}
if ($filtro) {
    $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

$query = "SELECT ubicaciones_modulos.Id_ubic_mod,ubicaciones_modulos.fecha,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material,libros.codigo FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;


$resultado = $conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {

    $pdf->Ln(10);
    $pdf->cell(20, 10, $fila['codigo'], 1, 0, 'C', 0);
    $pdf->cell(42, 10, mb_convert_encoding($fila['Titulo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(42, 10, mb_convert_encoding($fila['ubicacion_actual'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(15, 10, $fila['Copias'], 1, 0, 'C', 0);
    $pdf->cell(28, 10, $fila['nivel'], 1, 0, 'C', 0);
    $pdf->cell(28, 10, $fila['material'], 1, 0, 'C', 0);
    $pdf->cell(28, 10, $fila['estado'], 1, 0, 'C', 0);
    $pdf->cell(28, 10, $fila['fecha'], 1, 0, 'C', 0);
}
$pdf->Output();
