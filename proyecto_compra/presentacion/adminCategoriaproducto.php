<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Categoria Producto</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
          <li class="breadcrumb-item active">Categoria Producto</li>
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
          <input type="text" class="form-control" id="busquedanombre" name="busquedanombre" placeholder="Nombre" onkeyUp="if(event.keyCode=='13'){buscarCategoriaproducto(); }"> 
          </div>
          <div class="col-sm-4">
            <button type="button" id="btnBuscar" class="btn btn-success" onclick="buscarCategoriaproducto();"><i class="fa fa-search"></i>Buscar</button>
            <button type="button" id="btnNuevo" class="btn btn-primary" onclick="nuevoCategoriaproducto();"><i class="fa  fa-plus"></i>Nuevo</button>
          </div>
        </div>
        
      </div>
      <div class="row text-center" id="divMantCategoriaproducto">
        
      </div>
      <!-- /.card-body -->
      <div class="card-body" id="divListadoCategoriaproducto">
        
      </div><!-- /.card-body -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
  function buscarCategoriaproducto() {
    let nombre = $("#busquedanombre").val();
    cargar('divListadoCategoriaproducto','presentacion/listadoCategoriaproducto.php?nombre='+nombre);
  }

  function nuevoCategoriaproducto() {
    //$("#divMantCategoriaproducto").show();
    //cargar('divMantCategoriaproducto','presentacion/mantCategoriaproducto.php?accion=REGISTRAR');
    ViewModal('presentacion/mantCategoriaproducto.php?accion=REGISTRAR','divModalMediano','Registro de Nueva Categoria');
  }

  function editarCategoriaproducto(id) {
    //$("#divMantCategoriaproducto").show();
    //cargar('divMantCategoriaproducto','presentacion/mantCategoriaproducto.php?accion=ACTUALIZAR&id='+id);
    ViewModal('presentacion/mantCategoriaproducto.php?accion=ACTUALIZAR&id='+id,'divModalMediano','Actualizar Categoria');
  }

  function guardarCategoriaproducto() {
    $.ajax({
      url:'controlador/contCategoriaproducto.php',
      type: 'POST',
      data: $('#frmCategoriaproducto').serialize()
    }).done(function (respuesta) {
      //alert(respuesta); 
      if (respuesta == 'OK') {
        alert("DATOS PROCESADOS CORRECTAMENTE");
        buscarCategoriaproducto();
        //$("#divMantCategoriaproducto").hide();
        CloseModal('divModalMediano');
      }else{
        alert(respuesta);
      }
        
    })
  }

  function cambiarEstadoCategoriaproducto(id, estado){
    msj="";
    if(estado=="A"){msj="¿Esta seguro de desactivar categoria de producto?";}
    if(estado=="N"){msj="¿Esta seguro de activar categoria de producto?";}
    if(estado=="E"){msj="¿Esta seguro de eliminar categoria de producto?";}
    
    //confirm(msj,"ProcesoCambiarEstadoCategoriaproduct('"+id+"','"+estado+"')"); 
    NuevoConfirmar(msj,"ProcesoCambiarEstadoCategoriaproducto('"+id+"','"+estado+"')");
  }
  function ProcesoCambiarEstadoCategoriaproducto(id, estado){
    //CloseModal('divConfirmar');
      $.ajax({
      method: "POST",
      url: 'controlador/contCategoriaproducto.php',
      data: {accion: "CAMBIAR_ESTADO_CATEGORIA",
        'id': id,
        'estado': estado
        }
      })
      .done(function( respuesta ) {
        if (respuesta == 'OK') {
          alert("DATOS PROCESADOS CORRECTAMENTE");
          buscarCategoriaproducto();
          //$("#divMantCategoriaproducto").hide();
          //CloseModal('divModalMediano');
        }else{
          alert(respuesta);
        }
      })
  }

  buscarCategoriaproducto();
</script>