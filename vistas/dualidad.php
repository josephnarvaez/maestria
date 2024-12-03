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
  <h1 class="box-title">Informes Docentes de Dualidad IST 17 de Julio </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 2500px;" id="formularioregistros">
  <form action="" name="formulario1" id="formulario1" method="POST">
  
	  <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="jose">Fecha (año-mes-dia): </label>
       <input type="text"  id="fechar" name="fechar" required>   
	  
    
    </div>
	    <div id="cabecera">
       <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <button id="btntrae" type="button" class="btn btn-primary" onclick="traer_empresas()"></span>Llenar Informe</button>
			<button id="btntrai" type="button" class="btn btn-primary" onclick="imprime_inf()"></span>Imprimir Informe</button>
       
       </div>
	</div>
	<div id="empresas">  
   
    
      
   </div>   
      <div id='botones' class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar1"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
      </div>
    

  </form>    
      </div>
         
<div id="divreporte">
  <embed src="../reportes/rpt_infomes.php" type="application/pdf" id="reporte"  width="100%" height="600px" />
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
 <script src="scripts/dualidad.js"></script>
 <?php 
}

ob_end_flush();
  ?>

