<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");

if ((isset($_POST[cambiar])) && (!empty($_SESSION[usuario])) )  {
	mysql_query("UPDATE pedidos SET estado='$_POST[nuevoestado]' where id_pedido='$_GET[id]'");
	unset($_POST[cambiar]);
}

$sql = "SELECT * FROM pedidos order by id_pedido";
$result = mysql_query($sql);


if ((isset($_POST[ordenar])) && ($_POST[orden]=='Id pedido') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM pedidos order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Cliente') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM pedidos order by cliente";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Menor cuant�a') && (!empty($_SESSION[usuario])) )  {

	$sql = "SELECT * FROM pedidos order by importe_total";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Mayor cuant�a') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos order by importe_total desc";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='Estado') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos order by estado";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Fecha entrega') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos order by fecha_hora_entrega desc";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='Fecha realizaci�n') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos order by fecha_hora_pedido desc";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}

if ((isset($_POST[ordenar])) && ($_POST[orden]=='S�lo tramitados') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos where estado='tramitado' order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='S�lo pagados') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos where estado='pagado' order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='S�lo enviados') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos where estado='enviado' order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='S�lo recibidos') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos where estado='recibido' order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}
if ((isset($_POST[ordenar])) && ($_POST[orden]=='S�lo archivados') && (!empty($_SESSION[usuario]))) {

	$sql = "SELECT * FROM pedidos where estado='archivado' order by id_pedido";
	$result = mysql_query($sql);
	unset($_POST[ordenar]);
}


?>
<div class="contenido">
	<p><h2>Listado Pedidos:&nbsp;</h2>Ordenar por:&nbsp;
	<form method="post">
	<table>
			<td>
				<select name="orden" size="1">
				<option>Id pedido</option>
				<option>S�lo tramitados</option>
				<option>S�lo pagados</option>
				<option>S�lo enviados</option>
				<option>S�lo recibidos</option>
				<option>S�lo archivados</option>
				<option>Mayor cuant�a</option>
				<option>Menor cuant�a</option>
				<option>Cliente</option>
				<option>Estado</option>
				<option>Fecha entrega</option>
				<option>Fecha realizaci�n</option>
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
		<form method="post" action="administrador.php?seccion=listadopedidos&id=<?php echo $reg[id_pedido];?>">
		<h1>Id pedido:&nbsp;<?php echo $reg[id_pedido];?></h1>
		<p><strong>Cliente:&nbsp;</strong><?php echo $reg[cliente];?></p>
		<p><strong>Estado:&nbsp;</strong><?php echo $reg[estado];?></p>
		<p><strong>Fecha realizaci�n:&nbsp;</strong><?php echo $reg[fecha_hora_pedido];?></p>
		<p><strong>Fecha entrega:&nbsp;</strong><?php echo $reg[fecha_hora_entrega];?></p>
		<p><strong>Importe total:&nbsp;</strong><?php echo $reg[importe_total];?>&nbsp;�</p>
		<p>Cambiar estado:&nbsp;<select name="nuevoestado" size="1">
				<option>tramitado</option>
				<option>pagado</option>
				<option>enviado</option>
				<option>recibido</option>
				<option>archivado</option>
				</select>
		<input type="submit" value="Modificar" name="cambiar"/></p>
		<p><a href="administrador.php?seccion=detallespedido&id=<?php echo $reg[id_pedido];?>">Mostrar detalles del pedido</a></p>

		</form>
		</div>
		
<?php	}
}else
	echo "No hay resultados con ese criterio de b�squeda."

?>


</div> 

<? 
	mysql_free_result($result);
	mysql_close($conexion);
?>