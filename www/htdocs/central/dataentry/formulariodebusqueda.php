<?php
function DibujarFormaBusqueda(){
global $arrHttp,$camposbusqueda,$db_path,$tagisis,$msgstr;

if (!isset($arrHttp["refine"]) ) unset ($_SESSION["Expresion"]);
// Prepare the advanced search form

	echo "<style type=text/css>
			#myvar {
			border:1px solid #ccc;
			background:#ffffff;
			padding:2px;}
		</style>";

//read search expressions stored
echo "\n<script>
str_expr=\"\"
str_search=new Array()
stored=\"\"
copyTo=\"\"\n";
$str_expr="";
unset($fp);

if (!isset($lang_db)) $lang_db=$_SESSION["lang"];
if (file_exists($db_path.$arrHttp["base"]."/pfts/".$_SESSION["lang"]."/search_expr.tab"))
	$fp = file($db_path.$arrHttp["base"]."/pfts/".$_SESSION["lang"]."/search_expr.tab");
else
	if (file_exists($db_path.$arrHttp["base"]."/pfts/".$lang_db."/search_expr.tab"))
		$fp = file($db_path.$arrHttp["base"]."/pfts/".$lang_db."/search_expr.tab");
if (isset($fp)){
	$str_expr="Y";
	$ix=-1;
	foreach ($fp as $value){
		if (trim($value)!=""){
			$ix=$ix+1;
			$stored[$ix]=trim($value);
			echo "str_search[$ix]=\"".trim($value)."\"\n";
		}
	}
}
echo "</script>\n";

?>

<script languaje=javascript>
document.onkeypress =
	function (evt) {
			var c = document.layers ? evt.which
	       		: document.all ? event.keyCode
	       		: evt.keyCode;
			if (c==13) PrepararExpresion()
			return true;
	}

