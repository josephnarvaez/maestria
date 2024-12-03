var tabla;

//funcion que se ejecuta al inicio
function init(){
  
   $("#botones").hide();
     
     $("#formulario1").on("submit",function(e){
   	guardaryeditar(e);
   });
}







function traer_empresas(op){

    $("#empresas").show();
    $("#fechar").attr("disabled", "disabled");
	 $.ajax({
     	url: "../ajax/asistencias.php?op=infoempresas&fechar="+$('#fechar').val(),
     	type: "POST",
       	contentType: false,
     	processData: false,
     	success: function(datos){
     		$("#empresas").html(datos);
	      //  alert (datos);
     	}
     });

	 $("#botones").show();
     
    
}
function imprime_inf(){

     window.open("../reportes/rpt_dual.php?inf="+$('#fechar').val(), 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
     
    
}
//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                 'excelHtml5'	
		],
		"ajax":
		{
			url:'../ajax/vacaciones.php?op=detallesaldosuni&id='+$('#id').val(),
			type: "GET",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
	
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
	//alert($("#formulario1")[0]);
     var formData=new FormData($("#formulario1")[0]);
    //alert($("#formulario1").serialize());
     $.ajax({
     	url: "../ajax/asistencias.php?op=gdualidad",
     	type: "GET",
     	data: $("#formulario1").serialize(),
     	contentType: false,
     	processData: false,
     	success: function(datos){
		
     	//	bootbox.alert("Ingresados exitoso Imprima documento para su Entrega");
	    ///  	bootbox.alert(datos);
			//listar();
			 window.open("../reportes/rpt_dual.php?inf="+datos, 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
                      
     	
     	}
     });

     limpiar();
	 
}

init();