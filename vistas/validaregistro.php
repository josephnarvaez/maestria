<?php 
//activamos almacenamiento en el buffer
ob_start();
 ?>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VALIDADOR DE REGISTRO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->

<!-- DATATABLES-->
<link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../public/css/bootstrap-select.min.css">
<link rel="stylesheet" href="../public/css/daterangepicker.css">
</head>
<body class="hold-transition skin-blue sidebar-mini " >


  

<div >
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">

<!--box-header-->
<!--centro-->


<div class="panel-body" id="formularioregistros">
<div class="form-group col-lg-12 col-md-12 col-xs-12" align="center"><h1>ASISTENCIA AL EVENTO</h1></div>
<div class="form-group col-lg-12 col-md-12 col-xs-12" align="center"><img src="../files/img/istanti.jpeg" width="182" height="151" alt=""/><img src="../files/img/entrenamiento.png" width="302" height="144" alt=""/></div>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
	<form action="" name="fevento" id="fevento" method="GET">
	  <div class="form-group col-lg-12 col-md-12 col-xs-12" align="center" >
      <label for="" >Cédula(*):</label>      
      <input  name="cedula" type="text" required   id="cedula"   placeholder="Cédula" size="20" >
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
      <button class="btn btn-primary" type="submit" id="btnGuardar" ><i class="fa fa-save"></i>  Guardar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

<script src="../public/js/jquery.min.js"></script>
<script src="../public/js/moment.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../public/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- AdminLTE App -->
<script src="../public/js/adminlte.min.js"></script>
<script src="../public/js/daterangepicker.js"></script>

<script src="../public/datatables/buttons.colVis.min.js"></script>
<script src="../public/datatables/buttons.html5.min.js"></script>
<script src="../public/datatables/dataTables.buttons.min.js"></script>
<script src="../public/datatables/jquery.dataTables.min.js"></script>
<script src="../public/datatables/jszip.min.js"></script>

<script src="../public/datatables/pdfmake.min.js"></script>
<script src="../public/datatables/vfs_fonts.js"></script>
<script src="../public/datatables/datatables.min.js"></script>
<script src="../public/js/bootbox.min.js"></script>
<script src="../public/js/bootstrap-select.min.js"></script>

<script src="scripts/hmac-sha256.js"></script>
 <script src="scripts/validaregistro.js"></script>
 <?php 


ob_end_flush();
  ?>
