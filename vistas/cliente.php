<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{
echo '<input type="hidden" name="id" id="id" value="'.$_SESSION['usu_id'].'"/>';
require 'header.php';
if ($_SESSION['Activos']==1 or $_SESSION['Actas']==1) {
	
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
   <h1 class="box-title"><button class="btn btn-warning" ><i class="fa fa-calendar-check-o"></i> Permisos Docentes</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<script>
    function dias_horas(op)
	  {
		 
		  if (op==2){
			 document.getElementById("cdias").checked=false;  
		     document.getElementById("dias").hidden=true;
			 document.getElementById("horas").hidden=false;
			 }
		  else{
			 document.getElementById("choras").checked=false;  
		     document.getElementById("dias").hidden=false;
			 document.getElementById("horas").hidden=true;
			  }
		  
	  }
</script>
<div class="panel-body" align="center"><label for="" id='saldo' name="saldo"></label></div>
<div class="panel-body" style="height: 200px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-4 col-md-6 col-xs-12">
      <label for="">Motivo</label>
       <select name="cat_id_motivo" id="cat_id_motivo" class="form-control selectpicker" data-live-search="true" required>          
            </select>
    </div>
     <div class="form-group col-lg-4 col-md-6 col-xs-12">
      <label for="">Observaciones</label>
     <input class="form-control" type="text" name="observaciones" id="observaciones" maxlength="70" placeholder="Observaciones">
    </div>
	  <div class="form-group col-lg-4 col-md-6 col-xs-12">
      <label for="">Descripción</label>
     <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="70" placeholder="Observaciones">
    </div>
     <div class="form-group col-lg-4 col-md-6 col-xs-12"  >
      <label for="">Días</label><input name="cdias" id="cdias" type="checkbox" onclick="dias_horas(1);" checked />
	  <label for="">Horas</label><input name="choras" id="choras" type="checkbox" onclick="dias_horas(2);"/>
    </div>
	 <div class="form-group col-lg-4 col-md-6 col-xs-12" id="dias" >
      <label for="">Fechas Desde - Hasta</label>
      <input class="form-control pull-right"  type="text" name="rfechas" id="rfechas" maxlength="70" placeholder="Rango de Fechas" >
    </div>
    <div class="form-group col-lg-4 col-md-6 col-xs-12" id="horas" hidden="false">
      <label for="">Hora Desde - Hasta</label>
      <input class="form-control pull-right" type="text" name="rhoras" id="rhoras" maxlength="70" placeholder="Rango de Horas">
    </div>  
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>	

</div>
<div class="panel-body table-responsive" id="listadoregistros">
	
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="messages-table-header">
                         <tr>
							 <th><i class="fa fa-angle-double-right"></i>-</th>
							<th><i class="fa fa-angle-double-right"></i> Fecha Solicitud</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha Inicio</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha Fin</th>
                           <th><i class="fa fa-angle-double-right"></i> Hora Inicio</th>
                           <th><i class="fa fa-angle-double-right"></i> Hora Fin</th>
                           <th><i class="fa fa-angle-double-right"></i> Total </th>   
				<th><i class="fa fa-angle-double-right"></i> Observación </th>   
                          </tr>
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
 <script src="scripts/cliente.js"></script>
 <?php 
}

ob_end_flush();
  ?>
