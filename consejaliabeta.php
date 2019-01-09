<?php include "conexion.php" ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Gestion de Expedientes</title>
		<!-- Bootstrap -->
		<meta charset="utf-8">
	</head>
	<body>
		<?php include "menu.php"; include "incluirjq.php"; ?>

		<?php 
			$filas= mysqli_query($conexion, "SELECT * FROM expediente");
			setlocale(LC_ALL, "spanish");	
		?>

	<div class="container">	
		<h1>Expedientes</h1>
		
		<div class="form-inline">
			<p id="demo"></p>
			<input class="form-control" type="text" id="titulo" onkeyup="obra()" placeholder="Buscar...">
			<label>Ingresado</label>
			<input id="ingresado" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<label>En tratamiento</label>
			<input id="entratamiento" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<label>Para firma</label>
			<input id="parafirma" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<label>Resuelto</label>
			<input id="resuelto" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<label>Archivado</label>
			<input id="archivado" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<?php
				 if(isset($_SESSION['logged'])){
			  ?>			
			<a class="btn btn-primary float-right" href="carganuevo.php">Cargar Nuevo Expediente</a>
			<a class="btn btn-primary float-right" href="cargaractuacion.php">Cargar Nueva Actuacion</a>
			<?php }; ?>
		</div>
		<p></p>
		<textarea hidden style="width:100%" id="exito"></textarea>

	 <div class="table-responsive">          
	  <table class="table table-inverse" id="mytable">
	    <thead>
	      <tr class="azul">
	        <th>Titulo</th>
	        <th>Numero</th>
	        <th>Origen</th>
	        <th>Reseña sobre el título</th>
	        <th>Estado</th>
	        <th>Fecha de Inicio</th>
	        <th>Cantidad de actuaciones</th>
	        <th>Opciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php 
	        	$i=0;
	        	while ($fila=mysqli_fetch_array($filas)) {	    

		        	$auxquery= mysqli_query($conexion, "SELECT count(*) FROM actuacion WHERE idexpediente=".$fila[0]."");
		        	$auxarr= mysqli_fetch_array($auxquery);

		        	echo "<tr>";
		        	echo "<td>".$fila[1] ."</td>";
		        	echo "<td>".$fila[2] ."</td>";
		        	echo "<td>".$fila[3] ."</td>";
		        	echo "<td>".$fila[4] ."</td>";
		        	echo "<td>".$fila[5] ."</td>";
		        	echo "<td>".$fila[6] ."</td>";
		        	echo "<td>".$auxarr[0] ."</td>";
		        	echo "<td><a href=verexpediente.php?idexpediente=".$fila[0].">Ver</a>";
		        	echo "&nbsp;&nbsp;&nbsp";
		        	 if(isset($_SESSION['logged'])){
		        	echo "<a href=editarcontacto.php?idexpediente=".$fila[0].">Editar</a>";


		        	echo "&nbsp;&nbsp;&nbsp";
		        	echo "<a href=borrarcontacto.php?idexpediente=".$fila[0].">Borrar</a>";
		        	};
		        	echo "</td></tr>";
	        	}
	        ?>  
	    </tbody>
	  </table>
	  </div>
	</div>
	</body>

	<script>
		
		function mostrar(){

			table = document.getElementById("mytable");
		 	tr = table.getElementsByTagName("tr");
		 	
			for (i = 1; i < tr.length; i++) {
		 		tr[i].setAttribute("hidden", true);
		 	}

		 	for (i = 1; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4].innerHTML;
				if (document.getElementById('ingresado').checked && (td.toUpperCase() == "INGRESADO")) {
			      tr[i].removeAttribute("hidden");
				} 
				if (document.getElementById('entratamiento').checked && (td.toUpperCase() == "EN TRATAMIENTO")) {
					tr[i].removeAttribute("hidden");
				} 
				if (document.getElementById('parafirma').checked && (td.toUpperCase() == "PARA FIRMA")) {
				    tr[i].removeAttribute("hidden");
				} 
				if (document.getElementById('resuelto').checked && (td.toUpperCase() == "RESUELTO")) {
				    tr[i].removeAttribute("hidden");
				} 
				if (document.getElementById('archivado').checked && (td.toUpperCase() == "ARCHIVADO")) {
				    tr[i].removeAttribute("hidden");
				} 
			}				  
		}

		function obra() {
			// Declare variables
			var input, filter, table, tr, td, i;
			input = document.getElementById("titulo");
			filter = input.value.toUpperCase();
			table = document.getElementById("mytable");
			tr = table.getElementsByTagName("tr");
			
			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
			    td0 = tr[i].getElementsByTagName("td")[0];
			    td1 = tr[i].getElementsByTagName("td")[1];
			    td2 = tr[i].getElementsByTagName("td")[2];
			    td3 = tr[i].getElementsByTagName("td")[3];
			    td4 = tr[i].getElementsByTagName("td")[4];
			    td5 = tr[i].getElementsByTagName("td")[5];
			    td6 = tr[i].getElementsByTagName("td")[6];
			    td7 = tr[i].getElementsByTagName("td")[7];

			    if (td0) {
					if (
						(td0.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td2.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td3.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td4.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td5.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td6.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td7.innerHTML.toUpperCase().indexOf(filter) > -1)
						) {
						tr[i].style.display = ""; 
					} 
					else { 
						tr[i].style.display = "none";
					}
				}
			}
		}
	
	</script>
</html>