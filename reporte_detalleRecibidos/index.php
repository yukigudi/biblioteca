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
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,mb_convert_encoding('Pagína ', 'ISO-8859-1', 'UTF-8').$this->PageNo().'',0,0,'C');
}
}

require_once("../conexion/conexion.php");
$filtro = "";
if (isset($_GET['dato'])) {
    if (isset($_GET['dato'])) {
        $dato = $_GET['dato'];
        $filtro .= " Id_hrecibido='$dato'";
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



$query = "SELECT * FROM recibido_modulos INNER join libros on recibido_modulos.titulo=libros.Id_libro " . $filtro;
$resultado=$conexion->query($query);

$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('../images/logo1.png',10,8,20);
    // Movernos a la derecha
    $pdf->Cell(80);
    // Título
    $pdf->Cell(110,10,'ISEJA Control de libros',1,0,'C');
    // Salto de línea
    $pdf->Ln(20);
    $pdf->Cell(50,10,'Detalle de Recibido Numero '.$dato,0,0,'C');
    $pdf->Ln(20);
    $pdf->cell(15,10,'ID',1,0,'C',0);
    $pdf->cell(65,10,mb_convert_encoding('Módulo', 'ISO-8859-1', 'UTF-8'),1,0,'C',0);
    $pdf->cell(20,10,'cantidad',1,0,'C',0);
    $pdf->cell(20,10,'Nivel',1,0,'C',0);
    $pdf->cell(20,10,'Estado',1,0,'C',0);
    $pdf->cell(20,10,'Material',1,0,'C',0);
   
    /*$pdf->cell(45,10,mb_convert_encoding('Fecha de edición'),1,0,'C',0);
    $pdf->cell(45,10,mb_convert_encoding('Categoría'),1,0,'C',0);
    $pdf->cell(17,10,'Estante',1,1,'C',0);*/

$pdf->SetFont('Arial','I',9);

while ($row=$resultado->fetch_assoc()) {
    $row['titulo'] = $libro[$row['titulo']];
    $pdf->Ln(10);
	$pdf->cell(15,10,$row['Id_recibido'],1,0,'C',0);
    $pdf->cell(65,10,mb_convert_encoding($row['titulo'], 'ISO-8859-1', 'UTF-8'),1,0,'C',0);
    $pdf->cell(20,10,$row['cantidad'],1,0,'C',0);
    $pdf->cell(20,10,$row['nivel'],1,0,'C',0);
    $pdf->cell(20,10,$row['estado'],1,0,'C',0);
    $pdf->cell(20,10,$row['material'],1,0,'C',0);
    
}
$pdf->Output();
 ?>