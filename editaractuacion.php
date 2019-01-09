<?php 
	include "conexion.php";
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Editar Actuacion</title>
		<!-- Bootstrap -->
		<meta charset="utf-8">
	</head>
	<body onload="actuacion()">
		<?php 
			include "menu.php";
			include "incluirjq.php";
		?>
		<?php 
			$actuaciones=mysqli_query($conexion, "SELECT * FROM actuacion 
				WHERE idactuacion=".$_GET['idactuacion'].
				" LIMIT 1");
			$actuacion=mysqli_fetch_array($actuaciones);
			setlocale(LC_ALL, "spanish");
			$act= $actuacion;
			
			
			$instrumentos=mysqli_query($conexion, "SELECT * FROM instrumento 
				WHERE idactuacion=".$_GET['idactuacion']." LIMIT 1");
			$instrumento=mysqli_fetch_array($instrumentos);
			setlocale(LC_ALL, "spanish");
			$inst= $instrumento;
			
		?>

		<div class="container">
			<form action="" method="POST">
				<div class="form-group">
					<h1>Editar Actuacion</h1>
					
					<label>Numero de expediente:</label>
					<?php

					$expedientes = mysqli_query($conexion, "SELECT * FROM expediente WHERE idexpediente='". $_GET['idexpediente'] ."' ORDER BY numero LIMIT 1");
					$expediente=mysqli_fetch_array($expedientes);
					 ?>
					<input type="text" class="form-control" list="expedientes" id="idexpediente" name="idexpediente" value="<?php echo $expediente['numero']; ?>">
					<datalist id="expedientes">
						<?php 
							$expedientes = mysqli_query($conexion, "SELECT * FROM expediente ORDER BY numero LIMIT 9999");
							setlocale(LC_ALL, "spanish");
					  		while($expediente=mysqli_fetch_array($expedientes)){
								if($expediente['idexpediente']==$act['idexpediente']){ 
								} 
								else {
									$selected="";
								}
								echo "<option id='".$expediente['idexpediente']."' value='" . $expediente['numero'] . "'></option>"	;
							};
						?>

					</datalist>
					</select>
					<label for="numero">Numero de Actuacion Simple:</label>
					<input class="form-control" type="text" id="numero" name="numero" value="<?php echo $act['numero']; ?>" placeholder="" >
					<label for="fin">Fin/Destino/Enviado a:</label>
					<input class="form-control" id="fin" type="text" name="fin" value="<?php echo $act['fin']; ?>">
					<label for="fecha">Fecha de Presentacion:</label>
					<input class="form-control" type="date" id="fecha" name="fecha" value="<?php echo $act['fecha']; ?>">
					<label for="resena">Reseña:</label>
					<textarea class="form-control" id="resena" name="resena"><?php echo $act['resena']; ?></textarea>					
					<label for="tipo">Tipo de Actuacion:</label>
					<input type="text" class="form-control" disabled value="<?php echo $act['tipo'] ?>">
					<input type="hidden" id="tipo" name="tipo" value="<?php echo $act['tipo'] ?>">
					<!-- 
					<select class="form-control" id="tipo" name="tipo" disabled="disabled">
						<option value="Pase" <?php if ($act['tipo']=="Pase"){ echo "selected='selected'"; }; ?>>Pase</option>
						<option value="Instrumento" <?php if ($act['tipo']=="Instrumento"){ echo "selected='selected'"; }; ?>>Instrumento</option>			
					</select>	
					-->
					<!-- pases -->
					<div id="pases">
					<h2>Datos para pases</h2>
					<label for="paseorigen">Origen:</label>
					<input class= "form-control" list="areas" id="paseorigen" name="paseorigen" value="<?php echo $act['paseorigen']; ?>" >
					<datalist id="areas">
						<option value="Equipo de Proyecto">
						<option value="Secretaria">
						<option value="Equipo territorial del bloque">
						<option value="Equipo CCPA">
						<option value="Area de Personal">
					</datalist>
					<label for="pasedestino">Destino:</label>
					<input class= "form-control" list="areas" id="pasedestino" name="pasedestino" value="<?php echo $act['pasedestino']; ?>">
					<datalist id="areas">
						<option value="Equipo de Proyecto">
						<option value="Secretaria">
						<option value="Equipo territorial del bloque">
						<option value="Equipo CCPA">
						<option value="Area de Personal">
					</datalist>
					</div>
						
					<!-- instrumentos -->
					<div id="instrumentos">
					
					<h2>Datos para Instrumentos</h2>
					<label for="tipoins">Tipo de instrumento:</label>
					<select class="form-control" id="tipoins" name="tipoins" autocomplete="off" disabled="disabled">
						<option selected value="Nota" <?php if ($inst['tipo']=="Nota"){ echo "selected='selected'"; }; ?>>Nota</option>
						<option value="Memorandum" <?php if ($inst['tipo']=="Memorandum"){ echo "selected='selected'"; }; ?>>Memorandum</option>
						<option value="Resolucion" <?php if ($inst['tipo']=="Resolucion"){ echo "selected='selected'"; }; ?>>Resolucion</option>
						<option value="Disposicion" <?php if ($inst['tipo']=="Disposicion"){ echo "selected='selected'"; }; ?>>Disposicion</option>
						<option value="Proyecto" <?php if ($inst['tipo']=="Proyecto"){ echo "selected='selected'"; }; ?>>Proyecto</option>
						<option value="Proyecto de Ordenanza" <?php if ($inst['tipo']=="Proyecto de Ordenanza"){ echo "selected='selected'"; }; ?>>Proyecto de Ordenanza</option>
						<option value="Ordenanza" <?php if ($inst['tipo']=="Ordenanza"){ echo "selected='selected'"; }; ?>>Ordenanza</option>
						<option value="Ley" <?php if ($inst['tipo']=="Ley"){ echo "selected='selected'"; }; ?>>Ley</option>
						<option value="Declaracion" <?php if ($inst['tipo']=="Declaracion"){ echo "selected='selected'"; }; ?>>Declaracion</option>
						<option value="Invitacion" <?php if ($inst['tipo']=="Invitacion"){ echo "selected='selected'"; }; ?>>Invitacion</option>
						<option value="Oficio" <?php if ($inst['tipo']=="Oficio"){ echo "selected='selected'"; }; ?>>Oficio</option>
						<option value="Otro" <?php if ($inst['tipo']=="Otro"){ echo "selected='selected'"; }; ?>>Otro</option>
					</select>
							
					<!-- notas -->
					
					<div id="notas">
					<h3>Datos para Nota</h3>
					<label for="notaayn">Apellido y Nombre:</label>
					<input class="form-control" type="text" id="notaayn" name="notaayn" value="<?php echo $inst['notaayn']; ?>">
					<label for="notadni">DNI (sin puntos):</label>
					<input class="form-control" type="number" id="notadni" name="notadni" min="0" max="999999999" value="<?php echo $inst['notadni']; ?>">
					<label for="notadireccion">Direccion:</label>
					<input class="form-control" type="text" id="notadireccion" name="notadireccion" value="<?php echo $inst['notadireccion']; ?>">
					<label for="notatelefono">Numero de telefono:</label>
					<input class="form-control" type="text" id="notatelefono" name="notatelefono" value="<?php echo $inst['notatelefono']; ?>">
					</div>
					
					
					<!-- memorandums -->
					<div id="memorandums">
					<h3>Datos para Memorandum</h3>
					</div>
					
					<!-- resolusiones -->
					
					<div id="resoluciones">
					<h3>Datos para Resolucion</h3>					
					<label for="resnumero">Numero de Resolucion:</label>
					<input class="form-control" type="number" id="resnumero" name="resnumero" value="<?php echo $inst['resnumero']; ?>">
					<label for="resndado">Numero de Actuacion de Origen:</label>
					<input class="form-control" type="text" id="resndado"  name="resndado" placeholder="" value="<?php echo $inst['resndado']; ?>">
					</div>
					
					<!-- disposiciones -->
					<div id="disposiciones">
					<h3>Datos para Disposición</h3>
					</div>
					
					<!-- proyectos -->
					<div id="proyectos">
					<h3>Datos para Proyecto</h3>
					</div>
					
					<!-- Proyectos De Ordenanza -->
					
					<div id="proyectosDeOrdenanza">
					<h3>Datos para Proyecto de Ordenanza</h3>
					<label for="pdotipo">Tipo:</label>
					<select class="form-control" id="pdotipo" name="pdotipo">
						<option value="Ordenanza" <?php if ($inst['pdotipo']=="Ordenanza"){ echo "selected='selected'"; }; ?> >Ordenanza</option>
						<option value="Resolucion" <?php if ($inst['pdotipo']=="Resolucion"){ echo "selected='selected'"; }; ?> >Resolucion</option>
						<option value="Declaracion" <?php if ($inst['pdotipo']=="Declaracion"){ echo "selected='selected'"; }; ?> >Declaracion</option>
					</select>
					<label for="pdoconcejal">Consejal:</label>
					<input class="form-control" type="text" id="pdoconcejal" name="pdoconcejal" value="<?php echo $inst['pdoconcejal']; ?>">
					<label for="pdobarrio">Barrio:</label>
					<input class="form-control" type="text" id="pdobarrio" name="pdobarrio" value="<?php echo $inst['pdobarrio']; ?>">
					<label for="pdotemas">Temas:</label>
					<input class="form-control" type="text" id="pdotemas" name="pdotemas" value="<?php echo $inst['pdotemas']; ?>">
					<label for="pdotiposes">Tipo de sesiones/audiencia:</label>
					<select class="form-control" id="pdotiposes" name="pdotiposes">
						<option value="Sesion Ordinaria" <?php if ($inst['pdotiposes']=="Sesion Ordinaria"){ echo "selected='selected'"; }; ?>>Sesion Ordinaria</option>
						<option value="Sesion Especial" <?php if ($inst['pdotiposes']=="Sesion Especial"){ echo "selected='selected'"; }; ?>>Sesion Especial</option>
						<option value="Audiencia Publica" <?php if ($inst['pdotiposes']=="diencia Publica"){ echo "selected='selected'"; }; ?>>Audiencia Publica</option>
					</select>
					</div>
					
					<!-- ordenanzas -->
					
					<div id="ordenanzas">
					<h3>Datos para Ordenanza</h3>
					<label for="ordnumero">Numero de Ordenanza:</label>
					<input class="form-control" type="number" id="ordnumero" name="ordnumero" value="<?php echo $inst['ordnumero']; ?>">
					<label for="ordnumerores">Numero de Resolucion:</label>
					<input class="form-control" type="number" id="ordnumerores" name="ordnumerores" value="<?php echo $inst['ordnumerores']; ?>">
					<label for="ordndado">Numero de Actuacion de Origen:</label>
					<input class="form-control" type="text" id="ordndado"  name="ordndado" placeholder="" value="<?php echo $inst['ordndado']; ?>">
					</div>
					
					<!-- leyes -->
					<div id="leyes">
					<h3>Datos para Ley</h3>
					<label for="leynumero">Numero de Ley:</label>
					<input class="form-control" type="text" id="leynumero" name="leynumero" value="<?php echo $inst['leynumero']; ?>">
					</div>
					
					<!-- declaraciones -->
					
					<div id="declaraciones">
					<h3>Datos para Declaracion</h3>
					<label for="declnumero">Numero de Declaracion:</label>
					<input class="form-control" type="text" id="declnumero" name="declnumero" value="<?php echo $inst['declnumero']; ?>" >
					<label for="declndado">Numero de Actuacion de Origen:</label>
					<input class="form-control" type="text" id="declndado"  name="declndado" placeholder="" value="<?php echo $inst['declndado']; ?>" >
					</div>
						
					<!-- invitaciones -->
					
					<div id="invitaciones">
					<h3>Datos para Invitacion</h3>
					<label for="invitacionqi">Quien invita:</label>
					<input class= "form-control" list="qis" id="invitacionqi" name="invitacionqi" value="<?php echo $inst['invitacionqi']; ?>" >
					<datalist id="qis" >
						<option value="Secretaria de Gobierno">
						<option value="Administracion Provincial del Agua">
						<option value="SAMEEP">
					</datalist>
					</div>

					<!-- oficios -->
					<div id="oficios">
					<h3>Datos para Oficio</h3>
					<label for="oficionro">Numero de Oficio:</label>
					<input class="form-control" type="text" id="oficionro" name="oficionro" value="<?php echo $inst['oficionro']; ?>" >
					</div>
					</div>				
					<br>
					<input class="btn btn-default" type="submit" name="enviar" value="Guardar Cambios">
				</div>	
			</form>
		</div>
	</body>
	<script>
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
	</script>	
</html>

<?php
	if (isset($_POST['enviar'])) {

		//consigue el id del expediente mediante el numero de expediente y arregla para el expediente nulo
		$expedientes = mysqli_query($conexion, "SELECT * FROM expediente WHERE numero='". $_POST['idexpediente'] ."' ORDER BY numero LIMIT 1");
		$expediente=mysqli_fetch_array($expedientes);
			
			
			if(!is_numeric($expediente['idexpediente'])){
				$idexpe="NULL";
			}else {
				$idexpe = "'". $expediente['idexpediente'] . "'";
			}


		mysqli_query($conexion, "UPDATE actuacion
			SET
			idexpediente= ".$idexpe.",
			numero= '".$_POST['numero']."',
			fin= '".$_POST['fin']."',
			fecha= '".$_POST['fecha']."',
			resena= '".$_POST['resena']."',
			paseorigen= '".$_POST['paseorigen']."',
			pasedestino= '".$_POST['pasedestino']."',
			usuario='".$_SESSION['usuario']." Edito'

			WHERE idactuacion=".$_GET['idactuacion']
		);
		
		
		if ($_POST['tipo'] == 'Instrumento') {			
			
			mysqli_query($conexion, "UPDATE instrumento
			SET 
			notaayn= '".$_POST['notaayn']."',
			notadni= '".$_POST['notadni']."',
			notadireccion= '".$_POST['notadireccion']."',
			notatelefono= '".$_POST['notatelefono']."',
			resnumero= '".$_POST['resnumero']."',
			resndado= '".$_POST['resndado']."',
			pdotipo= '".$_POST['pdotipo']."',
			pdoconcejal= '".$_POST['pdoconcejal']."',
			pdobarrio= '".$_POST['pdobarrio']."',
			pdotemas= '".$_POST['pdotemas']."',
			pdotiposes= '".$_POST['pdotiposes']."',
			ordnumero= '".$_POST['ordnumero']."',
			ordnumerores= '".$_POST['ordnumerores']."',
			ordndado= '".$_POST['ordndado']."',
			leynumero= '".$_POST['leynumero']."',
			declnumero= '".$_POST['declnumero']."',
			declndado= '".$_POST['declndado']."',
			invitacionqi= '".$_POST['invitacionqi']."',
			oficionro= '".$_POST['oficionro']."'
			
			WHERE idactuacion=".$_GET['idactuacion']."" 
			);
			
		}
		
		//header("Location: gestionactuaciones.php");
		
	}
 ?>

 
<?php if (!isset($_SESSION['logged'])){
	header('Location: consejaliabeta.php');
}