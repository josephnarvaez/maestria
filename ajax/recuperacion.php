<?php 
require_once "../modelos/recuperacion.php";
if (strlen(session_id())<1) 
	session_start();

$informe = new Recuperacion();
$usu_id=$_SESSION["usu_id"];


switch ($_GET["op"]) {
	case 'guardaryeditar':
	    $rspta=$informe->insertar_rec(0,$_POST["fechap"],$_POST["fechar"],$_POST["tema"],$_POST["materias"],$_POST["rhoras"],$_POST["modalidad"],$_POST["acuerdo"],$_SESSION['usu_id'],$_POST["obj"]);	
		 
    	$reg=$rspta->fetch_object(); 
		$_SESSION["inf"]=$reg->id;
     	echo $reg->id;	
		break;  	
	

	case 'imforme':
		$rspta=$informe->insertar_rec(1,"2024-01-01","2024-01-01","","",0,"","",$_SESSION['usu_id'],"");
     	$data=Array();		
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>$reg->rec_fechaa,
			"1"=>$reg->rec_fechar,
			"2"=>$reg->rec_tema,
	        "3"=>$reg->rec_modalidad,
	        "4"=>explode("--", $reg->rec_asignatura)[2]."--".explode("--", $reg->rec_asignatura)[3],
	        "5"=>$reg->rec_horas,
			"6"=>$reg->rec_acuerdo
	       );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	
    	echo json_encode($results);
		break;
	case 'obtenmaterias':
		
		$rspta=$informe->obten_materias_inf(-1,$_SESSION['usu_id'],0);			
		while ($reg = $rspta->fetch_object()) {
				echo '<option value="'.$reg->cat_id."--".$reg->carrera."--".$reg->cat_nombre."--".$reg->paralelo.'">'.$reg->carrera." - ".$reg->cat_nombre." - ".$reg->paralelo.'</option>';
			}

		break;
	case 'informes':
		$rspta=$informe->obten_informes(1,$_SESSION['usu_id'],$_GET['periodo']);
		$_SESSION["peri"]=$_GET['periodo'];
	   	$data=Array();
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>"<p align='center'><button id='sacainfo' type='button' class='btn btn-primary btn-xs' onclick='presentainforme(".$reg->inf_id.",".$reg->cat_id.")'><i class='fa fa-pencil-square-o'></i></button>
			<button id='sacainfo' type='button' class='btn btn-success btn-xs' onclick=imeinforme(".$reg->inf_id.");'><i class='fa fa-list'></i></button>
			<button id='sacainfo1' type='button' class='btn btn-warning btn-xs' onclick='imprimeinforme1(".$reg->inf_id.");'><i class='fa fa-road'></i></button>
			</p>",
			"1"=>$reg->inf_mes,
			"2"=>$reg->inf_carreras,
			"3"=>$reg->cat_nombre
	       );
   		$_SESSION['periodotexto']=$reg->cat_nombre;
		

		}
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

	
}
 ?>