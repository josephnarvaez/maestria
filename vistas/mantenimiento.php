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
  <h1 class="box-title">Pedido de mantenimiento de Activos</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 800px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Detalle el mantenimineto general(*):</label>   
     <textarea  cols="200" rows="5"     name="mant_obj" 
       id="mant_obj" ></textarea> 
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
       <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <a data-toggle="modal" href="#myModal">
       <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Agregar Activos</button>
     </a>
    </div> 
<div class="form-group col-lg-12 col-md-12 col-xs-12">
     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" width="100">
       <thead style="background-color:#A9D0F5">
        <th></th>
        <th>Activo</th>
        <th>Detalle</th>
         <th>Observación</th>
       </thead>       
       <tbody>
         
       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <!--Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Activo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th></th>
              <th>Código IST</th>
               <th>Código </th>
              <th>Nombre</th>
              <th>Foto</th>
              </thead>
            <tbody>              
            </tbody>           
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/mantenimiento.js"></script>
 <?php 
}

ob_end_flush();
  ?>

