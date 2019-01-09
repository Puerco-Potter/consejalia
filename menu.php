<?php session_start(); ?>
<img src="img/banner.png" width="100%"> 
<!--<a href="index.php"><h1 id="site-title">IPAP - Certificados</h1></a>-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="edicion.css">

<!-- #header -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Concejalía de Resistencia</a>
    </div>
    <ul class="nav navbar-nav">
    	<li><a href="consejaliabeta.php">Gestion de Expedientes</a></li>
      	<li><a href="gestionactuaciones.php">Gestion de Actuaciones</a></li>
      	<?php
         if(isset($_SESSION['logged'])){
        ?>
        <li><a href="carganuevo.php">Nuevo Expediente</a></li>  
        <li><a href="cargaractuacion.php">Nueva Actuacion</a></li>
        <?php }; ?>
      	<li><a href="generarpdf.php">Generar Informes</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><?php 
      if(isset($_SESSION['logged'])){
          echo "<a>".$_SESSION['usuario']."";
        }else{
          
          echo "<a href='admin.php'>Ingresar";
        }
        ?>
        <span class="glyphicon glyphicon-user"></span> 
      </a>
		</li>
      <li><a href="salir.php" >Salir</a>
    </ul>
  </div>
</nav> 


