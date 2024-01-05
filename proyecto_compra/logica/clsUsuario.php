<?php 
require_once('conexion.php');

class clsUsuario
{
	
	function consultaracceso($login,$clave)
	{
		$sql = "SELECT id,login,tipousuario_id,clave,estado FROM `usuario` WHERE login = :login AND clave = SHA1(:clave) AND estado = 'N'";
		global $cnx;
		$parametros = array(':login'=>$login, ':clave' => $clave);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		return $pre;
	}

	function consultaopcionmenubyTipousuario($tipousuario_id)
	{
		$sql = "SELECT p.id, p.opcionmenu_id, om.nombre AS nombreopcionmenu,om.link, om.orden as ordenopcionmenu, om.categoriamenu_id, ct.nombre AS nombrecategoriamenu, ct.orden as ordencategoriamenu, ct.icono as iconocategoriamenu  
			FROM permiso p
			INNER JOIN tipousuario tp ON p.tipousuario_id = tp.id
			INNER JOIN opcionmenu om ON p.opcionmenu_id = om.id
			INNER JOIN categoriamenu ct ON om.categoriamenu_id = ct.id
			WHERE p.estado = 'N' AND p.tipousuario_id = :tipousuario_id
			ORDER BY ct.orden ASC, om.orden ASC";
		global $cnx;
		$parametros = array(':tipousuario_id'=>$tipousuario_id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		return $pre;
	}
}

?>