var tabla;

//
//funcion que se ejecuta al inicio
function init(){
  $("#formulario").on("submit",function(e){
	 guardaryeditar(e);
   });
	
$.post("../ajax/giras.php?op=docentes", function(r){
	$("#gdocentes").html(r);
});
}



//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
    // $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/giras.php?op=guardar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
	       bootbox.alert("Datos ingresados con exito");
		   window.open("../reportes/rpt_gira.php?id="+datos, 'Reporte de Gira', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');
                      
			
			
     	}
     });

     //limpiar();
}
function imprimehojadevida(){
	alert("saddbnfghj");
      window.open("../reportes/rpt_gira.php?id=21", 'Reporte de Gira', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=700,left = 390,top = 50');

	}
init();


