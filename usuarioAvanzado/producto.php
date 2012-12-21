<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$producto = $_GET["id"];
$sql = "SELECT * FROM productos WHERE nombre='$producto'";
$result = mysql_query($sql);
$reg = mysql_fetch_array($result, MYSQL_ASSOC);
?>
<div class="contenido">
	<p><h2><?php echo $reg[nombre];?></h2></p>
	<img src="<?php echo $reg[foto];?>" alt="fotografia <?php echo $reg[nombre];?>" />
	<p><?php echo $reg[amplia_descripcion];?></p>
	<a href="usuario.php?seccion=categoria&id=<?php echo $reg[categoria];?>"><strong>Volver</strong></a>
	<br></br>
</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>