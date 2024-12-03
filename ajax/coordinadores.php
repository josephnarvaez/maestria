<?php 
require_once "../modelos/coordinadores.php";

$coordinadores=new coordinadores();

$periodo=isset($_POST["cat_id_periodo"])? limpiarCadena($_POST["cat_id_periodo"]):"";
$docente=isset($_POST["id_docente"])? limpiarCadena($_POST["id_docente"]):"";

$idmateria=isset($_POST["idmateria"])? limpiarCadena($_POST["idmateria"]):"";
$paralelo=isset($_POST["paralelo"])? limpiarCadena($_POST["paralelo"]):"";
$idaula=isset($_POST["idaula"])? limpiarCadena($_POST["idaula"]):"";
$idh=isset($_POST["hhorario"])? limpiarCadena($_POST["hhorario"]):"";
$dia=isset($_POST["dhorario"])? limpiarCadena($_POST["dhorario"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	    $_SESSION["docenteh"]= $docente;
		$rspta=$coordinadores->insertar($periodo,$docente);		
		echo $rspta? "Datos registrados correctamente" : "Ya existe un horario asignado";
		
 	break;
	case 'guardarmateria':
		$rspta=$coordinadores->insertarmate($idmateria,$paralelo,$idaula,$idh,$dia,$_SESSION["docenteh"]);	
		//echo $idmateria.'-'.$paralelo.'-'.$idaula.'-'.$idh.'-'.$dia	;
		echo $rspta;
		
 	break;		
	case 'eliminarm':
		$rspta=$coordinadores->eliminarm($idh,$dia);
		echo json_encode($rspta);

	break;
	case 'eliminar':
		$rspta=$coordinadores->eliminar($_POST["idhorario"]);
		echo json_encode($rspta);

	break;
	case 'mostrar':
		$rspta=$coordinadores->mostrar($_POST["idhorario"]);
		echo json_encode($rspta);
		break;
    case 'listar':
		$rspta=$coordinadores->listar(0,$_SESSION['usu_id']);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="horario('.$reg->hor_id.',\''.$reg->usu_nombre.'\')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->hor_id.')"><i class="fa fa-close"></i></button>',
	        "1"=>$reg->usu_nombre,
            "2"=>$reg->hor_fecha,
            );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
		case 'combo_periodos':			
			$rspta = $coordinadores->combo(3);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
		case 'combo_docentes':			
			$rspta = $coordinadores->obten_usuarios(0,1);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->usu_id.'>'.$reg->usu_nombre.'</option>';
			}
			break;	
		case 'combo_materia':			
			$rspta = $coordinadores->obten_materias($_SESSION['coor']);
			while ($reg = $rspta->fetch_object()) {
				$detalle=explode("/", $reg->cat_detalle);
				echo '<option value='.$reg->cat_id.'>'.$detalle[2].' - '.$reg->cat_nombre.'</option>';
			}
			break;	
		case 'docente':			
			$rspta = $coordinadores->nomdocente(1,$_GET["docente"]);
		    while ($reg = $rspta->fetch_object()) {
		        $doc= $reg->usu_nombre;
			}
		    echo json_encode($doc);
			break;		
		case 'combo_aulas':			
			$rspta = $coordinadores->obten_aulas(2);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;	

	case 'horario':
	     //echo $_GET['op'];
		$_SESSION['hor_id']=$_GET['idh'];
		$rspta=$coordinadores->presentar_horario(0,$_GET['idh']);
		//echo $rspta;
		$data=Array();
					
		while ($reg=$rspta->fetch_object()) {
			if (is_null($reg->deth_lunes) or $reg->deth_lunes=='' )
			   {
				$opl='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',1,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_lunes);
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
				$opl='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
				if ($reg1->carrera == $_SESSION['coor']){
    			    $opl=$opl.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',1,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',1)"><i class="fa fa-trash"></i></button></p>';
			
				}
			}
			if (is_null($reg->deth_martes) or $reg->deth_martes=='')
			   {
				$op2='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',2,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_martes);
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
    			$op2='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
				if ($reg1->carrera == $_SESSION['coor'])
    			    $op2=$op2.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',2,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',2)"><i class="fa fa-trash"></i></button>';
			}
			if (is_null($reg->deth_miercoles) or $reg->deth_miercoles=='')
			   {
				$op3='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',3,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_miercoles);
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
    			$op3='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span></p>';
				if ($reg1->carrera == $_SESSION['coor'])
    			    $op3=$op3.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',3,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',3)"><i class="fa fa-trash"></i></button>';
			   }
			if (is_null($reg->deth_jueves) or $reg->deth_jueves=='')
			   {
				$op4='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',4,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_jueves );
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
    			$op4='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
				if ($reg1->carrera == $_SESSION['coor'])
    			    $op4=$op4.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',4,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',4)"><i class="fa fa-trash"></i></button>';
			   }
		   if (is_null($reg->deth_viernes)  or	 $reg->deth_viernes=='')
			   {
				$op5='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',5,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_viernes);
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
    			$op5='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
				if ($reg1->carrera == $_SESSION['coor'])
    			    $op5=$op5.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',5,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',5)"><i class="fa fa-trash"></i></button>';
			}
			if (is_null($reg->deth_sabado) or $reg->deth_sabado=='')
			   {
				$op6='<p align="center"><button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',6,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button></p>';
			   }
			else{	
			    $inf=explode("/", $reg->deth_sabado );
			    $rspta1=$coordinadores->presentar_info($inf[0],$inf[2]);
				$reg1=$rspta1->fetch_object();
    			$op6='<span style="color:BLUE; font-size:10px;"><p>'.$reg1->nom_carrera.'</p><p>'.$reg1->materia.' ('.$inf[1].')</p>'.$reg1->aula.'</span>';
				if ($reg1->carrera == $_SESSION['coor'])
    			    $op6=$op6.'<button class="btn btn-warning btn-xs" onclick="ingresa_hora('.$reg->deth_id.',6,'.$inf[0].')"><i class="fa fa-pencil-square-o"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="elimina_hora('.$reg->deth_id.',6)"><i class="fa fa-trash"></i></button>';
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