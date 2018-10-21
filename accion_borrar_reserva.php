<?php	
	session_start();	
	
	if (isset($_SESSION["reserva"])) {
		$reserva = $_SESSION["reserva"];
		unset($_SESSION["reserva"]);
		
		require_once("gestionBD.php");
		require_once("gestionarReservas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_reserva($conexion,$reserva["PISTA"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "realizar_reservas.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: realizar_reservas.php");
	}
	else Header("Location: realizar_reservas.php"); // Se ha tratado de acceder directamente a este PHP
?>