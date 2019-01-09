<?php 
	include "conexion.php" ;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php 
			include "menu.php" ; 
			include "incluirjq.php";
			
			$expedientes=mysqli_query($conexion, "SELECT * FROM expediente WHERE idexpediente=".$_GET['idexpediente']." LIMIT 1");
				$expediente=mysqli_fetch_array($expedientes);
				setlocale(LC_ALL, "spanish");

				if (isset($_POST['enviar'])) {
				
				mysqli_query($conexion, "DELETE FROM expediente WHERE idexpediente=".$_GET['idexpediente'] ."");
				header("Location:consejaliabeta.php");
			}
		?>
		<title>Borrar Expediente</title>
		<!-- Bootstrap -->
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container">
			<h2>¿Esta seguro que desea borrar este expediente?</h2>
			<?php
				echo "<h3>Numero de Expediente: ". $expediente[2] . "</h3>";
				echo "<h3>Titulo: ". $expediente[1] . "</h3>";
			?>
			<form action="" method="POST">
				<input class="btn btn-default" type="submit" name="enviar" value="Borrar Expediente">
			</form>
		</div>
	</body>
</html>


<?php if (!isset($_SESSION['logged'])){
	header('Location: consejaliabeta.php');
}