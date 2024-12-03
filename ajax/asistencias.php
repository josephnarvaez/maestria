<?php 
require_once "../modelos/asistencias.php";
$informe = new Asistencias();
//$fech=isset($_POST["dia"])? limpiarCadena($_POST["dia"]):"";

function obten_empresa($lat,$lon) {
	   $inf = new Asistencias();
       $rspta=$inf->obten_lasempresas();
	    $ne=0;

		while ($reg=$rspta->fetch_object()) {
			$theta = $lon - $reg->emp_lon;
     		$dist = sin(deg2rad((float)$lat)) * sin(deg2rad((float)$reg->emp_lat)) +  cos(deg2rad((float)$lat)) * cos(deg2rad((float)$reg->emp_lat)) * cos(deg2rad((float)$theta));	    
			$dist = acos($dist);
			$dist = rad2deg($dist);
		    $dist = $dist * 1000;
		
			if (round($dist,2)<0.1){
				return $reg->emp_nombre;
                  				
			}
			else{
				 if (round($dist,2)<2){
				    
				 	 if ($reg->emp_nombre=="IST 17 DE JULIO IBARRA" or $reg->emp_nombre=="IST 17 DE JULIO YACHAY" ){
			                return $reg->emp_nombre;
						   
				        }
				 }
      		}
			
		}
	  return -1;
	/*
			if ($reg->emp_nombre<>"IST 17 DE JULIO IBARRA" and $reg->emp_nombre<>"IST 17 DE JULIO YACHAY" ){
					if (round($dist,2)<0.1){
			           return $reg->emp_nombre;
					}
			}
			else { 
			     if (round($dist,2)<2){
			           return $reg->emp_nombre;
				 }
			}
		}
	  */       
    }


if (strlen(session_id())<1) 
	session_start();


