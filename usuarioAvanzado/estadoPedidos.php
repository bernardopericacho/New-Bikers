<?php
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$consulta = "SELECT id from usuarios where login='$_SESSION[usuario]'";
$consul = mysql_query($consulta);
$registro = mysql_fetch_array($consul, MYSQL_ASSOC);
$sql = "select * from pedidos where cliente='$registro[id]' order by fecha_hora_pedido desc";
$resultado = mysql_query($sql);
?>

	<div class="contenido">
	<h2>Estado de los pedidos</h2>
	
<?php

	while($reg = mysql_fetch_array($resultado, MYSQL_ASSOC)) {

	?>
		
		<div class="producto">

		
		<h1>Id pedido:&nbsp;<?php echo $reg[id_pedido];?></h1>
		<p><strong>Importe:&nbsp;</strong><?php echo $reg[importe_total];?>&nbsp;€</p>
		<p><strong>Estado:&nbsp;</strong><?php echo $reg[estado];?></p>
		<p><strong>Fecha realización del pedido:&nbsp;</strong><?php echo $reg[fecha_hora_pedido];?></p>
		<p><strong>Fecha entrega del pedido:&nbsp;</strong><?php echo $reg[fecha_hora_entrega];?></p>
		<p><a href="usuario.php?seccion=detallespedido&id=<?php echo $reg[id_pedido];?>">Más detalles del pedido</a></p>

		</div>
		
<?php	
	} 
?>
		
		
	
	</div>

