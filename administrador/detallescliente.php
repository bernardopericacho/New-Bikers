<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$cliente = $_GET["id"];
$sql = "SELECT * FROM usuarios WHERE id='$cliente' and tipo='u'";
$result = mysql_query($sql);
$reg = mysql_fetch_array($result, MYSQL_ASSOC);
?>
<div class="contenido">
	<p>Id cliente:&nbsp;<?php echo $reg[id];?></p>
	<p>Nombre:&nbsp;<?php echo $reg[nombre];?></p>
	<p>Apellidos:&nbsp;<?php echo $reg[apellidos];?></p>
	<p>Login:&nbsp;<?php echo $reg[login];?></p>
	<p>Direccion:&nbsp;<?php echo $reg[direccion];?></p>
	<p>Email:&nbsp;<?php echo $reg[email];?></p>
	<p>Pregunta:&nbsp;<?php echo $reg[pregunta];?></p>
	<p>Respuesta:&nbsp;<?php echo $reg[respuesta];?></p>
</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>