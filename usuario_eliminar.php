<?php
session_start();
ob_start();
if(!isset($_SESSION['usuario'])){
  header('Location: ingresar');
  exit();
}

include('config/conexion.php');
include('include/header.php');
if(empty($_GET['id'])){
  header('Location: ver_usuarios');
  exit();
} 

if(isset($_SESSION['usuario'])) { 
	if($_SESSION['tipo'] === "Administrador") {
		
		$query = "DELETE FROM `usuarios` WHERE `id_usuario` = ".$_GET['id'];
		$resultado = mysqli_query($enlace,$query);
		if($resultado){
		  $_SESSION['flash'] = "UsE";
		}
		header('Location: ver_usuarios');
	}
}
?>