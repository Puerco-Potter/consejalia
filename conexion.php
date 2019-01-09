<?php
	$servidor = "localhost";
	$usuario = "root";
	$contrasena = "concejalia123";
	$bd = "consejalia";
	$conexion = mysqli_connect($servidor, $usuario, $contrasena, $bd)or die(mysqli_error($conexion));

	mysqli_select_db($conexion, $bd)or die(mysqli_error($conexion));
	$conexion->set_charset("utf8");

	function conectar(){
		$conn = @mysql_connect("localhost", "root", "");
		mysql_select_db("ipapprod", $conn);		
	}

	function conectarpon(){
		$conn = @mysql_connect("10.2.2.46", "root", "pipa2015");
		mysql_select_db("pon", $conn);		
	}

	function desconectar(){
		mysql_close();
	}
?> 
