<?php 
	include "conexion.php";	

	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Editar Expediente</title>
		<!-- Bootstrap -->
		  <meta charset="utf-8">
	</head>
	<body>
		<?php 
			include "menu.php" ;
			include "incluirjq.php";	
		?>
		<?php 
			$expedientes=mysqli_query($conexion, "SELECT * FROM expediente WHERE idexpediente=".$_GET['idexpediente']." LIMIT 1");
			$expediente=mysqli_fetch_array($expedientes);
			setlocale(LC_ALL, "spanish");
			$exp= $expediente;
		?>

		<div class="container">
			<form action="" method="POST">
				<div class="form-group">
					<h1>Editar Expediente</h1>

					<label for="titulo">Titulo:</label>
					<input class="form-control" id="titulo" type="text" name="titulo" value="<?php echo $exp['titulo']; ?>">
					<label for="numero">Numero:</label>
					<input class="form-control" id="numero" type="text" name="numero" value="<?php echo $exp['numero']; ?>" placeholder="nnnn/aaaa">
					<label for="area">Origen:</label>
					<!--<input class="form-control" id="area" type="text" name="area" value="<?php echo $exp['area']; ?>" > -->
					<input class= "form-control"  id="area" type="text" name="area" value="<?php echo $exp['area']; ?>" list="areas" >
					<datalist id="areas">
						<option value="Equipo de Proyecto">
						<option value="Secretaria">
						<option value="Equipo territorial del bloque">
						<option value="Equipo CCPA">
						<option value="Area de Personal">
					</datalist>
					<label for="resena">Reseña sobre el título:</label>
					<textarea class="form-control" id="resena" name="resena"><?php echo $exp['resena']; ?></textarea>					
					<label for="estado">Estado:</label>
					<select class="form-control" id="estado" name="estado">
						<option value="Ingresado" <?php if ($exp['estado']=="Ingresado"){ echo "selected='selected'"; }; ?>>Ingresado</option>
						<option value="En tratamiento" <?php if ($exp['estado']=="En tratamiento"){ echo "selected='selected'"; }; ?>>En tratamiento</option>
						<option value="Para firma" <?php if ($exp['estado']=="Para firma"){ echo "selected='selected'"; }; ?>>Para firma</option>
						<option value="Resuelto" <?php if ($exp['estado']=="Resuelto"){ echo "selected='selected'"; }; ?>>Resuelto</option>
						<option value="Archivado" <?php if ($exp['estado']=="Archivado"){ echo "selected='selected'"; }; ?>>Archivado</option>
					</select>
					<label>Fecha de Inicio:</label>
					<input class="form-control" id="fecha" type="date" name="fecha" value="<?php echo $exp['fecha']; ?>">
					<br>
					<input class="btn btn-default" type="submit" name="enviar" value="Guardar Cambios">
				</div>	
			</form>
		</div>
	</body>
</html>

<?php 
	if (isset($_POST['enviar'])) {
		
		mysqli_query($conexion, "UPDATE expediente 
			SET 
			titulo='".$_POST['titulo']."',
			numero='".$_POST['numero']."',
			area='".$_POST['area']."',
			resena='".$_POST['resena']."',
			estado='".$_POST['estado']."',
			fecha='".$_POST['fecha']."',
			usuario='".$_SESSION['usuario']." Edito'
			WHERE idexpediente=".$_GET['idexpediente'].""
		);
		
		header("Location: consejaliabeta.php");
		
	} ?>

	
<?php if (!isset($_SESSION['logged'])){
	header('Location: consejaliabeta.php');
}