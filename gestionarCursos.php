<?php

function alta_curso($conn,$form_us) {
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	$comand_text = "CALL INSERTAR_CURSO (:FECHAINICIO, :FECHAFIN, :CURSO, :LLENO)";
	$form_us["fechaInicio"]= date("d/m/Y", strtotime($form_us["fechaInicio"]));
	$form_us["fechaFin"]= date("d/m/Y", strtotime($form_us["fechaFin"]));
	
	
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array($form_us["fechaInicio"],$form_us["fechaFin"],$form_us["Curso"],'NO'));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}

function consultarTodosCursos($conexion) {
	$consulta = "SELECT * FROM CURSOS";
		//. " WHERE (EVENTOS.NUMIDENTIFICATIVO = EVENTOS.NUMIDENTIFICATIVO)";
		
			
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}

?>