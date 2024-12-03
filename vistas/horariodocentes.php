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
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
     
<div class="box-header with-border">
  <h1 class="box-title">Horarios Docentes IST 17 de Julio </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 2500px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
   
    <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Periodo Académico:</label>       
       <select name="periodo" id="periodo" class="form-control selectpicker" data-live-search="true" required>              
      </select>   
    </div>
       <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <button id="btninformes" type="button" class="btn btn-primary" onclick="traer_informes()"></span>Traer Horarios</button>
       
       </div>
</form>    
		  <div id="divreporte"  name="divreporte" hidden="true">
 
</div>
      </div>
         

 
 
<!--fin centro-->

      <!-- /.box -->

 
<div>

</div>

<?php 

}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/horariodocentes.js"></script>
 <?php 
}

ob_end_flush();
  ?>

