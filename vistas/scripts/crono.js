var tabla;

//funcion que se ejecuta al inicio
function init(){
   listar();
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   }) 
   $("#ingmateria").on("submit",function(e){
	 guardarmateria(e);
   }) 
 	
	$.post("../ajax/coordinadores.php?op=combo_docentes", function(r){
   	$("#docente").html(r);
   	$('#docente').selectpicker('refresh');
	
	$.post("../ajax/crono.php?op=combo_gestores", function(r){
   	$("#gestoria").html(r);
   	$('#gestoria').selectpicker('refresh');
   });
   });
}
   
   


//funcion listar
function listar(){
     tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                 
		],
		"ajax":
		{
			url:'../ajax/crono.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/crono.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,
     	success: function(datos){    
		//		bootbox.alert(datos);

			bootbox.alert('Datos registrados correctamente');
		//	var info = datos.split('*');
		//	horario(info[0],docente[1]);
   		    //if(datos=='Datos registrados correctamente'){
		//	location.href ="../vistas/coordinadores.php"					
			//}  enviar por get y cargar horario
     		//$("#horario").show();
     		//tabla.ajax.reload();
		  //location.href ="../vistas/ingreso.php";
     	}
     });
     
   //  limpiar();
}

function guardarmateria(e){
     
	 e.preventDefault();//no se activara la accion predeterminada 
	
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#ingmateria")[0]);

     $.ajax({
     	url: "../ajax/ingreso.php?op=guardarmateria",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		
			bootbox.alert(datos);
		//	var info = datos.split('*');
		//	horario(info[0],docente[1]);
   		   if(datos=='Datos registrados correctamente'){
			 location.href ="../vistas/ingreso.php"					
			}  
     		//$("#horario").show();
     		//tabla.ajax.reload();
		  //location.href ="../vistas/ingreso.php";
     	}
     });
     
   //  limpiar();
}

//funcion para desactivar
function eliminar(idhorario){
	bootbox.confirm("¿Esta seguro de eliminar el Horario?", function(result){
		if (result) {
			$.post("../ajax/ingreso.php?op=eliminar", {idhorario : idhorario}, function(e){
				//bootbox.alert(e);
				listar();
			});
		}
	})
}

function activar(idarticulo){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/articulo.php?op=activar" , {idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function ingresa_hora(id,dia){
//alert(id+" "+dia);
 $('#hhorario').val(id);
 $('#dhorario').val(dia);
 $('#DataEdit').modal('toggle');
}

function elimina_hora(id,dia){
    bootbox.confirm("¿Esta seguro de eliminar este dato?" , function(result){
    if (result) {
		$.post("../ajax/coordinadores.php?op=eliminarm" , {hhorario: id, dhorario:dia}, function(e){
		location.href ="../vistas/ingreso.php"		
		});
	}
	})
}

function imprimir(){
	$("#print").printArea();
}

init();
