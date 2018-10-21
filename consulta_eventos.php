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


</head>
<?php
	include_once("cabeceraGestion.php");
	

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
						<a href="consulta_eventos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
		</div>

		<form method="get" action="consulta_eventos.php">
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
		<form method="post" action="controlador_eventos.php">
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
					
					
					<!-- 
					<div class="LUGAR"><em><?php echo $fila["LUGAR"]; ?></em></div>
					<div class="FECHA"><em><?php echo $fila["FECHA"]; ?></em></div>
					<div class="PRECIO"><em><?php echo $fila["PRECIO"]; ?></em></div> -->
				<?php
					if (isset($evento) and ($evento["NUMIDENTIFICATIVO"] == $fila["NUMIDENTIFICATIVO"])) { ?>
						<!-- Editando todo el evento -->
						<input class="NOMBREE" id="NOMBREE" name="NOMBRE" type="text" value="<?php echo $fila["NOMBRE"]; ?>"/>
						<input class="PRECIO" id="PRECIO" name="PRECIO" type="text" value="<?php echo $fila["PRECIO"]; ?>"/>
						<input class="LUGAR" id="LUGAR" name="LUGAR" type="text" value="<?php echo $fila["LUGAR"]; ?>"/>
						<input class="FECHA" id="FECHA" name="FECHA" type="text" value="<?php echo $fila["FECHA"]; ?>"/>
						<!--<h4><?php echo $fila["NOMBRE"]."".$fila["FECHA"]; ?></h4>-->
				<?php }	else { ?>
						<!-- mostrando nombre evento 
						<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>-->
						<div class="nombre"><b><?php echo $fila["NOMBRE"]; ?></b></div>
						<div class="precio"><b><?php echo $fila["PRECIO"]; ?></b></div>
						<div class="lugar"><b><?php echo $fila["LUGAR"]; ?></b></div>
						<div class="fecha"><b><?php echo $fila["FECHA"]; ?></b></div>
						
					<!--<div class="plf">Precio, lugar y fecha: <em><?php echo $fila["PRECIO"].", 
						".$fila["LUGAR"].", ".$fila["FECHA"]; ?></em></div>-->
				<?php } ?>
				</div>

				<div id="botones_fila">
				<?php if (isset($evento) and ($evento["NUMIDENTIFICATIVO"] == $fila["NUMIDENTIFICATIVO"])) { ?>
						<button id="grabar" name="grabar" type="submit" class="editar_fila">
							<img src="images/guardar.png" class="editar_fila" alt="Guardar modificación">
						</button>
				<?php } else {?>
						<button id="editar" name="editar" type="submit" >
							<img src="images/EditarCliente.bmp" class="editar_fila" alt="Editar evento">
						</button>
				<?php } ?>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="images/papelerita.png.bmp" class="editar_fila" alt="Borrar evento">
					</button>
				</div>
			</div>
		</form>
	</article>
	<?php } ?>
</main>
<div id="boton_anadir">
	<input type="submit" value="✚" title="Añadir Evento" name="anadir" 
		onclick="document.getElementById('formevento').style.display='block'"/>						
</div>

<?php
	include_once("pie.php");
?>

<!-- AQUI COMIENZA LAS COSAS DEL FORMULARIO DE EVENTOS:-->

<?php  
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['precio'] = "";
		$formulario['lugar'] = "";
		$formulario['fecha'] = "";
		$formulario['idadmin'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

	
  
<div class="formEvento" id="formevento">
	<span onclick="document.getElementById('formevento').style.display='none'"
			class="close" title="Close Modal">&times;</span>
		<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>		
	<form class="contenidoform" id="altaEvento" method="get" action="accion_alta_evento.php"  >
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend><strong>Datos a rellenar del evento</strong></legend> 
			 <div><label for="nombre">Nombre:<em>*</em></label>
			 <input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'] ;?>" required/>		
			 </div>
			 
			<div><label for="precio">Precio:</label>
			<input id="precio" name="precio" type="text" size="30" value="<?php echo $formulario['precio'];?>"/>
			</div>
			
			
			<div><label for="lugar">Lugar:<em>*</em></label>
			<input type="text" id="lugar" name="lugar" size="40" required
			value="<?php echo $formulario['lugar'] ;?>" />
			</div>
			
			<div><label for="fecha">Fecha:<em>*</em></label>
				<input type="date" id="fecha" name="fecha" required value="<?php echo $formulario['fecha'] ;?>"/>
			</div>
			
			<!--<div><label for="id">id:</label>
			<input id="ida" name="idadmin" type="text" 
			value="<?php echo $formulario['idadmin'];?>"/>
			</div>-->
		</fieldset>
				
		<div><input type="submit" id="boton_registrarse" value="Añadir" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>
		
	</form>	
</div>
<script>
		function myfunction(){
			document.getElementById("altaEvento").reset();
		}
	</script>

	<!-- <?php
		include_once("pie.php");
	?> -->
</body>
</html>
