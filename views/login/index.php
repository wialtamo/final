<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	  <link rel="icon" href="../../img/favicon.png">

    <title>SII</title>
	 <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../bootstrap/css/signin.css" rel="stylesheet">
  </head>

	<body class="text-center">
	<form class="form-signin" action="index.php" method="POST">
      <img class="mb-4" src="../../img/logo.png" alt="" width="200" height="150">
      <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>

				<label for="inputEmail" class="sr-only">Usuario</label>
				<input type="text" id="usuario" name="usuario" class="form-control" placeholder="usuario" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>

					 <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Ingresar">
				<p class="mt-5 mb-3 text-muted">&copy; 2021</p>
			</form>

			<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>

	</body>

</html>
<?php
   error_reporting(E_ALL ^ E_NOTICE);
	require('../../models/config.php');
	

	if(isset($_SESSION["id_usuario"])){
		header("Location: ../index.php");
	}

	if(!empty($_POST))
	{
		$usuario = mysqli_real_escape_string($link,$_POST['usuario']);
		$password = mysqli_real_escape_string($link,$_POST['password']);
		$error = '';

		$sha1_pass = md5($password);

		//$sql = "SELECT id, tipo FROM usuarios WHERE username = '$usuario' AND password = '$sha1_pass'";

		$sql = "SELECT idusuario, tipo, perfil, estado FROM usuarios WHERE usuario = '$usuario' AND password = '$sha1_pass' AND estado='activo'";
		$result=$link->query($sql);
		$rows = $result->num_rows;

		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['idusuario'];
			$_SESSION['tipo_usuario'] = $row['tipo'];
      $_SESSION['tipo_usuario'] = $row['perfil'];
      $id=$row['idusuario'];
      $tipo=$row['tipo'];
      $perfil=$row['perfil'];

      $cons="INSERT INTO registro ( `idusuario`, `tipo`, `perfil`) VALUES('$id', '$tipo', '$perfil')";
      $link->query($cons);
	  
			echo '
			<script>
			window.location.replace("../index.php");
			</script>
			';

			//header("location:../index.php");
			} else {
			echo "<script language='javascript'>alert('\\t Usuario o contraseña incorrecto');</script>";
		}
	}
?>