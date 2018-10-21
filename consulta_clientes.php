<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarClientes.php");
	require_once("paginacion_consulta.php");

	if (isset($_SESSION["cliente"])){
		$cliente = $_SESSION["cliente"];
		unset($_SESSION["cliente"]);
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
	$query = 'SELECT CLIENTES.NICKNAME, CLIENTES.OID_CLIENTE,  '
		.'PERSONAS.DNI, PERSONAS.NOMBRE, PERSONAS.APELLIDOS '
		.'FROM CLIENTES,PERSONAS '
		.'WHERE '
			.'(PERSONAS.DNI = CLIENTES.DNI)';

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
  <title>Gestión del gimnasio: Lista de CLientes</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" />

</head>

<body>
	<?php
	include_once("cabeceraGestion.php");
?>
<main>
	 <nav>
		<div id="enlaces">
			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>
						<a href="consulta_clientes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>
		
		<form method="get" action="consulta_clientes.php">
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
			<p class="d">DNI:</p>
			<p class="nom">NONBRE Y APELLIDOS:</p>
			<p class="pre">NICKNAME:</p>
			
		</div>	
	<?php
		foreach($filas as $fila) {
	?>

	<article class="cliente">	
		<form method="post" action="controlador_clientes.php">
			<div class="fila_cliente">
				<div class="datos_cliente">
					<input id="OID_CLIENTE" name="OID_CLIENTE"
						type="hidden" value="<?php echo $fila["OID_CLIENTE"]; ?>"/>
					<input id="NICKNAME" name="NICKNAME"
						type="hidden" value="<?php echo $fila["NICKNAME"]; ?>"/>
					<input id="DNI" name="DNI"
						type="hidden" value="<?php echo $fila["DNI"]; ?>"/>
					<input id="NOMBRE" name="NOMBRE"
						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
					<input id="APELLIDOS" name="APELLIDOS"
						type="hidden" value="<?php echo $fila["APELLIDOS"]; ?>"/>
						
					<div class="dni"><em><?php echo $fila["DNI"]; ?></em></div>
				<!--<div class="clienteNA"> <?php echo $fila["APELLIDOS"]." ".$fila["NOMBRE"]; ?></div>-->
					
					<div class="nombre"><em><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></em></div>

				<?php
					if (isset($cliente) and ($cliente["OID_CLIENTE"] == $fila["OID_CLIENTE"])) { ?>
						<!-- Editando título -->
						
						<input id="NICKNAME" name="NICKNAME" type="text" value="<?php echo $fila["NICKNAME"]; ?>"/>
						<!--<h4><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></h4>-->
				<?php }	else { ?>
						<!-- mostrando título 
						<input id="NICKNAME" name="NICKNAME" type="hidden" value="<?php echo $fila["NICKNAME"]; ?>"/>-->
						<div class="nickname"><b><?php echo $fila["NICKNAME"]; ?></b></div>
				<?php } ?>
				</div>

				<div id="botones_fila">
				<?php if (isset($cliente) and ($cliente["OID_CLIENTE"] == $fila["OID_CLIENTE"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">
							<img src="images/guardar.png" class="editar_fila" alt="Guardar modificación">
						</button>
				<?php } else {?>
						<button id="editar" name="editar" value="submit" type="submit" >
							<img src="images/EditarCliente.bmp" class="editar_fila" alt="Editar cliente">
						</button>
				<?php } ?>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="images/papelerita.png.bmp" class="editar_fila" alt="Borrar cliente">
					</button>
				</div>
			</div>
		</form>
	</article>

	<?php } ?>
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>
