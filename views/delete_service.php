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

if (isset($_GET['id_control'])){

  $id=$_GET['id_control'];
  $sql= $link->query("DELETE FROM soat_servicios WHERE idcontrol=$id");
  if (!$sql)
  {
    die ("Error de consulta");
  }
  $evento="eliminar";
  $detalle="Eliminacion del usuario: ".$id;
  $id2=$_SESSION['id_usuario'];
  $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id2')");
  header("location:service_full.php");
}
 ?>
