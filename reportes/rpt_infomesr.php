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
$rspta=$info->obten_informes(2,$_SESSION["inf"], $_SESSION["peri"]);
$row = $rspta->fetch_row();
$anio=explode("PA", $row[8]);;
$_SESSION["AA"]=$anio[1];
//incluimos a la clase PDF_MC_Table
require('PDF_MC_Tablecabe.php');

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


$pdf->setXy(30,56);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,6,"DEDICACION DOCENTE",0,'L',0);
$pdf->setXy(65,56);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,6,strtoupper(utf8_decode($row[6])),'B','L',0);
$pdf->setXy(135,56);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,6,"TITULO PROFESIONAL",0,'L',0);
$pdf->setXy(170,56);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,6,utf8_decode($row[7]),'B','L',0);

$pdf->setXy(30,62);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,10,"PERIODO ACADEMICO",0,'L',0);
$pdf->setXy(65,62);
$pdf->SetFont('Arial','',7);	
//$_GET["peri"]
$pdf->MultiCell(70,10,utf8_decode($row[8]),'B','L',0);
$pdf->setXy(135,62);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,10,"CARRERAS",0,'L',0);
$pdf->setXy(170,62);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($row[4]),'B','L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Ln(2);
$pdf->setXY(17,80);
$pdf->Cell(80,0,'ACTIVIDADES DE DOCENCIA',0,0,'L');

$encay=$pdf->gety();
$encax=$pdf->getx();
$pdf->sety($encay+3);
$pdf->SetFont('Arial','B',7	);
$pdf->MultiCell(50,12,"CARRERA",1,'L',0);
$pdf->setXy(60,$encay+3);
$pdf->MultiCell(60,12,"ASIGNATURA",1,'L',0);
$pdf->setXy(120,$encay+3);
$pdf->MultiCell(17,4,"HORAS CLASE POR SEMANA",1,'L',0);
$pdf->setXy(137,$encay+3);
$pdf->MultiCell(58,12,"MEDIO/S DE VERIFICACION",1,'L',0);
$pdf->setXy(195,$encay+3);
$pdf->MultiCell(25,6,"PORCENTAJE DE AVANCE DEL PEA",1,'L',0);
$pdf->setXy(220,$encay+3);
$pdf->MultiCell(50,12,"OBSERVACIONES",1,'L',0);
$pdf->SetFont('Arial','',7);
$rspta=$info->obten_materias_inf($_SESSION["inf"],$_SESSION['usu_id'], $_SESSION["peri"]); // $_SESSION['usu_id'], $_SESSION["peri"]

$encay=$encay+15;
$encay1=$encay;
$encay2=$encay;
$u=0;
//$_SESSION['tmaterias']
$pdf->SetFont('Arial','',4);
$horasclase=0;
while ($reg=$rspta->fetch_object()) {
	$pdf->setXy(10,$encay);
		$y=str_pad($reg->carrera,81,'.');
	$pdf->MultiCell(50,4,utf8_decode($reg->carrera),'T','L',0);
   // $pdf->MultiCell(40,4,'123456789012345678901234567890123456789012345678901234567890123456789012345678901',1,'L',0);
	$pdf->setXy(60,$encay);
	$pdf->MultiCell(60,4,utf8_decode($reg->materia." PARALELO ".$reg->iact_paralelo),'T','L',0);
	$pdf->setXy(120,$encay);
	$horasclase=$horasclase+$reg->iact_hora;
	$pdf->MultiCell(17,4,utf8_decode($reg->iact_hora),'T','C',0);
  	$encay=$encay+8;
	$pdf->setXy(38,$encay1);
	$pdf->setXy(137,$encay1);
	$pdf->MultiCell(58,4,utf8_decode(str_pad($reg->iact_medio,81," ")),'T','L',0);

	$pdf->setXy(195,$encay1);
	$pdf->MultiCell(25,4,utf8_decode($reg->iact_porce),'T','C',0);
	$pdf->setXy(220,$encay1);
	$pdf->MultiCell(50,4,utf8_decode(str_pad($reg->iact_obj,81," ")),'T','L',0);
  	$encay1=$encay1+8;

	$u++;
  }
	//SUMAS
	$encay1=43;

$rspta=$info->obten_oact(1,$_SESSION["inf"]);//$_SESSION["inf"]);
$data = array();
$horasotras=0;
while ($reg=$rspta->fetch_object()) {
	$horasotras=$horasotras+$reg->iot_horas;
	
  }
$rspta=$info->obt_ract(1,$_SESSION["inf"],0);//$_SESSION["inf"]);
$horasinv=0;
while ($reg=$rspta->fetch_object()) {
	$horasinv=$reg->ige_horas;
  }
$rspta=$info->obt_ract(1,$_SESSION["inf"],1);//$_SESSION["inf"]);
$horasgest=0;
$encayf=$pdf->gety();
while ($reg=$rspta->fetch_object()) {
	$horasget=$reg->ige_horas;
	$horasgest=$reg->ige_horas;
  }


	//SUMAS
//otras actividades
$pdf->AddPage();
	$encay1=0;
//	$pdf->SetFont('Arial','B',10);
//$pdf->Cell(80,0,utf8_decode("INFORMACION DE LOS CONTENIDOS PROFESIONALES"),0,0,'C');
$encay1=$pdf->gety();
$pdf->SetFont('Arial','',7);
$pdf->setXY(60,$encay1+4);

