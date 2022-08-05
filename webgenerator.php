<?php
	session_start();
	$estado = false;
	if (isset($_SESSION['id'])) {
		$estado = true;
		header("Location: panel.php");
	}
?>
<?php
	include "login.php";
?>