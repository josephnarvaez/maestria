<?php 
require_once "../modelos/actasist.php";
if (strlen(session_id())<1) 
	session_start();

$acta = new Actasist();

$ist_id=isset($_POST["ist_id"])? limpiarCadena($_POST["ist_id"]):"";
$ist_fecha=isset($_POST["ist_fecha"])? limpiarCadena($_POST["ist_fecha"]):"";
$cat_id_ciudad=isset($_POST["cat_id_ciudad"])? limpiarCadena($_POST["cat_id_ciudad"]):"";
$cat_id_t=isset($_POST["cat_id_t"])? limpiarCadena($_POST["cat_id_t"]):"";
$custodio=isset($_POST["custodio"])? limpiarCadena($_POST["custodio"]):"";
$ist_ref=isset($_POST["ist_ref"])? limpiarCadena($_POST["ist_ref"]):"";

$usu_id=$_SESSION["usu_id"];


switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idventa)) {
		$_SESSION['act_ist']=$ist_id;
		if($ist_ref==0){
			$rspta=$acta->insertar($ist_id,$ist_fecha,$cat_id_ciudad,$cat_id_t,$custodio,$ist_ref,$_POST["act_id"],$_POST["act_nombre"]); 
		}
		else
		   $rspta=$acta->insertar($ist_id,$ist_fecha,$cat_id_ciudad,$cat_id_t,$custodio,$ist_ref,'',''); 
		echo $rspta? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$acta->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$acta->mostrar($idventa);
		echo json_encode($rspta);
		break;

	case 'listarDetalle':
		//recibimos el idventa
		$id=$_GET['id'];

		$rspta=$acta->listarDetalle($id);
		echo '<thead style="background-color:#A9D0F5">
        <th></th>
        <th>Activo</th>
        <th>Detalle</th>
       </thead> ';
		while ($reg=$rspta->fetch_object()) {
			echo '<tr class="filas">
			<td></td>
			<td>'.$reg->act_id.'</td>
			<td>'.$reg->act_detalle.'</td></tr>';
			
		}
		break;

		case 'siguiente':
			$rspta = $acta->siguiente(); //4
			echo $rspta;
		break;
		case 'reimpre':
			$_SESSION['act_ist']=$ist_id;
			echo $ist_id;
		break;
		case 'selectCiudad':
			
			$rspta = $acta->combo(4); //4

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
		case 'selectTipo':
			

			$rspta = $acta->combo(5); //5

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
		case 'selectCustodio':			
			$rspta = $acta->custodio(); 
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->usu_id.'>'.$reg->usu_nombre.'</option>';
			}
			break;
		case 'listarActivos':
		

			$rspta=$acta->listar(2,'0');
			$data=Array();	
			while ($reg=$rspta->fetch_object()) {
				$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->act_id.',\''.$reg->act_detalle.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->act_id,
				"2"=>$reg->act_cyachay,
				"3"=>$reg->act_detalle,	
				"4"=>$reg->cat_nombre,			
				"5"=>'<img src="data:image/jpeg;base64,'.base64_encode( $reg->act_foto ).'" width="60" height="60"/>'			  
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