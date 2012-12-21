

<div class="contenido">
<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

if (isset($_POST[nueva]) && !empty($_SESSION[usuario])) {

	$nombre=$_POST[nom];
	$foto=$_POST[fot];
	$peq=$_POST[des];
	$amp=$_POST[desamp];
	$precio=$_POST[precio];
	$sql="select id_categoria from categorias where nombre='$_POST[pregunta]'";
	$resultado=mysql_query($sql);
	$reg = mysql_fetch_array($resultado, MYSQL_ASSOC);
	
	if (!empty($nombre) && !empty($precio) && is_numeric($precio)){
	
		$consulta = "select * from categorias where nombre='$nombre'";
		$result=mysql_query($consulta);
		if(mysql_num_rows($result) > 0){
			echo "Ese producto ya existe, por favor introduzca otro nombre.";
		}
		else {
			mysql_query("insert into productos(nombre,p_descripcion,amplia_descripcion,precio,categoria,foto) values ('$nombre','$peq','$amp','$precio','$reg[id_categoria]','$foto')");
			mysql_query("update categorias set num_prod=num_prod+1 where id_categoria='$reg[id_categoria]'");
			echo "Producto añadido con exito.";
		}
	
	}
	else{
	echo "Nombre del producto vacio o precio no numerico.";
	
	}
		
	unset($_POST[nueva]);


}



?>

	
<h1>&nbsp;Nuevo Producto:&nbsp;</h1>
<table>
<tr>
	<td>
		<form name="formReg" method="post">

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
				<td align="right">Categoría:&nbsp;</td>
				<td align="left">
				<select name="pregunta" size="1">
				
<?php
$consulta = "SELECT nombre from categorias";
$result = mysql_query($consulta);

while($registro = mysql_fetch_array($result, MYSQL_ASSOC)){

				?><option><?php echo $registro[nombre] ?></option>
<?php
}
?>
				</select>
				</td>
			</tr>
		
			<tr>
				<td align="right">&nbsp;</td>
				<td align="left">
					<input type="submit" value="Enviar" name="nueva"/>
					<input type="reset" value="Limpiar" />
				</td>
			</tr>

		</form>
	</td>
	
</tr>
</table>
<br></br>

</div>