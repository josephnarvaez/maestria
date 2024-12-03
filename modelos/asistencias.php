<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Asistencias{


	//implementamos nuestro constructor
public function __construct(){

}

public function obten_asishorario($fecha,$usu,$cri){
	$sql="call sp_picada_horario('$fecha',$usu,$cri)";
  	return ejecutarConsultaSP($sql);
}
//metodo insertar registro

public function obten_asistencias($op,$fecha,$cri){
	$sql="call sp_asistencias($op,'$fecha',$cri)";
  	return ejecutarConsultaSP($sql);
	//return $sql;
}
public function obten_lasempresas(){
	$sql="CALL sp_empresas();";
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

public function obten_control($hora,$dia){
	$sql="call sp_control_personal($hora,$dia);";
	return  ejecutarConsultaSP($sql);

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
	$sql="CALL `sp_firmas`($usu,$periodo)";
  	return ejecutarConsultaSP($sql);
}
public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}
public function dualidad($op,$reg,$fecha,$empresa,$asunto,$horai, $horaf,$coor,$alumnos,$actividades,$debilidades,$foratalezas,$sugerencias){
	$sql="CALL sp_infdualidad($op,$reg,'$fecha','$empresa','$asunto','$horai', '$horaf','$coor','$alumnos','$actividades','$debilidades','$foratalezas','$sugerencias')";
  	return ejecutarConsultaSP($sql);
}
public function historico($op,$fechaini, $fechafin,$usu){
	$sql="CALL historia_faltas($op,'$fechaini','$fechafin',$usu)";
	return ejecutarConsultaSP($sql);
}
}

 ?>
