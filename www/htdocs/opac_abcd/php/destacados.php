<?php
include("config_opac.php");
$Formato="opac.pft";
$Expresion=$_REQUEST["Expresion"];
$base=$_REQUEST["base"];
	$resultado=wxisLlamar($base,$query,$xWxis."buscar.xis");
	foreach ($resultado as $value) {
		$value=trim($value);
		if (substr($value,0,8)=='[TOTAL:]'){
			continue;
		}else{
	       $salida.=$value;
		}
}
?>