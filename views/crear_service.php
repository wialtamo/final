<?php

//abrimos la sesión
session_start();
//Si la variable sesión está vacía
if (!isset($_SESSION['id_usuario']))
{
   /* nos envía a la siguiente dirección en el caso de no poseer autorización */
   header("location:../login/index.php");
}

include "menu.php";
include '../models/config.php';

?>
<html>
<head>
   <title>Crear Servicio</title>
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
        <form id="form1" name="form1" method="post" action="crear_service.php" enctype="multipart/form-data">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Crear Servicio</legend>
                  <br/>
                  <br/>
          		  <ul>
                  <li>
                    <label for="placa" style="font-size:20px; color:#ffffff">Placa:</label>
                    <input type="text" name="placa" id="number" size="6" style="text-transform:uppercase;">
                  </li>
                  <br/>
                  <li>
                    <label for="poliza" style="font-size:20px; color:#ffffff">N° de poliza:</label>
                    <input type="number" name="poliza" id="poliza">
                  </li>
                  <br/>
                  <li>
                    <label for="cliente" style="font-size:20px; color:#ffffff">Cliente:</label>
                    <input type="number" name="cliente" id="cliente">
                  </li>
                  <br/>
                  <li>
                    <label for="compra" style="font-size:20px; color:#ffffff">Fecha compra:</label>
                    <input type="date" name="compra" id="compra">
                  </li>
                  <br/>
                  <li>
                    <label for="inicio" style="font-size:20px; color:#ffffff">Inicio Vigencia:</label>
                    <input type="date" name="inicio" id="inicio">
                  </li>
                  <br/>
                  <li>
                    <label for="fin" style="font-size:20px; color:#ffffff">Fin Vigencia:</label>
                    <input type="date" name="fin" id="fin">
                  </li>
                  <br/>
                  <li>
                    <label for="file" style="font-size:20px; color:#ffffff">Archivo:</label>
                    <input type="file" name="file" id="file">
                  </li>
                  <br/>
                  <li>
                    <label for="estado" style="font-size:20px; color:#ffffff">Estado:</label>
                    <select name="estado" id="estado">
                      <option value='' >Elige</option>
                      <option value='vigente'>Vigente</option>
                      <option value='vencido'>Vencido</option>
                    </select>
                  </li>
                    </ul>
                    <br/>
                    <div align="center">
                			<input type="submit" name="submit" id="submit" value="Crear" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
                		</div>
                  </br>
                    <p>Por favor diligencie estos datos con la información del documento SOAT</p>
                  </fieldset>
            </form>
        </div>
</body>
</html>
<?php

if (isset($_POST['submit'])) {

$id = $_SESSION['id_usuario'];
$placa = $_POST['placa'];
$poliza = $_POST['poliza'];
$cliente = $_POST['cliente'];
$compra = $_POST['compra'];
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];
$estado = $_POST['estado'];

//datos del arhivo
//$nombre_archivo = $_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];
$tamano_archivo = $_FILES['file']['size'];
//$carpeta= "../file/";
$filename = tempnam('../file', '.');
list ($ruta,$nombre,$ext)=explode(".",$filename);
$pdf=$nombre.".pdf";
rename($filename, $nombre .= '.pdf');
unlink($nombre);

//echo "archivo: ".$tipo_archivo;
//compruebo si las características del archivo son las que deseo
if (!((strpos($tipo_archivo, "pdf") && ($tamano_archivo < 1572864)))) {
   //echo "archivo: ".$tipo_archivo."fin <br>";
   	echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf <br><li>se permiten archivos de 1.5 MB máximo.</td></tr></table>";
}else{
   	if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta.$nombre)){

        $sql= $link->query("INSERT INTO soat_servicios (placa, idsoat, idusuario, fecha_compra, fecha_vigencia, fecha_vencimiento, pdf, estado, usuarios_idusuario)
        VALUES('$placa','$poliza', '$cliente', '$compra', '$inicio', '$fin', '$nombre', '$estado', '$id')");
        $evento="insertar";
        $detalle="Creación del servicio: ".$poliza;
        $id2=$_SESSION['id_usuario'];
        $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id2')");
        echo "<script language='javascript'>alert('\\t Servicio creado \\n \\t\\t con exito');</script>";
          echo "<script language='javascript'>window.location.replace('service_full.php');</script>";

   	}else{

          echo "archivo: ".$tipo_archivo."<br>";
          echo "<script language='javascript'>alert('\\t Ocurrió algún error al subir el fichero \\n \\t\\t  No pudo guardarse.');</script>";
          //echo "<script language='javascript'>window.location.replace('../service_full.php');</script>";
   	}
}

//$sql= $link->query("INSERT INTO usuarios (idusuario, nombre, dia_nacimiento, mes_nacimiento, ano_nacimiento, telefono, direccion, correo, usuario, password, tipo, perfil, estado)
//VALUES('$id2','$nombre2', '$dia', '$mes', '$anio', '$telefono2', '$direccion2', '$email2', '$usuario2', '$password2', '$tipo2', '$perfil2', '$estado2')");
}

 ?>
