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
$filtro = "";
if (isset($_GET['dato'])) {
    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= " Id_hasignacion='$dato'";
    }
}
if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------libros
$query = "SELECT * FROM libros";

$resultado = $conexion->query($query);
$libro = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $libro[$row['Id_libro']] = $row['Titulo'];
        // echo $fila['nombre_lugar'];
    }
}
//------------

$query = "SELECT * FROM usuarios";

$resultado = $conexion->query($query);
$tecnico = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $tecnico[$row['Id_usuario']] = $row['nombre_empleado'];
        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
    }
}
//------firmas
//$query = "SELECT h.*, u1.nombre_empleado as nombre_usuario1, u2.nombre_empleado as nombre_usuario2 FROM header_asignacion_modulos h JOIN usuarios u1 ON h.usuario = u1.Id_usuario JOIN usuarios u2 ON h.recibe = u2.Id_usuario where h.Id_asignacion='$dato'";

//$resultado = $conexion->query($query);
//$firmas = array();

//if ($resultado->num_rows > 0) {
//    $firma = $resultado->fetch_assoc();
//$firmas[$row['Id_usuario']] = $row['nombre_empleado'];
//}
$query = "SELECT * FROM `asignacion_modulos` INNER join libros on asignacion_modulos.titulo=libros.Id_libro " . $filtro;
$resultado = $conexion->query($query);

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Image('../images/logo2.png', 15, 8, 20);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, 'ISEJA Control de libros', 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(120, 10, mb_convert_encoding('Detalle de Asignaciones Número ' . $dato . ' - ' . date("d/m/Y, g:i a"), 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(15, 10, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(65, 10, mb_convert_encoding('Módulo', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Cantidad', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Nivel', 1, 0, 'C', 0);
$pdf->cell(20, 10, 'Estado', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Material', 1, 0, 'C', 0);
$pdf->cell(65, 10, mb_convert_encoding('Técnico Docente', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);


/*$pdf->cell(45,10,mb_convert_encoding('Fecha de edición'),1,0,'C',0);
    $pdf->cell(45,10,mb_convert_encoding('Categoría'),1,0,'C',0);
    $pdf->cell(17,10,'Estante',1,1,'C',0);*/

$pdf->SetFont('Arial', 'I', 9);

while ($row = $resultado->fetch_assoc()) {
    $row['titulo'] = $libro[$row['titulo']];
    $pdf->Ln(10);
    $pdf->cell(15, 10, $row['codigo'], 1, 0, 'C', 0);
    $pdf->cell(65, 10, mb_convert_encoding($row['titulo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(20, 10, $row['cantidad'], 1, 0, 'C', 0);
    $pdf->cell(30, 10, $row['nivel'], 1, 0, 'C', 0);
    $pdf->cell(20, 10, $row['estado'], 1, 0, 'C', 0);
    $pdf->cell(30, 10, $row['material'], 1, 0, 'C', 0);
    $pdf->cell(65, 10, mb_convert_encoding($tecnico[$row['tecnico']], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
}


$pdf->SetFont('Arial', '', 12);
$pdf->Ln(40); // agregar un salto de línea antes de las líneas de firma

// imprimir la primera línea de firma
$pdf->Cell(60, 0, '');
$pdf->Cell(60, 0, '');
$pdf->Cell(60, 0, '');

$pdf->Ln(5); // agregar un pequeño salto de línea entre cada línea de firma

// imprimir la segunda línea de firma
$pdf->Cell(60, 0, '                      ');
$pdf->Cell(90, 0, '______________________');
$pdf->Cell(90, 0, '______________________');

$pdf->Ln(5);

// imprimir la tercera línea de firma
//$pdf->Cell(90, 0, mb_convert_encoding('Jefe de departamento de planeación', 'ISO-8859-1', 'UTF-8'));
$pdf->Cell(60, 0, '                      ');
$pdf->Cell(90, 0, mb_convert_encoding('Responsable entrega', 'ISO-8859-1', 'UTF-8'));
$pdf->Cell(90, 0, mb_convert_encoding('Responsable recibe', 'ISO-8859-1', 'UTF-8'));

$pdf->Ln(5);
// imprimir la tercera línea de firma
//$pdf->Cell(90, 0, 'Responsable de entrega');
//$pdf->Cell(90, 0, 'Responsable que recibe');
//$pdf->Cell(90, 0, mb_convert_encoding('Jefe de departamento de planeación', 'ISO-8859-1', 'UTF-8'));

$pdf->Ln(20);
$pdf->Output();
