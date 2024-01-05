<?php 
$accion = $_GET['accion'];
$id = ''; $nombre = '';
if ($accion == 'ACTUALIZAR') {
	$id = $_GET['id'];
	require_once('../logica/clsCategoriaproducto.php');
	$objcategoriaproducto = new clsCategoriaproducto();
	$data = $objcategoriaproducto->consultarById($id);
	$dato = $data->fetch(PDO::FETCH_NAMED);
	$id = $dato['id'];
	$nombre = $dato['nombre'];
}
?>

<div class="col-md-12">
<form id="frmCategoriaproducto" name="frmCategoriaproducto">
<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<div class="card-body">
  <div class="form-group">
    <label for="nombre" >Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" value="<?php echo $nombre; ?>">
  </div>
</div>
<!-- /.card-body -->

<div class="card-footer text-center">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
</div>
</form>
</div>
<script type="text/javascript">
	$("#btnGuardar").click(function(){
      guardarCategoriaproducto();  
    });
</script>