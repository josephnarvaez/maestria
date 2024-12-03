<strong></strong><?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION['usu_nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['Actas']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title"><button class="btn btn-warning" data-toggle="modal" data-target="#myModal"><i class="fa fa-calendar-check-o"></i> Nuevo Horario</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
   <table class="table table-striped" id="tbllistado">
                      <thead class="messages-table-header">
                         <tr>
                           <th><i class="fa fa-angle-double-right"></i> Acciones</th>
                           <th><i class="fa fa-angle-double-right"></i> Nombre</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha</th>
                           
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
 
  
</div>

<!--fin centro-->

   <!-- container -->
      <div id="divhorario" class="container">
<table id="tblhorario" class="table table-bordered">
<thead class="thead">
 <tr>
    <td align="center"></td>
    <td colspan="7"><div id="divdoc"> <h3 class="horario-name"></i> 
    <textarea name="nombredoc" id="nombredoc" cols="60" disabled="disabled" rows="1"></textarea>	 </h3>	</div></td>
  </tr>
<th >Id</th>
<th class="horarioheader"><i class="fa fa-clock-o"></i> Horario</th>
<th ><i class="fa fa-angle-right"></i> Lunes</th><th><i class="fa fa-angle-right"></i> Martes</th><th><i class="fa fa-angle-right"></i> Miercoles</th><th><i class="fa fa-angle-right"></i> Jueves</th><th><i class="fa fa-angle-right"></i> Viernes</th><th><i class="fa fa-angle-right"></i> Sabado</th>

</thead>
<tbody>
</tbody></table>

      </div>
    <!-- container -->


      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<!-- modal nuevo horario -->
<div class="modal fade  animated bounceInLeft" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cancel-new" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Nuevo Horario</h4>
      </div>
      <div class="modal-body">
        
         <form id="formulario"  id="formulario" method="POST">
        
            <label>Período Académico:</label>
            <select name="cat_id_periodo" id="cat_id_periodo" class="form-control selectpicker" data-live-search="true" required>          
            </select>
            <label>Docente	:</label>
            <select name="id_docente" id="id_docente" class="form-control selectpicker" data-live-search="true" required>          
            </select>          
         

      </div>
      <div class="modal-footer">
        <button  type="submit"  id="btnGuardar" class="create-horario btn btn-success" ><i class="fa fa-calendar-check-o"></i> Crear</button>
        <button type="button" class="cancel-new btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal nuevo horario -->
<!-- append modal set data -->
<div class="modal fade" id="DataEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i> Agregar Materia</h4>
      </div>
      <div class="modal-body">
        
        <form id="ingmateria">
                    <table width="100%"  border="0">
  <tr>
    <td> <label>Materia</label> </td><td></td><td colspan="4">     <select name="idmateria" id="idmateria" class="form-control selectpicker" data-live-search="true" required>
    </select></td>
  
    </tr>
  <tr>
    <td> <label>Paralelo</label></td><td></td>
    <td ><select class="form-control" id="paralelo" name="paralelo">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
              <option value="F">F</option>
              <option value="G">G</option>
              <option value="H">H</option>
              <option value="I">I</option>
              <option value="J">J</option>
              <option value="K">K</option>
              <option value="L">L</option>
              <option value="M">M</option>
              <option value="N">N</option>
		      <option value="O">O</option>
              <option value="P">P</option>
              <option value="Q">Q</option>
              <option value="R">R</option>
			  <option value="S">S</option>
              <option value="T">T</option>
		      <option value="U">U</option>
              <option value="V">V</option>
              <option value="W">W</option>
			  <option value="X">X</option>
              <option value="Y">Y</option>
              <option value="Z">Z</option>
              
           </select>  </td>
    <td align="right"> <label>Aula  </label></td><td></td>
        <td ><select name="idaula" id="idaula" class="form-control selectpicker" data-live-search="true" required></select></td>
        <input id="hhorario" name="hhorario" type="hidden" >
        <input id="dhorario" name="dhorario" type="hidden" >
	      </tr>
 
</table>    
  
       

      </div>
      <div class="modal-footer">
        <button type="submit" class="savetask btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
        <button type="button" class="canceltask btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
       </form>
    </div>
  </div>
</div>
<!-- append modal set data -->
  
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/coordinadores.js"></script>

 <?php 
}
if (isset($_SESSION['hor_id'])) {
  echo '<script type="text/javascript">horario('.$_SESSION['hor_id'].','.$_SESSION["docenteh"].'); </script>';
}

ob_end_flush();
  ?>