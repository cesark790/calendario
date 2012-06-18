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
		background:rgb(255,223,87);
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



if ($opcion==1) {

if (isset($eliminar)) {
	
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino a un Usuario <ID> $id','$_SESSION[u_name]')");
	mysql_query("DELETE FROM calendario_cc_responsables WHERE id_responsable = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>

<?
if ($opcion==2) {

if (isset($eliminar)) {
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino una Actividad <ID> $id','$_SESSION[u_name]')");
	mysql_query("DELETE FROM calendario_cc_actividades WHERE id_actividad = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>

<?
if ($opcion==3) {

if (isset($eliminar)) {
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino una Area <ID> $id','$_SESSION[u_name]')");
	mysql_query("DELETE FROM calendario_cc_areas WHERE id_area = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>








<?
if ($opcion==4) {


if (isset($eliminar)) {
	$verificar = mysql_query("SELECT id_clienteexterno FROM vista_calendario_general WHERE id_clienteexterno = '$id' ");
	$num=mysql_num_rows($verificar);
	if($num==0){
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino a un Cliente <ID> $id','$_SESSION[u_name]')");	
	mysql_query("DELETE FROM calendario_cc_clientesexternos WHERE id_cliente_externo = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?
	}else{?>
	<div style="color:red;" align="center">ERROR 1: Hay registros asociados a este cliente. <br><br><br><a href="javascript:self.close()">Cerrar</a></div><?	
	 }


}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>




<?
if ($opcion==5) {

if (isset($eliminar)) {
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino una Particurlaridad <ID> $id','$_SESSION[u_name]')");
	mysql_query("DELETE FROM calendario_cc_particularidad WHERE id_particularidad = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>





<?
if ($opcion=='admin') {

if (isset($eliminar)) {
	

	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Elimino una Actividad <ID> $id','$_SESSION[u_name]')");
	mysql_query("UPDATE calendario_general SET estatus = '0' WHERE id_calendario = '$id' ")
?><div align="center">El registro fue borrado<br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">Cerrar</a></div><?

}else{
 ?>

<form action="" method="post">
 <div align="center" style="border:2px solid;background:white; solid; width:380px; height:100px; border-color:#ccc;">
 	<div style="background:rgb(255,248,97)"> VENTANA DE CONFIRMACION</div>
 	<div align="center" style="padding:8px 9px;">Eliminar Registro No <? echo $id;?><br></div>
 	<input type="submit" name="eliminar" value="CONFIRMAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	<input type="button" value="CANCELAR" onclick="javascript:window.close()"

 </div>
 </form>
 <?}
}?>

