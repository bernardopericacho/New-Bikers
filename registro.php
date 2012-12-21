<?php 
session_start();
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
<?php
function haciendoclick(){
	return isset($_POST[envio]) && ("Enviar" == $_POST[envio]);
}


if(haciendoclick()){
	$nombre = addslashes($_POST['nom']);
	$apellidos = addslashes($_POST['ape']);
	$dni = addslashes($_POST['dni']);
	$direccion = addslashes($_POST['dir']);
	$codigo = addslashes($_POST['cod']);

	$login = addslashes($_POST['login']);
	$contraseña = addslashes($_POST['pass']);
	$contraseña2 = addslashes($_POST['pass2']);

	$ok = false;
	$obligatorios = false;

 
	$preg = addslashes($_POST['pregunta']);
	$resp = addslashes($_POST['respuesta']);
	$email = addslashes($_POST['email']);

if ( (ereg('[A-Za-z0-9]',$nombre)) && (strlen($nombre) > 2) ) {
	if ((ereg('[A-Za-z0-9]',$apellidos)) && (strlen($apellidos) > 2)) {
		if (strlen($direccion) > 2) {
			if ( (is_numeric($codigo))  && (strlen($codigo) == 5)) {
				if ((ereg('[A-Za-z0-9]',$login)) && (strlen($login) > 3) && (strlen($login) < 13)) {
					if ((ereg('[A-Za-z0-9]',$contraseña)) && (strlen($contraseña) > 3) && (strlen($contraseña) < 11) && ($contraseña == $contraseña2)) {
						$obligatorios = true;
					}
				}
			}
		}
	}
}
if ($obligatorios == false){
	echo 'ERROR. FALTAN POR RELLENAR CAMPOS OBLIGATORIOS O TIENEN ERRORES';
}else {
	
	if  (!(empty($email))) {
		if (ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $email)) {
			$ok = true;
		}
	}else {
		$ok = true;
	}
	
}
if ($ok == true) {
$conn = mysql_connect("localhost", "prueba", "prueba")
    or die('Problema al obtener la conexion: ' . mysql_error());
mysql_select_db("prueba") 
    or die('Connectarse a la BBDD de prueba');
    
$query = "SELECT * FROM usuarios WHERE login='$login'";
$result = mysql_query($query) or die("Fallo al ejecutar consulta $query: " . mysql_error());

if (mysql_num_rows($result) > 0){
	echo 'ERROR. EL USUARIO YA EXISTE EN LA BASE DE DATOS.';
}
else{
	$sql = "INSERT INTO usuarios(login,pass,tipo,nombre,apellidos,dni,direccion,codigo_postal,email,pregunta,respuesta)
	 VALUES ('$login','$contraseña','u','$nombre','$apellidos','$dni','$direccion','$codigo','$email','$preg','$resp')";
	$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	?>
	<br></br>
	<?php
	echo "EL PROCESO DE REGISTRO SE HA REALIZADO CORRECTAMENTE, PINCHE ";?>
	
	<a href="validacion.php">AQUI</a>
	<?php echo " PARA ACCEDER A SU ZONA PERSONAL.";
}
}
if ($ok==true) {

mysql_close($conn);

}
else {

	if ($obligatorios == true) {	
		echo 'ERROR. ALGUN CAMPO CONTIENE CARACTERES ERRONEOS. POR FAVOR, REVISE LOS CAMPOS.';
	}

}
}
?>
<h1>&nbsp;Registro:&nbsp;</h1>
<p>&nbsp;A continuación se muestra un formulario que debe rellenar para completar el proceso de registro. Los datos obligatorios están marcados con un (*), el resto son opcionales.</p>
<p>&nbsp;Una vez dado de alta puede modificar sus datos desde su perfil de usuario.</p>
<table class="reg">
<tr>
	<td>
		<form name="formReg" onsubmit="return registro(this)" method="post">
		<table>
			<tr>
				<td align="right">Nombre:&nbsp;(*)</td>
				<td align="left"><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td align="right">Apellidos:&nbsp;(*)</td>
				<td align="left"><input type="text" name="ape" /></td>
			</tr>
			<tr>
				<td align="right">Dni:&nbsp;(*)</td>
				<td align="left"><input type="text" name="dni" /></td>
			</tr>
			<tr>
				<td align="right">Dirección:&nbsp;(*)</td>
				<td align="left"><input type="text" name="dir" /></td>
			</tr>
			<tr>
				<td align="right">Código Postal:&nbsp;(*)</td>
				<td align="left"><input type="text" name="cod" /></td>
			</tr>
			<tr>
				<td align="right">Email:&nbsp;</td>
				<td align="left"><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td align="right">Login:&nbsp;(*)</td>
				<td align="left"><input type="text" name="login" /></td>
			</tr>
			<tr>
				<td align="right">Contraseña:&nbsp;(*)</td>
				<td align="left"><input type="password" name="pass" /></td>
			</tr>
			<tr>
				<td align="right">Repetir contraseña:&nbsp;(*)</td>
				<td align="left"><input type="password" name="pass2" /></td>
			</tr>
			<tr>
				<td align="right">Pregunta:&nbsp;</td>
				<td align="left">
				<select name="pregunta" size="1">
				<option>¿Cuál es tu animal preferido?</option>
				<option>¿Cómo se llama tu juego preferido?</option>
				<option>¿Cúal es tu color preferido?</option>				
				<option>¿Cúal es tu deporte preferido?</option>
				<option>¿Cúal es tu ciudad preferida?</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right">Respuesta:&nbsp;</td>
				<td align="left"><input type="text" name="respuesta" /></td>	
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">&nbsp;</td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">
					<input type="submit" name="envio" value="Enviar" />
					<input type="reset" value="Limpiar" />
				</td>
			</tr>
		</table>
		</form>
	</td>
	
</tr>
</table>
</div>

<div class="pie">
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