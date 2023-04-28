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
        $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo(), 0, 0, 'C');
        //$this->Cell(0, 10, utf8_decode('Pagína ') . $this->PageNo() . '', 0, 0, 'C');
    }
}
$filtro = "";
if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];
    $filtro .= "and nombre_empleado like '%$dato%' ";
}
if (isset($_GET['nivel'])) {
    $nivel = $_GET['nivel'];
    $filtro .= "and nivel='$nivel' ";
}
/*if ($filtro) {
    $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}*/

require_once("../conexion/conexion.php");
$pdf = new FPDF('L', 'mm', 'Letter');

$pdf->AddPage();
$pdf->SetFont('Arial', 'I', 8);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 9);
// Movernos a la derecha
$pdf->Cell(80);
$pdf->Image('../images/logo2.png', 15, 8, 20);
// Título
$pdf->Cell(40, 10, 'ISEJA Control de libros', 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(50, 10, 'Usuarios registrados', 0, 0, 'C');
$pdf->Ln(20);
//ID	Usuario	Nombre	Fecha alta	Nivel de usuario	Correo
$pdf->cell(20, 10, 'ID', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Usuario', 1, 0, 'C', 0);
$pdf->cell(65, 10, 'Nombre', 1, 0, 'C', 0);
$pdf->cell(30, 10, 'Fecha Alta', 1, 0, 'C', 0);
$pdf->cell(40, 10, 'Nivel de usuario', 1, 0, 'C', 0);
//$this->cell(40,10,utf8_decode('Contratación'),1,0,'C',0);
$pdf->cell(45, 10, 'Correo', 1, 1, 'C', 0);

$query = "SELECT * FROM usuarios WHERE Activo=1 " . $filtro;
/*$query="SELECT empleados.Id_empleado,personas.Nombre,empleados.Fecha_contratacion,puesto.Descripcion
                                FROM personas,empleados,puesto WHERE personas.Id_persona=empleados.Id_persona
                                AND empleados.Id_puesto=puesto.Id_puesto AND empleados.Activo=1";*/
$resultado = $conexion->query($query);

//$pdf = new PDF();

while ($row = $resultado->fetch_assoc()) {
    //$pdf->Ln(10);
    $pdf->cell(20, 10, $row['Id_usuario'], 1, 0, 'C', 0);
    $pdf->cell(30, 10, mb_convert_encoding($row['Nombre_usuario'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(65, 10, mb_convert_encoding($row['nombre_empleado'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(30, 10, $row['fecha'], 1, 0, 'C', 0);
    $pdf->cell(40, 10, $row['nivel'], 1, 0, 'C', 0);
    $pdf->cell(45, 10, $row['correo'], 1, 1, 'C', 0);
}
$pdf->Output();
