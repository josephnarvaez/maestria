<?php
require('PDF_MC_Tablecabe.php');
$pdf=new PDF_MC_Table('l','mm','letter');
$x=40;
$y=60;
//agregamos la primera pagina al documento pdf
$pdf->AddPage();
$pdf->setXY($x,$y);
$pdf->Cell(80,0,$_GET["rudos"],0,0,'L');
$pdf->ln();
$pdf->setXY($x,$y+3);
$pdf->MultiCell(35,5,"Apellidos: ",'LRTB','L',0);
$pdf->setXY($x+35,$y+3);
$pdf->MultiCell(35,5,"Nombres: ",'LRTB','L',0);
$pdf->ln();
$pdf->MultiCell(35,5,"Rudos",'LRTB','L',0);
$y=$pdf->getY();
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255, 180, 255);

for($i=0; $i<35; $i++){
	$pdf->setXY($x,$y);
    $pdf->MultiCell(35,5,"Rudos",'LR','L',0);
	$y=$pdf->getY();
	if ($y>180){
		$pdf->AddPage();
	    $x=40;
		$y=40; 	
	}
		
}
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0, 0, 0);
$pdf->Line($x-20,$y, $x+180, $y);


$pdf->AddPage();

$pdf->AddPage();

$pdf->AddPage();
$pdf->Output();
?>