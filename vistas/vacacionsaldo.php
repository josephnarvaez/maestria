<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['Generación']==1 or $_SESSION['TEMP']==1) {
 ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">	
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"><button class="btn btn-warning"><i class="fa fa-calendar-check-o"></i> Reporte de Saldos de vacaciones del Personal</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body table-responsive" id="listadoregistros">
   <table class="table table-striped" id="permisos">
                      <thead class="messages-table-header">
                         <tr>
							 <th><i class="fa fa-angle-double-right"></i>-</th>
                           <th><i class="fa fa-angle-double-right"></i> Docente</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha Ingreso al IST</th>
                           <th><i class="fa fa-angle-double-right"></i> Total Días a la Fecha</th>
                           <th><i class="fa fa-angle-double-right"></i> Total Días en Permiso</th>
                           <th><i class="fa fa-angle-double-right"></i> Saldo de Días</th>   
                          </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
 
  
</div>
<div class="modal fade" id="DataEdit" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel" >
  <div  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i> Detalle de Permisos</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped"  width="100%" id="detallepermisos">
                      <thead class="messages-table-header">
                         <tr>
							<th><i class="fa fa-angle-double-right"></i> Fecha Solicitud</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha Inicio</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha Fin</th>
                           <th><i class="fa fa-angle-double-right"></i> Hora Inicio</th>
                           <th><i class="fa fa-angle-double-right"></i> Hora Fin</th>
                           <th><i class="fa fa-angle-double-right"></i> Total </th>   
				<th><i class="fa fa-angle-double-right"></i> Observación </th>   
                          </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
       
    </div>
  </div>
</div>
	</div>

<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>

 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/vacacionsaldo.js"></script>

 <?php 
}

ob_end_flush();
  ?>