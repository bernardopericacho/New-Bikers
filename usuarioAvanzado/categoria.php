<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$categoria=$_GET[id];
$sql = "SELECT * FROM productos WHERE categoria='$categoria'";
$result = mysql_query($sql);

$sqlcat = "SELECT nombre FROM categorias WHERE id_categoria='$categoria'";
$resultcat = mysql_query($sqlcat);
$reg = mysql_fetch_array($resultcat, MYSQL_ASSOC);
?>
<div class="contenido">
	<?php

	if( isset($_POST[aniadir]) && !(empty($_SESSION[usuario]))) {
	$idprod=$_GET["prod"];
	$cons = "SELECT * FROM productos WHERE id_producto='$idprod'";
	$msql = mysql_query($cons);
	$re = mysql_fetch_array($msql, MYSQL_ASSOC);
	$cant=$_POST["cantidad"];
	if ($cant>0) {
	$preciot=$_POST["cantidad"]*$re["precio"];
	$consulta = "SELECT id FROM usuarios WHERE login='$_SESSION[usuario]'";
	$consul = mysql_query($consulta);
	$registro = mysql_fetch_array($consul, MYSQL_ASSOC);
	mysql_query("INSERT INTO carrito(idprod,numusu,unidades,precioprod,nombreproducto) values ('$idprod','$registro[id];','$cant','$preciot','$re[nombre]')");
	echo 'SE HA AÑADIDO AL CARRITO CORRECTAMENTE';
	}
	unset($_POST[aniadir]);	

}else{
		if (isset($_POST[aniadir])) echo 'Necesita estar logeado para hacer una compra';
}
	?>
	<p><h2>Categoria:&nbsp;<?php echo $reg[nombre];?></h2></p>
	<?php
	while($reg = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
		
		<div class="producto">
		<form method="post" action="usuario.php?seccion=categoria&id=<?php echo $categoria?>&prod=<?php echo $reg[id_producto];?>">
		<h1><?php echo $reg[nombre];?></h1>
		<p><?php echo $reg[p_descripcion];?></p>
		<p>Precio: <?php echo $reg[precio];?>€</p>
		<p>Unidades:
			<input type="text" size="3" value="0" name="cantidad"/>
			<input type="submit" value="Añadir" name="aniadir"/>
		</p>
		<p><a href="usuario.php?seccion=producto&id=<?php echo $reg[nombre];?>">Más detalles del producto</a></p>
		</form>
		</div>
		
<?php	} 
	?>

	<h1><a href="usuario.php?seccion=pedirDatos">Finalizar compra</a></h1>


</div> 

<?
	
	mysql_free_result($result); 
	mysql_close($conexion);
?>