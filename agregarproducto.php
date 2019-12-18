<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/stock_estilo.css">
    <link rel="shortcut icon" href="img/icon.png">
    <script type="text/javascript">
        function regi_producto(){
            var imag = document.getElementById('imagen').value;
            var cod = document.getElementById('txt_codigo').value;
            var prec = document.getElementById('txt_precio').value;
            var stk = document.getElementById('stock').value;

            if (imag == '' || cod == '' || prec == '' || stk == ''){
              alert('Faltan completar campos.');
              return;
            }
            console.log(imag);
           var xhr;
            if (window.XMLHttpRequest) {
              xhr = new XMLHttpRequest();
            } else if(window.ActiveXObject){
              xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            var data = "";
            data = data + "cod=" + cod + "&";
            data = data + "prec=" + prec + "&";
            data = data + "stk=" + stk + "&";
            data = data + "imag=" + imag;

            xhr.open("POST", "registrar_producto.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);

            xhr.onreadystatechange = display_data;
            function display_data(){
                if (xhr.readyState == 4){
                    if (xhr.status == 200){
                      alert(xhr.responseText);
                      window.location.href='agregarlaptop.php';
                    } else {
                      alert('Ha ocurrido un problema.');
                    }
                }
            }
          
        }
    </script>
</head>

<body>
<div id="form" method="POST" enctype="multipart/form-data">
  <table height="330" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" align="center"><h3><strong>INGRESE UN PRODUCTO A STOCK</strong></h3></td>
      </tr>
      <tr>
        <td class="detalle">Imagen:</td>
        <td width="225"><input type="file" name="imagen" id="imagen"></td>
      </tr>
      <tr>
        <td class="detalle">Código</td>
        <td><input type="number" name="txt_codigo" id="txt_codigo"></td>
      </tr>
      
      <tr>
        <td class="detalle">Precio:</td>
        <td><input type="number" name="txt_precio" id="txt_precio" min="1" step="0.1"></td>
      </tr>
      <tr>
        <td class="detalle">Stock:</td>
        <td><input type="number" name="stock" id="stock" min="1"></td>
      </tr>
    </tbody>
  </table>
  <br>

  <div class="botones" align="center">
  <button type="submit" id="submit" onclick="regi_producto()">Enviar</button>
  <input type="button" onclick="window.location.href='admin.php'" name="boton" id="boton" value="Cancelar">
  </div>

  <figure>
    <img align="center" src="img/nuevalaptop.jpg" alt="Agregando un nuevo producto" id="figura">
  </figure>
</div>
</body>
</html>

<!--<tr>
        <td class="detalle">Fecha:</td>
        <td><label for="fecha">
          <input type="text" name="fecha" id="fecha" value="<?php echo date("y-m-d");?>">
          <input type="text" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" name="pattern_fecha" id="pattern_fecha" placeholder="Ingrese una fecha" required/>
        </label></td>
      </tr>-->