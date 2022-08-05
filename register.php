<?php 
	session_start();
	$estado = false;
	if (isset($_SESSION['id'])) {
		$estado = true;
		header("Location: panel.php");
	} else {
		if (isset($_SESSION['id'])) {
			$usuario = $_SESSION['id'];
		}
		if (isset($_SESSION['email'])) {
			$email = $_SESSION['email'];
		}
		if (isset($_SESSION['password'])) {
			$password = $_SESSION['password'];
		}
	}
?>


<?php

	$mensaje = "";
	if (isset($_POST["Button-Register"])) {
		if ($_POST["Email"]=="" && $_POST["Password"]==""){
			$mensaje = "DEBE INGRESAR EL EMAIL / CONTRASEÑA";
		}else if ($_POST["Email"]=="" && $_POST["Password"]!=""){
			$mensaje = "DEBE INGRESAR EL EMAIL";
		}else if ($_POST["Password"]=="" && $_POST["Email"]!=""){
			$mensaje = "DEBE INGRESAR LA CONTRASEÑA";
		}else if ($_POST["Email"] != ""  && $_POST["Password"] != ""){
			if ($_POST["Password"] == $_POST["ConfirmPassword"]) {
				$email = $_POST['Email'];
				$Password = $_POST['Password'];
				$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "”webgenerator");
				$Sql = mysqli_query($Connection, "SELECT * FROM usuarios WHERE email = '$email' ");
				$data = mysqli_fetch_row($Sql);
				if ($data[0] > 0) {
					$mensaje = "ESTE CORREO ELECTRONICO YA ESTA VINCULADA A UNA CUENTA";
				} else {
					$fechaRegistro = shell_exec('date +%y\ %m\ %d');
					$fechaRegistro = strtr($fechaCreacion," ", "-");
					$consulta = "INSERT INTO usuarios(`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL,'$email','$Password','$fechaCreacion')";
					$Sql = mysqli_query($Connection, $consulta);
					header("Location: login.php");
				}
			}else{
				$mensaje = "LAS CONTRASEÑAS NO COINCIDEN";
			}
		}
	}
?>

<html lang="en"><head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>webgenerator</title>
 </head>
 <body align="center">
 	<h1>Registrarte es simple.</h1>
 	<form action="#" method="post">
 		<input type="text" name="Email" placeholder="Email">
 		<br><br>
 		<input type="password" name="Password" placeholder="Contraseña">
 		<br><br>
 		<input type="password" name="ConfirmPassword" placeholder="Confirmar Contraseña">
 		<br><br>
 		<input type="submit" name="Button-Register" value="Registrar">
 	</form>
 	<div> <?php echo $mensaje; ?></div>
  </body>
  </html>