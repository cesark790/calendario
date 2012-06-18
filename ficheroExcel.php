<?php
$titulo="Reporte.xls";
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=$titulo");header("Pragma: no-cache");header("Expires: 0");

error_reporting(0);
echo $_POST['tabla_p'];
echo $_POST['tabla_1'];
echo $_POST['tabla_2'];
echo $_POST['tabla_3'];
?>