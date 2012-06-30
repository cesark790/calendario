<?
include('conexion.php');
session_start();
$responsable=$_POST['responsable'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];
$user=$_POST['user'];
$dia=$_POST['dia'];
error_reporting(0);
?>

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

	$sql_datos=mysql_query("SELECT * FROM vista_calendario_general WHERE id_responsable like '%$responsable%' and anio ='$anio' and id_mes = '$mes' and dia = '$dia' and estatus = '1' ORDER BY dia");


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
				<td class="td"><? echo $reg['razon_comercial'];?></td>
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