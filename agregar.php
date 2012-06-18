<?include("top.php");?>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Prosto+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/estilos_principales.css">
	<script type="text/javascript" src="tabla/tablefilter_compressed.js"></script>
	<script type="text/javascript" src="js/livevalidation_standalone.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jsvalidation.css">
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
		background:rgb(255,223,87)
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

if ($opcion==1) {
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>DATOS DEL NUEVO USUARIO</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Nombre</td><td width="65%"><input type="text" size="25" name="nombre_insertar"></td>
				<script type="text/javascript">
						var nombre=new LiveValidation ('nombre_insertar');
						nombre.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="15%">Apellido Paterno</td><td width="15%"><input name="a_paterno" size="25"></td>
				<script type="text/javascript">
						var a_paterno=new LiveValidation ('a_paterno');
						a_paterno.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="15%">Apellido Materno</td><td width="15%"><input name="a_materno" size="25"></td>
				<script type="text/javascript">
						var a_materno=new LiveValidation ('a_materno');
						a_materno.add( Validate.Presence );							
						</script>
			</tr>
		</table>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Nombre Usuario</td><td width="65%"><input name="uname" size="25"></td>
				<script type="text/javascript">
						var uname=new LiveValidation ('uname');
						uname.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="30%">Password</td><td width="65%"><input name="pass" size="25"></td>
				<script type="text/javascript">
						var pass=new LiveValidation ('pass');
						pass.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="30%">Privilegios</td><td width="65%">
				<select name="privilegios">
					<option></option>
					<?
					$sql_privilegios=mysql_query("SELECT * FROM calendario_cc_privilegios");
					while ($reg_privilegios=mysql_fetch_array($sql_privilegios)) {
				?><option value="<?echo $reg_privilegios['id_privilegio'];?>"><? echo $reg_privilegios['privilegio'];?></option>
				<?
					}
					?>

				</select>
				<script type="text/javascript">
						var privilegios=new LiveValidation ('privilegios');
						privilegios.add( Validate.Presence );
							

						</script>

				</td>
			</tr>
		</table>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
				<tr>
				<td align="right" width="30%">Area</td><td width="65%">
				<select name="id_area">
					<option></option>
					<?
					$sql_areas=mysql_query("SELECT * FROM calendario_cc_areas");
					while ($reg_areas=mysql_fetch_array($sql_areas)) {
				?><option value="<?echo $reg_areas['id_area'];?>"><? echo $reg_areas['area'];?></option>
				<?
					}
					?>

				</select>
				<script type="text/javascript">
						var id_area=new LiveValidation ('id_area');
						id_area.add( Validate.Presence );
							

						</script>

				</td>
			</tr>
			<tr>
				<td align="right" width="30%">Empresa</td><td width="65%">
				<select style="width:250px;"  name="empresa">
					<option></option>
					<?
					$sql_empresas=mysql_query("SELECT * FROM empresas");
					while ($reg_empresas=mysql_fetch_array($sql_empresas)) {
				?><option value="<? echo $reg_empresas['Id_empresa'];?>"><? echo $reg_empresas['nombre_empresa']; ?></option>
				<?
					}
					?>

				</select>
				<script type="text/javascript">
						var empresa=new LiveValidation ('empresa');
						empresa.add( Validate.Presence );
							

						</script>
				</td>
			</tr>
			</tr>
		</table>
		<br>
		<div align="center"><input type="submit" value="Guardar" name="guardar">  </div>
		<br><br>
		<?
		if (isset($guardar)) {
			mysql_query("INSERT INTO calendario_cc_responsables(nombre,a_paterno,a_materno,uname,pass,privilegios,id_area,empresa) VALUES ('$nombre_insertar','$a_paterno','$a_materno','$uname','$pass','$privilegios','$id_area','$empresa')");
			mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Agrego a un Nuevo Usuario <DATOS>  Nombre:$nombre_insertar   Usuario:$uname   Privilegios:   $privilegios','$_SESSION[u_name]')");
			?>
			<div align="center" style="color:red;">GUARDADO<br><a href="javascript:window.opener.location.reload(); self.close();">Cerrar</a></div>
			<?
		}
		?>
	</form>
	</div>

<?
}
?>
<?
if ($opcion==2) {
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>DATOS DE LA ACTIVIDAD</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Actividad</td><td width="65%"><input type="text" size="25" name="actividad"></td>
				<script type="text/javascript">
						var actividad=new LiveValidation ('actividad');
						actividad.add( Validate.Presence );
						</script>
			</tr>
		</table>
		<br>
		<div align="center"><input type="submit" value="Guardar" name="guardar"> </div>
		<br><br>
		<?
		if (isset($guardar)) {
			mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Agrego una Nueva Actividad <DATOS>  Actividad:$actividad','$_SESSION[u_name]')");
			mysql_query("INSERT INTO calendario_cc_actividades(actividad) VALUES ('$actividad')");
			?>
			<div align="center" style="color:red;">GUARDADO<br><br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">CERRAR</a></div>
			<?
		}
		?>
	</form>
	</div>

<?
}
?>

