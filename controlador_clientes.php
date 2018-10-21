<?php	
	session_start();
	
	if (isset($_REQUEST["OID_CLIENTE"])){
		$cliente["OID_CLIENTE"] = $_REQUEST["OID_CLIENTE"];
		$cliente["NICKNAME"] = $_REQUEST["NICKNAME"];
		$cliente["DNI"] = $_REQUEST["DNI"];
		$cliente["NOMBRE"] = $_REQUEST["NOMBRE"];
		$cliente["APELLIDOS"] = $_REQUEST["APELLIDOS"];
		
		$_SESSION["cliente"] = $cliente;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_clientes.php"); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_cliente.php");
		else if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_cliente.php"); 
	}
	else 
		Header("Location: consulta_clientes.php");

?>
