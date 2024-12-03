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
  <h1 class="box-title">Informes Mensuales Docente IST 17 de Julio </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 2500px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-3 col-md-3 col-xs-12">
      <label for="">Mes: </label>
       <select name="mes" id="mes" class="form-control selectpicker" data-live-search="true" required>        
       <option value="Enero">Enero</option>
        <option value="Febrero">Febrero</option>
         <option value="Marzo">Marzo</option>
          <option value="Abril">Abril</option>
           <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
        <option value="Agosto">Agosto</option>
         <option value="Septiembre">Septiembre</option>
          <option value="Octubre">Octubre</option>
           <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
      </select>
    </div>
        <div class="form-group col-lg-3 col-md-3 col-xs-12">
      <label for="">Dedicación Docente: </label>
       <select name="dedicacion" id="dedicacion" class="form-control selectpicker" data-live-search="true" required>        
       <option value="Tiempo Completo">Tiempo Completo</option>
        <option value="Medio Completo">Medio Completo</option>
         <option value="Cuarto Completo">Cuarto Completo</option>
        
      </select>
    </div>
     <div class="form-group col-lg-3 col-md-3 col-xs-12">
      <label for="">Titulo Profesional: </label>
       <select name="titulo" id="titulo" class="form-control selectpicker" data-live-search="true" required>        
       <option value="TERCER NIVEL">TERCER NIVEL</option>
        <option value="CUARTO NIVEL">CUARTO NIVEL</option>
        
      </select>
    </div>
    <div class="form-group col-lg-2 col-md-2 col-xs-12">
      <label for="">Periodo Académico:</label>       
       <select name="periodo" id="periodo" class="form-control selectpicker" data-live-search="true" required>              
      </select>   
    </div>
       <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <button id="btntrae" type="button" class="btn btn-primary" onclick="traer_materias()"></span>Llenar Informe</button>
          <button id="btninformes" type="button" class="btn btn-primary" onclick="traer_informes()"></span>Traer Informes</button>
       
       </div>
       <div id="informes" class="form-group col-lg-12 col-md-12 col-xs-12">
    <table id="tblinformes" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>OPCION</th>
      <th>MES</th>
      <th>CARRERAS</th>
      <th>PERIODO</th>
    </thead>
    <tbody>
    </tbody>     
  </table>

   </div>
      <div id='actividades' class="form-group col-lg-12 col-md-12 col-xs-12">
         
      <label for="">ACTIVIDADES REALIZADAS</label>
      <table id="tblmaterias" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>CARRERA</th>
      <th>ASIGNATURA</th>
      <th>H/SEMANA</th>
      <th>MEDIO/S DE VERIFICACIÓN</th>
      <th>% DE AVANCE</th>
      <th>OBSERVACIONES</th>      
    </thead>
    <tbody>
    </tbody>     
  </table>
       <table id="otras" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>#</th>
      <th>OTRA ACTIVIDADES</th>
      <th>HORAS/SEMANA</th>
      <th>MEDIO/S DE VERIFICACIÓN</th>
      <th>OBSERVACIONES</th>
      
    </thead>
    <tbody>
    </tbody>
  
  </table>
 <div> <label for="">HORAS DE INVESTIGACION</label></div>
  
  
      <table id="investiga" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>CARRERA</th>
      <th>NOMBRE DEL PROYECTO DE INVESTIGACION</th>
      <th>HORAS</th>
      <th>OBSERVACIONES</th>
      
    </thead>
    <tbody>
     <tr>
     <td><textarea name="invcarreras" id="invcarreras" cols="60" rows="4"></textarea></td>
     <td><textarea name="invproyectos" id="invproyectos" cols="60" rows="4"></textarea></td>
      <td><textarea name="invhoras" id="invhoras" cols="10" rows="1"></textarea></td>
     <td><textarea name="invobj" id="invobj" cols="60" rows="4"></textarea></td>
     </tr>
    </tbody>
  
  </table>
  <label for="">HORAS DE DIRECCION / GESTION / OTRAS</label>
 
      <table id="investiga" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>CARRERA</th>
      <th>GESTION / DIRECCION / OTRAS</th>
       <th>HORAS</th>
      <th>OBSERVACIONES</th>
      
    </thead>
    <tbody>
     <tr>
     <td><textarea name="gcarreras" id="gcarreras" cols="60" rows="4"></textarea></td>
     <td><textarea name="gproyectos" id="gproyectos" cols="60" rows="4"></textarea></td>
       <td><textarea name="ghoras" id="ghoras" cols="10" rows="1"></textarea></td>
     <td><textarea name="gobj" id="gobj" cols="60" rows="4"></textarea></td>
     </tr>
    </tbody>
  
  </table>
    <label for="">ACTIVIDADES REALIZADAS</label>
     
  </table>
    <table id="investiga1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>SITUACIONES O PROBLEMAS DETECTADOS</th>
      
    </thead>
    <tbody>
     <tr>
     <td><textarea name="situaciones" id="situaciones" cols="160" rows="4"></textarea></td>
     </tr>
    </tbody>
  
  </table>
    <table id="investiga1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>SUGERENCIA DE ACCIONES A TOMAR PARA ATENCIÓN A LAS SITUACIONES O PROBLEMAS DETECTADOS</th>
      
    </thead>
    <tbody>
     <tr>
     <td><textarea name="acciones" id="acciones" cols="160" rows="4"></textarea></td>
     </tr>
    </tbody>
 
  </table>
  <!-- 
     <table id="investiga1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>TOTAL DE HORAS (40)</th>
      <th>(40)</th>      
    </thead>
    <tbody>
     <tr>
     <td>IMPARTICIÓN DE CLASES PRESENCIALES, VIRTUALES O EN LÍNEA, DE CARÁCTER TEÓRICO O PRÁCTICO, EN LA INSTITUCIÓN O FUERA DE ELLA, BAJO RESPONSABILIDAD Y DIRECCIÓN DE LA MISMA.</td>
     <td><input name="docencia" id="docencia" cols="160" rows="4" /></td>
     </tr>
     <tr>
     <td>HORAS DEDICADAS A LAS DEMÁS ACTIVIDADES DE DOCENTE</td>
     <td><input name="demas" id="demas"  /></td>
     </tr>
     <tr>
     <td>HORAS DE INVESTIGACIÓN</td>
     <td><input name="himvestiga" id="hinvestiga" /></td>
     </tr>
        <tr>
     <td>ACTIVIDADES DE DIRECCIÓN ACADÉMICA / GESTIÓN / OTRAS</td>
     <td><input name="hdireccion" id="hdireccion" /></td>
     </tr>
    </tbody>
  
  </table>
  -->
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar1"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
      </div>
    

  </form>    
      </div>
         
<div id="divreporte">
  <embed src="../reportes/rpt_infomes.php" type="application/pdf" id="reporte"  width="100%" height="600px" />
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
 <script src="scripts/informes.js"></script>
 <?php 
}

ob_end_flush();
  ?>

