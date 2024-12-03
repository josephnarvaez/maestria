<?php 
session_start();
//incluir la conexion de base de datos
require "../config/Conexion.php";
class coordinadores{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($periodo,$docente){
	$sql="call sp_horario(0,$periodo,$docente)";
	$row=ejecutarConsultaSP($sql);	 
	$horario=$row->fetch_row();
	$_SESSION['hor_id']=$horario[0];
	$sql="call sp_usuarios(1,$docente)";
	$row=ejecutarConsultaSP($sql);
	$nombre=$row->fetch_row();
	$_SESSION['docente']=$nombre[1];
	return $horario[0].'*'.$nombre[1];	
 
}
public function insertarmate($materia,$paralelo,$aula,$idh,$dia,$doc){
	$data=$materia.'/'.$paralelo.'/'.$aula;
	$sql="call sp_ingmateria(0,'$data',$idh,$dia,$doc)";
	$row=ejecutarConsultaSP($sql);	 
	$resp=$row->fetch_row();
	if ($resp[0]==0)
	    return 'Ya existe la materia asignada al docente: '.$resp[1].' --'.$data.'*'.$aula.'*'.$idh;
	else {	
		if ($resp[0]==1)
	    	return 'Ya existe en esa hora el Aula ocupada docente:'.$resp[1].' / '.$resp[2].' --'.$data.'*'.$aula.'*'.$idh	;
	    else
			return 'Datos registrados correctamente';
	}
}
public function eliminarm($idh,$dia){
	$sql="call sp_elimateria($idh,$dia)";
	return ejecutarConsultaSP($sql);
}

public function eliminar($horario){
	$sql="call sp_elimina_horario($horario);";
	return ejecutarConsultaSP($sql);
}

public function mostrar($idarticulo){
	$sql="call sp_obten_horario($horario);";
	return ejecutarConsultaSP($sql);
}
public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}

public function obten_usuarios($op,$id){
	$sql="call sp_usuarios($op,$id);";
	return ejecutarConsultaSP($sql);
}
public function obten_materias($id){
	$sql="CALL sp_catalgo('scpa', 0,0,$id);";
	return ejecutarConsultaSP($sql);
}
public function obten_aulas($id){
	$sql="CALL sp_catalgo('scpa', 0,0,$id);";
	return ejecutarConsultaSP($sql);
}

public function listar($op,$docente){
	$sql="call sp_lista_horarios($op,$docente);";
	return ejecutarConsultaSP($sql);
}

public function presentar_horario($op,$horario){
	$sql="call sp_usuarios(2,$horario)";
	$row=ejecutarConsultaSP($sql);
	$nombre=$row->fetch_row();
	$_SESSION['docente']=$nombre[0];
	$_SESSION["docenteh"]=$nombre[1];
	
	$sql="call sp_obten_horario($op,$horario);";
	return ejecutarConsultaSP($sql);
}
public function presentar_info($materia,$aula){
	$sql="call sp_infodiahora($materia,$aula)";
	return ejecutarConsultaSP($sql);
}
public function	nomdocente($op,$docente){
	$sql="call sp_usuarios($op,$docente)";
	return ejecutarConsultaSP($sql);
}
}
 ?>
