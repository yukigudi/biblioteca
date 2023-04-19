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
$pdf->SetFont('Arial', 'B', 12);
$pdf->Image('../images/logo1.png', 10, 8, 20);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(110, 10, mb_convert_encoding('ISEJA Control de módulos', 'ISO-8859-1', 'UTF-8') , 1, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->Cell(80, 10, 'Registro de Envios - ' . date("d/m/Y, g:i a"), 0, 0, 'C');
$pdf->Ln(20);
$pdf->cell(15, 10, 'ID', 1, 0, 'C', 0);
$pdf->cell(50, 10, mb_convert_encoding('Ubicación', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->cell(50, 10, 'Destino', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Fecha', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Remitente', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Destinatario', 1, 0, 'C', 0);
$pdf->cell(38, 10, 'Testigo', 1, 0, 'C', 0);
$pdf->SetFont('Arial', 'I', 9);


$filtro = "";

    if (isset($_POST['dato'])) {
        $dato = $_POST['dato'];
        $filtro .= " fechaenvio='$dato'";
    }

if ($filtro) {
    // $filtro = substr($filtro, 4);
    $filtro = "Where" . $filtro;
}

//------ubicacion actual de envios
$query = "SELECT * FROM ubicaciones where tipo='r'";

$resultado = $conexion->query($query);
$ubicacion_actual = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ubicacion_actual[$row['Id_ubicacion']] = $row['nombre_lugar'];
        // echo $fila['nombre_lugar'];
    }
}
//------------
//--------------envioa tipo m o tipo p
$query = "SELECT * FROM ubicaciones where tipo in ('cz','d') ";

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


$query = "SELECT * FROM header_envio_modulos " . $filtro . " order by fechaenvio desc,Id_henvio desc";
//$query = "SELECT ubicaciones_modulos.Id_ubic_mod,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;

//la ubicacion actual es municipios o plazas tipo "m" o "p"
//echo $query;
$resultado = $conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {
    $id = $fila['Id_henvio'];

    $fila['ubicacion_actual'] = $ubicacion_actual[$fila['ubicacion']];
    $fila['envioa'] = $envioa[$fila['envioa']];
    $fila['usuario'] = $remitente[$fila['usuario']];
    $fila['recibe'] = $destinatario[$fila['recibe']];

    $pdf->Ln(10);


    $pdf->cell(15, 10, $fila['Id_henvio'], 1, 0, 'C', 0);
    $pdf->cell(50, 10, mb_convert_encoding($fila['ubicacion_actual'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(50, 10, mb_convert_encoding($fila['envioa'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, $fila['fechaenvio'], 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($fila['usuario'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($fila['recibe'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->cell(38, 10, mb_convert_encoding($fila['testigo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
}
$pdf->Output();
