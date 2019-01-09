<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Gestion de Actuaciones</title>
		<!-- Bootstrap -->
		<meta charset="utf-8">
	</head>
	<body>
		<?php include "menu.php"; include "incluirjq.php"; ?>

		<?php 
			$filas= mysqli_query($conexion, "SELECT * FROM actuacion");
			setlocale(LC_ALL, "spanish");	
		?>

	<div class="container">	
		<h1>Actuaciones</h1>		
		<div class="form-inline">
			<p id="demo"></p>
			<input class="form-control" type="text" id="titulo" onkeyup="obra()" placeholder="Buscar...">
			<label>Pase</label>
			<input id="pase" onchange="mostrar()" type="checkbox" name="" checked="checked">
			<label>Instrumento</label>
			<input id="instrumento" onchange="mostrar()" type="checkbox" name="" checked="checked">
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
			<th>Titulo Expediente</th>	        
			<th>Numero Expediente</th>
			<th>Numero Actuación</th>
			<th>Fin/Destino/Enviado a</th>
	        <th>Tipo de actuacion</th>
	        <th>Fecha</th>
	        <th>Reseña</th>
	        <th>Opciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php 
	        	$i=0;
	        	while ($fila=mysqli_fetch_array($filas)) {

		        	if($filaexpe= mysqli_query($conexion, "SELECT * FROM expediente WHERE idexpediente=".$fila[1]."")){
		        		$arrexpe= mysqli_fetch_array($filaexpe);
		        	}else {
		        		$arrexpe= array("","No tiene","No tiene");
		        	}

		        	echo "<tr>";
		        	echo "<td>".$arrexpe[1] ."</td>";	        	
		        	echo "<td>".$arrexpe[2] ."</td>";
		        	echo "<td>".$fila[2] ."</td>";
		        	echo "<td>".$fila[3] ."</td>";
		        	echo "<td>".$fila[6] ."</td>";
		        	echo "<td>".$fila[4] ."</td>";
		        	echo "<td>".$fila[5] ."</td>";

		        	echo "<td><a href=veractuacion.php?idactuacion=".$fila[0]."&idexpediente=".$fila[1].">Ver</a>";
		        	echo "&nbsp;&nbsp;&nbsp";
		        	 if(isset($_SESSION['logged'])){
		        	echo "<a href=editaractuacion.php?idactuacion=".$fila[0]."&idexpediente=".$fila[1].">Editar</a>";
		        	echo "&nbsp;&nbsp;&nbsp";
		        	echo "<a href=borraractuacion.php?idactuacion=".$fila[0]."&idexpediente=".$fila[1].">Borrar</a>";
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
				if (document.getElementById('pase').checked && (td.toUpperCase() == "PASE")) {
			      tr[i].removeAttribute("hidden");
				} 
				if (document.getElementById('instrumento').checked && (td.toUpperCase() == "INSTRUMENTO")) {
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

			    if (td0) {
					if (
						(td0.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td1.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td2.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td3.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td4.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td5.innerHTML.toUpperCase().indexOf(filter) > -1) || 
				      	(td6.innerHTML.toUpperCase().indexOf(filter) > -1)
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