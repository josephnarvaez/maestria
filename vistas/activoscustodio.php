<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['Custodios']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Activos a Cargo del Custodio</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" width="100%">
    <thead>
      <th>Código IST</th>
      <th>Activo</th>
      <th>Nro. Acta</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Ubicación</th>
    </thead>
    <tbody>
    </tbody>
   
  </table>
</div>

<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/activoscustodio.js"></script>
 <?php 
}

ob_end_flush();
  ?>

