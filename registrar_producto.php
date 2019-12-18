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
	

	/*$dat = file_get_contents($_POST['imag']);
	$rutadestino = pg_escape_bytea($dat);*/
	//$rutadestino=pg_escape_string($_POST['imag']);
	$cod=$_POST['cod'];
	$prec=$_POST['prec'];
	$stk=$_POST['stk'];
	$imag=$_POST['imag'];	

	$rutaservidor='img';
	$rutatemporal=$_FILES['imagen']['tmp_name'];
	$nombreimagen=$_FILES['imagen']['name'];
	$rutadestino=$rutaservidor.'/'.$imag;
	move_uploaded_file($imag,$rutadestino);

	$sql = "SELECT nuevo_producto(" . $cod . ", " . $prec . ", " . $stk . ", '" . $rutadestino . "');";
	$query = pg_query($cnx, $sql);
	$result = pg_fetch_result($query, 0, 0);
	echo $result;
	pg_close($cnx);
}
catch (Exception $e) {
	echo 'Excepción: ', $e->getMessage();
}
?>