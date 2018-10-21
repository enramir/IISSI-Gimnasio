<?php  
    session_start(); 
	
	include_once("gestionBD.php");       // Para incluir el fichero gestionBD.php
	include_once("gestionarUsuarios.php");
	
	//comprobamos si existen los valores del usuario
	$nickname = (isset($_REQUEST["nickname"])) ? ($_REQUEST["nickname"]) : null;
	$contraseña = (isset($_REQUEST["contraseña"])) ? ($_REQUEST["contraseña"]) : null;
	
	if($nickname!=""){
		$conn = crearConexionBD();
		$login = consultarCliente($conn,$nickname,$contraseña);
		if($login==$nickname) {
			$_SESSION["login"]=$nickname;
			header("Location:FirstPage1.html");

		}else{
			header("Location:excepcion1.php");
			
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/loginCliente-css.css" />
  <title>Login</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
</head>

<body>

<!-- // <?php
	 // include_once("cabecera.php");
// ?> -->

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el nickname.";
		echo "</div>";
	}	
	?>
	
	<div class="login">
		<img src="images/iconavatar.png" class="avatar" />
	
	<!-- The HTML login form -->
	<form action="login.php" method="post">
		<div><label for="nickname">Nickname: </label>
		<input type="text" name="nickname" id="nickname" placeholder="Enter Nickname"
		value="<?php echo $nickname ?>"/></div>
		<div><label for="contraseña">Contraseña: </label>
		<input type="password" name="contraseña" id="contraseña" placeholder="Enter Contraseña" </div>
		<input type="submit" name="submit" value="Enviar" /> 
	</form>
		
	<p>¿Aún no estás registrado? <a href="form_alta_usuario.php">¡Apúntate!</a></p>
	</div>
</main><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<footer>&copy; Centro deportivo La Venta 2018</footer>

</body>
</html>
