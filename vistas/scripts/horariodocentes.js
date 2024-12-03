// JavaScript Document
 $.post("../ajax/informes.php?op=combo_periodos", function(r){
   	$("#periodo").html(r);
   	$('#periodo').selectpicker('refresh');
     });

function traer_informes(){
	$("#divreporte").show();

	$("#divreporte").html('<embed src="../reportes/rpt_horariosdocentes.php?periodo='+$("#periodo").val()+'" type="application/pdf" id="reporte"  width="100%" height="600px" />');
	
	
	}