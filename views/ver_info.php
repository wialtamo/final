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
    <title>Info usuario</title>
    <div class="pagina col-xl-20" align="center">
      <div class="col-xl-10 offset-xl-5" style="align-content: center; margin-top:10%">
        <div class='table-users'>
                  <table cellspacing='0'>
                     <tr>
                       <th style="font-size:20px; color:#346F74">N° Usuario</th>
                       <th style="font-size:20px; color:#346F74">Nombre</th>
                       <th style="font-size:20px; color:#346F74">Teléfono</th>
                       <th style="font-size:20px; color:#346F74">Correo</th>
                       <th style="font-size:20px; color:#346F74">Usuario</th>
                       <th style="font-size:20px; color:#346F74">Estado</th>
                     </tr>
                     <?php
                     $sql= $link->query("SELECT * FROM usuarios WHERE idusuario='$id_usuario'");
                     while($row4=mysqli_fetch_array($sql))
                     {                       
                       ?>
                      <tr>
                       <td><?php echo $row4['idusuario']; ?></td>
                       <td><?php echo $row4['nombre']; ?></td>
                       <td><?php echo $row4['telefono']; ?></td>
                       <td><?php echo $row4['correo']; ?></td>
                       <td><?php echo $row4['usuario']; ?></td>
                       <td><?php echo $row4['estado']; ?></td>
                     </tr>
                    <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>
