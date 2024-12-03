<?php 
//session_start();
//incluir la conexion de base de datos
require "../config/Conexion.php";
class aulas{

	//implementamos nuestro constructor
public function __construct(){

}

public function  obten_libre ($id,$dia) {
	$sql="CALL sp_libreaula($id,$dia);";
	return  ejecutarConsultaSP($sql);
		
}

public function obten_aulas($id){
	$sql="CALL sp_catalgo('scpa', 0,0,$id);";
	return ejecutarConsultaSP($sql);
}

public function niveles($id){
	$sql="call sp_niveles($id);";
	return ejecutarConsultaSP($sql);
}
public function cursos($carrera,$dia,$nivel,$paralelo){
	$sql="call sp_horarionivel($carrera,$dia,$nivel,'$paralelo');";
	return ejecutarConsultaSP($sql);
}
public function aulas($op,$sede){
	$sql="CALL horarios_ist17j.sp_catalgo('$op','','$sede',2);";
	return ejecutarConsultaSP($sql);
}
public function porcentajes($aula,$dia){
	$sql="call sp_porclibreaula($aula,$dia);";
	return ejecutarConsultaSP($sql);
}
public function obten_control($hora,$dia){
	$sql="call sp_control_personal($hora,$dia);";
	return  ejecutarConsultaSP($sql);

}
}
 ?>
