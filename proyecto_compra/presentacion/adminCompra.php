<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Compra</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Almacen</a></li>
          <li class="breadcrumb-item active">Compra</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <!--<h3 class="card-title">Icons</h3> -->
        <div class="row">
          <div class="col-sm-4">
          <input type="text" class="form-control" id="busquedanombre" name="busquedanombre" placeholder="Nombre Proveedor" onkeyUp="if(event.keyCode=='13'){buscarCompra(); }"> 
          </div>
          <div class="col-sm-4">
            <button type="button" id="btnBuscar" class="btn btn-success" onclick="buscarCompra();"><i class="fa fa-search"></i>Buscar</button>
            <button type="button" id="btnNuevo" class="btn btn-primary" onclick="nuevoCompra();"><i class="fa  fa-plus"></i>Nuevo</button>
          </div>
        </div>
        
      </div>
      <div class="row text-center" id="divMantCompra">
        
      </div>
      <!-- /.card-body -->
      <div class="card-body" id="divListadoCompra">
        
      </div><!-- /.card-body -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
  function buscarCompra() {
    let nombre = $("#busquedanombre").val();
    cargar('divListadoCompra','presentacion/listadoCompra.php?nombre='+nombre);
  }

  function nuevoCompra() {
    //$("#divMantCompra").show();
    //cargar('divMantCompra','presentacion/mantCompra.php?accion=REGISTRAR');
    ViewModal('presentacion/mantCompra.php?accion=REGISTRAR','divModalMediano','Registro de Nueva Compra');
  }

  function guardarCompra() {
    $.ajax({
      url:'controlador/contCompra.php',
      type: 'POST',
      data: $('#frmCompra').serialize()
    }).done(function (respuesta) {
      //alert(respuesta); 
      if (respuesta == 'OK') {
        alert("DATOS PROCESADOS CORRECTAMENTE");
        buscarCompra();
        //$("#divMantCompra").hide();
        CloseModal('divModalMediano');
      }else{
        alert(respuesta);
      }
        
    })
  }

  buscarCompra();
</script>