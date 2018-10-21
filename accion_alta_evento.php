<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoEvento["nombre"] = $_REQUEST["nombre"];
		$nuevoEvento["precio"] = $_REQUEST["precio"];
		$nuevoEvento["lugar"] = $_REQUEST["lugar"];
		$nuevoEvento["fecha"] = $_REQUEST["fecha"];
		//$nuevoEvento["idadmin"] = $_REQUEST["idadmin"];
	}
	else // En caso contrario, vamos al formulario
		Header("Location: consulta_eventos.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoEvento;

	// Validamos el formulario en servidor 
	$errores = validarDatosEventos($nuevoEvento);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: consulta_eventos.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: exito_alta_evento.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosEventos($nuevoEvento){
		// Validación del Nombre			
		if($nuevoEvento["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		if($nuevoEvento["lugar"]=="") 
			$errores[] = "<p>El lugar no puede estar vacío</p>";
		
		if($nuevoEvento["fecha"]==""){
			$errores[] = "<p>la fecha no puede estar vacía</p>";
		}else if(strtotime($nuevoEvento["fecha"])<mktime(0,0,0)){
			$errores[] = "<p>fecha erronea, la fecha debe ser posterior al dia de hoy </p>";
			
		} 
	
	
		return $errores;
	}
	

?>

