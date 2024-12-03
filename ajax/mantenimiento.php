<?php 
require_once "../modelos/mantenimiento.php";


if (strlen(session_id())<1) 
	session_start();

$mante = new Mantenimiento();

$mant_obj=isset($_POST["mant_obj"])? limpiarCadena($_POST["mant_obj"]):"";
$usu_id=$_SESSION["usu_id"];


switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (!empty($mant_obj)) {
		$rspta=$mante->insertar($mant_obj,$_POST["act_id"],$usu_id,$_POST["mantact_obj"]); 
		echo $rspta? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        echo  "Ingrese un Detalle General" ;
	}
		break;
	

	case 'anular':
		$rspta=$mante->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$mante->mostrar($idventa);
		echo json_encode($rspta);
		break;

	case 'listarDetalle':
		//recibimos el idventa
		$id=$_GET['id'];

		$rspta=$mante->listarDetalle($id);
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

    case 'listar':
	/*	$rspta=$venta->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
                 if ($reg->tipo_comprobante=='Ticket') {
                 	$url='../reportes/exTicket.php?id=';
                 }else{
                    $url='../reportes/exFactura.php?id=';
                 }

			$data[]=array(
            "0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
            '<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
            "1"=>$reg->fecha,
            "2"=>$reg->cliente,
            "3"=>$reg->usuario,
            "4"=>$reg->tipo_comprobante,
            "5"=>$reg->serie_comprobante. '-' .$reg->num_comprobante,
            "6"=>$reg->total_venta,
            "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);*/
		break;

		
		case 'listarActivos':
			require_once "../modelos/ingreso.php";
			$ingreso=new Ingreso();
          //  echo 'fdg='.$usu_id;
			$rspta=$ingreso->listar(4,$usu_id);		
			//$rspta=$ingreso->listar(4,'58');
		    $data=Array();	
			while ($reg=$rspta->fetch_object()) {
				$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->act_id.',\''.$reg->act_detalle.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->act_id,
				"2"=>$reg->act_cyachay,
				"3"=>$reg->act_detalle,			
				"4"=>'<img src="data:image/jpeg;base64,'.base64_encode( $reg->act_foto ).'" width="60" height="60"/>'			  
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