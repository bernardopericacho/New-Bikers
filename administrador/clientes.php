<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

if ((isset($_POST[borrar])) && (!empty($_SESSION[usuario]))){
	mysql_query("delete from usuarios where id='$_GET[id]'");
	unset($_POST[borrar]);
}

$sql = "SELECT * FROM usuarios WHERE tipo='u' order by nombre,apellidos";
$result = mysql_query($sql);

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Id cliente') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM usuarios WHERE tipo='u' order by id";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Orden alfabético') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM usuarios WHERE tipo='u' order by nombre,apellidos";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}



?>
<div class="contenido">
	<p><h2>Listado Clientes:&nbsp;</h2>Ordenar por:&nbsp;
	<form method="post">
	<table>
			<td>
				<select name="orden" size="1">
				<option>Orden alfabético</option>
				<option>Id cliente</option>				
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
		<form method="post" action="administrador.php?seccion=clientes&id=<?php echo $reg[id];?>">
		<h1>Id cliente:&nbsp;<?php echo $reg[id];?></h1>
		<p>Nombre:&nbsp;<?php echo $reg[nombre];?></p>
		<p>Apellidos:&nbsp;<?php echo $reg[apellidos];?></p>
		<p>Login:&nbsp;<?php echo $reg[login];?></p>
			<input type="submit" value="Eliminar" name="borrar"/>
		<p><a href="administrador.php?seccion=detallescliente&id=<?php echo $reg[id];?>">Más detalles del cliente</a></p>

		</form>
		</div>
		
<?php	} 
}else
	echo "No hay clientes";
	?>





</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>