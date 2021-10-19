<?php
session_start();
//$_SESSION=array();
include("../central/config.php");
include("../central/common/get_post.php");
foreach ($arrHttp as $var=>$value) echo "$var = $value<br>";

if (isset($_SESSION["lang"])){
	$arrHttp["lang"]=$_SESSION["lang"];
}else{
	$arrHttp["lang"]=$lang;
	$_SESSION["lang"]=$lang;
}
include ("../central/lang/admin.php");
include ("../central/lang/lang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
	<head>
		<title>ABCD</title>
		<meta http-equiv="Expires" content="-1" />
		<meta http-equiv="pragma" content="no-cache" />
		<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta http-equiv="Content-Language" content="pt-br" />
		<meta name="robots" content="all" />
		<meta http-equiv="keywords" content="" />
		<meta http-equiv="description" content="" />
		<!-- Stylesheets -->
		<link rel="stylesheet" rev="stylesheet" href="../central/css/template.css" type="text/css" media="screen"/>
		<!--[if IE]>
			<link rel="stylesheet" rev="stylesheet" href="../central/css/bugfixes_ie.css" type="text/css" media="screen"/>
		<![endif]-->
		<!--[if IE 6]>
			<link rel="stylesheet" rev="stylesheet" href="../central/css/bugfixes_ie6.css" type="text/css" media="screen"/>
		<![endif]-->
<script src=../central/dataentry/js/lr_trim.js></script>
<script language=javascript>

document.onkeypress =
	function (evt) {
			var c = document.layers ? evt.which
	       		: document.all ? event.keyCode
	       		: evt.keyCode;
			if (c==13) Enviar()
			return true;
	}

function UsuarioNoAutorizado(){
	alert("<?php echo $msgstr["menu_noau"];?>")
}
function Enviar(id){
	login=Trim(document.administra.login.value)
	password=Trim(document.administra.password.value)
	if (login=="" || password=="")
	{
		alert("<?php echo $msgstr["datosidentificacion"];?>")
		return
	}
	else
	{
	DoLogIn(login,password,id);		
	}
}

<!--//Ajax funtion to declare an XMLHttpRequest object
function getXMLHTTPRequest() {
try {
req = new XMLHttpRequest();
} catch(err1) {
  try {
  req = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (err2) {
    try {
    req = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (err3) {
      req = false;
    }
  }
}
return req;
}
// -->//XMLHttpRequest object instance
 var http = getXMLHTTPRequest();
 
 function DoLogIn(user,pass,id)
 {

 if (http.readyState == 4 || http.readyState == 0)
  	{
//        alert('dologin2'+ user+ pass+ id + http.readyState);
//	ix=document.administra.db_path.selectedIndex;
//	var mydbaccess=document.administra.db_path.options[ix].value;
//        alert ('dbpath='+ix+mydbaccess);
//  var mydbaccess="/var/opt/ABCD/bases/";
        mydbaccess="<?php echo $db_path ?>";
  var myurl = 'dologin.php';//define la url
  myRand = parseInt(Math.random()*999999999999999);// es para que la info no vaya a la cache sino al servidor  
  var modurl = myurl+"?user="+user+"&pass="+pass+"&path="+mydbaccess+"&rand="+myRand;//crea la nueva url
//  alert('modurl='+modurl);
	http.open("GET", modurl);//define tipo de convercion
  http.onreadystatechange = function(){ResponseDoLogin(id);}//es lo que queremos q se ejecute
  http.send(null);//se ejecuta la funcion
  }
  else
    setTimeout('DoLogIn('+user+','+pass+','+id+')', 1000);
 
 }
 function ResponseDoLogin(id)
{
//alert('readyState='+http.readyState+' status='+http.status+' response='+http.responseText);
if (http.readyState == 4)
	  if(http.status == 200)
	{
	  if (http.responseText=="DISPLAY") {		   
		   opener.document.getElementById('divurld'+id).style.display='none';
		   opener.document.getElementById('divurl'+id).style.display='block';
		   opener.document.getElementById('into').value='si';
           close(); 		   
		  }
		  else
		  {
		   alert(" Wrong user login-data, please try again");
		   document.getElementById("user").focus();
		  }
        }
}
</script>
</head>
<body>
	<div class="heading">
		<div class="institutionalInfo">
			<h1><img src=../central/images/logoabcd.jpg height=33 width=22>      &nbsp; &nbsp;
			<?php echo $institution_name?></h1>
		</div>
		<div class="userInfo"></div>
		<div class="spacer">&#160;</div>
	</div>
	<div class="sectionInfo">
		<div class="breadcrumb"></div>
		<div class="actions"></div>
		<div class="spacer">&#160;</div>
	</div>
<form name=administra onsubmit="javascript:return false" method=post action=../central/common/inicio.php>
<input type=hidden name=Opcion value=admin>
<input type=hidden name=cipar value=acces.par>
<input type=hidden name=window_id>
	<div class="middle login">
		<div class="loginForm">
			<div class="boxTop">
				<div class="btLeft">&#160;</div>
				<div class="btRight">&#160;</div>
			</div>
		<div class="boxContent">
<?php
if (isset($arrHttp["login"]) and $arrHttp["login"]=="N"){
		echo "
			<div class=\"helper alert\">".$msgstr["menu_noau"]."
			</div>
		";
}
if (isset($arrHttp["login"]) and $arrHttp["login"]=="P"){
		echo "
			<div class=\"helper alert\">".$msgstr["pswchanged"]."
			</div>
		";
}
?>
		<div class="formRow">
			<label for="user"><?php echo $msgstr["userid"]?></label>
<?php
if (isset($arrHttp["login"]) and $arrHttp["login"]=="N"){
		echo "
			<input type=\"text\" name=\"login\" id=\"user\" value=\"\" class=\"textEntry superTextEntry inputAlert\" onfocus=\"this.className = 'textEntry superTextEntry inputAlert textEntryFocus';\" onblur=\"this.className = 'textEntry superTextEntry inputAlert';\" />\n";
}else{
		echo "
			<input type=\"text\" name=\"login\" id=\"user\" value=\"\" class=\"textEntry superTextEntry\" onfocus=\"this.className = 'textEntry superTextEntry textEntryFocus';\" onblur=\"this.className = 'textEntry superTextEntry';\" />\n";
}
?>
		</div>
		<div class="formRow">
			<label for="pwd"><?php echo $msgstr["password"]?></label>
			<input type="password" name="password" id="pwd" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" />
		</div>
<!--		
		<div class="formRow"><br>
<?php
if (file_exists("../dbpath.dat")){
	$fp=file("../dbpath.dat");
	echo $msgstr["database_dir"].": <select name=db_path>\n";
	foreach ($fp as $value){
		if (trim($value)!=""){
			$v=explode('|',$value);
			$v[0]=trim($v[0]);
			echo "<Option value=".trim($v[0]).">".$v[1]."\n";
		}
	}
	echo "</select><p>";
}
?>
		</div-->
		<div class="submitRow">
			<div class="frLeftColumn"></div>
			<div class="frRightColumn">
				<a href="javascript:Enviar('<?php echo $_GET["id"];?>')" class="defaultButton goButton">
				<img src="../central/images/icon/defaultButton_next.png" alt="" title="" />
					<span><strong><?php echo $msgstr["entrar"]?></strong></span>
				</a>
			</div>
			<div class="spacer">&#160;</div>
		</div>		
	</div>
	<div class="boxBottom">
		<div class="bbLeft">&#160;</div>
			<div class="bbRight">&#160;</div>
	</div>
</div>
</div>
</form>
<?php include ("../central/common/footer.php");?>
	</body>
</html>
