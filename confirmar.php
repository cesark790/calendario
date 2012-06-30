<?
if ($_POST['n']==2) {
?>
<div align="right">
	<div style="widht:15px; height:15px;">
		<img src="img/cerrar.jpg" width="18" alt="Cerrar" id="cerrar" style="margin:10px 10px; cursor:pointer;" height="18">
	</div>
</div>
<div align="center" style="margin:10px auto">
	<div>Cancelar Actividad Completada</div>
		<div id="aceptar" style="width:auto"><h3 style="cursor:pointer;color:blue">Confirmar</h3></div>
</div>
<?
$id=$_POST['id'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];
$responsable=$_POST['responsable'];
$user=$_POST['user'];
$dia=$_POST['dia'];
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#cerrar').click(function(){
		$('#confirmar').remove();
	})
	$('#aceptar').click(function(){
		$('#aceptar h3').remove();
		$('#tabla').remove();
		$.ajax({
				type : 'POST',
				url : 'checkear.php',
				cache : false,
				data : 'n=2&id=<?echo $id;?>' ,
				beforeSend : function(){
					$('#aceptar').html('Cargando...');
				},
				success: function(data){
					$('#cerrar').remove();
					$('#aceptar').html("<img src='img/ico_aceptar.png' width='20' height='20'>");
					$('#aceptar').html("<br><br><div align='center' style='color:blue;'> Procesando...</div>  ");
				}

			});
	})

	$('#aceptar').click(function(e){
		e.preventDefault();
		$.ajax({
				type : 'POST',
				url : 'tabla.php',
				cache : false,
				data : 'user=<?echo $user;?>&responsable=<?echo $responsable?>&anio=<?echo $anio;?>&mes=<? echo $mes;?>&dia=<? echo $dia;?>' ,
				beforeSend : function(){
					$('#aceptar').html('Cargando...');
				},
				success: function(data){
					$('#confirmar').remove();
					$('#data').html(data);
				}

			});
	})
})
</script>

<?
}else{?>
	<div align="right">
	<div style="widht:15px; height:15px;">
		<img src="img/cerrar.jpg" width="18" alt="Cerrar" id="cerrar" style="margin:10px 10px; cursor:pointer;" height="18">
	</div>
</div>
<div align="center" style="margin:10px auto">
	<div>Confirmar Actividad Completada</div>
		<div id="aceptar" style="width:auto"><h3 style="cursor:pointer;color:blue">Confirmar</h3></div>
</div>
<?
$id=$_POST['id'];
$mes=$_POST['mes'];
$anio=$_POST['anio'];
$responsable=$_POST['responsable'];
$user=$_POST['user'];
$dia=$_POST['dia'];
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#cerrar').click(function(){
		$('#confirmar').remove();
	})
	$('#aceptar').click(function(){
		$('#aceptar h3').remove();
		$('#tabla').remove();
		$.ajax({
				type : 'POST',
				url : 'checkear.php',
				cache : false,
				data : 'n=1&id=<?echo $id;?>' ,
				beforeSend : function(){
					$('#aceptar').html('Cargando...');
				},
				success: function(data){
					$('#cerrar').remove();
					$('#aceptar').html("<img src='img/ico_aceptar.png' width='20' height='20'>");
					$('#aceptar').html("<br><br><div align='center' style='color:blue;'> Procesando...</div>  ");
				}

			});
	})

	$('#aceptar').click(function(e){
		e.preventDefault();
		$.ajax({
				type : 'POST',
				url : 'tabla.php',
				cache : false,
				data : 'user=<?echo $user;?>&responsable=<?echo $responsable?>&anio=<?echo $anio;?>&mes=<? echo $mes;?>&dia=<? echo $dia;?>' ,
				beforeSend : function(){
					$('#aceptar').html('Cargando...');
				},
				success: function(data){
					$('#confirmar').remove();
					$('#data').html(data);
				}

			});
	})
})
</script>
<?}?>