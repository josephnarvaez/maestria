<?php 
require_once "../modelos/telefonos.php";
$informe = new Telefonos();
//$fech=isset($_POST["dia"])? limpiarCadena($_POST["dia"]):"";


switch ($_GET["op"]) {
	case 'telefonos':
		$date1 = new DateTime($_GET["diai"]);
        $date2 = new DateTime($_GET["diaf"]);
		$data=Array();
		$j=0;
		$rspta=$informe->telefonos($date1->format('Y-m-d H:i:s'),$date2->format('Y-m-d H:i:s')); //0 entradas
		while ($reg=$rspta->fetch_object()) {
			$data[$j]=array(             
		    "0"=>$reg->usu_id, 
	        "1"=>$reg->usu_nombre,
            "2"=>$reg->nro
            );
			$j++;
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