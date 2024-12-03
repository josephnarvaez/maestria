<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Actasist{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($ist_id,$ist_fecha,$cat_id_ciudad,$cat_id_t,$custodio,$ist_ref,$activos,$nombres){
	$sql="call sp_ingactaist('$ist_id','$ist_fecha',$cat_id_ciudad,$cat_id_t,$custodio,'$ist_ref')";
	//INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado) VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
	//return ejecutarConsulta($sql);
	 $acta=ejecutarConsultaSP($sql);
	 //$acta='zczzxc';
     if($ist_ref=="0"){
		 $num_elementos=0;
		 $sw=true;
		 while ($num_elementos < count($activos)) {	
			$sql_detalle="call sp_ingactivoactaist(0,'$ist_id',$activos[$num_elementos])";	
			ejecutarConsultaSP($sql_detalle) or $sw=false;
				$num_elementos=$num_elementos+1;
		 }
		 return $sw;
	 }
	 else {
		 $sql_detalle="call sp_ingactivoactaist('$ist_id','$ist_ref',0)";		 
		 return ejecutarConsultaSP($sql_detalle);
	 }
}

public function anular($idventa){
	$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
	return ejecutarConsulta($sql);
}


//implementar un metodopara mostrar los datos de unregistro a modificar
public function mostrar($idventa){
	$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario, v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE idventa='$idventa'";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($actaist){
	$sql="call sp_actasist_detalle('$actaist');";
	return ejecutarConsultaSP($sql);
}



public function siguiente(){
	$sql= "select max(cast(id as SIGNED)) from (select  SUBSTRING(ist_id, 12, 100)  as id  from actas_ist) as pp";
	$row=ejecutarConsulta($sql);
	$sig=$row->fetch_row();
	$idacta=$sig[0]; 
	$idacta=$idacta+1;
	return 'IST17J-UAF-'.$idacta;
}

public function ventadetalles($idventa){
	$sql="SELECT a.nombre AS articulo, a.codigo, d.cantidad, d.precio_venta, d.descuento, (d.cantidad*d.precio_venta-d.descuento) AS subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
         return ejecutarConsulta($sql);
}
public function custodio(){
	$sql="call sp_usuarios(0,0);";
	return ejecutarConsultaSP($sql);
}
public function acta_ist($acta){
	$sql="call sp_actasist('$acta');";
	return ejecutarConsultaSP($sql);
}
public function combo($padre){
	$sql="call sp_catalgo('scpa','','',$padre);";
	return ejecutarConsultaSP($sql);
}
public function listar($op,$data){
	$sql="call sp_activos($op,'$data');";
	return ejecutarConsultaSP($sql);
}
public function listaracta($op,$acta){
	$sql="call sp_activos($op,'$acta');";
	return ejecutarConsultaSP($sql);
}
}

 ?>
