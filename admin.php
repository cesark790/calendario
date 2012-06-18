<?include("top.php");?>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<link rel="stylesheet" type="text/css" href="tabla/filtergrid.css">
	<title>.::Calendario Actividades CI::.</title>
	<script language="JavaScript" > 
<!-- 
window.onerror = new Function("return true") 
//--> 
</script>  

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
	if (!(isset($opcion))) {
		$opcion=1;
	}
 ?>
<div align="left"><img src="img/ci_logo.png" ></div>

<div style="position:absolute;right:0px;top:0px;font-size:16px;font-family: 'Prosto One', sans-serif;">BIENVENIDO  <? echo $_SESSION['nombre_s']." ".$_SESSION['a_paterno'];?> <a href="salir.php" style="text-decoraction:none;color:rgb(127,37,255);font-size:12px;">(Salir)</a> 	<?php if($_SESSION['permiso_s']==2){?><a href="inicio.php" style="text-decoraction:none">Inicio</a><?}?>   <br><p style="font-size:13px;text-align:right"><?echo date("d/m/Y");?></p></div>
<div align="center" style="font-weight:bold;margin:50px 25%;position:absolute;top:0px;font-size:30px;font-family: 'Prosto One', sans-serif;width:50%; vertical-align:bottom;">CALENDARIO DE ACTIVIDADES<br><br> ADMINISTRADOR</div>
<br><br><br><br>
<table align="center" width="85%" border="0" cellpading="0" cellspacing="0">

	
	<tr style="background:rgb(117,117,117); color:white;font-family: 'Krona One', sans-serif;">
		<td width="6%" align="center" <? if($opcion==1){?>style="background:rgb(68,68,68); "<?}?>  height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?>&opcion=1">Control Usuarios</a></div></td>
		<td width="7%" align="center" <? if($opcion==2){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?>&opcion=2">Control de Actividades</a></div></td>
		<td width="6%" align="center" <? if($opcion==3){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?>&opcion=3">Control de Areas</a></div></td>
		<td width="6%" align="center" <? if($opcion==4){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?anio=<? echo $anio;?>&opcion=4">Control Clientes Externos</a></div></td>
		<td width="5%" align="center" <? if($opcion==5){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?anio=<? echo $anio;?>&opcion=5">Control de Particularidad</a></div></td>
		<td width="6%" align="center" <? if($opcion==6){?>style="background:rgb(68,68,68); "<?}?> height="45"><div style="font-size:11px;font-family: 'Prosto One', sans-serif;"><a class="link_dos" href="admin.php?anio=<? echo $anio;?>&opcion=6"></a></div></td>
		</td>
	</tr>
</table>
<hr style="width:75%">

<?if ($opcion==1) {
?>
<table align="center" width="85%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<th width="2%">Id</th>
		<th width="25%">Nombre Completo</th>
		<th width="15%">Usuario</th>
		<th width="15%">Privilegios</th>
		<th width="15%">Area</th>
		<th width="3%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT cr.id_responsable,CONCAT(cr.nombre,' ' , cr.a_paterno) as nombre,cp.privilegio ,cr.privilegios as id_privilegio, cr.uname,cr.pass,em.nombre_empresa,ca.area FROM calendario_cc_responsables cr INNER JOIN calendario_cc_privilegios cp ON cp.id_privilegio = cr.privilegios INNER JOIN empresas em ON em.id_empresa = cr.empresa INNER JOIN calendario_cc_areas ca ON  ca.id_area = cr.id_area ");


	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr>
				<td align="center" class="td"><? echo $reg['id_responsable'];?></td>
				<td align="center" class="td"><? echo $reg['nombre'];?></td>
				<td align="center" class="td"><? echo $reg['uname'];?></td>
				<td align="center" class="td"><? echo $reg['privilegio'];?></td>
				<td align="center" class="td"><? echo $reg['area'];?></td>
				<td align="center"><a href="modificar.php?id=<? echo $reg['id_responsable'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<a href="eliminar_registro.php?id=<? echo $reg['id_responsable'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=400,height=130'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="ELIMINAR"<?}?> src="img/cancelar.png" style="border:none" width="22" height="22"></a>	
				 </td>
			</tr>
	<?
		}

	?>
	

</table>
<br><br>
<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar.php?opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" style="color:white;"> AGREGAR USUARIO</a></div>
<?}?>


<?if ($opcion==2) {
?>
<table align="center" width="55%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<th width="10%">Id</th>
		<th width="45%">Actividad</th>
		<th width="30%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT id_actividad,actividad FROM calendario_cc_actividades ");

	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr>
				<td align="center" class="td"><? echo $reg['id_actividad'];?></td>
				<td align="center" class="td"><? echo $reg['actividad'];?></td>
				<td align="center"><a href="modificar.php?id=<? echo $reg['id_actividad'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<a href="eliminar_registro.php?id=<? echo $reg['id_actividad'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=400,height=130'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="ELIMINAR"<?}?> src="img/cancelar.png" style="border:none" width="22" height="22"></a>

				 </td>
			</tr>
	<?
		}

	?>
	

</table>
<br><br>
<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar.php?opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" style="color:white;"> AGREGAR ACTIVIDAD</a></div>
<?}?>

<?if ($opcion==3) {
?>
<table align="center" width="55%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<th width="10%">Id</th>
		<th width="45%">Area</th>
		<th width="30%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT id_area,area FROM calendario_cc_areas ");

	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr>
				<td align="center" class="td"><? echo $reg['id_area'];?></td>
				<td align="center" class="td"><? echo $reg['area'];?></td>
				<td align="center"><a href="modificar.php?id=<? echo $reg['id_area'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<a href="eliminar_registro.php?id=<? echo $reg['id_area'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=400,height=130'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="ELIMINAR"<?}?> src="img/cancelar.png" style="border:none" width="22" height="22"></a>

				 </td>
			</tr>
	<?
		}

	?>
	

</table>
<br><br>
<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar.php?opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" style="color:white;"> AGREGAR AREA</a></div>
<?}?>




<?if ($opcion==4) {
?>
<table align="center" width="85%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<th width="10%">Id</th>
		<th width="30%">Razon Social</th>
		<th width="30%">Razon Comercial</th>
		<th width="10%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT id_cliente_externo,razon_social,razon_comercial FROM calendario_cc_clientesexternos ");

	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr>
				<td align="center" class="td"><? echo $reg['id_cliente_externo'];?></td>
				<td align="center" class="td"><? echo $reg['razon_social'];?></td>
				<td align="center" class="td"><? echo $reg['razon_comercial'];?></td>
				<td align="center"><a href="modificar.php?id=<? echo $reg['id_cliente_externo'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<a href="eliminar_registro.php?id=<? echo $reg['id_cliente_externo'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=400,height=130'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="ELIMINAR"<?}?> src="img/cancelar.png" style="border:none" width="22" height="22"></a>

				 </td>
			</tr>
	<?
		}

	?>
	

</table>
<br><br>
<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar.php?opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" style="color:white" > AGREGAR CLIENTE</a></div>
<?}?>






