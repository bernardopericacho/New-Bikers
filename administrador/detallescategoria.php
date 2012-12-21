<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

function haciendoclick(){
	return isset($_POST[envio]) && ("Enviar" == $_POST[envio]);
}


if(haciendoclick()){
	$nombre = addslashes($_POST['nom']);
	$foto = addslashes($_POST['fot']);
	$clase = addslashes($_POST['clase']);
	$categoria = $_GET[id];
	
	if  ((!(empty($nombre))) && (strlen($nombre) > 2) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE categorias SET nombre='$nombre' where id_categoria='$categoria'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	
	if  ((!(empty($foto))) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE categorias SET foto='$foto' where id_categoria='$categoria'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}

	
}
$categoria = $_GET[id];
$sql = "SELECT * FROM categorias WHERE id_categoria='$categoria'";
$result = mysql_query($sql);
$reg = mysql_fetch_array($result, MYSQL_ASSOC);
$consulta = "SELECT nombre_ub from ubicacion where id_ubicacion='$reg[ubicacion]'";
$resultado = mysql_query($consulta);
$registro = mysql_fetch_array($resultado, MYSQL_ASSOC);
?>
<div class="contenido">
	<p><strong>Id categoria:&nbsp;</strong><?php echo $reg[id_categoria];?></p>
	<p><strong>Nombre:&nbsp;</strong><?php echo $reg[nombre];?></p>
	<p><strong>Número de productos:&nbsp;</strong><?php echo $reg[num_prod];?></p>
	<p><strong>Ubicación:&nbsp;</strong><?php echo $registro[nombre_ub];?></p>
	<img src="<?php echo $reg[foto];?>" alt="fotografia <?php echo $reg[nombre];?>" />
	
	<br></br>
	<p>&nbsp;A continuación se muestra un formulario en el que puede introducir los nuevos datos. Si deja algún campo en blanco, no se modificará el valor anterior.</p>
	<br></br>
	<form name="formReg" method="post">
		<table>
			<tr>
				<td align="right">Nombre de la categoría:</td>
				<td align="left"><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td align="right">Fotografia de la categoría:</td>
				<td align="left"><input type="text" name="fot" /></td>
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
		<br></br>

</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>