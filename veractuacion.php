<?php 
	include "conexion.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Ver Actuacion</title>
		<!-- Subida -->
<link type="text/css" rel="stylesheet" href="jquery.fileManager.css" />

<!-- include required jQuery + jQueryUI -->
<link type="text/css" rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<script type="text/javascript" src="jquery.fileManager.js"></script>
<script type="text/javascript" src="plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="plupload/js/plupload.min.js"></script>
<script type="text/javascript" src="plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<script type="text/javascript" src="plupload/js/i18n/es.js"></script>
		<!-- Fin de Subida -->



		<meta charset="utf-8">



	</head>
	<body onload="actuacion()">


		<?php 
			include "menu.php";
			
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
					<h1>Ver Actuacion</h1>
					
					<label>Numero de expediente:</label>
					<select class="form-control" id="idexpediente" name="idexpediente" disabled>
					<option selected></option>>
						<?php 
							$expedientes = mysqli_query($conexion, "SELECT * FROM expediente ORDER BY numero LIMIT 9999");
							setlocale(LC_ALL, "spanish");
					  		while($expediente=mysqli_fetch_array($expedientes)){
								if($expediente['idexpediente']==$act['idexpediente']){ 
									$selected="selected='selected'";
								} 
								else {
									$selected="";
								}
								echo "<option id='".$expediente['idexpediente']."' value='" . $expediente['idexpediente'] . "' ".$selected. ">" . $expediente['numero'] . "</option>"	;
							};
						?>
					</select>
					<label>Numero de Actuacion Simple:</label>
					<p style="color:green;"><b><?php echo $act['numero']; ?></b></p>
					<label for="fin">Fin/Destino/Enviado a:</label>
					<p style="color:green;"><b><?php echo $act['fin']; ?></b></p>
					<label for="fecha">Fecha de Presentacion:</label>
					<p style="color:green;"><b><?php echo $act['fecha']; ?></b></p>
					<label for="resena">Reseña:</label>
					<p style="color:green;"><b><?php echo $act['resena']; ?></b></p>					
					<label for="tipo">Tipo de Actuacion:</label>
					<select class="form-control" id="tipo" name="tipo" disabled="disabled">
						<option value="Pase" <?php if ($act['tipo']=="Pase"){ echo "selected='selected'"; }; ?>>Pase</option>
						<option value="Instrumento" <?php if ($act['tipo']=="Instrumento"){ echo "selected='selected'"; }; ?>>Instrumento</option>			
					</select>	

					<!-- pases -->
					
					<div id="pases">
						<h2>Datos de pases</h2>
						<label for="paseorigen">Origen:</label>
						<p style="color:green;"><b><?php echo $act['paseorigen']; ?></b></p>
						<label for="pasedestino">Destino:</label>
						<p style="color:green;"><b><?php echo $act['pasedestino']; ?></b></p>
					</div>

						
					<!-- instrumentos -->

					<div id="instrumentos">

						<h2>Datos de Instrumentos</h2>
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
							<h3>Datos de Nota</h3>
							<label for="notaayn">Apellido y Nombre:</label>
							<p style="color:green;"><b><?php echo $inst['notaayn']; ?></b></p>
							<label for="notadni">DNI (sin puntos):</label>
							<p style="color:green;"><b><?php echo $inst['notadni']; ?></b></p>
							<label for="notadireccion">Direccion:</label>
							<p style="color:green;"><b><?php echo $inst['notadireccion']; ?></b></p>
							<label for="notatelefono">Numero de telefono:</label>
							<p style="color:green;"><b><?php echo $inst['notatelefono']; ?></b></p>
						</div>
						
						<!-- memorandums  -->
						<div id="memorandums">
						<h3>Datos de Memorandum</h3>
						</div>
						
						<!-- resolusiones -->
						
						<div id="resoluciones">						
							<h3>Datos de Resolucion</h3>					
							<label for="resnumero">Numero de Resolucion:</label>
							<p style="color:green;"><b><?php echo $inst['resnumero']; ?></b></p>
							<label for="resndado">Numero de Actuacion de Origen:</label>
							<p style="color:green;"><b><?php echo $inst['resndado']; ?></b></p>
						</div>
						
						<!-- disposiciones -->
						<div id="disposiciones">
						<h3>Datos de Disposición</h3>
						</div>
						
						<!-- proyectos -->
						<div id="proyectos">
						<h3>Datos de Proyecto</h3>
						</div>
						
						<!-- Proyectos De Ordenanza -->
						
						<div id="proyectosDeOrdenanza">
							<h3>Datos de Proyecto de Ordenanza</h3>
							<label for="pdotipo">Tipo:</label>
							<p style="color:green;"><b><?php echo $inst['pdotipo']; ?></b></p>
							
							<label for="pdoconcejal">Consejal:</label>
							<p style="color:green;"><b><?php echo $inst['pdoconcejal']; ?></b></p>
							<label for="pdobarrio">Barrio:</label>
							<p style="color:green;"><b><?php echo $inst['pdobarrio']; ?></b></p>
							<label for="pdotemas">Temas:</label>
							<p style="color:green;"><b><?php echo $inst['pdotemas']; ?></b></p>
							<label for="pdotiposes">Tipo de sesiones/audiencia:</label>
							<p style="color:green;"><b><?php echo $inst['pdotiposes']; ?></b></p>						
						</div>
						
						<!-- ordenanzas -->
						
						<div id="ordenanzas">
							<h3>Datos de Ordenanza</h3>
							<label for="ordnumero">Numero de Ordenanza:</label>
							<p style="color:green;"><b><?php echo $inst['ordnumero']; ?></b></p>
							<label for="ordnumerores">Numero de Resolucion:</label>
							<p style="color:green;"><b><?php echo $inst['ordnumerores']; ?></b></p>
							<label for="ordndado">Numero de Actuacion de Origen:</label>
							<p style="color:green;"><b><?php echo $inst['ordndado']; ?></b></p>
						</div>
						
						<!-- leyes -->
						<div id="leyes">
						<h3>Datos de Ley</h3>
						<label for="leynumero">Numero de Ley:</label>
						<p style="color:green;"><b><?php echo $inst['leynumero']; ?></b></p>
						</div>
						
						<!-- declaraciones -->
						
						<div id="declaraciones">
							<h3>Datos para Declaracion</h3>
							<label for="declnumero">Numero de Declaracion:</label>
							<p style="color:green;"><b><?php echo $inst['declnumero']; ?></b></p>
							<label for="declndado">Numero de Actuacion de Origen:</label>
							<p style="color:green;"><b><?php echo $inst['declndado']; ?></b></p>
						</div>
							
						
						<!-- invitaciones -->
						<div id="invitaciones">
						<h3>Datos para Invitacion</h3>
						<label for="invitacionqi">Quien invita:</label>
						<p style="color:green;"><b><?php echo $inst['invitacionqi']; ?></b></p>
						</div>

						<!-- oficios -->
						<div id="oficios">
						<h3>Datos para Oficio</h3>
						<label for="oficionro">Numero de Oficio:</label>
						<p style="color:green;"><b><?php echo $inst['oficionro']; ?></b></p>
						</div>
					
					</div>
				</div>				
			</form>

			<div id="informe">
						<h2>Informe PDF</h2>
							<a class="btn btn-default" href="Informeactuacion.php?idactuacion=<?php echo $_GET['idactuacion'] ?>">Generar Informe</a>
				</div>

						<div id="subida">
						<h2>Manejo de Archivos</h2>
							<div id="filemanager_events"></div>
							<script type="text/javascript">
								$('#filemanager_events').fileManager({
									ajaxPath:'fileManager.php',
									upload:true,
									Path: "actuaciones/<?php echo $_GET['idactuacion'] ?>",
									fixedPath: 'actuaciones/<?php echo $_GET['idactuacion'] ?>',
									events:{
										click: function() {
											var data = $(this).data();
											window.open("/consejalia/uploads/actuaciones/<?php echo $_GET['idactuacion'] ?>/" + data.item.title, '_blank');
										}
									}
								});
							</script>
						</div>
						
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
		<!-- Ocultar Basurero -->
	<?php
		 if(!isset($_SESSION['logged'])){
	  ?>	
		<style>
            .fmTrash {
                display: none;
            }
            .ui-button.ui-widget.ui-state-default.ui-corner-all.ui-button-text-only {
            	display: none;
            }
        </style>
<?php }; ?>

</html>

