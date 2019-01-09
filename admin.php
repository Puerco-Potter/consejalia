<?php include "conexion.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
</head>
<body>
	<?php include "menu.php"; ?>
	<div class="container">
		
		<?php
			if(isset($_SESSION['logged'])){
				header('Location:consejaliabeta.php');
			}
			else {
		?>
		
		<div class="form-group" id= "body">
			<form action="" method="POST">
			<label>Usuario</label>
			<input class="form-control" type="text" name="email" placeholder="Nombre de usuario">
			<label>Contraseña</label>
			<input class="form-control" type="password" name="password" placeholder="Contraseña">
			<label></label>
			<input class="btn btn-primary btn-block" type="submit" name="enviar" value="Acceder">
			<form/>
		</div>
		
		<?php
			}
			if(isset($_POST['enviar'])){
				$usuario = utf8_decode(mysqli_real_escape_string($conexion, $_POST['email']));
				$password = utf8_decode(mysqli_real_escape_string($conexion, $_POST['password']));
				if($usuario == '' or $password == '') {
					echo "Los campos tienen que ser completados en su totalidad";
				}
				else {
					$comprobar = mysqli_query($conexion, "SELECT * FROM login WHERE usuario ='".$usuario."' AND pass = '".$password."' LIMIT 1") or die(mysqli_error($conexion));
					if (mysqli_num_rows($comprobar) == 1){
						$row = mysqli_fetch_assoc($comprobar);
						$_SESSION['id'] = $row['id'];
						$_SESSION['usuario'] = $row['usuario'];
						$_SESSION['logged'] = TRUE;
						header('Location: consejaliabeta.php');
					}
					else {
						echo "El email o password no son correctos";
					}
				}
			}
		?>
	</div>	
</body>
</html>