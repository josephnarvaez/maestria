<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['Actas']==1 or $_SESSION['Activos']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"><button class="btn btn-warning"><i class="fa fa-calendar-check-o"></i> Disposición de Aulas</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 200px;" id="formularioregistros">
	<input type="hidden" id="periau" name="periau">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Seleccione el Aula:</label>
        <select name="aula" id="aula" class="form-control selectpicker" data-live-search="true" required>          
            </select>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Visualizar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
        <div id="divhorario" class="container">
<table id="tblhorario" class="table table-bordered">
<thead class="thead">
<th ><i class="fa fa-clock-o"></i> -</th>
<th ><i class="fa fa-clock-o"></i> Lunes</th>
<th ><i class="fa fa-clock-o"></i> Martes</th>
<th ><i class="fa fa-clock-o"></i> Miercoles</th>
<th ><i class="fa fa-clock-o"></i> Jueves</th>
<th ><i class="fa fa-clock-o"></i> Viernes</th>
<th ><i class="fa fa-clock-o"></i> Sabado</th>

</thead>
<tbody>
</tbody></table>

      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<!-- modal nuevo horario -->
<div class="modal fade animated bounceInLeft" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cancel-new" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Nuevo Horario</h4>
      </div>
      <div class="modal-body">
        
         <form id="horariofrm">
            <label>Período Académico:</label>
            <select name="periodo" id="periodo" class="form-control selectpicker" data-live-search="true" required>          
            </select>
            <label>Docente	:</label>
            <select name="docente" id="docente" class="form-control selectpicker" data-live-search="true" required>          
            </select>          
         </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="create-horario btn btn-success"><i class="fa fa-calendar-check-o"></i> Crear</button>
        <button type="button" class="cancel-new btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- modal nuevo horario -->
  
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/aulas.js"></script>

 <?php 
}
ob_end_flush();
  ?>