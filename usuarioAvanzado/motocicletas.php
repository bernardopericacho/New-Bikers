<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$sql = "SELECT * FROM categorias WHERE ubicacion='1'";
$result = mysql_query($sql);
?>
<div class="contenido">
	<table >
	<?php
	while($reg = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
		<tr>
			<td>
			<?php
				$imagen = $reg['foto'];
				if($imagen == ' ') 
				{ echo 'Imagen no disponible'; }
				else 
				{ echo '<img src="',$imagen,'" alt="fotografia de ',$reg[nombre],'"/>'; }
			?>
			</td>
			<td>
				<a href="usuario.php?seccion=categoria&id=<?php echo $reg[id_categoria];?>"><h2><?php echo $reg['nombre']?></h2></a>
			</td>
		</tr>
		
<?php	} 
	?>
	</table>




</div> 

<?
	mysql_free_result($result); 
	mysql_close($conexion);
?>