switch ($_GET["op"]) {
	case 'guardaryeditar':	    	    
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],0); //0 entradas
		$data=Array();
		$i=0;
		$j=0;	
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp<>"IST 17 DE JULIO IBARRA" and $emp<>"IST 17 DE JULIO YACHAY" ){
				$data[$i][0]=$reg->usu_id;
				$data[$i][1]=$reg->usu_nombre;
				$data[$i][2]=$reg->fecha;
				$data[$i][3]="";
				$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
				if ($emp=='-1')
					$data[$i][4]="EMPRESA NO REGISTRADA";
				else 
					$data[$i][4]=$emp;
				$data[$i][5]=$reg->empresa;
				 $i++;	
			  }
		    }
			
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],1); //1 salidas
		$bandera=0;
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp<>"IST 17 DE JULIO IBARRA" and $emp<>"IST 17 DE JULIO YACHAY" ){
			  $bandera=0;
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][4]){
						   $data[$k][3]= $reg->fecha;
						   $data[$k][5]=$data[$k][5]." ".$reg->empresa;
						   $bandera=1;
						  }						  				  
					}
			   if ($bandera==0){
						  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]=$reg->fecha;
						  if ($emp=='-1')
								$data[$i][4]="EMPRESA NO REGISTRADA";
						  else 
								$data[$i][4]=$emp;
						  $data[$i][5]=$reg->empresa;
						  $i++;	
						 }		
						

			  }
		    }

	
        $data1=Array(); 			
		for	($j=0; $j<$i; $j++){
			$data1[$j]=array(             
		    "0"=>$data[$j][1],
	        "1"=>$data[$j][2],
            "2"=>$data[$j][3],
			"3"=>$data[$j][4],
			"4"=>$data[$j][5]
            );
		  }
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data1),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data1),//enviamos el total de registros a visualizar
             "aaData"=>$data1); 
	   
	    echo json_encode($results);
		break;     
	

	case 'asistenciaist':
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],0); //0 entradas
		$data=Array();
		$i=0;
		$j=0;	
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY" ){
				$data[$i][0]=$reg->usu_id;
				$data[$i][1]=$reg->usu_nombre;
				$data[$i][2]=$reg->fecha;		
				$data[$i][3]="";
				$data[$i][4]="";
				$data[$i][5]="";	
				$data[$i][6]=$emp;
				if(strlen($reg->empresa)==0)
					$data[$i][7]=" ";
				else
				    $data[$i][7]=$reg->empresa;			
				 $i++;	
			  }
		    }
		
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],1); //1 salidas
		$bandera=0;
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY" ){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][5]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						   $k=$i;
						  }		
					  		
				     }			
				 if ($bandera==0 ){
						  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]="";
				          $data[$i][4]="";	
				     	  $data[$i][5]=$reg->fecha;
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }	 	
			  }
		    }
	  $rspta=$informe->obten_asistencias(1,$_GET['dia'],1); //1 salidas almuerzo
		$bandera=0;
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY" ){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][3]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						   $k=$i;
						  }					     				
						}	
					  if ($bandera==0 ){
					  	  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]=$reg->fecha;
				          $data[$i][4]="";	
				     	  $data[$i][5]="";
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }					
				 
			  }
		    }
	   $rspta=$informe->obten_asistencias(1,$_GET['dia'],0); //0 entrada almuerzo
		$bandera=0;
		
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if ($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY" ){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][4]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						  $k=$i;
						  }	
						 		
						}		
						 	 if ($bandera==0 ){
					  	  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]="";
				          $data[$i][4]=$reg->fecha;	
				     	  $data[$i][5]="";
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }	  			
			
			  }
		    }
        $data1=Array(); 			
		for	($j=0; $j<$i; $j++){
			$data1[$j]=array(             
		    "0"=>$data[$j][1],
	        "1"=>$data[$j][2],
            "2"=>$data[$j][3],
			"3"=>$data[$j][4],
			"4"=>$data[$j][5],
			"5"=>$data[$j][6],
			"6"=>$data[$j][7]
            );
		  }
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data1),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data1),//enviamos el total de registros a visualizar
             "aaData"=>$data1); 
	   
	    echo json_encode($results);
		
		break;
	case 'asistenciaist1':
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],0); //0 entradas
		$data=Array();
		$i=0;
		$j=0;	
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if (($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY") and $reg->usu_id==$_SESSION['usu_id']){
				
				$data[$i][0]=$reg->usu_id;
				$data[$i][1]=$reg->usu_nombre;
				$data[$i][2]=$reg->fecha;		
				$data[$i][3]="";
				$data[$i][4]="";
				$data[$i][5]="";	
				$data[$i][6]=$emp;
				if(strlen($reg->empresa)==0)
					$data[$i][7]=" ";
				else
				    $data[$i][7]=$reg->empresa;			
				 $i++;	
			  }
		    }
		
		$rspta=$informe->obten_asistencias(0,$_GET['dia'],1); //1 salidas
		$bandera=0;
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if (($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY") and $reg->usu_id==$_SESSION['usu_id']){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][5]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						   $k=$i;
						  }		
					  		
				     }			
				 if ($bandera==0 ){
						  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]="";
				          $data[$i][4]="";	
				     	  $data[$i][5]=$reg->fecha;
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }	 	
			  }
		    }
	  $rspta=$informe->obten_asistencias(1,$_GET['dia'],1); //1 salidas almuerzo
		$bandera=0;
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if (($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY") and $reg->usu_id==$_SESSION['usu_id']){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][3]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						   $k=$i;
						  }					     				
						}	
					  if ($bandera==0 ){
					  	  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]=$reg->fecha;
				          $data[$i][4]="";	
				     	  $data[$i][5]="";
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }					
				 
			  }
		    }
	   $rspta=$informe->obten_asistencias(1,$_GET['dia'],0); //0 entrada almuerzo
		$bandera=0;
		
		while ($reg=$rspta->fetch_object()) {
			$bandera=0;
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			if (($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY") and $reg->usu_id==$_SESSION['usu_id']){
				for($k=0; $k<$i; $k++){
					  if ($data[$k][0]==$reg->usu_id and $emp==$data[$k][6]){
						   $data[$k][4]=$reg->fecha;
						   $data[$k][7]=$data[$k][7]." ".$reg->empresa;
						   $bandera=1;
						  $k=$i;
						  }	
						 		
						}		
						 	 if ($bandera==0 ){
					  	  $data[$i][0]=$reg->usu_id;
						  $data[$i][1]=$reg->usu_nombre;
						  $data[$i][2]="";
						  $data[$i][3]="";
				          $data[$i][4]=$reg->fecha;	
				     	  $data[$i][5]="";
						  $data[$i][6]=$emp;
						  $data[$i][7]=$reg->empresa;
						  $i++;	
						 }	  			
			
			  }
		    }
        $data1=Array(); 			
		for	($j=0; $j<$i; $j++){
			$data1[$j]=array(             
		    "0"=>$data[$j][1],
	        "1"=>$data[$j][2],
            "2"=>$data[$j][3],
			"3"=>$data[$j][4],
			"4"=>$data[$j][5],
			"5"=>$data[$j][6],
			"6"=>$data[$j][7]
            );
		  }
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data1),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data1),//enviamos el total de registros a visualizar
             "aaData"=>$data1); 
	   
	    echo json_encode($results);
		
		break;
	case 'infoempresas':
		//$_GET['fecha']
		$rspta=$informe->obten_asistencias(6,$_GET['fechar'].'+'.$_SESSION["usu_id"],0); //0 entradas
		$data=Array();
		$i=0;
		$j=0;		
	//	echo obten_empresa(0.2291408221, -78.2610737449);
	//	echo obten_empresa(0.4046745712,	-78.1804390148);
		
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
		//	echo $emp;
			if (($emp<>"IST 17 DE JULIO IBARRA" and $emp<>"IST 17 DE JULIO YACHAY")){ //$_SESSION['usu_id']
			  
				$data[$i][0]=$reg->reg_id;
				$data[$i][1]="";
				if ($emp=='-1')
					$data[$i][2]="EMPRESA NO REGISTRADA";
				else 
					$data[$i][2]=$emp;
				$data[$i][3]=$reg->fecha;		
				$data[$i][4]="";
				$data[$i][5]=$reg->reg_lat.", ".$reg->reg_lon;
			    $i++;	
			  }
	      }
		
	    $rspta=$informe->obten_asistencias(6,$_GET['fechar'].'+'.$_SESSION["usu_id"],1); //1 salidas
	    $bandera=0;

