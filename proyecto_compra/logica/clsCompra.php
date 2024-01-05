<?php 
require_once('conexion.php');
class clsCompra
{
	function insertar($fecha,$total,$serie,$numerodocumento,$persona_id,$tipomovimiento_id)
	{
		$sql = "INSERT INTO movimiento(id,fecha,total,serie,numerodocumento,persona_id,tipomovimiento_id,estado) VALUES(null,:fecha,:total,:serie,:numerodocumento,:persona_id,:tipomovimiento_id,'N')";
		global $cnx;
		$parametros = array(":fecha"=>$fecha,":total"=>$total,":serie"=>$serie,":numerodocumento"=>$numerodocumento,":persona_id"=>$persona_id,":tipomovimiento_id"=>$tipomovimiento_id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function insertardetalle($cantidad,$preciounitario,$subtotal,$producto_id,$movimiento_id)
	{
		$sql = "INSERT INTO detallemovimiento(id,cantidad,preciounitario,subtotal,producto_id,movimiento_id,estado) VALUES(null,:cantidad,:preciounitario,:subtotal,:producto_id,:movimiento_id,'N')";
		global $cnx;
		$parametros = array(":cantidad"=>$cantidad,":preciounitario"=>$preciounitario,":subtotal"=>$subtotal,":producto_id"=>$producto_id,":movimiento_id"=>$movimiento_id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function insertarkardex($fecha,$tipo,$cantidad,$stockanterior,$stockactual,$producto_id,$detallemovimiento_id)
	{
		$sql = "INSERT INTO kardex(id,fecha,tipo,cantidad,stockanterior,stockactual,producto_id,detallemovimiento_id,estado) VALUES(null,:fecha,:tipo,:cantidad,:stockanterior,:stockactual,:producto_id,:detallemovimiento_id,'N')";
		global $cnx;
		$parametros = array(":fecha"=>$fecha,":tipo"=>$tipo,":cantidad"=>$cantidad,":stockanterior"=>$stockanterior,":stockactual"=>$stockactual,":producto_id"=>$producto_id,":detallemovimiento_id"=>$detallemovimiento_id);
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
	}

	function consultar($nombre)
	{
		$sql = "SELECT m.id,m.fecha,m.total, m.serie, m.numerodocumento, m.persona_id, m.estado, p.nombres, p.apellidos, p.razon_social, p.tipopersona 
			FROM movimiento m
			INNER JOIN persona p on m.persona_id = p.id
			WHERE m.tipomovimiento_id = 1 AND m.estado <> 'E' ";
		$parametros = array();
		if($nombre!=''){
			$sql.=" AND CONCAT_WS(' ',p.nombres, p.apellidos, p.razon_social) LIKE :nombre ";
			$parametros[':nombre'] = $nombre;
		}

		$sql .= ' ORDER BY m.fecha DESC';
		
		global $cnx;
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

	function consultarUltimoIdMovimiento()
	{
		$sql = "SELECT id FROM movimiento ORDER BY id DESC LIMIT 1";
		global $cnx;
		$parametros = array();
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

	function consultarUltimoIdDetallemovimiento()
	{
		$sql = "SELECT id FROM detallemovimiento ORDER BY id DESC LIMIT 1";
		global $cnx;
		$parametros = array();
		$pre = $cnx->prepare($sql);
		$pre->execute($parametros);
		//echo var_dump($datos);
		return $pre;
	}

}
?>