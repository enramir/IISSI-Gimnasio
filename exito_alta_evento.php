<?php
	session_start();

	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
	require_once'gestionBD.php';
	require_once'gestionarEventos.php';

	if   (isset($_SESSION["formulario"]))  {
		  $form_user = $_SESSION["formulario"];
		  $_SESSION["formulario"] = null;
		  $_SESSION["errores"] = null;

    }
	else  header("Location: consulta_eventos.php");

	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	//...
	
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	$conn = crearConexionBD();
	//...

	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión del Gimnasio: Alta del evento realizada con éxito</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
    <link rel="stylesheet" type="text/css" href="css/excepcion.css" />

</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<!-- CONSULTAR EL TEMA DE TEORÍA SOBRE ACCESO A DATOS -->
		<?php 	// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
		        $codigo_retorno = alta_evento($conn,$form_user); 
		        //Alta SQL de usuario
		        if($codigo_retorno==0){ //El alta se ha producido
		?>
				<!-- MENSAJE DE BIENVENIDO AL USUARIO -->
				<h4>Enhorabuena, El evento ha sido creado correctamente.
			    </h4>
			    <div>
			    	<a href="FirstPage2.html"> Volver a página de gestión.</a>
			    </div>
		<?php } else { //Usuario duplicado ?>
				<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
				<h4>¡Lo siento! error al crear un evento, <?php echo $form_user["nombre"]?> ya existe.
			    </h4>
			    <div>
			    	<a href="consulta_eventos.php">Pulse aquí para probar con otros datos!</a>
			    </div>
		<?php } ?>

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conn);
	
?>

