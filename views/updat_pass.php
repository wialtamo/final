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

    $id = $_SESSION['id_usuario'];
    /* Envio de correo */


function correo ($id)
{
        //  Inicio PHP envio correo y registro  !-->
          include '../models/config.php';
            /* Estructura correo HTML */
            $sql2= $link->query("SELECT nombre,correo FROM usuarios WHERE idusuario='$id'");
            while($row2=mysqli_fetch_array($sql2))
            {
              $user=$row2['nombre'];
              $correo= $row2['correo'];
            }
            $asunto="Actualización de contraseña";
            $mensaje="Su contraseña ha sido actualizada";
            $cuerpo='<div class="pagina col-xl-10" id="formulario" align="center" background="#1673AE">
                <table width="600" border="0">
                  <tbody>
                    <tr>
                      <td height="60" colspan="6" bgcolor="#E6EBEF" align="center">
                        <a href="#" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#677D9E">
                        <img src="http://cyfo.net/sii/img/logo.png" alt="SII logo" title="SII logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="134"></a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="6" height="300">
                        <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#666666">
                          El usuario: '.$user.' </br>a realizado una actualizacion de contraseña
                        </h3>
                      </br>
                      <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica, sans-serif;line-height:21px;color:#999999">
                        '.$asunto.'
                      </p>
                      </br>
                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica, sans-serif;line-height:21px;color:#999999">
                          '.$mensaje.'
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="6" height="60" bgcolor="#E6EBEF">
                        <br>
                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:arial, helvetica, sans-serif;line-height:20px;color:#999999" align="center">
                          Recibió este correo electrónico porque visitó nuestro sitio y nos solicitó información.
                        </p>
                        <br>
                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:arial, helvetica, sans-serif;line-height:20px;color:#999999" align="center">
                          CR 48 98 A SUR 367 KM 4 VTE CALDAS BG 103 / Antioquia, La Estrella. Colombia
                        </p>
                        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:arial, helvetica, sans-serif;line-height:20px;color:#999999" align="center">
                          Todos los derechos reservados © 2021 SII.
                        </p>
                      </td>
                    </tr>
                    <tr height="60">
                      <td  width="230">&nbsp;</td>
                      <td><img title="Facebook" src="http://cyfo.net/sii/img/facebook.png" alt="Facebook" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                      <td><img title="Instagram" src="http://cyfo.net/sii/img/instagram.png" alt="Instagram" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                      <td><img title="Twitter" src="http://cyfo.net/sii/img/twitter.png" alt="Twitter" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                      <td><img title="YouTube" src="http://cyfo.net/sii/img/youtube.png" alt="YouTube" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                      <td  width="230">&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>';
            /*--------------------------*/

              try {
                  include '../models/email_conf.php';

                  //Recipients
                  $mail->setFrom($fromemail, $user);
                  $mail->addAddress($correo, 'Wilson Tamayo');     // Add a recipient
                  //$mail->addAddress('');               // Name is optional
                  //$mail->addReplyTo(''.$email.'', $user);
                //  $mail->addCC('');
                  //$mail->addBCC('bcc@example.com');
                  //echo "Usuario: ".$user;
                  // Attachments
                //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                  // Content
                  $mail->isHTML(true);
                  $mail->CharSet = 'UTF-8';                                  // Set email format to HTML
                  $mail->Subject = $asunto;
                  $mail->Body = $cuerpo;
                  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  $mail->send();
                  //echo "<script language='javascript'>alert('\\t Su ".$tipo." fue enviado\\n \\t\\t con exito');</script>";
                  //echo "<script language='javascript'>window.location.replace('contacto.php');</script>";

              } catch (Exception $e) {

                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }

              //$link->close();

        //  Fin PHP envio correo y registro
}

    if (isset($_POST['submit'])) {

      $actual = md5($_POST['actual']);
      $nuevo = md5($_POST['nuevo']);
      $confirm = md5($_POST['confirm']);

      $sql= $link->query("SELECT * FROM usuarios WHERE idusuario=$id");
      while($row4=mysqli_fetch_array($sql))
      {
        $password = $row4['password'];
        $user=$row4['nombre'];
      }
    if ($nuevo==$confirm)
    {
      if ($actual==$password)
      {
        //$password2=md5($nuevo);
        $sql= $link->query("UPDATE usuarios SET password='$nuevo' WHERE idusuario=$id");
        echo "<script language='javascript'>alert('\\t Modificacion realizada\\n \\t\\t con exito');</script>";
        $evento="actualizar";
        $detalle="Actualización de la contraseña del usuario: ".$user;
        $sql= $link->query("INSERT INTO auditoria (evento, detalle, usuario) VALUES('$evento','$detalle', '$id')");
        correo ($id);
        echo "<script language='javascript'>window.location.replace('ver_info.php');</script>";
      }
      else {
        echo "<script language='javascript'>alert('\\t Su contraseña actual\\n \\t\\t presenta errores');</script>";
      }
    }
    else {
      echo "<script language='javascript'>alert('\\t Las contraseñas nuevas\\n \\t\\t no coinciden');</script>";
    }
  }
?>
<html>
<head>
   <title>Cambiar Contraseña</title>
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
        <form id="form1" name="form1" method="POST" action="updat_pass.php">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Cambiar contraseña</legend>
                  <br/>
                  <br/>
          		  <ul>
                  <li>
                    <label for="actual" style="font-size:20px; color:#ffffff">Contraseña actual:</label>
                    <input type="password" name="actual" id="number" value="">
                  </li>
                  <br/>
                  <li>
                    <label for="nuevo" style="font-size:20px; color:#ffffff">Contraseña nueva:</label>
                    <input type="password" name="nuevo" id="textfield" value="">
                  </li>
                  <br/>
                  <li>
                    <label for="confirm" style="font-size:20px; color:#ffffff">Confirmar contraseña: </label>
                    <input type="password" name="confirm" id="date" value="">
                  </li>
                    <br/>
                    </ul>
                    <br/>
                    <div align="center">
                			<input type="submit" name="submit" id="submit" value="Cambiar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
                		</div>
                  </fieldset>
            </form>
        </div>
</body>
</html>
