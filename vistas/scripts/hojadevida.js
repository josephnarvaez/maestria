var tabla;

//
//funcion que se ejecuta al inicio
function init(){
  $("#formulario").on("submit",function(e){
	  guardaryeditar(e);
   });
 $("#formularioa").on("submit",function(e){
	  guardaryeditara(e);
   });
  $("#formularioe").on("submit",function(e){
	  guardaryeditare(e);
   });
  $("#formularioc").on("submit",function(e){
	  guardaryeditarc(e);
   });
   $("#formulariop").on("submit",function(e){
	   guardaryeditarp(e);
   });
	
 
 $.post("../ajax/coordinadores.php?op=combo_docentes", function(r){
   	$("#id_docente").html(r);
   	$('#id_docente').selectpicker('refresh');
   });

	combo1();
   
	
tinstruccion();
texperiencia();
tcapacitacion();
tpublicaciones();
}

function combo1(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=5",
     	type: "POST",
     	contentType: false,
     	processData: false,
        async: false,
     	success: function(datos){
		   $("#doc_genero").html(datos);
			combo2();
    	}
	    
     });
	
}
function combo2(){
    $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=9",
     	type: "POST",
     	contentType: false,
     	processData: false,
        async: false, 
     	success: function(datos){
         	$("#doc_tsangre").html(datos);
			combo3();
     	        	}
     });
}
function combo3(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=973",
     	type: "POST",
     	contentType: false,
     	processData: false,
async: false,
     	success: function(datos){
			$("#doc_etnia").html(datos)
			combo4();
       	}
     });
}
function combo4(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=974",
     	type: "POST",
     	contentType: false,
     	processData: false,
async: false,
     	success: function(datos){
     		$("#doc_discapacidad").html(datos)
     	      combo5(); 
			info();
			
     	}
     });
}
function combo5(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=975",
     	type: "POST",
     	contentType: false,
     	processData: false,
async: false,
     	success: function(datos){
     		$("#cap_tipo").html(datos)
     	      combo6(); 			
     	}
     });
}
function combo6(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=976",
     	type: "POST",
     	contentType: false,
     	processData: false,
async: false,
     	success: function(datos){
     		$("#cap_tipoc").html(datos)
     	      combo7(); 			
     	}
     });
}
function combo7(){
   $.ajax({
     	url: "../ajax/hojadevida.php?op=combo&id=977",
     	type: "POST",
     	contentType: false,
     	processData: false,
async: false,
     	success: function(datos){
     		$("#pub_bdd").html(datos)
     			
     	}
     });
}


function info(){

	$.ajax({
		url: "../ajax/hojadevida.php?op=info",
		type: "POST",
		contentType: false,
		processData: false,
		async: false,
		success: function(datos){
        var resu =$.parseJSON(datos);
		$("#doc_cedula").val(resu.doc_cedula);
		$("#doc_nombre1").val(resu.doc_nombre1);
		$("#doc_nombre2").val(resu.doc_nombre2);
		$("#doc_apellido1").val(resu.doc_apellido1);
		$("#doc_apellido2").val(resu.doc_apellido2);
		$("#doc_nacionalidad").val(resu.doc_nacionalidad);
		$("#doc_civil").val(resu.doc_estadocivil);		
		$("#doc_celular").val(resu.doc_tcelular);
		$("#doc_tcasa").val(resu.doc_tcasa);
		$("#doc_nombrec").val(resu.doc_nombrec);
		$("#doc_celularc").val(resu.doc_tcontacto);
		$("#doc_fnace").val(resu.doc_fechanace);
		$("#doc_correo").val(resu.doc_correop);
		$("#doc_icorreo").val(resu.doc_correoi);
		$("#doc_domicilio").val(resu.doc_direccion);
		$('#doc_img').attr('src','../files/usuarios/'+resu.doc_cedula+'.jpg');
		$("#doc_porcen").val(resu.doc_porcentaje);
		$("#doc_carnet").val(resu.doc_nrocarnet);
		$("#doc_genero option[value="+resu.cat_id_g+"]").attr("selected",true);
		$("#doc_tsangre option[value="+resu.cat_id_s+"]").attr("selected",true);
		$("#doc_etnia option[value="+resu.cat_id_e+"]").attr("selected",true);
		$("#doc_discapacidad option[value="+resu.cat_id_d+"]").attr("selected",true);
   }
     });


}

function discapacidad(){   
	if ($("#doc_discapacidad option:selected").html()=="NINGUNA" || $("#doc_discapacidad").val()==0 ){	
		$("#doc_porcen").val("");
		$("#doc_carnet").val("");
		$("#divp").hide();
		$("#divc").hide();

	}
	else{
		$("#divp").show();
		$("#divc").show();
	}
}
function academico(){
	$("#academico").show();
	$("#experiencia").hide();
	$("#capacitacion").hide();
	$("#libros").hide();
	tinstruccion();
}
function experiencia(){
	$("#academico").hide();
	$("#experiencia").show();
	$("#capacitacion").hide();
	$("#libros").hide();	
	texperiencia();
}

function capacitacion(){
	$("#academico").hide();
	$("#experiencia").hide();
	$("#capacitacion").show();
	$("#libros").hide();

	tcapacitacion();
}
function libros(){
	$("#academico").hide();
	$("#experiencia").hide();
	$("#capacitacion").hide();
	$("#libros").show();
	/*$.post("../ajax/hojadevida.php?op=combo&id=977", function(r){
					$("#pub_bdd").html(r);
                          
		});*/
	tpublicaciones();
}


