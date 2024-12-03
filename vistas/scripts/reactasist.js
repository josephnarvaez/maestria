var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(true);
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });

  
}

//funcion limpiar
function limpiar(){

	$("#idcliente").val("");
	$("#cliente").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#impuesto").val("");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");

	//obtenemos la fecha actual
	var now = new Date();
	var day =("0"+now.getDate()).slice(-2);
	var month=("0"+(now.getMonth()+1)).slice(-2);
	var today=now.getFullYear()+"-"+(month)+"-"+(day);
	$("#fecha_hora").val(today);

	//marcamos el primer tipo_documento
	$("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');

}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarActivos();

		$("#btnGuardar").show();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();
		$("#reporte").hide();


	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	//mostrarform(false);
}


function verificaacta(){
	
	$.post("../ajax/actasist.php?op=listarDetalle&id="+$("#ist_ref").val(),function(r){
		var posicion = r.indexOf('class="filas"');
		if (posicion>0){
			$("#detalles").html(r);
			$("#btnGuardar").show();
		}
		else
		    alert('El Acta referencia no existe en la base de datos'); 	
	});
	
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
			url:'../ajax/actasist.php?op=listar',
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

function listarActivos(){
	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../ajax/actasist.php?op=listarActivos',
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

     var formData=new FormData($("#formulario")[0]);  

     $.ajax({
     	url: "../ajax/actasist.php?op=reimpre",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     				
				$('#reporte').attr("src", $('#reporte').attr("src"));
				$("#reporte").show();
		
     	}
     });  		

 
}

function mostrar(idventa){
	$.post("../ajax/actasist.php?op=mostrar",{idventa : idventa},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#idcliente").val(data.idcliente);
			$("#idcliente").selectpicker('refresh');
			$("#tipo_comprobante").val(data.tipo_comprobante);
			$("#tipo_comprobante").selectpicker('refresh');
			$("#serie_comprobante").val(data.serie_comprobante);
			$("#num_comprobante").val(data.num_comprobante);
			$("#fecha_hora").val(data.fecha);
			$("#impuesto").val(data.impuesto);
			$("#idventa").val(data.idventa);
			
			//ocultar y mostrar los botones
			$("#btnGuardar").hide();
			$("#btnCancelar").show();
			$("#btnAgregarArt").hide();
		});
	$.post("../ajax/actasist.php?op=listarDetalle&id="+idventa,function(r){
		$("#detalles").html(r);
	});

}


//funcion para desactivar
function anular(idventa){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/actasist.php?op=anular", {idventa : idventa}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//declaramos variables necesarias para trabajar con las compras y sus detalles
var impuesto=18;
var cont=0;
var detalles=0;


$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto(){
	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
	if (tipo_comprobante=='Factura') {
		$("#impuesto").val(impuesto);
	}else{
		$("#impuesto").val("0");
	}
}

function agregarDetalle(act_id,act_detalle){
   // alert(act_id);
	if (act_id!="") {
	     var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input class="form-control" type="text" name="act_id[]" id="act_id[]" value="'+act_id+'" ></td>'+
        '<td><input class="form-control" type="text" name="act_nombre[]" id="act_nombre[]" value="'+act_detalle+'"></td>'+
        '</tr>';
		cont++;
		detalles++;
		$('#detalles').append(fila);
		evaluar();
		
	}else{
		alert("error al ingresar el detalle, revisar las datos del articulo ");
	}
}

function eliminarDetalle(indice){
$("#fila"+indice).remove();

detalles=detalles-1;

}


function evaluar(){

	if (detalles>0) 
	{
		$("#btnGuardar").show();
	}
	else
	{
		$("#btnGuardar").hide();
		cont=0;
	}
}


init();