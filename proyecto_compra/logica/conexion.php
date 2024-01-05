<?php
@session_start();
try{
	$manejador = "mysql"; // pgsql, sqllite, odbc
	$servidor = "localhost"; // 127.0.0.1
	$usuario = "root";
	$pass = "";
	$base = "proyecto_compra";
	$cadena = "$manejador:host=$servidor;dbname=$base";
	global $cnx;
	$cnx = new PDO($cadena,$usuario,$pass,array(PDO::ATTR_PERSISTENT => "true", PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	//echo 'conexion exitosa';
}catch(Exception $e){
	echo "Error de conexión a la base de datos ".$e;
}
?>