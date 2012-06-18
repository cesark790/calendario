<?include("top.php");?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<link rel="stylesheet" type="text/css" href="tabla/filtergrid.css">
	<title>.::Calendario Actividades CI::.</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jsvalidation.css">

<!-- 
window.onerror = new Function("return true") 
//--> 
</script>  

<body>
	<style type="text/css">
	body{
		font-size:18px;
		font-family: 'Arial', sans-serif;
		background-image:url(img/ci.jpg);	
		background-repeat: no-repeat;
		background-attachment: fixed;
		text-shadow:5px 5px 10px rgba(0,0,0,0.3);
	}
	#info{
		cursor: pointer;
		border:5px solid;
		border-color:orange;
		color:orange;
		font-family: 'Arial', sans-serif;
		font-size:12px;
		position: absolute;
		text-align:center;
		top:110px;
		left:10px;
		width:9em;
		height:25px;
		background-color: rgb(152,255,151);
	}

	</style>

<?php
	include("conexion.php");
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

	if (!(isset($anio))) {
		$anio=date("Y");
		$anio_dos=date("Y");	
		$anio_tres=date("Y");
		$mes=date("m");
	}else{
		$anio_dos=$anio;
		$anio_tres=$anio;
	}

	
	

?>

<div align="left"><img src="img/ci_logo.png" ></div>

<div style="position:absolute;right:0px;top:0px;font-size:16px;font-family: 'Prosto One', sans-serif;">BIENVENIDO  <? echo $_SESSION['nombre_s']." ".$_SESSION['a_paterno'];?> <a href="salir.php" style="text-decoraction:none;color:rgb(127,37,255);font-size:12px;">(Salir)</a> 	<?php if($_SESSION['permiso_s']==2){?><a href="admin.php" style="text-decoraction:none">Administrador</a><?}?>   	<?php if($_SESSION['permiso_s']==2){?><a href="reportes.php" style="text-decoraction:none">Reportes</a><?}?><a href="inicio.php"> Inicio</a>    <br><p style="font-size:13px;text-align:right"><?echo date("d/m/Y");?></p></div>
<div align="center" style="font-weight:bold;margin:50px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">CALENDARIO DE ACTIVIDADES</div>
<div align="center" style="font-weight:bold;margin:100px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">REPORTES</div>
<br>
<div aling="center"<? if($_SESSION['permiso_s']!=2){?>style="display:none"<?}?> style="position:absolute;top 0px;"></div>
<div>
	<p>
		&nbsp;
	</p>
</div>
<form id="form1" action="resultado.php" method="post">
<div align="center">
	<div style="width:90%; background:white; margin:0px 110px; border:3px  solid;">
		<div align="right" style="font-size:14px; margin:20px;">
				SELECCIONA TUS PARAMETROS BUSQUEDA
		</div>
		<table width="80%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="30%"> &nbsp;</td>
					<td width="70%"> &nbsp;</td>
				</tr>
				<tr>
					<td align="right">
						Responsable : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<select style="width:54%" name="responsable">
							<option value="">-------------------Selecciona---------------------</option>
						<?
						$sql_responsable=mysql_query("SELECT id_responsable, nombre, a_paterno, a_materno FROM calendario_cc_responsables");
						while ($reg=mysql_fetch_array($sql_responsable)) {
						?>
						<option value="<? echo $reg['id_responsable'];?>"> <? echo $reg['nombre']. " " . $reg['a_paterno'];?></option>
						<?
						}
						?>
						</select>
						<script type="text/javascript">
						var responsable = new LiveValidation ('responsable');
						responsable.add( Validate.Presence );
						</script>
					</td>	
				</tr>	
				<tr>
					<td align="right">
						Año : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<select style="width:54%" name="anio">
							<option value="">-------------------Selecciona---------------------</option>
							<?
							$anio=2011;
							$anio_actual=date("Y");
							while($anio<=$anio_actual){
								?>
								<option value="<? echo $anio;?>"><?echo $anio;?></option>
								<?
								$anio++;
							}
							?>
						</select>
						<script type="text/javascript">
						var anio = new LiveValidation ('anio');
						anio.add( Validate.Presence );
						</script>
					</td>	
				</tr>	
				<tr>
					<td align="right">
						Mes : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<select style="width:54%" name="mes">
							<option value="">--------------------Selecciona---------------------</option>
						<?
						$sql_mes=mysql_query("SELECT id_mes,mes FROM meses");
						while ($reg=mysql_fetch_array($sql_mes)) {
						?>
						<option value="<? echo $reg['id_mes'];?>"> <? echo $reg['mes'];?></option>
						<?
						}
						?>
						</select>
					</td>	
				</tr>	
				
					<tr>
					<td align="right">
						Periodo : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<select style="width:25%" name="periodo_1">
							<option value="">--Selecciona--</option>
						<?
						$sql_mes=mysql_query("SELECT id_mes,mes FROM meses");
						while ($reg=mysql_fetch_array($sql_mes)) {
						?>
						<option value="<? echo $reg['id_mes'];?>"> <? echo $reg['mes'];?></option>
						<?
						}
						?>
						</select> a 

						<select style="width:25%" name="periodo_2">
							<option value="">--Selecciona--</option>
						<?
						$sql_mes=mysql_query("SELECT id_mes,mes FROM meses");
						while ($reg=mysql_fetch_array($sql_mes)) {
						?>
						<option value="<? echo $reg['id_mes'];?>"> <? echo $reg['mes'];?></option>
						<?
						}
						?>
						</select>
					</td>	
					</tr>	
					<tr>
					<td align="right">
						Actividad : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<select style="width:54%" name="actividad">
							<option value="">--------------------Selecciona---------------------</option>
						<?
						$sql_actividades=mysql_query("SELECT id_actividad,actividad FROM  calendario_cc_actividades");
						while ($reg=mysql_fetch_array($sql_actividades)) {
						?>
						<option value="<? echo $reg['id_actividad'];?>"> <? echo $reg['actividad'];?></option>
						<?
						}
						?>
						</select>
					</td>	
				</tr>	

				<tr>
					<td align="right">
						Estatus : &nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td>
						<input type="checkbox" name="estatus_1" value="estatus_1"> Completados &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="estatus_2" value="estatus_2"> Vencidos &nbsp;&nbsp;&nbsp;&nbsp;
						<br>
						<input type="checkbox" name="estatus_3" value="estatus_3"> En Proceso &nbsp;&nbsp;&nbsp;&nbsp;
						</select>
					</td>	
				</tr>	

				<tr>
					<td align="right">
						&nbsp; &nbsp; &nbsp; &nbsp;
					</td>
					<td align="right">
						<div style="width:80px; height:40px; background:#ccc; margin:20px 20 px; text-align='center';border:2px solid; cursor:	pointer;">
							<div id="enviar" style="margin:10px 10px;"> Generar</div>
						</div>
					</td>	
				</tr>

		</table>
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('tr').css('height','50px');
		$('#enviar').click(function(){
			$('#form1').submit(); 
		})

	})
</script>