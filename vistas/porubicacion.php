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
  <h1 class="box-title">Activos por Ubicación</h1>  
</div>
<!--box-header-->
<div class="panel-body"  id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
      <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Ubicación(*):</label>
      <select name="cat_id" id="cat_id" class="form-control selectpicker" data-live-search="true" required>          
      </select>
    </div>
   
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Reporte</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Cod. IST</th>
      <th>Detalle</th>
      <th>Cod. Yachay</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Observación</th>
      <th>Serie</th>
      <th>Factura</th>
      <th>Valor</th>
      <th>Ubicación</th>
       <th>Imagen</th>
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
 <script src="scripts/porubicacion.js"></script>
 <?php 
}

ob_end_flush();
  ?>

