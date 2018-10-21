<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */
     
function consultarTodosClientes($conexion) {
	$consulta = "SELECT * FROM CLIENTES, PERSONAS"
		. " WHERE (PERSONAS.DNI = CLIENTES.DNI)"
		. " ORDER BY APELLIDOS, NOMBRE";
		
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}
  
function quitar_cliente($conexion,$dni) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_CLIENTE(:DNI)');
		$stmt->bindParam(':DNI',$dni);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_nickname($conexion,$oidCliente,$nickname) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_NICKNAME(:OID_CLIENTE,:NICKNAME)');
		$stmt->bindParam(':NICKNAME',$nickname);

		$stmt->bindParam(':OID_CLIENTE',$oidCliente);

		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

?>