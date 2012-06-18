<? include("top.php");?>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css\sunny\jquery-ui-1.8.17.custom.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<link rel="stylesheet" type="text/css" href="tabla/filtergrid.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
	<title>.::Opciones::.</title>
		<script language="JavaScript" > 
<!-- 
window.onerror = new Function("return true") 
//--> 
</script>  
</head>
<SCRIPT>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</SCRIPT>

</scrip>
<script type="text/javascript">
	function completado(){

		if(document.datos.avance.value==100){
			document.datos.fecha_completado.disabled = false;
		}else{

			document.datos.fecha_completado.disabled = true;
		}
	}
	
</script>
<body>
	<style type="text/css">
	body{
		font-size:18px;
		font-family: 'Arial', sans-serif;
		background:white;
		background-repeat: no-repeat;
		background-attachment: fixed;
		text-shadow:5px 5px 10px rgba(0,0,0,0.3);
	}
	</style>

<?php
	include("conexion.php");
	include("convierte_mes.php");
	error_reporting(0);
	foreach ($_POST as $nombre => $value) {
		$expresion="\$".$nombre."='".$value."';";
		eval($expresion);
	}
	foreach ($_GET as $nombre => $value) {
		$expresion="\$".$nombre."='".$value."';";
		eval($expresion);
	}
	
	foreach($_SESSION as $nombre_campo => $valor){ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   	eval($asignacion); 
}

if (isset($eliminar)) {
	unlink($ruta);
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino el archivo del registro con el Id $id ','$_SESSION[u_name]')")
?><div align="center">El archivo fue borrado<br><br><br><a href="javascript:window.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:220px; height:50px; border-color:#ccc;">
 	<input type="submit" name="eliminar" value="CONFIRMAR">
 	<br>
 	<br>
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}?>
