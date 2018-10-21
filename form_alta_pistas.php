<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();

// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['numpista'] = "";
		$formulario['pista'] = "";
		$formulario['precio'] = "";
		
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

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
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
  
<div class="formPistas" id="formpista">
		<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>		
	<form class="contenidoform" id="altaPista" method="get" action="accion_alta_pistas.php"  novalidate="">
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend><strong>Datos a rellenar de la pista</strong></legend> 
			 <div><label for="numpista">Número de pista:<em>*</em></label>
			 <input id="numpista" name="numpista" type="number" size="20" value="<?php echo $formulario['numpista'];?>" required />		
			 </div>
			 
			 <div><label for="pista">Tipo de Pista:<em>*</em></label>
			 	<select name="pista" id="pista">

					<option value="FUTBOL"<?php if($formulario['pista']=='FUTBOL') $formulario['pista'];?>>FUTBOL</option>
					
					<option value="PADEL"<?php if($formulario['pista']=='PADEL') $formulario['pista'];?>>PADEL</option>
					
					<option value="TENIS"<?php if($formulario['pista']=='TENIS') $formulario['pista'];?>>TENIS</option>
					
				</select>
				<!-- <label>
				<input name="pista" type="radio" value="FUTBOL" <?php if($formulario['pista']=='FUTBOL') echo ' checked ';?>/>
					Fútbol</label>
				<label>
					<input  name="pista" type="radio" value="PADEL" <?php if($formulario['pista']=='PADEL') echo ' checked ';?>/>
					Padel</label>
				<label>
					<input  name="pista" type="radio" value="TENIS" <?php if($formulario['pista']=='TENIS') echo ' checked ';?>/>
					Tenis</label> -->
			</div>
					
			
			<div><label for="precio">Precio:<em>*</em></label>
			<input id="precio" name="precio" type="number" size="20" value="<?php echo $formulario['precio'];?>" required/>
			</div>
		
		</fieldset>
		
		<div><input type="submit" id="boton_registrarse" value="Registrar" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>
		
	</form>	
</div>
<script>
		function myfunction(){
			document.getElementById("altaPista").reset();
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