$pdf->MultiCell(100,4,utf8_decode("IMPARTICIÓN DE CLASES PRESENCIALES, VIRTUALES O EN LÍNEA, DE CARÁCTER TEÓRICO O PRÁCTICO, EN LA INSTITUCIÓN O FUERA DE ELLA, BAJO
RESPONSABILIDAD Y DIRECCIÓN DE LA MISMA."),1,'L',0);
$pdf->setXY(160,$encay1+4);
$encay1=$pdf->gety();
$pdf->MultiCell(20,12,utf8_decode($horasclase),1,'C',0);

$encay1=$pdf->gety();
$pdf->setXY(60,$encay1);	
$pdf->MultiCell(100,4,utf8_decode("HORAS DEDICADAS A LAS DEMÁS ACTIVIDADES DE DOCENTE"),1,'L',0);
$pdf->setXY(160,$encay1);
$pdf->MultiCell(20,4,utf8_decode($horasotras),1,'C',0);
$pdf->setxY(60,$encay1+4);
$pdf->MultiCell(100,4,utf8_decode("HORAS DE INVESTIGACIÓN"),1,'L',0);
$pdf->setXY(160,$encay1+4);
$pdf->MultiCell(20,4,utf8_decode($horasinv),1,'C',0);
$pdf->setxY(60,$encay1+8);
$pdf->MultiCell(100,4,utf8_decode("ACTIVIDADES DE ACTIVIDADES DE DIRECCION / GESTION / OTRAS"),1,'L',0);
$pdf->setXY(160,$encay1+8);
$pdf->MultiCell(20,4,utf8_decode($horasgest),1,'C',0);
$pdf->setxY(60,$encay1+12);
$pdf->MultiCell(100,4,utf8_decode("TOTAL"),0,'R',0);
$pdf->setXY(160,$encay1+12);
$pdf->MultiCell(20,4,utf8_decode($horasgest+$horasclase+$horasotras+$horasinv),1,'C',0);
$pdf->SetFont('Arial','',6);
$fir=$pdf->gety()+8	;
$pdf->setxy(17,$fir);
$pdf->MultiCell(45,4,utf8_decode("Elaborado por:"),'LTR','C',0);
$pdf->setx(17);
$pdf->MultiCell(45,15,utf8_decode(""),'LR','C',0);
$pdf->setx(17);
$pdf->MultiCell(45,4,utf8_decode($_SESSION['usu_nombre']),'LR','C',0);
$pdf->setx(17);
$pdf->SetFont('Arial','B',5);
$pdf->MultiCell(45,4,utf8_decode("DOCENTE"),'LBR','C',0);
$tope=$pdf->getx();
$tope1=$pdf->getx();	
$rspta=$info->obt_firmas($_SESSION["usu_id"],$_SESSION["peri"]);//$_SESSION["inf"]);
$pdf->SetFont('Arial','',6	);
while ($reg=$rspta->fetch_object()) {
    $pdf->setxy($tope+53,$fir);
	$pdf->MultiCell(45,4,utf8_decode("Verificado por:"),'LTR','C',0);
    $pdf->setxy($tope+53,$fir);
	$pdf->MultiCell(45,19,utf8_decode(""),'LR','C',0);
    $pdf->setx($tope+53);
	$pdf->MultiCell(45,4,utf8_decode($reg->usu_nombre),'LR','C',0);
    $pdf->setx($tope+53);
	$pdf->SetFont('Arial','B',5);
	$pdf->MultiCell(45,2,utf8_decode("COORDINADOR DE LA CARRERA "),'LR','C',0);
	$pdf->setx($tope+53);
	$pdf->MultiCell(45,2,utf8_decode($reg->cat_nombre),'LBR','C',0);
	$pdf->SetFont('Arial','',6);
	$tope=$tope+46;

}
	$tope1=$tope1+7;
$pdf->SetFont('Arial','',6);
$fir=$pdf->gety()+8	;
$pdf->setxy($tope1,$fir);
$pdf->MultiCell(45,4,utf8_decode("Verificado por:"),'LTR','C',0);
$pdf->setx($tope1);
$pdf->MultiCell(45,15,utf8_decode(""),'LR','C',0);
$pdf->setx($tope1);
$pdf->MultiCell(45,4,utf8_decode("Dra. Tania Sánchez"),'LR','C',0);
$pdf->setx($tope1);
$pdf->SetFont('Arial','B',5);
$pdf->MultiCell(45,4,utf8_decode("Unidad Administrativa y Financiera"),'LBR','C',0);
$tope=$pdf->getx();

$pdf->SetFont('Arial','',6);
//$fir=$pdf->gety()+8	;
$pdf->setxy(65,$fir);
$pdf->MultiCell(45,4,utf8_decode("Validado por:"),'LTR','C',0);
$pdf->setx(65);
$pdf->MultiCell(45,15,utf8_decode(""),'LR','C',0);
$pdf->setx(65);
$pdf->MultiCell(45,4,utf8_decode("Econ. Cristian Paul Andrade"),'LR','C',0);
$pdf->setx(65);
$pdf->SetFont('Arial','B',5);
$pdf->MultiCell(45,4,utf8_decode("Vicerrectorado Académico"),'LBR','C',0);
$tope=$pdf->getx();

$pdf->Output();

}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>
