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
  <h1 class="box-title"><button class="btn btn-warning"><i class="fa fa-calendar-check-o"></i> Impresión para Control de Personal </a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 200px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
  
     <div class="form-group col-lg-2 col-md-6 col-xs-6">
      <label for="">Seleccione la hora:</label>
        <select name="hora" id="hora" class="form-control selectpicker" data-live-search="true" required>    
         <option value="7:00 - 8:00">7:00 - 8:00</option>
        <option value="8:00 - 9:00">8:00 - 9:00</option>
        <option value="9:00 - 10:00">9:00 - 10:00</option>
        <option value="10:00 - 11:00">10:00 - 11:00</option>
        <option value="11:00 - 12:00">11:00 - 12:00</option>
        <option value="12:00 - 13:00">12:00 - 13:00</option>
        <option value="13:00 - 14:00">13:00 - 14:00</option>
        <option value="14:00 - 15:00">14:00 - 15:00</option>
        <option value="15:00 - 16:00">15:00 - 16:00</option>
        <option value="16:00 - 17:00">16:00 - 17:00</option>
        <option value="17:00 - 18:00">17:00 - 18:00</option>
        <option value="18:00 - 19:00">18:00 - 19:00</option>
        <option value="19:00 - 20:00">19:00 - 20:00</option>
        <option value="20:00 - 21:00">20:00 - 21:00</option>
        <option value="21:00 - 22:00">21:00 - 22:00</option>  
            </select>
    </div>
      <div class="form-group col-lg-2 col-md-6 col-xs-6">
      <label for="">Ingrese Fecha (año-mes-dia)</label>
       <input type="text" id="dia" name="dia">        
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
 <tr>
							<th colspan="5"> FS: Fuera de Sede   </th>
						  </tr> 
<tr>	
<th ><i class="fa fa-clock-o"></i>Codigo.</th>
<th ><i class="fa fa-clock-o"></i>Docente</th>
<th ><i class="fa fa-clock-o"></i>Hora</th>
<th ><i class="fa fa-clock-o"></i>Sede Instituto</th>
<th ><i class="fa fa-clock-o"></i>Observaciones</th>
</tr>
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
 <script src="scripts/controlpersonal.js"></script>

 <?php 
}

ob_end_flush();
  ?>