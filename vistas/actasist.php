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
      <label for="">Código Acta(*):</label>   
       <input class="form-control" type="text" name="ist_id" id="ist_id"  required>       
    </div>
      <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Fecha(*): </label>
      <input class="form-control" type="text" name="ist_fecha" id="ist_fecha" placeholder="5 días del mes de octubre de 2020"  required>  
      </div>
     <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Ciudad(*): </label>
       <select name="cat_id_ciudad" id="cat_id_ciudad" class="form-control selectpicker" data-live-search="true" required>        
      </select>
    </div>
      <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Tipo(*): </label>
       <select name="cat_id_t" id="cat_id_t" class="form-control selectpicker" data-live-search="true" required>        
      </select>
    </div>
   <div class="form-group col-lg-3 col-md-3 col-xs-12">
      <label for="">Custodio(*): </label>
       <select name="custodio" id="custodio" class="form-control selectpicker" data-live-search="true" required>        
      </select>
    </div>
      <div class="form-group col-lg-1 col-md-1 col-xs-12">
      <label for="">Referencia: </label>
      <input class="form-control" type="text" name="ist_ref" id="ist_ref" value="0" placeholder="Si enlaza con otra acta"  onblur="verificaacta()" >  
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
     <embed src="../reportes/rpt_actasist.php" type="application/pdf" id="reporte"  width="100%" height="600px" />
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<div>

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
               <th>Ubicación</th>
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
 <script src="scripts/actasist.js"></script>
 <?php 
}

ob_end_flush();
  ?>

