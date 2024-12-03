<?php 

//incluir la conexion de base de datos
require "../config/Conexion.php";



class Asistencias{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function obten_vacacionesgeneral($op,$usu){
	$sql="call sp_vacaciones($op,$usu)";
  	return ejecutarConsultaSP($sql);
}
public function obten_detallevacaciones($op,$usu_id){
	$sql="call sp_detallevacaciones($op,$usu_id)";
  	return ejecutarConsultaSP($sql);
}
public function obten_motivos($id){
	$sql="CALL sp_catalgo('scpa', 0,0,$id);";
	return ejecutarConsultaSP($sql);
}
public function ingresa_permiso($op,$usu,$fechaini,$fechafin, $horaini,$horafin,$obj){
   $sql="call sp_inserta_vacaciones($op,$usu,'$fechaini','$fechafin', '$horaini','$horafin','$obj')";
   return ejecutarConsultaSP($sql);
} 
	
}

 ?>
