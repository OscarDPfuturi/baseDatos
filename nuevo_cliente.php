<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Registro del Cliente</title>
	<link rel="shortcut icon" href="img/icon.png">
	<link rel="stylesheet" href="css/regis_estilo.css">
	<script type="text/javascript">
		function regi_cliente() {
			var dnip = document.getElementById('txt_dnip').value;
			var corr = document.getElementById('txt_corr').value;
			var nombs = document.getElementById('txt_nombs').value;
			var apels = document.getElementById('txt_apels').value;
			var contr = document.getElementById('txt_contr').value;

			if (dnip == '' || corr == '' || nombs == '' || apels == '' || contr == ''){
				alert('Faltan completar campos.');
				return;
			}

			var xhr;
			if (window.XMLHttpRequest) {
				xhr = new XMLHttpRequest();
			} else if(window.ActiveXObject){
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}

			var data2 = "";
			data2 = data2 + "dnip=" + dnip;

			xhr.open("POST", "registrar_cliente.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(data2);

			xhr.onreadystatechange = display_data;
			function display_data(){
				if (xhr.readyState == 4){
					if (xhr.status == 200){
						alert(xhr.responseText);
					} else {
						alert('Ha ocurrido un problema.');
					}
				}
			}

			var xhr;
			if (window.XMLHttpRequest) {
				xhr = new XMLHttpRequest();
			} else if(window.ActiveXObject){
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}

			var data1 = "";
			data1 = data1 + "corr=" + corr + "&";
			data1 = data1 + "nombs=" + nombs + "&";
			data1 = data1 + "apels=" + apels + "&";
			data1 = data1 + "contr=" + contr + "&";
			data1 = data1 + "dnip=" + dnip;

			xhr.open("POST", "registrar_cuenta.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(data1);

			xhr.onreadystatechange = display_data;
			function display_data(){
				if (xhr.readyState == 4){
					if (xhr.status == 200){
						alert(xhr.responseText);
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
			<td colspan="2"><legend style="font-size: 22pt; text-align: center; color: #0000FF"><b>Nuevo Cliente</b></legend></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">DNI:</label></td>
			<td><input type="number" id="txt_dnip" min="11111111" max="99999999" required /></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Correo:</label></td>
			<td><input type="email" id="txt_corr" placeholder="ejemplo@xmail.com" required></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Nombre(s):</label></td>
			<td><input type="text" id="txt_nombs" required /></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Apellido(s):</label></td>
			<td><input type="text" id="txt_apels"></td>
		</tr>
		<tr>
			<td><label style="font-size: 14pt;">Contraseña:</label></td>
			<td><input type="password" id="txt_contr" required /></td>
		</tr>
	</tbody>
	</table>
	<br/>
	<br/>
	<div class="sub2" align="center">
		<button type="submit" id="boton" onclick="regi_cliente()">Registrar</button>
	</div>
	</div>
</body>
</html>