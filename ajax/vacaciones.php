<?php 
require_once "../modelos/vacaciones.php";
$informe = new Asistencias();
//$fech=isset($_POST["dia"])? limpiarCadena($_POST["dia"]):"";


if (strlen(session_id())<1) 
	session_start();

$motivo=isset($_POST["cat_id_motivo"])? limpiarCadena($_POST["cat_id_motivo"]):"";
$ob=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
$des=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


switch ($_GET["op"]) {
	case 'saldostodos':	    	    
		$rspta=$informe->obten_vacacionesgeneral(0,0); //0 entradas
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>'<p align="center"><button id="sacainfo" type="button" class="btn btn-warning btn-xs" onclick="presentadetalle('.$reg->vac_id.')"><i class="fa fa-pencil-square-o"></i></button></p>',
        	"1"=>$reg->usu_nombre,
			"2"=>$reg->vac_fechaing,
			"3"=>$reg->dias_total,
	        "4"=>$reg->Total_permisos,
			"5"=>$reg->saldo
	       );
		}			
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	   
	    echo json_encode($results);
		break;   
	
	case 'saldo':	    	    
		$rspta=$informe->obten_vacacionesgeneral(1,$_SESSION["usu_id"]); //0 entradas
		$fetch=$rspta->fetch_object();
	  	echo "<p>FECHA DE INGRESO AL IST: ".$fetch->vac_fechaing."</p><p> DIAS DE PERMISOS: ".number_format($fetch->Total_permisos, 2, ',', ' ')." DIAS A FAVOR: ".number_format($fetch->saldo, 2, ',', ' ')."</p>";
					
	  
		break;   
			
	 case 'detallesaldos':	    	    
		$rspta=$informe->obten_detallevacaciones(0,$_GET["id"]); //0 entradas
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>$reg->det_fechasolicitud, 
        	"1"=>$reg-> det_fechaini,
			"2"=>$reg->det_fechafin,
			"3"=>$reg->det_horaini,
	        "4"=>$reg->det_horafin,
			"5"=>$reg->dias, 
			"6"=>$reg->det_obj
	       );
		}			
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	   
	    echo json_encode($results);
		break;    
	case 'detallesaldosuni':	    	    
		$rspta=$informe->obten_detallevacaciones(1,$_GET["id"]); //0 entradas
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>'<p align="center"><button id="sacainfo" type="button" class="btn btn-warning btn-xs" onclick="imprimepermiso('.$reg->det_id.')"><i class="fa fa-pencil-square-o"></i></button></p>',
			"1"=>$reg->det_fechasolicitud, 
        	"2"=>$reg->det_fechaini,
			"3"=>$reg->det_fechafin,
			"4"=>$reg->det_horaini,
	        "5"=>$reg->det_horafin,
			"6"=>$reg->dias, 
			"7"=>$reg->det_obj
	       );
		}			
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	   
	    echo json_encode($results);
		break;	
	case 'combo_motivos':
		  	$rspta = $informe->obten_motivos(6);
			while ($reg = $rspta->fetch_object()) {
				echo '<option value="'.$reg->cat_nombre.'">'.$reg->cat_nombre.'</option>';
			}
			break;	
		
	 case 'guardaryeditar':
		     $fechaini=$fechafin=$horaini=$horafin=$obj="";	
           if(isset($_POST['choras'])){
			   $data =explode(" ", $_POST['rhoras']); 
			   $fechaini=$fechafin=$data[0];
			   $horaini=$data[1];
			   $horafin=$data[4];				    
		   }
		   if (isset($_POST['cdias'])){
				$data =explode(" ", $_POST['rfechas']); 
			   $fechaini=$data[0];
			   $fechafin=$data[2];
			   $horaini=$horaini='00:00';			   
		   }
			$obj=$motivo.' / '.$ob.' / '.$des  ;
		    $rspta = $informe->ingresa_permiso(0,$_SESSION["usu_id"],$fechaini,$fechafin, $horaini,$horafin,$obj);	
		    $fetch=$rspta->fetch_object();
	  		echo $fetch->id;
		    break;	
}
 ?>