<?php
   error_reporting(E_ALL ^ E_NOTICE);
	require('models/config.php');
	session_start();

	if(isset($_SESSION["id_usuario"])){
		header("Location: views/welcome.php");
	}
  else {
    header("Location: views/login/index.php");
  }

?>
