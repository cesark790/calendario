<?include("top.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<link rel="stylesheet" type="text/css" href="tabla/filtergrid.css">
	<title>.::Calendario Actividades CI::.</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript">
<!-- 
window.onerror = new Function("return true") 
//--> 
</script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#info').click(function(){
			$('#ver').show(500);
		})
		
		$('#ocultar').click(function(){
			$('#ver').hide('explode',1000);
		})
	})
</script>

<!--

Aplicaciones Calemdario 2012 

	Version 1.0 

			- Se añadio Modulos de usuario
			- Se añadio Modulos de actividades

	Version 1.2

			- Se añade el color alas actividades
			- Se añade boton de "informacion" para ver el estatus del mes
			- Se añade modulo de reportes

	Version 1.3

			-Se añade function de checbox con jQuery y Ajax
-->

</head>
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
	#ver{
		border:1px solid;
		border-color:orange;
		display: none;
		color:orange;
		font-family: 'Arial', sans-serif;
		font-size:12px;
		position: absolute;
		text-align:center;
		top:0px;
		left:0px;
		margin: 18em 30em 30em 30em;
		width:390px;
		height:250px;
		background-color:rgb(243,243,243);


	}
	#ocultar{
		cursor: pointer;
		color:black;
		font-family: 'Arial', sans-serif;
		font-size:12px;
		border:1px solid;
		font-size:15px;
		margin: 8px 10px 10px 0px;
		text-align:center;
		width:15px;

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

<div style="position:absolute;right:0px;top:0px;font-size:16px;font-family: 'Prosto One', sans-serif;">BIENVENIDO  <? echo $_SESSION['nombre_s']." ".$_SESSION['a_paterno'];?> <a href="salir.php" style="text-decoraction:none;color:rgb(127,37,255);font-size:12px;">(Salir)</a> 	<?php if($_SESSION['permiso_s']==2){?><a href="admin.php" style="text-decoraction:none">Administrador</a><?}?>   	<?php if($_SESSION['permiso_s']==2){?><a href="reportes.php" style="text-decoraction:none">Reportes</a><?}?>    <br><p style="font-size:13px;text-align:right"><?echo date("d/m/Y");?></p></div>
<div align="center" style="font-weight:bold;margin:50px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">CALENDARIO DE ACTIVIDADES</div>
<br><div aling="center"<? if($_SESSION['permiso_s']!=2){?>style="display:none"<?}?> style="position:absolute;top 0px;">
<br>
<form action="" method="post"> Modificar Actividades del Usuario <select onchange="this.form.submit()" class="blanco" name="user" >
																			<option></option>
																			<?
																			$sql_user=mysql_query("SELECT * FROM calendario_cc_responsables");
																			while ($reg_user=mysql_fetch_array($sql_user)) {
																				?><option value="<? echo $reg_user['id_responsable'];?>"><? echo $reg_user['nombre'];?></option><?
																			}?>
																			</select>
																			</form></div>
																			<br>
