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
	<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jsvalidation.css">
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
		var ListaHora = [
		"08:00",
		"08:30",
		"09:00",
		"09:30",
		"10:00",
		"10:30",
		"11:00",
		"11:30",
		"12:00",
		"12:30",
		"13:00",
		"13:30",
		"14:00",
		"14:30",
		"15:00",
		"15:30",
		"16:00",
		"16:30",
		"17:00",
		"17:30",
		"18:00",
		"18:30",
		"19:00",
		"19:30",
		"20:00",
		"20:30",
		];

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
 ?>
<?



 if(isset($guardar)) {
	$fecha_explide=explode("-", $fecha);
	$dia_n=$fecha_explide[0];
	$id_mes_nuevo=$fecha_explide[1];
	$anio_nuevo=$fecha_explide[2];

	
	
	mysql_query("INSERT INTO calendario_general (id_responsable,dia,id_mes,anio,id_area,id_actividad,id_clienteexterno,id_particularidad,hora) VALUES ('$id_responsable','$dia_n','$id_mes_nuevo', '$anio_nuevo','$id_area','$id_actividad','$id_clienteexterno','$id_particularidad','$hora')");
	$registro=mysql_insert_id();
	mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Agrego una Actividad <Datos> id: $registro   Aignada a: $id_responsable  Actividad: $id_actividad','$_SESSION[u_name]')");
	?>
	<br><br><br>
	<hr style="width:70%">
	 <div align="center"><h3 style="color:red">GUARDADO</h3></div>
	 <br><br>
	 <div align="center"><a href="javascript:window.opener.location.reload(); self.close();">CERRAR</a></div>
	 <br>
	 <hr style="width:70%">
	 <?
	}
	else{


		if($_GET['r']==1){
?>

<div id="contenedor" style="border-color:#ccc; border-radius=15px;)">
<form action="" method="post" name="datos" enctype="multipart/form-data">
	<div align="center"><img src="img/ci_logo.png"  width="65" heigth="65" align="left"><h2>DESCRIPCION DE LA ACTIVIDAD</h2></div>
	<hr style="width:80%">
		<table align="center" width="95%">
			<tr>
				<td height="15%" width="20%" align="right"> Asignado a : </td>
				<td align="left"><select style="width:85%" name="id_responsable">
					<option></option>
					<?
					$sql_user=mysql_query("SELECT id_responsable,nombre,a_paterno FROM calendario_cc_responsables");
					while ($reg_user=mysql_fetch_array($sql_user)) {
						?>
						<option value="<?echo $reg_user['id_responsable'];?>"><? echo $reg_user['nombre']." ".$reg_user['a_paterno'];?></option>
					<?
					
				}
				?></select></td>
				<script type="text/javascript">
						var id_responsable=new LiveValidation ('id_responsable');
						id_responsable.add( Validate.Presence );					

						</script>
				<td align="right"></td>
				<td align="left"></td>
				
			</tr>
			<tr>
				<td align="right" alig>Area : </td>
				<td align="left"><select name="id_area">
							<option></option>
								<?
								$sql_area=mysql_query("SELECT * FROM calendario_cc_areas");

								while ($reg_area=mysql_fetch_array($sql_area)) {
								?>
							<option value="<? echo $reg_area['id_area'];?>"><? echo $reg_area['area'];?></option>
								<?
								
							}?>
								</select>
					</td>
					<script type="text/javascript">
						var area=new LiveValidation ('area');
						id_area.add( Validate.Presence );					

						</script>
				<td align="left">Fecha:   
				<input id="datepicker" type="text" name="fecha" size="8" >
				Hora:
				<select name="hora">
					<option value="08:00">08:00</option>
					<option value="08:30">08:30</option>
					<option value="09:00">09:00</option>
					<option value="09:30">09:30</option>
					<option value="10:00">10:00</option>
					<option value="10:30">10:30</option>
					<option value="11:00">11:00</option>
					<option value="11:30">11:30</option>
					<option value="12:00">12:00</option>
					<option value="12:30">12:30</option>
					<option value="13:00">13:00</option>
					<option value="13:30">13:30</option>
					<option value="14:00">14:00</option>
					<option value="14:30">14:30</option>
					<option value="15:00">15:00</option>
					<option value="15:30">15:30</option>
					<option value="16:00">16:00</option>
					<option value="16:30">16:30</option>
					<option value="17:00">17:00</option>
					<option value="17:30">17:30</option>
					<option value="18:00">18:00</option>
					<option value="18:30">18:30</option>
					<option value="19:00">19:00</option>
					<option value="19:30">19:30</option>
					<option value="20:00">20:00</option>
					<option value="20:30">20:30</option>

				</select>
				</TD>
				<td></td>
			</tr>	
			
			</table>
			<hr style="width:80%">
			<table align="center" width="95%">
				<tr>
				<td colspan="2" align="center" alig><strong>Cliente Externo</strong>  </td>
				</tr>
				<td height="15%" width="20%" align="right">Razon Social</td><td align="left">
				<select name="id_clienteexterno">
					<option></option>
					<?
					$sql_cliente=mysql_query("SELECT * FROM calendario_cc_clientesexternos");
					while ($reg_cliente=mysql_fetch_array($sql_cliente)) {
					?>
								<option value="<? echo $reg_cliente['id_cliente_externo'];?>"><? echo $reg_cliente['razon_social'];?></option>
						<?
					}?>
				</select>
				<script type="text/javascript">
						var id_clienteexterno=new LiveValidation ('id_clienteexterno');
						id_clienteexterno.add( Validate.Presence );					

						</script>
				</td>
			</tr>	
			<tr>
				<td height="15%" width="20%" align="right"></td><td align="left"></td>
			</tr>

		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
				<tr>
				<td colspan="4" align="center" alig><strong>Actividad</strong>  </td>
				</tr>
				<td height="10%" width="24%" align="right">Actividad</td>
				<td colspan="3" width="25%" align="left">
					<select style="width:70%" name="id_actividad">
					<option></option>
						<?
						$sql_actividad=mysql_query("SELECT * FROM calendario_cc_actividades");
						while ($reg_actividad=mysql_fetch_array($sql_actividad)) {
						?>
						<option value="<? echo $reg_actividad['id_actividad'];?>"><?echo $reg_actividad['actividad'];?></option>

					<?	
					}
						?>
					</select>
					<script type="text/javascript">
						var id_actividad=new LiveValidation ('id_actividad');
						id_actividad.add( Validate.Presence );					

						</script>
				</td>
			</tr>	
			<tr>
				<td align="right"></td>
				<td width="19%" align="left"></td>
				<td align="right"></td>
				<td width="12%" align="left"></td>
			</tr>
			<tr>
				<td align="right">Observaciones: </td>
				<td colspan="3"><input name="observaciones" size="50" >
				</td>
			</tr>
			<tr>
				<td align="right">Particularidad: </td>
				<td colspan="3">
					<select name="id_particularidad">
						<?
						$sql_particularidad=mysql_query("SELECT * FROM calendario_cc_particularidad");
						while ($reg_particularidad=mysql_fetch_array($sql_particularidad)) {
						?>
						<option value="<? echo $reg_particularidad['id_particularidad'];?>"><? echo $reg_particularidad['particularidad'];?></option>
						<?
						
					}
						?>
					</select>
				</td>
			</tr>
		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
			<tr>
				<td height="10%" width="24%" align="right"></td>
				<td colspan="3" width="25%" align="left"></td>
			</tr>
			<tr>
				<td align="right"> </td>
				<td colspan="3"></td>
			</tr>
			<tr>
				 <td height="25"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="guardar" type="submit" value ="Guardar" </td>
				<td>
				</td>
				
			</tr>


		</table>
		

</div>
</form>
<?php
}else{
	$id=$_SESSION['id_responsable_s'];
	?>


<div id="contenedor" style="border-color:#ccc; border-radius=15px;)">
<form action="" method="post" name="datos" enctype="multipart/form-data">
	<div align="center"><img src="img/ci_logo.png"  width="65" heigth="65" align="left"><h2>DESCRIPCION DE LA ACTIVIDAD</h2></div>
	<hr style="width:80%">
		<table align="center" width="95%">
			<tr>
				<td height="15%" width="20%" align="right"> Asignado a : </td>
				<td align="left"><select style="width:85%" name="id_responsable">
					<?
					$sql_user=mysql_query("SELECT id_responsable,nombre,a_paterno FROM calendario_cc_responsables WHERE id_responsable = '$id'");
					while ($reg_user=mysql_fetch_array($sql_user)) {
						?>
						<option value="<?echo $reg_user['id_responsable'];?>"><? echo $reg_user['nombre']." ".$reg_user['a_paterno'];?></option>
					<?
					
				}
				?></select></td>
				<script type="text/javascript">
						var id_responsable=new LiveValidation ('id_responsable');
						id_responsable.add( Validate.Presence );					

						</script>
				<td align="right"></td>
				<td align="left"></td>
				
			</tr>
			<tr>
				<td align="right" alig>Area : </td>
				<td align="left"><select name="id_area">
							<option></option>
								<?
								$sql_area=mysql_query("SELECT * FROM calendario_cc_areas");

								while ($reg_area=mysql_fetch_array($sql_area)) {
								?>
							<option value="<? echo $reg_area['id_area'];?>"><? echo $reg_area['area'];?></option>
								<?
								
							}?>
								</select>
					</td>
					<script type="text/javascript">
						var area=new LiveValidation ('area');
						id_area.add( Validate.Presence );					

						</script>
				<td align="left">Fecha:   
				<input id="datepicker" type="text" name="fecha" size="8" >
				Hora:
				<select name="hora">
					<option value="08:00">08:00</option>
					<option value="08:30">08:30</option>
					<option value="09:00">09:00</option>
					<option value="09:30">09:30</option>
					<option value="10:00">10:00</option>
					<option value="10:30">10:30</option>
					<option value="11:00">11:00</option>
					<option value="11:30">11:30</option>
					<option value="12:00">12:00</option>
					<option value="12:30">12:30</option>
					<option value="13:00">13:00</option>
					<option value="13:30">13:30</option>
					<option value="14:00">14:00</option>
					<option value="14:30">14:30</option>
					<option value="15:00">15:00</option>
					<option value="15:30">15:30</option>
					<option value="16:00">16:00</option>
					<option value="16:30">16:30</option>
					<option value="17:00">17:00</option>
					<option value="17:30">17:30</option>
					<option value="18:00">18:00</option>
					<option value="18:30">18:30</option>
					<option value="19:00">19:00</option>
					<option value="19:30">19:30</option>
					<option value="20:00">20:00</option>
					<option value="20:30">20:30</option>

				</select>
				</TD>
				<td></td>
			</tr>	
			
			</table>
			<hr style="width:80%">
			<table align="center" width="95%">
				<tr>
				<td colspan="2" align="center" alig><strong>Cliente Externo</strong>  </td>
				</tr>
				<td height="15%" width="20%" align="right">Razon Social</td><td align="left">
				<select name="id_clienteexterno">
					<option></option>
					<?
					$sql_cliente=mysql_query("SELECT * FROM calendario_cc_clientesexternos");
					while ($reg_cliente=mysql_fetch_array($sql_cliente)) {
					?>
								<option value="<? echo $reg_cliente['id_cliente_externo'];?>"><? echo $reg_cliente['razon_social'];?></option>
						<?
					}?>
				</select>
				<script type="text/javascript">
						var id_clienteexterno=new LiveValidation ('id_clienteexterno');
						id_clienteexterno.add( Validate.Presence );					

						</script>
				</td>
			</tr>	
			<tr>
				<td height="15%" width="20%" align="right"></td><td align="left"></td>
			</tr>

		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
				<tr>
				<td colspan="4" align="center" alig><strong>Actividad</strong>  </td>
				</tr>
				<td height="10%" width="24%" align="right">Actividad</td>
				<td colspan="3" width="25%" align="left">
					<select style="width:70%" name="id_actividad">
					<option></option>
						<?
						$sql_actividad=mysql_query("SELECT * FROM calendario_cc_actividades");
						while ($reg_actividad=mysql_fetch_array($sql_actividad)) {
						?>
						<option value="<? echo $reg_actividad['id_actividad'];?>"><?echo $reg_actividad['actividad'];?></option>

					<?	
					}
						?>
					</select>
					<script type="text/javascript">
						var id_actividad=new LiveValidation ('id_actividad');
						id_actividad.add( Validate.Presence );					

						</script>
				</td>
			</tr>	
			<tr>
				<td align="right"></td>
				<td width="19%" align="left"></td>
				<td align="right"></td>
				<td width="12%" align="left"></td>
			</tr>
			<tr>
				<td align="right">Observaciones: </td>
				<td colspan="3"><input name="observaciones" size="50" >
				</td>
			</tr>
			<tr>
				<td align="right">Particularidad: </td>
				<td colspan="3">
					<select name="id_particularidad">
						<?
						$sql_particularidad=mysql_query("SELECT * FROM calendario_cc_particularidad");
						while ($reg_particularidad=mysql_fetch_array($sql_particularidad)) {
						?>
						<option value="<? echo $reg_particularidad['id_particularidad'];?>"><? echo $reg_particularidad['particularidad'];?></option>
						<?
						
					}
						?>
					</select>
				</td>
			</tr>
		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
			<tr>
				<td height="10%" width="24%" align="right"></td>
				<td colspan="3" width="25%" align="left"></td>
			</tr>
			<tr>
				<td align="right"> </td>
				<td colspan="3"></td>
			</tr>
			<tr>
				 <td height="25"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="guardar" type="submit" value ="Guardar" </td>
				<td>
				</td>
				
			</tr>


		</table>
		

</div>
</form>

<?
}
}
?>
</body>
</html>