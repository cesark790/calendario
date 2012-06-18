<?include("top.php");?>
<html>
<head>
	<?
	header ('Content-type: text/html; charset=utf-8');
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<link rel="stylesheet" type="text/css" href="tabla/filtergrid.css">
	<title>.::Calendario Actividades CI::.</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

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
	$color=1;
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

	
	/*
	Verificamos si los campos vienen vacios y si vienen se les asigna un valor nulo y si no se les asigna el and para completar la setencia SQL
	*/
if($responsable==""){
	$responsable_v="";
}
else{
	$responsable_v=" id_responsable =  '$responsable' ";
}

		if($anio==""){
			$anio_v="";
		}
			else{
				$anio_v="and anio = '$anio' ";
			}

		if ($mes=="") {
			$mes_v=" ";
		}
			else{
				$mes_v=" and id_mes = '$mes' ";
			}

		if ($periodo_1=="") {
			$periodo="";
		}else{
			$periodo="and id_mes BETWEEN '$periodo_1' and '$periodo_2' ";
		}

		if ($actividad=="") {
			$actividad="";
		}else{
			$actividad="and id_actividad = '$actividad' ";
		}

		if($estatus_1==true){
			$sql_completas=mysql_query("SELECT count(id_responsable) as completas FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance ='100'");
			$conteo_completas=mysql_fetch_array($sql_completas);
			$conteo_completas=$conteo_completas['completas'];
			$sql_completas_dos=mysql_query("SELECT * FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance ='100'");
		}

		if($estatus_2==true){
			$sql_vencidad=mysql_query("SELECT count(id_responsable) as vencidas FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance ='0'");
			$conteo_vencidad=mysql_fetch_array($sql_vencidad);
			$conteo_vencidad=$conteo_vencidad['vencidas'];
			$sql_vencidad_dos=mysql_query("SELECT * FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance ='0'");

		}

		if($estatus_2==true){
			$sql_proceso=mysql_query("SELECT count(id_responsable) as proceso FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance BETWEEN '1' AND '99'") ;
			$conteo_proceso=mysql_fetch_array($sql_proceso);
			$conteo_proceso=$conteo_proceso['proceso'];
			$sql_proceso_dos=mysql_query("SELECT * FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad and avance BETWEEN '1' AND '99'") ;
			}

		$sql_principal=mysql_query("SELECT * FROM vista_calendario_general WHERE $responsable_v $anio_v $mes_v $periodo $actividad ");

		$sql_responsable=mysql_query("SELECT * FROM vista_calendario_general  WHERE id_responsable = '$responsable' GROUP BY id_responsable ");
		$responsable=mysql_fetch_array($sql_responsable);
		$nombre_responsable = $responsable['nombre'];
		$area=$responsable['area'];
		if($mes==""){
			$mesoperiodo= " ". mes($periodo_1). " a ". mes($periodo_2);
		}else{
			$mesoperiodo= mes($mes);
		}

		
	?>
<div align="left"><img src="img/ci_logo.png" ></div>
<div style="position:absolute;right:0px;top:0px;font-size:16px;font-family: 'Prosto One', sans-serif;">BIENVENIDO  <? echo $_SESSION['nombre_s']." ".$_SESSION['a_paterno'];?> <a href="salir.php" style="text-decoraction:none;color:rgb(127,37,255);font-size:12px;">(Salir)</a><a href="inicio.php"> Inicio</a> 	<?php if($_SESSION['permiso_s']==2){?><a href="admin.php" style="text-decoraction:none">Administrador</a><?}?>   	<?php if($_SESSION['permiso_s']==2){?><a href="reportes.php" style="text-decoraction:none">Reportes</a><?}?>    <br><p style="font-size:13px;text-align:right"><?echo date("d/m/Y");?></p></div>
<div align="center" style="font-weight:bold;margin:50px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">CALENDARIO DE ACTIVIDADES</div>
<div align="center" style="font-weight:bold;margin:100px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">RESULTADO DE LA BUSQUEDA</div>
<br><div aling="center"<? if($_SESSION['permiso_s']!=2){?>style="display:none"<?}?> style="position:absolute;top 0px;">
<div>
	<p>
		&nbsp;
	</p>
