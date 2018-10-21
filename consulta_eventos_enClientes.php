<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarEventos.php");
	require_once("paginacion_consulta.php");
	

	if (isset($_SESSION["evento"])){
		$evento = $_SESSION["evento"];
		unset($_SESSION["evento"]);
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
	$query = 'SELECT EVENTOS.NUMIDENTIFICATIVO, EVENTOS.NOMBRE, EVENTOS.PRECIO,' 
			.'EVENTOS.LUGAR, EVENTOS.FECHA FROM EVENTOS';
			

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


  <title>Gestión del gimnasio: Listado de Eventos</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" />
  <link rel="stylesheet" type="text/css" href="css/formEvento.css" />
  <script src="javascript/formEvent.js"></script>


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
						<a href="consulta_eventos_enClientes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>

		<form method="get" action="consulta_eventos_enClientes.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			Mostrando
			<input id="PAG_TAM" name="PAG_TAM" type="number"
				min="1" max="<?php echo $total_registros;?>"
				value="<?php echo $pag_tam?>" autofocus="autofocus" />
			entradas de <?php echo $total_registros?>
			<input type="submit" value="Cambiar">
		</form><br />
	</nav><br />
<div id="titulo">
			<p class="numident">Nº IDENT:</p>
			<p class="nom">NONBRE EVENTO:</p>
			<p class="pre">PRECIO:</p>
			<p class="lug">LUGAR:</p>
			<p class="numident">FECHA:</p>
		</div>
	<?php
		foreach($filas as $fila) {
	?>

	<article class="evento">
		<form method="post"  id="evento">
			<div class="fila_evento">
				<div class="datos_evento">
					<input id="NUMIDENTIFICATIVO" name="NUMIDENTIFICATIVO"
						type="hidden" value="<?php echo $fila["NUMIDENTIFICATIVO"]; ?>"/>
					<input id="NOMBRE" name="NOMBRE"
						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
					<input id="PRECIO" name="PRECIO"
						type="hidden" value="<?php echo $fila["PRECIO"]; ?>"/>
					<input id="LUGAR" name="LUGAR"
						type="hidden" value="<?php echo $fila["LUGAR"]; ?>"/>
					<input id="FECHA" name="FECHA"
						type="hidden" value="<?php echo $fila["FECHA"]; ?>"/>
						
					
					<div class="NUMIDENT"><em><?php echo $fila["NUMIDENTIFICATIVO"]; ?></em></div>
					
					<div class="nombre"><b><?php echo $fila["NOMBRE"]; ?></b></div>
					<div class="precio"><b><?php echo $fila["PRECIO"]; ?></b></div>
					<div class="lugar"><b><?php echo $fila["LUGAR"]; ?></b></div>
					<div class="fecha"><b><?php echo $fila["FECHA"]; ?></b></div>
					<!-- 
					<div class="LUGAR"><em><?php echo $fila["LUGAR"]; ?></em></div>
					<div class="FECHA"><em><?php echo $fila["FECHA"]; ?></em></div>
					<div class="PRECIO"><em><?php echo $fila["PRECIO"]; ?></em></div> -->
				
				</div>
			</div>
		</form>
	</article>
	<?php } ?>
</main>

</div>
</body>
</html>
