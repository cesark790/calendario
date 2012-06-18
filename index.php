<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CI</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript">
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
$(document).ready(function()
{
	$("#login_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Verificando....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ajax_login.php",{ user_name:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Ingresando al Sistema.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='inicio.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Datos Incorrectos, Ingrese un Usuario y Password validos...').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	
});
</script>
<style type="text/css">
body {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
}
.top {
margin-bottom: 15px;
}
.buttondiv {
margin-top: 10px;
}
.messagebox{
	position:absolute;
	width:100px;
	margin-left:430px;
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	position:absolute;
	width:auto;
	margin-left:430px;
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;
	
}
.messageboxerror{
	position:absolute;
	width:auto;
	margin-left:430px;
	border:1px solid #CC0000;
	background:#F7CBCA;
	padding:1px;
	font-weight:bold;
	color:#CC0000;
}

.Estilo1 {color: #FFFFFF}
.Estilo3 {color: #000000; font-weight: bold; }
</style>

</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id="qVRvZG8gbG9zIGRlcmVjaG9zIHJlc2VydmFkb3Msc2UgcHJvaGliZSBlbCB1c28gZGUgZXN0ZSBz
aXN0ZW1hIGhhc3RhICBjb250YXIgY29uIHVuYSBsaWNlbmNpYSBvIHF1ZSBzZSB0ZW5nYW4gbG9z
IGRlcmVjaG9zIGRlIGVzdGUgc2lzdGVtYSwNCg0KRGVzYXJyb2xsYWRvIHBvciBKdWxpbyBDZXNh
ciBTYW5jaGV6IExvcGV6IDIwMTEtMjAxMiA="></div>
<form method="post" action="" id="login_form">
<div align="center">
<div class="top" ></div>
<table width="35%" border="0" cellspacing="0" bgcolor="#4AA3CF">
  <tr>
    <td colspan="2" bgcolor="#E1CC20"><div align="left"><img src="img/ci_logo.PNG" alt="CI" width="108" height="93" /></div></td>
    </tr>
  <tr>
    <td width="66%" bgcolor="#E6E6E6"><div align="center" class="Estilo1">
      <div align="right" class="Estilo3">Usuario</div>
    </div></td>
    <td width="34%" bgcolor="#E6E6E6">
      
        <div align="left">
          <input name="username" type="text" id="username" value="" maxlength="20" />
        </div></td>
  </tr>
  <tr>
    <td bgcolor="#E6E6E6"><div align="center" class="Estilo1">
      <div align="right" class="Estilo3">Clave:</div>
    </div></td>
    <td bgcolor="#E6E6E6"><div align="left"><span style="margin-top:5px">
      <input name="password" type="password" id="password" value="" maxlength="20" />
    </span></div></td>
  </tr>
  <tr>
    <td bgcolor="#E1CC20">&nbsp;</td>
    <td bgcolor="#E1CC20"><div align="right" class="buttondiv">
      <input name="Submit" type="submit" id="submit" value="Aceptar" style="margin-left:5px; height:23px"  /> 
      </div></td>
  </tr>
</table>
</div>
</form>
<span id="msgbox" style="display:none"></span>
</body>
</html>
