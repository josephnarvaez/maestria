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
require_once "../modelos/giras.php";
$info=new giras();

//incluimos a la clase PDF_MC_Table
require('PDF_MC_TableGira.php');

//instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table('p','mm','letter');
	
$_SESSION["t1"]='     SALIDAS DE CAMPO O GIRAS';
$_SESSION["t2"]='     PEDAGÓGICAS';
$_SESSION["c"]='12-INS-01';
//agregamos la primera pagina al documento pdf
/*
$pdf->AddPage();

//seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial=5;


$pdf->setXy(18,42);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(180,6,utf8_decode( 'Lineamientos para Salidas de Campo o Giras Pedagógicas del Instituto Superior Tecnológico 17 de Julio.'),'','C',0);
	$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,6,utf8_decode('
Objetivo:
Establecer un marco normativo para las salidas formales de los estudiantes del Instituto Superior Tecnológico 17 de Julio (IST17J), con el fin de garantizar su seguridad, el cumplimiento de objetivos pedagógicos y el adecuado manejo de los recursos institucionales.

Procedimiento:
1. Acercamientos Preliminares:
   - Antes de planificar una salida, el docente responsable deberá realizar acercamientos previos con las empresas, instituciones u otras entidades pertinentes, dependiendo de la carrera y los objetivos específicos de la actividad.

2. Solicitud de Salida (Llenar documento:12-REG-01):
   - Una vez obtenida la aprobación preliminar de los socios estratégicos, el docente deberá completar el formato de solicitud de salida, disponible en la plantilla correspondiente. Esta solicitud incluirá:
     - Nombre del docente responsable.
     - Fecha de solicitud.
     - Tipo de salida.
     - Número de estudiantes participantes.
     - Número de docentes acompañantes.
     - Fecha y hora estimada de salida y regreso.
     - Requerimientos para la salida (ropa, calzado, alimentación, agua, transporte, materiales, etc.).
     - Objetivos de la salida.
     - Itinerario detallado.
     - Listado de estudiantes y docentes con su información personal y de contacto.

3. Aprobación:
   - La aprobación de la salida estará sujeta al correcto llenado de la solicitud y la presentación de los respaldos necesarios.
   - Una vez firmada por el docente responsable, la solicitud deberá obtener dos firmas adicionales:
a.	Del coordinador/a de carrera, quien aprueba la salida.
b.	 Del coordinador/a de vinculación, quien certifica que se cuenta con póliza de seguro proporcionada por SENESCYT.

4. Observaciones:
   - En caso de que la salida implique actividades adicionales no notificadas inicialmente (por ejemplo, visitas a múltiples lugares), se deberán incluir observaciones detalladas en la solicitud.'),'','L',0);
$pdf->AddPage();
$pdf->setXy(17,48);
$pdf->MultiCell(180,6,utf8_decode(' 5. Informe Post Salida (Llenar documento: 12-REG-02):
   - Una vez concluida la salida, se deberá completar un informe post salida utilizando la plantilla proporcionada.
   - El informe incluirá información detallada sobre los docentes involucrados, la fecha de la salida, los objetivos alcanzados, los productos obtenidos, el listado de estudiantes participantes con confirmación de asistencia, observaciones relevantes y las firmas de los docentes involucrados.
   - Este informe deberá entregarse como máximo 72 horas después del retorno de la salida para su revisión y aprobación por parte del coordinador de carrera, vicerrector y rector.

Responsabilidades:
- Docentes Responsables:
	*	Planificar, coordinar y supervisar la salida.
	*	Completar la solicitud de salida y el informe post salida con precisión (Entregar documento:12-REG-02). 
	*	Obtener las firmas correspondientes y asegurar la entrega oportuna de los documentos.
- Coordinador de Carrera:
	*	Aprobar la solicitud de salida y el informe post salida.
	*	Brindar apoyo logístico y académico según corresponda.
- Coordinador de Vinculación:
	*	Certificar la existencia de póliza de seguro proporcionada por SENESCYT.
- Vicerrector y Rector:
	*	Revisar y aprobar el informe post salida.

Disposiciones Finales:
- Cualquier modificación en la planificación de la salida deberá ser comunicada y aprobada previamente por las instancias correspondientes.
- El incumplimiento de los lineamientos establecidos en este documento podrá conllevar a sanciones disciplinarias según lo establecido por las normativas institucionales.

Este documento entra en vigencia a partir de su aprobación por las autoridades competentes del IST 17 de Julio y deberá ser adherido al proceso de todas las salidas o giras pedagógicas realizadas por la institución.
'),'','L',0);	
	*/
$pdf->setXy(17,50);

$_SESSION["t1"]='     SOLICITUD SALIDA DE';
$_SESSION["t2"]='     CAMPO/GIRA';
$_SESSION["c"]='12-REG-01';
//agregamos la primera pagina al documento pdf
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->setxy(15,45);


