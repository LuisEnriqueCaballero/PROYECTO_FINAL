<?php 
require_once('../logica/clsUsuario.php');
$accion = '';
if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
}
$objusuario = new clsUsuario();
switch ($accion) {
	case 'INGRESAR':
		$login = $_POST['login'];
		$clave = $_POST['clave'];
		$resp = $objusuario->consultaracceso($login,$clave);
		if ($resp->rowCount() > 0) {
			$dato = $resp->fetch(PDO::FETCH_NAMED);
			$_SESSION['usuario_id'] = $dato['id'];
			$_SESSION['login'] = $dato['login'];
			$_SESSION['tipousuario_id'] = $dato['tipousuario_id'];

			echo 'admin.php';
		}else{
			echo '*** USUARIO Y/O CLAVE INCORRECTOS ***';
		}
		break;
	
	default:
		echo "*** NO EXISTE ACCION ***";
		break;
}

?>