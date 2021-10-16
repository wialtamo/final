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

  if  (isset($_GET['id_usuario'])) {
    $id = $_GET['id_usuario'];
    $sql= $link->query("SELECT * FROM usuarios WHERE idusuario=$id");
    while($row4=mysqli_fetch_array($sql))
    {
      $idusuario=$row4['idusuario'];
      $nombre = $row4['nombre'];
      $cumple = $row4['dia_nacimiento']."/".$row4['mes_nacimiento']."/".$row4['ano_nacimiento'];
      $telefono = $row4['telefono'];
      $direccion = $row4['direccion'];
      $correo = $row4['correo'];
      $usuario = $row4['usuario'];
      $password = $row4['password'];
      $tipo = $row4['tipo'];
      $perfil = $row4['perfil'];
      $estado = $row4['estado'];
    }
}
    if (isset($_POST['submit'])) {

    $id = $_GET['id_usuario'];
    $id2 = $_POST['cedula'];
    $nombre2 = $_POST['nombre'];
    $nacimiento2 = $_POST['nacimiento'];
    list($dia, $mes, $anio) = explode("/", $nacimiento2);
    $telefono2 = $_POST['telefono'];
    $direccion2 = $_POST['direccion'];
    $email2 = $_POST['email'];
    $usuario2 = $_POST['usuario'];
    $password2 = $_POST['password'];
    if($password==$password2)
    {
      $password3=$password2;
    }
    else {
      $password3=md5($password2);
    }

    $tipo2 = $_POST['element_82'];
    if ($_POST['element_82']=="cliente")
    {
      $perfil2="estandar";
    }
    else
    {
      $perfil2 = $_POST['element_57'];
    }
    $estado2 = $_POST['estado'];

    $sql= $link->query("UPDATE usuarios SET idusuario='$id2', nombre='$nombre2', dia_nacimiento='$dia',
      mes_nacimiento='$mes', ano_nacimiento='$anio', telefono='$telefono2', direccion='$direccion2',
      correo='$email2', usuario='$usuario2', password='$password3', tipo='$tipo2', perfil='$perfil2',
      estado='$estado2 ' WHERE idusuario=$id");
      $evento="actualizar";
      $detalle="Actualización del usuario: ".$nombre2;
      $id3=$_SESSION['id_usuario'];
      $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id3')");
    echo "<script language='javascript'>alert('\\t Modificacion realizada\\n \\t\\t con exito');</script>";
    echo "<script language='javascript'>window.location.replace('contr_usu.php');</script>";
  }
?>
<html>
<head>
   <title>Actualizar Usuario</title>
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
        <form id="form1" name="form1" method="POST" action="edit_user.php?id_usuario=<?php echo $idusuario; ?>">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Actualizar usuario</legend>
                  <br/>
                  <br/>
          		  <ul>
                  <li>
                    <label for="cedula" style="font-size:20px; color:#ffffff">Cedula:</label>
                    <input type="number" name="cedula" id="number" value="<?php echo $idusuario; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="nombre" style="font-size:20px; color:#ffffff">Nombre:</label>
                    <input type="text" name="nombre" id="textfield" placeholder="Nombre" value="<?php echo $nombre; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="nacimiento" style="font-size:20px; color:#ffffff">Nacimiento: </label>
                    <input type="text" name="nacimiento" id="date" value="<?php echo $cumple; ?>" placeholder="dd/mm/aaaa">
                  </li>
                  <br/>
                  <li>
                    <label for="telefono" style="font-size:20px; color:#ffffff">Celular:</label>
                    <input type="tel" name="telefono" id="tel" value="<?php echo $telefono; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="direccion" style="font-size:20px; color:#ffffff">Dirección:</label>
                    <input type="text" name="direccion" id="textfield3" value="<?php echo $direccion; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="email" style="font-size:20px; color:#ffffff">Correo:</label>
                    <input type="email" name="email" id="email" value="<?php echo $correo; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="usuario" style="font-size:20px; color:#ffffff">Usuario:</label>
                    <input type="text" name="usuario" id="textfield4" value="<?php echo $usuario; ?>">
                  </li>
                  <br/>
                  <li>
                    <label for="password" style="font-size:20px; color:#ffffff">Contraseña:</label>
                    <input type="password" name="password" id="password" value="<?php echo $password; ?>">
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
                    <br/>
                    <li>
                      <label for="estado" style="font-size:20px; color:#ffffff">* Estado:</label>
                      <select name="estado" required="required">
                        <option value="<?php echo $estado; ?>"><?php echo $estado; ?></option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                      </select>
                    </li>
                    <br/>
                    </ul>
                    <br/>
                    <div align="center">
                			<input type="submit" name="submit" id="submit" value="Actualizar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
                		</div>
                  </fieldset>
            </form>
        </div>
</body>
</html>
