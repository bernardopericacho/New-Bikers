




<div class="contenido">
<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
if (isset($_POST[nueva]) && !empty($_SESSION[usuario])) {

	$nombre=$_POST[nom];
	$foto=$_POST[foto];
	$sql="select id_ubicacion from ubicacion where nombre_ub='$_POST[pregunta]'";
	$resultado=mysql_query($sql);
	$reg = mysql_fetch_array($resultado, MYSQL_ASSOC);
	if (!empty($nombre)){
	
		$consulta = "select * from categorias where nombre='$nombre'";
		$result=mysql_query($consulta);
		if(mysql_num_rows($result) > 0){
			echo "Esa categoria ya existe, por favor introduzca otra.";
		}
		else {
			mysql_query("insert into categorias(nombre,num_prod,ubicacion,foto) values ('$nombre','0','$reg[id_ubicacion]','$foto')");
			mysql_query("update ubicacion set num_categ=num_categ+1 where id_ubicacion='$reg[id_ubicacion]'");
			echo "Categoría añadida con exito.";
		}
	
	}
	else{
	echo "Nombre de la categoria vacio";
	
	}
		
	unset($_POST[nueva]);


}



?>
	
	<h1>&nbsp;Nueva categoría:&nbsp;</h1>
			<form name="formReg" method="post">
<table class="reg">


			<tr>
				<td align="right">Nombre:&nbsp;</td>
				<td align="left"><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td align="right">Foto:&nbsp;</td>
				<td align="left"><input type="text" name="foto" /></td>
			</tr>

			<tr>
				<td align="right">Ubicación:&nbsp;</td>
				<td align="left">
				<select name="pregunta" size="1">
				<option>Motocicletas</option>
				<option>Accesorios</option>
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


</table>
</form>


</div>