<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Telefonos{


	//implementamos nuestro constructor
public function __construct(){

}
public function telefonos($fecha1,$fecha2){
	$sql="call sp_telefonos('$fecha1','$fecha2')";
  	return ejecutarConsultaSP($sql);
}

}

 ?>
