<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

if ((isset($_POST[borrar])) && (!empty($_SESSION[usuario]))){
	$consulta="select * from productos where id_producto='$_GET[id]'";
	$res=mysql_query($consulta);
	$fila = mysql_fetch_array($res, MYSQL_ASSOC);

	mysql_query("update categorias set num_prod=num_prod-1 where id_categoria='$fila[categoria]'");
	mysql_query("delete from productos where id_producto='$_GET[id]'");
	unset($_POST[borrar]);
}

$sql = "SELECT * FROM productos order by categoria";
$result = mysql_query($sql);

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Mayor Precio') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM productos order by precio desc";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Categoria') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM productos order by categoria";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Menor Precio') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM productos order by precio";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Orden alfabético') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM productos order by nombre";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='Id producto') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM productos order by id_producto";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}


?>
<div class="contenido">
	<p><h2>Listado Productos:&nbsp;</h2>Ordenar por:&nbsp;
	<form method="post">
	<table>
			<td>
				<select name="orden" size="1">
				<option>Categoria</option>
				<option>Mayor Precio</option>
				<option>Menor Precio</option>
				<option>Orden alfabético</option>
				<option>Id producto</option>				
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
		<form method="post" action="administrador.php?seccion=listadoproductos&id=<?php echo $reg[id_producto];?>">
		<h1><?php echo $reg[nombre];?></h1>
		<p><strong>Pequeña descripcion:&nbsp;</strong><?php echo $reg[p_descripcion];?></p>
		<p><strong>Id producto:&nbsp;</strong><?php echo $reg[id_producto];?></p>
		<p><strong>Precio:&nbsp;</strong><?php echo $reg[precio];?>&nbsp;€</p>
			<input type="submit" value="Eliminar" name="borrar"/>
		<p><a href="administrador.php?seccion=detallesproducto&id=<?php echo $reg[id_producto];?>">Modificar las características del producto</a></p>

		</form>
		</div>
		
<?php	}
}
else 
	echo "No hay productos";
	?>





</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>