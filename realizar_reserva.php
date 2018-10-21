<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	require_once("gestionBD.php");
	require_once("gestionarReservas.php");
	require_once("paginacion_consulta.php");

	if (isset($_SESSION["reserva"])){
		$evento = $_SESSION["reserva"];
		unset($_SESSION[""]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = 'SELECT PISTAS.OID_PISTA, PISTAS.NUMERO_PISTA, PISTAS.PISTA,' 
			.'PISTAS.PRECIO FROM PISTAS';
			

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++;
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);

	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <title>Área Cliente: Reservar pistas</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet"  type="text/css"  href="css/realizar_reserva.css" />
  <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" /> 
    <link rel="stylesheet" type="text/css" href="css/formEvento.css" />
</head>
 <?php
	include_once("cabeceraClientes.php");
?> 
<body>
<main>
	 <nav>
		<div id="enlaces">
			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>
						<a href="realizar_reserva.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>

		<form method="get" action="realizar_reserva.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			Mostrando
			<input id="PAG_TAM" name="PAG_TAM" type="number"
				min="1" max="<?php echo $total_registros;?>"
				value="<?php echo $pag_tam?>" autofocus="autofocus" />
			entradas de <?php echo $total_registros?>
			<input type="submit" value="Cambiar">
		</form><br />
	</nav>
	<table id="tablaReservas">
		<tr >
		<th>	<?php
			// Obteniendo la fecha actual del sistema con PHP
			$fechaActual = date('d-m-Y');
			echo $fechaActual;
			
			$fechamañana=date("d-m-Y",strtotime("+1 day"));
			
			
			?>
		</th>
		</tr> </table>
	<table >
		<tr>
				<th>PISTAS/HORAS</th>
				<th id="1">10 AM</th>
				<th id="1">11 AM</th>
				<th id="1">12 PM</th>
				<th id="1">1 PM</th>
				<th id="1">2 PM</th>
				<th id="1">3 PM</th>
				<th id="1">4 PM</th>
				<th id="1">5 PM</th>
				<th id="1">6 PM</th>
				<th id="1">7 PM</th>
				<th id="1">8 PM</th>
		</tr>
		
			<?php
				foreach($filas as $fila) {
			?>

				<article class="reserva">
					<form method="post" action="controlador_reservas.php">
						<div class="fila_reserva">
							<div class="datos_reserva">
								<input id="OID_PISTA" name="OID_PISTA"
									type="hidden" value="<?php echo $fila["OID_PISTA"]; ?>"/>
								<input id="NUMERO_PISTA" name="NUMERO_PISTA"
									type="hidden" value="<?php echo $fila["NUMERO_PISTA"]; ?>"/>
								<input id="PISTA" name="PISTA"
									type="hidden" value="<?php echo $fila["PISTA"]; ?>"/>
								<input id="PRECIO" name="PRECIO"
									type="hidden" value="<?php echo $fila["PRECIO"]; ?>"/>
					
							</div>
  		
							<!--<div class="OID_PISTA"><em><?php echo $fila["OID_PISTA"]; ?></em></div>-->
							
							<tr>
								<th><div class="PISTA">TIPO:<em><?php echo $fila["PISTA"]; ?></em></div>
								<div class="NUMERO_PISTA" name="numPista">Nº DE PISTA:<em><?php echo $fila["NUMERO_PISTA"]; ?></em></div>
								<div class="PRECIO">PRECIO:<em><?php echo $fila["PRECIO"]; ?></em></div></th>
						
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php">
								<input  type="button" value="Reservar" id="reservarpista" /></a></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							<td><a href="../GYM_ACTUALIZADO/form_alta_reserva.php"><input  type="button" value="Reservar" id="reservarpista" /></td>
							</tr>
						</div>
					</form>
				</article>
			<?php } ?>
		
  	</table>
</main>

<!-- EMPIEZA FORMULARIO DE RESERVAS -->

</body>
</html>