//funciones eliminar
function elimina(id,op){
  $.post("../ajax/hojadevida.php?op=eliminar&id="+id+"&inf="+op, function(r){
		bootbox.alert("Eliminado con exito");
	  if (op==0)
	    tinstruccion();
	  if (op==1)
		 texperiencia(); 
	   if (op==2)
		 tcapacitacion();
	   if (op==3)
		 tpublicaciones(); 
 });	
		
}

//funcion listar
function tinstruccion(){
	tabla=$('#tinstruccion').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		
		"ajax":
		{
			url:'../ajax/hojadevida.php?op=listarins',
			type: "POST",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
function texperiencia(){
	tabla=$('#texperiencia').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		
		"ajax":
		{
			url:'../ajax/hojadevida.php?op=listarexp',
			type: "POST",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
	
}
function cambio(){

	if ($("#pub_tipo").val()=="ARTICULO"){			
		$("#lbl_libro").html("Tema de la publicación (*):");
		$("#lbl_editorial").html("Revista (*):");
		$("#lbl_participa").html("Participación (*):");
		$("#lbl_revisado").html("Indexado (*):");
		
	}
	if ($("#pub_tipo").val()=="LIBRO"){
		$("#lbl_libro").html("Nombre del libro (*):");
		$("#lbl_editorial").html("Editorial (*):");
		$("#lbl_participa").html("Participación en el libro (*):");
		$("#lbl_revisado").html("Revisado por pares (*):");
			$("#bdd").hide();
		    $("#doi").hide();
	}
	
}
function revisado(){
     
	if ($("#pub_tipo").val()=="ARTICULO"){	
		if ($("#pub_revisado").val()=="SI"){	
			
			$("#bdd").show();
		    $("#doi").show();
			
		}
		else{
			$("#bdd").hide();
		    $("#doi").hide();
			
		}
	}
	if ($("#pub_tipo").val()=="LIBRO"){
		$("#bdd").hide();
		$("#doi").hide();
	}
	
}
function tcapacitacion(){
	tabla=$('#tcapacitacion').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		
		"ajax":
		{
			url:'../ajax/hojadevida.php?op=listarcap',
			type: "POST",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
	
}
function tpublicaciones(){
	tabla=$('#tpublicaciones').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		
		"ajax":
		{
			url:'../ajax/hojadevida.php?op=listarpub',
			type: "POST",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
	
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/hojadevida.php?op=guardaryeditardoc",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
			var val = datos.split("*");
			if (val[1]==1){
				bootbox.alert("Datos personales ingresados con exito sin foto");
			    bootbox.alert("TAMAÑO DE LA FOTO MUY GRANDE");
			}
			else
			    bootbox.alert("Datos personales ingresados con exito");
			
			
			
     	}
     });

     //limpiar();
}
function guardaryeditara(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formularioa")[0]);

     $.ajax({
     	url: "../ajax/hojadevida.php?op=guardaryeditaraca",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		//bootbox.alert(datos);
				bootbox.alert("Datos de instrución ingresados con exito");
                limpiarint();
     	}
     });
     
    
}
function guardaryeditare(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formularioe")[0]);

     $.ajax({
     	url: "../ajax/hojadevida.php?op=guardaryeditarexp",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     	     	bootbox.alert("Datos de experiencia ingresados con exito");
                limpiarexp();
     	}
     });
     
    
}
function guardaryeditarc(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formularioc")[0]);

     $.ajax({
     	url: "../ajax/hojadevida.php?op=guardaryeditarcap",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     			bootbox.alert("Datos de capacitación ingresados con exito");
                limpiarcap();
     	}
     });
     
    
}
function guardaryeditarp(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulariop")[0]);

     $.ajax({
     	url: "../ajax/hojadevida.php?op=guardaryeditarpub",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     			bootbox.alert("Datos de publicaciones ingresados con exito");
                limpiarpub();
		}
     });
     
    
}
function limpiarint() {
	$("#ins_nombre").val("");
    $("#ins_titulo").val("");
    $("#ins_registro").val("");
    $("#ins_fecha").val("");
     tinstruccion();
}
function limpiarexp() {
	$("#exp_institucion").val("");
    $("#exp_cargo").val("");
    $("#exp_fini").val("");
    $("#exp_ffin").val("");
	 $("#exp_telefono").val("");
	 texperiencia();
    
}
function limpiarcap() {
	$("#cap_tema").val("");
    $("#cap_institucion").val("");
    $("#cap_fini").val("");
    $("#cap_ffin").val("");
	$("#cap_cap_horas").val("");
	tcapacitacion();
    
}
function limpiarpub() {
	$("#pub_nombre").val("");
    $("#pub_editorial").val("");
    $("#pub_fecha").val("");
    $("#pub_isbn").val("");
	$("#pub_participa").val("");
	$("#pub_doi").val("");
	tpublicaciones();
    
}
function imprimehojadevida(){
	 window.open("../reportes/rpt_hojadevida.php", 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
                      
	// $('#reporte').attr("src", $('#reporte').attr("src"));
	// $("#reporte").show();
	}
function imprimehojadevidaA(){
	 window.open("../reportes/rpt_hojadevidaA.php?usu="+$("#id_docente").val(), 'HOJA DE VIDA', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');

	}
   init();


