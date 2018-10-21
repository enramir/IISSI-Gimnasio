<?php	
	session_start();
	
	if (isset($_REQUEST["NUMIDENTIFICATIVO"])){
		$evento["NUMIDENTIFICATIVO"] = $_REQUEST["NUMIDENTIFICATIVO"];
		$evento["NOMBRE"] = $_REQUEST["NOMBRE"];
		$evento["PRECIO"] = $_REQUEST["PRECIO"];
		$evento["LUGAR"] = $_REQUEST["LUGAR"];
		$evento["FECHA"] = $_REQUEST["FECHA"];
		//$evento["IDADMINISTRATIVO"] = $_REQUEST["IDADMINISTRATIVO"];
		
		$_SESSION["evento"] = $evento;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_eventos.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_evento.php");
		else if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_evento.php");
		 
	}
	else 
		Header("Location: consulta_eventos.php");

?>
