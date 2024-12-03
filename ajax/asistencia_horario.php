<?php 
require_once "../modelos/asistencias.php";
$informe = new Asistencias();
//$fech=isset($_POST["dia"])? limpiarCadena($_POST["dia"]):"";
function acentos($cadena) 
{
   $search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü");
   $replace = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}
function obten_empresa($lat,$lon) {
	   $inf = new Asistencias();
       $rspta=$inf->obten_lasempresas();
		while ($reg=$rspta->fetch_object()) {
			$theta = $lon - $reg->emp_lon;
     		$dist = sin(deg2rad($lat)) * sin(deg2rad($reg->emp_lat)) +  cos(deg2rad($lat)) * cos(deg2rad($reg->emp_lat)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
		    $dist = $dist * 1000;
			if ($reg->emp_nombre<>"IST 17 DE JULIO IBARRA" and $reg->emp_nombre<>"IST 17 DE JULIO YACHAY" ){
					if (round($dist,2)<0.1)
			           return $reg->emp_nombre;
			}
			else { 
					if (round($dist,2)<5)
			           return $reg->emp_nombre;
			}
		}   
		return -1;  
		            
    }

if (strlen(session_id())<1) 
	session_start();


switch ($_GET["op"]) {
	case 'asistenciahorario':
		$date1 = new DateTime($_GET["diai"]);
        $date2 = new DateTime($_GET["diaf"]);
		
		$rspta=$informe->historico(0,$_GET["diai"],$_GET["diaf"],$_GET["docente"]);//$_SESSION["inf"]);
		//echo json_encode($rspta->fetch_row());
		$i=0;
		$data=Array();
		$tht=0;
		$HoraT = strtotime('00:00');
		while ($reg=$rspta->fetch_object()) {			
			$t1= explode("-",$reg->his_entrada);		
			$t2= explode("-",$reg->his_salida);
			if (count($t1)>1)
				$tt1=$t1[1];
			else
				$tt1=$reg->his_entrada;
			
		    if (count($t2)>1)
				$tt2=$t2[1];
			else
				$tt2=$reg->his_salida;		
		
		    if ($tt1=="SP"){
				$tt1=$tt2;
			}	
			if ($tt2=="SP"){
				$tt2=$tt1;
			}	
			if ((((strtotime($tt2)-(strtotime($tt1)))/3600)-1)>$reg->horas)
				$t1=$reg->horas;
			else	
				$t1=((strtotime($tt2)-(strtotime($tt1)))/3600)-1;
			if ($t1<>-1)
			    $tht=$tht+$t1;
			$data[]=array(
			"0"=>$reg->his_fecha,
			"1"=>$reg->his_entrada,
			"2"=>$reg->his_salidaalmuerzo,
			"3"=>$reg->his_entradaalmuerzo,
			"4"=>$reg->his_salida,
			"5"=>$reg->his_sede,
			"6"=>acentos($reg->his_observaciones),
			"7"=>$reg->his_tiempo,
			"8"=>round($t1,2)
			);
			
			$HoraT=$HoraT+strtotime($reg->his_tiempo);
			$i++;
		  }	
	
		$data[$i]=array(             
		    "0"=>"Total Tiempo",
	        "1"=>"",
            "2"=>"",
			"3"=>"",
			"4"=>"",
			"5"=>"",
			"6"=>"",
			"7"=>date('H:i:s', $HoraT),
			"8"=>round($tht,2),
            );
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	    echo json_encode($results);
		break;     
			
    case 'asistenciahorarioi':
		$date1 = new DateTime($_GET["diai"]);
        $date2 = new DateTime($_GET["diaf"]);
		$rspta=$informe->historico(0,$_GET["diai"],$_GET["diaf"],$_SESSION["usu_id"]);//$_SESSION["inf"]);
		$data=Array();
		$HoraT = strtotime('00:00');
		$i=0;
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>$reg->his_fecha,
			"1"=>$reg->his_entrada,
			"2"=>$reg->his_salidaalmuerzo,
			"3"=>$reg->his_entradaalmuerzo,
			"4"=>$reg->his_salida,
			"5"=>$reg->his_sede,
			"6"=>acentos($reg->his_observaciones),
			"7"=>$reg->his_tiempo);
			$HoraT=$HoraT+strtotime($reg->his_tiempo);
			$i++;
		  }	
		  $data[$i]=array(             
		    "0"=>"Fin",
	        "1"=>"",
            "2"=>"",
			"3"=>"",
			"4"=>"",
			"5"=>"",
			"6"=>"",
			"7"=>""    					
            );
		  $i++;
	      $data[$i]=array(             
		    "0"=>"Tiempo Atraso:",
	        "1"=>date('H:i:s', $HoraT),
            "2"=>"",
			"3"=>"",
			"4"=>"",
			"5"=>"Firma Docente:",
			"6"=>"",
			"7"=>""  					
            );
	    
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	    echo json_encode($results);
	   	break;     
		
	case 'combo_periodos':			
			$rspta = $informe->combo(3);
			$op1= '<option value="---">-----</option>';
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
	case 'resto':			
		$rspta=$informe->obt_ract($_GET['op1'],$_GET['idinfo'],$_GET['tipo']);
		$data1="" ;
		
		while ($reg=$rspta->fetch_row()) {
			$data1=$reg[3].'&'.$reg[4].'&'.$reg[5].'&'.$reg[6];
					
		  }
		echo json_encode($data1);
		break;
	case 'otras':
		$data1 = array();
	    if ($_GET['idinfo']==0)
		   {
	 	    for ($j=0; $j<13; $j++)
		      {
				$data1[$j][0]=0;
				$data1[$j][1]="";
				$data1[$j][2]="";
			
			  }
		   }
		else{   
			$rspta=$informe->obten_oact(1,$_GET['idinfo']);//$_SESSION["inf"]);
			$i=0; 
			while ($reg=$rspta->fetch_object()) {
				$data1[$i][0]=$reg->iot_horas;
				$data1[$i][1]=$reg->iot_medios;
				$data1[$i][2]=$reg->iot_obj;
				$i++;
			  }
		}
		$i=0;
		$data[$i]=array(
        	"0"=>'1',
			"1"=>'PREPARACIÓN Y ACTUALIZACIÓN DE CLASES, SEMINARIOS, TALLERES, ENTRE OTROS',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'" />',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text">'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" />'.$data1[$i][2].' </textarea>'	
	       );
		$i++;   
		$data[$i]=array(
        	"0"=>'2',
			"1"=>'DISEÑO Y ELABORACIÓN DE LIBROS, MATERIAL DIDÁCTICO, GUÍAS DOCENTES O SYLLABUS',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		 $i++;
		$data[$i]=array(
        	"0"=>'3',
			"1"=>'ORIENTACIÓN Y ACOMPAÑAMIENTO A TRAVÉS DE TUTORÍAS PRESENCIALES O VIRTUALES, INDIVIDUALES O GRUPALES',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;   
		$data[$i]=array(
        	"0"=>'4',
			"1"=>'VISITAS DE CAMPO, TUTORÍAS, DOCENCIA EN SERVICIO Y FORMACIÓN DUAL',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;   
		$data[$i]=array(
        	"0"=>'5',
			"1"=>'DIRECCIÓN, TUTORÍAS, SEGUIMIENTO Y EVALUACIÓN DE PRÁCTICAS O PASANTÍAS PRE PROFESIONALES',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;
		$data[$i]=array(
        	"0"=>'6',
			"1"=>'PREPARACIÓN, ELABORACIÓN, APLICACIÓN Y CALIFICACIÓN DE EXÁMENES, TRABAJOS Y PRÁCTICAS',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		 $i++;
		 $data[$i]=array(
        	"0"=>'7',
			"1"=>'DIRECCIÓN Y TUTORÍA DE TRABAJOS PARA LA OBTENCIÓN DEL TÍTULO, CON EXCEPCIÓN DE TESIS DOCTORALES O DE MAESTRÍAS DE INVESTIGACIÓN',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;
		$data[$i]=array(
        	"0"=>'8',
			"1"=>'DIRECCIÓN Y PARTICIPACIÓN DE PROYECTOS DE EXPERIMENTACIÓN E INNOVACIÓN DOCENTE',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;
		 $data[$i]=array(
            "0"=>'9',
        	"1"=>'DISEÑO E IMPARTICIÓN DE CURSOS DE EDUCACIÓN CONTINUA O DE CAPACITACIÓN Y ACTUALIZACIÓN',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
		$i++;   
		$data[$i]=array(
        	"0"=>'10',
			"1"=>'PARTICIPACIÓN EN ACTIVIDADES DE PROYECTOS SOCIALES, ARTÍSTICOS, PRODUCTIVOS Y EMPRESARIALES DE VINCULACIÓN CON LA SOCIEDAD ARTICULADOS A LA DOCENCIA E INNOVACIÓN EDUCATIVA;',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
			$i++;   
		$data[$i]=array(
        	"0"=>'11',
			"1"=>'PARTICIPACIÓN Y ORGANIZACIÓN DE COLECTIVOS ACADÉMICOS DE DEBATE, CAPACITACIÓN O INTERCAMBIO DE METODOLOGÍAS Y EXPERIENCIAS DE ENSEÑANZA;',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );
			$i++;   
		$data[$i]=array(
        	"0"=>'12',
			"1"=>'USO PEDAGÓGICO DE LA INVESTIGACIÓN Y LA SISTEMATIZACIÓN COMO SOPORTE O PARTE DE LA ENSEÑANZA;',
			"2"=>'<input name="horaso'.$i.'" id="horaso'.$i.'" type="text" value="'.$data1[$i][0].'"/>',
			"3"=>'<textarea name="medioso'.$i.'" id="medioso'.$i.'" type="text" >'.$data1[$i][1].' </textarea>',
	        "4"=>'<textarea name="objo'.$i.'" id="objo'.$i.'" type="text" >'.$data1[$i][2].' </textarea>'
	       );             
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		
    	echo json_encode($results);
		break;
	
}
 ?>