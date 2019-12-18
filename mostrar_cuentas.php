<html>
<head>
	<title>Lista de Cuentas</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		tr:hover {background-color: #f5f5f5;}
	</style>
</head>

<body>
	<h1>Lista de Cuentas</h1>
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
		$cnx = pg_connect($strCnx) or die ("Error de conexion. ". pg_last_error());
	}
	catch (Exception $e) {
		echo 'Excepción: ', $e->getMessage();
	}

	$sql = 'SELECT * FROM mostrar_cuentas();';
	$result = pg_query($cnx, $sql);

	$i = 0;
	echo '<table><tr>';
	while ($i < pg_num_fields($result))
	{
		$fieldName = pg_field_name($result, $i);
		echo '<th>' . $fieldName . '</th>';
		$i = $i + 1;
	}
	echo '</tr>';
	$i = 0;

	while ($row = pg_fetch_row($result)) {
		echo '<tr>';
		$count = count($row);
		$y = 0;
		while ($y < $count){
			$c_row = current($row);
			echo '<td>' . $c_row . '</td>';
			next($row);
			$y = $y + 1;
		}
		echo '</tr>';
		$i = $i + 1;
	}
	pg_free_result($result);

	echo '</table>';
	?>
</body>
</html>