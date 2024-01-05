<?php 
require_once('conexion.php');
class clsProducto
{
	function insertar($nombre,$preciocompra,$precioventa,$stockminimo,$categoriaproducto_id)
	{
		$sql = "INSERT INTO producto(id,nombre,preciocompra,precioventa,stockminimo,categoriaproducto_id,estado) VALUES(null,:nombre,:preciocompra,:precioventa,:stockminimo,:categoriaproducto_id,'N')";
		global $cnx;
		$parametros = array(":nombre"=>$nombre,":preciocompra"=>$preciocompra,":precioventa"=>$precioventa,":stockminimo"=>$stockminimo,":categoriaproducto_id"=>$categoriaproducto_id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function actualizar($id,$nombre,$preciocompra,$precioventa,$stockminimo,$categoriaproducto_id)
	{
		$sql = "UPDATE producto SET nombre=:nombre, preciocompra=:preciocompra, precioventa=:precioventa, stockminimo=:stockminimo, categoriaproducto_id=:categoriaproducto_id WHERE id=:id";
		global $cnx;
		$parametros = array(":nombre"=>$nombre,":preciocompra"=>$preciocompra,":precioventa"=>$precioventa,":stockminimo"=>$stockminimo,":categoriaproducto_id"=>$categoriaproducto_id,":id"=>$id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function cambiarEstado($id,$estado)
	{
		$sql = "UPDATE producto SET estado=:estado WHERE id=:id";
		global $cnx;
		$parametros = array(":id"=>$id,":estado"=>$estado);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function consultar($nombre,$categoriaproducto_id)
	{
		$sql = "SELECT p.id,p.nombre,p.preciocompra,p.precioventa,p.stockminimo,p.categoriaproducto_id,ct.nombre as nombrecategoria,p.estado FROM producto p 
			INNER JOIN categoriaproducto ct on p.categoriaproducto_id = ct.id WHERE p.estado <> 'E' ";
		$parametros = array();
		if($nombre!=''){
			$sql.=" AND p.nombre LIKE :nombre ";
			$parametros[':nombre'] = '%'.$nombre.'%';
		}
		if($categoriaproducto_id!=''){
			$sql.=" AND p.categoriaproducto_id = :categoriaproducto_id ";
			$parametros[':categoriaproducto_id'] = $categoriaproducto_id;
		}
		global $cnx;
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

	function consultarById($id)
	{
		$sql = "SELECT id,nombre,preciocompra,precioventa,stockminimo,categoriaproducto_id,estado FROM producto WHERE id = :id";
		global $cnx;
		$parametros = array(":id"=>$id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

	function consultarStockProductoById($id)
	{
		$sql = "SELECT id,fecha,tipo,cantidad,stockanterior,stockactual,estado FROM kardex WHERE producto_id = :id ORDER BY id DESC LIMIT 1";
		global $cnx;
		$parametros = array(":id"=>$id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}
}
?>