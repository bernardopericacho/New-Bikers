<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$pedido = $_GET["id"];
$sql = "SELECT * FROM contiene,productos WHERE producto=id_producto and pedido='$pedido'";
$result = mysql_query($sql);
?>
<div class="contenido">
<h2>Detalles del pedido: <?php echo $pedido;?></h2>
<?php
	while($reg = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
		<div class="producto">
		<h1>Producto:&nbsp;<?php echo $reg[nombre];?></h1>
		<p>Unidades:&nbsp;<?php echo $reg[unidades];?></p>
		<p>Precio de las unidades:&nbsp;<?php echo $reg[precio_unidades];?>&nbsp;€</p>
		</div>
		
<?php	} 

	?>
</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>