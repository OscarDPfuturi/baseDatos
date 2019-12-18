<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/estilos2.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script> 
	<script type="text/javascript" src="js/js.js"></script>
	<meta charset="UTF-8">
	<title>Tienda de Laptops - LapStore</title>
	<link rel="shortcut icon" href="img/Libcomlogo.jpg">
</head>
<body>
	<div class="banner">
		<img  alt="" src="img/banner.jpg" class="banner" width="100%" height="200">
	</div>
	<header class="cabecera">
		<nav class="menu">
			<ul>
				<li><a href="desconectar.php"> Cerrar Sesión </a></li>
				<li><a href="index.php"> Inicio </a></li>
				<li><a href="carrito.php"> Ver Carrito </a></li>
				<li><a href="nueva_persona.php"> Registrarse </a></li>
				<li><a href="index.php"> Login Administrador</a></li>
			</ul>
		</nav>
	</header>
	<div class="cuerpo">
		<nav class="vertical">
		<figure>
			<img src="img/lapstore.jpg" alt="Logo de la página" id="logo" />
			<figcaption><center>Encuentra Laptops de todas las marcas y precios.</center></figcaption>
			<br>
			<hr >
			<br>
		</figure>
		</nav>
		
		<div class="contenedor">
			
			
			<div class="caja">   
				<h4><?php echo $nombre ?></h4>
				<img src="<?php echo $imagen ?>" width="240" height="250">
				<p>$<?php echo $precio ?></p>
				<form action="detalle.php" method="post" name="detalle">
					<input name="id" type="hidden" value="<?php echo $id ?>" />
					<input class="boton" type="submit" value="Detalles">
				</form>
			</div>

		</div>
	</div>
	<aside>
		<footer id="pie">
		<p>&copy; Derechos Reservados - LapStore</p>
	</footer>
	</aside>
	
</body>
</html>