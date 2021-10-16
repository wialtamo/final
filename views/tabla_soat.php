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
    <title>Editar usuario</title>
    <div class="pagina col-xl-20" align="center">
      <div class="col-xl-10 offset-xl-5" style="align-content: center; margin-top:5%">
        <div class='table-users' style="overflow:scroll; height:600px; width:850px">
                  <table cellspacing='0'>
                     <tr>
                       <th style="font-size:20px; color:#346F74">Tipo</th>
                       <th style="font-size:20px; color:#346F74">Código</th>
                       <th style="font-size:20px; color:#346F74">Caract.</th>
                       <th style="font-size:20px; color:#346F74">Modelo</th>
                       <th style="font-size:20px; color:#346F74">Vr Prima</th>
                       <th style="font-size:20px; color:#346F74">Ley 1093</th>
                       <th style="font-size:20px; color:#346F74">RUNT</th>
                       <th style="font-size:20px; color:#346F74">Total</th>
                       <th style="font-size:20px; color:#346F74">Acción</th>
                     </tr>
                     <?php
                     $sql= $link->query("SELECT * FROM soat");
                     while($row4=mysqli_fetch_array($sql))
                     {
                       $idusuario=$row4['idsoat'];
                       ?>

                      <tr>
                       <td><?php echo $row4['tipo']; ?></td>
                       <td><?php echo $row4['cod_tipo']; ?></td>
                       <td><?php echo $row4['caracteristicas']; ?></td>
                       <td><?php echo $row4['modelo']; ?></td>
                       <td><?php echo "$ ".number_format($row4['vr_prima']); ?></td>
                       <td><?php echo "$ ".number_format($row4['ley1093']); ?></td>
                       <td><?php echo "$ ".number_format($row4['runt']); ?></td>
                       <td><?php echo "$ ".number_format($row4['total']); ?></td>
                       <td align="center">
                         <a href="edit_soat.php?id_soat=<?php echo $row4['idsoat']; ?>"><img src='../img/edit.svg' align="right" height='25' width='25'></a>
                       </td>
                     </tr>
                    <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>
