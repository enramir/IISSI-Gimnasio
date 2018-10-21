<?php 
	error_reporting(E_ALL ^ E_NOTICE);

    session_start(); 
	// require_once("gestionBD.php");
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
		$formulario['dni'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['telefono'] = "";
		$formulario['direccion'] = "";
		$formulario['email'] = "";
		$formulario['nickname'] = "";
		$formulario['contraseña'] = "";
		
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		//unset($_SESSION["errores"]);
	}
	// Finalmente, destruir la sesión.
	//session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->


  <title>Gestión del gimnasio: Crear una usuario</title>
  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <!-- <link rel="stylesheet"  type="text/css"  href="css/Gestion-css.css" /> -->
    <link rel="stylesheet"  type="text/css"  href="css/formPistas.css" />

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.mim.js" type="text/javascript"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="javascript/validarContraseña.js" type="text/javascript"></script>


</head>
 <?php
	include_once("cabeceraInicio.php");
?> 
<body>
	<script>
		$(document).ready(function() {
			//Manejador de evento del color de la contraseña
			$("#pass").on("input", function() {
				// Calculo el color
				passwordColor();
			});
			$("#confirmpass").on("input", function() {
				// Calculo el color
				passwordColor();
			});
			

		});
		
	</script>

  
<div class="formUsuario" id="formusuario">
		<?php
	//Mostrar los errores de vlidacion si los hay
		if(isset($errores) && count($errores) >0){
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
    		echo "</div>";
		}
	?>		
<form class="contenidoAlta" id="altaUsuario" method="get" action="accion_alta_usuario.php" onsubmit="return validateForm()">
		
		<p><i>Los campos obligatorios estan marcados con</i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			<div><label for="dni">DNI<em>*</em></label>
			<input id="dni" name="dni" type="text" maxlength="9" placeholder="12345678A" pattern="^[0-9]{8}[A-Z]" 
			title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['dni'];?>" required />
			 </div>
			 
			 <div><label for="nombre">Nombre:<em>*</em></label>
			 <input id="nombre" name="nombre" type="text" size="40" placeholder="Miriam" value="<?php echo $formulario['nombre'];?>" required/>		
			 </div>
			 
			<div><label for="apellidos">Apellidos:<em>*</em></label>
			<input id="apellidos" name="apellidos" type="text" size="60" placeholder="Fernández Martínez" value="<?php echo $formulario['apellidos'];?>" required/>
			</div>
			
			<div><label for="fechaNacimiento">Fecha de nacimiento:<em>*</em></label>
			<input type="date" id="fechaNacimiento" placeholder="19/09/1999" name="fechaNacimiento"  
			value="<?php echo $formulario['fechaNacimiento'];?>" required/>
			</div>
			
			<div><label for="telefono">Teléfono:</label>
			<input id="telefono" name="telefono" type="text" placeholder="95570../680..." size="18" maxlength="9" 
			value="<?php echo $formulario['telefono'];?>"/>
			</div>
			
			<div><label for="direccion">Dirección:<em>*</em></label>
			<input id="direccion" name="direccion" type="text" placeholder="C/A - "#"" size="80" 
			value="<?php echo $formulario['direccion'];?>" required/>
			</div>
			
			<div><label for="email">Email:<em>*</em></label>
			<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" size="50" 
			pattern="([a-zA-Z0-9_-])+@((alum.)?us.es|gmail.com|hotmail.com|hotmail.es|outlook.es|outlook.com)" 
			value="<?php echo $formulario['email'];?>"  required/><br>
			</div>
		</fieldset>
		
		<fieldset><legend>Datos de la cuenta</legend>
			<div><label for="nick">Nickname:<em>*</em></label>
			<input type="nickname" name="nickname" id="nick" size="30" placeholder="miriam3" required/>
			</div>
			<div><label for="pass">Contraseña:<em>*</em></label>
				<input type="password" name="contraseña" id="pass" 
					placeholder="Debe contener letras mayúsculas, minúsculas y dígitos" 
					size="55" required oninput="passwordValidation()"  oninput="passwordColor()"/>	
				<input type="checkbox" onclick="mostrarContraseña()" />Mostrar Contraseña
				<p id="p1">Contraseña muy mala</p>
			</div>
			
			<div><label for="confirmpass">Confirmar Contraseña:<em>*</em></label>
			<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de la contraseña" 
					size="50" required oninput="passwordConfirmation()" />
					
			</div>
		</fieldset>
		
		<div><input type="submit" id="boton_registrarse" value="Registrarse" /></div>
		<div><input type="button" id="boton_reset" onclick="myfunction()" value="Limpiar"/></div>
		<p>¿Ya estás registrado? <a href="login.php">¡Entra!</a></p>
		
	</form>	
</div>
<script>
		function myfunction(){
			document.getElementById("altaUsuario").reset();
		}
</script>


<?php
	include_once("pie.php");
?>

</body>
</html>