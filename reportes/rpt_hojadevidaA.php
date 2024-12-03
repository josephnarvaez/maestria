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
require_once "../modelos/hojadevida.php";
$info=new hoja();
$_SESSION["usuA"]=$_GET["usu"];
$rspta=$info->info(3);
$reg = $rspta->fetch_object();

//incluimos a la clase PDF_MC_Table
require('PDF_MC_TableHV.php');

//instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table('l','mm','letter');

//agregamos la primera pagina al documento pdf
$pdf->AddPage();

//seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial=5;

$pdf->Ln();
$firma=$reg->doc_cedula;
$nombredoc=$reg->doc_apellido1." ".$reg->doc_apellido2." ".$reg->doc_nombre1." ".$reg->doc_nombre2;

$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,48);
$pdf->Cell(80,0,'DATOS PERSONALES',0,0,'L');
$pdf->setXy(17,50);
$pdf->SetFont('Arial','B',7);
$pdf->Image("../files/usuarios/".$reg->doc_cedula.".jpg", 17, 51, 25);
$pdf->setXy(44,50);
$pdf->MultiCell(35,5,"Apellidos: ",0,'L',0);
$pdf->setXy(67,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,5,utf8_decode($reg->doc_apellido1." ".$reg->doc_apellido2),'','L',0);
$pdf->setXy(110,50);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Nombres: ",0,'L',0);
$pdf->setXy(130,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(85,5,utf8_decode($reg->doc_nombre1." ".$reg->doc_nombre2),'','L',0);
$pdf->setXy(165,50);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Cédula: "),0,'L',0);
$pdf->setXy(185,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_cedula),'','L',0);
$pdf->setXy(215,50);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Nacimiento: "),0,'L',0);
$pdf->setXy(235,50);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_fechanace),'','L',0);

$pdf->setXy(44,55);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Género: "),0,'L',0);
$pdf->setXy(67,55);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,5,utf8_decode($reg->cat_id_g),'','L',0);
$pdf->setXy(110,55);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Nacionalidad: ",0,'L',0);
$pdf->setXy(130,55);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(85,5,utf8_decode($reg->doc_nacionalidad),'','L',0);
$pdf->setXy(165,55);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Estado Civil: "),0,'L',0);
$pdf->setXy(185,55);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_estadocivil),'','L',0);
$pdf->setXy(215,55);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Etnia: ",0,'L',0);
$pdf->setXy(235,55);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->cat_id_e),'','L',0);	

$pdf->setXy(44,60);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Tipo de Sangre: ",0,'L',0);
$pdf->setXy(67,60);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,5,utf8_decode($reg->cat_id_s),'','L',0);
$pdf->setXy(110,60);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Telf. Celular: "),0,'L',0);
$pdf->setXy(130,60);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(70,5,utf8_decode($reg->doc_tcelular),'','L',0);	
$pdf->setXy(165,60);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Telf. Domicilio: ",0,'L',0);
$pdf->setXy(185,60);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_tcasa),'','L',0);

$pdf->setXy(44,65);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Dirección: "),0,'L',0);
$pdf->setXy(67,65);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(0,5,utf8_decode($reg->doc_direccion),'','L',0);	
$y=$pdf->gety();
	
$pdf->setXy(44,$y);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Correo Personal: "),0,'L',0);
$pdf->setXy(67,$y);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_correop),'','L',0);$pdf->setXy(80,70);
$pdf->setXy(110,$y);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Correo IST: ",0,'L',0);
$pdf->setXy(130,$y);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_correoi),'','L',0);
	
$y=$y+5;
$pdf->setXy(44,$y);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Contacto: "),0,'L',0);
$pdf->setXy(67,$y);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_nombrec),'','L',0);$pdf->setXy(80,70);
$pdf->setXy(110,$y);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,"Telf Contacto: ",0,'L',0);
$pdf->setXy(130,$y);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->doc_tcontacto),'','L',0);
$y=$y+5;
	
