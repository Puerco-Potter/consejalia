<?php
include "conexion.php";
require('fpdf/fpdf.php');

if($_GET["tipo"] == "semanal"){
    $tiempo="7";
    $titulo="Informe de los 7 d�as previos al " . date( "m/d/y");
}

if($_GET["tipo"] == "mensual"){
    $tiempo="30";
    $titulo="Informe de los 30 d�as previos al " . date( "m/d/y") . "";
}

if($_GET["tipo"] == "anual"){
    $tiempo="365";
    $titulo="Informe de los 365 d�as previos al " . date( "m/d/y") . "";
}


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
    $this->Cell(80,10,'Informe de Transacciones',1,0,'C');
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
$pdf->SetFont('Arial','b',20);
$pdf->Cell(0,10,$titulo,0,1);
$pdf->SetFont('Times','b',16);
$pdf->Cell(0,10,"Expedientes:",0,1);

$pdf->SetFont('Times','b',12);
$pdf->Cell(0,10,"Ingresado:",0,1);
$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

            $pdf->Cell(50,6,"Titulo",1);
            $pdf->Cell(30,6, "Numero",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

$pdf->SetFont('Times','',11);
while ($fila=mysqli_fetch_array($filas)) { 
    if($fila["estado"]=="Ingresado"){
            $pdf->Cell(50,6,$fila["titulo"],1);
            $pdf->Cell(30,6, $fila["numero"],1);
            $pdf->Cell(40,6,$fila["usuario"],1);
            $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
        }              
}

$pdf->SetFont('Times','b',12);
$pdf->Cell(0,10,"En Tratamiento:",0,1);
$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

            $pdf->Cell(50,6,"Titulo",1);
            $pdf->Cell(30,6, "Numero",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

            
$pdf->SetFont('Times','',11);
while ($fila=mysqli_fetch_array($filas)) { 
    if($fila["estado"]=="En tratamiento"){
            $pdf->Cell(50,6,$fila["titulo"],1);
            $pdf->Cell(30,6, $fila["numero"],1);
            $pdf->Cell(40,6,$fila["usuario"],1);
            $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
        }              
}

$pdf->SetFont('Times','b',12);
$pdf->Cell(0,10,"Para firma:",0,1);
$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

            $pdf->Cell(50,6,"Titulo",1);
            $pdf->Cell(30,6, "Numero",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

            
$pdf->SetFont('Times','',11);
while ($fila=mysqli_fetch_array($filas)) { 
    if($fila["estado"]=="Para firma"){
            $pdf->Cell(50,6,$fila["titulo"],1);
            $pdf->Cell(30,6, $fila["numero"],1);
            $pdf->Cell(40,6,$fila["usuario"],1);
            $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
        }              
}

$pdf->SetFont('Times','b',12);
$pdf->Cell(0,10,"Resuelto:",0,1);
$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

            $pdf->Cell(50,6,"Titulo",1);
            $pdf->Cell(30,6, "Numero",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

            
$pdf->SetFont('Times','',11);
while ($fila=mysqli_fetch_array($filas)) { 
    if($fila["estado"]=="Resuelto"){
            $pdf->Cell(50,6,$fila["titulo"],1);
            $pdf->Cell(30,6, $fila["numero"],1);
            $pdf->Cell(40,6,$fila["usuario"],1);
            $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
        }              
}   

$pdf->SetFont('Times','b',12);
$pdf->Cell(0,10,"Archivado:",0,1);
$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM expediente WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

           $pdf->Cell(50,6,"Titulo",1);
            $pdf->Cell(30,6, "Numero",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

            
$pdf->SetFont('Times','',11);
while ($fila=mysqli_fetch_array($filas)) { 
    if($fila["estado"]=="Archivado"){
            $pdf->Cell(50,6,$fila["titulo"],1);
            $pdf->Cell(30,6, $fila["numero"],1);
            $pdf->Cell(40,6,$fila["usuario"],1);
            $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
        }              
} 

$pdf->SetFont('Times','b',16);
$pdf->Cell(0,10,"Actuaciones:",0,1);

$pdf->SetFont('Times','b',11);
$filas= mysqli_query($conexion, "SELECT * FROM actuacion WHERE 
ultimamodif BETWEEN DATE_SUB(NOW(), INTERVAL ". $tiempo." DAY) AND NOW()
ORDER BY ultimamodif");

            $pdf->Cell(30,6,"Numero",1);
            $pdf->Cell(70,6, "Fin",1);
            $pdf->Cell(40,6, "Accion",1);
            $pdf->Cell(40,6, "Momento",1,1);

$pdf->SetFont('Times','',11);

$cell_width= 70;
$cell_height= 6;
$corrimientoy= 0;
while ($fila=mysqli_fetch_array($filas)) { 
    
    if ($corrimientoy > 0){
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();
        $pdf->SetXY($current_x, $current_y + $corrimientoy);
    }

    $pdf->Cell(30,6,$fila["numero"],1);
    $current_y = $pdf->GetY();
    $current_x = $pdf->GetX();

    $pdf->SetFont('Courier','',11);
    $pdf->MultiCell($cell_width,$cell_height, $fila["fin"],1);
    $pdf->SetXY($current_x + $cell_width, $current_y);
    $pdf->SetFont('Times','',11);
    
    $pdf->Cell(40,6,$fila["usuario"],1);
    $pdf->Cell(40,6,$fila["ultimamodif"],1,1);
    $corrimientoy= floor(strlen($fila["fin"]) / $cell_width)*($cell_height) + 12;

}

$pdf->Output();
?>