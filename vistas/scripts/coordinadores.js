var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(true);
   listar();
 
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   }) 
   $("#ingmateria").on("submit",function(e){
	 guardarmateria(e);
   }) 
     //cargamos los items al select proveedor
   $.post("../ajax/coordinadores.php?op=combo_periodos", function(r){
   	$("#cat_id_periodo").html(r);
   	$('#cat_id_periodo').selectpicker('refresh');
   });

 //cargamos los items al select proveedor
   $.post("../ajax/coordinadores.php?op=combo_docentes", function(r){
   	$("#id_docente").html(r);
   	$('#id_docente').selectpicker('refresh');
   });
 
}
   
   

//funcion limpiar
function limpiar(){
	$("#acta_id").val("");
	$("#acta_fecha").val("");
	$("#acta_recibe").val("");
	$("#acta_entrega").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	
	if(flag){
		$("#listadoregistros").show();
		$("#horario").hide();
		//$("#listadoregistros").hide();
		//$("#btnGuardar").prop("disabled",false);
	//$("#myModal").modal('hide');
		
	}else{
		$("#horario").show();
		
		//$("#btnagregar").hide();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	location.href ="../vistas/escritorio.php";
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
			url:'../ajax/coordinadores.php?op=listar',
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
//funcion listar
function horario(idhorario,docente){
	   // $('#nombredoc').val(docente);
	   if (isNaN(docente)) {
			$('#nombredoc').val(docente);
		  
	   }
	   else{
		    $.post("../ajax/coordinadores.php?op=docente&docente="+docente, function(r){
     			$('#nombredoc').val(r);
			});
	   }
			
	
		tabla=$('#tblhorario').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                   {
                 text: 'Imprimir Horario',
                 action: function ( e, dt, node, config ) {
					 window.open('../reportes/rpt_horarioindi.php?idhor='+idhorario, 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=600,left = 390,top = 50');
                     
                }
            }
		],
		"ajax":
		{
			url:'../ajax/coordinadores.php?op=horario&idh='+idhorario,		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0,"asc"]]//ordenar (columna, orden)
		
	}).DataTable();	

}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar"type: "POST",).prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/coordinadores.php?op=guardaryeditar",
        type: "POST",	
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		
			bootbox.alert('Datos registrados correctamente');
			var info = datos.split('*');
		//	horario(info[0],docente[1]);
   		    //if(datos=='Datos registrados correctamente'){
			location.href ="../vistas/coordinadores.php"					
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
     	url: "../ajax/coordinadores.php?op=guardarmateria",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		
			bootbox.alert(datos);
		//	var info = datos.split('*');
		//	horario(info[0],docente[1]);
   		    if(datos=='Datos registrados correctamente'){
			 location.href ="../vistas/coordinadores.php"					
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
			$.post("../ajax/coordinadores.php?op=eliminar", {idhorario : idhorario}, function(e){
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

function ingresa_hora(id,dia,mate){
	   //cargamos los items al select materias
    $.post("../ajax/coordinadores.php?op=combo_materia", function(r){
		$("#idmateria").html(r);
		$('#idmateria').selectpicker('refresh');
		 $('#idmateria').selectpicker('val', mate);
		
	});
	
	$.post("../ajax/coordinadores.php?op=combo_aulas", function(r){
   	$("#idaula").html(r);
   	$('#idaula').selectpicker('refresh');
     });
	//alert(id+" "+dia);
	 $('#hhorario').val(id);
	 $('#dhorario').val(dia);
	
	 $('#DataEdit').modal('toggle');
	
}

function elimina_hora(id,dia){
    bootbox.confirm("¿Esta seguro de eliminar este dato?" , function(result){
    if (result) {
		$.post("../ajax/coordinadores.php?op=eliminarm" , {hhorario: id, dhorario:dia}, function(e){
		location.href ="../vistas/coordinadores.php"		
		});
	}
	})
}

function imprimir(){
	$("#print").printArea();
}

init();
