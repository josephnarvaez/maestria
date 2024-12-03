var tabla;

//funcion que se ejecuta al inicio
function init(){
   listar();
 
   $("#formulario").show();
   $("#rfechas").daterangepicker({
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " al ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
      
        "opens": "center"
    });
	
	
   $("#rhoras").daterangepicker({
     "timePicker": true,
	 "timePicker24Hour": true,
	 "showDropdowns":false,
	 "locale": {		    
            "format": "YYYY-MM-DD HH:mm",
            "separator": " al ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
      
        "opens": "center"
});
   
   $.post("../ajax/vacaciones.php?op=combo_motivos", function(r){
       $("#cat_id_motivo").html(r);
   	   $('#cat_id_motivo').selectpicker('refresh');
   });
	$.post("../ajax/vacaciones.php?op=saldo", function(r){
       $("#saldo").html(r);   	 
   });
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });
}



//funcion limpiar
function limpiar(){

	$("#nombre").val("");
	$("#num_documento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#idpersona").val("");
}


function imprimepermiso(inf_id){
	 window.open("../reportes/rpt_permiso.php?inf="+inf_id, 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
                      
	// $('#reporte').attr("src", $('#reporte').attr("src"));
	// $("#reporte").show();
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
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/vacaciones.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,
     	success: function(datos){
     	//	bootbox.alert("Ingresados exitoso Imprima documento para su Entrega");
	   //	bootbox.alert(datos);
			listar();
			 window.open("../reportes/rpt_permiso.php?inf="+datos, 'Nombre de la ventana', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
                      
     	
     	}
     });

     limpiar();
}

init();