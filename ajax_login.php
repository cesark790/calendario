<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
include "conexion.php";

//select the database | Change the name of database from here
//mysql_select_db('control_facturas'); 

//get the posted values
$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
$pass=$_POST['password'];
//$pass=$_POST['password'];
//now validating the username and password
$sql="SELECT id_responsable,nombre,a_paterno,a_materno,privilegios,uname,pass,email FROM calendario_cc_responsables WHERE uname='".$user_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	//compare the password
	if(strcmp($row['pass'],$pass)==0)
	{	
		mysql_query("INSERT INTO calendario_log(suceso,user) VALUES ('Inicio Session','$row[uname]')");
		echo "yes";
		//now set the session from here if needed
		$_SESSION['u_name']=$row['uname']; 
		$_SESSION['permiso_s']=$row['privilegios'];
		//$_SESSION['ses_tipo']=$row['tipo'];
		$_SESSION['nombre_s']=$row['nombre'];
		$_SESSION['a_paterno_s']=$row['a_paterno'];
		$_SESSION['id_responsable_s']=$row['id_responsable'];
		$_SESSION['correo']=$row['email'];
	}
	else
		echo "no"; 
}
else
	echo "no"; //Invalid Login
?>