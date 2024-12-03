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
require_once "../modelos/recuperacion.php";
$info=new Recuperacion();

//incluimos a la clase PDF_MC_Table
require('PDF_MC_TablecabeR.php');

//instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table('L','mm','letter');

//agregamos la primera pagina al documento pdf
$pdf->AddPage();

//seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial=5;
$y=$pdf->gety()-5;
$pdf->setxy(5,$y);	
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(30,4,utf8_decode("1. Introducción"),0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(260,4,utf8_decode("En caso de que un docente se vea imposibilitado de impartir clases debido a algún permiso o circunstancia imprevista, es fundamental establecer un plan de recuperación de clases que garantice la continuidad del proceso educativo y el cumplimiento de los objetivos académicos.
"),0,'L',0);
$pdf->SetFont('Arial','B',7);
$pdf->setx(5);
$pdf->MultiCell(30,4,utf8_decode("2. Objetivos"),0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(260,4,utf8_decode("- Garantizar la continuidad del proceso educativo para evitar interrupciones en el aprendizaje de los estudiantes.
- Recuperar el contenido académico perdido durante el período de ausencia del docente.
- Proporcionar apoyo adicional a los estudiantes para asegurar su progreso académico
"),0,'L',0);
	$pdf->setx(5);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(30,4,utf8_decode("3. Procedimiento"),0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(260,4,utf8_decode("- Comunicación: Se establecerá una comunicación clara y oportuna con los estudiantes para informarles sobre la situación y los pasos a seguir en el proceso de recuperación de clases.  
- Reprogramación de clases: Se coordinará con la coordinación de carrera y los estudiantes para reprogramar las clases perdidas. Se priorizará la flexibilidad y la adaptabilidad para proponer los horarios, y contar con el consentimiento de la coordinación de carrera y la firma de aceptación de todos los estudiantes matriculados en las materias.
- Monitoreo y seguimiento: Se llevará a cabo un seguimiento continuo del desarrollo del plan de recuperación de clases para identificar posibles áreas de mejora y asegurar su efectividad en el logro de los objetivos académicos establecidos.  
"),0,'L',0);
$pdf->SetFont('Arial','B',7);
$pdf->setx(5);
$pdf->MultiCell(30,4,utf8_decode("4. Responsabilidades"),0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(260,4,utf8_decode("- Docentes: Serán responsables de colaborar en la reprogramación de clases y proporcionar el apoyo necesario a los estudiantes durante el proceso de recuperación.
- Estudiantes: Deberán participar activamente en las actividades de recuperación de clases y aprovechar los recursos de apoyo proporcionados para garantizar su progreso académico.
"),0,'L',0);
	$pdf->SetFont('Arial','B',7);
$pdf->setx(5);
$pdf->MultiCell(50,4,utf8_decode("5. Evaluación y Retroalimentación"),0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(260,4,utf8_decode("Al finalizar el período de recuperación de clases, se realizará una evaluación del proceso para identificar lecciones aprendidas y áreas de mejora. Se recopilará la retroalimentación para lo cual el Vicerrectorado a través de la coordinación académica enviará una encuesta de satisfacción a los estudiantes para su llenado.
"),0,'L',0);
	$pdf->AddPage();
$pdf->SetFont('Arial','B',7);
$y=$pdf->gety()+5;
$pdf->setxy(5,$y);	
$pdf->MultiCell(23,4,"Fecha de Perdida",1,'L',0);
$pdf->setxy(28,$y);	
$pdf->MultiCell(30,4,utf8_decode("Fecha de Recuperación"),1,'L',0);	
$pdf->setxy(58,$y);	
$pdf->MultiCell(80,4,utf8_decode("Tema a Tratar"),1,'L',0);	
$pdf->setxy(138,$y);	
$pdf->MultiCell(40,4,utf8_decode("Asignatura"),1,'L',0);	
$pdf->setxy(178,$y);	
$pdf->MultiCell(10,4,utf8_decode("Horas"),1,'L',0);
$pdf->setxy(188,$y);	
$pdf->MultiCell(15,4,utf8_decode("Modalidad"),1,'L',0);
$pdf->setxy(203,$y);	
$pdf->MultiCell(15,4,utf8_decode("Acu. Est."),1,'L',0);
$pdf->setxy(218,$y);	
$pdf->MultiCell(55,4,utf8_decode("Observaciones"),1,'L',0);
$pdf->SetFont('Arial','',7);
$rspta=$info->insertar_rec(1,"2024-01-01","2024-01-01","","",0,"","",$_SESSION['usu_id'],"");
$y=$y+4;
$r=$y+4;
$fir="";	
$i=0;	
while ($reg=$rspta->fetch_object()) {
	if ($i==0)
		$fir=explode("--", $reg->rec_asignatura)[0];		
	else
		$fir=$fir.",".explode("--", $reg->rec_asignatura)[0];
	$pdf->setxy(5,$y);	
	$pdf->MultiCell(23,4,utf8_decode($reg->rec_fechaa),'T','L',0);
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(28,$y);	
	$pdf->MultiCell(30,4,utf8_decode($reg->rec_fechar),'T','L',0);	
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(58,$y);	
	$pdf->MultiCell(80,4,utf8_decode($reg->rec_tema),'T','L',0);	
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(138,$y);	
	$pdf->MultiCell(40,4,utf8_decode(explode("--", $reg->rec_asignatura)[2]." - ".explode("--", $reg->rec_asignatura)[3]),'T','L',0);	
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(178,$y);	
	$pdf->MultiCell(10,4,utf8_decode($reg->rec_horas),'T','L',0);
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(188,$y);	
	$pdf->MultiCell(15,4,utf8_decode($reg->rec_modalidad),'T','L',0);
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(203,$y);	
	$pdf->MultiCell(15,4,utf8_decode($reg->rec_acuerdo),'T','L',0);
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$pdf->setxy(218,$y);	
	$pdf->MultiCell(55,4,utf8_decode($reg->rec_observacion),'T','L',0);
	if ($r<$pdf->gety())
		$r=$pdf->gety();
	$y=$r;
	$i++;
  }
$pdf->sety($pdf->gety()+10);	
	//firmas

$rspta=$info->obt_firmasr($fir);
$pdf->SetFont('Arial','',6	);
$tope=$pdf->getx();
$ini=$pdf->gety();
	$pdf->SetFont('Arial','B',5);
	$pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,4,utf8_decode("Elaborado por:"),'LTR','C',0);
    $pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,19,utf8_decode(""),'LR','C',0);
    $pdf->setx($tope);
	
	$pdf->MultiCell(45,4,utf8_decode($_SESSION['usu_nombre']),'LR','C',0);
    $pdf->setx($tope);
	$pdf->SetFont('Arial','B',5);
	$pdf->MultiCell(45,2,utf8_decode("DCODENTE IST"),'LR','C',0);
	$pdf->setx($tope);
	$pdf->MultiCell(45,2,utf8_decode(""),'LBR','C',0);	
	$tope=$tope+45;
	$pdf->sety($ini);

	$pdf->sety($ini);
while ($reg=$rspta->fetch_object()) {   
	$pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,4,utf8_decode("Revisado por:"),'LTR','C',0);
    $pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,19,utf8_decode(""),'LR','C',0);
    $pdf->setx($tope);
	$pdf->MultiCell(45,4,utf8_decode($reg->usu_nombre),'LR','C',0);
    $pdf->setx($tope);
	$pdf->SetFont('Arial','B',5);
	$pdf->MultiCell(45,2,utf8_decode("COORDINADOR DE LA CARRERA "),'LR','C',0);
	$pdf->setx($tope);
	$pdf->MultiCell(45,2,utf8_decode($reg->cat_nombre),'LBR','C',0);	
	$tope=$tope+45;
	$pdf->sety($ini);
}
	$pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,4,utf8_decode("Verificado por:"),'LTR','C',0);
    $pdf->setxy($tope,$pdf->gety());
	$pdf->MultiCell(45,19,utf8_decode(""),'LR','C',0);
    $pdf->setx($tope);
	$pdf->MultiCell(45,4,utf8_decode("CRISTIAN ANDRADE CH."),'LR','C',0);
    $pdf->setx($tope);
	$pdf->SetFont('Arial','B',5);
	$pdf->MultiCell(45,2,utf8_decode("VICERRECTOR "),'LR','C',0);
	$pdf->setx($tope);
	$pdf->MultiCell(45,2,utf8_decode("INSTITUTO 17 DE JULIO"),'LBR','C',0);	
	$tope=$tope+45;
	$pdf->setxy(5,$pdf->gety()+10 );
	$pdf->SetFont('Arial','',7);
	$pdf->MultiCell(100,4,utf8_decode("FECHA: ".date("F j, Y, g:i a")),0,'L',0);
	$pdf->MultiCell(260,4,utf8_decode("* Se adjunta formato de lista de estudiantes matriculados, los estudiantes deberán firmar y se adjuntará como anexo"),0,'L',0);





$pdf->Output();



}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>
