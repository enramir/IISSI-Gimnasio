 <?php

 function alta_reserva($conn,$form_us) {
	$comand_text = "CALL INSERTAR_RESERVA (:FECHAINICIO, :FECHAFIN, :IDADMINISTRATIVO)";
	$form_us["fechaInicio"]=date("d/m/Y",strtotime($form_us["fechaInicio"]));
	$form_us["fechaFin"]=date("d/m/Y",strtotime($form_us["fechaFin"]));
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array($form_us["fechaInicio"],$form_us["fechaFin"],'CH25'));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}

 function alta_alquilan_unas($conn,$form_us) {
	$comand_text = "CALL INSERTAR_ALQUILAN_UNAS (:OID_CLIENTE, :OID_PISTA)";
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array(28,6));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}

 function alta_quedanocupadas($conn,$form_us) {
	$comand_text = "CALL INSERTAR_QUEDANOCUPADAS (:OID_PISTA, :OID_RESERVA)";
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array(6,16));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}





function consulta_oidCliente($conn,$nickname){
	$consulta = "SELECT OID_CLIENTE FROM CLIENTES 
	             WHERE (CLIENTES.NICKNAME = $nickname)";

	try{
		return $conn->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion']=$e->GetMessage();
		header("Location: excepcion.php");
	}
}

function consultarTodasPistas($conn){
	$consulta = "SELECT * FROM PISTAS";			
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}

function quitarReserva($value=''){
	try {
		$stmt=$conexion->prepare('CALL QUITAR_RESERVA(:PISTA)');
		$stmt->bindParam(':PISTA',$nombre);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
	
}


 function registrar_reserva_qa($conn,$form_us) {
	$comand_text = "CALL registrar_reserva_qa (:NICKNAME,:PISTA,:NUMERO_PISTA,:FECHAINICIO,:FECHAFIN,:IDADMINISTRATIVO)";
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array($form_us['nickname'],$form_us['tipopista'],$form_us['numeroPista'],date('d-m-Y'),
		  date("d-m-Y",strtotime("+1 day")),'ADMIN1'));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}












?>