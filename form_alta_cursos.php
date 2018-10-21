<?php   
	 error_reporting(E_ALL ^ E_NOTICE);

	session_start();
// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['fechaInicio'] = "";
		$formulario['fechaFin'] = "";
		$formulario['Curso'] = "";
		
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
		
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->


  <title>Gestión del gimnasio: Crear una pista</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" />
  <link rel="stylesheet"  type="text/css"  href="css/formPistas.css" />


</head>
<?php
	include_once("cabeceraGestion.php");
	

?>
<body>
<main>
  
<div class="formCuso" id="formcurso">
		<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>		
	<form class="contenidoform" id="altaCurso" method="get" action="accion_alta_curso.php">
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend><strong>Datos a rellenar del curso</strong></legend> 
			 <div><label for="fechaInicio">Fecha de inicio:<em>*</em></label>
			<input type="date" id="fechaInicio" name="fechaInicio" 
			value="<?php echo $formulario['fechaInicio'];?>" required/>
			</div>
			
			<div><label for="fechaFin">Fecha de Fin:<em>*</em></label>
			<input type="date" id="fechaFin" name="fechaFin" 
			value="<?php echo $formulario['fechaFin'];?>" required/>
			</div>
			 
			 <div><label for="Curso">Tipo de Curso:<em>*</em></label>
			 	<select name="Curso" id="curso">
					<option value="CROSSFORCE"<?php if($formulario['Curso']=='CROSSFORCE') $formulario['Curso'];?>>CROSSFORCE</option>
					
					<option value="GAP"<?php if($formulario['Curso']=='GAP') $formulario['Curso'];?>>GAP</option>
					
					<option value="PILATES"<?php if($formulario['Curso']=='PILATES') $formulario['Curso'];?>>PILATES</option>
					
					<option value="TRX"<?php if($formulario['Curso']=='TRX') $formulario['Curso'];?>>TRX</option>

					<option value="SPINNING"<?php if($formulario['Curso']=='SPINNING') $formulario['Curso'];?>>SPINNING</option>

					<option value="YOGA"<?php if($formulario['Curso']=='YOGA') $formulario['Curso'];?>>YOGA</option>

				</select>
			</div>
					
			
		</fieldset>
		
		<div><input type="submit" id="boton_registrarse" value="Registrar" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>

		
	</form>	
</div>
<script>
		function myfunction(){
			document.getElementById("altaCurso").reset();
		}
	</script>
</main>

<?php
	include_once("pie.php");
?>

<!-- AQUI COMIENZA LAS COSAS DEL FORMULARIO DE EVENTOS:-->


	<!-- <?php
		include_once("pie.php");
	?> -->
</body>
</html>
