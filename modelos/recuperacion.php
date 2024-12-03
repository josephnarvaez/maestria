<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Recuperacion{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar_rec($op,$fechaa,$fechar,$tema,$asig,$horas,$modalidad,$acuerdo,$usu,$obj){
	$sql="call sp_recuperacion($op,'$fechaa','$fechar','$tema','$asig',$horas,'$modalidad','$acuerdo',$usu,'$obj')";
  	return ejecutarConsultaSP($sql);
}
public function insertar_act($op,$inf, $materia,$paralelo,$horas,$medio,$por,$obj){
	$sql="CALL sp_infactividades($op, $inf,$materia,'$paralelo',$horas, '$medio', '$por', '$obj');";
  	return ejecutarConsultaSP($sql);
}
public function insertar_oact($op,$inf,$item,$horas,$medio,$obj){
	$sql="CALL sp_infotraactividades($op, $inf,$item,$horas,'$medio', '$obj');";
  	return ejecutarConsultaSP($sql);
}
public function insertar_ract($op,$inf,$tipo,$carrera,$proyecto,$horas,$obj){
	$sql="CALL `sp_infresto`($op,$inf,$tipo,'$carrera', '$proyecto',$horas,'$obj')";
  	return ejecutarConsultaSP($sql);
}


public function obten_materias($usu,$periodo){
	$sql="call sp_materias_horario($usu,$periodo);";
    return ejecutarConsultaSP($sql);
}
public function obten_materias_inf($info,$usu,$periodo){
	$sql="call sp_materias_inf($info,$usu,$periodo);";
    return ejecutarConsultaSP($sql);
}

public function obten_informes($op,$usu,$periodo){
	$sql="call sp_informemes($op,$usu,'','',$periodo,'','');";
	$g=ejecutarConsultaSP($sql);
	$row = $g->fetch_row();
	$_SESSION['mes']=$row[2];
    return ejecutarConsultaSP($sql);
}
public function obten_oact($op,$inf){
	$sql="CALL sp_infotraactividades($op, $inf,0,0,'', '');";
  	return ejecutarConsultaSP($sql);
}
public function obt_ract($op,$inf,$tipo){
	$sql="CALL `sp_infresto`($op,$inf,$tipo,'', '',0,'')";
  	return ejecutarConsultaSP($sql);
}
public function obt_firmas($usu,$periodo){
	$sql="CALL sp_firmas($usu,$periodo)";
  	return ejecutarConsultaSP($sql);
}
public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}
public function obten_dual_inf($fecha,$usu){
	$sql="CALL sp_infdualidad(1,$usu,'$fecha','','','', '','','','','','','')";
  	return ejecutarConsultaSP($sql);
}
public function obt_firmasr($materias){
	$sql="CALL sp_firmasr('$materias')";
  	return ejecutarConsultaSP($sql);
}
}

 ?>
