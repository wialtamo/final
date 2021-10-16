<?php
// Información sobre la base de datos
$var_servidor_bd="localhost";  // Servidor de la base de datos
$var_nombre_bd="sii";  // Nombre de la base de datos
$var_usuario_bd="root";    // Usuario de la base de datos
$var_password_bd="";    // Contraseña de la base de datos

$link = mysqli_connect($var_servidor_bd, $var_usuario_bd, $var_password_bd, $var_nombre_bd);

if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

$link->query("SET NAMES 'utf8'");
//Fin información sobre la base de datos
?>
