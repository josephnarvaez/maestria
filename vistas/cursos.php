<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['Actas']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Impresión de Horario por Niveles</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
  <embed src="../reportes/rpt_horarioniveles.php" type="application/pdf" id="reporte1"  width="100%" height="600px" />
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <?php 
}

ob_end_flush();
  ?>

