<?php 
require_once "../modelos/Consultas.php";
require_once "../modelos/Ingreso.php";
if (strlen(session_id())<1) 
	session_start();
	
$consulta = new Consultas();

switch ($_GET["op"]) {
	
   case 'activoscustodio':
	    
		$ingreso = new Ingreso();
        $rspta=$ingreso->listar(5,$_SESSION["usu_id"]);
        $data=Array();

        while ($reg=$rspta->fetch_object()) {
            $data[]=array(
            "0"=>$reg->act_id,
            "1"=>$reg->act_detalle,
            "2"=>$reg->ist_id,
            "3"=>$reg->marca,
            "4"=>$reg->modelo,
            "5"=>$reg->ubicacion
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