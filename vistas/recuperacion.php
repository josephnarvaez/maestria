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
  <h1 class="box-title">Informes de Recuperación  Docente IST 17 de Julio </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 2500px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">

       <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <button id="btntrae" type="button" class="btn btn-primary" onclick="traer_recuperacion()"></span>Llenar Recuperación</button>
          <button id="btninformes" type="button" class="btn btn-primary" onclick="traer_informes()"></span>Traer Informes</button>
       
       </div>
       <div id="informes" class="form-group col-lg-12 col-md-12 col-xs-12">
    <table id="tblinformes" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>OPCION</th>
      <th>ASIGNATURA</th>
      <th>FECHA RECUPERACION</th>
    </thead>
    <tbody>
    </tbody>     
  </table>

   </div>
		  
      <div id='actividades' class="form-group col-lg-12 col-md-12 col-xs-12">   
	 <div> <div class="form-group col-lg-2 col-md-3 col-xs-12">
      <label for="">Fecha a Recuperar:</label> 
	  <input class="form-control" type="text" name="fechap" id="fechap" maxlength="10" placeholder="2024-01-01">
    </div>		
     <div class="form-group col-lg-2 col-md-6 col-xs-12">
      <label for="">Fecha de Recuperación </label>
     <input class="form-control" type="text" name="fechar" id="fechar" maxlength="10" placeholder="2024-01-01">
    </div>
	  <div class="form-group col-lg-7 col-md-6 col-xs-12">
      <label for="">Tema a tratarse</label>
     <input class="form-control" type="text" name="tema" id="tema" maxlength="500" placeholder="">
    </div>
	 <div class="form-group col-lg-5 col-md-6 col-xs-12" id="dias" >
      <label for="">Asignatura</label>
      <select name="materias" id="materias" class="form-control selectpicker" data-live-search="true" required>        
      
       </select>
    </div>
    <div class="form-group col-lg-2 col-md-6 col-xs-12"  >
      <label for="">Modalidad</label>
       <select name="modalidad" id="modalidad" class="form-control selectpicker" data-live-search="true" required>        
       <option value="Presencial">Presencial</option>
        <option value="Virtual">Virtual</option>
       </select>
    </div>  
    <div class="form-group col-lg-2 col-md-6 col-xs-12"  >
      <label for="">Horas a Recuperar</label>
      <input class="form-control pull-right" type="text" name="rhoras" id="rhoras" maxlength="70" placeholder="">
    </div> 
    <div class="form-group col-lg-2 col-md-6 col-xs-12"  >
      <label for="">Acuerdo con Estudiantes</label>
	  <select name="acuerdo" id="acuerdo" class="form-control selectpicker" data-live-search="true" required>   
      <option value="SI">SI</option>
        <option value="NO">NO</option>
		  </select>
    </div> 
	  <div class="form-group col-lg-7 col-md-6 col-xs-12">
      <label for="">Observaciones</label>
     <input class="form-control" type="text" name="obj" id="obj" maxlength="500" placeholder="">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
   

      <div><p></p><p></p><p></p><p></p><label for="">ACTIVIDADES A REALIZAR</label> </div>
      <table id="tblmaterias" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
			
      <th>Fecha a Recuperar</th>
		<th>Fecha de Recuperación</th>
      <th>Tema a tratarse</th>
      <th>Modalidad</th>
	  <th>Asignatura</th>
      <th>Horas a Recuperar</th>
      <th>Acuerdado con Estudiantes</th>           
    </thead>
    <tbody>
    </tbody>     
  </table>
    
     <button class="btn btn-primary" type="button" onclick="imprime();" id="imprimir"><i class="fa fa-save"></i>  Imprimir Informe</button>
      </div>
    </div>
		   </div>

  </form>    
      </div>
         

 
 
<!--fin centro-->

      <!-- /.box -->

 
<div>

</div>

<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/recuperacion.js"></script>
 <?php 
}

ob_end_flush();
  ?>

