<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:login/index.php");
}
?>
<html>
<head>
  <?php
  require "menu.php";
   ?>
</head>
  <?php
    include '../models/config.php';
  ?>
  <body>
    <title>Cotizador</title>
  <style type="text/css">
  #formulario {
      background-color: transparent;
      margin: auto;
      padding: 10%;
      height: auto;
      width: auto;
  }
  </style>
  <div class="pagina col-xl-10" id="formulario" align="center">
    <form id="form1" name="form1" method="POST" action="cot_view.php">
      <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
        	<legend align="center" style="font-size:xx-large; color:#ffffff">Cotizacion SOAT</legend>
          <br/>
  		  <ul>
  			<li>
  				<label for="placa" style="font-size:20px; color:#ffffff">* Placa:</label>
  				<input name="placa" type="text" required="required" id="placa" placeholder="Ingrese su placa" size="58" style="text-transform:uppercase;">
        </li>
        <br/>
  			<li>
  				<label for="tipo" style="font-size:20px; color:#ffffff">* Tipo:</label>
          <script>
               function obtenerCategorias(val)
               {
                   $.ajax
                   ({
                      type: "POST",
                      url: "../controllers/get_categoria.php",
                      data:'id_tipo='+val,
                      success: function(data)
                      {
                         $("#lista_categorias").html(data);
                      }
                    });
                }
          </script>

          <?php
            $consulta_tipos   = $link->query("select DISTINCT tipo as 'valor', tipo as 'descripcion' from soat order by tipo");
            $consulta_categorias = $link->query("select DISTINCT cod_tipo as 'valor', Caracteristicas as 'descripcion' from soat order by cod_tipo");
          ?>
          <select name="tipo" onChange="obtenerCategorias(this.value);">
            <option value="">Seleccionar</option>
            <?php
              while($row= $consulta_tipos->fetch_object())
              {
                echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
              }
            ?>
          </select>
  			</li>
        <br/>
  			<li>
  				<label for="categoria" style="font-size:20px; color:#ffffff">* Caracteristica:</label>
          <select name="categoria" id="lista_categorias" >
            <option value="">Seleccionar</option>
            <?php
            if(!empty($_POST["id_tipo"]))
            {
              while($row= $consulta_categorias->fetch_object())
               {
                echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
               }
            }
            ?>
          </select>
  			</li>
        <br/>
  			<li>
  				<label for="modelo" style="font-size:20px; color:#ffffff">Modelo:</label>
  				<input type="text" name="modelo" id="modelo" placeholder="Ingrese su modelo" size="58">
  			</li>
        <br>
  		  </ul>
  		<div align="center">
  			<input type="submit" name="submit" id="submit" value="Enviar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
  		</div>
  </fieldset>
  </form>
  </div>
</body>
</html>
