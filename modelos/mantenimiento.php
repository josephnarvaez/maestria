<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
require '../PHPMailer/PHPMailerAutoload.php';
class Mantenimiento{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($mant_obj,$activos,$usu_id,$obj){
	$sql="call sp_ingmantenimiento('$mant_obj',$usu_id)";
	//INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado) VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
	//return ejecutarConsulta($sql);
	 $mante=ejecutarConsultaSP($sql);
	 $manteid=$mante->fetch_object();
	 $id=$manteid->id;
	 	$mail = new PHPMailer(false);
		$mail->SMTPDebug  = 0;
		$mail->IsSMTP();
		$mail->Mailer = "smtp";
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;                                    // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->Username = 'jlnarvaez@ist17dejulio.edu.ec';                 // SMTP username
		$mail->Password = 'Ame79820!';                           // SMTP password
		
	
		$mail->setFrom('jlnarvaez@ist17dejulio.edu.ec', 'Sistema de Activos');
		$mail->addAddress('josephnarvaez@hotmail.com', 'User');     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Pedido Mantenimiento nro: '.$id;
		$mail->Body    = $mant_obj;
		$mail->AltBody = '';
		$mail->send();
	
		$mail->AddAddress($_SESSION['usu_correo']);
		$mail->Subject = 'Mantenimiento de Activos';
		$mail->Body = 'Código de Mantenimiento: '.$id.' '.utf8_encode($mant_obj);
		$mail->Send();
	 
	 //$acta='zczzxc';
    	 $num_elementos=0;
		 $sw=true;
		 while ($num_elementos < count($activos)) {	
		  	if (empty($obj[$num_elementos]))
			    $sql_detalle="call sp_ingactivomantenimiento($id,$activos[$num_elementos],'S/Obj')";	
			else
			    $sql_detalle="call sp_ingactivomantenimiento($id,$activos[$num_elementos],'$obj[$num_elementos]')";	
			ejecutarConsultaSP($sql_detalle) or $sw=false;
				$num_elementos=$num_elementos+1;
		 }
		 return $sw;
		
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

//listar registros
public function listar(){
	$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario, v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario ORDER BY v.idventa DESC";
	return ejecutarConsulta($sql);
}


public function ventacabecera($idventa){
	$sql= "SELECT v.idventa, v.idcliente, p.nombre AS cliente, p.direccion, p.tipo_documento, p.num_documento, p.email, p.telefono, v.idusuario, u.nombre AS usuario, v.tipo_comprobante, v.serie_comprobante, v.num_comprobante, DATE(v.fecha_hora) AS fecha, v.impuesto, v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
	return ejecutarConsulta($sql);
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

}

 ?>
