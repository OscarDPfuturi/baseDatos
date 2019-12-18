<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Agregar Laptop</title>
  <link rel="stylesheet" href="css/stock_estilo.css">
  <link rel="shortcut icon" href="img/icon.png">
  <script type="text/javascript">
    function regi_laptop() {
      var cod = document.getElementById('txt_codigo').value;
      var model = document.getElementById('txt_modelo').value;
      var disc = document.getElementById('txt_discoduro').value;
      var pant = document.getElementById('txt_pantalla').value;
      var proc = document.getElementById('txt_proces').value;
      var sist = document.getElementById('txt_so').value;
      var pes = document.getElementById('txt_peso').value;
      var rm = document.getElementById('txt_ram').value;
      var tarj = document.getElementById('txt_tarj').value;

      if (cod == '' || model == '' || disc == '' || pant == '' || proc == '' || sist == '' || pes == '' || rm == '' || tarj == ''){
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
      data2 = data2 + "cod=" + cod + "&";
      data2 = data2 + "disc=" + disc + "&";
      data2 = data2 + "pant=" + pant + "&";
      data2 = data2 + "proc=" + proc + "&";
      data2 = data2 + "sist=" + sist + "&";
      data2 = data2 + "pes=" + pes + "&";
      data2 = data2 + "rm=" + rm + "&";
      data2 = data2 + "tarj=" + tarj + "&";
      data2 = data2 + "model=" + model;

      xhr.open("POST", "registrar_laptop.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send(data2);

      xhr.onreadystatechange = display_data2;
      function display_data2(){
        if (xhr.readyState == 4){
          if (xhr.status == 200){
            alert(xhr.responseText);
          } else {
            alert('Ha ocurrido un problema.');
          }
        }
      }
      alert('End function');
    }
  </script>
</head>

<body>
<form method="post" id="agregar" enctype="multipart/form-data">
  <table height="330" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" align="center"><h3><strong>INGRESE LOS DETALLES DEL PRODUCTO</strong></h3></td>
      </tr>
      <tr>
        <td class="detalle">Código</td>
        <td><label for="codigo">
        	<input type="number" name="txt_codigo" id="txt_codigo" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Modelo:</td>
        <td><label for="modelo">
        	<input type="text" name="txt_modelo" id="txt_modelo" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Disco Duro:</td>
        <td><label for="discoduro">
          <input type="text" name="txt_discoduro" id="txt_discoduro" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Pantalla (pulgadas):</td>
        <td><label for="pantalla">
          <input type="number" name="txt_pantalla" id="txt_pantalla" min="1" step="0.1" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Procesador:</td>
        <td><label for="proces">
          <input type="text" name="txt_proces" id="txt_proces" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">SO:</td>
        <td><label for="so">
          <input type="text" name="txt_so" id="txt_so" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Peso:</td>
        <td><label for="peso">
          <input type="number" name="txt_peso" id="txt_peso" min="1" step="0.1" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">RAM:</td>
        <td><label for="ram">
          <input type="number" name="txt_ram" id="txt_ram" min="2" step="2.0" required>
        </label></td>
      </tr>
      <tr>
        <td class="detalle">Tarjeta Gráfica:</td>
        <td><label for="tarj">
          <input type="text" name="txt_tarj" id="txt_tarj" required>
        </label></td>
      </tr>

      <tr>
        <td class="botones" colspan="2" align="center">
          <input type="submit" name="submit" id="submit" value="Enviar" onclick="regi_laptop()">
      </tr>
    </tbody>
  </table>

  <figure>
    <img align="center" src="img/nuevalaptop.jpg" alt="Agregando una nueva laptop" id="figura">
  </figure>
</form>
</body>
</html>