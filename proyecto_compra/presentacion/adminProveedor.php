<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Proveedor</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
          <li class="breadcrumb-item active">Proveedor</li>
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
            <input type="text" class="form-control" id="busquedanombre" name="busquedanombre" placeholder="Nombre" onkeyUp="if(event.keyCode=='13'){buscarProveedor(); }"> 
            </div>
            <div class="col-sm-4">
              <button type="button" id="btnBuscar" class="btn btn-success" onclick="buscarProveedor();"><i class="fa fa-search"></i>Buscar</button>
              <button type="button" id="btnNuevo" class="btn btn-primary" onclick="nuevoProveedor();"><i class="fa  fa-plus"></i>Nuevo</button>
            </div> 
        </div>
        
      </div>
      <div class="row text-center" id="divMantProveedor">
        
      </div>
      <!-- /.card-body -->
      <div class="card-body" id="divListadoProveedor">
        
      </div><!-- /.card-body -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
  function buscarProveedor() {
    let nombre = $("#busquedanombre").val();
    cargar('divListadoProveedor','presentacion/listadoProveedor.php?nombre='+nombre);
  }

  function nuevoProveedor() {
    //$("#divMantProveedor").show();
    //cargar('divMantProveedor','presentacion/mantProveedor.php?accion=REGISTRAR');
    ViewModal('presentacion/mantProveedor.php?accion=REGISTRAR','divModalMediano','Registro de Nuevo Proveedor');
  }

  function editarProveedor(id) {
    //$("#divMantProveedor").show();
    //cargar('divMantProveedor','presentacion/mantProveedor.php?accion=ACTUALIZAR&id='+id);
    ViewModal('presentacion/mantProveedor.php?accion=ACTUALIZAR&id='+id,'divModalMediano','Actualizar Proveedor');
  }

  function guardarProveedor() {
    $.ajax({
      url:'controlador/contProveedor.php',
      type: 'POST',
      data: $('#frmProveedor').serialize()
    }).done(function (respuesta) {
      //alert(respuesta); 
      if (respuesta == 'OK') {
        alert("DATOS PROCESADOS CORRECTAMENTE");
        buscarProveedor();
        //$("#divMantProveedor").hide();
        CloseModal('divModalMediano');
      }else{
        alert(respuesta);
      }
        
    })
  }

  function cambiarEstadoProveedor(id, estado){
    msj="";
    if(estado=="A"){msj="¿Esta seguro de anular proveedor?";}
    if(estado=="N"){msj="¿Esta seguro de activar proveedor?";}
    if(estado=="E"){msj="¿Esta seguro de eliminar proveedor?";}
    
    //confirm(msj,"ProcesoCambiarEstadoCategoriaproduct('"+id+"','"+estado+"')"); 
    NuevoConfirmar(msj,"ProcesoCambiarEstadoProveedor('"+id+"','"+estado+"')");
  }
  function ProcesoCambiarEstadoProveedor(id, estado){
    //CloseModal('divConfirmar');
      $.ajax({
      method: "POST",
      url: 'controlador/contProveedor.php',
      data: {accion: "CAMBIAR_ESTADO_CATEGORIA",
        'id': id,
        'estado': estado
        }
      })
      .done(function( respuesta ) {
        if (respuesta == 'OK') {
          alert("DATOS PROCESADOS CORRECTAMENTE");
          buscarProveedor();
          //$("#divMantProveedor").hide();
          //CloseModal('divModalMediano');
        }else{
          alert(respuesta);
        }
      })
  }

  buscarProveedor();
</script>