//	echo obten_empresa(0.4048105017,	-78.1799628499);
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);
			
		if ($emp<>"IST 17 DE JULIO IBARRA" and $emp<>"IST 17 DE JULIO YACHAY" ){
			  $bandera=0;
				for($k=0; $k<$i; $k++){
					  if ($emp==$data[$k][2]){
						   $data[$k][4]= $reg->fecha;
						   $data[$k][1]=$reg->reg_id;
						   $bandera=1;
						  }						  				  
					}
			   if ($bandera==0){
						  $data[$i][0]="";
					      $data[$i][1]=$reg->reg_id;
						  if ($emp=='-1')
								$data[$i][2]="EMPRESA NO REGISTRADA";
						  else 
								$data[$i][2]=$emp;
				          
						  $data[$i][3]="";
						  $data[$i][4]=$reg->fecha;
				          $data[$i][5]=$reg->reg_lat.", ".$reg->reg_lon;
			    
						  $i++;	
						 }		
						

			  }

        }
		$_SESSION["temp"]=$i;
		$tabla='<table width="1000" border="0"> <tbody>';
		for ($j=0; $j<$i; $j++){
			$tabla=$tabla.'<tr>
      <td><strong><label>Empresa:</label></strong></td>
      <td colspan="2"><input name="emp'.$j.'" id="emp'.$j.'" type="text"  size="50" value="'.$data[$j][2].'" readonly ></input></td>
     
	  <input name="f" id="f" type="text"  size="50" value="'. $_GET['fechar'].'" hidden ></input>
      <td><strong><label>Coordenadas:</label></strong></td>
      <td><input name="coo'.$j.'" id="coo'.$j.'" type="text"  size="30" value="'.$data[$j][5].'" readonly ></input></td>
    </tr>
    <tr>
      <td><strong><label>Hora inicio:</label></strong></td>
      <td><input name="hi'.$j.'" id="hi'.$j.'" type="text"  size="5" value="'.$data[$j][3].'" readonly ></td>
      <td>&nbsp;</td>
      <td><strong><label>Hora Fin:</label></strong></td>
      <td><input name="hf'.$j.'" id="hf'.$j.'" type="text"  size="5" value="'.$data[$j][4].'" readonly ></td>
    </tr>
    <tr>
      <td><strong><label>Asunto:</label></strong></td>
      <td> <select name="va'.$j.'" id="va'.$j.'" >
    <option>ACERCAMIENTO</option>
    <option>VISITA</option>
  </select>
	 
      <td>&nbsp;</td>
      <td><label>Ids:</label></td>
      <td><input name="hid'.$j.'" id="hid'.$j.'" type="text"  size="10" value="'.$data[$j][0].'-'.$data[$j][1].'" readonly ></td>
    </tr>
	<tr><td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td></tr>
    <tr>
      <td><strong ><label font-size:"8px">ESTUDIANTES / OBSERVACIONES</label></strong></td>
      <td><strong><label>ACTIVIDADES REALIZADAS</label></strong></td>
      <td><strong><label>DEBILIDADES ENCONTRADAS</label></strong></td>
      <td><strong><label>FORTALEZAS ENCONTRADAS</label></strong></td>
      <td><strong><label>SUGERENCIAS</label></strong></td></font>
    </tr>
			 <tr>
      <td><textarea name="es'.$j.'" id="es'.$j.'"  rows="5" cols="25"></textarea></td>
      <td><textarea name="ac'.$j.'" id="ac'.$j.'"  rows="5" cols="25"></textarea></td>
		<td><textarea name="de'.$j.'" id="de'.$j.'"  rows="5" cols="25"></textarea></td>
      <td><textarea name="fo'.$j.'" id="fo'.$j.'"  rows="5" cols="25"></textarea></td>
		<td><textarea name="su'.$j.'" id="su'.$j.'"  rows="5" cols="25"></textarea></td>
      
    </tr>
	<tr bgcolor="#808080"><td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td></tr>';
			
		}
        $tabla=$tabla.'</tbody></table>';
	    echo $tabla;
			//json_encode($data[0][0]);
		
		break;
	
	/*case 'informes':
		$rspta=$informe->obten_informes(1,$_SESSION['usu_id'],$_GET['periodo']);
		$_SESSION["peri"]=$_GET['periodo'];
	   	$data=Array();
		while ($reg=$rspta->fetch_object()) {
		   	$data[]=array(
        	"0"=>'<p align="center"><button id="sacainfo" type="button" class="btn btn-warning btn-xs" onclick="presentainforme('.$reg->inf_id.','.$reg->cat_id.')"><i class="fa fa-pencil-square-o"></i></button>
			<button id="sacainfo" type="button" class="btn btn-warning btn-xs" onclick="imprimeinforme('.$reg->inf_id.')"><i class="fa fa-list"></i></button>
			</p>',
			"1"=>$reg->inf_mes,
			"2"=>$reg->inf_carreras,
			"3"=>$reg->cat_nombre
	       );
   		$_SESSION['periodotexto']=$reg->cat_nombre;
		

		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;*/
	
	
	case 'combo_periodos':			
			$rspta = $informe->combo(3);
			$op1= '<option value="---">-----</option>';
			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->cat_id.'>'.$reg->cat_nombre.'</option>';
			}
			break;
	case 'resto':			
		$rspta=$informe->obt_ract($_GET['op1'],$_GET['idinfo'],$_GET['tipo']);
		$data1="" ;
		
		while ($reg=$rspta->fetch_row()) {
			$data1=$reg[3].'&'.$reg[4].'&'.$reg[5].'&'.$reg[6];
					
		  }
		echo json_encode($data1);
		break;
	