$pdf->setXy(44,$y);
$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(35,5,utf8_decode("Discapacidad: "),0,'L',0);
$pdf->setXy(67,$y);
$pdf->SetFont('Arial','',7);	
$pdf->MultiCell(80,5,utf8_decode($reg->cat_id_d),'','L',0);$pdf->setXy(80,70);
if ($reg->cat_id_d!="NINGUNA"){
	$pdf->setXy(110,$y);
	$pdf->SetFont('Arial','B',7);
	$pdf->MultiCell(35,5,"Porcentaje: ",0,'L',0);
	$pdf->setXy(130,$y);
	$pdf->SetFont('Arial','',7);	
	$pdf->MultiCell(80,5,utf8_decode($reg->doc_porcentaje),'','L',0);
	$pdf->setXy(165,$y);
	$pdf->SetFont('Arial','B',7);
	$pdf->MultiCell(35,5,utf8_decode("Nro. Carnet: "),0,'L',0);
	$pdf->setXy(185,$y);
	$pdf->SetFont('Arial','',7);	
	$pdf->MultiCell(80,5,utf8_decode($reg->doc_nrocarnet),'','L',0);
}
	
$y=$y+15;
$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,$y);
$pdf->Cell(80,0,utf8_decode('INSTRUCCIÓN FORMAL'),0,0,'L');
$y=$y+5;
$pdf->setXy(17,$y);
$pdf->SetFont('Arial','B',7	);
$pdf->MultiCell(83,5,utf8_decode("Institución"),1,'L',0);
$pdf->setXy(100,$y);
$pdf->MultiCell(87,5,utf8_decode("Título"),1,'L',0);
$pdf->setXy(187,$y);
$pdf->MultiCell(29,5,"Nro Registro",1,'L',0);
$pdf->setXy(216,$y);
$pdf->MultiCell(19,5,"Fecha",1,'L',0);
$pdf->setXy(235,$y);
$pdf->MultiCell(25,5,"Nivel",1,'L',0);
$y=$y+5;
$rspta=$info->obten_data(1,0);
while ($reg=$rspta->fetch_object()) {
	$r=0;
	$r1=0;
	$pdf->setXy(17,$y);
	$pdf->SetFont('Arial','',7	);
	$v1=0;
	$v2=0;
		$pdf->MultiCell(83,5,utf8_decode($reg->ins_institucion),'T','L',0);
		$pdf->setXy(100,$y);
	    $v1=$pdf->gety();
		$pdf->MultiCell(87,5,utf8_decode($reg->ins_titulo),'T','L',0);
	    $v2=$pdf->gety();
		$pdf->setXy(187,$y);
		$pdf->MultiCell(29,5,$reg->ins_registro,'T','L',0);
		$pdf->setXy(216,$y);
		$pdf->MultiCell(19,5,$reg->ins_fecha,'T','L',0);
		$pdf->setXy(235,$y);
		$pdf->MultiCell(25,5,$reg->ins_nivel,'T','L',0);

	if (  $v1>$v2)
		$y=$v1;
	else
		$y=$v2;
	if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
  }
