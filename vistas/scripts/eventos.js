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
     var //cad="&cedula="+$("#cedula").val()+"&nombres="+$("#nombres").val()+"&apellidos="+$("#apellidos").val()+"&cargo="+$("#cargo").val()+"&telefono="+$("#telefono").val()+"&correo="+$("#correo").val()+"&institucion="+$("#institucion").val()+"&ciudad="+$("#ciudad").val()+"&genero="+$("#genero").val()+"&etnia="+$("#etnia").val();
	 cad="&cedula="+$("#cedula").val()+"&nombres="+$("#nombres").val()+"&apellidos="+$("#apellidos").val()+"&telefono="+$("#telefono").val()+"&correo="+$("#correo").val()+"&ciudad="+$("#ciudad").val()+"&genero="+$("#genero").val()+"&edad="+$("#edad").val();
     $.ajax({
     	url: "../ajax/usuario.php?op=regevento"+cad,
     	type: "GET",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
			if (datos==1){
			bootbox.alert("Ya se encuentra Registrado");	
			} 
			else{
			bootbox.alert("Registro Exitoso");	
				
			}
     	     	}
     });

}



init();