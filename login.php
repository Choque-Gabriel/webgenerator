<?php
	session_start();
	$estado = false;
	if (isset($_SESSION['id'])) {
		$estado = true;
		header("Location: panel.php");
	}
?>

<?php 
	$mensaje = "";
	if (isset($_POST["Button-Login"])) {
		if ($_POST["Email"]=="" && $_POST["Password"]==""){
			$mensaje = "DEBE INGRESAR EL EMAIL / CONTRASEÑA";
		} else if ($_POST["Email"]=="" && $_POST["Password"]!=""){
			$mensaje = "DEBE INGRESAR EL EMAIL";
		} else if ($_POST["Password"]=="" && $_POST["Email"]!=""){
			$mensaje = "DEBE INGRESAR LA CONTRASEÑA";
		} else if ($_POST["Email"] != ""  && $_POST["Password"] != ""){
			$mensaje = "DATOS INCORRECTOS";
		}
	}
?>

<?php
	
	if (isset($_POST["Button-Login"])) {
		$Email = "";
		$Password = "";
		$Email = $_POST["Email"];
		$Password = $_POST["Password"];

		$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "”webgenerator");
		$Sql = mysqli_query($Connection, "SELECT idUsuario, email, password FROM usuarios WHERE email='$Email' AND password='$Password'");

		$idUsuario = mysqli_fetch_row($Sql);
		if ($idUsuario[0] > 0) {
			session_start();
			$_SESSION['id'] = $idUsuario[0];
			$_SESSION['email'] = $idUsuario[1];
			$_SESSION['password'] = $idUsuario[2];
			header("Location: panel.php");
		}
	}
?>

<html lang="en"><head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>WEBGENERATOR</title>
 </head>
 <body align="center">
 	<h1>webgenerator Gabriel Choque</h1>
 	<form action="#" method="post">
 		<input type="text" name="Email" placeholder="Email">
 		<br><br>
 		<input type="password" name="Password" placeholder="Contraseña">
 		<br><br>
 		<a href="register.php">No tienes cuenta?</a>
 		<br><br>
 		<input type="submit" name="Button-Login" value="Ingresar">
 	</form>
 	<div>
 		<?php echo $mensaje; ?>
 	</div>
  </body></html>