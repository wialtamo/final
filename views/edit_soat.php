<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:login/index.php");
}
require "menu.php";
include '../models/config.php';

  if  (isset($_GET['id_soat'])) {
    $id = $_GET['id_soat'];
    $sql= $link->query("SELECT * FROM soat WHERE idsoat=$id");
    while($row4=mysqli_fetch_array($sql))
    {
      $idsoat=$row4['idsoat'];
      $tipo = $row4['tipo'];
      $caracteristica = $row4['caracteristicas'];
      $modelo = $row4['modelo'];
      $vrl_prima = $row4['vr_prima'];
      $ley1093 = $row4['ley1093'];
      $runt = $row4['runt'];
      $total = $row4['total'];
    }
}
    if (isset($_POST['submit']))
    {

      $id = $_GET['id_soat'];
      $vrl_prima2 = $_POST['vrl_prima'];
      $ley10932 = $_POST['ley1093'];
      $runt2 = $_POST['runt'];
      $total2 = $_POST['total'];

      $sql= $link->query("UPDATE soat SET vr_prima='$vrl_prima2', ley1093='$ley10932', runt='$runt2', total='$total2' WHERE idsoat=$id");
      $evento="actualizar";
      $detalle="Actualización de la tarifa soat: ".$id.", prima=".$vrl_prima2.", ley1093=".$ley10932.", runt=".$runt2.", total=".$total2;
      $id2=$_SESSION['id_usuario'];
      $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id2')");
      echo "<script language='javascript'>alert('\\t Modificacion realizada\\n \\t\\t con exito');</script>";
      echo "<script language='javascript'>window.location.replace('tabla_soat.php');</script>";
    }
?>
<html>
<head>
   <title>Actualizar Tarifas</title>
</head>
<style type="text/css">
#formulario {
    background-color: transparent;
    margin: auto;
    padding: 8%;
    height: auto;
    width: auto;
}
</style>
<body>
  <div class="pagina col-xl-10" id="formulario" align="center">
        <form id="form1" name="form1" method="POST" action="edit_soat.php?id_soat=<?php echo $idsoat; ?>">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Actualizar usuario</legend>
                  <br/>
                  <br/>
          		  <ul>
                    <li>
                    <label for="tipo" style="font-size:20px; color:#ffffff">Tipo:</label>
                    <label for="tipo" style="font-size:15px; color:#439E9A"><?php echo $tipo; ?></label>
                  </li>
                  <br/>
                  <li>
                    <label for="caracteristica" style="font-size:20px; color:#ffffff">Caracteristica:</label>
                    <label for="caracteristica" style="font-size:15px; color:#439E9A"><?php echo $caracteristica; ?></label>

                  </li>
                  <br/>
                  <li>
                    <label for="modelo" style="font-size:20px; color:#ffffff">Modelo:</label>
                    <label for="modelo" style="font-size:15px; color:#439E9A"><?php echo $modelo; ?></label>
                  </li>
                  <br/>
                  <li>
                    <label for="vrl_prima" style="font-size:20px; color:#ffffff">Vlr Prima:</label>
                    <input type="number" name="vrl_prima" value="<?php echo $vrl_prima; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="ley1093" style="font-size:20px; color:#ffffff">Ley 1093:</label>
                    <input type="number" name="ley1093" value="<?php echo $ley1093; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="runt" style="font-size:20px; color:#ffffff">Runt:</label>
                    <input type="number" name="runt" value="<?php echo $runt; ?>">
                  </li>
                    <br/>
                    <li>
                      <label for="total" style="font-size:20px; color:#ffffff">Total:</label>
                      <input type="number" name="total" value="<?php echo $total; ?>">
                    </li>
                      <br/>
                    </ul>
                    <br/>
                    <div align="center">
                			<input type="submit" name="submit" id="submit" value="Actualizar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
                		</div>
                  </fieldset>
            </form>
        </div>
</body>
</html>
