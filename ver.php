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
} ?>
<?
$permiso=base64_decode($permisos);


if($permiso==1){
	if (isset($guardar)) {

		$tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
    $extension = explode('.',$archivo); 
    $sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
	$reg=mysql_fetch_array($sql_datos);

    $prefijo = substr(md5(uniqid(rand())),0,6);
    if ($archivo != "") {
      // guardamos el archivo a la carpeta files
      $destino =  "data/".$reg['id_responsable']."/".$reg['id_calendario'].".".$extension[1];
       if (copy($_FILES['archivo']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo."</b>";
       } else {
           $status = "Error al subir el archivo";
        }
    } else {
        $status = "";
    }
    	$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
    	$reg=mysql_fetch_array($sql_datos);

    	if ($reg['avance']==$avance) {
    		$avance_a="";    	}
    		else{$avance_a = "Anvance :  $avance";		}
    	if ($reg['observaciones']==$observaciones) {
    		$observaciones_a="";   	}
    		else{$observaciones_a= "  Observerciones  : $observaciones  "; }

    	if ($reg['fecha_cumplimiento']==$fecha_completado) {    
    		$fecha_completado_a="";	}	
    		else{
    			$fecha_completado_a = "   Fecha Cumplimiento : $fecha_completado";
    		}		

    	if ($reg['avance']==$avance and $reg['observaciones']==$observaciones and $reg['fecha_cumplimiento']==$fecha_completado) {
    		
    	}else{
    		mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actulizo la tabla  ACITVIDADES  <DATOS>   $avance_a    $observaciones_a  $fecha_completado_a  ','$_SESSION[u_name]')");
    	}
   	
		
	mysql_query("UPDATE calendario_general SET avance = '$avance', observaciones = '$observaciones', fecha_cumplimiento = '$fecha_completado',ruta_archivo = '$destino', hora = '$hora' WHERE id_calendario = '$id'");	}
	$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
	$reg=mysql_fetch_array($sql_datos);
?>
<div id="contenedor" style="border-color:#ccc; border-radius=15px; text-shadow:5px 5px 10px rgba(0,0,0,0.3>
<form action="" method="post" name="datos" enctype="multipart/form-data">
	<div align="center"><img src="img/ci_logo.png"  width="65" heigth="65" align="left"><h2>DESCRIPCION DE LA ACTIVIDAD</h2></div>
	<hr style="width:80%">
		<table align="center" width="95%">
			<tr>
				<td height="15%" width="20%" align="right"> Asignado a : </td>
				<td align="left"><input type="text" readonly="readonly" size="25" value="<? echo $reg['nombre'];?>"></td>
				<td align="right">ID actividad:</td>
				<td align="left"><input type="text" size="8" value="<? echo $reg['id_calendario'];?>" readonly="readonly"></td>
				
			</tr>
			<tr>
				<td align="right" alig>Area : </td>
				<td align="left"><input type="text" size="25" value="<? echo $reg['area'];?>" readonly="readonly"></td>
				<td align="left" colspan="2">Fecha:   
				<input  type="text" name="fecha" readonly="readonly" size="8" value="<? echo $reg['dia']."-".$reg['id_mes']."-".$reg['anio'];?>">
				Hora: 
				<select name="hora">
					<option value="00:00">00:00</option>
					<?
					for($x=0; $x <= count($horas); $x++)
						if ($horas[$x]==$reg['hora']) {
					?>
					<option selected="selected" value="<? echo $horas[$x];?>"><? echo $horas[$x];?></option>
					<?
						}else{
					?>
					<option value="<? echo $horas[$x];?>"><? echo $horas[$x];?></option>
					<?
						}
					?>

				</select>
				</td>
			</tr>	
			
			</table>
			<hr style="width:80%">
			<table align="center" width="95%">
				<tr>
				<td colspan="2" align="center" alig><strong>Cliente Externo</strong>  </td>
				</tr>
				<td height="15%" width="20%" align="right">Razon Social</td><td align="left"><input type="text" size="75" value="<? echo $reg['razon_social'];?>" readonly="readonly"></td>
			</tr>	
			<tr>
				<td height="15%" width="20%" align="right">Razon Comercial</td><td align="left"><input type="text" size="25" value="<? echo $reg['razon_comercial'];?>" readonly="readonly"></td>
			</tr>

		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
				<tr>
				<td colspan="4" align="center" alig><strong>Actividad</strong>  </td>
				</tr>
				<td height="10%" width="24%" align="right">Actividad</td>
				<td colspan="3" width="25%" align="left"><input type="text" size="45" value="<? echo $reg['actividad'];?>" readonly="readonly"></td>
			</tr>	
			<tr>
				<td align="right">Avance:</td>
				<td width="19%" align="left"> <input name="avance" <?if($reg['avance']==100){?>readonly="readonly"<?}?> value="<?echo $reg['avance'];?>" <?if($reg['avance'] !=100){?> onkeyup="completado()" <?}?> type="text" size="2">%</td>
				<td align="left"></td>
				<td width="12%" align="left"></td>
			</tr>
			<tr>
				<td align="right">Observaciones: </td>
				<td colspan="3"><input name="observaciones" size="50" value="<? echo $reg['observaciones'];?>"
				</td>
			</tr>
			<tr>
				<td align="right">Particularidad: </td>
				<td colspan="3"><input type="text" name="paticularidad" readonly="readonly" value="<? echo $reg['particularidad'];?>"></td>
			</tr>
		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
			<tr>
				<td height="10%" width="24%" align="right">Subir Archvio: </td>
				<td colspan="3" width="25%" align="left"><?if (file_exists($reg['ruta_archivo'])) {
					?><a href="<?echo $reg['ruta_archivo'];?>">VER</a><?
				}else{?><input name="archivo" type="file"><?}?></td>
			</tr>
			<tr>
				<td align="right">Fecha de Termino: </td>
				<td colspan="3"><input name="fecha_completado" type="text" value="<? echo date('Y-m-d H:i:s',time());?>" disabled="disabled"></td>
			</tr>
			<tr>
				 <td height="25"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="guardar" type="submit" value ="Guardar">
				<a href="javascript:window.opener.location.reload(); self.close();">Cerrar</a> </td>
				<td><?
				if(isset($guardar)){

					?>
					<div align="center" style="color:red;">GUARDADO<br><?echo $status;?></div>
<?
				}
				?></td>
				
			</tr>
		<input type="hidden" value="data/<?echo $reg['id_responsable']?>/<?echo $reg['id_calendario'];?>" name="ruta_archivo">



		</table>

</div>
<input type="hidden" value="data/<?echo $reg['id_responsable']?>/" name="ruta_archivo">
</form>
<?php
}
elseif($permiso==2){
if (isset($guardar)) {

	$fecha_explide=explode("-", $fecha);
	$dia_n=$fecha_explide[0];
	$id_mes_nuevo=$fecha_explide[1];
	$anio_nuevo=$fecha_explide[2];

	$tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
    $extension = explode('.',$archivo); 
    $sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
	$reg=mysql_fetch_array($sql_datos);

    $prefijo = substr(md5(uniqid(rand())),0,6);
    if ($archivo != "") {
      // guardamos el archivo a la carpeta files
      $destino =  "data/".$reg['id_responsable']."/".$reg['id_calendario'].".".$extension[1];
       if (copy($_FILES['archivo']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo."</b>";
       } else {
           $status = "Error al subir el archivo";
        }
    } else {
        $status = "";
    }
   
   		$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
   		$reg=mysql_fetch_array($sql_datos);


    	if ($reg['avance']==$avance) {
    		$avance_a="";    	}
    		else{$avance_a = "Anvance :  $avance";		}
    	if ($reg['observaciones']==$observaciones) {
    		$observaciones_a="";   	}
    		else{$observaciones_a= "  Observerciones  : $observaciones  "; }

    	if ($reg['fecha_cumplimiento']==$fecha_completado) {    
    		$fecha_completado_a="";	}	
    		else{
    			$fecha_completado_a = "   Fecha Cumplimiento : $fecha_completado";
    		}		

    	if ($reg['id_responsable']==$id_responsable) {
    		
    	}

    	if ($reg['avance']==$avance and $reg['observaciones']==$observaciones and $reg['fecha_cumplimiento']==$fecha_completado) {
    		
    	}else{
    		mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actualizo la tabla  ACITVIDADES  <DATOS>   $avance_a    $observaciones_a  $fecha_completado_a  ','$_SESSION[u_name]')");
    	}

	
		
	mysql_query("UPDATE calendario_general SET id_responsable='$id_responsable', dia='$dia_n', id_mes='$id_mes_nuevo', anio = '$anio_nuevo',id_area = '$id_area',id_actividad = '$id_actividad', id_clienteexterno ='$id_clienteexterno',id_particularidad= '$id_particularidad', avance = '$avance', observaciones = '$observaciones', fecha_cumplimiento = '$fecha_completado',ruta_archivo='$destino', hora = '$hora' WHERE id_calendario = '$id'");
	}
	$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_calendario = '$id'");	
	$reg=mysql_fetch_array($sql_datos);
?>

<div id="contenedor" style="border-color:#ccc; border-radius=15px; text-shadow:5px 5px 10px rgba(0,0,0,0.3)">
<form action="" method="post" name="datos" enctype="multipart/form-data">
	<div align="center"><img src="img/ci_logo.png"  width="65" heigth="65" align="left"><h2>DESCRIPCION DE LA ACTIVIDAD</h2></div>
	<hr style="width:80%">
		<table align="center" width="95%">
			<tr>
				<td height="15%" width="20%" align="right"> Asignado a : </td>
				<td align="left"><select name="id_responsable"><?
					$sql_user=mysql_query("SELECT id_responsable,nombre,a_paterno FROM calendario_cc_responsables");
					while ($reg_user=mysql_fetch_array($sql_user)) {
						if ($reg['id_responsable']==$reg_user['id_responsable']) {
					?><option selected="selected" value="<?echo $reg_user['id_responsable'];?>"><? echo $reg_user['nombre']." ".$reg_user['a_paterno'];?></option>
						<?}else{?>
						<option value="<?echo $reg_user['id_responsable'];?>"><? echo $reg_user['nombre']." ".$reg_user['a_paterno'];?></option>
					<?
					}
				}
				?></select></td>
				<td align="right">ID Actividad:</td>
				<td align="left"><input type="text" size="8" value="<? echo $reg['id_calendario'];?>" readonly="readonly"></td>
				
			</tr>
			<tr>
				<td align="right" alig>Area : </td>
				<td align="left"><select name="id_area">
								<?
								$sql_area=mysql_query("SELECT * FROM calendario_cc_areas");

								while ($reg_area=mysql_fetch_array($sql_area)) {
							if ($reg_area['id_area']==$reg['id_area']) {
							?><option selected="selected" value="<? echo $reg_area['id_area'];?>"><? echo $reg_area['area'];?></option>
							<?}else{?>
							<option value="<? echo $reg_area['id_area'];?>"><? echo $reg_area['area'];?></option>
								<?
								}
							}?>
								</select>
					</td>
				<td align="left" colspan="2">Fecha:   
				<input id="datepicker" type="text" name="fecha" size="8" value="<? echo $reg['dia']."-".$reg['id_mes']."-".$reg['anio'];?>">
				Hora: 
				<select name="hora">
					<option value="00:00">00:00</option>
					<?
					for($x=0; $x <= count($horas); $x++)
						if ($horas[$x]==$reg['hora']) {
					?>
					<option selected="selected" value="<? echo $horas[$x];?>"><? echo $horas[$x];?></option>
					<?
						}else{
					?>
					<option value="<? echo $horas[$x];?>"><? echo $horas[$x];?></option>
					<?
						}
					?>

				</select>
				</td>
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
					<?
					$sql_cliente=mysql_query("SELECT * FROM calendario_cc_clientesexternos");
					while ($reg_cliente=mysql_fetch_array($sql_cliente)) {
					if ($reg_cliente['id_cliente_externo']==$reg['id_clienteexterno']) {
					
				?><option selected="selected" value="<? echo $reg_cliente['id_cliente_externo'];?>"><? echo $reg_cliente['razon_social'];?></option>
						<?}else{?>
								<option value="<? echo $reg_cliente['id_cliente_externo'];?>"><? echo $reg_cliente['razon_social'];?></option>
						<?}
					}?>
				</select>
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
					<select name="id_actividad">
						<?
						$sql_actividad=mysql_query("SELECT * FROM calendario_cc_actividades");
						while ($reg_actividad=mysql_fetch_array($sql_actividad)) {
						if ($reg_actividad['id_actividad']==$reg['id_actividad']) {
						?>
				<option selected="selected" value="<? echo $reg_actividad['id_actividad'];?>"><?echo $reg_actividad['actividad'];?></option>
						<?}else{?>
						<option value="<? echo $reg_actividad['id_actividad'];?>"><?echo $reg_actividad['actividad'];?></option>

					<?	}
					}
						?>
					</select>
				</td>
			</tr>	
			<tr>
				<td align="right">Avance:</td>
				<td width="19%" align="left"><input name="avance" <?if($reg['avance']==100){?>readonly="readonly"<?}?> value="<?echo $reg['avance'];?>" <?if($reg['avance'] !=100){?> onkeyup="completado()" <?}?> type="text" size="2">%</td>
				<td align="right"></td>
				<td width="12%" align="left"></td>
			</tr>
			<tr>
				<td align="right">Observaciones: </td>
				<td colspan="3"><input name="observaciones" size="50" value="<? echo $reg['observaciones'];?>"
				</td>
			</tr>
			<tr>
				<td align="right">Particularidad: </td>
				<td colspan="3">
					<select name="id_particularidad">
						<?
						$sql_particularidad=mysql_query("SELECT * FROM calendario_cc_particularidad");
						while ($reg_particularidad=mysql_fetch_array($sql_particularidad)) {
						if ($reg_particularidad['id_particularidad']==$reg['id_particularidad']) {
			?><option selected="selected" value="<? echo $reg_particularidad['id_particularidad'];?>"><? echo $reg_particularidad['particularidad'];?></option>
						<?}else{?>
						<option value="<? echo $reg_particularidad['id_particularidad'];?>"><? echo $reg_particularidad['particularidad'];?></option>
						<?
						}
					}
						?>
					</select>
				</td>
			</tr>
		</table>
		<hr style="width:80%">
			<table align="center" width="95%" border="0">
			<tr>
				<td height="10%" width="24%" align="right">Subir Archvio: </td>
				<td colspan="3" width="25%" align="left"><?if (file_exists($reg['ruta_archivo'])) {
					?><a style="text-decoration:none" href="<?echo $reg['ruta_archivo'];?>">Ver</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <a style="text-decoration:none;color:red;" href="eliminar.php?id=<? echo $reg['id_calendario'];?>&ruta=<?echo $reg['ruta_archivo'];?>" onclick="window.open(this.href,this.target,'width=150,height=120'); window.close();">Eliminar</a><?
				}else{?><input name="archivo" type="file"><?}?></td>
			</tr>
			<tr>
				<td align="right">Fecha de Termino: </td>
				<td colspan="3"><input name="fecha_completado" type="text" value="<? echo date('Y-m-d H:i:s',time());?>" disabled="disabled"></td>
			</tr>
			<tr>
				 <td height="25"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input name="guardar" type="submit" value ="Guardar">
				<br>
				<a href="javascript:window.opener.location.reload(); self.close();">Cerrar</a> </td>
				<td><?
				if(isset($guardar)){

					?>
					<div align="center" style="color:red;">GUARDADO<br><? echo $status;?></div>
<?
				}
				?></td>
				
			</tr>


		</table>
		<input type="hidden" value="data/<?echo $reg['id_responsable']?>/<?echo $reg['id_calendario'];?>" name="ruta_archivo">

</div>
</form>
<?php
}
?>
</body>
</html>