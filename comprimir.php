<?php 
	$dominio = $_GET['dominio'];
	$carpetazip = $dominio.".zip";
	shell_exec('zip -r '.$carpetazip.' '.$dominio);
	header("Location: $carpetazip");
?>