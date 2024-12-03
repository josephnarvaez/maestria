<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class giras{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function guardar($op,$carrera,$usu,$nest,$fechas,$horas,$fechar,$horar,$ropa,$alimentacion,$transporte,$materiales, $objetivos , $inerario, $docentes,$tipo ){
	$sql="call sp_gira($op,$carrera,$usu,$nest,'$fechas','$horas','$fechar','$horar','$ropa','$alimentacion','$transporte','$materiales','$objetivos','$inerario','$tipo')";
    $row=ejecutarConsultaSP($sql);
	$id=$row->fetch_row();
	$num_elementos=0;
	 while ($num_elementos < count($docentes)) {
	     $sql_detalle="CALL sp_doc_gira(0,$id[0],$docentes[$num_elementos])";
		$row1=ejecutarConsultaSP($sql_detalle);
	    $num_elementos=$num_elementos+1;
	 }
  return $id[0];
}

//metodo para mostrar registro $_SESSION['coor']
public function docentescarrera($carrera){
	$sql="call sp_docentes_carrera($carrera);";
    return ejecutarConsultaSP($sql);
}
public function reportegiras($id){
	$sql="call sp_gira(1,$id,0,0,'2024-07-01',0,'2024-07-01',0,'','','','','','','')";
    return ejecutarConsultaSP($sql);
}
public function reportedocgiras($id){
	$sql="call sp_gira(2,$id,0,0,'2024-07-01',0,'2024-07-01',0,'','','','','','','')";
    return ejecutarConsultaSP($sql);
}
}

 ?>
