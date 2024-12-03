<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Ingreso{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($op,$acta_id,$acta_item,$act_id,$act_detalle,$act_cyachay,$act_id_marca,$act_id_modelo,$act_observacion,$act_serie,$act_factura,$act_valor,$cat_id,$act_foto,$act_fist17j,$act_fyachay){
	
	$sql="call sp_ingactivo($op,$acta_id,$acta_item,$act_id,'$act_detalle',$act_cyachay,$act_id_marca,$act_id_modelo,'$act_observacion','$act_serie','$act_factura',$act_valor,$cat_id,'$act_foto','$act_fist17j','$act_fyachay')";
	//INSERT INTO ingreso (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado) VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_compra','Aceptado')";
	 
	return ejecutarConsultaSP($sql);
	
}
public function insertarmate($materia,$paralelo,$opcion,$idh,$dia,$doc){
//        if($opcion=839)
	$data=$materia.'/-/'.$opcion;
	$sql="call sp_ingmateria(1,'$data',$idh,$dia,$doc)";
	$row=ejecutarConsultaSP($sql);	 
	return 'Datos registrados correctamente';

}
public function presentar_horario($op,$horario){
	$sql="call sp_obten_horario($op,$horario);";
	return ejecutarConsultaSP($sql);
}
public function presentar_info($materia,$aula){
	$sql="call sp_infodiahora($materia,$aula)";
	return ejecutarConsultaSP($sql);
}
public function obten_materias($id){
	$sql="CALL sp_materias_horario($id);";
	return ejecutarConsultaSP($sql);
}
public function obten_opciones($id){
	$sql="CALL sp_catalgo('scpa', 0,0,$id);";
	return ejecutarConsultaSP($sql);
}
public function encabezado($op,$id){
	$sql="CALL sp_horas_diarias($op,$id);";
	return ejecutarConsultaSP($sql);
}
public function listar($op,$data){
	$sql="call activos_ist17j.sp_activos($op,'$data');";
	return ejecutarConsultaSP($sql);
}
public function cursos($carrera,$dia,$nivel){
	$sql="call sp_horarionivel($carrera,$dia,$nivel);";
	return ejecutarConsultaSP($sql);
}
public function obten_id($horario){
	$sql="call sp_usuarios(2,$horario)";
	$row=ejecutarConsultaSP($sql);
	/*$nombre=$row->fetch_row();
	$_SESSION['docente']=$nombre[0];
	$_SESSION["docenteh"]=$nombre[1];	*/
	return true;
}
public function horariosTotales($periodos){
	$sql="call sp_horariosdocentes($periodos);";
	return ejecutarConsultaSP($sql);
}
}

 ?>
