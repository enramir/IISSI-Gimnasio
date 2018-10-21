<?php 
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["nickname"] = $_REQUEST["nickname"];
		$nuevoUsuario["tipopista"] = $_REQUEST["tipopista"];
		$nuevoUsuario["numeroPista"] = $_REQUEST["numeroPista"];
		
		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: realizar_reserva.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;

	// Validamos el formulario en servidor 
	$errores = validarDatosReserva($nuevoUsuario);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_reserva.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: exito_alta_reserva.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosReserva($nuevoUsuario){
        
        //Validación del nickname
		if($nuevoUsuario["nickname"]==""){ 
			$errores[] = "<p>El nickname no puede estar vacío</p>";
		
         }
	
		return $errores;
	}

?>