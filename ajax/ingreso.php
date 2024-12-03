<?php 
require_once "../modelos/Ingreso.php";
if (strlen(session_id())<1) 
	session_start();

$opcion=isset($_POST["opcion"])? limpiarCadena($_POST["opcion"]):"";
$idh=isset($_POST["hhorario"])? limpiarCadena($_POST["hhorario"]):"";
$dia=isset($_POST["dhorario"])? limpiarCadena($_POST["dhorario"]):"";

$ingreso=new Ingreso();

switch ($_GET["op"]) {
	case 'guardaryeditar':
	 
		break;
	case 'guardarmateria':
		$rspta=$ingreso->insertarmate('9','-',$opcion,$idh,$dia,$_SESSION["usu_id"]);	
		//echo $idmateria.'-'.$paralelo.'-'.$idaula.'-'.$idh.'-'.$dia	;
		echo $rspta;
		
 	break;		
		case 'combo_materia':			
			$rspta = $ingreso->obten_materias($_SESSION['usu_id']);
			while ($reg = $rspta->fetch_object()) {
				if (!is_null($reg->cat_detalle)){
					$detalle=explode("/", $reg->cat_detalle);
					echo '<option value='.$reg->cat_id.'>'.$detalle[2].' - '.$reg->cat_nombre.'</option>';
					}
				
			}
			break;	
			
		case 'combo_opciones':			
			$rspta = $ingreso->obten_opciones(4);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;	
	
			
		case 'horario':
		$rspta=$ingreso->presentar_horario(1,$_SESSION['usu_id']);
		//echo $rspta;
		$data=Array();
					
		while ($reg=$rspta->fetch_object()) {
			if (is_null($reg->deth_lunes) or $reg->deth_lunes=='' )
			   {
				$opl='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',1)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_lunes);
				$rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
		        if($inf[1]=='-')
					$opl='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',1)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',1)"><i class="fa fa-trash"></i></button>';	
				else	
					$opl='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
								
			}
			if (is_null($reg->deth_martes) or $reg->deth_martes=='')
			   {
				$op2='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',2)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_martes);
			    $rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				if($inf[1]=='-')
					$op2='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',2)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',2)"><i class="fa fa-trash"></i></button>';
				else	
					$op2='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
			
			}
			if (is_null($reg->deth_miercoles) or $reg->deth_miercoles=='')
			   {
				$op3='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',3)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_miercoles);
			    $rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				if($inf[1]=='-')
  					$op3='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',3)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',3)"><i class="fa fa-trash"></i></button>';
				else	
					$op3='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
			}
			if (is_null($reg->deth_jueves) or $reg->deth_jueves=='')
			   {
				$op4='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',4)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_jueves );
			    $rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				if($inf[1]=='-')
					$op4='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',4)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',4)"><i class="fa fa-trash"></i></button>';
				else
				    $op4='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
			}
			if (is_null($reg->deth_viernes)  or $reg->deth_viernes=='')
			   {
				$op5='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',5)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_viernes);
			    $rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				if($inf[1]=='-')
					$op5='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',5)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',5)"><i class="fa fa-trash"></i></button>';
				else
					$op5='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';	
				
			}
			if (is_null($reg->deth_sabado) or $reg->deth_sabado=='')
			   {
				$op6='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',6)"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_sabado );
			    $rspta1=$ingreso->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				if($inf[1]=='-')
					$op6='<span style="color:BLACK; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.'</p>'.$reg1->aula.'</span><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',6)"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',6)"><i class="fa fa-trash"></i></button>';
    				else
					$op6='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';	
				
			}
			$data[]=array(
            "0"=>$reg->deth_id,
			"1"=>$reg->deth_hora,
			"2"=>$opl,
			"3"=>$op2,
	        "4"=>$op3,
	        "5"=>$op4,
	        "6"=>$op5,
	        "7"=>$op6
	       );
			
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
			 
    	echo json_encode($results);
		break;
}
 ?>
