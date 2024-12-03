<?php 
session_start();
require_once "../modelos/giras.php";

$gira=new giras();


switch ($_GET["op"]) {
	case 'guardar':
	 $rspta=$gira->guardar(0,$_SESSION['coor'],$_SESSION['usu_id'],$_POST["gir_nro"],$_POST["gir_fechas"],$_POST["gir_hora"],$_POST["gir_fechar"],$_POST["gir_horar"],$_POST["gir_ropa"],$_POST["gir_ali"],$_POST["gir_transporte"],$_POST["gir_materiales"],$_POST["gir_obj"],$_POST["gir_cumplir"],$_POST["docentes"],$_POST["gir_tipo"]);  
       
	 // $id=$rspta->fetch_row();
	 // echo $id[0];	
	break;
	
	case 'listar':

	break;

	case 'docentes':
				//obtenemos toodos los permisos de la tabla permisos $_SESSION['coor']
        $rspta=$gira->docentescarrera($_SESSION['coor']);
		//echo $rspta;
		while ($reg=$rspta->fetch_object()) {
				echo '<li><input type="checkbox" name="docentes[]" value="'.$reg->usu_id.'">'.$reg->usu_nombre.'</li>';
		      }
	break;

	
	
}
?>