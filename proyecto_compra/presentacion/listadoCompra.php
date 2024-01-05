<?php 
require_once('../logica/clsCompra.php');
$nombre = $_GET['nombre'];
$nombre="%".str_replace(' ','%',$nombre)."%";
$objcompra = new clsCompra();
$data = $objcompra->consultar($nombre);
if ($data->rowCount() > 0) {
?>
<table class="table table-bordered table-hover ">
	<thead>
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th>Serie-NroDoc</th>
			<th>Proveedor</th>
			<!--<th colspan="3">Operaciones</th> -->
		</tr>
	</thead>
	<tbody>
		<?php
			$i=0;  
			//for ($i=0; $i < count($lista) ; $i++) { 
			while($dato = $data->fetch(PDO::FETCH_NAMED)){ 
				$class="";$proveedor = '';
				if($dato['estado']=='A'){
					$class="text-red";
				}
				if ($dato['tipopersona']=='P') {
					$proveedor = $dato['nombres'].' '.$dato['apellidos'];
				}elseif ($dato['tipopersona']=='E') {
					$proveedor = $dato['razon_social'];
				}
		?>
			<tr class="<?php echo $class;?>">
				<td><?php echo ($i+1); ?></td>
				<td><?php echo date('d/m/Y',strtotime($dato['fecha'])) ; ?></td>
				<td><?php echo $dato['serie'].'-'.$dato['numerodocumento']; ?></td>
				<td><?php echo $proveedor; ?></td>
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