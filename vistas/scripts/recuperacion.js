var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(true);
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });

  $.post("../ajax/recuperacion.php?op=obtenmaterias", function(r){

   	$("#materias").html(r);
   	$('#materias').selectpicker('refresh');
     });
}

function imprime(){
	 window.open("../reportes/rpt_recuperacion.php", 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
	
                      
	// $('#reporte').attr("src", $('#reporte').attr("src"));
	// $("#reporte").show();
	}
function imprimeinforme1(inf_id){
	 window.open("../reportes/rpt_infomesr.php?inf="+inf_id, 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
	
                      
	// $('#reporte').attr("src", $('#reporte').attr("src"));
	// $("#reporte").show();
	}
function presentainforme(inf_id,periodo,mess){
	 
	    $('#informes').hide();
	     $('#periodo').val(periodo);
	
	     $("#actividades").show();
		 var totalAmount = 0;
	    tabla=$('#tblmaterias').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		bFilter: false, bInfo: false,
		"bPaginate": false, //Ocultar paginación
		buttons: [
         
		],
		"ajax":
		{
			url:'../ajax/recuperacion.php?op=obtenmaterias',		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}			
		},
		"bDestroy":true ,
		"footerCallback": function (row, data, start, end, display) {          
           for (var i = 0; i < data.length; i++) {
					var vec =data[i][2].split('>');
					var vec1 = vec[1].split('<');	
                    totalAmount += parseFloat(vec1[0]);
									
                }
				 $('#docencia').val(totalAmount);
	      }
		
		
	}).DataTable();	
	
	
    $("#otras").show();
		tabla=$('#otras').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		bFilter: false, bInfo: false,
		"bPaginate": false, //Ocultar paginación
		buttons: [
         
		],
		"ajax":
		{
			url:'../ajax/informes.php?op=otras&idinfo='+inf_id,		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true
		
	}).DataTable();	
	
	//investiga
	$.get("../ajax/informes.php",{ op: 'resto', op1: 1, tipo:0, idinfo:inf_id},
		function(data,status)
		{
	
			data=JSON.parse(data);
		    var vec =data.split('&');
			//mostrarform(true);
		   
		    $("#invcarreras").val(vec[0]);
			$("#invproyectos").val(vec[1]);
			$("#invhoras").val(vec[2]);
			$("#invobj").val(vec[3]);
			
		});
		$.get("../ajax/informes.php",{ op: 'resto', op1: 1, tipo:1, idinfo:inf_id},
		function(data,status)
		{
	
			data=JSON.parse(data);
		    var vec =data.split('&');
			//mostrarform(true);
		   
		    $("#gcarreras").val(vec[0]);
			$("#gproyectos").val(vec[1]);
			$("#ghoras").val(vec[2]);
			$("#gobj").val(vec[3]);
			
		});
			$.get("../ajax/informes.php",{ op: 'resto', op1: 1, tipo:2, idinfo:inf_id},
		function(data,status)
		{
	
			data=JSON.parse(data);
		    var vec =data.split('&');
			//mostrarform(true);
		   
		    $("#situaciones").val(vec[0]);
		
			
		});
	    $.get("../ajax/informes.php",{ op: 'resto', op1: 1, tipo:3, idinfo:inf_id},
		function(data,status)
		{
	
			data=JSON.parse(data);
		    var vec =data.split('&');
			//mostrarform(true);
		   
		    $("#acciones").val(vec[0]);
		
			
		});
	
		$("#reporte").attr("src","../reportes/rpt_infomes.php");
	    $("#reporte").show();
		
}

function otras_actividades(){		 
	
	  //  $('#nombredoc').val(docente);
	    $("#otras").show();
		tabla=$('#otras').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		bFilter: false, bInfo: false,
		"bPaginate": false, //Ocultar paginación
		buttons: [
         
		],
		"ajax":
		{
			url:'../ajax/informes.php?op=otras&idinfo=0',		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true
		
	}).DataTable();	

}
function traer_recuperacion(){
 //  $('#nombredoc').val(docente);
       
        $("#actividades").show();
		tabla=$('#tblmaterias').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		bFilter: false, bInfo: false,
		"bPaginate": false, //Ocultar paginación
		buttons: [
         
		],
		"ajax":
		{
			url:'../ajax/recuperacion.php?op=imforme',		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		
	}).DataTable();	

}

function traer_informes(){
 //  $('#nombredoc').val(docente);
        $("#informes").show();
		tabla=$('#tblinformes').dataTable({
		"aProcessing": true,//activaidhorariomos el procedimiento del datatable
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		bFilter: false, bInfo: false,
		"bPaginate": false, //Ocultar paginación
		buttons: [
         
		],
		"ajax":
		{
			url:'../ajax/informes.php?op=informes&periodo='+$("#periodo").val(),		    
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true		
		
	}).DataTable();	

}
function limpiar(){
	$("#fechap").val("");
	$("#fechar").val("");
	$("#tema").val("");
	$("#rhoras").val("");
	$("#obj").val("");	
}

//funcion mostrar formulario
function mostrarform(flag){
	//materias();
//	limpiar();
	if(flag){
		$("#actividades").hide();
		$("#otras").hide();
		$("#informes").hide();
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
	location.href ="../vistas/escritorio.php";
}



//funcion para guardaryeditar

function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     //$("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);
     $.ajax({
     	url: "../ajax/recuperacion.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){

			if(datos!=0){
			 alert("Datos Ingresados Correctamente");	
	                      
			}
			else
			 alert("Error al Ingresar Datos");	
			
     		//mostrarform(true);
     	//	listar();
     	}
     });

     limpiar();
	traer_recuperacion();
}






init();