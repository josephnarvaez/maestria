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
  <h1 class="box-title"><button class="btn btn-warning" ><i class="fa fa-calendar-check-o"></i> ASIGNACION DE RESPONSABLES DE CARRERA</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->


<!--fin centro-->

   <!-- container -->
		  <div class="panel-body" style="height: 200px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-4 col-md-6 col-xs-12">
      <label for="">Docente</label>
       <select name="docente" id="docente" class="form-control selectpicker" data-live-search="true" required>          
       </select>
    </div>
      <div class="form-group col-lg-4 col-md-6 col-xs-12">
      <label for="">Responsable</label>
       <select name="gestoria" id="gestoria" class="form-control selectpicker" data-live-search="true" required>          
       </select>
    </div>
	   <div class="form-group col-lg-12 col-md-6 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

    </div>
  </form>	

</div>
      <div id="divhorario" class="container">
<div class="panel-body table-responsive" id="listadoregistros">
	
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="messages-table-header">
                         <tr>
							 <th><i class="fa fa-angle-double-right"></i>-</th>
							<th><i class="fa fa-angle-double-right"></i> Docente</th>
                           <th><i class="fa fa-angle-double-right"></i> Responsable</th>
                           
                          </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
</div>	

      </div>
    <!-- container -->


      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

<!-- append modal set data -->

<!-- append modal set data -->
  
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/crono.js"></script>

 <?php 
}
if (isset($_SESSION['hor_id'])) {
  echo '<script type="text/javascript">horario('.$_SESSION['usu_id'].',"'.$_SESSION['usu_nombre'].'"); </script>';
}

ob_end_flush();
  ?>
