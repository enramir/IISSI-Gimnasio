<?php  
    session_start(); 
	
	include_once("gestionBD.php");       // Para incluir el fichero gestionBD.php
	include_once("gestionarUsuarios.php");
	
	//comprobamos si existen los valores del usuario
	/*$numeroSeguridadSocial = (isset($_REQUEST["numeroSeguridadSocial"])) ? ($_REQUEST["numeroSeguridadSocial"]) : null;*/
	$dni = (isset($_REQUEST["dni"])) ? ($_REQUEST["dni"]) : null;
	
	if($dni!=""){
		$conn = crearConexionBD();
		$login = consultarAdministrador($conn,$dni);
		if($login==$dni) { 
			$_SESSION["login"]=$dni;
			header("Location:FirstPage2.html");

		}else{
			header("Location:excepcion.php");
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

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en el dni o no existe el dni.";
		echo "</div>";
	}	
	?>
	<div class="login">
		<img src="images/iconavatar.png" class="avatar" />
	<!-- The HTML login form -->
	<form action="form_login_administrador.php" method="post">
		<!--<div><label for="numerodSeguridadSocial">Número de la seguridad social: </label>
		<input type="text" name="numerodSeguridadSocial" id="numerodSeguridadSocial"
		value="<?php /*echo*/ $numeroSeguridadSocial ?>"/></div>-->  
		<div><label for="dni">NÚMERO DE SEGURIDAD: </label>
		<input type="text" name="dni" id="dni" maxlength="9" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" placeholder="8 dígitos y una letra"
		value="<?php echo $dni ?>" /></div>
		<input type="submit" name="submit" value="Entrar" /> 
	</form>
	</div>	
</main>

</body>
</html>