<?if ($opcion==5) {
?>
<table align="center" width="55%" border="0" id="tabla">
	<tr style="font-size:12px;">
		<th width="10%">Id</th>
		<th width="30%">Particularidad</th>
		<th width="10%">Opciones</th>
	</tr>
	<?
	if ($_SESSION['permiso_s']==2) {
		$responsable=$user;
	}else{
		$responsable=$_SESSION['id_responsable_s'];
	}

	$sql_datos=mysql_query("SELECT id_particularidad,particularidad FROM calendario_cc_particularidad ");

	while ($reg=mysql_fetch_array($sql_datos)) {
		?>
			<tr>
				<td align="center" class="td"><? echo $reg['id_particularidad'];?></td>
				<td align="center" class="td"><? echo $reg['particularidad'];?></td>
				<td align="center"><a href="modificar.php?id=<? echo $reg['id_particularidad'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="Modificar"<?}?> src="img/clasificaciones.png" style="border:none" width="22" height="22"></a>
				<a href="eliminar_registro.php?id=<? echo $reg['id_particularidad'];?>&opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=400,height=130'); return false;" ><img <?if($_SESSION['permiso_s']==1){?>alt="Ver"<?} elseif($_SESSION['permiso_s']==2){?>alt="ELIMINAR"<?}?> src="img/cancelar.png" style="border:none" width="22" height="22"></a>

				 </td>
			</tr>
	<?
		}

	?>
	

</table>
<br><br>
<div align="center" style="background:rgb(117,117,117); width:100%; color:white; height:40px"><a href="agregar.php?opcion=<? echo $opcion;?>" onclick="window.open(this.href,this.target,'width=500,hegiht=700'); return false;" style="color:white;" > AGREGAR PARTICULARIDAD</a></div>
<?}?>



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
	
		
		//col_width: ["40px","120px","120px","120px","40px","120px","120px","120px","120px"],
		paging: true,
		paging_length: 10,		
		//Grid layout properties
		selectable: true,
		grid_layout: false,
		grid_width: '80%',
		grid_height: '50%',
		
		/*** Extensions manager ***/
		extensions: { 
			/*** Columns Visibility Manager extension load ***/	
			name:['ColsVisibility'], 
			src:['TFExt_ColsVisibility/TFExt_ColsVisibility.js'], 
			description:['Show/hide columns'],
			initialize:[function(o){o.SetColsVisibility('ColsVisibility');}] 
		},
		btn_showHide_cols_text: 'Columns?'
	}
	setFilterGrid("tabla",props);
	</script>
</html>