<?php 
require_once('conexion.php');
class clsCategoriaproducto
{
	function insertar($nombre)
	{
		$sql = "INSERT INTO categoriaproducto(id,nombre,estado) VALUES(null,:nombre,'N')";
		global $cnx;
		$parametros = array(":nombre"=>$nombre);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function actualizar($id,$nombre)
	{
		$sql = "UPDATE categoriaproducto SET nombre=:nombre WHERE id=:id";
		global $cnx;
		$parametros = array(":nombre"=>$nombre,":id"=>$id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function cambiarEstado($id,$estado)
	{
		$sql = "UPDATE categoriaproducto SET estado=:estado WHERE id=:id";
		global $cnx;
		$parametros = array(":id"=>$id,":estado"=>$estado);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function consultar($nombre)
	{
		$sql = "SELECT id,nombre,estado FROM categoriaproducto WHERE estado <> 'E' ";
		$parametros = array();
		if($nombre!=''){
				$sql.=" AND nombre LIKE :nombre ";
				$parametros[':nombre'] = '%'.$nombre.'%';
			}
		global $cnx;
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

	function consultarById($id)
	{
		$sql = "SELECT id,nombre,estado FROM categoriaproducto WHERE id = :id";
		global $cnx;
		$parametros = array(":id"=>$id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}
}
?>