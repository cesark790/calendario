<?
include("conexion.php");
$id=$_POST['id'];
$quitar=$_POST['quitar'];
$act=mysql_query("UPDATE calendario_general SET avance = '0' WHERE id_calendario='$id' ");

if(!$act){
	echo "no se efectuo";
}else{
?>
<img src="img/ico_aceptar.png" width="20" height="20" align="center">
<?
}
?>