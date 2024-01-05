<?php 
require_once("../logica/clsProducto.php");
$accion = '';
if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
}
$objproducto = new clsProducto();

switch ($accion) {
	case 'REGISTRAR':
		try{
			$nombre = $_POST['nombre'];
			$preciocompra = $_POST['preciocompra'];
			$precioventa = $_POST['precioventa'];
			$stockminimo = $_POST['stockminimo'];
			$categoriaproducto_id = $_POST['categoriaproducto_id'];
			$objproducto->insertar(strtoupper($nombre),$preciocompra,$precioventa,$stockminimo,$categoriaproducto_id);
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudieron Registar los datos'.$e;
		}
		break;
	case 'ACTUALIZAR':
		try{
			$nombre = $_POST['nombre'];
			$id = $_POST['id'];
			$preciocompra = $_POST['preciocompra'];
			$precioventa = $_POST['precioventa'];
			$stockminimo = $_POST['stockminimo'];
			$categoriaproducto_id = $_POST['categoriaproducto_id'];
			$objproducto->actualizar($id,strtoupper($nombre),$preciocompra,$precioventa,$stockminimo,$categoriaproducto_id);
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudieron Actualizar los datos'.$e;
		}
		break;
	case 'CAMBIAR_ESTADO_CATEGORIA':
		try{
			$id = $_POST['id'];
			$estado = $_POST['estado'];
			$objproducto->cambiarEstado($id,$estado);
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudo Cambiar el Estado del Registro'.$e;
		}
		break;
	case 'CONSULTAR_PERSONA_ID':
		try{
			$id = $_POST['id'];
			$data = $objproducto->consultarById($id);
			$dato = $data->fetch(PDO::FETCH_NAMED);
			$datos = array("nombre"=>$dato['nombre'],"preciocompar"=>$dato['preciocompar'],"precioventa"=>$dato['precioventa'],"stockminimo"=>$dato['stockminimo'],"categoriaproducto_id"=>$dato['categoriaproducto_id'], "estado" => $dato['estado'], "id" => $dato['id']);
			echo json_encode($datos);
		}catch(Exception $e){
			echo 'No se pudo Eliminar el Registro'.$e;
		}
		break;
	
	default:
		echo '*** NO SE ESPECIFICO ACCION';
		break;
}
?>