$y=$pdf->gety()+10;
$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,$y);
$pdf->Cell(80,0,'EXPERIENCIA LABORAL',0,0,'L');
if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
$y=$y+5;
$rspta=$info->obten_data(1,1);
$pdf->setXy(17,$y);
$pdf->SetFont('Arial','B',7	);
$pdf->MultiCell(93,5,utf8_decode("Institución"),'T','L',0);
$pdf->setXy(110,$y);
$pdf->MultiCell(93,5,utf8_decode("Cargo"),'T','L',0);
$pdf->setXy(203,$y);
$pdf->MultiCell(18,5,"Fecha Desde",'T','L',0);
$pdf->setXy(221,$y);
$pdf->MultiCell(17,5,"Fecha Hasta",'T','L',0);
$pdf->setXy(238,$y);
$pdf->MultiCell(22,5,utf8_decode("Teléfono"),'T','L',0);
$y=$y+5;	
while ($reg=$rspta->fetch_object()) {
	$v1=0;
	$v2=0;
	$v3=0;
	$pdf->setXy(17,$y);
	$pdf->SetFont('Arial','',7	);
    
			$pdf->MultiCell(93,5,utf8_decode($reg->exp_institucion),'T','L',0);
	        $v1=$pdf->gety();
			$pdf->setXy(110,$y);
			$pdf->MultiCell(93,5,utf8_decode($reg->exp_cargo),'T','L',0);
	        $v2=$pdf->gety();
			$pdf->setXy(203,$y);
			$pdf->MultiCell(18,5,$reg->exp_fechad,'T','L',0);
			$pdf->setXy(221,$y);
	 if ($reg->exp_fechah=='1900-01-01')
	 {
		 $pdf->SetFont('Arial','',5	);
		  $pdf->MultiCell(17,5,'EN FUNCIONES','T','L',0);
		 $pdf->SetFont('Arial','',7	);
	 }
		
	 else{
		 $pdf->MultiCell(17,5,$reg->exp_fechah,'T','L',0);
		
	 }	 
		$pdf->setXy(238,$y);
	    $pdf->MultiCell(22,5,$reg->exp_telefono,'T','L',0);
         $v3=$pdf->gety();;
		/*
	if (  $v1>$v2)
		$y=$v1;
	else
		$y=$v2;*/
	
	if ($v1>=$v2 && $v1>=$v3)
		$y=$v1;
	if ($v2>=$v1 && $v2>=$v3)
		$y=$v2;
	if ($v3>=$v1 && $v3>=$v2)
		$y=$v3;
	
	if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
  }
	
$y=$pdf->gety()+10;
if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,$y);
$pdf->Cell(80,0,utf8_decode('CAPACITACIÓN'),0,0,'L');
if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
$y=$y+5;
$rspta=$info->obten_data(1,2);
$pdf->setXy(17,$y);
$pdf->SetFont('Arial','B',7	);
$pdf->MultiCell(26,5,utf8_decode("Tipo"),1,'L',0);
$pdf->setXy(43,$y);
$pdf->MultiCell(78,5,utf8_decode("Tema"),1,'L',0);
$pdf->setXy(121,$y);
$pdf->MultiCell(76,5,utf8_decode("Institución"),1,'L',0);
$pdf->setXy(197,$y);	
$pdf->MultiCell(22,5,utf8_decode("Certificación"),1,'L',0);
$pdf->setXy(219,$y);	
$pdf->MultiCell(15,5,"Fecha D.",1,'L',0);
$pdf->setXy(234,$y);
$pdf->MultiCell(15,5,"Fecha H.",1,'L',0);
$pdf->setXy(249,$y);
$pdf->MultiCell(11,5,"HORAS",1,'L',0);
$y=$y+5;	
while ($reg=$rspta->fetch_object()) {
	$v1=0;
	$v2=0;
	$pdf->setXy(17,$y);
	$pdf->SetFont('Arial','',7	);

		$pdf->MultiCell(26,5,utf8_decode($reg->cat_id_t),'T','L',0);
		$pdf->setXy(43,$y);
		$pdf->MultiCell(78,5,utf8_decode($reg->cap_tema),'T','L',0);
	    $v1=$pdf->gety();
		$pdf->setXy(121,$y);	   
		$pdf->MultiCell(76,5,utf8_decode($reg->cap_institucion),'T','L',0);
	    $v2=$pdf->gety();
		$pdf->setXy(197,$y);	  
		$pdf->MultiCell(22,5,utf8_decode($reg->cat_id_tc),'T','L',0);
		$pdf->setXy(219,$y);
		$pdf->MultiCell(15,5,$reg->cap_fechad,'T','L',0);
		$pdf->setXy(234,$y);
		$pdf->MultiCell(15,5,$reg->cap_fechah,'T','L',0);	
		$pdf->setXy(249,$y);
		$pdf->MultiCell(11,5,$reg->cap_hora,'T','L',0);
	
	if (  $v1>$v2)
		$y=$v1;
	else
		$y=$v2;

	if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
  }
	
