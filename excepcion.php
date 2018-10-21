<?php 
	session_start();
	
	//$excepcion = $_SESSION["excepcion"];
	//unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <!--<link rel="stylesheet" type="text/css" href="css/biblio.css" /> -->
  <title>Gestión de Usuarios: ¡Se ha producido un problema!</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet" type="text/css" href="css/excepcion.css">
</head>
<body>	
	
<?php	
	include_once("cabecera.php"); 
?>	

	<div>
		
		<?php if ($destino<>"") { ?>
		<p>Ocurrió un problema durante el procesado de los datos. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.</p>
		<?php } else { ?>
		<h4>¡DNI INCORRECTO!</h4>
		<p>El dni no es correcto. Pulse <a href="../GYM_ACTUALIZADO/form_login_administrador.php">aquí</a> para intentarlo de nuevo.</p>
		<?php } ?>
	</div><br><br>
		
	<!--<div class='excepcion'>	
		<?php //echo "Información relativa al problema: $excepcion;" ?>
	</div>-->

<?php	
	include_once("pie.php");
?>	

</body>
</html>