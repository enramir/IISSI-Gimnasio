<?php	
	session_start();
	
	if (isset($_REQUEST["OID_RESERVA"])){
		$reserva["NUMERO_PISTA"] = $_REQUEST["NUMERO_PISTA"];
		$reserva["PISTA"] = $_REQUEST["PISTA"];
		$reserva["PRECIO"] = $_REQUEST["PRECIO"];
	
		$_SESSION["reserva"] = $reserva;
			
		if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_reserva.php");	 
	}
	else 
		Header("Location: realizar_reserva.php");

?>
