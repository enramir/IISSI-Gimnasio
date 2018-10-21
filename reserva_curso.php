<?php 
    session_start(); 
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['fechaInicio'] = "";
		$formulario['fechaFin'] = "";
		$formulario['tipoCurso'] = "";
		
		
		
	
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
  <!--<link rel="stylesheet" type="text/css" href="css/biblio.css" /> -->
  <title>Gestión de Gimnasio La venta: Gestión de cursos</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	
	<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>
	
	<form id="altaCurso" method="get" action="accion_alta_curso.php" novalidate>
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend>Datos del curso</legend>
			<div><label for="fechaInicio">Fecha de inicio<em>*</em></label>
			<input id="fechaInicio" name="fechaInicio" type="date" value="<?php echo $formulario['fechaInicio'];?>" required>
			 </div>
			 
			 <div><label for="fechaFin">Fecha de fin<em>*</em></label>
			<input id="fechaFin" name="fechaFin" type="date" value="<?php echo $formulario['fechaFin'];?>" required>
			 </div>
			 
			
			<div><label>Tipo de curso:</label>
			<label>
				<input name="Crossforce" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				Crossforce</label>
			<label>
				<input name="Gap" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				Gap</label>
			<label>
				<input name="Pilates" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				Pilates</label>
			<label>
				<input name="TRX" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				TRX</label>
			<label>
				<input name="Spinning" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				Spinning</label>
			<label>
				<input name="Yoga" type="radio" value="<?php echo $formulario['tipoCurso'];?>" />
				Yoga</label>
			</div>
			
		</fieldset>
		
		
		<div><input type="submit" value="Reservar" /></div>
		
	</form>	
	<?php
		include_once("pie.php");
	?>
</body>
</html>