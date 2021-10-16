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
<!DOCTYPE html>
<html>
  <head>
    <?php
      require "menu.php";
      include '../models/config.php';
     ?>
     <link rel="stylesheet" href="../css/tabla_cot.css">
  </head>
  <body>
    <title>Cotización</title>
    <div class="pagina col-xl-10" align="center">
      <div class="col-xl-7 offset-xl-3" style="align-content: center; margin-top:10%">
      <br>
         <?php
         $idusuario=$_SESSION['id_usuario'];
         $placa=isset($_POST['placa'])?$_POST['placa']:'';
         $tipo=isset($_POST['tipo'])?$_POST['tipo']:'';
         $categoria=isset($_POST['categoria'])?$_POST['categoria']:'';
         $modelo=isset($_POST['modelo'])?$_POST['modelo']:'';

         $cons="INSERT INTO cotizacion ( `placa`, `tipo`, `categoria`, `modelo`, `usuario`) VALUES('$placa', '$tipo', '$categoria', '$modelo', '$idusuario')";
         $link->query($cons);

         if ($modelo=="")
         {
           $model="";
         }
         elseif ($modelo<=2010)
         {
           $model="Modelos desde 2010 hacia atras";
         }
         elseif ($modelo>2010 && $modelo<=2021)
         {
           $model="Modelos desde 2011 hasta 2020";
         }
         elseif ($modelo<=1950 && $modelo>2021)
         {
           $model="Modelo Erroneo";
         }

        $sql1 = "SELECT modelo FROM soat WHERE tipo = '$tipo' AND modelo!='' ";
     		$result=$link->query($sql1);
     		$rows = $result->num_rows;

     		if($rows > 0)
        {
          //echo "Si hay filas";
          //echo "<br>modelo: <br><br><br>".$rows."<br><br><br><br><br>";
         $concat=$tipo.$categoria.$model;
        }
        else
        {
          //echo "No hay filas, ingreso al else";
          //echo "<br>modelo: <br><br><br>".$rows."<br><br><br><br><br>";
         $concat=$tipo.$categoria;
       }

           if(!empty($_POST["placa"]))
           {
               printf("
               <div class='table-users'>
                  <div class='header'>Cotización</div>
                  <table cellspacing='0'>
                     <tr>
                       <th>Foto</th>
                       <th>Tipo</th>
                       <th>Caracteristicas</th>
                       <th>Valor Prima</th>
                       <th>Total</th>
                     </tr>");
               $sql= $link->query("SELECT * FROM soat WHERE concat='$concat'");
             //	$result=$mysqli->query($sql);
             function asDollars($value) {
                 return '$' . number_format($value, 2);
               }
               while($row4=mysqli_fetch_array($sql))
               {
                 printf("<tr>");
                 echo "<td><img src='../img/".$tipo.".png' class='img'></td>";
                 printf("<td>".$row4['tipo']."</td>");
                 printf("<td>".$row4['caracteristicas']."</td>");
                 printf("<td>".asDollars($row4['vr_prima'])."</td>");
                 printf("<td>".asDollars($row4['total'])."</td>");
                 printf("</tr>");
               }
                 printf("</table></div>");
              // $link->close();
             }
          ?>
          <div align="center">
      			<a href="cotizacion.php" style="background-color:#439E9A;border: none; color: white; padding: 10px 20px; text-decoration: none; cursor: pointer;font-size:16px;">Volver a cotizar</a>
      		</div>
      </div>
    </div>
    <!--  Inicio PHP envio correo y registro  !-->
          <?php
              /* Estructura correo HTML */
              $sql2= $link->query("SELECT nombre FROM usuarios WHERE idusuario='$idusuario'");
              while($row2=mysqli_fetch_array($sql2))
              {
                $user=$row2['nombre'];
              }
              $asunto="Cotización";
              $mensaje="Placa: ".$placa."<br> Tipo: ".$tipo."<br> Categoria: ".$categoria."<br> Modelo: ".$modelo;
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
                            El usuario: '.$user.' </br>a solicitado una cotizacion con la siguiente información:
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

                try {
                    include '../models/email_conf.php';
                    //Recipients
                    $mail->setFrom($fromemail, $user);
                    $mail->addAddress('wialtamo@hotmail.com', 'Wilson Tamayo');     // Add a recipient
                    //$mail->addAddress('');               // Name is optional
                    //$mail->addReplyTo(''.$email.'', $user);
                    //$mail->addCC('');
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

                $link->close();
          ?>

          <!--  Fin PHP envio correo y registro  !-->
</body>
</html>
