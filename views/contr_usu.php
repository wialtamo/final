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
    <div style="position:absolute; left:65%;
             top:10%;
             width:8%;
             height:11%;
             text-align:center;">
             <a href='crear_usuario.php'>
              <span class='u-uppercase'style="font-size:12px; color:#ffffff">Crear Usuarios</span></br>
               <img src='../img/add_user.png' height='60' width='60'>
             </a>
      </div>

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
                       <th colspan="2" style="font-size:20px; color:#346F74">Acción</th>
                     </tr>
                     <?php
                     $sql= $link->query("SELECT * FROM usuarios");
                     while($row4=mysqli_fetch_array($sql))
                     {
                       $idusuario=$row4['idusuario'];
                       ?>
                      <tr>
                       <td><?php echo $row4['idusuario']; ?></td>
                       <td><?php echo $row4['nombre']; ?></td>
                       <td><?php echo $row4['telefono']; ?></td>
                       <td><?php echo $row4['correo']; ?></td>
                       <td><?php echo $row4['usuario']; ?></td>
                       <td><?php echo $row4['estado']; ?></td>
                       <td>
                         <a href="edit_user.php?id_usuario=<?php echo $row4['idusuario']; ?>"><img src='../img/edit.svg' height='25' width='25'></a>
                       </td>
                       <td>
                        <a href="javascript:js_Eliminar(<?=$idusuario ?>)"><img src='../img/trash.svg' height='25' width='25'></a>

                        <script language='javascript'>
                         function js_Eliminar(idusuario) {
                          	if (window.confirm("¿Está seguro que desea eliminar el registro seleccionado?")) {
                          	   	   location.href = "delete_user.php?id_usuario=" + idusuario;
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
