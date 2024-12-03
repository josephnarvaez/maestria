<?php 
//if (isset($_SESSION["usu_id"]))
//{
require_once "../modelos/hojadevida.php";
$hoja = new hoja();
//$fech=isset($_POST["dia"])? limpiarCadena($_POST["dia"]):"";

if (strlen(session_id())<1) 
	session_start();


switch ($_GET["op"]) {
	case 'guardaryeditardoc': 
		if (!file_exists($_FILES['doc_foto']['tmp_name'])|| !is_uploaded_file($_FILES['doc_foto']['tmp_name'])) {
			$imagen="";
		}
		else{	
			$tam=0;
			if ($_FILES["doc_foto"]["size"]<=81930){
			   $ext=explode(".", $_FILES["doc_foto"]["name"]);
				if ($_FILES['doc_foto']['type']=="image/jpg" || $_FILES['doc_foto']['type']=="image/jpeg" || $_FILES['doc_foto']['type']=="image/png") {
					$imagen=$_POST["doc_cedula"].'.'. end($ext);
		        ///	unlink( "../files/usuarios/".$imagen);//acá le damos la direccion exacta del archivo				
					move_uploaded_file($_FILES["doc_foto"]["tmp_name"], "../files/usuarios/".$imagen);			
				}
			}
			else
				//echo json_encode("Imagen excede el tamaño permitido");
			    $tam=1;
				
	        }
            
		if (empty($_POST["doc_porcen"]))
			$porc=0;
		else
			$porc=$_POST["doc_porcen"];
		$rspta = $hoja->guardareditardoc(0,$_POST["doc_cedula"], $_POST["doc_nombre1"], $_POST["doc_nombre2"], $_POST["doc_apellido1"], $_POST["doc_apellido2"], $_POST["doc_genero"], $_POST["doc_nacionalidad"], $_POST["doc_civil"], $_POST["doc_tsangre"], $_POST["doc_etnia"], $_POST["doc_celular"], $_POST["doc_tcasa"], $_POST["doc_nombrec"],$_POST["doc_celularc"], $_POST["doc_fnace"], $_POST["doc_correo"], $_POST["doc_icorreo"], $_POST["doc_domicilio"], $_POST["doc_discapacidad"], $porc, $_POST["doc_carnet"]);
		echo json_encode($rspta)."*".$tam;
		break;  
	case 'guardaryeditaraca': 		
		$rspta = $hoja->guardareditarinst(0,$_POST["ins_nombre"], $_POST["ins_titulo"], $_POST["ins_registro"], $_POST["ins_fecha"], $_POST["ins_nivel"]);
		echo json_encode($rspta);
		break;  
	case 'guardaryeditarexp': 	
		if (strlen($_POST["exp_ffin"])==0)
			$fechaf='1900-01-01';
		else
			$fechaf=$_POST["exp_ffin"];
		$rspta = $hoja->guardareditarexp(0,$_POST["exp_institucion"], $_POST["exp_cargo"], $_POST["exp_fini"], $fechaf, $_POST["exp_telefono"]);
		echo json_encode($rspta);
		break;
	case 'guardaryeditarcap': 		
		$rspta = $hoja->guardareditarcap(0,$_POST["cap_tema"], $_POST["cap_institucion"], $_POST["cap_fini"], $_POST["cap_ffin"], $_POST["cap_tipo"], $_POST["cap_tipoc"], $_POST["cap_horas"]);
		echo json_encode($rspta);
		break;
	case 'guardaryeditarpub': 
		if (empty($_POST["pub_doi"]))
			$doi="";
		else
			$doi=$_POST["pub_doi"];
		if ($_POST["pub_bdd"]=="0")
			$bdd=0;
		else
			$bdd=$_POST["pub_bdd"];
		
		$rspta = $hoja->guardareditarpub(0,$_POST["pub_tipo"], $_POST["pub_nombre"], $_POST["pub_editorial"], $_POST["pub_fecha"], $_POST["pub_isbn"], $_POST["pub_participa"], $_POST["pub_revisado"],$bdd,$doi);
		echo json_encode($rspta);
		break;
    case 'info':
		$rspta = $hoja->info(1);
		$reg=$rspta->fetch_object();
		echo json_encode($reg);
		break;  
	case 'combo':			
			$rspta = $hoja->combo($_GET["id"]);
			echo '<option value="0">Seleccione</option>';
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
		    
			break;
	case 'listarins':
		$rspta=$hoja->obten_data(0,0);
	   	$data=Array();
		//<button id='sacainfo' type='button' class='btn btn-warning btn-xs' onclick='editains(".$reg->ins_id.",0);'><i class='fa fa-edit'></i></button>
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>"<p align='center'><button id='sacainfo' type='button' class='btn btn-danger btn-xs' onclick='elimina(".$reg->ins_id.",0)'><i class='fa fa fa-trash'></i></button>
			</p>",
			"1"=>$reg->ins_institucion,
			"2"=>$reg->ins_titulo,
			"3"=>$reg->ins_registro,
			"4"=>$reg->ins_fecha,
			"5"=>$reg->ins_nivel				
	       );
   		
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
	case 'listarexp':
		$rspta=$hoja->obten_data(0,1);
	   	$data=Array();
		//<button id='sacainfo' type='button' class='btn btn-warning btn-xs' onclick='editains(".$reg->exp_id.",1);'><i class='fa fa-edit'></i></button>
		while ($reg=$rspta->fetch_object()) {
			if ($reg->exp_fechah=='1900-01-01')
				$ff="EN FUNCIONES";
			else
				$ff=$reg->exp_fechah;
		   	$data[]=array(
        	"0"=>"<p align='center'><button id='sacainfo' type='button' class='btn btn-danger btn-xs' onclick='elimina(".$reg->exp_id.",1)'><i class='fa fa fa-trash'></i></button>
			
			</p>",
			"1"=>$reg->exp_institucion,
			"2"=>$reg->exp_cargo,
			"3"=>$reg->exp_fechad,
			"4"=>$ff,
			"5"=>$reg->exp_telefono				
	       );
   		
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
	case 'listarcap':
		$rspta=$hoja->obten_data(0,2);
	   	$data=Array();
		//<button id='sacainfo' type='button' class='btn btn-warning btn-xs' onclick='editains(".$reg->exp_id.",1);'><i class='fa fa-edit'></i></button>
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>"<p align='center'><button id='sacainfo' type='button' class='btn btn-danger btn-xs' onclick='elimina(".$reg->cap_id.",2)'><i class='fa fa fa-trash'></i></button>			
			</p>",
			"1"=>$reg->cat_id_t,
			"2"=>$reg->cap_tema,
			"3"=>$reg->cap_institucion,
			"4"=>$reg->cat_id_tc,
			"5"=>$reg->cap_fechad,
			"6"=>$reg->cap_fechah,
			"7"=>$reg->cap_hora				
	       );
   		
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;		
	case 'listarpub':
		$rspta=$hoja->obten_data(0,3);
	   	$data=Array();
		//<button id='sacainfo' type='button' class='btn btn-warning btn-xs' onclick='editains(".$reg->exp_id.",1);'><i class='fa fa-edit'></i></button>
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>"<p align='center'><button id='sacainfo' type='button' class='btn btn-danger btn-xs' onclick='elimina(".$reg->pub_id.",3)'><i class='fa fa fa-trash'></i></button>			
			</p>",
			"1"=>$reg->pub_tipo,
			"2"=>$reg->pub_nombre,
			"3"=>$reg->pub_fecha,
			"4"=>$reg->pub_editorial,
			"5"=>$reg->pub_isbn,
			"6"=>$reg->pub_participa,
			"7"=>$reg->pub_revisado,
			"8"=>$reg->cat_id_b,
			"9"=>$reg->pub_doi
	       );
   		
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;		
	case 'eliminar':
		if ($_GET["inf"]==0){
			$rspta = $hoja->elimina(0,$_GET["id"]);
			echo json_encode($rspta);
		}
		if ($_GET["inf"]==1){
			$rspta = $hoja->elimina(1,$_GET["id"]);
			echo json_encode($rspta);
		}
		if ($_GET["inf"]==2){
			$rspta = $hoja->elimina(2,$_GET["id"]);
			echo json_encode($rspta);
		}
		if ($_GET["inf"]==3){
			$rspta = $hoja->elimina(3,$_GET["id"]);
			echo json_encode($rspta);
		}
		//echo json_encode($results);
		break;
 // }
}
 ?>