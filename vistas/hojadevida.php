
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
  <h1 class="box-title"><button class="btn btn-warning" ><i class="fa fa-calendar-check-o"></i> MI HOJA DE VIDA</a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
		 <button class="btn btn-primary" id="btnhojarpt" onclick="imprimehojadevida();"><i class="fa fa-list"></i>  Imprimir hoja de vida</button>
		 
   </div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label ><h4>DATOS PERSONALES</h4></label>
     </div>
	  	  <div class="form-group col-lg-2 col-md-4 col-xs-12">
	   <img src="" alt="" width="100%" height="100%" id="doc_img" name="doc_img">
</div>

	  <div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label >Cédula(*):</label>
      <input type="text" class="form-control" name="doc_cedula" id="doc_cedula" placeholder="Cedula" maxlength="20"></div>
	 <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Primer Nombre(*):</label>
      <input class="form-control" type="text" name="doc_nombre1" id="doc_nombre1" maxlength="100" placeholder="Nombre" required></div>
	   <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Segundo Nombre(*):</label>
      <input class="form-control" type="text" name="doc_nombre2" id="doc_nombre2" maxlength="100" placeholder="Nombre" required>
	  </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Apellido Paterno(*):</label>
      <input class="form-control" type="text" name="doc_apellido1" id="doc_apellido1" maxlength="100" placeholder="Apellido" required>
    </div>
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Apellido Materno(*):</label>
      <input class="form-control" type="text" name="doc_apellido2" id="doc_apellido2" maxlength="100" placeholder="Apellido" required>
    </div>  
    <div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label >Genero(*):</label>
             <select name="doc_genero" id="doc_genero" class="form-control selectpicker" data-live-search="true" required>
			</select> 
    </div>
	  	  <div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label >Nacionalidad(*):</label>
      <input type="text" class="form-control" name="doc_nacionalidad" id="doc_nacionalidad" placeholder="Nacionalidad" maxlength="30">
    </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Estado Civil(*):</label>
      <input class="form-control" type="text" name="doc_civil" id="doc_civil" maxlength="100" placeholder="Estado Civil" required>
    </div>
	   <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Tipo de Sangre(*):</label>
       <select name="doc_tsangre" id="doc_tsangre" class="form-control selectpicker" data-live-search="true" required>
			</select> 
    </div>
	    <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Fecha de Nacimiento (*) :</label>
      <input class="form-control" type="text" name="doc_fnace" id="doc_fnace" maxlength="100" placeholder="AAAA-MM-DD" >
    </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Etnia(*):</label>
       <select name="doc_etnia" id="doc_etnia" class="form-control selectpicker" data-live-search="true" required>
			</select> 
    </div>							
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Teléfono Celular (*):</label>
      <input class="form-control" type="text" name="doc_celular" id="doc_celular" maxlength="100" placeholder="Nro. Telf. Celular" required>
	  </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Teléfono Casa :</label>
      <input class="form-control" type="text" name="doc_tcasa" id="doc_tcasa" maxlength="100" placeholder="Nro. Telf. Casa" >
    </div>
 <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Teléfono Contacto (*):</label>
      <input class="form-control" type="text" name="doc_celularc" id="doc_celularc" maxlength="100" placeholder="Nro. Telf. Celular contacto" required>
    </div>	
	    <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label >Nombre Contacto (*):</label>
      <input class="form-control" type="text" name="doc_nombrec" id="doc_nombrec" maxlength="100" placeholder="Nombre contacto" required>
    </div>		
<div class="form-group col-lg-3 col-md-4 col-xs-12">
      <label >Correo Personal(*):</label>
      <input class="form-control" type="email" name="doc_correo" id="doc_correo" maxlength="70" placeholder="Correo">
    </div>  
<div class="form-group col-lg-3 col-md-4 col-xs-12">
      <label >Correo Institucional(*):</label>
      <input class="form-control" type="email" name="doc_icorreo" id="doc_icorreo" maxlength="70" placeholder="Correo Instituto">
    </div>
