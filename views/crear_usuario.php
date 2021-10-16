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

if (isset($_POST['submit'])) {

//$id = $_GET['id_usuario'];
$id2 = $_POST['cedula'];
$nomb = $_POST['nombre'];
$apell = $_POST['apellido'];
$nombre2 = $nomb." ".$apell;
$nacimiento2 = $_POST['nacimiento'];
list($anio, $mes, $dia) = explode("-", $nacimiento2);
//echo "Nacimiento: ".$nacimiento2."<br>";
//echo "Dia: ".$dia."<br>";
//echo "mes: ".$mes."<br>";
//echo "anio: ".$anio;
$telefono2 = $_POST['telefono'];
$direccion2 = $_POST['direccion'];
$email2 = $_POST['email'];
$usuario2 = $_POST['usuario'];
$password2 = md5($_POST['password']);
$tipo2 = $_POST['element_82'];
if ($_POST['element_82']=="cliente")
{
  $perfil2="estandar";
}
else
{
  $perfil2 = $_POST['element_57'];
}
$estado2 = "activo";

$sql= $link->query("INSERT INTO usuarios (idusuario, nombre, dia_nacimiento, mes_nacimiento, ano_nacimiento, telefono, direccion, correo, usuario, password, tipo, perfil, estado)
VALUES('$id2','$nombre2', '$dia', '$mes', '$anio', '$telefono2', '$direccion2', '$email2', '$usuario2', '$password2', '$tipo2', '$perfil2', '$estado2')");
$evento="insertar";
$detalle="Creación del usuario: ".$nombre2;
$id=$_SESSION['id_usuario'];
$sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id')");
echo "<script language='javascript'>alert('\\t Usuario creado \\n \\t\\t con exito');</script>";
echo "<script language='javascript'>window.location.replace('contr_usu.php');</script>";
}
?>
<html>
<head>
   <title>Crear Usuario</title>
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
        <form id="form1" name="form1" method="post" action="crear_usuario.php">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Crear usuario</legend>
                  <br/>
                  <br/>
          		  <ul>
                  <li>
                    <label for="cedula" style="font-size:20px; color:#ffffff">Cedula:</label>
                    <input type="number" name="cedula" id="number">
                  </li>
                  <br/>
                  <li>
                    <label for="nombre" style="font-size:20px; color:#ffffff">Nombre:</label>
                    <input type="text" name="nombre" id="textfield" placeholder="Nombre">
                    <input type="text" name="apellido" id="textfield2" placeholder="Apellido">
                  </li>
                  <br/>
                  <li>
                    <label for="nacimiento" style="font-size:20px; color:#ffffff">Nacimiento:</label>
                    <input type="date" name="nacimiento" id="date">
                  </li>
                  <br/>
                  <li>
                    <label for="telefono" style="font-size:20px; color:#ffffff">Celular:</label>
                    <input type="tel" name="telefono" id="tel">
                  </li>
                  <br/>
                  <li>
                    <label for="direccion" style="font-size:20px; color:#ffffff">Dirección:</label>
                    <input type="text" name="direccion" id="textfield3">
                  </li>
                  <br/>
                  <li>
                    <label for="email" style="font-size:20px; color:#ffffff">Correo:</label>
                    <input type="email" name="email" id="email">
                  </li>
                  <br/>
                  <li>
                    <label for="usuario" style="font-size:20px; color:#ffffff">Usuario:</label>
                    <input type="text" name="usuario" id="textfield4">
                  </li>
                  <br/>
                  <li>
                    <label for="password" style="font-size:20px; color:#ffffff">Contraseña:</label>
                    <input type="password" name="password" id="password">
                  </li>
                  <br/>
                    <script>
                        function cambio(X){
                            if(X == 'cliente'){
                              $("#element_57_1").attr('disabled','disabled');
                              $("#element_57_1").attr('checked', false);
                              $("#element_57_2").attr('disabled','disabled');
                              $("#element_57_2").attr('checked', false);
                            }else{
                              $("#element_57_1").removeAttr('disabled');
                              $("#element_57_2").removeAttr('disabled');
                              $("#element_57_1").attr('required', true);
                              $("#element_57_2").attr('required', true);
                            }
                          }
                      </script>
                      <li id="uno" >
                        <label class="description" style="font-size:20px; color:#ffffff">Tipo de usuario:</label><br/>
                        <span>
                            <input id="element_82_1" name="element_82" class="element radio" type="radio" value="cliente" required onClick="cambio(this.value);"/>
                            <label class="choice" >Cliente</label>
                            <input id="element_82_2" name="element_82" class="element radio" type="radio" value="empleado" onClick="cambio(this.value);"/>
                            <label class="choice" >Empleado</label>
                        </span>
                    </li>
                    <br/>
                    <li id="dos" >
                        <label class="description" for="element_57" style="font-size:20px; color:#ffffff">Perfil: </label><br/>
                        <span>
                            <input id="element_57_1" name="element_57" class="element radio" type="radio" value="estandar" disabled />
                            <label class="choice" >Estandar</label>
                            <input id="element_57_2" name="element_57" class="element radio" type="radio" value="admin" disabled />
                            <label class="choice" >Administrador</label>
                        </span>
                    </li>
                    </ul>
                    <br/>
                    <div align="center">
                			<input type="submit" name="submit" id="submit" value="Enviar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
                		</div>
                  </fieldset>
            </form>
        </div>
</body>
</html>
