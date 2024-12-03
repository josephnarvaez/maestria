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
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Actas Entrega Recepción IST 17 de Julio </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Fecha</th>
      <th>Cliente</th>
      <th>Usuario</th>
      <th>Documento</th>
      <th>Número</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
  
  </table>
</div>
<div class="panel-body" style="height: 800px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    
      <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Nro. Acta(*): </label>
      <input class="form-control" type="text" name="ist_id" id="ist_id" value="IST17J-UAF-" placeholder="IST17J-UAF-"   >  
    </div>
    

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Ver Reporte</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
    <embed src="../reportes/rpt_horarioindi.php" type="application/pdf" id="reporte"  width="100%" height="600px" />
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  
  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/reactasist.js"></script>
 <?php 
}

ob_end_flush();
  ?>

