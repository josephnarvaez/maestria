var tabla;

//funcion que se ejecuta al inicio
function init(){
   $("#fevento").on("submit",function(e){
   	guardaryeditar(e);
   })

}



function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     var formData=new FormData($("#fevento")[0]);
     var cad="&cedula="+$("#cedula").val();
     $.ajax({
     	url: "../ajax/usuario.php?op=validareg"+cad,
     	type: "GET",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
			if (datos==0){
			bootbox.alert("Realice Primero el Registro");	
				$("#cedula").val("");

			} 
			else{
			bootbox.alert("Asistencia Confirmada: "+datos);	
				$("#cedula").val("");
	
			}
     	     	}
     });

}



init();