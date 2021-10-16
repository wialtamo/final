<html>
  <head>
  </head>
  <body>
      <!--  Inicio PHP envio correo y registro  !-->
      <?php
      include '../models/config.php';
echo "Hola";
      date_default_timezone_set('America/Bogota');
      $dia=date("j");
      $mes=date("n");
      $ano=date("Y");
      $hoy=$mes."-".$dia;

      $sql= $link->query("SELECT nombre,correo,dia_nacimiento,mes_nacimiento,ano_nacimiento FROM usuarios");
      while($row4=mysqli_fetch_array($sql))
      {
        $dia=$row4['dia_nacimiento'];
        $mes=$row4['mes_nacimiento'];
        $ano=$row4['ano_nacimiento'];
        $nombre=$row4['nombre'];
        $correo= $row4['correo'];
        $nacimiento=$mes."-".$dia;

        if ($hoy==$nacimiento)
        {
           correo($nombre,$correo);
        }
      }

        function correo ($nombre,$correo)
        {
                $id=$_SESSION['id_usuario'];
                $asunto="Feliz cumpleaños";


                /* Estructura correo HTML */
                $cuerpo='<div class="pagina col-xl-10" id="formulario" align="center" background="#1673AE">
                    <table width="600" border="0">
                      <tbody>
                        <tr>
                          <td height="60" colspan="6" bgcolor="#E6EBEF" align="center">
                            <a href="#" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#677D9E">
                            <img src="http://c2300112.ferozo.com/sii/img/logo.png" alt="SII logo" title="SII logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="134"></a>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" height="150"><center>
                            <img src="http://c2300112.ferozo.com/sii/img/party-people.svg" alt="Feliz" width="134" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="SII logo" align="center">
                          </center>
                          </td>
                          <td  colspan="4" height="300">
                			  <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#666666" align="center">
                              ¡Hola!..<br>
                              '.$nombre.' <br>hoy en tu día <br> queremos desearte un feliz cumpleaños
                            </h3>
                          </br>
                		  <center>
                			  <img src="http://c2300112.ferozo.com/sii/img/happy-birthday.svg" alt="birthday" width="134" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="SII logo" align="center">
                		  </center>
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
                          <td  width="168">&nbsp;</td>
                          <td width="32"><img title="Facebook" src="http://c2300112.ferozo.com/sii/img/facebook.png" alt="Facebook" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                          <td width="65"><img title="Instagram" src="http://c2300112.ferozo.com/sii/img/instagram.png" alt="Instagram" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                          <td width="32"><img title="Twitter" src="http://c2300112.ferozo.com/sii/img/twitter.png" alt="Twitter" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                          <td width="174"><img title="YouTube" src="http://c2300112.ferozo.com/sii/img/youtube.png" alt="YouTube" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="32"></td>
                          <td  width="103">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>';
                /*--------------------------*/

                try {
                    include '../models/email_conf.php';
                    //Recipients
                    $mail->setFrom($fromemail, $nombre);
                    $mail->addAddress($correo, $nombre);     // Add a recipient


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

      }


      ?>
      <!--  Fin PHP envio correo y registro  !-->
  </div>
</body>
</html>
