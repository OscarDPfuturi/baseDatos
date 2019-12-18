<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Registro de Personas</title>
	<link rel="shortcut icon" href="img/icon.png">
	<link rel="stylesheet" href="css/regis_estilo.css">
	<script type="text/javascript">
		function regi_persona() {
			var dn = document.getElementById('txt_dn').value;
			var nomb = document.getElementById('txt_nomb').value;
			var papel = document.getElementById('txt_papel').value;
			var sapel = document.getElementById('txt_sapel').value;
			var f_naci = document.getElementById('txt_f_naci').value;
			var sex = document.getElementById('txt_sex').value;
			var dir = document.getElementById('txt_dir').value;
			var ciud = document.getElementById('txt_ciud').value;
			var complem = document.getElementById('txt_complem').value;

			if (dn == '' || nomb == '' || papel == '' || sapel == '' || f_naci == '' || sex == '' || dir == '' || ciud == '' || complem == ''){
				alert('Faltan completar campos.');
				return;
			}

			var xhr;
			if (window.XMLHttpRequest) {
				xhr = new XMLHttpRequest();
			} else if(window.ActiveXObject){
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}

			var data = "";
			data = data + "dn=" + dn + "&";
			data = data + "nomb=" + nomb + "&";
			data = data + "papel=" + papel + "&";
			data = data + "sapel=" + sapel + "&";
			data = data + "f_naci=" + f_naci + "&";
			data = data + "sex=" + sex + "&";
			data = data + "dir=" + dir + "&";
			data = data + "ciud=" + ciud + "&";
			data = data + "complem=" + complem;

			xhr.open("POST", "registrar_persona.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(data);

			xhr.onreadystatechange = display_data;
			function display_data(){
				if (xhr.readyState == 4){
					if (xhr.status == 200){
						alert(xhr.responseText);
						window.location.href = 'nuevo_cliente.php';
					} else {
						alert('Ha ocurrido un problema.');
					}
				}
			}
		}
	</script>
</head>

<body>
	<div id="form">
	<table align="center" id="tabla_reg">
	<tbody>
		<tr>
			<td colspan="2"><legend style="font-size: 22pt; text-align: center; color: #0000FF"><b>Registro</b></legend></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">DNI:</label></td>
			<td><input type="number" id="txt_dn" min="11111111" max="99999999" /></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Nombre(s):</label></td>
			<td><input type="text" id="txt_nomb"></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Primer Apellido:</label></td>
			<td><input type="text" id="txt_papel"/></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Segundo Apellido:</label></td>
			<td><input type="text" id="txt_sapel"></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Fecha de Nacimiento:</label></td>
			<td><input type="date" id="txt_f_naci" min="1900-01-01" max="2100-31-12" /></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Sexo:</label></td>
			<td><input type="text" id="txt_sex"></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Dirección:</label></td>
			<td><input type="text" id="txt_dir"/></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Ciudad:</label></td>
			<td><input type="text" id="txt_ciud"></td>
		</tr>
		<tr>
			<td><label  style="font-size: 14pt;">Complemento:</label></td>
			<td><input type="text" id="txt_complem"/></td>
		</tr>
	</tbody>
	</table>
	<br/>
	<br/>
	<div class="sub2" align="center">
		<input type="submit" name="submit" id="boton" onclick="regi_persona()" value="Registrar">
		<?php

		?>
	</div>

	<br><br>
	<div class="sub1" align="center">
      	<input onclick="window.location.href='index.php'" type="button" name="boton" id="boton" value="Volver" />
    </div>
    </div>

</body>
</html>