<?php 
$conexion = mysql_connect("localhost", "prueba", "prueba");
mysql_select_db("prueba");
$consulta = "SELECT id from usuarios where login='$_SESSION[usuario]'";
$consul = mysql_query($consulta);
$registro = mysql_fetch_array($consul, MYSQL_ASSOC);

if( isset($_POST[mod]) && !(empty($_SESSION[usuario]))) {
	$cantidad=$_POST[cuantos];
	$id=$_GET[id];
	$datos = "SELECT * FROM productos where id_producto='$id'";
	$resu = mysql_query($datos);
	$fila = mysql_fetch_array($resu, MYSQL_ASSOC);
	if ($cantidad>0) {
		$precio=$fila[precio]*$cantidad;
		mysql_query("UPDATE carrito SET unidades='$cantidad',precioprod='$precio' where idprod='$id'");
	}
	else {
		mysql_query("DELETE FROM carrito where idprod='$id' and numusu='$registro[id]'");
	}
	unset($_POST[mod]);
}

if( isset($_POST[borrar]) && !(empty($_SESSION[usuario]))) {
	$id=$_GET[id];
	mysql_query("DELETE FROM carrito where idprod='$id' and numusu='$registro[id]'");
	unset($_POST[borrar]);
} 

$sql = "SELECT * FROM carrito WHERE numusu='$registro[id]'";
$result = mysql_query($sql);
$suma=0;

?>
	
<div class="contenido">


	<p><h2>Productos actualmente en el carrito:</h2></p>
	<?php
	while($reg = mysql_fetch_array($result, MYSQL_ASSOC)) {
	?>
		
		<div class="producto">
		<form method="post" action="usuario.php?seccion=pedirDatos&id=<?php echo $reg[idprod];?>">
		
		<h1><?php echo $reg[nombreproducto];?></h1>
		<p>Unidades:&nbsp;
		<input type="text" size="3" value="<?php echo $reg[unidades];?>" name="cuantos"/>
		<input type="submit" value="Modificar" name="mod"/>
		<input type="submit" value="Eliminar" name="borrar"/>
		</p>
		<p>
		Precio:&nbsp;<?php echo $reg[precioprod];?>€
		</p>
		</form>
		</div>
		
<?php	
	$suma=$suma + $reg[precioprod];
	} 
?>
	<p>Precio total:&nbsp;<?php echo $suma?>€</p>
	<br></br>
<?php
		if ( isset($_POST[confir]) && !(empty($_SESSION[usuario]))){

				$numerotarjeta=$_POST[tarjeta];

				if ((is_numeric($numerotarjeta))  && (strlen($numerotarjeta) == 16)) {
					
					$pregunta = "SELECT * FROM carrito WHERE numusu='$registro[id]'";
					$respuesta = mysql_query($pregunta);
					$fechaactual = date("y/m/d h:i:s");
					if ($suma > 0){
						$dia=$_POST[day];
						$mes=$_POST[month];
						$año=$_POST[year];
						$fecha= $año.'/'.$mes.'/'.$dia;
						$mensaje="";
						mysql_query("INSERT INTO pedidos(estado,importe_total,cliente,fecha_hora_pedido,fecha_hora_entrega) VALUES ('pagado','$suma','$registro[id]','$fechaactual','$fecha')");
						$ultimo=mysql_insert_id();
						while($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)){
							mysql_query("INSERT INTO CONTIENE(pedido,producto,unidades,precio_unidades) values ('$ultimo','$fila[idprod]','$fila[unidades]','$fila[precioprod]')");
							
							$mensaje=$mensaje+" Producto: $fila[nombreproducto] Cantidad: $fila[unidades] Importe: $fila[precioprod]\n";
						}
						$mail='newuser@localhost';
						$titulo = "Pedido New Bikers";
						$cabeceras = 'From: noreply@newbikers.com' . "\r\n" .
   				  					 'Reply-To: noreply@nwebikers.com' . "\r\n" .
   				  					 'X-Mailer: PHP/' . phpversion();
						mail($mail, $titulo, $mensaje, $cabeceras);
						mysql_query("DELETE FROM carrito WHERE numusu='$registro[id]'");
						echo 'Pedido realizado correctamente. Se le enviará un email de confirmación si ha proporcionado su dirección. Gracias por depositar su confianza en "New Bikers".';
					}
					else{
						echo 'El carrito de la compra está vacío';
						}

				}
				else echo 'Introduzca un numero de tarjeta valido de 16 numeros positivos.';
				
				unset($_POST[confir]);
		}

?>
		<form method="post">

		<br></br>
		<h2>Datos bancarios:</h2>
		<p>Número de tarjeta:
			<input type="text" name="tarjeta" />
			<select name="tipotarj" size="1">
				<option>Visa</option>
				<option>Visa Electron</option>
				<option>Mastercard</option>				
				<option>American Express</option>
				</select>
		</p>
		<p>Fecha de caducidad de la tarjeta:&nbsp;
			Mes:&nbsp;<select name="mes" size="1">
				<option>Enero</option>
				<option>Febrero</option>
				<option>Marzo</option>				
				<option>Abril</option>
				<option>Mayo</option>
				<option>Junio</option>
				<option>Julio</option>				
				<option>Agosto</option>
				<option>Septiembre</option>
				<option>Octubre</option>
				<option>Noviembre</option>				
				<option>Diciembre</option>
				</select>
			Año:&nbsp;<select name="año" size="1">
				<option>2009</option>
				<option>2010</option>
				<option>2011</option>
				<option>2012</option>
				<option>2013</option>
				<option>2014</option>
				<option>2015</option>
				<option>2016</option>
				</select>
		</p>
		<p>Fecha de entrega del pedido:&nbsp;
			Dia:&nbsp;<select name="day" size="1">
				<option>01</option>
				<option>02</option>
				<option>03</option>				
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>				
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>				
				<option>12</option>
				<option>13</option>
				<option>14</option>
				<option>15</option>				
				<option>16</option>
				<option>17</option>
				<option>18</option>
				<option>19</option>				
				<option>20</option>
				<option>21</option>
				<option>22</option>
				<option>23</option>				
				<option>24</option>
				<option>25</option>
				<option>26</option>
				<option>27</option>				
				<option>28</option>
				<option>29</option>
				<option>30</option>
				<option>31</option>				
				</select>
			Mes:&nbsp;<select name="month" size="1">
				<option>01</option>
				<option>02</option>
				<option>03</option>				
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>				
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>				
				<option>12</option>
				</select>
			Año:&nbsp;<select name="year" size="1">
				<option>09</option>
				<option>10</option>
				</select>
		</p>
		<input type="submit" value="Confirmar" name="confir"/>
		</form>
		<br></br>
		<br></br>

	</div>
