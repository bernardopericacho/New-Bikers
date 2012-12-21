<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

if ((isset($_POST[borrar])) && (!empty($_SESSION[usuario]))){
	$sql = "SELECT * FROM categorias where id_categoria='$_GET[id]'";
	$result = mysql_query($sql);
	$registro = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($registro[num_prod] > 0){
	echo "La categoria que desea eliminar tiene productos. Eliminelos para poder borrar la categoria.";
	}
	else {
	mysql_query("update ubicacion set num_categ=num_categ-1 where id_ubicacion='$registro[ubicacion]'");
	mysql_query("delete from categorias where id_categoria='$_GET[id]'");
	}
	unset($_POST[borrar]);
}

$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion order by id_categoria";
$result = mysql_query($sql);

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Id categoria') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion order by id_categoria";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Nombre') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion order by nombre";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Número de productos') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion order by num_prod desc";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Motocicletas') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion and ubicacion='1'";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='Accesorios') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM categorias,ubicacion where ubicacion=id_ubicacion and ubicacion='2'";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}


?>
<div class="contenido">
	<p><h2>Listado Categorias:&nbsp;</h2>Ordenar por:&nbsp;
	<form method="post">
	<table>
			<td>
				<select name="orden" size="1">
				<option>Id categoria</option>
				<option>Nombre</option>
				<option>Número de productos</option>
				<option>Motocicletas</option>
				<option>Accesorios</option>				
				</select>
			</td>
			<td>
				<input type="submit" value="Aceptar" name="ordenar"/></p>
			</td>	
	</table>
	</form>
	
<?php
	if(mysql_num_rows($result) > 0){
	while($reg = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
		<div class="producto">
		<form method="post" action="administrador.php?seccion=listadocategorias&id=<?php echo $reg[id_categoria];?>">
		<h1><?php echo $reg[nombre];?></h1>
		<p><strong>Número de productos:&nbsp;</strong><?php echo $reg[num_prod];?></p>
		<p><strong>Id categoria:&nbsp;</strong><?php echo $reg[id_categoria];?></p>
		<p><strong>Ubicacion:&nbsp;</strong><?php echo $reg[nombre_ub];?></p>
			<input type="submit" value="Eliminar" name="borrar"/>
		<p><a href="administrador.php?seccion=detallescategoria&id=<?php echo $reg[id_categoria];?>">Modificar las características de la categoria</a></p>

		</form>
		</div>
		
<?php	}
}
else 
	echo "No hay categorias con los criterios de búsqueda seleccionados.";
	?>





</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>