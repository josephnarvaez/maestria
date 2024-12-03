<?php 
session_start();
//incluir la conexion de base de datos
require "../config/Conexion.php";
class crono{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function guardar($op,$docente, $carrera,$gestoria){
	$sql="call sp_gestores($op,$docente, $carrera,$gestoria)";
	$row=ejecutarConsultaSP($sql);	 
	$accion=$row->fetch_row();
	return $accion[0];	
 
}

public function listar($op,$carrera){
	$sql=" CALL horarios_ist17j.sp_gestores($op,0,$carrera,0);";
	return ejecutarConsultaSP($sql);
}
public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}


}
 ?>
