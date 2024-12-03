<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Categoria{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$padre){
	$sql="call sp_catalgo('ing','$nombre','$descripcion',$padre)";
		
	return ejecutarConsulta($sql);
}

public function editar($idcategoria,$nombre,$descripcion){
	$sql="UPDATE categoria SET nombre='$nombre',descripcion='$descripcion' 
	WHERE idcategoria='$idcategoria'";
	return ejecutarConsulta($sql);
}
public function desactivar($idcategoria){
	$sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
	return ejecutarConsulta($sql);
}
public function activar($idcategoria){
	$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar(){
	$sql="CALL sp_catalgo('spa','', '',0)";
	return ejecutarConsultaSP($sql);
}

//listar registros
public function listar(){
	$sql="CALL sp_catalgo('list','', '',0)";
	return ejecutarConsultaSP($sql);
}
public function texto_firmas($padre){
	$sql="CALL sp_catalgo('tf','', '',$padre)";
	return ejecutarConsultaSP($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM categoria WHERE condicion=1";
	return ejecutarConsulta($sql);
}
}

 ?>
