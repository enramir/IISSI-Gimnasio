<?php 
    session_start(); 
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

<!DOCTYPE hmtl>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/formEvento.css" />
  <title>Gestión de Gimnasio La venta: Alta de Eventos</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
</head>

<body>
	
	<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>
  
<div class="formEvento" id="formevento">	
	<form class="contenidoform" id="altaEvento" method="get" action="accion_alta_evento.php" novalidate>
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend><strong>Datos a rellenar del evento</strong></legend> 
			 <div><label for="nombre">Nombre:<em>*</em></label>
			 <input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>		
			 </div>
			 
			<div><label for="precio">Precio:</label>
			<input id="precio" name="precio" type="text" size="30" value="<?php echo $formulario['precio'];?>"/>
			</div>
			
			
			<div><label for="lugar">Lugar:</label>
			<input type="text" id="lugar" name="lugar" size="40"
			value="<?php echo $formulario['lugar'];?>"/>
			</div>
			
			<div><label for="fecha">Fecha:</label>
			<input id="fecha" name="fecha" type="date" 
			value="<?php echo $formulario['fecha'];?>"/>
			</div>
			
			<!--<div><label for="id">id:</label>
			<input id="ida" name="idadmin" type="text" 
			value="<?php echo $formulario['idadmin'];?>"/>
			</div>-->
		</fieldset>
		
		<div><input type="submit" id="boton_registrarse" value="Registrarse" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>
		
	</form>	
</div>
<script>
		function myfunction(){
			document.getElementById("altaCurso").reset();
		}
	</script>
	<!-- <?php
		include_once("pie.php");
	?> -->
</body>
</html>