<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:login/index.php");
}
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
              if($result <= 1)
        {
            include ('cumpleanio.php');
        }
    }
    header('location: welcome.php');
?>