$rspta=$info->reportegiras($_GET["id"]);
$row = $rspta->fetch_row();
$pdf->MultiCell(150,6,"Docente:   ".utf8_decode($row[15]),'0','L',0);
$pdf->Ln();
$y=	$pdf->gety();
$pdf->setx(15);	
$x=	$pdf->getx();
$pdf->MultiCell(48,6,"Fecha de Solicitud:",'','L',0);
$pdf->setXY($x+48,$y);
$pdf->MultiCell(46,6,utf8_decode($row[4]),'B','L',0);	
$pdf->setXY($x+94,$y);
$pdf->MultiCell(50,6,"Tipo de Salida:   ",'','L',0);
$pdf->setXY($x+144,$y);
$pdf->MultiCell(46,6,utf8_decode($row[15]),'B','L',0);
$y=	$pdf->gety();
$pdf->setx(15);	
$pdf->MultiCell(48,6,utf8_decode("Nro. de Estudiantes:   "),'','L',0);
$pdf->setXY($x+48,$y);
$pdf->MultiCell(46,6,utf8_decode($row[3]),'B','L',0);	
$pdf->setXY($x+94,$y);
$pdf->MultiCell(50,6,utf8_decode("Nro. docentes/acompañantes:"),'','L',0);
$pdf->setXY($x+144,$y);
$pdf->MultiCell(46,6,utf8_decode($row[18]),'B','L',0);

$y=	$pdf->gety();
$pdf->setx(15);	
$x=	$pdf->getx();
$pdf->MultiCell(48,6,"Fecha de salida:",'LT','L',0);
$pdf->setXY($x+48,$y);
$pdf->MultiCell(46,6,utf8_decode($row[5]),'B','L',0);	
$pdf->setXY($x+94,$y);
$pdf->MultiCell(50,6,"Fecha de retorno:",'T','L',0);
$pdf->setXY($x+144,$y);
$pdf->MultiCell(46,6,utf8_decode($row[7]),'BR','L',0);
$y=	$pdf->gety();
$pdf->setx(15);	
$pdf->MultiCell(48,6,utf8_decode("Hora estimada de salida:"),'LB','L',0);
$pdf->setXY($x+48,$y);
$pdf->MultiCell(46,6,utf8_decode($row[6]),'B','L',0);	
$pdf->setXY($x+94,$y);
$pdf->MultiCell(50,6,utf8_decode("Hora estimada de retorno:"),'B','L',0);
$pdf->setXY($x+144,$y);
$pdf->MultiCell(46,6,utf8_decode($row[8]),'BR','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode("REQUERIMIENTOS PARA A REALIZACIÓN DE LA SALIDA DE CAMPO/PRÁCTICA"),'','C',0);	

$pdf->setx(15);	
$pdf->MultiCell(48,6,utf8_decode("Tipo de ropa y calzado:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[9]),1,'L',0);
$pdf->setx(15);	
$pdf->MultiCell(48,6,utf8_decode("Alimentación y agua:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[10]),1,'L',0);
$pdf->setx(15);	
$pdf->MultiCell(48,6,utf8_decode("Transporte:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[11]),1,'L',0);
$pdf->setx(15);	
$pdf->MultiCell(108,6,utf8_decode("Materiales que los estudiantes deben llevar:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[12]),1,'L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode("Objetivos de la salida de campo/práctica/actividades:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[13]),1,'L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode("Itinerario por cumplir en la Salida / rutas a seguir:"),'','L',0);
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode($row[14]),1,'L',0);
$pdf->AddPage();	
$pdf->setx(15);	
$pdf->MultiCell(190,6,utf8_decode("REGISTRO DE DOCENTES QUE ASISTIRÁN"),'','C',0);	
$rspta=$info->reportedocgiras($_GET["id"]);

while ($reg=$rspta->fetch_object()) {
	$y=	$pdf->gety();
	$pdf->setx(40);
	$pdf->MultiCell(55,6,utf8_decode($reg->usu_nombre),'B','L',0);
	$pdf->setXY($x+80,$y);
	$pdf->MultiCell(25,6,utf8_decode($reg->usu_cedula),'B','L',0);
	$pdf->setXY($x+105,$y);
	$pdf->MultiCell(25,6,utf8_decode($reg->cargo),'B','L',0);
	$pdf->setXY($x+130,$y);
	$pdf->MultiCell(25,6,utf8_decode($reg->usu_telefono),'B','L',0);
}
$pdf->setxy(15,$y+12);	
	$y=	$pdf->gety();

$pdf->MultiCell(90,4,utf8_decode("Firma de docente: 
                               
							   
							   
															
															
															"),1,'L',0);	
$pdf->setXY($x+90,$y);
$pdf->MultiCell(90,4,utf8_decode("Firma Coordinador de Vinculación en caso de tener seguro estudiantil vigente:





"),1,'L',0);
	$y=	$pdf->gety();	
$pdf->setx(15);	
$pdf->MultiCell(180,6,utf8_decode("Observaciones:




"),1,'L',0);		
$y=	$pdf->gety();		
$pdf->setxy(15,$y+6);	
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190,6,utf8_decode("Adjuntamos el listado de estudiantes"),'','L',0);	
$pdf->Output();



}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>
