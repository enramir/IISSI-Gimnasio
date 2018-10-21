<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/login.css" />
  <title>Login</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
</head>

<body>

<?php
	include_once("cabecera.php");
?>
<main>
	<form action="form_login_administrador.php" method="post">
	<input type="submit" name="submit" value="ADMINISTRADOR">
	</form>
	<form action="login.php" method="post">
	<input type="submit" name="submit" value="CLIENTE">
	</form>
</main>
<footer>&copy; Centro deportivo La Venta 2018</footer>
</body>
</html>