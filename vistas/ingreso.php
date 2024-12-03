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
  <h1 class="box-title"><button class="btn btn-warning" ><i class="fa fa-calendar-check-o"></i> MI HORARIO</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->


<!--fin centro-->

   <!-- container -->
      <div id="divhorario" class="container">
<table id="tblhorario" class="table table-bordered">
<thead class="thead">
 <tr>
    <td align="center"></td>
    <td colspan="7"><div id="divdoc"> <h3 class="horario-name"></i> 
    <textarea name="nombredoc" id="nombredoc" cols="60" disabled="disabled" rows="1"><?php echo $_SESSION['usu_nombre'];  ?></textarea>	 </h3>	</div></td>
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

<!-- append modal set data -->
<div class="modal fade" id="DataEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close canceltask" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumb-tack"></i> Agregar Opción</h4>
      </div>
      <div class="modal-body">
        
        <form id="ingmateria">
                    <table width="100%"  border="0">
  <tr>
    <td> <label>Oopción</label></td><td></td>
    <td ><select class="form-control" id="opcion" name="opcion">
          </select>  </td>
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
 <script src="scripts/ingreso.js"></script>

 <?php 
}
if (isset($_SESSION['hor_id'])) {
  echo '<script type="text/javascript">horario('.$_SESSION['usu_id'].',"'.$_SESSION['usu_nombre'].'"); </script>';
}

ob_end_flush();
  ?>
