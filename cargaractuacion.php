<?php 
	include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Carga de Actuacion</title>
	<!-- Bootstrap -->
	<meta charset="utf-8">
</head>
<body>
	<?php 
		include "menu.php";
		include "incluirjq.php";

	?>
	<?php if (!isset($_SESSION['logged'])){
	header('Location: consejaliabeta.php');
}
?>
	<div class="container">
		<form action="" method="POST">
			<div class="form-group">
				<h1>Carga de Actuacion</h1>
				<h2>Datos comunes a todas las actuaciones</h2>
				<label>Numero de Expediente:</label>
				<input class="form-control" id="nmexpediente" name="nmexpediente" list="expedientes">
				<datalist id="expedientes">
					<?php 
						$expedientes = mysqli_query($conexion, "SELECT * FROM expediente ORDER BY numero LIMIT 9999");
						setlocale(LC_ALL, "spanish");
						while($expediente=mysqli_fetch_array($expedientes)){
							echo "<option value='" . $expediente['numero'] . "'>";
						};
					?>
				</datalist>				
				<label for="numero">Numero de Actuacion Simple:</label>
				<input class="form-control" type="text" id="numero" name="numero" placeholder="">
				<label>Fin/Destino/Enviado a:</label>
				<input class="form-control" type="text" id="fin"  name="fin">
				<label for="fecha">Fecha de Presentacion:</label>
				<input class="form-control" type="date" id="fecha"  name="fecha">
				<label for="resena">Reseña:</label>
				<textarea class="form-control" id="resena" name="resena"></textarea>
				<label for="tipo">Tipo de Actuacion:</label>
				<select class="form-control" autocomplete="off" id="tipo" name="tipo" onchange="actuacion()">
					<option selected value="Pase">Pase</option>
					<option value="Instrumento">Instrumento</option>					
				</select>
				
				<!-- pases -->
				
				<div id="pases">
					<h2>Datos para pases</h2>
					<label for="paseorigen">Origen:</label>
					<input class= "form-control" list="areas" id="paseorigen" name="paseorigen">
					<datalist id="areas">
						<option value="Equipo de Proyecto">
						<option value="Secretaria">
						<option value="Equipo territorial del bloque">
						<option value="Equipo CCPA">
						<option value="Area de Personal">
					</datalist>
					<label for="pasedestino">Destino:</label>
					<input class= "form-control" list="areas" id="pasedestino" name="pasedestino">
					<datalist id="areas">
						<option value="Equipo de Proyecto">
						<option value="Secretaria">
						<option value="Equipo territorial del bloque">
						<option value="Equipo CCPA">
						<option value="Area de Personal">
					</datalist>
				</div>
				<!-- instrumentos -->
				<div id="instrumentos" style="display: none;">
							<h2>Datos para Instrumentos</h2>
							<label for="tipoins">Tipo de instrumento:</label>
							<select class="form-control" id="tipoins" name="tipoins" autocomplete="off" onchange="instrumento()">
								<option selected value="Nota">Nota</option>
								<option value="Memorandum">Memorandum</option>
								<option value="Resolucion">Resolucion</option>
								<option value="Disposicion">Disposicion</option>
								<option value="Proyecto">Proyecto</option>
								<option value="Proyecto de Ordenanza">Proyecto de Ordenanza</option>
								<option value="Ordenanza">Ordenanza</option>
								<option value="Ley">Ley</option>
								<option value="Declaracion">Declaracion</option>
								<option value="Invitacion">Invitacion</option>
								<option value="Oficio">Oficio</option>
								<option value="Otro">Otro</option>
							</select>
							
							<!-- notas -->
							
							<div id="notas">
								<h3>Datos para Nota</h3>
								<label for="notaayn">Apellido y Nombre:</label>
								<input class="form-control" type="text" id="notaayn" name="notaayn">
								<label for="notadni">DNI (sin puntos):</label>
								<input class="form-control" type="number" id="notadni" name="notadni" min="0" max="999999999">
								<label for="notadireccion">Direccion:</label>
								<input class="form-control" type="text" id="notadireccion" name="notadireccion">
								<label for="notatelefono">Numero de telefono:</label>
								<input class="form-control" type="text" id="notatelefono" name="notatelefono">
							</div>					
							<!-- memorandums -->
								<div id="memorandums" style="display: none;">
									<h3>Datos para Memorandum</h3>
								</div>
							<!-- resolusiones -->
								<div id="resoluciones" style="display: none;">
									<h3>Datos para Resolucion</h3>
									<label for="resnumero">Numero de Resolucion:</label>
									<input class="form-control" type="number" id="resnumero" name="resnumero">
									<label for="resndado">Numero de Actuacion de Origen:</label>
									<input class="form-control" type="text" id="resndado"  name="resndado" placeholder="">
								</div>
							<!-- disposiciones -->
								<div id="disposiciones" style="display: none;">
									<h3>Datos para Disposición</h3>
								</div>
							<!-- proyectos -->
								<div id="proyectos" style="display: none;">
									<h3>Datos para Proyecto</h3>
								</div>
							<!-- Proyectos De Ordenanza -->
								<div id="proyectosDeOrdenanza" style="display: none;">
									<h3>Datos para Proyecto de Ordenanza</h3>
									<label for="pdotipo">Tipo:</label>
									<select class="form-control" id="pdotipo" name="pdotipo">
										<option value="Ordenanza">Ordenanza</option>
										<option value="Resolucion">Resolucion</option>
										<option value="Declaracion">Declaracion</option>
									</select>
									<label for="pdoconcejal">Consejal:</label>
									<input class="form-control" type="text" id="pdoconcejal" name="pdoconcejal">
									<label for="pdobarrio">Barrio:</label>
									<input class="form-control" type="text" id="pdobarrio" name="pdobarrio">
									<label for="pdotemas">Temas:</label>
									<input class="form-control" type="text" id="pdotemas" name="pdotemas">
									<label for="pdotiposes">Tipo de sesiones/audiencia:</label>
									<select class="form-control" id="pdotiposes" name="pdotiposes">
										<option value="Sesion Ordinaria">Sesion Ordinaria</option>
										<option value="Sesion Especial">Sesion Especial</option>
										<option value="Audiencia Publica">Audiencia Publica</option>
									</select>
								</div>
							<!-- ordenanzas -->
								<div id="ordenanzas" style="display: none;">
									<h3>Datos para Ordenanza</h3>
									<label for="ordnumero">Numero de Ordenanza:</label>
									<input class="form-control" type="number" id="ordnumero" name="ordnumero">
									<label for="ordnumerores">Numero de Resolucion:</label>
									<input class="form-control" type="number" id="ordnumerores" name="ordnumerores">
									<label for="ordndado">Numero de Actuacion de Origen:</label>
									<input class="form-control" type="text" id="ordndado"  name="ordndado" placeholder="">
								</div>
							<!-- leyes -->
								<div id="leyes" style="display: none;">
									<h3>Datos para Ley</h3>
									<label for="leynumero">Numero de Ley:</label>
									<input class="form-control" type="text" id="leynumero" name="leynumero">
								</div>
							<!-- declaraciones -->
								<div id="declaraciones" style="display: none;">
									<h3>Datos para Declaracion</h3>
									<label for="declnumero">Numero de Declaracion:</label>
									<input class="form-control" type="text" id="declnumero" name="declnumero">
									<label for="declndado">Numero de Actuacion de Origen:</label>
									<input class="form-control" type="text" id="declndado"  name="declndado" placeholder="">
								</div>
							<!-- invitaciones -->
								<div id="invitaciones" style="display: none;">
									<h3>Datos para Invitacion</h3>
									<label for="invitacionqi">Quien invita:</label>
									<input class= "form-control" list="qis" id="invitacionqi" name="invitacionqi">
									<datalist id="qis">
										<option value="Secretaria de Gobierno">
										<option value="Administracion Provincial del Agua">
										<option value="SAMEEP">
									</datalist>
								</div>
							<!-- oficios -->
							<div id="oficios" style="display: none;">
							<h3>Datos para Oficio</h3>
							<label for="oficionro">Numero de Oficio:</label>
							<input class="form-control" type="text" id="oficionro" name="oficionro">
							</div>					
				</div>
					<br>
					<input class="btn btn-default" type="submit" name="enviar" value="Cargar Actuacion">
			</div>	
		</form>
	</div>
	</body>
	<script>
		function instrumento() {
			var input;
			input = document.getElementById("tipoins").value;
				  	switch(input) {
					    case "Nota":
					    	aux = document.getElementById("notas");
					    	aux.style.display = "";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Memorandum":
					    	aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Resolucion":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Disposicion":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Proyecto":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Proyecto de Ordenanza":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Ordenanza":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Ley":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Declaracion":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Invitacion":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					    break;
					    case "Oficio":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "";
					    break;
					    case "Otro":
					    aux = document.getElementById("notas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("memorandums");
					    	aux.style.display = "none";
					    	aux = document.getElementById("resoluciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("disposiciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectos");
					    	aux.style.display = "none";
					    	aux = document.getElementById("proyectosDeOrdenanza");
					    	aux.style.display = "none";
					    	aux = document.getElementById("ordenanzas");
					    	aux.style.display = "none";
					    	aux = document.getElementById("leyes");
					    	aux.style.display = "none";
					    	aux = document.getElementById("declaraciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("invitaciones");
					    	aux.style.display = "none";
					    	aux = document.getElementById("oficios");
					    	aux.style.display = "none";
					} 
		}
		
		function actuacion() {
			var input;
			input = document.getElementById("tipo").value;
			switch(input) {
			    case "Pase":
			    	aux = document.getElementById("pases");
			    	aux.style.display = "";
			    	aux = document.getElementById("instrumentos");
			    	aux.style.display = "none";
			    break;
			    case "Instrumento":
			    	aux = document.getElementById("pases");
			    	aux.style.display = "none";
			    	aux = document.getElementById("instrumentos");
			    	aux.style.display = "";
				break;
			} 
		}
	</script>
</html>



<?php
	//guardamos el formulario
	if (isset($_POST['enviar'])) {
		
		
		//consigue el id del expediente mediante el numero de expediente y arregla para el expediente nulo
		$expedientes = mysqli_query($conexion, "SELECT * FROM expediente WHERE numero='". $_POST['nmexpediente'] ."' ORDER BY numero LIMIT 1");
		$expediente=mysqli_fetch_array($expedientes);
			
			if(!is_numeric($expediente['idexpediente'])){
				$idexpe="NULL";
			}else {
				$idexpe = "'". $expediente['idexpediente'] . "'";
			}


		//guardamos el formulario
		mysqli_query($conexion, "INSERT INTO actuacion(idexpediente, numero, fin, fecha, resena, tipo, paseorigen, pasedestino, usuario) VALUES(
			".$idexpe.",
			'".$_POST['numero']."',
			'".$_POST['fin']."',
			'".$_POST['fecha']."',
			'".$_POST['resena']."',
			'".$_POST['tipo']."',
			'".$_POST['paseorigen']."',
			'".$_POST['pasedestino']."',
			'".$_SESSION['usuario']." Creo'
			)"
		);
		
		//Consigue el id de la actuacion mediante el numero de actuacion simple
		$actuaciones = mysqli_query($conexion, "SELECT * FROM actuacion WHERE numero='". $_POST['numero'] ."' ORDER BY numero LIMIT 1");
		setlocale(LC_ALL, "spanish");
		$actuacion=mysqli_fetch_array($actuaciones);
		
		//Si la actuacion es de tipo instrumento, inserta un registro en la tabla instrumento
		if ($_POST['tipo'] == 'Instrumento') {			
			
			echo "INSERT INTO instrumento(idactuacion, tipo, notaayn, notadni, notadireccion, notatelefono, resnumero, resndado, pdotipo, pdoconcejal, pdobarrio, pdotemas, pdotiposes, ordnumero, ordnumerores, ordndado, leynumero, declnumero, declndado, invitacionqi, oficionro) VALUES(
			'".$actuacion['idactuacion']."',
			'".$_POST['tipoins']."',
			'".$_POST['notaayn']."',
			'".$_POST['notadni']."',
			'".$_POST['notadireccion']."',
			'".$_POST['notatelefono']."',
			'".$_POST['resnumero']."',
			'".$_POST['resndado']."',
			'".$_POST['pdotipo']."',
			'".$_POST['pdoconcejal']."',
			'".$_POST['pdobarrio']."',
			'".$_POST['pdotemas']."',
			'".$_POST['pdotiposes']."',
			'".$_POST['ordnumero']."',
			'".$_POST['ordnumerores']."',
			'".$_POST['ordndado']."',
			'".$_POST['leynumero']."',
			'".$_POST['declnumero']."',
			'".$_POST['declndado']."',
			'".$_POST['invitacionqi']."',
			'".$_POST['oficionro']."'
			)";
			mysqli_query($conexion, "INSERT INTO instrumento(idactuacion, tipo, notaayn, notadni, notadireccion, notatelefono, resnumero, resndado, pdotipo, pdoconcejal, pdobarrio, pdotemas, pdotiposes, ordnumero, ordnumerores, ordndado, leynumero, declnumero, declndado, invitacionqi, oficionro) VALUES(
			'".$actuacion['idactuacion']."',
			'".$_POST['tipoins']."',
			'".$_POST['notaayn']."',
			'".$_POST['notadni']."',
			'".$_POST['notadireccion']."',
			'".$_POST['notatelefono']."',
			'".$_POST['resnumero']."',
			'".$_POST['resndado']."',
			'".$_POST['pdotipo']."',
			'".$_POST['pdoconcejal']."',
			'".$_POST['pdobarrio']."',
			'".$_POST['pdotemas']."',
			'".$_POST['pdotiposes']."',
			'".$_POST['ordnumero']."',
			'".$_POST['ordnumerores']."',
			'".$_POST['ordndado']."',
			'".$_POST['leynumero']."',
			'".$_POST['declnumero']."',
			'".$_POST['declndado']."',
			'".$_POST['invitacionqi']."',
			'".$_POST['oficionro']."'
			)"
			);
		}		
	}
 ?>

 
