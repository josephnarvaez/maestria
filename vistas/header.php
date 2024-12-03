 <?php 
if (strlen(session_id())<1) 
  session_start();

  ?>
 <!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PORTAFOLIO DOCENTE</title>
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

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="escritorio.php" class="logo" >
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><font size="4">=></font></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><font size="4">MENU</font></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span><font size="4" style="color:#FFF">PORTAFOLIO DOCENTE</font></span>
        
      </a>
      
      <div class="navbar-custom-menu">
       
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo $_SESSION['usu_nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">             
                <p>                  
               
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
  
                </div>
                <div class="pull-right">
                  <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
</header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
  
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">

<br>
               <?php 

if ($_SESSION['Actas']==1) {
  echo ' <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Opciones de Coordinadores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
			<li><a href="coordinadores.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>           
            <li><a href="aulas.php"><i class="fa fa-circle-o"></i> Disp. Aulas</a></li>
			 <li><a href="ocupacion.php"><i class="fa fa-circle-o"></i> % Ocupación Aulas</a></li>
			<li><a href="cursos.php"><i class="fa fa-circle-o"></i> Horarios Niveles</a></li>         
			<li><a href="crono.php"><i class="fa fa-circle-o"></i> Asig. Responsables</a></li>   
			<li><a href="giras.php"><i class="fa fa-circle-o"></i> Giras</a></li>
          </ul>
        </li>';
}
        ?>
               <?php 
if ($_SESSION['Activos']==1) {
  echo ' <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Opciones de Docente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Horario</a></li>
			<li><a href="informes.php"><i class="fa fa-circle-o"></i> Informe Mensual</a></li>
			<li><a href="recuperacion.php"><i class="fa fa-circle-o"></i> Informe de recuperación</a></li>
				<li><a href="dualidad.php"><i class="fa fa-circle-o"></i> Informe Dualidad</a></li>
            <li><a href="imphorario.php"><i class="fa fa-circle-o"></i> Impresión Horario</a></li>			
			 <li><a href="aulas.php"><i class="fa fa-circle-o"></i> Disp. Aulas</a></li>		
			<li><a href="asistencia_horarioi.php"><i class="fa fa-circle-o"></i> Asistencia Horario</a></li>
     	<li><a href="cliente.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
	<li><a href="hojadevida.php"><i class="fa fa-circle-o"></i> Hoja de vida</a></li>
			<li><a href="asistenciaistpersonal.php"><i class="fa fa-circle-o"></i> Revision Picadas</a></li>
          </ul>
        </li>';
}
        ?>

		             <?php 
if ($_SESSION['TEMP']==1) {
  echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administrativo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="vacacionsaldo.php"><i class="fa fa-circle-o"></i> Saldos Vacaciones Personal</a></li>
			<li><a href="horariodocentes.php"><i class="fa fa-circle-o"></i> Horarios Docentes</a></li>
			<li><a href="hojas.php"><i class="fa fa-circle-o"></i> Hojas de Vida</a></li>
			
		
          </ul>
        </li>';
}
        ?>
		  
               <?php 
if ($_SESSION['Generación']==1) {
  echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administrativo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="controlpersonal.php"><i class="fa fa-circle-o"></i> Imp. Control de personal</a></li>
            <li><a href="asistencia.php"><i class="fa fa-circle-o"></i> Asistencia Empresas	</a></li>
			<li><a href="asistenciaist.php"><i class="fa fa-circle-o"></i> Asistencia IST	</a></li>
			<li><a href="atrazos.php"><i class="fa fa-circle-o"></i> Atrasos x Día</a></li>
			<li><a href="asistencia_horario.php"><i class="fa fa-circle-o"></i> Asistencia Horario</a></li>
			<li><a href="vacacionsaldo.php"><i class="fa fa-circle-o"></i> Saldos Vacaciones Personal</a></li>
			<li><a href="horariodocentes.php"><i class="fa fa-circle-o"></i> Horarios Docentes</a></li>
			<li><a href="hojas.php"><i class="fa fa-circle-o"></i> Hojas de Vida</a></li>
			<li><a href="telefonos.php"><i class="fa fa-circle-o"></i> Uso de Teléfonos</a></li>
			
		
          </ul>
        </li>';
}
        ?>

                             <?php 
if ($_SESSION['Acceso']==1) {
  echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>Acceso</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
			 <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Catálogos</a></li>
          </ul>
        </li>';
}
        ?>  
                                     <?php 
if ($_SESSION['Reportes']==1) {
  echo '     <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="reactasist.php"><i class="fa fa-circle-o"></i>Reimpreción Actas Ist</a></li>
            <li><a href="porubicacion.php"><i class="fa fa-circle-o"></i>Activos por Ubicación</a></li>
          </ul>
        </li>';
}
        ?>  
              
                                                <?php 
if ($_SESSION['Custodios']==1) {
  echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Custodios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="activoscustodio.php"><i class="fa fa-circle-o"></i> Consulta de Activos</a></li>
         
            <li><a href="mantenimiento.php"><i class="fa fa-circle-o"></i> Pedido de Mantenimiento</a></li>

          </ul>
        </li>';
}
        ?>     

        
        
      </ul>
    </section>
    <!-- /.sidebar -->
 
  </aside>