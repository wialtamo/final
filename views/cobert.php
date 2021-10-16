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
<link rel="stylesheet" href="../css/tabla_cobert.css">
  </head>
  <body>
    <title>Coberturas</title>
    <div class="pagina col-xl-10" align="center">
      <div class="col-xl-7 offset-xl-3" style="align-content: center; margin-top:5%">
        <div class='table-users'>
          <table border="1" >
            <tbody>
              <tr>
                <td height="60" width="500" colspan="6" bgcolor="#FFF" align="center">
                <h3 style="font-size:20px">Las coberturas que tiene incorporado el SOAT y sus cuantías por víctima son: </h3>
                <p>&nbsp;</p>
              </td>
              </tr>
              <tr>
                <td>
                  <table>
                  <tbody>
                    <tr>
                      <th>Cobertura</th>
                      <th>Cuantía</th>
                      <th>Valor en pesos </br>(2021)</th>
                    </tr>
                    <tr>
                      <td>Gastos de transporte y movilización de las víctimas [1]</td>
                      <td>Hasta 10 SMLDV*</td>
                      <td>$ 302.842</td>
                    </tr>
                    <tr>
                      <td>Incapacidad permanente [2]</td>
                      <td>Hasta 180 SMLDV*</td>
                      <td>$ 5.451.156</td>
                    </tr>
                    <tr>
                      <td>Gastos médicos, quirúrgicos, farmacéuticos y hospitalarios</td>
                      <td>Hasta 800 SMLDV*</td>
                      <td>$ 24.227.360</td>
                    </tr>
                    <tr>
                      <td>Muerte de la víctima [3]</td>
                      <td>750 SMLDV*</td>
                      <td>$ 22.713.150</td>
                    </tr>
                  </tbody>
                </table>
              </td>
              </tr>
              <tr>
                <td height="60" width="500" colspan="6" bgcolor="#FFF" align="center"><p>&nbsp;</p>
                <p>
                  [1] El transporte y movilización de las víctimas a los establecimientos hospitalarios o clínicos se debe hacer preferiblemente en ambulancias o vehículos adecuadamente dotados para este tipo de servicios, garantizando la atención oportuna y efectiva de la víctima.
                </p>
                <p>
                  [2] Entendiéndose por tal la prevista en los artículos 209 y 211 del Código Sustantivo del Trabajo.
                </p>
                <p>
                  [3] Siempre y cuando ocurra dentro del año siguiente a la fecha del accidente.</br>
                  *Entiéndase por SMLDV salario mínimo legal diario vigente.
                </p>
              </td>
              </tr>
              <tr>
                <td>
                  <p class="cuenta" align="center">Para tener en cuenta</p>
                  <p>Las  coberturas  del  SOAT  están  atadas  al  salario  mínimo,  es  decir  que  cada  vez  que  aumenta este indicador, los beneficios para las víctimas igualmente aumentan.</p>
                </td>
              </tr>
              <tr>
                <td>
                  El SOAT no cubre responsabilidad civil, daños a bienes o hurto. Es un seguro enfocado exclusi-vamente en la atención de las personas
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
      </body>
</html>