function CopyExpr(){
	o=Opc.split('|')
	document.forma1.expre[copyTo].value=o[1]
	document.forma1.camp[copyTo].selectedIndex=0

function GetExpression(ic){
	copyTo=ic
	var winl = (screen.width-300)/2;
	var wint = (screen.height-100)/2;

	msgwin=window.open("","sst","width=400,height=100,left="+winl+",top="+wint+",scrollbars,resizable")
    msgwin.document.close()
	msgwin.document.writeln("<html><body><font face=arial size=2><form name=forma1>")
	msgwin.document.writeln("<?php echo $msgstr["copysearch"]?>")
	msgwin.document.writeln("<p><select width=250 name=ex onchange=window.opener.stored=document.forma1.ex.options[document.forma1.ex.selectedIndex].value;window.opener.CopyExpr();self.close()>\n")
	msgwin.document.writeln("<option value=\"\"></option>")
	<?php
	if (isset($stored)){
		foreach ($stored as $var=>$value){
			$s=explode("|",$value);
	}
	?>
    msgwin.document.writeln("</select>")
	msgwin.document.writeln("</body></html>")
	msgwin.document.close()
	msgwin.focus()

function Ayuda(){
	msgwin=window.open("../html/ayuda_expresion.html")
}
function switchMenu(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display != "none" ) {
		el.style.display = 'none';
	}
	else {
		el.style.display = '';
	}
}

/*function LeerExpresion(TipoR,Obj){
	var el = document.getElementById('Expre')
	el.style.display = 'none';
	var el = document.getElementById('myvar')
	el.style.display = '';
	url="busqueda_leer.php?base=<?php echo $arrHttp["base"]?>&tipor="+TipoR+"&obj="+Obj
	msgwin=window.open(url,"busqueda","menu=no,status=yes")
	msgwin.focus()
} */

function Buscar_Expre(){
	document.forma1.Expresion.value=document.forma1.Expre_b.value
<?php	if (!isset($arrHttp["Target"])){
		echo "msgwin=window.open(\"\",\"Resultados\",\"status=yes,resizable=yes,toolbar=no,menu=no,scrollbars=yes,width=630,height=400\")
		msgwin.focus()\n";
	}
?>
	document.forma1.submit()
}

function LimpiarBusqueda() {
  for (i=0; i<document.forma1.camp.length; i++){
      document.forma1.expre[i].value=""
      }
}


function PrepararExpresion(){
	j=document.forma1.expre.length
	Expresion=""
	Operadores=""
	Campos=""
	for (i=0;i<j;i++){
	    if (document.forma1.expre[i].value==""){
			document.forma1.expre[i].value=" "
		}
		if (Expresion==""){
			Expresion=document.forma1.expre[i].value
		}else{
			if (document.forma1.expre[i].value==" "){
				Expresion=Expresion+" ~~~ "
				document.forma1.expre[i].value=""
			}else{
				Expresion=Expresion+" ~~~ "+document.forma1.expre[i].value
			}
		}
		ixSel=document.forma1.camp[i].selectedIndex
		cc=document.forma1.camp[i].options[ixSel].value
		pref=dt[ixSel][2]
		if (Campos==""){
			Campos=cc
			Prefijo=pref
		}else{
			Campos=Campos+" ~~~ "+cc
			Prefijo=Prefijo+" ~~~ "+pref
		}
		if (i<j-1){
			ixSel=document.forma1.oper[i].selectedIndex
			if (ixSel=="undefined") ixSel=0
			cc=document.forma1.oper[i].options[ixSel].value
			if (Operadores==""){
				Operadores=cc
			}else{
				Operadores=Operadores+" ~~~ "+cc
			}
		}
	}

	document.forma1.Expresion.value=Expresion
	document.forma1.Campos.value=Campos
	document.forma1.Operadores.value=Operadores
	document.forma1.Prefijos.value=Prefijo

	for (i=0;i<j;i++){
		if (document.forma1.expre[i].value==" ") document.forma1.expre[i].value=""
	}
	SinExpre="S"
	for (i=0;i<j;i++){
		if (document.forma1.expre[i].value!="") SinExpre="N"
	}

	if (SinExpre=="S"){
		alert("<?php echo $msgstr["faltaexpr"]?>")
	}else{

		document.forma1.submit()
	}
}


function Diccionario(jx){
	j=document.forma1.camp[jx].selectedIndex
	if (document.forma1.camp[jx].options[j].value=="---"){
		alert("<?php echo $msgstr["selcampob"]?>")
		return
	}

<?php
	echo "document.diccio.base.value=\"".$arrHttp['base']."\"\n";
	echo "document.diccio.cipar.value=\"".$arrHttp['cipar']."\"\n";


?>
	document.diccio.Opcion.value="diccionario";
	nombrec=dt[j][0]
    prefijo=dt[j][2]
    decode=dt[j][3]
	if (prefijo=="--"){
		alert("<?php echo $msgstr["sinindice"]?>")
	}else{
		msgwin=window.open("","Diccionario","status=yes,resizable=yes,toolbar=no,menu=no,scrollbars=yes,height=500,width=700")
		msgwin.focus()
		id=dt[j][1]
		document.diccio.campo.value=nombrec
		document.diccio.prefijo.value=prefijo
		document.diccio.id.value=id
		document.diccio.Diccio.value=jx
		if (decode=="DECODE") document.diccio.Decode.value="S"
		document.diccio.submit()
	}

}


</script>
<?php
	echo "<script>\n";
	echo "var dt= new Array()\n";
	$ix=0;
	echo "dt[".$ix."]= new Array \n";
	echo "dt[".$ix."][0]=\"---\"\n";
	echo "dt[".$ix."][1]=\"\"\n";
	echo "dt[".$ix."][2]=\"\"\n";
	echo "dt[".$ix."][3]=\"\"\n";

	foreach ($camposbusqueda as $linea) {

		$ix=$ix+1;
		$l=explode('|',$linea);
		if (!isset($l[3])) $l[3]="";
		echo "dt[".$ix."]= new Array \n";
		echo "dt[".$ix."][0]=\"".$l[0]."\"\n";
		echo "dt[".$ix."][1]=\"".$l[1]."\"\n";
		echo "dt[".$ix."][2]=\"".$l[2]."\"\n";
		echo "dt[".$ix."][3]=\"".$l[3]."\"\n";
	}
	$Tope=$ix+1;  //significa que se van a colocar 7 cajas de texto con la expresi�n de b�squeda
	echo "</script>\n";
	echo "<body>";
	if (!isset ($arrHttp["encabezado"])){
		echo "<div class=\"helper\">
			<a href=../documentacion/ayuda.php?help=". $_SESSION["lang"]."/buscar.html target=_blank>".$msgstr["help"]."</a>&nbsp &nbsp";
		if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
			echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/buscar.html target=_blank>".$msgstr["edhlp"]."</a>";
		echo "<font color=white>&nbsp; &nbsp; Script: dataentry/buscar.php</font>";
		echo "</div>";
	}
	echo "<div class=\"middle form\">
			<div class=\"formContent\">
	";

	echo "<form method=post name=forma1 action=";
	if (isset($arrHttp["Target"]) and $arrHttp["Target"]=="reserve")
		echo "buscar.php";
	else
		echo "../dataentry/buscar.php";
	echo "  onSubmit=\"javascript:return false\" >";

	echo '<input type=hidden name=tag8999 value="">';
	echo "<input type=hidden name=desde value=".$arrHttp['desde'].">\n";
	echo "<input type=hidden name=base value=".$arrHttp['base'].">\n";
	echo "<input type=hidden name=cipar value=".$arrHttp['cipar'].">\n";
	if (isset($arrHttp["copies"])) echo "<input type=hidden name=copies value=".$arrHttp['copies'].">\n";
    echo "<input type=hidden name=from value=1>\n";
	if (isset($arrHttp["Formato"]))echo "<input type=hidden name=Formato value=".$arrHttp['Formato'].">\n";
	if (isset($arrHttp["count"])) echo "<input type=hidden name=count value=".$arrHttp['count'].">\n";
	echo "<input type=hidden name=Opcion value=".$arrHttp['Opcion'].">\n";
	if (isset($arrHttp["prologo"])) echo "<input type=hidden name=prologo value=".$arrHttp['prologo'].">\n";
	if (isset($arrHttp["epilogo"])) echo "<input type=hidden name=epilogo value=".$arrHttp['epilogo'].">\n";
	echo "<input type=hidden name=Campos value=\"\">\n";
	echo "<input type=hidden name=Operadores value=\"\">\n";
	echo "<input type=hidden name=Expresion value=\"\">\n";
	echo "<input type=hidden name=Prefijos value=\"\">\n";
	if (isset($arrHttp["prestamo"])) echo "<input type=hidden name=prestamo value=\"".$arrHttp['prestamo']."\">\n";
	if (isset($arrHttp["Tabla"])) echo "<input type=hidden name=Tabla value=".$arrHttp['Tabla'].">\n";
	if (isset($arrHttp["copies"])) echo "<input type=hidden name=copies value=".$arrHttp['copies'].">\n";
	echo "<center>\n";
	echo "<table valign=center cellpadding=2 Cellspacing=0 border=0 width=800>\n
			<tr>
				<td colspan=3>";
				if (file_exists($db_path.$arrHttp["base"]."/pfts/".$_SESSION["lang"]."/search_expr.tab")){
					if (isset($_SESSION["permiso"]["db_ALL"]) or isset($_SESSION["permiso"]["CENTRAL_ALL"]) or  isset($_SESSION["permiso"][$arrHttp["base"]."_CENTRAL_ALL"])  or  isset($_SESSION["permiso"][$arrHttp["base"]."_EDITSTOREDEXPR"])){
						if (isset($arrHttp["desde"]) and $arrHttp["desde"]=="dataentry")
							echo "<img src=../dataentry/img/search.gif border=0> <a href=\"edit_stored_expr.php?base=".$arrHttp["base"]."\">". $msgstr["edit_search_expr"]."</a>";
					}
				}
				echo "<p>".$msgstr["mensajeb"]."</td>
			<tr>
				<td bgcolor=#cccccc nowrap><font face=verdana size=2 color=#697782><b>".$msgstr["campo"]."</b></td>
				<td bgcolor=#cccccc><font face=verdana size=2 color=#697782><b>".$msgstr["expresion"]."</td>
				<td bgcolor=#cccccc>&nbsp;</td>
			</tr>\n";
	for ($jx=0;$jx<$Tope;$jx++){
		echo "<tr><td  valign=center nowrap>";
		echo "<SELECT name=camp>";

		echo "<OPTION value=\"---\">---";
		for ($i=0;$i<count($camposbusqueda);$i++){
			$linea=$camposbusqueda[$i];
			$l=explode('|',$linea);
			$parte3=$l[2];
			$parte2=$l[1];
			$parte1=$l[0];
			echo "<OPTION value='".$parte2."'";
			if ($jx==0 and isset($_SESSION["Expresion"])){
				if ($i==$jx) echo " selected ";
			}
			echo ">".$parte1;
		}
		echo "</SELECT> &nbsp;";
		echo "<font size=1><a href=\"javascript:Diccionario(".$jx.")\"><font size=1>".$msgstr["indice"]."</a>\n";
		echo "</td>";
		echo "<td align=center>";
		if (isset($_SESSION["Expresion"]) and $jx==0){
			$E=str_replace('"',"''",$_SESSION["Expresion"]);
			//if (substr($E,0,1)=="("){
			//	if (substr($E,strlen($E)-1)==")")
			//		$E=substr($E,0,strlen($E)-1);
			//}
            //$E=str_replace('"','',$E);
			echo "<input type=text size=100 name=expre value=\"".$E."\"></td>\n<td nowrap>";
		//	unset($_SESSION["Expresion"]);
			echo "<input type=text size=100 name=expre value=\"\"></td>\n<td nowrap>";
		}
		if ($str_expr=="Y")
			echo "<a href=Javascript:GetExpression($jx)><img src=../dataentry/img/search.gif border=0 alt=\"".$msgstr["copysearch"]."\"></a>";
		if ($jx<$Tope-1){
       		echo "&nbsp;<select name=oper size=1>";
       		echo "<option value=and selected>and\n";
       		echo "<option value=or>or\n";
       		echo "<option value=^>and not\n";
       		echo "</select>\n";
 		}else {
       		echo "<input type=hidden name=oper>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;";
    	}

   		echo "</td>\n";

	}
	echo "<tr>\n";
	echo "<td colspan=3 align=center><p><br>\n";
	?>
	<div class="sectionButtons"><center>
		<a href="javascript:PrepararExpresion()" class="defaultButton multiLine listButton">
		<img src="../images/mainBox_iconBorder.gif" alt="" title="" />
							<span><?php echo $msgstr["m_buscar"]?></strong></span>
						</a>
		<a href="javascript:LimpiarBusqueda(this,1)" class="defaultButton multiLine cancelButton">
		<img src="../images/mainBox_iconBorder.gif" alt="" title="" />
							<span><?php echo $msgstr["borrar"]?></strong></span>
						</a>


	<?php
	if (isset($arrHttp["desde"]) and $arrHttp["desde"]=="reserve"){
	?>
	 <a href="javascript:document.basedatos.submit()" class="defaultButton multiLine backButton">
		<img src="../images/mainBox_iconBorder.gif" alt="" title="" />
							<span><?php echo $msgstr["back"]?></strong></span>
						</a>
	<?php
	echo "</div>";
	echo "</td>\n";
	echo "</table>\n";
	echo "</form>\n";
	echo "<script>document.forma1.expre[0].blur()</script>\n";
	echo "<form name=diccio method=post action=../dataentry/diccionario.php target=Diccionario>\n";

	echo "<input type=hidden name=base value=".$arrHttp['base'].">\n";
	echo "<input type=hidden name=cipar value=".$arrHttp['cipar'].">\n";
	if (isset($arrHttp["Formato"]))echo "<input type=hidden name=Formato value=".$arrHttp['Formato'].">\n";
	echo "<input type=hidden name=Opcion value=buscar>\n";
	echo "<input type=hidden name=prefijo value=\"\">\n";
	echo "<input type=hidden name=campo value=\"\">\n";
	echo "<input type=hidden name=id value=\"\">\n";
	echo "<input type=hidden name=Diccio value=\"\">\n";
	echo "<input type=hidden name=Decode value=\"\">\n";
	echo "<input type=hidden name=desde value=".$arrHttp["desde"].">";
	if (isset($arrHttp["epilogo"])) echo "<input type=hidden name=epilogo value=".$arrHttp['epilogo'].">\n";
	if (isset($arrHttp["prologo"])) echo "<input type=hidden name=prologo value=".$arrHttp["prologo"].">\n";
	if (isset($arrHttp["prestamo"])) {
	    echo "<input type=hidden name=prestamo value=".$arrHttp['prestamo'].">\n";
	}
	if (isset($arrHttp["Target"])) {
	    echo "<input type=hidden name=Target value=".$arrHttp['Target'].">\n";
	}
	if (isset($arrHttp["Tabla"])) {
	    echo "<input type=hidden name=Tabla value=".$arrHttp['Tabla'].">\n";
	}
	echo "</form>\n";
    echo "</div></div></center>\n";
    include("../common/footer.php");
	echo "</body>";
	echo "</html>";

}
?>