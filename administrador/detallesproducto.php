<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

function haciendoclick(){
	return isset($_POST[envio]) && ("Enviar" == $_POST[envio]);
}


if(haciendoclick()){
	$nombre = addslashes($_POST['nom']);
	$peque = addslashes($_POST['des']);
	$amplia = addslashes($_POST['desamp']);
	$precio = addslashes($_POST['precio']);
	$foto = addslashes($_POST['fot']);

	$producto = $_GET["id"];
	
	if  ((!(empty($nombre))) && (strlen($nombre) > 2) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE productos SET nombre='$nombre' where id_producto='$producto'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	
	if  ((!(empty($peque))) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE productos SET p_descripcion='$peque' where id_producto='$producto'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  ((!(empty($precio))) && (is_numeric($precio)) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE productos SET precio='$precio' where id_producto='$producto'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	
	if  ((!(empty($foto))) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE productos SET foto='$foto' where id_producto='$producto'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}
	if  ((!(empty($amplia))) && (!empty($_SESSION[usuario]))){
		$sql = "UPDATE productos SET amplia_descripcion='$amplia' where id_producto='$producto'";
		$resultado = mysql_query($sql) or die("Fallo al ejecutar consulta $query: " . mysql_error());
	}

	
}


$producto = $_GET["id"];
$sql = "SELECT * FROM productos WHERE id_producto='$producto'";
$result = mysql_query($sql);
$reg = mysql_fetch_array($result, MYSQL_ASSOC);
$consulta = "SELECT nombre from categorias where id_categoria='$reg[categoria]'";
$resultado = mysql_query($consulta);
$registro = mysql_fetch_array($resultado, MYSQL_ASSOC);
?>
<div class="contenido">
	<p><strong>Id producto:&nbsp;</strong><?php echo $reg[id_producto];?></p>
	<p><strong>Nombre:&nbsp;</strong><?php echo $reg[nombre];?></p>
	<p><strong>Pequeña descripción:&nbsp;</strong><?php echo $reg[p_descripcion];?></p>
	<p><strong>Amplia descripcion:&nbsp;</strong><?php echo $reg[amplia_descripcion];?></p>
	<p><strong>Precio:&nbsp;</strong><?php echo $reg[precio];?>&nbsp;€</p>
	<p><strong>Categoria:&nbsp;</strong><?php echo $registro[nombre];?></p>
	<img src="<?php echo $reg[foto];?>" alt="fotografia <?php echo $reg[nombre];?>" />
	
	<br></br>
	<p>&nbsp;A continuación se muestra un formulario en el que puede introducir los nuevos datos. Si deja algún campo en blanco, no se modificará el valor anterior.</p>
	<br></br>
	<form name="formReg" method="post">
		<table>
			<tr>
				<td align="right">Nombre:&nbsp;</td>
				<td align="left"><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td align="right">Pequeña descripción:&nbsp;</td>
				<td align="left"><textarea name="des" rows="5" cols="30"></textarea></td>
			</tr>
			
			<tr>
				<td align="right">Amplia descripción:&nbsp;</td>
				<td align="left"><textarea name="desamp" rows="8" cols="30"></textarea></td>
			</tr>

			<tr>
				<td align="right">Precio:&nbsp;</td>
				<td align="left"><input type="text" name="precio" />&nbsp;€</td>
			</tr>
			<tr>
				<td align="right">Fotografia:&nbsp;</td>
				<td align="left"><input type="text" name="fot" /></td>
			</tr>
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">
					<input type="submit" value="Enviar" name="envio" />
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