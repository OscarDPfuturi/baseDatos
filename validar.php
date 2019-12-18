<?php
session_start();
	echo 'Entrada';
	require("conexion1.php");

	$username=$_POST['mail'];
	$pass=$_POST['pass'];
	$sql2=pg_query($cnx,"SELECT * FROM op_administrador WHERE contrasenha = '$pass';");
	
	if($row=pg_fetch_row($sql2)){
		if ($row['contrasenha'] == $pass){
			//$_SESSION['codigo_e']=$row['codigo_e'];
			/*$_SESSION['correo_a']=$row['correo_a'];
			$_SESSION['contrasenha']=$row['contrasenha'];*/
			echo '<script>alert("BIENVENIDO ADMINISTRADOR")</script> ';
			echo "<script>location.href='admin.php'</script>";
		}
		else{
			echo 'Contraseña incorrecta.'
		}
	}
	
	$sql=pg_query($cnx,"SELECT * FROM op_cuenta WHERE correo_c = '$username' AND contrasenha = '$pass';");
	if ($row2=pg_fetch_array($sql)){
		if ($row['contrasenha'] == $pass)
			header("Location: principal.php");
		else
			echo 'Contraseña incorrecta.'
	}
	else {
			echo '<script>alert("La cuenta o la contraseña son incorrectos, porfavor inténtelo nuevamente.")</script> ';
			
			echo "<script>location.href='index.php'</script>";
	}
	echo "<script>alert('Ocurrió un problemar para conectar a la página</script>"
?>