<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Informe</title>
	<meta charset="utf-8">
</head>
<body>
<?php include "menu.php"; include "incluirjq.php"; ?>

<div class="container">
	<h1>Informes</h1>
	<h4>Del Día:</h4>
	<a href="informe.php?tipo=semanal" class="btn btn-primary">Crear Informe de Transacciones de la ultima semana</a>
	<h4>Semanal:</h4>
	<a href="informe.php?tipo=mensual" class="btn btn-primary">Crear Informe de Transacciones de los ultimos 30 días</a>
	<h4>Mensual:</h4>
	<a href="informe.php?tipo=anual" class="btn btn-primary">Crear Informe de Transacciones del ultimo año</a>

</div>

</body>
</html>