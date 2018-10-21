		
<?php 
	error_reporting(E_ALL ^ E_NOTICE);

    session_start();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>GIMNASIO LA VENTA</title>
		<link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
		<meta name="description" content="">
		<meta name="author" content="JoseCarlos">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		
		<link rel="stylesheet" type="text/css" href="css/gimnasio.css" />
		<link rel="stylesheet" href="fonts/style.css" />
		
		<link rel="stylesheet"  type="text/css"  href="css/slider.css" />
		<script src="javascript/mapa.js"></script>
		<!--añandido -->
		<link rel="stylesheet" type="text/css" href="css/form_usuario-css.css" />
  <link rel="stylesheet" type="text/css" href="css/formEvento.css" />

  <link rel="shortcut icon" type="image/jpg" href="images/Logo1.jpg"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.mim.js" type="text/javascript"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="javascript/validarContraseña.js" type="text/javascript"></script>
		
	</head>
	
	<div>
	<header>
		
		<!-- Probando efectos-->
		<!-- <div class="contenedor">
			<center><img src="images/Logo1.jpg"/ width="150px" height="150px" align="left" ></center>
			<p>Gimnasio La venta</p>
			<p> Deporte es vida</p>
			<ul>
				<li>Salud</li>
				<li>Bienestar</li>
			</ul> -->
		
		<div class="cabecera">
	        <center><img src="images/Logo1.jpg"/ width="160px" height="100%" align="left" ></center>
	    	<center><em><h1>Gimnasio La Venta</h1></em></center>
	        <center><h3><small>Siempre en forma</small></h3></center>
	        
         </div>		
	<nav class="navegacion">
		<ul class="menu">
			<!-- onclick="document.getElementById('formusuario').style.display='block'" -->
		 <a href="../GYM_ACTUALIZADO/form_alta_usuario.php" target="_self">
		<input style="background-color: #FF9900" type="submit" name="boton" value="Registrarse"  /></a>
		<a href="../GYM_ACTUALIZADO/form_login.php" target="_self"><input style="background-color: #FF9900" type="button" name="boton" value="Iniciar sesión" /></a> 
			<li><a href="../GYM_ACTUALIZADO/FirstPage.php"><span class="primero"><i class="icon icon-home"></i></span>Inicio</a></li>
			<li><a href="#"><span class="primero"><i class="icon icon-earth"></i></span>Navegación</a>
				<ul class="submenu">
					<li><a href="">RedesSociales</a></li>
					<li><a href="http://cdlaventa.blogspot.com/" target="_blank">Blog</a></li>
				</ul>
			</li>
			<li><a href="login.php"><span class="primero"><i class="icon icon-accessibility"></i></span>Cursos</a>
			</li>
			<li><a href="#contactodireccion"><span class="primero"><i class="icon icon-envelop"></i></span>Contacto</a>
				<ul class="submenu">
					<li><a href="#">Fundación</a></li>
					<li><a href="#contactodireccion">Contáctanos</a></li>
				</ul>
			</li>
			<li><a href="#map"><span class="primero"><i class="icon icon-earth"></i></span>Localización</a>
				
			</li>	
				
		</ul>
	</nav>
	
	
	</header>
		<!-- Termina el cuerpo del Header -->
		<!-- Empieza el cuerpo del Body -->
	<body>
		
		<main>
				<section>
					<hr/>
					<center><h4><em class="nuestras">NUESTRAS INSTALACIONES</em></h4></center>	
					<!-- a añadido lisi -->
					<div class="conjuntofotos">
						<div id="flecha-izquierda" class="flecha"></div>
						<div id="controlDeslizante">
							<div class="cambio desliza1">
								<div class="desliza-contenido">
									<span>Nuestro gimnasio</span>
								</div>
							</div>
							<div class="cambio desliza2">
								<div class="desliza-contenido">
									<span>Piscina</span>
								</div>
							</div>
							<div class="cambio desliza3">
								<div class="desliza-contenido">
									<span>Pista de Tenis</span>
								</div>
							</div>
							<div class="cambio desliza4">
								<div class="desliza-contenido">
									<span>Visitanos</span>
								</div>
							</div>
						</div>
						<div id="flecha-derecha" class="flecha"></div>
					</div>
					<script src="javascript/imagenesCambiantes.js"  type="text/javascript" ></script>	
				</section>
				<section>
					<hr>
					<center><h4><em class="descubre">DESCUBRE EL CENTRO</em></h4></center>
					<hr>
					<article id="datosgimnasio">
						<p>
							<strong><h4>¡Matrícula GRATIS en cuota Oro (29,90€/mes)!</h4></strong>
						</p><br>
						<div>
							 En nuestro gimnasio de Sevilla contamos con unas completas y modernas instalaciones en las que disfrutarás de todo tipo   de actividades con las que ponerte en forma y pasarlo bien, ¡porque en Centro deportivo La Venta queremos que disfrutes haciendo ejercicio!
								.....y mucho más:   
		                       <ul id="puntos">    
		                        	    <li type="square">3.500m2 de instalaciones</li>
		                                <li type="square">Espacios gigantes</li>
		                                <li type="square">Zona de estiramientos</li>
		                                <li type="square">Área de entrenamiento funcional</li>
		                                <li type="square">Sauna, baño de vapor y solárium</li>
		                                <li type="square">Más de 150 clases a la semana</li>
		                                <li type="square">Maquinaria Technogym con más de 250 puestos</li>
		                                <li type="square">Reserva de las clases a través de la página web</li>
		                                <li type="square">Parking gratuito</li>
		                            </ul><br>
                                </div>
                            	Únete a <strong>Centro deportivo La Venta</strong> y aprovecha todas las comodidades de un gran gimnasio al precio mereces.
                                Apúntate ahora......¡en 1 minuto!
                     </article>      
			    </section>
				<section>
				    <hr>
					<center><h4><em class="contacto">CONTACTO Y LOCALIZACIÓN</em></h4></center>
					<hr>
				<section>
					<div id="map" style="width:60%;height:400px;"></div>
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCb3ujcB9vaj525On55gZSnk2G_FOjbiuw&callback=myMap"></script>	
				</section>
				<section>
					<div id="contactodireccion"> 
						<h4>DIRECCIÓN Y DATOS DE CONTACTO</h4><br>
						  <h5>Calle Alondra,1</h5>
						  <h5>41600 Arahal</h5>
						  <h5><strong>Teléfono:</strong> 625196615</h5>
						  <h5><strong>Email:</strong> centrodeportivolaventa@gmail.com</h5><br />

						  <a href="https://www.google.es/maps/dir/''/como+llegar+al+gimnasio+la+venta+arahal/@37.2557163,-5.6199418,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0xd129b59b57c3beb:0xe223d6025fdc3831!2m2!1d-5.5499018!2d37.2557369">Cómo llegar</a>

					</div>
				</section>
			</main><br><br><br><br>
			<br><br><br><br>
			
			<footer>
				<p>
					&copy; Centro deportivo La venta 2018
				</p>
			</footer>
	</div>
	<!-- formulario registro persona-->	
	</div>
	</section>

</body>
</html>
