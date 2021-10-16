<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:login/index.php");
}
$id_usuario=$_SESSION['id_usuario'];
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
    <title>Info Servicios</title>
    <div class="pagina col-xl-20" align="center">
      <div class="col-xl-10 offset-xl-5" style="align-content: center; margin-top:10%">
        <div class='table-users'>
          <legend align="center" style="font-size:xx-large; color:#ffffff">Servicios asociados</legend>
                  <table cellspacing='0'>
                     <tr>
                       <th style="font-size:20px; color:#346F74">Placa</th>
                       <th style="font-size:20px; color:#346F74">Fecha de compra</th>
                       <th style="font-size:20px; color:#346F74">Fecha vigencia</th>
                       <th style="font-size:20px; color:#346F74">Fecha vencimiento</th>
                       <th style="font-size:20px; color:#346F74">Estado</th>
                       <th style="font-size:20px; color:#346F74">PDF</th>
                     </tr>
                     <?php
                     $sql= $link->query("SELECT * FROM soat_servicios WHERE idusuario='$id_usuario'");
                     while($row4=mysqli_fetch_array($sql))
                     {
                       ?>
                      <tr>
                       <td><?php echo $row4['placa']; ?></td>
                       <td><?php echo $row4['fecha_compra']; ?></td>
                       <td><?php echo $row4['fecha_vigencia']; ?></td>
                       <td><?php echo $row4['fecha_vencimiento']; ?></td>
                       <td><?php echo $row4['estado']; ?></td>
                       <td>
                         <a href="../file/<?php echo $row4['pdf']; ?>"><img src='../img/pdf.svg' height='25' width='25'></a>
                      </td>
                     </tr>
                    <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>
