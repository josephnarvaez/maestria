var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(true);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })
    //cargamos los items al celect categoria
    $.post("../ajax/ingreso.php?op=combo_ubicacion", function(r){
   	$("#cat_id").html(r);
   	$('#cat_id').selectpicker('refresh');
   });
}

//funcion limpiar
function limpiar(){
	$("#cat_id").val("");
	$("#act_id").val("");
	$("#act_detalle").val("");
    $("#act_cyachay").val("");
	$("#cat_id_a").val("");
	$("#yachay").val("");
}

function verificaacta(){
	
	$.post("../ajax/ingreso.php?op=mostrar&id="+$("#act_id").val(),function(r){
	   // alert(r);
		$("#act_detalle").val(r.split('*')[0].slice(1,100));		
		var largo = r.split('*')[4].length-1;
		$("#cat_id_a").val(r.split('*')[1]);	
		$("#act_cyachay").val(r.split('*')[2]);
		$("#yachay").val(r.split('*')[2]);
		$("#usu_nombre").val(r.split('*')[4].slice(0,largo));
	});
	
}
function verificaacta1(){
	//alert($("#act_id").val().length)
	if ($("#act_id").val().length==0){
	$.post("../ajax/ingreso.php?op=mostrar1&id="+$("#yachay").val(),function(r){
	   // alert(r);
		$("#act_detalle").val(r.split('*')[0].slice(1,100));		
		var largo = r.split('*')[4].length-1;		
		$("#cat_id_a").val(r.split('*')[1]);			
		$("#act_cyachay").val(r.split('*')[3]);
	    $("#act_id").val(r.split('*')[3]);
		$("#usu_nombre").val(r.split('*')[4].slice(0,largo));
	})
	}
}



//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/categoria.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":15,//paginacion
		"order":[[0]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/ingreso.php?op=modificaru",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(true);
     	
     	}
     });

     limpiar();
}

function mostrar(idcategoria){
	$.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#nombre").val(data.nombre);
			$("#descripcion").val(data.descripcion);
			$("#idcategoria").val(data.idcategoria);
		})
}


//funcion para desactivar
function desactivar(idcategoria){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idcategoria){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/categoria.php?op=activar" , {idcategoria : idcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();
