<html>
  <head>
  <?php
    include '../models/config.php';
  ?>
  </head>
  <body>
      <!--  Inicio PHP envio correo y registro  !-->
      <?php

     date_default_timezone_set('America/Bogota');
      $dia=date("d");
      $mes=date("m");
      $ano=date("Y");
      $hoy=$ano."-".$mes."-".$dia;
      $fec1=new DateTime($hoy);
      //echo $hoy;

      $sql= $link->query("SELECT a.placa,a.idusuario,a.fecha_vencimiento, b.nombre, b.idusuario, b.correo FROM soat_servicios a, usuarios b WHERE a.idusuario=b.idusuario");
      while($row4=mysqli_fetch_array($sql))
      {
        $vencimiento=$row4['fecha_vencimiento'];
        $correo=$row4['correo'];
        $placa=$row4['placa'];
        $nombre=$row4['nombre'];

        $otr=new DateTime($vencimiento);
        $diff=$fec1->diff($otr);
        $dias=$diff->days;
        //echo $dias. " days ".$correo."<br>";

        if ($dias==0){
          $text= "El SOAT asociado a la placa <b>".$placa."</b><br> vence hoy";

          correo2($placa, $vencimiento,$correo,$text,$nombre);

        }
        elseif ($dias==5) {
          $text= "El SOAT asociado a la placa <b>".$placa."</b> <br>esta por vencer en <br>".$dias." días";
          correo2($placa, $vencimiento,$correo,$text,$nombre);
        }

      }

    function correo2($placa, $vencimiento,$correo,$text,$nombre)
    {
              $asunto="Vencimiento SOAT ".$vencimiento;
              $mensaje=$text;
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
                        <td colspan="2" height="150">
                        <center>
                        <img src="http://c2300112.ferozo.com/sii/img/calendar.svg" alt="calendar" title="SII logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="134">
                        </center>
                        </td>
                        <td  colspan="4" height="300">
                      <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#666666" align="center">
                            ¡Señor (a):<br>
                            '.$nombre.' <br>'.$text.'
                          </h3>
                        </br>
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
