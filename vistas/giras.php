
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
    <div class="row">
     <div class="col-md-12">
      <div class="box"> 
<div class="box-header with-border">
  <h1 class="box-title"><button class="btn btn-warning" ><i class="fa fa-calendar-check-o"></i> Salida a Giras de Observacion/Practicas </a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST"> 	 

	 <div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label >Tipo de Gira(*):</label>
             <select name="gir_tipo" id="gir_tipo" class="form-control selectpicker" data-live-search="true" required>
				<option value="Practica">PRACTICA</option>
			<option value="Observacion">OBSERVACION</option>
            
			</select> 
    </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Nro. de Estudiantes(*):</label>
      <input class="form-control" type="text" name="gir_nro" id="gir_nro" maxlength="100" placeholder="# Estudiantes" required></div>
	
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Fecha Salida(*):</label>
      <input class="form-control" type="text" name="gir_fechas" id="gir_fechas" maxlength="100" placeholder="2024-07-01" required>
    </div>
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Hora Estimada Salida(*):</label>
      <input class="form-control" type="text" name="gir_hora" id="gir_hora" maxlength="100" placeholder="HH:MM:SS" required>
    </div>  
    <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Fecha Retorno(*):</label>
      <input class="form-control" type="text" name="gir_fechar" id="gir_fechar" maxlength="100" placeholder="2024-07-01" required>
    </div>
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Hora Estimada de Retorno(*):</label>
      <input class="form-control" type="text" name="gir_horar" id="gir_horar" maxlength="100" placeholder="HH:MM:SS" required>
    </div>  
	  	  <div align="center" class="form-group col-lg-11 col-md-4 col-xs-12">
      <label >REQUERIMIENTOS PARA A REALIZACIÓN DE LA SALIDA DE CAMPO/PRÁCTICA</label>
     
    </div>
	  <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Tipo de ropa y calzado: (*):</label>
      <input class="form-control" type="text" name="gir_ropa" id="gir_ropa" maxlength="200" placeholder="" required>
    </div>
	   <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Alimentación y agua: (*):</label>
       <input class="form-control" type="text" name="gir_ali" id="gir_ali" maxlength="200" placeholder="" required>
    </div>
	    <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Transporte: (*):</label>
      <input class="form-control" type="text" name="gir_transporte" id="gir_transporte" maxlength="200" placeholder="" required>
    </div>
	   <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Materiales que los estudiantes deben llevar: (*):</label>
       <input class="form-control" type="text" name="gir_materiales" id="gir_materiales" maxlength="200" placeholder="" required>
    </div>
	<div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Objetivos de la salida de campo/práctica/actividades: (*):</label>
      <textarea class="form-control" type="text" name="gir_obj" id="gir_obj" maxlength="200" placeholder="" rows="3" required></textarea>
    </div>
	   <div class="form-group col-lg-6 col-md-12 col-xs-12">
      <label >Itinerario por cumplir en la Salida / rutas a seguir: (*):</label>
       <textarea class="form-control" type="text" name="gir_cumplir" id="gir_cumplir" maxlength="200" rows="3" placeholder="" required></textarea>
    </div>  
  <div class="form-group col-lg-11 col-md-4 col-xs-12">
      <label > REGISTRO DE DOCENTES QUE ASISTIRÁN</label>
      <ul id="gdocentes" style="list-style: none;">
        
      </ul>
    </div>	  
	
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar y Generar pdf de Solicitud de  Gira</button>
	 <button class="btn btn-primary" id="btnhojarpt" onclick="imprimehojadevida();"><i class="fa fa-list"></i>  Imprimir hoja de vida</button>
		
		 
   </div>
 </form>


<!--fin centro-->


    </div>
    
        </div> <!-- row -->
     </div>
	</div>
	</seccion>
	</div>

		<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>

 <script src="scripts/gira.js"></script>
 <?php 
}

ob_end_flush();
  ?>
