<?php 
require_once("../logica/clsCategoriaproducto.php");
$accion = '';
if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
}
$objcategoriaproducto = new clsCategoriaproducto();

switch ($accion) {
	case 'REGISTRAR':
		try{
			$nombre = $_POST['nombre'];
			$objcategoriaproducto->insertar(strtoupper($nombre));
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudieron Registar los datos'.$e;
		}
		break;
	case 'ACTUALIZAR':
		try{
			$nombre = $_POST['nombre'];
			$id = $_POST['id'];
			$objcategoriaproducto->actualizar($id,strtoupper($nombre));
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudieron Actualizar los datos'.$e;
		}
		break;
	case 'CAMBIAR_ESTADO_CATEGORIA':
		try{
			$id = $_POST['id'];
			$estado = $_POST['estado'];
			$objcategoriaproducto->cambiarEstado($id,$estado);
			echo "OK";
		}catch(Exception $e){
			echo 'No se pudo Cambiar el Estado del Registro'.$e;
		}
		break;
	case 'CONSULTAR_PERSONA_ID':
		try{
			$id = $_POST['id'];
			$data = $objcategoriaproducto->consultarById($id);
			$dato = $data->fetch(PDO::FETCH_NAMED);
			$datos = array("nombre"=>$dato['nombre'], "estado" => $dato['estado'], "id" => $dato['id']);
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