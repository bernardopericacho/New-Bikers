<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");


function haciendoclick(){
	return isset($_POST[envio]) && ("Enviar" == $_POST[envio]);
}


if(haciendoclick()){
	$nombre = addslashes($_POST['nom']);
	$apellidos = addslashes($_POST['ape']);
	$dni = addslashes($_POST['dni']);
	$direccion = addslashes($_POST['dir']);
	$codigo = addslashes($_POST['cod']);
	$contraseña = addslashes($_POST['pass']);
	$contraseña2 = addslashes($_POST['pass2']);
	$preg = addslashes($_POST['pregunta']);
	$resp = addslashes($_POST['respuesta']);
	$email = addslashes($_POST['email']);
	
	if  ((!(empty($nombre))) && (ereg('[A-Za-z0-9]',$nombre)) && (strlen($nombre) > 2)){
		$sql = "UPDATE usuarios SET nombre='$nombre' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	
	if  ((!(empty($apellidos))) && (ereg('[A-Za-z0-9]',$apellidos)) && (strlen($apellidos) > 2)){
		$sql = "UPDATE usuarios SET apellidos='$apellidos' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  (!(empty($dni))){
		$sql = "UPDATE usuarios SET dni='$dni' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  ((!(empty($direccion))) && (strlen($direccion) > 2)){
		$sql = "UPDATE usuarios SET direccion='$direccion' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  ((!(empty($codigo)))&& (is_numeric($codigo))  && (strlen($codigo) == 5)){
		$sql = "UPDATE usuarios SET codigo_postal='$codigo' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  ((!(empty($contraseña))) &&  (!(empty($contraseña2))) && (strlen($contraseña) > 3) && (strlen($contraseña) < 11) && (ereg('[A-Za-z0-9]',$contraseña)) &&  ($contraseña == $contraseña2)){
		$sql = "UPDATE usuarios SET pass='$contraseña' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  (!(empty($resp))){
		$sql = "UPDATE usuarios SET pregunta='$preg', respuesta='$resp' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  (!(empty($email))){
		$sql = "UPDATE usuarios SET email='$email' where login='$_SESSION[usuario]'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}

}
$sql = "SELECT * FROM usuarios WHERE login='$_SESSION[usuario]'";
$result = mysql_query($sql);
$reg = mysql_fetch_array($result, MYSQL_ASSOC);
?>
<div class="contenido">
	<table >
		<tr>
			<td>Nombre:</td>
			<td><?php echo $reg[nombre];?></td>
		</tr>
		<tr>
			<td>Apellidos:</td>
			<td><?php echo $reg[apellidos];?></td>
		</tr>
		<tr>
			<td>DNI:</td>
			<td><?php echo $reg[dni];?></td>
		</tr>
		<tr>
			<td>Direccion:</td>
			<td><?php echo $reg[direccion];?></td>
		</tr>
		<tr>
			<td>Codigo Postal:</td>
			<td><?php echo $reg[codigo_postal];?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><?php echo $reg[email];?></td>
		</tr>
		<tr>
			<td>Pregunta:</td>
			<td><?php echo $reg[pregunta];?></td>
		</tr>
		<tr>
			<td>Respuesta:</td>
			<td><?php echo $reg[respuesta];?></td>
		</tr>
		<tr>
			<td>Contraseña:</td>
			<td><?php echo $reg[pass];?></td>
		</tr>
	</table>
	<p>&nbsp;A continuación se muestra un formulario en el que puede introducir los nuevos datos. Si deja algún campo en blanco, no se modificará el valor anterior.</p>
	
	<form name="formReg" method="post">
		<table>
			<tr>
				<td align="right">Nombre:</td>
				<td align="left"><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td align="right">Apellidos:</td>
				<td align="left"><input type="text" name="ape" /></td>
			</tr>
			<tr>
				<td align="right">Dni:</td>
				<td align="left"><input type="text" name="dni" /></td>
			</tr>
			<tr>
				<td align="right">Dirección:</td>
				<td align="left"><input type="text" name="dir" /></td>
			</tr>
			<tr>
				<td align="right">Código Postal:</td>
				<td align="left"><input type="text" name="cod" /></td>
			</tr>
			<tr>
				<td align="right">Email:</td>
				<td align="left"><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td align="right">Contraseña:</td>
				<td align="left"><input type="password" name="pass" /></td>
			</tr>
			<tr>
				<td align="right">Repetir contraseña:</td>
				<td align="left"><input type="password" name="pass2" /></td>
			</tr>
			<tr>
				<td align="right">Pregunta:</td>
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
				<td align="right">Respuesta:</td>
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



</div> 

<?

	mysql_free_result($result); 
	mysql_close($conexion);
?>