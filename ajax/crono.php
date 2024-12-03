<?php 
require_once "../modelos/crono.php";

$crono=new crono();

switch ($_GET["op"]) {
	case 'guardaryeditar':
	   	$rspta=$crono->guardar(1,$_POST['docente'], $_SESSION['coor'],$_POST['gestoria']);
		echo $rspta;		
 	break;
	case 'listar':
		$rspta=$crono->listar(2,$_SESSION['coor']);
		$data=Array();
		while ($reg=$rspta->fetch_object()) {			
			$data[]=array(
            "0"=>' ',
	        "1"=>$reg->docente,
            "2"=>$reg->cat_nombre,
            );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
		case 'combo_gestores':			
			$rspta = $crono->combo(7);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
	

	
}
 ?>