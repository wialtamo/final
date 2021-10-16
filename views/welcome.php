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
     ?>
  </head>
  <body>
    <title>Inicio</title>
      <div class="pagina col-xl-10" align="center">
        <div class="col-xl-7 offset-xl-3" style="align-content: center; margin-top:10%">
          <h1 style="font-size:30px;"> Bienvenid@:</h1>
          <br>
          <?php
              include '../models/config.php';
              $id=$_SESSION['id_usuario'];

              $sql= $link->query("SELECT nombre FROM usuarios WHERE idusuario='$id'");
              while($row4=mysqli_fetch_array($sql))
              {
                $user=$row4['nombre'];
              }
              $link->close();
           ?>
          <h2 style="font-size:40px;"><?php echo $user;?></h2>
          <br>
          <br>
          <br>
          <img src="../img/logo.png" alt="Financial logo" title="Financial logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="200">
        </div>
      </div>
  <?php
      $idusuario=$_SESSION['id_usuario'];

      include ("../models/config.php");

      date_default_timezone_set('America/Bogota');
      $dia=date("d");
      $mes=date("m");
      $ano=date("Y");
      $hoy=$ano."-".$mes."-".$dia;

          $sql1= $link->query("SELECT perfil FROM usuarios WHERE idusuario=$idusuario");
          while($row1=mysqli_fetch_array($sql1))
          {
            $perfil=$row1['perfil'];
          }
          if ($perfil=="admin")
          {

            $sql2= $link->query("SELECT perfil,fecha FROM registro WHERE perfil='admin' AND fecha LIKE '%$hoy%'");
            $result=mysqli_num_rows($sql2);
        		//$rows = $result->mysqli_num_rows;
            	if($result <= 1)
              {
                  include ('vencimientos.php');
              }
          }
    ?>
  </body>
</html>
