<?php 
require_once('../logica/clsCategoriaproducto.php');
$nombre = $_GET['nombre'];
$objcategoriaproducto = new clsCategoriaproducto();
$data = $objcategoriaproducto->consultar($nombre);
if ($data->rowCount() > 0) {
?>
<table class="table table-bordered table-hover ">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th colspan="3">Operaciones</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=0;  
			//for ($i=0; $i < count($lista) ; $i++) { 
			while($dato = $data->fetch(PDO::FETCH_NAMED)){ 
				$class="";
				if($dato['estado']=='A'){
					$class="text-red";
				}
		?>
			<tr class="<?php echo $class;?>">
				<td><?php echo ($i+1); ?></td>
				<td><?php echo $dato['nombre']; ?></td>
				<td><button type="button" class="btn btn-primary btn-xs" onclick="editarCategoriaproducto(<?php echo $dato['id']; ?>);">Editar</button></td>
				<?php if($dato['estado']=='A'){ ?>
				<td><button type="button" class="btn btn-success btn-xs" onclick="cambiarEstadoCategoriaproducto(<?php echo $dato['id']; ?>,'N');">Activar</button></td>
				<?php }else{ ?>
				<td><button type="button" class="btn btn-warning btn-xs" onclick="cambiarEstadoCategoriaproducto(<?php echo $dato['id']; ?>,'A');">Anular</button></td>
				<?php } ?>
				<td><button type="button" class="btn btn-danger btn-xs" onclick="cambiarEstadoCategoriaproducto(<?php echo $dato['id']; ?>,'E');">Eliminar</button></td>
			</tr>
		<?php	
			$i++;	
			}
		?>
	</tbody>
</table>
<?php 
}else{
?>
<h3 class="text-center text-warning">NO SE ENCONTRARON REGISTROS</h3>
<?php	
}
?>