<?php 
    session_start(); 
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoCurso["fechaInicio"] = $_REQUEST["fechaInicio"];
		$nuevoCurso["fechaFin"] = $_REQUEST["fechaFin"];
		$nuevoCurso["Curso"] = $_REQUEST["Curso"];
		//$nuevoEvento["idadmin"] = $_REQUEST["idadmin"];
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_cursos.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoCurso;

	// Validamos el formulario en servidor 
	$errores = validarDatosCurso($nuevoCurso);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_cursos.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
		Header('Location: exito_alta_curso.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosCurso($nuevoCurso){
        
		if($nuevoCurso["fechaInicio"]==""){ 
			$errores[] = "<p>la fecha inicio no puede estar vacía</p>";
		}else if(strtotime($nuevoCurso["fechaInicio"])<mktime(0,0,0)){
			$errores[] = "<p>fecha erronea, la fecha Inicio debe ser posterior al dia de hoy </p>";
		
		}
		if($nuevoCurso["fechaFin"]==""){
			$errores[] = "<p>la fecha fin no puede estar vacía</p>";

		}else if(strtotime($nuevoCurso["fechaFin"])<strtotime($nuevoCurso["fechaInicio"])){
			$errores[] = "<p>fecha erronea, la fecha fin debe ser posterior a la fecha de inicio </p>";
		
		}
	
		return $errores;
	}

?>