case 'control':			
  
		  // echo date('N',strtotime('2023-02-03'));
		    $rspta = $informe->obten_control($_GET["hora"],date('N',strtotime($_GET["dia"])));
			$data=Array();
		    $i=0;
    		while ($reg=$rspta->fetch_object()) {
					$data[$i][0]=$reg->usu_id;
		 			$data[$i][1]=$reg->usu_nombre;
					$data[$i][2]="SP";
				    $data[$i][3]="-";
					$data[$i][4]="-";					
					 $i++;	
				  }
		$hora= substr($_GET["hora"], 0, -1);
	    $hora= substr($hora, 1, 13);
    	$rspta=$informe->obten_asistencias(5,$_GET['dia'].'+'.$hora,0); //0 entradas

		$ii=0;
		while ($reg=$rspta->fetch_object()) {
			$emp=obten_empresa($reg->reg_lat,$reg->reg_lon);		
			for ($h=0; $h<$i; $h++){
		     	if($data[$h][0]==$reg->usu_id){
	     //          echo $reg->usu_id;	
  				    if ($emp=="IST 17 DE JULIO IBARRA" or $emp=="IST 17 DE JULIO YACHAY" ){
                        $data[$h][2]=$reg->hora;
						$data[$h][3]=$emp;
						$data[$h][4]=$reg->criterio;	
					  }
					else{
                        $data[$h][2]="FS-".$reg->hora;
						$data[$h][3]="";
						$data[$h][4]=$reg->criterio;
					}
				 	$h=$i;
			    }
				 
			}
				
		}
		$data1=Array(); 			
		for	($j=0; $j<$i; $j++){
			$data1[$j]=array(             
		    "0"=>$data[$j][0],
	        "1"=>$data[$j][1],
            "2"=>$data[$j][2],
			"3"=>$data[$j][3],
				"4"=>$data[$j][4]
			);
		  }
		
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data1),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data1),//enviamos el total de registros a visualizar
             "aaData"=>$data1); 
	  
	    echo json_encode($results);

	 break;	
     case 'gdualidad':
	//    echo $_SESSION['tmaterias'];<br />
        $data="";
		for($i=0; $i<$_SESSION['temp'];$i++)
		  {	
		   // echo $_GET['hid'.$i];
				
			$id=explode("-", $_GET['hid'.$i]);
			//echo $id[0];
			if ($id[0]<>'')
			    $regid=$id[0];
			 else
			    $regid=$id[1];
			//echo "jose luis";
			$rspta = $informe->dualidad(0,$regid,$_GET['f'],$_GET['emp'.$i],$_GET['va'.$i],$_GET['hi'.$i], $_GET['hf'.$i],$_GET['coo'.$i],$_GET['es'.$i],$_GET['ac'.$i],$_GET['de'.$i],$_GET['fo'.$i],$_GET['su'.$i]);
			//echo $rspta ;

			
		  }
		echo $_GET['f']; 
		//echo $data; */
		break;  
	case 'atrasos':
	 	$date1 = new DateTime($_GET["dia"]);
      
		$rspta=$informe->historico(1,$_GET["dia"],$_GET["dia"],0);//$_SESSION["inf"]);
		$i=0;
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
			"0"=>$i+1,
			"1"=>$reg->usu_nombre,
			"2"=>$reg->his_entrada,
			"3"=>$reg->his_tiempo,
			"4"=>$reg->his_sede,
			"5"=>acentos($reg->his_observaciones));	
			$i++;
		  }	
	
		$data[$i]=array(             
		    "0"=>"",
	        "1"=>"",
            "2"=>"",
			"3"=>"",
			"4"=>"",
			"5"=>"");
		
		$i++;
		$data[$i]=array(             
		    "0"=>"",
	        "1"=>"<H4>NO REGISTRAN PICADA</H4>",
            "2"=>"-----",
			"3"=>"-----",
			"4"=>"-----",
			"5"=>"-----");
		
		$i++;
		$j=1;
		$rspta=$informe->historico(2,$_GET["dia"],$_GET["dia"],0);//$_SESSION["inf"]);
		while ($reg=$rspta->fetch_object()) {
			$data[$i]=array(
			"0"=>$j,
			"1"=>$reg->usu_nombre,
			"2"=>"",
			"3"=>"",
			"4"=>"",
			"5"=>"");	
			$i++;
			$j++;
		  }	
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	   
	    echo json_encode($results);
		break;  
	
}
function acentos($cadena) 
{
   $search = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü");
   $replace = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}
 ?>