</div>

<div align="left">
	<div id="regresar" style="width:150px; height:60px; background:rgb(245,245,245); border:2px solid; cursor:pointer;">
			<div style="margin:20px 25px">REGRESAR</div>
	</div>
</div>
<div>
	&nbsp;
</div>
<table align="center" width="95%">
	<th height="20" align="center">			
	</th>
</table>
<hr style="width:95%">
<div align="center">
	<div style="width:80%; height:290px;  background:white; border:4px solid; border-radius:15px; border-color:rgb(153,63,63); box-shadow:10px 10px 10px rgba(0,0,0,0.5)">
		<table align="center" width="84%">
			<tr>
				<td width="35%" > Responsable: </td>
				<td width="50%" align="left"><? echo $nombre_responsable;?></td>
				<td width="15%" rowspan="4" ><img src="img/ci_logo.png" style="margin:4px"></td>
			</tr>
			<tr>
				<td> Area : </td>
				<td colspan="2" width="55%" align="left"><? echo cambia($area);?></td>
			</tr>
			<tr>
				<td> Mes o Periodo : </td>
				<td colspan="2" width="55%" align="left"><? echo $mesoperiodo?></td>
			</tr>
			<tr>
				<td colspan="3"><hr> </td>				
			</tr>

			<tr>
				<td align="center" colspan="2"><strong>ESTATUS</strong> </td>				
			</tr>
			<tr>
				<td> Actividades Completadas (100%) : </td>
				<td width="55%" align="center"><? echo $conteo_completas; ?></td>
				<td  align="center"><a id="completas" href="#">Detallado</a></td>
			</tr>
			<tr>
				<td> Actividades Vencidas (0%)  : </td>
				<td width="55%" align="center"><? echo $conteo_vencidad; ?></td>
				<td  align="center"><a id="vencidas" href="#">Detallado</a></td>
			</tr>
				<tr>
				<td> Actividades en Proceso (1% a 99%)  : </td>
				<td width="55%" align="center"><? echo 	$conteo_proceso; ?></td>
				<td  align="center"><a id="proceso" href="#">Detallado</a></td>
			</tr>
		</table>
	</div>
</div>
<div id="contenedor_completadas">
	<div align="right">
		<div style="width:20px; height:20px; border:2px solid; text-align:center; cursor:pointer;" id="close_completas"> X </div>
	</div>
	<table align="center" width="90%" id="exportar_tabla_1">
		<tr align="center">
			<td colspan="3" width="80%">Actividades Completadas</td>
			<td width="20%" align="right">
				<form target="_blank" name="form1" id="form1" action="ficheroExcel.php" method="post">
					<a id="enviar_1" href="#">Exportar a Excel</a>
				<input type="hidden" id="tabla_1" name="tabla_1" />
			</td>
		</tr>
		<tr style="background:black;color:white;" align="center">
			<td width="20%%"> Responsable</td>
			<td width="20%%"> Actividad</td>
			<td width="20%%"> Fecha</td>
			<td width="20%%"> Avance</td>
		</tr>
		<?
			while ($reg=mysql_fetch_array($sql_completas_dos)) {
				?>
				<tr <? if($color%2==0){?> style="background:rgb(236,224,225);"<?}else{?> style="background:white;"<?}?> align="center">
					<td><? echo $reg['nombre'];?></td>
					<td><? echo $reg['actividad'];?></td>
					<td><? echo $reg['dia']. "-" . $reg['id_mes']. "-" .$reg['anio'];?></td>
					<td><? echo $reg['avance'];?>%</td>
				</tr>
				<?
				$color++;
			}
		?>
	</form>
	</table>
