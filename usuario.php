<?php 
	session_start();
	$conn=mysql_connect("localhost","prueba","prueba") or die ("Error conectando a la base de datos.");
	mysql_select_db("prueba") or die (mysql_error());
	
	if( isset($_POST[logout]) && !(empty($_SESSION[usuario]))) {
		$sql=("SELECT id FROM usuarios where login='$_SESSION[usuario]'");
		$consulta = mysql_query($sql);
		$fila = mysql_fetch_array($consulta, MYSQL_ASSOC);
		unset($_SESSION['usuario']);
		unset($_SESSION['tipo']);
		unset($_POST[logout]);
		mysql_query("DELETE FROM carrito WHERE numusu='$fila[id]'");
		header("Location: validacion.php");
	}
?>

<? '<?xml version="1.0" encoding="ISO-8859-1"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>

<link rel="stylesheet" href="CSS/CSS.css" type="text/css" />
<link rel="stylesheet" href="CSS/color.css" type="text/css" />
<script language="JavaScript" type="text/javascript" src="javascript/script.js"></script>
<script language="JavaScript" type="text/javascript" src="javascript/cookies.js"></script>
<title>NEW BIKERS</title>

</head>


<body>
<div class="completo">


<div class="cabecera">


	<div class="logo">
	<img src="images/vm_pequeno.gif" alt="rotulo empresa"/>
	</div>

	<div class="titulo">
	<img src="images/logo.gif" alt="logo empresa"/>
	</div>
</div>




<div class="central">
	
	<p>
	<form method="post" >
	<table>
		<tr>
			<td align="left">
			&nbsp;Bienvenido:&nbsp;<strong><?php echo $_SESSION[usuario];?></strong&nbsp;
			</td>
			<td align="right">
			<input type="submit" value="Logout" name="logout"/>
			</td>
		</tr>
	</table>
	</form>
	</p>
	
		
	<div class="menu">
	<table>
						<tr><a href="usuario.php?seccion=informacion"><h1>Informacion</h1></a></tr>
						<tr></tr>
						<tr><a href="usuario.php?seccion=motocicletas"><h1>Motocicletas</h1></a></tr>
						<tr></tr>
						<tr><a href="usuario.php?seccion=accesorios"><h1>Accesorios</h1></a></tr>
						<tr></tr>
						<tr><a href="usuario.php?seccion=datospersonales"><h1>Datos Personales</h1></a></tr>
						<tr></tr>
						<tr><a href="usuario.php?seccion=estadoPedidos"><h1>Pedidos</h1></a></tr>
						<tr></tr>
						<tr><a href="usuario.php?seccion=pedirDatos"><h1>Ver Carrito</h1></a></tr>
						

	</table>
	
	</div>

	<?php
			$query = $_SERVER['QUERY_STRING'];
			parse_str($query, $listpar);
			if (!empty($listpar['seccion'])){
				$link = addslashes($listpar['seccion']);
			}
			else {
				$link = addslashes('informacion');
			}
			if ( file_exists ('usuarioAvanzado/'.$link.'.xhtml') ){
				include('usuarioAvanzado/'.$link.'.xhtml');
			}
			elseif ( file_exists ('usuarioAvanzado/'.$link.'.php') ){
				include('usuarioAvanzado/'.$link.'.php');
			}
   		?>
	

</div>


<div class="pie">
		<table class="piepag">
			<tr>
				<td align="center">

					<a href="mailto:bernardo.sanperi@telefonica.net"><h1>Contacto</h1></a>
				</td>
								
				<td align="center">

					<h1>Última actualización 13:43</h1>

				</td>

				<td align="center">

					<img src="images/vcss.gif" alt="validacion css" />

				</td>


				<td align="center">

					<img src="images/validhtml.gif" alt="validacion html"/>

				</td>
				
			</tr>			
		</table>
</div>

</div>
</body>


</html>
<?php 
	mysql_close($conn);
?>