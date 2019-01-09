<?php 
	include "conexion.php" ;	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cargar Expediente</title>
		<!-- Bootstrap -->
		  <meta charset="utf-8">
	</head>
	<body>
		<?php 
			include "menu.php";
			include "incluirjq.php";
		?>
	<div class="container">
		<form action="" method="POST">
			<div class="form-group">
				<h1>Cargar Expediente Nuevo</h1>
				<label>Titulo:</label>
				<input class="form-control" id="titulo" type="text" name="titulo">
				<label>Numero:</label>
				<input class="form-control" id="numero" type="text" name="numero" placeholder="nnnn-a-20XX">
				<label>Origen:</label>
				<!--<input class="form-control" id="area" type="text" name="area">-->
				<!--
				<select class="form-control" id="area" name="area" >
					<?php
						/*
						$areas = mysqli_query($conexion, "SELECT * FROM area ORDER BY nombre LIMIT 10000");
						setlocale(LC_ALL, "spanish");
						while($area=mysqli_fetch_array($areas)){
							echo "<option id='".$area['idarea']."' value='" . $area['nombre'] . "'>" . $area['nombre'] . "</option>";
						};
						*/
					?>
				</select>
				-->
				<input class= "form-control" list="areas" id="area" name="area">
				<datalist id="areas">
					<option value="Equipo de Proyecto">
					<option value="Secretaria">
					<option value="Equipo territorial del bloque">
					<option value="Equipo CCPA">
					<option value="Area de Personal">
				</datalist>
				<label>Reseña sobre el título:</label>
				<textarea class="form-control" id="resena" name="resena"></textarea>
				<label>Estado:</label>
				<select class="form-control" id="estado" name="estado">
					<option value="Ingresado">Ingresado</option>
					<option value="En tratamiento">En tratamiento</option>
					<option value="Para firma">Para firma</option>
					<option value="Resuelto">Resuelto</option>
					<option value="Archivado">Archivado</option>
				</select>
				<label>Fecha de Inicio:</label>
				<input class="form-control" id="fecha" type="date" name="fecha">
				<br>
				<input class="btn btn-default" type="submit" name="enviar" value="Cargar Expediente">

			</div>	
		</form>
	</div>
</body>

<script type="text/javascript">
	createEditableSelect(document.forms[0].area);
</script>

</html>

<?php
	if (isset($_POST['enviar'])) {

		mysqli_query($conexion, "INSERT INTO expediente(titulo, numero, area, resena, estado, fecha, usuario) VALUES(
			'".$_POST['titulo']."',
			'".$_POST['numero']."',
			'".$_POST['area']."',
			'".$_POST['resena']."',
			'".$_POST['estado']."',
			'".$_POST['fecha']."',
			'".$_SESSION['usuario']." Creo'
			)"
		);
	}
 ?>

 
<?php if (!isset($_SESSION['logged'])){
	header('Location: consejaliabeta.php');
}