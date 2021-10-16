<?php

include '../models/config.php';

//pasamos id del país

if(!empty($_POST["id_tipo"]))
{
   $sql ="SELECT DISTINCT caracteristicas FROM soat WHERE tipo = '" . $_POST["id_tipo"] . "'";

   	$consulta_categorias = $link->query($sql);

   //construimos lista nueva dependiente
   ?>
     <option value="">Seleccionar Caracteristica</option>
   <?php

   while($categoria= $consulta_categorias->fetch_object())
   {
	   ?>
		  <option value="<?php echo $categoria->caracteristicas; ?>"><?php echo $categoria->caracteristicas; ?></option>
	   <?php
   }

}


?>
