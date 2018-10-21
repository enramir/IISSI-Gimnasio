<?php 
	error_reporting(E_ALL ^ E_NOTICE);

    session_start(); 
	$fechaActual = date('d-m-Y');
			
	$fechamañana=date("d-m-Y",strtotime("+1 day"));
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['nickname'] = "";
		$formulario['tipopista'] ="";
		$formulario['numeroPista'] ="";
		
		
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->


  <title>Gestión del gimnasio: Crear una reserva</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" />
  <link rel="stylesheet"  type="text/css"  href="css/formPistas.css" />


</head>
<?php
	include_once("cabeceraClientes.php");
	

?>
<body>
<main>
  
	
<div class="formReserva" id="formreserva">
		
	<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>
	
	<form class="contenidoform" id="altaReserva" method="get" action="accion_alta_reserva.php" novalidate>
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend>Datos de la reserva</legend>
			<div><label for="nickname">Nickname<em>*</em></label>
			<input id="nickname" name="nickname" type="text" placeholder="usuario"
			title="Introduzca su nickname" value="<?php echo $formulario['nickname'];?>" required>
			 </div>
			 
			 <div><label for="tipopista">Tipo de Pista:<em>*</em></label>
					<select name="tipopista" id="tipopista">

					<option value="FUTBOL"<?php if($formulario['tipopista']=='FUTBOL') $formulario['tipopista'];?>>FUTBOL</option>
					
					<option value="PADEL"<?php if($formulario['tipopista']=='PADEL') $formulario['tipopista'];?>>PADEL</option>
					
					<option value="TENIS"<?php if($formulario['tipopista']=='TENIS') $formulario['tipopista'];?>>TENIS</option>
					</select>
				</div>
			 
			<div><label for="numeroPista">Numero de pista:<em>*</em></label>
			<input id="numeroPista" name="numeroPista" type="number" size="50" value="<?php echo $formulario['numeroPista'];?>" required/>
			</div>
			
			<!-- 
			<div><label for="fechaInicio">Fecha de inicio:<em>*</em></label>
			<input type="date" id="fechaInicio" name="fechaInicio" 
			value="<?php echo $formulario['fechaInicio'];?>"/>
			</div> -->
			
			<!-- <div><label for="fechaFin">Fecha de Fin:<em>*</em></label>
			<input type="date" id="fechaFin" name="fechaFin" 
			value="<?php echo $formulario['fechaFin'];?>"/>
			</div>-->
			
		</fieldset>
				
		<div><input type="submit" id="boton_registrarse" value="Registrarse" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>
		
	</form>	
<script>
		function myfunction(){
			document.getElementById("altaReserva").reset();
		}
	</script>

	<?php
		include_once("pie.php");
	?>
<!-- AQUI COMIENZA LAS COSAS DEL FORMULARIO DE EVENTOS:-->


	<!-- <?php
		include_once("pie.php");
	?> -->
</body>
</html>

