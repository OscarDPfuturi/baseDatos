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
	$dn = $_POST['dn'];
	$nomb = pg_escape_string($_POST['nomb']);
	$papel = pg_escape_string($_POST['papel']);
	$sapel = pg_escape_string($_POST['sapel']);
	$f_naci = $_POST['f_naci'];
	$sex = pg_escape_string($_POST['sex']);
	$dir = pg_escape_string($_POST['dir']);
	$ciud = pg_escape_string($_POST['ciud']);
	$complem = pg_escape_string($_POST['complem']);

	$sql = "SELECT nueva_persona(" . $dn . ", '" . $nomb . "', '" . $papel . "', '" . $sapel . "', '" . $f_naci . "', '" . $sex . "', '" . $dir . "', '" . $ciud . "', '" . $complem . "');";
	$query = pg_query($cnx, $sql);
	$result = pg_fetch_result($query, 0, 0);
	echo $result;
	pg_close($cnx);
}
catch (Exception $e) {
	echo 'Excepción: ', $e->getMessage();
}
?>