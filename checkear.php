<?
include("conexion.php");
$id=$_POST['id'];
if ($_POST['n']==2) {
mysql_query("UPDATE calendario_general SET avance = '0' WHERE id_calendario='$id' ");
}
else{
	mysql_query("UPDATE calendario_general SET avance = '100' WHERE id_calendario='$id' ");
}
?>