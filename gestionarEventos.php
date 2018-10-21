<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_evento($conn,$form_us) { 
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	$comand_text = "CALL REGISTRAR_EVENTO(:NOMBRE, :PRECIO, :LUGAR, :FECHA, :IDADMINISTRATIVO)";
	$form_us["fecha"]= date("d/m/Y", strtotime($form_us["fecha"]));
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array(strtoupper($form_us["nombre"]),strtoupper($form_us["precio"]),
          	strtoupper($form_us["lugar"]),strtoupper($form_us["fecha"]),'ADMIN1'));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}

function consultarTodosEventos($conexion) {
	$consulta = "SELECT * FROM EVENTOS";
		//. " WHERE (EVENTOS.NUMIDENTIFICATIVO = EVENTOS.NUMIDENTIFICATIVO)";
		
			
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}
 
   
function quitar_evento($conexion,$nombre) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_EVENTO(:NOMBRE)');
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}


function modificar_eventos($conexion,$numidentificativo,$nombre,$precio,$lugar,$fecha) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_EVENTO(:NUMIDENTIFICATIVO,:NOMBRE,:PRECIO,:LUGAR,:FECHA)');
		$stmt->bindParam(':NUMIDENTIFICATIVO',$numidentificativo);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->bindParam(':PRECIO',$precio);
		$stmt->bindParam(':LUGAR',$lugar);		
		$stmt->bindParam(':FECHA',$fecha);

		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}












?>