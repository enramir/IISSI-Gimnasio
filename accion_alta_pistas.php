<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevaPista["numpista"] = $_REQUEST["numpista"];
		$nuevaPista["pista"] = $_REQUEST["pista"];
		$nuevaPista["precio"] = $_REQUEST["precio"];
		//$nuevoEvento["idadmin"] = $_REQUEST["idadmin"];
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_pistas.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevaPista;

	// Validamos el formulario en servidor 
	$errores = validarDatosPistas($nuevaPista);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_pistas.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: exito_alta_pistas.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosPistas($nuevaPista){
		// Validación del Nombre			
		if($nuevaPista["numpista"]==""){ 
			$errores[] = "<p>El numero de pista no puede estar vacío</p>";
		}
		
		if($nuevaPista["precio"]=="") 
			$errores[] = "<p>El precio no puede estar vacío</p>";
	
	
		return $errores;
	}
	

?>