<div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label >Dirección Domicilio calle1 / nro casa / calle2 / referncia (*):</label>
      <input class="form-control" type="text" name="doc_domicilio" id="doc_domicilio" maxlength="300" placeholder="Dirección Domicilio" required>
    </div>
	<div class="form-group col-lg-6 col-md-12 col-xs-12">
  <label >Subir Foto <FONT COLOR="red">Formato .jpg maximo 80KB (*) :</font></label>
      <input class="form-control" type="file" name="doc_foto" id="doc_foto">
 </div>
		  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label >Tipo de discapacidad (*):</label>
       <select name="doc_discapacidad" id="doc_discapacidad" class="form-control selectpicker" data-live-search="true" required onchange="discapacidad();">
	   	</select>
    </div>  
    <div class="form-group col-lg-2 col-md-4 col-xs-12" hidden="true" id="divp">
      <label >Porcentaje de Discapacidad:</label>
      <input type="text" class="form-control" name="doc_porcen" id="doc_porcen" placeholder="%" maxlength="20">
    </div>
     <div class="form-group col-lg-2 col-md-4 col-xs-12" hidden="true" id="divc">
      <label >Nro. Carnet Discapacidad:</label>
      <input type="text" class="form-control" name="doc_carnet" id="doc_carnet" placeholder="Numero del Carnet" maxlength="20">
	</div>	
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar Datos Personales</button>
		
		 
   </div>
 </form>
	
	<div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for=""><h4>INSTRUCCIÓN FORMAL   </h4> </label>   <button class="btn btn-success"  id="btnacademico" onclick="academico();"><i class="	fa fa-share"></i>  Ingresar Instrucción Formal</button>
  
		<table class="table table-striped" id="tinstruccion">
                      <thead class="messages-table-header">
                       <tr>							 
                           <th><i class="fa fa-angle-double-right"></i>Opciones</th>
                           <th><i class="fa fa-angle-double-right"></i>Institución</th>
                           <th><i class="fa fa-angle-double-right"></i>Título</th>
                           <th><i class="fa fa-angle-double-right"></i>Nro. Registro</th>
                           <th><i class="fa fa-angle-double-right"></i>Fecha</th>      
                           <th><i class="fa fa-angle-double-right"></i>Nivel</th>  				
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
	</div>   
	
	<div id="academico" hidden="true">															
	 <form action="" name="formularioa" id="formularioa" method="POST">
    
	 <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Institución(*):</label>
      <input class="form-control" type="text" name="ins_nombre" id="ins_nombre" maxlength="100" placeholder="Nombre" required>
    </div>
	  <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Título(*):</label>
      <input class="form-control" type="text" name="ins_titulo" id="ins_titulo" maxlength="100" placeholder="Titulo" required>
    </div>
    <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">N° REGISTRO SENESCYT (*):</label>
      <input class="form-control" type="text" name="ins_registro" id="ins_registro" maxlength="100" placeholder="# Registro" required>
    </div>  																					<div class="form-group col-lg-2 col-md-4 col-xs-12">
       <label for="">Fecha (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="ins_fecha" id="ins_fecha" maxlength="100" placeholder="Fecha" required>
    </div>																						<div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label for="">Tipo(*):</label>
        <select name="ins_nivel" id="ins_nivel" class="form-control selectpicker" data-live-search="true" required>   
			<option value="TERCER NIVEL">TERCER NIVEL</option>
			<option value="CUARTO NIVEL">CUARTO NIVEL</option>
            </select>
    </div>
 
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardarA"><i class="fa fa-save"></i>  Guardar Datos Instrucción</button>
	
    </div>

  </form> 
	 
 	
</div>	

		<div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for=""><h4>EXPERIENCIA LABORAL  </h4></label>     <button class="btn btn-success" id="btnexperiencia" onclick="experiencia();"><i class="fa fa-share"></i>  Ingrese Experiencia Laboral</button>     
		<table class="table table-striped" id="texperiencia">
                      <thead class="messages-table-header">
                       <tr>							 
                           <th><i class="fa fa-angle-double-right"></i>Opciones</th>
                           <th><i class="fa fa-angle-double-right"></i>Institución</th>
                           <th><i class="fa fa-angle-double-right"></i>Cargo</th>
                           <th><i class="fa fa-angle-double-right"></i>Fecha Desde</th>
                           <th><i class="fa fa-angle-double-right"></i>Fecha Hasta</th>      
                           <th><i class="fa fa-angle-double-right"></i>Teléfono</th> 			
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
	</div>
	<div id="experiencia" hidden="true">														 
<form action="" name="formularioe" id="formularioe" method="POST">\
	
	 <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Institución(*):</label>
      <input class="form-control" type="text" name="exp_institucion" id="exp_institucion" maxlength="100" placeholder="Institución" required>
    </div>
	  <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Cargo (*):</label>
      <input class="form-control" type="text" name="exp_cargo" id="exp_cargo" maxlength="100" placeholder="Cargo" required>
    </div>
    <div class="form-group col-lg-2 col-md-4 col-xs-12">
       <label for="">Fecha Desde (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="exp_fini" id="exp_fini" maxlength="100" placeholder="Fecha" required>
    </div>
	<div class="form-group col-lg-2 col-md-4 col-xs-12">
       <label for="">Fecha Hasta (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="exp_ffin" id="exp_ffin" maxlength="100" placeholder="Fecha" >
    </div>
	 <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Teléfono (*):</label>
      <input class="form-control" type="text" name="exp_telefono" id="exp_telefono" maxlength="100" placeholder="Teléfono" required>
    </div>      
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar Datos Experiencia</button>
	
    </div>
  </form>	
	</div>
	<div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for=""><h4>CAPACITACIÓN </h4></label>   <button class="btn btn-success" id="btncapacitacion" onclick="capacitacion();"><i class="fa fa-share"></i>  Ingrese Capacitación</button>
		<table class="table table-striped" id="tcapacitacion">
                      <thead class="messages-table-header">
                       <tr>							 
                           <th><i class="fa fa-angle-double-right"></i>Opciones</th>
						   <th><i class="fa fa-angle-double-right"></i>Tipo</th>
                           <th><i class="fa fa-angle-double-right"></i>Tema</th>
                           <th><i class="fa fa-angle-double-right"></i>Institución</th>
						     <th><i class="fa fa-angle-double-right"></i>Certificación</th> 
                           <th><i class="fa fa-angle-double-right"></i>Fecha Desde</th>
                           <th><i class="fa fa-angle-double-right"></i>Fecha Hasta</th>      
                         
						   <th><i class="fa fa-angle-double-right"></i>Nro. Horas</th> 
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
     </div>
	<div id="capacitacion" hidden="true">
	<form action="" name="formularioc" id="formularioc" method="POST">
    <div class="form-group col-lg-2 col-md-4 col-xs-12">
      <label for="">Tipo (*):</label>
             <select name="cap_tipo" id="cap_tipo" class="form-control selectpicker" data-live-search="true" required>
			</select> 
    </div>
	 <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Tema del Certificado (*):</label>
      <input class="form-control" type="text" name="cap_tema" id="cap_tema" maxlength="100" placeholder="Tema" required>
    </div>
	 <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label for="">Institución (*):</label>
      <input class="form-control" type="text" name="cap_institucion" id="cap_institucion" maxlength="100" placeholder="Institucion" required>
    </div>
		<div class="form-group col-lg-2 col-md-4 col-xs-12">
		<label for="">Tipo Certificado (*):</label>
             <select name="cap_tipoc" id="cap_tipoc" class="form-control selectpicker" data-live-search="true" required>
			</select> 
		</div>
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Fecha D (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="cap_fini" id="cap_fini" maxlength="100" placeholder="Fecha" required>
    </div>
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Fecha H (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="cap_ffin" id="cap_ffin" maxlength="100" placeholder="Fecha" required>
    </div>
   
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Horas(*):</label>
      <input class="form-control" type="text" name="cap_horas" id="cap_horas" maxlength="100" placeholder="Nro. horas" required>
    </div> 
      
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardarcap"><i class="fa fa-save"></i>  Guardar Datos Capacitación</button>

    </div>
  </form>
</div>
<div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for=""><h4>PUBLICACION</h4></label>   <button class="btn btn-success" id="btnlibros" onclick="libros();"><i class="fa fa-share"></i>  Ingrese Publicación</button>
		<table class="table table-striped" id="tpublicaciones">
                      <thead class="messages-table-header">
                       <tr>							 
                           <th><i class="fa fa-angle-double-right"></i>Opciones</th>
						   <th><i class="fa fa-angle-double-right"></i>Libro/Articulo</th>
						   <th><i class="fa fa-angle-double-right"></i>Nombre</th>
                           <th><i class="fa fa-angle-double-right"></i>Fecha Publicacón</th>
                           <th><i class="fa fa-angle-double-right"></i>Editorial/Revista</th>
                           <th><i class="fa fa-angle-double-right"></i>ISBN/ISSN</th>
                           <th><i class="fa fa-angle-double-right"></i>Participación</th>      
                           <th><i class="fa fa-angle-double-right"></i>Revisado/Indexado</th> 	
						   <th><i class="fa fa-angle-double-right"></i>Bases de Datos</th> 	
						    <th><i class="fa fa-angle-double-right"></i>DOI</th> 
                         </tr>
                      </thead>
                      <tbody>
   				</tbody>
  			 </table>
     </div>
<div id="libros" hidden="true">
	<form action="" name="formulariop" id="formulariop" method="POST">   
		 <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Tipo de Publicación (*):</label>
       <select name="pub_tipo" id="pub_tipo" class="form-control selectpicker" data-live-search="true" onChange="cambio();" required>   
			<option value="--">SELECCIONE</option>
		    <option value="ARTICULO">ARTICULO</option>
			<option value="LIBRO">LIBRO</option>	
            </select>
		 </div>
	 <div class="form-group col-lg-4 col-md-12 col-xs-12">
      <label id="lbl_libro" for="">Nombre del libro (*):</label>
      <input class="form-control" type="text" name="pub_nombre" id="pub_nombre" maxlength="200" placeholder="Nombre" required>
    </div>
		<div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label id="lbl_editorial" for="">Editorial (*):</label>
      <input class="form-control" type="text" name="pub_editorial" id="pub_editorial" maxlength="100" placeholder="Nombre" required>
    </div>
	 <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">Fecha (AAAA-MM-DD) (*):</label>
      <input class="form-control" type="text" name="pub_fecha" id="pub_fecha" maxlength="100" placeholder="Nombre" required>
    </div>
     
	  <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label for="">ISBN/ISSN (*):</label>
      <input class="form-control" type="text" name="pub_isbn" id="pub_isbn" maxlength="100" placeholder="Nombre" required>
    </div>
     <div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label id="lbl_participa" for="">Participación en el libro (*):</label>
       <select name="pub_participa" id="pub_participa" class="form-control selectpicker" data-live-search="true" required>   
			<option value="AUTOR">AUTOR</option>
			<option value="COAUTOR">COAUTOR</option>
			<option value="CAPITULO">CAPITULO</option>
            </select>
		 </div>
	<div class="form-group col-lg-2 col-md-12 col-xs-12">
      <label id="lbl_revisado" for="">Revisado por pares (*):</label>
       <select name="pub_revisado" id="pub_revisado" class="form-control selectpicker" data-live-search="true"  onchange="revisado();" required>   
		    <option value="--">SELECCIONE</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
	
            </select>
		 </div>
	     	<div class="form-group col-lg-2 col-md-12 col-xs-12" hidden="true"  id="bdd">
      <label for="">Base de datos (*):</label>
       <select name="pub_bdd" id="pub_bdd" class="form-control selectpicker" data-live-search="true" >   
			
            </select>
		 </div> 
	<div class="form-group col-lg-2 col-md-12 col-xs-12" hidden="true"  id="doi">
      <label for="">Doi (*):</label>
       <input class="form-control" type="text" name="pub_doi" id="pub_doi" maxlength="100" placeholder="Doi" >
		 </div> 
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar Datos Publicación</button>
</div>
  </form>
</div>
  
	

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

 <script src="scripts/hojadevida.js"></script>
 <?php 
}

ob_end_flush();
  ?>
