<?php 
	session_start();


	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["dni"] = $_REQUEST["dni"];
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["telefono"] = $_REQUEST["telefono"];
		$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["nickname"] = $_REQUEST["nickname"];
		$nuevoUsuario["contraseña"] = $_REQUEST["contraseña"];
		$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
		
	}
	else // En caso contrario, vamos al formulario
		 Header("Location: form_alta_usuario.php");
		//Header("Location: FirstPage.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;

	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);
	// Si se produce alguna excepción PDO en la validación, volvemos al formulario informando al usuario
	// try{ 
		// $conexion = crearConexionBD(); 
		// $errores = validarDatosUsuario($conexion, $nuevoUsuario);
		// cerrarConexionBD($conexion);
	// }catch(PDOException $e){
		// // Mensaje de depuración
		// $_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e->getMessage() . "</p>";
		// Header('Location: FirstPage.php');
		// //Header('Location: form_alta_usuario.php');
// 		
	// }
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		 Header('Location: form_alta_usuario.php');
		//Header('Location: firstPage.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: exito_alta_usuario.php');
			

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosUsuario($nuevoUsuario){
		$errores=array();
		// Validación del DNI
		if($nuevoUsuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["dni"]. "</p>";
		}

		// Validación del Nombre			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		// Validación del email
		if($nuevoUsuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
		}
        
        // Validación de la contraseña
		if(!isset($nuevoUsuario["contraseña"]) || strlen($nuevoUsuario["contraseña"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contraseña"]) || 
			!preg_match("/[A-Z]+/", $nuevoUsuario["contraseña"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contraseña"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas, minúsculas y dígitos</p>";
		}else if($nuevoUsuario["contraseña"] != $nuevoUsuario["confirmpass"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
        

        //Validación del nickname
		if($nuevoUsuario["nickname"]==""){ 
			$errores[] = "<p>El nickname no puede estar vacío</p>";
			
		}
		
		if($nuevoUsuario["direccion"]==""){ 
			$errores[] = "<p>La dirección no puede estar vacía</p>";
		}
		if($nuevoUsuario["apellidos"]==""){ 
			$errores[] = "<p>Los Apellidos no pueden estar vacío</p>";
		}
		 
		
		if($nuevoUsuario["fechaNacimiento"]==""){
			$errores[] = "<p>La fecha de nacimiento no puede estar vacía</p>";
		}else if(strtotime($nuevoUsuario["fechaNacimiento"])>mktime(0,0,0)){
			$errores[] = "<p>Error en la fecha de nacimiento. Debe de ser anterior a hoy.</p>";
		}
		
		
		/*else if(!filter_var($nuevoUsuario["nickname"], FILTER_VALIDATE_NICKNAME)){
			$errores[] = $error . "<p>El nickname  ".$nuevoUsuario["nickname"]." ya existe. </p>";
		}
		*/

	
		return $errores;
	}

?>

