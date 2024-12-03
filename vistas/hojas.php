<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['Generación']==1) {
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
  
  
     <div >
     <table width="1000" border="0">
  <tr>
    <td ><label for="">Seleccione Docente:</label></td>
    <td colspan="4">  <select name="id_docente" id="id_docente" class="form-control selectpicker" data-live-search="true" required>     </td>
	 </tr>
  <tr>
   
    <td> <button class="btn btn-primary" id="btnhojarptA" onclick="imprimehojadevidaA();"><i class="fa fa-list"></i>  Imprimir hoja de vida</button></td>
  </tr>
		 </table>
    </div>

</div>
     <p>&nbsp;</p>
     <p>&nbsp;</p>

		 

<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>

 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/hojadevida.js"></script>

 <?php 
}

ob_end_flush();
  ?>