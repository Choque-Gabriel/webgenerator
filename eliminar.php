<?php 
	session_start();
	$usuario = $_SESSION['id'];
	$estado = true;
	if (!isset($usuario)) {
		$estado = false;
		header("Location: login.php");
	}
?>

<?php
	$dominio = $_GET['dominio'];
	$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "”webgenerator");
	$Sql = mysqli_query($Connection, "DELETE FROM `webs` WHERE dominio = '$dominio'");
	header("Location: panel.php");
?>