<?php 
require_once("../logica/clsCategoriaproducto.php");
$objcategoriaproducto = new clsCategoriaproducto();
$data = $objcategoriaproducto->consultar('');
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Producto</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
          <li class="breadcrumb-item active">Producto</li>
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
            <input type="text" class="form-control" id="busquedanombre" name="busquedanombre" placeholder="Nombre" onkeyUp="if(event.keyCode=='13'){buscarProducto(); }"> 
            </div>
            <div class="col-sm-4">
            <select class="form-control" id="busquedacategoria" name="busquedacategoria" onchange="buscarProducto();">
              <option value="">TODAS LAS CATEGORIAS</option>
              <?php 
              while($dato = $data->fetch(PDO::FETCH_NAMED)){ 
              ?>
                <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
              <?php  
              }
              ?>
            </select> 
            </div>
            <div class="col-sm-4">
              <button type="button" id="btnBuscar" class="btn btn-success" onclick="buscarProducto();"><i class="fa fa-search"></i>Buscar</button>
              <button type="button" id="btnNuevo" class="btn btn-primary" onclick="nuevoProducto();"><i class="fa  fa-plus"></i>Nuevo</button>
            </div>
        </div>
          
        
      </div>
      <div class="row text-center" id="divMantProducto">
        
      </div>
      <!-- /.card-body -->
      <div class="card-body" id="divListadoProducto">
        
      </div><!-- /.card-body -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
  function buscarProducto() {
    let nombre = $("#busquedanombre").val();
    let categoriaproducto_id = $("#busquedacategoria").val();
    cargar('divListadoProducto','presentacion/listadoProducto.php?nombre='+nombre+'&categoriaproducto_id='+categoriaproducto_id);
  }

  function nuevoProducto() {
    //$("#divMantProducto").show();
    //cargar('divMantProducto','presentacion/mantProducto.php?accion=REGISTRAR');
    ViewModal('presentacion/mantProducto.php?accion=REGISTRAR','divModalMediano','Registro de Nuevo Producto');
  }

  function editarProducto(id) {
    //$("#divMantProducto").show();
    //cargar('divMantProducto','presentacion/mantProducto.php?accion=ACTUALIZAR&id='+id);
    ViewModal('presentacion/mantProducto.php?accion=ACTUALIZAR&id='+id,'divModalMediano','Actualizar Producto');
  }

  function guardarProducto() {
    $.ajax({
      url:'controlador/contProducto.php',
      type: 'POST',
      data: $('#frmProducto').serialize()
    }).done(function (respuesta) {
      //alert(respuesta); 
      if (respuesta == 'OK') {
        alert("DATOS PROCESADOS CORRECTAMENTE");
        buscarProducto();
        //$("#divMantProducto").hide();
        CloseModal('divModalMediano');
      }else{
        alert(respuesta);
      }
        
    })
  }

  function cambiarEstadoProducto(id, estado){
    msj="";
    if(estado=="A"){msj="¿Esta seguro de anular producto?";}
    if(estado=="N"){msj="¿Esta seguro de activar producto?";}
    if(estado=="E"){msj="¿Esta seguro de eliminar producto?";}
    
    //confirm(msj,"ProcesoCambiarEstadoCategoriaproduct('"+id+"','"+estado+"')"); 
    NuevoConfirmar(msj,"ProcesoCambiarEstadoProducto('"+id+"','"+estado+"')");
  }
  function ProcesoCambiarEstadoProducto(id, estado){
    //CloseModal('divConfirmar');
      $.ajax({
      method: "POST",
      url: 'controlador/contProducto.php',
      data: {accion: "CAMBIAR_ESTADO_CATEGORIA",
        'id': id,
        'estado': estado
        }
      })
      .done(function( respuesta ) {
        if (respuesta == 'OK') {
          alert("DATOS PROCESADOS CORRECTAMENTE");
          buscarProducto();
          //$("#divMantProducto").hide();
          //CloseModal('divModalMediano');
        }else{
          alert(respuesta);
        }
      })
  }

  buscarProducto();
</script>