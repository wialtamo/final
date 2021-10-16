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

  if  (isset($_GET['id_control'])) {
    $id = $_GET['id_control'];
    $sql= $link->query("SELECT * FROM soat_servicios WHERE idcontrol='$id'");
    while($row4=mysqli_fetch_array($sql))
    {
      $placa=$row4['placa'];
      $poliza = $row4['idsoat'];
      $cliente = $row4['idusuario'];
      $compra = $row4['fecha_compra'];
      $inicio = $row4['fecha_vigencia'];
      $fin = $row4['fecha_vencimiento'];
      $estado = $row4['estado'];
    }
}
    if (isset($_POST['submit'])) {

      $placa = $_POST['placa'];
      $poliza = $_POST['poliza'];
      $cliente = $_POST['cliente'];
      $compra = $_POST['compra'];
      $inicio = $_POST['inicio'];
      $fin = $_POST['fin'];
      $estado = $_POST['estado'];

    $sql= $link->query("UPDATE soat_servicios SET placa='$placa', idsoat='$poliza', fecha_compra='$compra',
      fecha_vigencia='$inicio', fecha_vencimiento='$fin', estado='$estado' WHERE idcontrol='$id'");
      $evento="actualizar";
      $detalle="Actualización del servicio: ".$poliza.", placa:".$placa.", compra:".$compra;
      $id2=$_SESSION['id_usuario'];
      $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id2')");
    echo "<script language='javascript'>alert('\\t Modificacion realizada\\n \\t\\t con exito');</script>";
    echo "<script language='javascript'>window.location.replace('service_full.php');</script>";
  }
?>
<html>
<head>
   <title>Actualizar Usuario</title>
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
        <form id="form1" name="form1" method="POST" action="edit_service.php?id_control=<?php echo $id; ?>">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Actualizar servicios</legend>
                  <br/>
                  <br/>
          		  <ul>
                  <li>
                    <label for="placa" style="font-size:20px; color:#ffffff">Placa:</label>
                    <input type="text" name="placa" id="number" value="<?php echo $placa; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="poliza" style="font-size:20px; color:#ffffff">N° Poliza:</label>
                    <input type="number" name="poliza" id="textfield" placeholder="Nombre" value="<?php echo $poliza; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="cliente" style="font-size:20px; color:#ffffff">Cliente: </label>
                    <input type="text" name="cliente" id="date" value="<?php echo $cliente; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="compra" style="font-size:20px; color:#ffffff">Fecha de compra:</label>
                    <input type="date" name="compra" id="tel" value="<?php echo $compra; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="inicio" style="font-size:20px; color:#ffffff">Inicio de vigencia:</label>
                    <input type="date" name="inicio" id="textfield3" value="<?php echo $inicio; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="fin" style="font-size:20px; color:#ffffff">Fin de vigencia:</label>
                    <input type="date" name="fin" id="email" value="<?php echo $fin; ?>">
                  </li>
                  <br/>
                    <li>
                      <label for="estado" style="font-size:20px; color:#ffffff">* Estado:</label>
                      <select name="estado" required="required">
                        <option value="<?php echo $estado; ?>"><?php echo $estado; ?></option>
                        <option value="vigente">Vigente</option>
                        <option value="vencido">Vencido</option>
                      </select>
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
