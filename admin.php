<?php include('conexion1.php');?>

<!DOCTYPE html>
<?php
/*session_start();
if (@!$_SESSION['correo_a']) {
	header("Location:index.php");
}elseif ($_SESSION['correo_c']) {
	header("Location:principal.php");
}*/
$sql2=pg_query($cnx,"SELECT * FROM op_administrador WHERE correo_a = '$username'");
$reg2 = pg_fetch_object($sql2, 0);
$sql=pg_query($cnx,"SELECT pe.nombres, pe.papellido, pe.sapellido 
					FROM op_persona pe
					INNER JOIN op_empleado em ON pe.dni = em.dni_p;");
$reg = pg_fetch_object($sql, 0);
?>

<html>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/users_estilo.css">
    <title>Administración</title>
    <link rel="shortcut icon" href="img/icon.png">
  </head>

<body>

	<header class="header">
		<strong>LapStore</strong>
	</header>

	<table id=tabla1 align="center">
		<tr>
		  <th width="267" >ADMINISTRADOR DEL SITIO</th>
		  <th width="250" >
		  <strong>
		  	<?php //echo ($reg['nombres'] + ' ' + $reg['papellido'] + $reg['sapellido']);?>
		  	</strong>
		  	</th>
		  <th width="120"><a href="desconectar.php"> Cerrar Sesión </a></th>
		</tr>
	</table>

<br>
<br>

	<!--table id=tabla2 align="center">
		<tr>
		  <th colspan="7" align="center">TABLA DE USUARIOS</th>
		</tr>
		<tr>
		  <th id=fil2 >ID</th>
		  <th id=fil2>Usuario</th>
		  <th id=fil2>Contraseña</th>
		  <th id=fil2>Correo</th>
		  <th id=fil2>Contraseña de Administrador</th>
		  <th id=fil2>Editar</th>
		  <th id=fil2>Borrar</th>
		</tr>

		<?php

			$consulta=pg_query($mysqli,"SELECT * FROM login3");
			while ($filas=pg_fetch_array($consulta)) {
				$id=$filas['id'];
				$user=$filas['user'];
				$password=$filas['password'];
				$email=$filas['email'];
				$pasadmin=$filas['pasadmin'];
				$rol=$filas['rol'];
		  ?>
		<tr>
		  <td><?php echo $id ?></td>
		  <td><?php echo $user ?></td>
		  <td><?php echo $password ?></td>
		  <td><?php echo $email ?></td>
		  <td><?php echo $pasadmin ?></td>
		  <td><form action="editarusuarios.php" method="post" name="editar"><button onClick="modificar(" .$filas['id'] .");">Modificar</button></form></td>
		  <td><form action="borrar.php" method="post" name="borrar"><input type="submit" name="borrar" value="Borrar"></form></td>
		</tr>
			<?php } 
			?> 
	</table>

<br>
<br>
 
	<form id="form1" name="form1" method="post"> </form>

	  <table id=tabla2 align="center">
		  <tr>
			<th colspan="8">EDICIÓN DE PRODUCTOS</th>
		  </tr>
		  <tr>
			<th>ID</th>
			<th>Imagen</th>
			<th>Título</th>
			<th>Categoría</th>
			<th>Precio</th>
			<th>Stock</th>
			<th>Fecha</th>
			<th>Editar</th>
		  </tr>

	<?php
			$consulta=pg_query($db_connection,"SELECT * FROM productos");
			while ($filas=pg_fetch_array($consulta)) {
				$id=$filas['id'];
				$imagen=$filas['imagen'];
				$nombre=$filas['nombre'];
				$desc=$filas['descripcion'];
				$precio=$filas['precio'];
				$stock=$filas['stock'];
				$fecha=$filas['fecha'];

	?>

		  <tr>
			<td><?php echo $id ?></td>
			<td><img src="<?php echo $imagen; ?>" width="120" height="120"><br></td>
			<td><?php echo $nombre ?></td>
			<td><?php echo $desc ?></td>
			<td><?php echo $precio ?></td>
			<td><?php echo $stock ?></td>
			<td><?php echo $fecha ?></td>
			<td>
			<form action="editar.php" method="post" name="compra">
				<input name="id2" type="hidden" value="<?php echo $id ?>"/>
				<input name="imagen2" type="hidden" value="<?php echo $imagen ?>"/>
				<input name="nombre2" type="hidden" value="<?php echo $nombre ?>"/>
				<input name="desc2" type="hidden" value="<?php echo $desc ?>"/>
				<input name="precio2" type="hidden" value="<?php echo $precio ?>"/>
				<input name="stock2" type="hidden" value="<?php echo $stock ?>"/>
				<input name="fecha2" type="hidden" value="<?php echo $fecha ?>"/>
				<input name="editar" type="submit" value="Editar"/>
			</form>

	<form action="borrar.php" method="post">
		<input type="hidden" value="<?php echo $id ?>">
		<input type="submit" name="" value="Borrar">
	 </form>
			</td>
		  </tr>
		  </tr>
		  <p>
		  <?php }
			?>    
	</table-->
<br>
<br>

	<div align="center">
		<form action="nuevo_empleado.php" method="post" name="agregar">
				<input class="boton" type="submit" value="Agregar Usuario">
		</form>
	</div>

	<br>

	<div align="center">
		<form action="agregarproducto.php" method="post" name="agregar">
			<input class="boton" type="submit" value="Agregar Producto">
		</form>
	</div>

	<hr>

	<footer class="footer">
		<br><br>
	</footer>
</body>
</html>