$y=$pdf->gety()+10;
$pdf->SetFont('Arial','B',10);
$pdf->setXy(17,$y);
$pdf->Cell(80,0,utf8_decode('PUBLICACIONES'),0,0,'L');
$y=$y+5;
	$y=$pdf->gety()	;
	if ($pdf->gety()>190){
		$pdf->AddPage();
		$y=48;
	}  
	$y=$y+5;
$rspta=$info->obten_data(1,3);
$pdf->setXy(17,$y);
$pdf->SetFont('Arial','B',7	);

$pdf->MultiCell(20,5,utf8_decode("Libro/Artículo"),1,'L',0);
$pdf->setXy(37,$y);	
$pdf->MultiCell(70,5,utf8_decode("Nombre"),1,'L',0);
$pdf->setXy(107,$y);
$pdf->MultiCell(20,5,utf8_decode("Fecha Pub."),1,'L',0);
$pdf->setXy(127,$y);	
$pdf->MultiCell(36,5,utf8_decode("Editorial/Revista"),1,'L',0);
$pdf->setXy(163,$y);
$pdf->MultiCell(22,5,utf8_decode("ISBN/ISSN"),1,'L',0);
$pdf->setXy(185,$y);
$pdf->MultiCell(18,5,utf8_decode("Participación"),1,'L',0);
$pdf->setXy(203,$y);
$pdf->MultiCell(13,5,"Rev./Ind.",1,'L',0);
$pdf->setXy(216,$y);
$pdf->MultiCell(20,5,"Base de Datos",1,'L',0);
$pdf->setXy(236,$y);
$pdf->MultiCell(22,5,"DOI",1,'L',0);
$y=$y+5;	
	
while ($reg=$rspta->fetch_object()) {
	$v1=0;
	$v2=0;
	$pdf->setXy(17,$y);
	$pdf->SetFont('Arial','',7	);
		$pdf->MultiCell(20,5,utf8_decode($reg->pub_tipo),'T','L',0);
		$pdf->setXy(37,$y);	
		$pdf->MultiCell(70,5,utf8_decode($reg->pub_nombre),'T','L',0);
	    $v1= $pdf->gety();
		$pdf->setXy(107,$y);
		$pdf->MultiCell(20,5,utf8_decode($reg->pub_fecha),'T','L',0);
		$pdf->setXy(127,$y);	
		$pdf->MultiCell(36,5,utf8_decode($reg->pub_editorial),'T','L',0);
	    $v2= $pdf->gety();
		$pdf->setXy(163,$y);
		$pdf->MultiCell(22,5,utf8_decode($reg->pub_isbn),'T','L',0);
	    $v3= $pdf->gety();
		$pdf->setXy(185,$y);
		$pdf->MultiCell(18,5,utf8_decode($reg->pub_participa),'T','L',0);
		$pdf->setXy(203,$y);
		$pdf->MultiCell(13,5,$reg->pub_revisado,'T','L',0);
		$pdf->setXy(216,$y);
		$pdf->MultiCell(20,5,utf8_decode($reg->cat_id_bdd),'T','L',0);
		$pdf->setXy(236,$y);
		$pdf->MultiCell(22,5,utf8_decode($reg->pub_doi),'T','L',0);
	    $v4= $pdf->gety();

	if ($v1>=$v2 and $v1>=$v3)
		$y=$v1;
	if ($v2>=$v1 and $v2>=$v3)
		$y=$v2;
	if ($v3>=$v1 and $v3>=$v2)
		$y=$v3;

	if ($pdf->gety()>165){
		$pdf->AddPage();
		$y=48;
	}  
  }

//firmas

$fir=$pdf->gety()+30 ;
	if ($pdf->gety()>165){
		$pdf->AddPage();
		$fir=48;
		}
$pdf->setxy(83,$fir);
$pdf->MultiCell(80,4,utf8_decode($nombredoc),"T",'C',0);
$pdf->setx(100);
$pdf->MultiCell(45,4,"CI. ".utf8_decode($firma),0,'C',0);


$pdf->Output();



}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>
