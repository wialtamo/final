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
<html>
<head>
  <?php
    require "menu.php";
   ?>
</head>
  <?php
    include '../models/config.php';
  ?>
  <body>
    <title>Contacto</title>
  <style type="text/css">
  #formulario {
      background-color: transparent;
      margin: auto;
      padding: 10%;
      height: auto;
      width: auto;
  }
  </style>
  <div class="pagina col-xl-10" id="formulario" align="center">
        <form id="form1" name="form1" method="post" action="contacto.php">
              <fieldset class="col-xl-7 offset-xl-3" style="align-content: center">
                	<legend align="center" style="font-size:xx-large; color:#ffffff">Contáctenos</legend>
                  <br/>
          		  <ul>
                  <li>
                    <label for="tipo" style="font-size:20px; color:#ffffff">* Tipo:</label>
                    <select name="tipo" required="required">
                      <option value="">Seleccionar</option>
                      <option value="Consulta">Consulta</option>
                      <option value="Felicitacion">Felicitación</option>
                      <option value="Peticion">Petición</option>
                      <option value="Queja">Queja</option>
                      <option value="Reclamo">Reclamo</option>
                      <option value="Sugerencia">Sugerencia</option>
                    </select>
                  </li>
                  <br/>
          			<li>
          				<label for="email" style="font-size:20px; color:#ffffff">* Correo:</label>
          				<input name="email" type="email" required="required" id="email" maxlength="100">
                </li>
                <br/>
          			<li>
          				<label for="asunto" style="font-size:20px; color:#ffffff">* Asunto:</label>
                  <input name="asunto" type="text" required="required" id="asunto" maxlength="50">
          			</li>
                <br/>
                <label for="mensaje" style="font-size:20px; color:#ffffff">* Mensaje:</label>
              </br>
                <script>
                    /*  Contador de caracteres TextArea */
                      var inputs = "textarea[maxlength]";
                      $(document).on('keyup', "[maxlength]", function (e) {
                        var este = $(this),
                          maxlength = este.attr('maxlength'),
                          maxlengthint = parseInt(maxlength),
                          textoActual = este.val(),
                          currentCharacters = este.val().length;
                          remainingCharacters = maxlengthint - currentCharacters,
                          espan = este.prev('label').find('span');
                          // Detectamos si es IE9 y si hemos llegado al final, convertir el -1 en 0 - bug ie9 porq. no coge directamente el atributo 'maxlength' de HTML5
                          if (document.addEventListener && !window.requestAnimationFrame) {
                            if (remainingCharacters <= -1) {
                              remainingCharacters = 0;
                            }
                          }
                          espan.html(remainingCharacters);
                        });
                  </script>
          			<li>
                  <label for="mensaje"> Caracteres restantes: <span></span><br></label>
          				<textarea type="text" name="mensaje" id="mensaje" placeholder="Ingrese su solicitud" maxlength="1000" rows="10" cols="50"></textarea>
                </li>
                <br>
          		  </ul>
          		<div align="center">
          			<input type="submit" name="submit" id="submit" value="Enviar" style="background-color:#439E9A;border: none; color: white; padding: 6px 10px; text-decoration: none; margin: 4px 2px; cursor: pointer;font-size:14px;">
          		</div>
          </fieldset>
      </form>
      <!--  Inicio PHP envio correo y registro  !-->
      <?php
          $tipo=isset($_POST['tipo'])?$_POST['tipo']:'';
          $email=isset($_POST['email'])?$_POST['email']:'';
          $asunto=isset($_POST['asunto'])?$_POST['asunto']:'';
          $mensaje=isset($_POST['mensaje'])?$_POST['mensaje']:'';

          $id=$_SESSION['id_usuario'];

          $sql= $link->query("SELECT nombre FROM usuarios WHERE idusuario='$id'");
          while($row4=mysqli_fetch_array($sql))
          {
            $user=$row4['nombre'];
          }
          //$link->close();

          /* Estructura correo HTML */
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
                        El usuario: '.$user.' </br>a presentado la siguiente '.$tipo.':
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

          /* Envio de correo */

      if ($tipo=='' OR $email=='' OR $asunto=='' OR $mensaje=='')
  		{
  			echo "<script language='javascript'>alert('>Por Favor diligencie todos los campos<');</script>";
  		}
  		else
  		{
            try {
                  include '../models/email_conf.php';

                //Recipients
                $mail->setFrom($fromemail, $user);
                $mail->addAddress($email, 'Wilson Tamayo');     // Add a recipient
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
                echo "<script language='javascript'>alert('\\t Su ".$tipo." fue enviado\\n \\t\\t con exito');</script>";
                echo "<script language='javascript'>window.location.replace('contacto.php');</script>";

            } catch (Exception $e) {

                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $cons="INSERT INTO contacto ( `email`, `tipo`, `asunto`, `mensaje`, `usuario`) VALUES('$email', '$tipo', '$asunto', '$mensaje', '$id')";
            $link->query($cons);

            $link->close();
        }

      ?>

      <!--  Fin PHP envio correo y registro  !-->
  </div>

</body>
</html>
