<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = 'postgres';
$passwd = 'unsa';
$db = 'lapstore';
$port = 5432;
$host = 'localhost';
$strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd";

try {
	$cnx = pg_connect($strCnx) or die ("Error de conexion.". pg_last_error());
	//echo 'Conexion exitosa<br';
}
catch (Exception $e){
	echo 'Excepción: ', $e->getMessage();
}

try{
	$corr = pg_escape_string($_POST['corr']);
	$nombs = pg_escape_string($_POST['nombs']);
	$apels = pg_escape_string($_POST['apels']);
	$contr = pg_escape_string($_POST['contr']);
	$dnip = $_POST['dnip'];

	$sql = "SELECT nueva_cuenta('" . $corr . "', '" . $nombs . "', '" . $apels . "', '" . $contr . "', " . $dnip . ");";
	$query = pg_query($cnx, $sql);
	$result = pg_fetch_result($query, 0, 0);
	echo $result;
	pg_close($cnx);
}
catch (Exception $e) {
	echo 'Excepción: ', $e->getMessage();
}
?>