</div>
<div id="contenedor_vencidas">
	<div align="right">
		<div style="width:20px; height:20px; border:2px solid; text-align:center; cursor:pointer;" id="close_vencidas"> X </div>
	</div>
	<table align="center" width="90%" id="exportar_tabla_2">
		<tr align="center">
			<td colspan="3" width="80%">Actividades Vencidas</td>
			<td width="20%" align="right"><form target="_blank" name="form"2 id="form2" action="ficheroExcel.php" method="post">
				<a id="enviar_2" href="#">Exportar a Excel</a>
			<input type="hidden" id="tabla_2" name="tabla_2" />
		</td>
		</tr>
		<tr style="background:black;color:white;" align="center">
			<td width="20%%"> Responsable</td>
			<td width="20%%"> Actividad</td>
			<td width="20%%"> Fecha</td>
			<td width="20%%"> Avance</td>
		</tr>
		<?
			while ($reg=mysql_fetch_array($sql_vencidad_dos)) {
				?>
				<tr <? if($color%2==0){?> style="background:rgb(236,224,225);"<?}else{?> style="background:white;"<?}?> align="center">
					<td><? echo $reg['nombre'];?></td>
					<td><? echo $reg['actividad'];?></td>
					<td><? echo $reg['dia']. "-" . $reg['id_mes']. "-" .$reg['anio'];?></td>
					<td><? echo $reg['avance'];?>%</td>
				</tr>
				<?
				$color++;
			}
		?>
	</form>
	</table>
</div>
<div id="contenedor_proceso">
	<div align="right">
		<div style="width:20px;  border:2px solid; text-align:center; cursor:pointer;" id="close_proceso"> X </div>
	</div>
	<table align="center" width="90%" id="exportar_tabla_3">
		<tr align="center">
			<td colspan="3" width="80%">Actividades en Proceso</td>
			<td width="20%" align="right"><form target="_blank" name="form3" id="form3" action="ficheroExcel.php" method="post">
				<a id="enviar_3" href="#">Exportar a Excel</a>
			<input type="hidden" id="tabla_3" name="tabla_3" />
			</td>
		</tr>
		<tr style="background:black;color:white;" align="center">
			<td width="20%%"> Responsable</td>
			<td width="20%%"> Actividad</td>
			<td width="20%%"> Fecha</td>
			<td width="20%%"> Avance</td>
		</tr>
		<?
			while ($reg=mysql_fetch_array($sql_proceso_dos)) {
				?>
				<tr <? if($color%2==0){?> style="background:rgb(236,224,225);"<?}else{?> style="background:white;"<?}?> align="center">
					<td><? echo $reg['nombre'];?></td>
					<td><? echo $reg['actividad'];?></td>
					<td><? echo $reg['dia']. "-" . $reg['id_mes']. "-" .$reg['anio'];?></td>
					<td><? echo $reg['avance'];?>%</td>
				</tr>
				<?
				$color++;
			}
		?>
	</form>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#regresar').click(function(){
			history.go(-1);
		})
		$('tr').css('height','30');

		$('#completas').click(function(evento){
			evento.preventDefault();
			$('#contenedor_completadas').show(2000);
		})
		$('#close_completas').click(function(evento){
			evento.preventDefault();
			$('#contenedor_completadas').hide(2000);
		})


		$('#vencidas').click(function(evento){
			evento.preventDefault();
			$('#contenedor_vencidas').show(2000);
		})
		$('#close_vencidas').click(function(evento){
			evento.preventDefault();
			$('#contenedor_vencidas').hide(2000);
		})


		$('#proceso').click(function(evento){
			evento.preventDefault();
			$('#contenedor_proceso').show(2000);
		})
		$('#close_proceso').click(function(evento){
			evento.preventDefault();
			$('#contenedor_proceso').hide(2000);
		})

		$('#enviar_1').click(function(){
			$('#tabla_1').val($("<div>").append( $("#exportar_tabla_1").eq(0).clone()).html()); 
			 $("#form1").submit(); 

		});
		$('#enviar_2').click(function(){
			$('#tabla_2').val($("<div>").append( $("#exportar_tabla_2").eq(0).clone()).html()); 
			 $("#form2").submit(); 

		});
		$('#enviar_3').click(function(){
			$('#tabla_3').val($("<div>").append( $("#exportar_tabla_3").eq(0).clone()).html()); 
			 $("#form3").submit(); 

		});


	})
</script>