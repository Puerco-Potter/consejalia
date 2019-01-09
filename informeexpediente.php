<?php
include "conexion.php";
require('fpdf/fpdf.php');

$id= $_GET['idexpediente'];

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logo.png',10,8,50);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'Informe de Expediente',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(0,10,"",0,1);
$pdf->SetFont('Times','b',16);

$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
idexpediente=".$id);

$pdf->SetFont('Times','',11);
$fila=mysqli_fetch_array($filas);
$pdf->Cell(0,10,"Numero de Expediente: ". $fila['numero'],0,1);
$pdf->MultiCell(0,10,"Titulo: ". $fila['titulo'],0,1);
$pdf->Cell(0,10,"Origen: ". $fila['area'],0,1);
$pdf->MultiCell(0,10,"Rese�a: ". $fila['resena'],0,1);
$pdf->MultiCell(0,10,"Fecha de Ingreso: ". $fila['fecha'],0,1);
$pdf->SetFont('Times','b',12);
$pdf->MultiCell(0,10,"Estado: ". $fila['estado'],0,1); 
$pdf->Cell(0,10,"Actuaciones:",0,1);

$actuaciones= mysqli_query($conexion, "SELECT * FROM actuacion WHERE 
idexpediente=".$id);
$pdf->SetFont('Times','',11);
while ($actuacion=mysqli_fetch_array($actuaciones)) {
    $pdf->Cell(0,10,"Numero:" . $actuacion['numero'],0,1);
    $pdf->MultiCell(0,10,"Fin:" . $actuacion['fin'],0,1);
};
        

$pdf->Output();
?>