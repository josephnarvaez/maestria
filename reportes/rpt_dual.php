<?php
header('Content-Type: text/html; charset=UTF-8');  
//activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id())<1) 
  session_start();

if (!isset($_SESSION['usu_nombre'])) {
  echo "debe ingresar al sistema correctamente para vosualizar el reporte";
}else{


if ($_SESSION['Activos']==1 or $_SESSION['Actas']==1 ){
require_once "../modelos/informes.php";
$info=new Informes();
$_SESSION["inf"]=$_GET["inf"];
//$rspta=$info->obten_informes(2,$_SESSION["inf"], $_SESSION["peri"]);
//$row = $rspta->fetch_row();
//$anio=explode("PA", $row[8]);;
//$_SESSION["AA"]=$anio[1];
//incluimos a la clase PDF_MC_Table
require('PDF_MC_TablecabeD.php');

//instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table('L','mm','letter');

//agregamos la primera pagina al documento pdf
$pdf->AddPage();

//seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial=5;

$pdf->Ln();


$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,48);
$pdf->Cell(80,0,'DATOS GENERALES DEL DOCENTE',0,0,'L');
$pdf->setXy(30,50);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,6,"NOMBRE DEL DOCENTE",0,'L',0);
$pdf->setXy(65,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,6,utf8_decode($_SESSION['usu_nombre']),'B','L',0);
$pdf->setXy(135,50);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,6,"NO. DE CEDULA",0,'L',0);
$pdf->setXy(170,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,6,utf8_decode($_SESSION['usu_cedula']),'B','L',0);


$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,70);
$pdf->Cell(80,0,'DATOS VISITAS',0,0,'L');
$rspta=$info->obten_dual_inf($_SESSION["inf"],$_SESSION['usu_id']); // $_SESSION['usu_id'], $_SESSION["peri"]
	
$encay=$pdf->gety();
$encayy=$encay;
$i=0;	
$bandera=0;	
while ($reg=$rspta->fetch_object()) {
	if ($i==2 or $i==4 or $i==6 ){
		$pdf->AddPage();
		$encay=38;
		$bandera=1;
	}
		
	$pdf->SetFont('Arial','B',10);
	$pdf->setXy(17,$encay+5);
	$pdf->MultiCell(100,6,"Empresa: ".utf8_decode($reg->dua_empresa),0,'L',0);
	$pdf->setXY(150,$encay+5);
	$pdf->MultiCell(100,6,"Coordenadas: ".$reg->dua_coordenadas,0,'L',0);
	$encay=$encay+5;
	$pdf->setXy(17,$encay+5);
	$pdf->MultiCell(100,6,"Hora: ".utf8_decode($reg->dua_horai." - ".$reg->dua_horaf ),0,'L',0);
	$pdf->setXY(150,$encay+5);
	$pdf->MultiCell(100,6,"Asunto: ".$reg->dua_asunto,0,'L',0);
	$encay=$encay+3;
	if ($reg->dua_asunto=="ACERCAMIENTO"){
		$pdf->sety($encay+10);
		$pdf->SetFont('Arial','B',7	);
		$pdf->MultiCell(150,6,"OBSERVACIONES",1,'L',0);
		$pdf->setXy(60,$encay+10);
		
		$encay=$encay+6;
		$pdf->sety($encay+10);
		$pdf->SetFont('Arial','B',7	);
		$pdf->MultiCell(150,30,utf8_decode($reg->dua_alumnos),1,'L',0);
       }
		
	else{	
		$pdf->sety($encay+10);
		$pdf->SetFont('Arial','B',7	);
		$pdf->MultiCell(50,6,"ESTUDIANTES",1,'L',0);
		$pdf->setXy(60,$encay+10);
		$pdf->MultiCell(50,6,"ACTIVIDADES REALIZADAS",1,'L',0);
		$pdf->setXy(110,$encay+10);
		$pdf->MultiCell(50,6,"DEBILIDADES ENCONTRADAS",1,'L',0);
		$pdf->setXy(160,$encay+10);
		$pdf->MultiCell(50,6,"FORTALEZAS ENCONTRADAS",1,'L',0);
		$pdf->setXy(210,$encay+10	);
		$pdf->MultiCell(50	,6,"SUGERENCIAS",1,'L',0);
		$encay=$encay+6;
		$pdf->sety($encay+10);
		$pdf->SetFont('Arial','B',7	);
		$pdf->MultiCell(50,30,utf8_decode($reg->dua_alumnos),1,'L',0);
		$pdf->setXy(60,$encay+10);
		$pdf->MultiCell(50,30,utf8_decode($reg->dua_actividades),1,'L',0);
		$pdf->setXy(110,$encay+10);
		$pdf->MultiCell(50,30,utf8_decode($reg->dua_debilidades),1,'L',0);
		$pdf->setXy(160,$encay+10);
		$pdf->MultiCell(50,30,utf8_decode($reg->dua_foratalezas),1,'L',0);
		$pdf->setXy(210,$encay+10	);
		$pdf->MultiCell(50	,30,utf8_decode($reg->dua_sugerencias),1,'L',0);
	}
	
	$encay=$pdf->gety()+3;
	$i++;
  }
if ($i==2 or $i==4 or $i==6 or $bandera=0){
		$pdf->AddPage();
		$encay=38;
	}
//$pdf->AddPage();
$fir=$pdf->gety()+2;	
$tope1=150;
$pdf->SetFont('Arial','',6);

$pdf->setxy($tope1,$fir);
$pdf->MultiCell(45,4,utf8_decode("Validado por:"),'LTR','C',0);
$pdf->setx($tope1);
$pdf->MultiCell(45,15,utf8_decode(""),'LR','C',0);
$pdf->setx($tope1);
$pdf->MultiCell(45,4,utf8_decode(""),'LR','C',0);
$pdf->setx($tope1);
$pdf->SetFont('Arial','B',5);
$pdf->MultiCell(45,4,utf8_decode("GESTOR LOCAL"),'LBR','C',0);
$tope=$pdf->getx();

$pdf->SetFont('Arial','',6);
//$fir=$pdf->gety()+8	;
$pdf->setxy(65,$fir);
$pdf->MultiCell(45,4,utf8_decode("Elaborado por:"),'LTR','C',0);
$pdf->setx(65);
$pdf->MultiCell(45,15,utf8_decode(""),'LR','C',0);
$pdf->setx(65);
$pdf->MultiCell(45,4,utf8_decode($_SESSION['usu_nombre']),'LR','C',0);
$pdf->setx(65);
$pdf->SetFont('Arial','B',5);
$pdf->MultiCell(45,4,utf8_decode("TUTOR ACADEMICO"),'LBR','C',0);
$tope=$pdf->getx();

$pdf->Output();

}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>
