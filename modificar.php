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
	<?
	if (isset($guardar)) {
			$sql=mysql_query("SELECT nombre,a_paterno,a_materno,uname,pass,privilegios,id_area,empresa FROM calendario_cc_responsables WHERE id_responsable ='$id' ");
			$reg=mysql_fetch_array($sql);
			
			if($reg['nombre']==$nombre_insertar){

				$nombre_a="";
			}else{
				$nombre_a="  Nombre : $nombre_insertar  ";
			}

			if($reg['a_paterno']==$a_paterno){

				$a_paterno_a="";
			}else{
				$a_paterno_a="  Apellido Paterno : $a_paterno  ";
			}

			if($reg['a_materno']==$a_materno){

				$a_materno_a="";
			}else{
				$a_materno_a="  Apellido Materno : $a_materno  ";
			}

			if($reg['uname']==$uname){

				$uname_a="";
			}else{
				$uname_a="   Usuario : $uname  ";
			}

			if($reg['pass']==$pass){

				$pass_a="";
			}else{
				$pass_a="    Password : $pass  ";
			}

			if($reg['privilegios']==$privilegios){

				$privilegios_a="";
			}else{
				$privilegios_a="  Privilegios : $privilegios  ";
			}

			if($reg['id_area']==$id_area){

				$id_area_a="";
			}else{
				$id_area_a="  Area : $id_area  ";
			}


			if($reg['empresa']==$empresa){

				$empresa_a="";
			}else{
				$empresa_a="  Empresa : $Empresa  ";
			}

			if ($reg['nombre']==$nombre_insertar and $reg['empresa']==$empresa and $reg['id_area']==$id_area and $reg['privilegios']==$privilegios and  $reg['a_paterno']==$a_paterno and $reg['a_materno']==$a_materno and  $reg['uname']==$uname and $reg['pass']==$pass ) {
				
			}else{

				mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actualizo campos de la tabla USUARIOS  <CAMPOS>  $nombre_a  $a_paterno_a   $a_materno_a  $uname_a  $pass_a  $privilegios_a  $id_area_a  $empresa_a','$_SESSION[u_name]')");
			}
			
			mysql_query("UPDATE calendario_cc_responsables SET nombre='$nombre_insertar',a_paterno='$a_paterno',a_materno='$a_materno',uname='$uname',pass='$pass',privilegios='$privilegios',id_area='$id_area',empresa='$empresa' WHERE id_responsable='$id'");
		}
	$sql=mysql_query("SELECT nombre,a_paterno,a_materno,uname,pass,privilegios,id_area,empresa FROM calendario_cc_responsables WHERE id_responsable ='$id' ");
	$reg=mysql_fetch_array($sql);
	?>	
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>MODIFICAR USUARIO</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Nombre</td><td width="65%"><input type="text" size="25" value="<? echo $reg['nombre'];?>" name="nombre_insertar"></td>
				<script type="text/javascript">
						var nombre=new LiveValidation ('nombre_insertar');
						nombre.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="15%">Apellido Paterno</td><td width="15%"><input value="<? echo $reg['a_paterno'];?>"  name="a_paterno" size="25"></td>
				<script type="text/javascript">
						var a_paterno=new LiveValidation ('a_paterno');
						a_paterno.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="15%">Apellido Materno</td><td width="15%"><input value="<? echo $reg['a_materno'];?>" name="a_materno" size="25"></td>
				
			</tr>
		</table>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Nombre Usuario</td><td width="65%"><input value="<? echo $reg['uname'];?>" name="uname" size="25"></td>
				<script type="text/javascript">
						var uname=new LiveValidation ('uname');
						uname.add( Validate.Presence );
							

						</script>
			</tr>
			<tr>
				<td align="right" width="30%">Password</td><td width="65%"><input value="<? echo $reg['pass'];?>" name="pass" size="25"></td>
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
					if ($reg['privilegios']==$reg_privilegios['id_privilegio']) {
					?><option selected="selected" value="<?echo $reg_privilegios['id_privilegio'];?>"><? echo $reg_privilegios['privilegio'];?></option>
					<?
					}else{
				?><option value="<?echo $reg_privilegios['id_privilegio'];?>"><? echo $reg_privilegios['privilegio'];?></option>
				<?}
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
						if ($reg['id_area']==$reg_areas['id_area']) {
						?><option selected="selected" value="<?echo $reg_areas['id_area'];?>"><? echo $reg_areas['area'];?></option>
						<?}else{
				?><option value="<?echo $reg_areas['id_area'];?>"><? echo $reg_areas['area'];?></option>
				<?
					}
				}?>

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
						if ($reg['empresa']==$reg_empresas['Id_empresa']) {
						?><option selected="selected" value="<? echo $reg_empresas['Id_empresa'];?>"><? echo $reg_empresas['nombre_empresa']; ?></option>
						<?
						}else{
				?><option value="<? echo $reg_empresas['Id_empresa'];?>"><? echo $reg_empresas['nombre_empresa']; ?></option>
				<?
					}
				}?>

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
		<div align="center"><input type="submit" value="Guardar" name="guardar"> </div>
		<br>
		<?
		if (isset($guardar)) {
	
			?>
			<div align="center" style="color:red;">GUARDADO<br><a href="javascript:window.opener.location.reload();self.close();" ><br><br>FINALIZAR</a></div>
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
	<?
if (isset($guardar)) {

			if($reg['actividad']==$actividad){

				$actividad_a="";
			}else{
				$actividad_a="  Actividad : $actividad  ";
			}



			if ($reg['actividad']==$actividad ) {
				
			}else{

			mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actualizo campos de la tabla ACTIIVIDAD <CAMPOS>  $actividad ','$_SESSION[u_name]')");
			}
			mysql_query("UPDATE calendario_cc_actividades SET actividad ='$actividad' WHERE id_actividad='$id' ");
			}

	$sql=mysql_query("SELECT actividad FROM calendario_cc_actividades WHERE id_actividad = '$id' ");
	$reg=mysql_fetch_array($sql);

?>
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>MODIFICAR ACTIVIDAD</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Actividad</td><td width="65%"><input type="text" size="25" value="<? echo $reg['actividad'];?>" name="actividad"></td>
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
	if (isset($guardar)) {

			if($reg['area']==$area){

				$area_a="";
			}else{
				$area_a="  Area  : $area  ";
			}



			if ($reg['area']==$area ) {
				
			}else{

			mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actualizo campos de la tabla AREAS <CAMPOS>   $area ','$_SESSION[u_name]')");
			}
			mysql_query("UPDATE calendario_cc_areas SET area ='$area' WHERE id_area='$id' ");
			}

	$sql=mysql_query("SELECT area FROM calendario_cc_areas WHERE id_area = '$id' ");
	$reg=mysql_fetch_array($sql);
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>MODIFICAR AREA</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Area</td><td width="65%"><input value="<? echo $reg['area'];?>" type="text" size="25" name="area"></td>
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
		if (isset($guardar)) {

			if($reg['razon_social']==$razon_social){

				$razon_social_a="";
			}else{
				$razon_social_a="  Razon_social : $razon_social  ";
			}



			if ($reg['razon_comercial']==$razon_comercial ) {

				$razon_comercial_a="";
			}
			else{
				$razon_comercial_a="  Razon Comercial : $razon_comercial  ";
			}

			if($reg['razon_social']==$razon_social and $reg['razon_comercial']==$razon_comercial){
				
			}else{

			mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Actualizo campos de la tabla CLIENTES <CAMPOS>   $razon_social_a    $razon_comercial_a ','$_SESSION[u_name]')");
			}

			mysql_query("UPDATE calendario_cc_clientesexternos SET razon_social ='$razon_social',razon_comercial ='$razon_comercial' WHERE id_cliente_externo ='$id' ");
			}

	$sql=mysql_query("SELECT razon_social,razon_comercial FROM calendario_cc_clientesexternos WHERE id_cliente_externo = '$id' ");
	$reg=mysql_fetch_array($sql);
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>MODIFICAR CLIENTE</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">Razon Social</td><td width="65%"><input type="text" value="<? echo $reg['razon_social']?>" size="25" name="razon_social"></td>
				<script type="text/javascript">
						var razon_social=new LiveValidation ('razon_social');
						razon_social.add( Validate.Presence );
						</script>
			</tr>
			<tr>
				<td align="right" width="30%">Razon Comercial</td><td width="65%"><input type="text"value="<? echo $reg['razon_comercial']?>" size="25" name="razon_comercial"></td>
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
	if (isset($guardar)) {
			mysql_query("UPDATE calendario_cc_particularidad SET particularidad ='$particularidad' WHERE id_particularidad ='$id' ");
			}

	$sql=mysql_query("SELECT particularidad FROM calendario_cc_particularidad WHERE id_particularidad = '$id' ");
	$reg=mysql_fetch_array($sql);
?>
<form action="" method="post">
	<div id="contenedor_dos" style="border-color:#ccc; border-radius:15px; text-shadow:5px 5px 10px rgba(0,0,0,0.5);">
		<div align="center" style="padding:1px 0;"	> <h3>PARTICULARIDAD</h3></div>
		<hr style="width:80%">
		<table align="center" width="90%" border="0">
			<tr>
				<td align="right" width="30%">PARTICULARIDAD</td><td width="65%"><input type="text" size="25" value="<? echo $reg['particularidad'];?>" name="particularidad"></td>
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