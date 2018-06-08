<?php
	session_start();
	ob_start();
	if( !isset($_SESSION['usuario']) ){
	  header('Location: ingresar');exit();
	}
	$titulo = "Inicio";
	include ('include/header.php');
	$nombre = $_SESSION['nombres'];
	$ape_pat = $_SESSION['ape_pat'];
	$ape_mat = $_SESSION['ape_mat'];
	/*
	if($_SESSION['tipo'] == 1){
		$us = "Administrador";
	}elseif ($_SESSION['tipo'] == 2) {
		$us = "Usuario";
	}
	*/
?>
<div class="container">
	<div class="row center">
		<div class="col s12">
			<br><br>
			<!--<audio src="msc/Ambientacion.mp3" preload="auto" autoplay loop></audio>-->
			<!--<img class="circle responsive-img"  alt="" src="img/fashion.png">-->
			<h1>Bienvenido(a)<?php echo " ",$_SESSION['tipo']; ?></h1>
	    	<h3><?php echo $nombre," ",$ape_pat, " ",$ape_mat; ?></h3>	
		</div>	
	</div>

</div>
<?php include('include/footer.php') ?>
