<?php
include "conexion.php";
require('fpdf/fpdf.php');

$id= $_GET['idactuacion'];

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
    $this->Cell(80,10,'Informe de Actuaci�n',1,0,'C');
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



$filas= mysqli_query($conexion, "SELECT * FROM actuacion WHERE 
idactuacion=".$id);

$pdf->SetFont('Times','',11);
$fila=mysqli_fetch_array($filas);
$pdf->Cell(0,10,"Numero de Actuacion: ". $fila['numero'],0,1);
$pdf->MultiCell(0,10,"Fin: ". $fila['fin'],0,1);
$pdf->Cell(0,10,"Fecha de Presentacion: ". $fila['fecha'],0,1);

if ($fila['tipo']=="Pase") {
    $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Pase",0,1);
            $pdf->SetFont('Times','',11);
    $pdf->Cell(0,10,"Origen: ". $fila['paseorigen'],0,1);
    $pdf->Cell(0,10,"Destino: ". $fila['pasedestino'],0,1);
}

if ($fila['tipo']=="Instrumento") {

    $instrumentos=mysqli_query($conexion, "SELECT * FROM instrumento 
        WHERE idactuacion=".$_GET['idactuacion']." LIMIT 1");
    $instrumento=mysqli_fetch_array($instrumentos);
    setlocale(LC_ALL, "spanish");
    $inst= $instrumento;

        if ($inst['tipo']=="Nota"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Nota",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Apellido y Nombre: ". $inst['notaayn'],0,1);
            $pdf->Cell(0,10,"DNI: ". $inst['notadni'],0,1);
            $pdf->Cell(0,10,"Direccion: ". $inst['notadireccion'],0,1);
            $pdf->Cell(0,10,"Numero de telefono: ". $inst['notatelefono'],0,1);

        }
        if ($inst['tipo']=="Memorandum"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Memorandum",0,1);
            $pdf->SetFont('Times','',11);
        }
        if ($inst['tipo']=="Resolucion"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Resoluci�n",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Numero de Resoluci�n: ". $inst['resnumero'],0,1);
            $pdf->Cell(0,10,"Numero de Actuacion de Origen: ". $inst['resndado'],0,1);
        }
        if ($inst['tipo']=="Disposicion"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Disposici�n",0,1);
            $pdf->SetFont('Times','',11);
        }
        if ($inst['tipo']=="Proyecto"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Proyecto",0,1);
            $pdf->SetFont('Times','',11);
        }
        if ($inst['tipo']=="Proyecto de Ordenanza"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Proyecto de Ordenanza",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Tipo: ". $inst['pdotipo'],0,1);
            $pdf->Cell(0,10,"Consejal: ". $inst['pdoconcejal'],0,1);
            $pdf->Cell(0,10,"Barrio: ". $inst['pdobarrio'],0,1);
            $pdf->Cell(0,10,"Temas: ". $inst['pdotemas'],0,1);
            $pdf->Cell(0,10,"Tipo de sesiones/audiencia: ". $inst['pdotiposes'],0,1); 
        }
        if ($inst['tipo']=="Ordenanza"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Ordenanza",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Numero de Ordenanza: ". $inst['ordnumero'],0,1);
            $pdf->Cell(0,10,">Numero de Resolucion: ". $inst['ordnumerores'],0,1);
            $pdf->Cell(0,10,"Numero de Actuacion de Origen: ". $inst['ordndado'],0,1);
        }
        if ($inst['tipo']=="Ley"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Ley",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Numero de Ley: ". $inst['leynumero'],0,1);
        }
        if ($inst['tipo']=="Declaracion"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Declaraci�n",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Numero de Declaracion: ". $inst['declnumero'],0,1);
            $pdf->Cell(0,10,"Numero de Actuacion de Origen: ". $inst['declndado'],0,1);
        }
        if ($inst['tipo']=="Invitacion"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Invitacion",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Quien invita: ". $inst['invitacionqi'],0,1);
        }
        if ($inst['tipo']=="Oficio"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Oficio",0,1);
            $pdf->SetFont('Times','',11);
            $pdf->Cell(0,10,"Numero de Oficio: ". $inst['oficionro'],0,1);
        }
        if ($inst['tipo']=="Otro"){
            $pdf->SetFont('Times','b',12);
            $pdf->Cell(0,10,"Otro",0,1);
            $pdf->SetFont('Times','',11);
        }
}        
$pdf->MultiCell(0,10,"Rese�a: ". $fila['resena'],0,1);         

$pdf->Output();
?>