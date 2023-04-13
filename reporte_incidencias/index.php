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
    //$this->Cell(0,10,utf8_decode('Pagína ').$this->PageNo().'',0,0,'C');
    $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo(), 0, 0, 'C');

}
}

require_once("../conexion/conexion.php");
$query="SELECT * FROM incidencias";
$resultado=$conexion->query($query);
$query = "SELECT * FROM usuarios";

$resultado1 = $conexion->query($query);
$usuario = array();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado1->fetch_assoc()) {
        $usuario[$fila['Id_usuario']] = $fila['Nombre_usuario'];
        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
    }
}

$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('../images/logo1.png',10,8,20);
    // Movernos a la derecha
    $pdf->Cell(80);
    // Título
    $pdf->Cell(110,10,'ISEJA Control de módulos',1,0,'C');
    // Salto de línea
    $pdf->Ln(20);
    $pdf->Cell(50,10,'Registro de incidencias',0,0,'C');
    $pdf->Ln(20);
    $pdf->cell(15,10,'ID',1,0,'C',0);
    $pdf->cell(38,10,'Usuario',1,0,'C',0);
    $pdf->cell(38,10,'F. envio',1,0,'C',0);
    $pdf->cell(38,10,'F. recibio',1,0,'C',0);
    $pdf->cell(38,10,'Usuario envia',1,0,'C',0);
    $pdf->cell(38,10,'Usuario recibe',1,0,'C',0);
    $pdf->cell(38,10,'Testigo',1,0,'C',0);
    $pdf->cell(38,10,'Detalle incidencia',1,0,'C',0);
    /*$pdf->cell(45,10,utf8_decode('Fecha de edición'),1,0,'C',0);
    $pdf->cell(45,10,utf8_decode('Categoría'),1,0,'C',0);
    $pdf->cell(17,10,'Estante',1,1,'C',0);*/

$pdf->SetFont('Arial','I',9);

while ($row=$resultado->fetch_assoc()) {
    $pdf->Ln(10);
	$pdf->cell(15,10,$row['Id_incidencia'],1,0,'C',0);
    $pdf->cell(38,10,$usuario[$row['usuario']],1,0,'C',0);
    $pdf->cell(38,10,$row['fechaenvio'],1,0,'C',0);
    $pdf->cell(38,10,$row['fecharecibido'],1,0,'C',0);
    $pdf->cell(38,10,$usuario[$row['usuarioenvio']],1,0,'C',0);
    $pdf->cell(38,10,$usuario[$row['usuariorecibio']],1,0,'C',0);
    $pdf->cell(38,10,$row['testigo'],1,0,'C',0);
    $pdf->cell(38,10,$row['incidencia'],1,0,'C',0);
	/*$pdf->cell(65,10,utf8_decode($row['Titulo']),1,0,'C',0);
	$pdf->cell(17,10,$row['Copias'],1,0,'C',0);
    $pdf->cell(38,10,utf8_decode($row['Editorial']),1,0,'C',0);
    $pdf->cell(45,10,$row['Fecha_edicion'],1,0,'C',0);
    $pdf->cell(45,10,utf8_decode($row['Categoria']),1,0,'C',0);
    $pdf->cell(17,10,$row['Estante'],1,1,'C',0);*/
}
$pdf->Output();
 ?>