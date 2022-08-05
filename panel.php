<?php
	session_start();
	$estado = true;
	if (!isset($_SESSION['id'])) {
		$estado = false;
		header("Location: login.php");
	} else {
		$usuario = $_SESSION['id'];
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
	}
?>

<?php 

	if (isset($_POST["Button-Generate"])){
		$web = $usuario.$_POST['folderName'];

		$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "”webgenerator");
		$Sql = mysqli_query($Connection, "SELECT * FROM webs WHERE dominio = '$web' ");

		$data = mysqli_fetch_row($Sql);
		if ($data[0] > 0) {
			shell_exec('./wix.sh '.$web);
		} else {
			$fechaCreacion = shell_exec('date +%y\ %m\ %d');
			$fechaCreacion = strtr($fechaCreacion," ", "-");
			$consulta = "INSERT INTO webs(`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES (NULL,'$usuario','$web','$fechaCreacion')";
			$Sql = mysqli_query($Connection, $consulta);
			shell_exec('./wix.sh '.$web);
			header("Location: panel.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WEBGENERATOR</title>
</head>
<body align="center">
	<h1>Bienvenido a tu panel</h1>
	<a href="logout.php">Cerrar sesion de <?php echo $usuario ?></a>
	<form action="#" method="post">
		<br>
		Generar web de:
		<input type="text" name="folderName" placeholder="Nombre de la carpeta"><br><br>
		<input type="submit" name="Button-Generate" value="Crear web">
	</form>
	<br><br>
		<?php 
			$Connection = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "”webgenerator");
			if ($email == "admin@server.com" && $password == "serveradmin"){
				$Sql = mysqli_query($Connection, "SELECT * FROM webs");
			} else {
				$Sql = mysqli_query($Connection, "SELECT * FROM webs WHERE idUsuario = '$usuario' ");
			}
			while($data = mysqli_fetch_assoc($Sql)) {
				echo "<a href='http://mattprofe.com.ar:81/alumno/3765/3765/ACTIVIDADES/CLASE_11/webgenerator/".$data['dominio']."/'>".$data['dominio']."</a> 
				→ <a href='comprimir.php?dominio=".$data['dominio']."'>Descargar web</a>
				→ <a href='eliminar.php?dominio=".$data['dominio']."'>Eliminar</a> <br>";
			}
		?>
</body>
</html>