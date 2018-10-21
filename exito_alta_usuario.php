<?php
	session_start();

	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE USUARIOS
	require_once'gestionBD.php';
	require_once'gestionarUsuarios.php';

	if   (isset($_SESSION["formulario"]))  {
		  $form_user = $_SESSION["formulario"];
		  $_SESSION["formulario"] = null;
		  $_SESSION["errores"] = null; 

    }
	 else  header("Location: form_alta_usuario.php");
	//else header("Location:FirstPage.php");

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
  <title>Gestión del Gimnasio: Alta de Usuario realizada con éxito</title>
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
		        //$codigo_retorno = alta_usuario($conn,$form_user); 
		        //$codigo_retorno1 = alta_cliente($conn,$form_user);//Alta SQL de usuario
		        $codigo_retorno = alta_cliente_Persona($conn,$form_user);
		        if(($codigo_retorno)==0){ //El alta se ha producido
		?>
				<!-- MENSAJE DE BIENVENIDO AL USUARIO -->
				<h4>¡Enhorabuena <?php echo $form_user["nombre"] ?>!
					Ya estás registrado. Bienvenido.
			    </h4>
			    <div>
			    	<a href="FirstPage1.html">Pulse aquí para navegar por la web!</a>
			    </div>
		<?php } else { //Usuario duplicado ?>
				<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
				<h4>¡Lo siento! El nickname (<?php echo $form_user["nickname"] ?>) o el email 
					 (<?php echo $form_user["email"] ?>)
					está repetido
			    </h4>
			    <div>
			    	<a href="form_alta_usuario.php">Pulse aquí para probar con un nuevo email! </a> 
			    	<!-- <a href="firstPage.php">Pulse aquí para probar con un nuevo email!</a>		    		 -->
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

