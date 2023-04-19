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
   // $this->Cell(0,10,mb_convert_encoding('Pagína ').$this->PageNo().'',0,0,'C');
    $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo(), 0, 0, 'C');
}
}

require_once("../conexion/conexion.php");
$filtro = "";

$filtro = " AND Activo=1 ";

    if (isset($_POST['dato']) && ($_POST['dato']) != "") {
        $dato = $_POST['dato'];
        $filtro .= " AND Titulo LIKE '$dato%'";
    }

if (isset($_POST['codigo']) && ($_POST['codigo']) != "") {
    $codigo = $_POST['codigo'];
    $filtro .= " AND codigo LIKE '$codigo%'";
}
if (isset($_POST['nivel']) && ($_POST['nivel']) != "") {
    $nivel = $_POST['nivel'];
    $filtro .= " AND nivel='$nivel' ";
}
if (isset($_POST['material']) && ($_POST['material']) != "") {
    $material = $_POST['material'];
    $filtro .= " AND material='$material' ";
}
if (isset($_POST['estado']) && ($_POST['estado']) != "") {
    $estado = $_POST['estado'];
    $filtro .= " AND estado='$estado' ";
}
if ($filtro) {
    $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

$query = "SELECT * FROM libros " . $filtro;
//$query="SELECT ubicaciones_modulos.Id_ubic_mod,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;
$resultado=$conexion->query($query);

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
    $pdf->Cell(100,10,'Libros registrados - '.date("F j, Y, g:i a"),0,0,'C');
    $pdf->Ln(20);
    $pdf->cell(15,10,mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'),1,0,'C',0);
    $pdf->cell(65,10,'Titulo',1,0,'C',0);
    $pdf->cell(38,10,'Cantidad',1,0,'C',0);
    $pdf->cell(38,10,'Estado',1,0,'C',0);
    $pdf->cell(45,10,'Nivel',1,0,'C',0);
    $pdf->cell(45,10,'Material',1,0,'C',0);
    //$pdf->cell(17,10,'Estante',1,1,'C',0);

$pdf->SetFont('Arial','I',9);
$pdf->Ln(10);
while ($row=$resultado->fetch_assoc()) {
	//$pdf->cell(15,10,$row['Id_ubic_mod'],1,0,'C',0);
    $pdf->cell(15,10,$row['codigo'],1,0,'C',0);
    $pdf->cell(65, 10, mb_convert_encoding($row['Titulo'], 'ISO-8859-1', 'UTF-8'),1,0,'C',0);
	//$pdf->cell(65,10,mb_convert_encoding($row['Titulo']),1,0,'C',0);
	$pdf->cell(38,10,$row['Copias'],1,0,'C',0);
    $pdf->cell(38,10,$row['estado'],1,0,'C',0);
    $pdf->cell(45,10,$row['nivel'],1,0,'C',0);
    $pdf->cell(45,10,$row['material'],1,0,'C',0);
    //$pdf->cell(17,10,$row['Estante'],1,1,'C',0);
    $pdf->Ln(10);
}
//$pdf->cell(65,10,$query,1,0,'C',0);
$pdf->Output();
?>