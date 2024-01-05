<?php
session_start();
require_once("logica/clsUsuario.php");
$objusuario = new clsUsuario();
$data = $objusuario->consultaopcionmenubyTipousuario($_SESSION['tipousuario_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Principal | Software Control</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="admin.php" class="nav-link">Inicio</a>
      </li>
    </ul>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Software de Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['login']; ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            $categoriamenu_id = '';
            while($dato = $data->fetch(PDO::FETCH_NAMED)){
              if ($categoriamenu_id != $dato['categoriamenu_id']) {
                  if ($categoriamenu_id != '') {
                    ?>
                        </ul>
                      </li>
                    <?php
                  }
                ?>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="<?php echo $dato['iconocategoriamenu']; ?>"></i>
                    <p>
                      <?php echo $dato['nombrecategoriamenu']; ?>
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" onclick="cargar('contenido','<?php echo $dato['link']; ?>');" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo $dato['nombreopcionmenu']; ?></p>
                      </a>
                    </li>
                <?php
                $categoriamenu_id = $dato['categoriamenu_id'];
              }else{
                ?>
                  <li class="nav-item">
                    <a href="#" onclick="cargar('contenido','<?php echo $dato['link']; ?>');" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo $dato['nombreopcionmenu']; ?></p>
                    </a>
                  </li>
                <?php
              }
            }

            if ($categoriamenu_id != '') {
          ?>
                  </ul>
                </li>
              <?php
            }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contenido">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-center">Bienvenido al Sistema: <?php  echo $_SESSION['login']; ?></h1>
          </div><!-- /.col -->
          <!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div> -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade bs-example-modal-sm" id="divModalMediano" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="divModalMedianoTitulo">Título</h4>
          <button tabindex="12222" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="divModalMedianoContenido">
          ...
        </div>
        <!--
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>-->
      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-lg" id="divlibre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="divlibreTitulo">Título</h4>
          <button tabindex="10000" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modal-body" id="divlibreContenido">
      ...
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-sm" id="divConfirmar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="divConfirmarTitulo">Título</h4>
          <button tabindex="10000" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        </div>
        <div class="modal-body" id="divConfirmarContenido">
          ...
        </div>
        <div class="modal-footer" id="divConfirmarFooter">
          <button type="button" class="btn btn-primary" id="divConfirmarAceptar">Aceptar</button>
          <button type="button" class="btn btn-danger" id="divConfirmarCancelar" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!--<script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard2.js"></script> -->
<script type="text/javascript">
  function cargar(div,url) {
    $('#'+div).load(url);
  }

  function ViewModal(page,divmodal,title){
    $('#'+divmodal).on('show.bs.modal', function(e) {
      document.getElementById(divmodal+"Titulo").innerHTML=title;
      cargar(divmodal+'Contenido',page);
      $(e.currentTarget).unbind();
      $('#'+divmodal).on('hidden.bs.modal', function (e) {
        document.getElementById(divmodal+"Titulo").innerHTML='';
        document.getElementById(divmodal+'Contenido').innerHTML="...";
        $("#"+divmodal+"Aceptar").prop("onclick",'');
        $(e.currentTarget).unbind();
      });
    }).modal({
      keyboard: false,
      backdrop: 'static'
    });
  }

  function CloseModal(divmodal){
    $('#'+divmodal).modal('hide');
  }

  function NuevoConfirmar(text,accionOk){
    var divmodal='divConfirmar';
    var icon="fa-question-circle";

    $('#'+divmodal).on('hidden.bs.modal', function (e) {
      $(e.currentTarget).unbind();
      document.getElementById(divmodal+"Titulo").innerHTML='';
      document.getElementById(divmodal+'Contenido').innerHTML="...";
    }).on('show.bs.modal', function(e) {
      document.getElementById(divmodal+"Titulo").innerHTML='<i class="fa '+icon+'"></i> Confirmar';
      document.getElementById(divmodal+"Contenido").innerHTML=text;
      $("#"+divmodal+"Aceptar").attr("onclick",accionOk+';CloseModal("'+divmodal+'");');
    }).modal("show");
  }
</script>
</body>
</html>
