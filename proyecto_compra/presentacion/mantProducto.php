<?php 
require_once('../logica/clsCategoriaproducto.php');
$objcategoriaproducto = new clsCategoriaproducto();
$datacategoria = $objcategoriaproducto->consultar('');
$accion = $_GET['accion'];
$id = ''; $nombre = ''; $preciocompra = ''; $precioventa = ''; $stockminimo = ''; $categoriaproducto_id = '';
if ($accion == 'ACTUALIZAR') {
	$id = $_GET['id'];
	require_once('../logica/clsProducto.php');
	$objproducto = new clsProducto();
	$data = $objproducto->consultarById($id);
	$dato = $data->fetch(PDO::FETCH_NAMED);
	$id = $dato['id'];
	$nombre = $dato['nombre'];
	$preciocompra = $dato['preciocompra'];
	$precioventa = $dato['precioventa'];
	$stockminimo = $dato['stockminimo'];
	$categoriaproducto_id = $dato['categoriaproducto_id'];
}
?>

<div class="col-md-12">
<form id="frmProducto" name="frmProducto">
<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<div class="card-body">
	<div class="form-group">
  	<label for="categoriaproducto_id" >Categoria</label>
  	<select class="form-control" id="categoriaproducto_id" name="categoriaproducto_id">
      <option value="">SELECCIONE</option>
      <?php 
      while($datocategoria = $datacategoria->fetch(PDO::FETCH_NAMED)){ 
      ?>
        <option value="<?php echo $datocategoria['id']; ?>" <?php if( ($categoriaproducto_id != '') && ($categoriaproducto_id == $datocategoria['id']) ){ echo 'selected="selected"'; } ?> ><?php echo $datocategoria['nombre']; ?></option>
      <?php  
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="nombre" >Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" value="<?php echo $nombre; ?>">
  </div>
  <div class="form-group">
    <label for="preciocompra" >Precio de Compra</label>
    <input type="text" class="form-control" id="preciocompra" name="preciocompra" placeholder="Ingrese Precio de Compra" value="<?php echo $preciocompra; ?>">
  </div>
  <div class="form-group">
    <label for="precioventa" >Precio de Venta</label>
    <input type="text" class="form-control" id="precioventa" name="precioventa" placeholder="Ingrese Precio de Venta" value="<?php echo $precioventa; ?>">
  </div>
  <div class="form-group">
    <label for="stockminimo" >Stock Minimo</label>
    <input type="text" class="form-control" id="stockminimo" name="stockminimo" placeholder="Ingrese Stock Minimo" value="<?php echo $stockminimo; ?>">
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
			if(validar_producto() == true){
				guardarProducto();
			}
    });

	function validar_producto() {
		let mensaje = 'Corregir los siguientes errores: \n';
		let respuesta = true;

		if($("#nombre").val() == ''){
			mensaje = mensaje + '\t Debe Ingresar un nombre \n';
			respuesta = false;
		}

		if($("#preciocompra").val() == ''){
			mensaje = mensaje + '\t Debe Ingresar un precio de compra \n';
			respuesta = false;
		}

		if($("#precioventa").val() == ''){
			mensaje = mensaje + '\t Debe Ingresar un precio de venta \n';
			respuesta = false;
		}

		if($("#stockminimo").val() == ''){
			mensaje = mensaje + '\t Debe Ingresar un stock minimo \n';
			respuesta = false;
		}

		if($("#categoriaproducto_id").val() == ''){
			mensaje = mensaje + '\t Debe Seleccionar una categoria \n';
			respuesta = false;
		}

		if(respuesta == false){
			alert(mensaje);
		}

		return respuesta;
	}
</script>