<?
if ($opcion==3) {
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>DATOS DE LA AREA</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Area</td><td width="65%"><input type="text" size="25" name="area"></td>
				<script type="text/javascript">
						var area=new LiveValidation ('area');
						area.add( Validate.Presence );
						</script>
			</tr>
		</table>
		<br>
		<div align="center"><input type="submit" value="Guardar" name="guardar"> </div>
		<br><br>
		<?
		if (isset($guardar)) {
				mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Agrego una Nueva Area  <DATOS>  Area:$area','$_SESSION[u_name]')");
			mysql_query("INSERT INTO calendario_cc_areas(area) VALUES ('$area')");
			?>
			<div align="center" style="color:red;">GUARDADO<br><br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">CERRAR</a></div>
			<?
		}
		?>
	</form>
	</div>

<?
}
?>






<?
if ($opcion==4) {
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>DATOS DEL CLIENTE</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Razon Social</td><td width="65%"><input type="text" size="25" name="razon_social"></td>
				<script type="text/javascript">
						var razon_social=new LiveValidation ('razon_social');
						razon_social.add( Validate.Presence );
						</script>
			</tr>
			<tr>
				<td align="right" width="30%">Razon Comercial</td><td width="65%"><input type="text" size="25" name="razon_comercial"></td>
				<script type="text/javascript">
						var razon_comercial=new LiveValidation ('razon_comercial');
						razon_comercial.add( Validate.Presence );
						</script>
			</tr>
		</table>
		<br>
		<div align="center"><input type="submit" value="Guardar" name="guardar"> </div>
		<br><br>
		<?
		if (isset($guardar)) {
				mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Agrego a un Nuevo Cliente <DATOS>  Razon Social:$razon_social      Razon Comercial:$razon_comercial','$_SESSION[u_name]')");
			mysql_query("INSERT INTO calendario_cc_clientesexternos(razon_social,razon_comercial) VALUES ('$razon_social','$razon_comercial' )");
			?>
			<div align="center" style="color:red;">GUARDADO<br><br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">CERRAR</a></div>
			<?
		}
		?>
	</form>
	</div>

<?
}
?>










<?
if ($opcion==5) {
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>PARTICULARIDAD</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">PARTICULARIDAD</td><td width="65%"><input type="text" size="25" name="particularidad"></td>
				<script type="text/javascript">
						var particularidad=new LiveValidation ('particularidad');
						particularidad.add( Validate.Presence );
						</script>
			</tr>
		</table>
		<br>
		<div align="center"><input type="submit" value="Guardar" name="guardar"> </div>
		<br><br>
		<?
		if (isset($guardar)) {
			mysql_query("INSERT INTO calendario_cc_particularidad(particularidad) VALUES ('$particularidad' )");
			?>
			<div align="center" style="color:red;">GUARDADO<br><br><br><br><a href="javascript:window.opener.document.location.reload();self.close()">CERRAR</a></div>
			<?
		}
		?>
	</form>
	</div>

<?
}
?>