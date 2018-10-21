<?php	
	session_start();	
	
	if (isset($_SESSION["cliente"])) {
		$cliente = $_SESSION["cliente"];
		unset($_SESSION["cliente"]);
		
		require_once("gestionBD.php");
		require_once("gestionarClientes.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_cliente($conexion,$cliente["DNI"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_clientes.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_clientes.php");
	}
	else Header("Location: consulta_clientes.php"); // Se ha tratado de acceder directamente a este PHP
?>