<table align="center" width="85%" border="0" cellpading="0" cellspacing="0">

	<tr><td align="center" colspan="12"<div style="font-size:22px;font-family: 'Prosto One', sans-serif"><a class="botones" href="inicio.php?anio=<? $anio_dos--; echo $anio_dos; ?>&mes=<?echo $mes;?>"><< </a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <? echo $anio;?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <a class="botones" href="inicio.php?anio=<? $anio_tres++; echo $anio_tres; ?>&mes=<?echo $mes;?>"> >></a></div></td></tr>
	<tr style="background:rgb(117,117,117); color:white;font-family: 'Krona One', sans-serif;">
		<td width="6%" align="center" <? if($mes==1){?>style="background:rgb(68,68,68); "<?}?>  height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=1">ENERO</a></div></td>
		<td width="7%" align="center" <? if($mes==2){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=2">FEBRERO</a></div></td>
		<td width="6%" align="center" <? if($mes==3){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=3">MARZO</a></div></td>
		<td width="6%" align="center" <? if($mes==4){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=4">ABRIL</a></div></td>
		<td width="5%" align="center" <? if($mes==5){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=5">MAYO</a></div></td>
		<td width="6%" align="center" <? if($mes==6){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=6">JUNIO</a></div></td>
		<td width="6%" align="center" <? if($mes==7){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=7">JULIO</a></div></td>
		<td width="7%" align="center" <? if($mes==8){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=8">AGOSTO</a></div></td>
		<td width="11%" align="center" <? if($mes==9){?>style="background:rgb(68,68,68);"<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=9">SEPTIEMBRE</a></div></td>
		<td width="7%" align="center" <? if($mes==10){?>style="background:rgb(68,68,68);"<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=10">OCTUBRE</a></div></td>
		<td width="11%" align="center" <? if($mes==11){?>style="background:rgb(68,68,68);"<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=11">NOVIEMBRE</a></div></td>
		<td width="11%" align="center" <? if($mes==12){?>style="background:rgb(68,68,68);"<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link" href="inicio.php?anio=<? echo $anio;?>&mes=12">DICIEMBRE</a></div></td>		
		</td>
	</tr>
	</tr>


</table>
<hr style="width:80%">
<div id="data">
<table align="center" width="85%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<? if ($_SESSION['permiso_s']==2) {
				?><th width="3%">Id</th><?
				}
				?>
		<th width="2%">Dia</th>
		<th width="10%">Responsable</th>
		<th width="10%">Actividad</th>
		<th width="10%">Razon Comercial</th>
		<th width="7%">Particularidad</th>
		<th align="center" width="4%">Avance</th>
		<th align="center" width="4%">Completado</th>
		<th width="3%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_responsable like '%$responsable%' and anio ='$anio' and id_mes = '$mes' and estatus = '1' ORDER BY dia");


?>

<?
	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr style="<?
			$dia = date('d');
			
			if ($reg['avance']==100) {
				$color=3;
				$finalizada_contador+=1;
			}elseif($reg['avance'] > 0 and $reg['anvace']  <100){
				$color=4;
				$proceso_contador+=1;
			}elseif($reg['dia']==$dia){
				$color=1;
				$dia_contador+=1;
			}elseif($reg['dia']<$dia){
				$color=2;
				$vecidos_contador+=1;
			}else{
				$color=5;
			
			}

			switch ($color) {
				case 1: echo " background:rgb(255,255,167);";break;
				case 2: echo " background:rgb(255,151,151);";break;
				case 3: echo " background:rgb(193,255,193);";break;
				case 4: echo " background:rgb(211,211,211);";break;
				case 5: echo " ";break;
			}
			?>">
				<? if ($_SESSION['permiso_s']==2) {
				?><td align="center" class="td"><? echo $reg['id_calendario'];?></td>
				<?}
				?>
				<td align="center" class="td"><? echo $reg['dia'];?></td>
				<td align="center" class="td">
				<? 
				$sql_responsable = mysql_query("SELECT concat(nombre,' ',a_paterno) as nombre FROM calendario_cc_responsables  WHERE id_responsable IN ($reg[id_responsable])");
				while ($res=mysql_fetch_array($sql_responsable)) {
					echo $res['nombre'].",";
				}
				
				?>

				</td>
				<td class="td"><? echo $reg['actividad'];?></td>
				<td class="td"><? echo utf8_encode($reg['razon_comercial']);?></td>
				<td class="td"><? echo $reg['particularidad'];?></td>
				<td align="center" class="td"><? echo $reg['avance'];?>%</td>	
				<?	
				if($reg['avance']==100){
				?>
				<td value="<?echo $reg['avance'];?>" align="center" style="cursor:pointer;" onclick="quitar(<? echo $reg['id_calendario'];?>)" style="cursor:pointer;"><div aling="center" style="height:22px;width:30px;border:3px solid black; background:white;"><img align="center" width="20" height="20" src="img/ico_aceptar.png"></div></td>
				<?
				}else{
				?>
				<td value="<?echo $reg['avance'];?>" align="center" style="cursor:pointer;" onclick="checkear(<? echo $reg['id_calendario'];?>)" style="cursor:pointer;">
				<div aling="center" style="height:22px;width:30px;border:3px solid black; background:white;"></div>
				</td>
				<?}?>
				<td align="center"><a href="ver.php?id=<? echo $reg['id_calendario'];?>&permisos=<? echo base64_encode($_SESSION['permiso_s']);?>&anio=<?echo $anio;?>&mes=<?echo $mes;?>&dia=<?echo $reg['dia'];?>" onclick="window.open(this.href,this.target,'width=750,height=620'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<? if($_SESSION['permiso_s']==2){?>
				<a href="eliminar_registro.php?id=<? echo $reg['id_calendario'];?>&opcion=admin" onclick="window.open(this.href,this.target,'width=500,height=230'); return false;" ><img alt="ELIMINAR" src="img/cancelar.png" style="border:none" width="22" height="22"></a><?
				}else{}?>	

				 </td>
			</tr>
	<?
		}

	?>

</table>
</div>
<br><br>

	<?
	if ($_SESSION['permiso_s']==2) {
		?>
		<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar_actividad.php?r=1" onclick="window.open(this.href,this.target,'width=700,height=600'); return false;" style="color:white; valign:botom; "> ASIGNAR NUEVA ACTIVIDAD</a></div>
	<?}else{
		?>
		<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar_actividad.php?r=2" onclick="window.open(this.href,this.target,'width=700,height=600'); return false;" style="color:white; valign:botom; "> AGREGAR NUEVA ACTIVIDAD</a></div>
		<?
	}
	?>
<div id="info" title="Informacion sobre los colores que componen la tabla de actividades">Informacion</div>
<div id="ver">
 <div align="right">
 	<div id="ocultar">X</div>
 </div>
 <div align="center" style="font-size:20px;">
 		Actividades del mes
 </div>
 <div>&nbsp;</div>
	 <table align="center" width="70%" border="0">
	 	<tr align="center" style="border:none">
	 		<th width="50%">Termino</td>
	 		<th width="25%">Total</td>
	 		<th width="25%">Color</td>
	 	</tr>
	 </table>
	  <table align="center" width="70%" border="0">
	 	<tr align="center" style="background:white;border:none;" >
	 		<td width="50%">En Proceso</td>
	 		<td width="25%"><? echo $proceso_contador;?></td>
	 		<td width="25%" style="background:rgb(211,211,211);"></td>
	 	</tr>
	 	<tr align="center" style="background:white;border:none;" >
	 		<td width="50%">Cubiertas</td>
	 		<td width="25%"><? echo $finalizada_contador;?></td>
	 		<td width="25%" style="background:rgb(193,255,193);"></td>
	 	</tr>
	 		<tr align="center" style="background:white;border:none;" >
	 		<td width="50%">Por Vencer</td>
	 		<td width="25%"><? echo $dia_contador;?></td>
	 		<td width="25%" style=" background:rgb(255,255,167);"></td>
	 	</tr>
	 	</tr>
	 		<tr align="center" style="background:white;border:none;" >
	 		<td width="50%">Vencidas</td>
	 		<td width="25%"><? echo $vecidos_contador;?></td>
	 		<td width="25%" style=" background:rgb(255,151,151);"></td>
	 	</tr>
	 </table>
</div>
</body>
<script language="javascript" type="text/javascript">
var props = {
		popup_filters: true,
		mark_active_columns: true,
		filters_row_index:1,
		remember_grid_values: false,
		remember_page_number: false,
		alternate_rows: true,
		rows_counter: true,
		btn_reset: true,
		btn_reset_text: "Monstrar todo",
		loader: true,		 
        loader_html: '<h4 style="color:red;">Cargando, por favor espere...</h4>',
		status_bar: true,
		col_number_format: [null,null,'US','US','US','US','US','US','US'],
	
		col_4: "select",
		col_5: "none",
		col_6: "none",
		col_2:"select",
		//col_width: ["40px","120px","120px","120px","40px","120px","120px","120px","120px"],
		paging: true,
		paging_length: 20,		
		//Grid layout properties
		selectable: true,
		grid_layout: false,
		grid_width: '80%',
		grid_height: '50%',
		
		/*** Extensions manager ***/
		
		btn_showHide_cols_text: 'Columns?'
	}
	setFilterGrid("tabla",props);
	</script>
<script type="text/javascript">
	function quitar(numero){
			$('body').append("<div id='confirmar'></div>");
			$('#confirmar').append("<div id='center' align='center'></div>");
			$('#center').append("<div id='confirmar_dos'></div>")
			$.ajax({
				url : 'confirmar.php',
				type : 'POST',
				cache : false ,
				data : "n=2&user=<?echo $user;?>&permiso=<? $_SESSION['permiso_s'];?>&id=" + numero +'&responsable=<? echo $responsable;?>&anio=<? echo $anio;?>&mes=<?echo $mes;?>' ,
				success : function(data){
					$('#confirmar_dos').html(data);
				}
			})
	}

		function checkear(numero){
			$('body').append("<div id='confirmar'></div>");
			$('#confirmar').append("<div id='center' align='center'></div>");
			$('#center').append("<div id='confirmar_dos'></div>")
			$.ajax({
				url : 'confirmar.php',
				type : 'POST',
				cache : false ,
				data : "n=1&user=<?echo $user;?>&permiso=<? $_SESSION['permiso_s'];?>&id=" + numero +'&responsable=<? echo $responsable;?>&anio=<? echo $anio;?>&mes=<?echo $mes;?>' ,
				beforeSend : function(){
					$('#confirmar_dos').html('Cargando...');
				},
				success : function(data){
					$('#confirmar_dos').html(data);
				}
			})
	}

	$('#cerrar').click(function(){
		$('#confirmar').remove();
	})
	
</script>

</html>
