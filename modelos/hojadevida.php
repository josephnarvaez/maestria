<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class hoja{


	//implementamos nuestro constructor
public function __construct(){

}

public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}
public function guardareditardoc($op,$doc_cedula, $doc_nombre1, $doc_nombre2, $doc_apellido1, $doc_apellido2, $doc_genero, $doc_nacionalidad, $doc_civil, $doc_tsangre, $doc_etnia, $doc_celular, $doc_tcasa, $doc_nombrec,$doc_celularc, $doc_fnace, $doc_correo, $doc_icorreo, $doc_domicilio, $doc_discapacidad, $doc_porcen, $doc_carnet){
	$usu=$_SESSION["usu_id"];
	$sql="call sp_docentes($op,'$doc_cedula',$usu,'$doc_nombre1', '$doc_nombre2','$doc_apellido1', '$doc_apellido2', $doc_genero, '$doc_nacionalidad', '$doc_civil', $doc_tsangre, $doc_etnia, '$doc_celular','$doc_tcasa','$doc_nombrec' ,'$doc_celularc', '$doc_fnace', '$doc_correo', '$doc_icorreo', '$doc_domicilio',  $doc_discapacidad, $doc_porcen, '$doc_carnet');";
//	echo $sql;
	return ejecutarConsultaSP($sql);
}
public function guardareditarinst($op,$ins_nombre, $ins_titulo, $ins_registro, $ins_fecha, $ins_nivel){
	$usu=$_SESSION["usu_id"];
	$sql="call sp_instruccion($op,$usu,'$ins_nombre', '$ins_titulo', '$ins_registro', '$ins_fecha', '$ins_nivel');";
	return ejecutarConsultaSP($sql);
}
public function guardareditarexp($op,$exp_nombre, $exp_cargo, $exp_fechad, $exp_fechah, $exp_telefono){
	$usu=$_SESSION["usu_id"];
	$sql="call sp_experiencia($op,$usu,'$exp_nombre', '$exp_cargo', '$exp_fechad', '$exp_fechah', '$exp_telefono');";
	return ejecutarConsultaSP($sql);
}
public function guardareditarcap($op,$cap_tema, $cap_institucion, $cap_fini, $cap_ffin, $cap_tipo, $cap_tipoc, $cap_horas){
	$usu=$_SESSION["usu_id"];
	$sql="call sp_capacitacion($op,$usu,'$cap_tema', '$cap_institucion', '$cap_fini', '$cap_ffin', $cap_tipo, $cap_tipoc, $cap_horas);";
	return ejecutarConsultaSP($sql);
}
public function guardareditarpub($op,$pub_tipo, $pub_nombre, $pub_editorial, $pub_fecha, $pub_isbn, $pub_participa, $pub_revisado,$bdd,$doi){
	$usu=$_SESSION["usu_id"];
	$sql="call sp_publicaciones($op,$usu,'$pub_tipo', '$pub_nombre', '$pub_editorial','$pub_fecha', '$pub_isbn', '$pub_participa', '$pub_revisado','$bdd','$doi');";
	return ejecutarConsultaSP($sql);
}
public function obten_data($op,$d){
	if ($op==0)
	  $usu=$_SESSION["usu_id"];		
	else
	  $usu=$_SESSION["usuA"]; 
	if ($d==0){
		$sql="call sp_instruccion(1,$usu,'', '', '', '2023-07-03', '');";
		return ejecutarConsultaSP($sql);	
	}
	if ($d==1){
		$sql="call sp_experiencia(1,$usu,'', '', '2023-07-03', '2023-07-03', '');";
		return ejecutarConsultaSP($sql);
	}
	if ($d==2){
		$sql="call sp_capacitacion(1,$usu ,'','', '2023-07-03', '2023-07-03',0,0, 0);";
		return ejecutarConsultaSP($sql);
	}
	if ($d==3){
		$sql="call sp_publicaciones(1,$usu,'', '', '','2023-07-04', '', '', '',0,'');";
	    return ejecutarConsultaSP($sql);
	}
}	
public function info($op){	
	if ($op==1){
		$usu=$_SESSION['usu_id'];
		$sql="call sp_docentes(1,'',$usu,'', '','', '', 0, '', '', 0, 0, '','','', '', '2023-06-26', '', '', '',  0,0, '');";
	    return ejecutarConsultaSP($sql);	
	}
	if ($op==2){
		$usu=$_SESSION['usu_id'];
		$sql="call sp_docentes(2,'',$usu,'', '','', '', 0, '', '', 0, 0, '','','', '', '2023-06-26', '', '', '',  0,0, '');";
	    return ejecutarConsultaSP($sql);	
	}
	if ($op==3){
		$usu=$_SESSION["usuA"];
		$sql="call sp_docentes(2,'',$usu,'', '','', '', 0, '', '', 0, 0, '','','', '', '2023-06-26', '', '', '',  0,0, '');";
	    return ejecutarConsultaSP($sql);	
	}
}
function elimina($op, $id){
		
	if ($op==0){ //instruccion
		$sql="call sp_instruccion(2,$id,'', '', '', '2023-07-03', '');";
		return ejecutarConsultaSP($sql);
	}
	if ($op==1){ //experiencia
		$sql="call sp_experiencia(2,$id,'', '', '2023-07-03', '2023-07-03', '');";
		return ejecutarConsultaSP($sql);
	}
	if ($op==2){ //experiencia
		$sql="call sp_capacitacion(2,$id, '','', '2023-07-03', '2023-07-03',0,0, 0);";
		return ejecutarConsultaSP($sql);
	}
	if ($op==3){ //experiencia
		$sql="call sp_publicaciones(2,$id,'', '', '','2023-07-04', '', '', '',0,'');";
		return ejecutarConsultaSP($sql);
	}
}
}
 ?>
