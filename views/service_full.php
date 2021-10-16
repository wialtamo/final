<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:login/index.php");
}
include '../models/config.php';
$id=$_SESSION['id_usuario'];
$sql= $link->query("SELECT perfil FROM usuarios WHERE idusuario='$id'");
while($row4=mysqli_fetch_array($sql))
{
  $perfil=$row4['perfil'];
}
if ($perfil!="admin")
{
  echo "<script language='javascript'>window.location.replace('service_view.php');</script>";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      require "menu.php";
      include '../models/config.php';
     ?>
     <link rel="stylesheet" href="../css/tabla_cot.css">
  </head>
  <body>
    <title>Administrar servicios</title>
    <div style="position:absolute; left:65%;
             top:10%;
             width:8%;
             height:11%;
             text-align:center;">
             <a href='crear_service.php'>
              <span class='u-uppercase'style="font-size:12px; color:#ffffff">Crear Servicio</span></br>
               <img src='../img/add-file.svg' height='60' width='60'>
             </a>
      </div>

    <div class="pagina col-xl-20" align="center">
      <div class="col-xl-10 offset-xl-5" style="align-content: center; margin-top:10%">
        <div class='table-users'>
                  <table cellspacing='0'>
                     <tr>
                       <th style="font-size:20px; color:#346F74">Placa</th>
                       <th style="font-size:20px; color:#346F74">Fecha de compra</th>
                       <th style="font-size:20px; color:#346F74">Fecha vigencia</th>
                       <th style="font-size:20px; color:#346F74">Fecha vencimiento</th>
                       <th style="font-size:20px; color:#346F74">Estado</th>
                       <th style="font-size:20px; color:#346F74">PDF</th>
                       <th colspan="2" style="font-size:20px; color:#346F74">Acción</th>
                     </tr>
                     <?php
                     $sql= $link->query("SELECT * FROM soat_servicios");
                     while($row4=mysqli_fetch_array($sql))
                     {
                       $idcontrol=$row4['idcontrol'];
                       ?>
                      <tr>
                        <td><?php echo $row4['placa']; ?></td>
                        <td><?php echo $row4['fecha_compra']; ?></td>
                        <td><?php echo $row4['fecha_vigencia']; ?></td>
                        <td><?php echo $row4['fecha_vencimiento']; ?></td>
                        <td><?php echo $row4['estado']; ?></td>
                        <td>
                          <a href="../file/<?php echo $row4['pdf']; ?>" target="_blank"><img src='../img/pdf.svg' height='25' width='25'></a>
                       </td>
                       <td>
                         <a href="edit_service.php?id_control=<?php echo $row4['idcontrol']; ?>"><img src='../img/edit.svg' height='25' width='25'></a>
                       </td>
                       <td>
                        <a href="javascript:js_Eliminar(<?=$idcontrol ?>)"><img src='../img/trash.svg' height='25' width='25'></a>

                        <script language='javascript'>
                         function js_Eliminar(idcontrol) {
                          	if (window.confirm("¿Está seguro que desea eliminar el registro seleccionado?")) {
                          	   	   location.href = "delete_service.php?id_control=" + idcontrol;
                          	}
                          }
                          </script>
                       </td>
                     </tr>
                    <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>
