<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['Activos']==1) {
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
  <h1 class="box-title"><button class="btn btn-warning"><i class="fa fa-calendar-check-o"></i> Asistencia por Día </a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 50px;" id="formularioregistros">
  <form action="" name="formulario1" id="formulario1" method="POST">
  
     <div >
     <table width="650" border="0">
  <tr>
    <td><label for="">Ingrese la Fecha (año-mes-dia)</label></td>
    <td><input type="text" id="dia" name="dia"></td>
    <td><button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Visualizar</button></td>

  </tr>
</table>
</div>
  </form>
</div>
<div class="panel-body table-responsive" id="listadoregistros">
   <table class="table table-striped" id="asistencias">
                      <thead class="messages-table-header">
                         <tr>
                           <th><i class="fa fa-angle-double-right"></i> Docente</th>
                           <th><i class="fa fa-angle-double-right"></i> Entrada</th>
                           <th><i class="fa fa-angle-double-right"></i> Salida Almuerzo</th>
                           <th><i class="fa fa-angle-double-right"></i> Entrada Almuerzo</th>
                           <th><i class="fa fa-angle-double-right"></i> Salida</th>      
                           <th><i class="fa fa-angle-double-right"></i> Sede</th>
                           <th><i class="fa fa-angle-double-right"></i> Observaciones</th>                       
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
 
  
</div>

<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>

 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/asistenciaist.js"></script>

 <?php 
}

ob_end_flush();
  ?>