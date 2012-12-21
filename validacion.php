<?php 
	session_start();
	$conn=mysql_connect("localhost","prueba","prueba") or die ("Error conectando a la base de datos.");
	mysql_select_db("prueba") or die (mysql_error());
	
function verificarLogin($usuario, $pass){
	$query = "SELECT * FROM usuarios WHERE login='$usuario' AND pass='$pass'";
	
	$loginOK = false;
	$result = mysql_query($query) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	if(mysql_num_rows($result) > 0){
		// El usuario y la contraseña existen
		$fila = mysql_fetch_array($result, MYSQL_ASSOC);
		$_SESSION['usuario'] = $fila['login'];
		$_SESSION['tipo'] = $fila['tipo'];
		$loginOK = true;
	}
	return $loginOK;
}


function haciendoLogin(){
	return isset($_POST[envio]) && ("Entrar" == $_POST[envio]);
}


if(haciendoLogin()){
	if(!verificarLogin($_POST[id], $_POST[pwd])){
		header("Location: validacion.php");
	}
}


if (isset($_SESSION['usuario'])){
	switch ($_SESSION['tipo']){
		case 'a' : header("Location: administrador.php");
		           break;
		default : header("Location: usuario.php");
		          break;
	}
}

?>
<? '<?xml version="1.0" encoding="ISO-8859-1" ?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>

<script language="JavaScript" type="text/javascript" src="javascript/script.js"></script>
<script language="JavaScript" type="text/javascript" src="javascript/cookies.js"></script> 
<link rel="stylesheet" href="CSS/CSS.css" type="text/css" />
<link rel="stylesheet" href="CSS/color.css" type="text/css" />
<title>NEW BIKERS</title>

</head>


<body onload="cargardatos()">
<div class="completo">


<div class="cabecera">


	<div class="logo">
	<img src="images/vm_pequeno.gif" alt="rotulo empresa"/>
	</div>

	<div class="titulo">
	<img src="images/logo.gif" alt="logo empresa"/>
	</div>
</div>




<div class="central">
<form name="formAdmin" onsubmit="return validar(this)" method="post" action="validacion.php">
<table class="login">

			<tr>
				<td align="right">Login:&nbsp;</td>
				<td align="left"><input type="text" name="id" /></td>
			</tr>
			<tr>
				<td align="right">Contraseña:&nbsp;</td>
				<td align="left"><input type="password" name="pwd" /></td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">&nbsp;</td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">
					<input type="submit" name="envio" value="Entrar" />
					<input type="reset" value="Limpiar" />
				</td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">&nbsp;</td>
			</tr>
</table>
</form>
</div>



<div class="pieinicio">
		<table class="piepag">
			<tr>
				<td align="center">

					<a href="mailto:bernardo.sanperi@telefonica.net"><h1>Contacto</h1></a>

				</td>
				
				<td align="center">

					<a href="registro.php"><h1>¡Registrate ahora!</h1></a>

				</td>

				
				<td align="center">

					<h1>Última actualización 13:43</h1>

				</td>

				<td align="center">

					<img src="images/vcss.gif" alt="validacion css"/>

				</td>


				<td align="center">

					<img src="images/validhtml.gif" alt="validacion html"/>

				</td>
				
			</tr>			
		</table>
</div>

</div>
</body>


</html>
<?php 
		mysql_close($conn);
?>