<?php require("/configuracion/ventanasEmergentes.php");?>




<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=600,height=800,scrollbars=YES") 
} 
</script> 


<?php


if($_GET['agrega'] AND $_GET['rfc'] and $_GET['domicilio']){













$sSQL1= "Select RFC,keyRFC From RFC where
entidad='".$entidad."'
and
RFC='".$_GET['rfc']."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if($myrow1['RFC'] ){
$agrega = "UPDATE RFC
set
RFC='".$_GET['rfc']."',
domicilio='".$_GET['domicilio']."',
telefono='".$_GET['telefono']."',
cp='".$_GET['cp']."',
entidad='".$entidad."'

where 
RFC='".$_GET['rfc']."' and entidad='".$entidad."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


} else {
$agrega = "INSERT INTO RFC (
RFC,domicilio,telefono,cp,entidad
) values ('".$_GET['rfc']."','".$_GET['domicilio']."','".$_GET['telefono']."','".$_GET['cp']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
} 




  $agrega = "UPDATE cargosCuentaPaciente
set
keyRFC='".$myrow1['keyRFC']."'
where 
entidad='".$entidad."'
and
folioFactura='".$_GET['folioFactura']."' 
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
  $agrega = "UPDATE clientesInternos
set
numeroFactura='".$_GET['folioFactura']."',

keyRFC='".$myrow1['keyRFC']."'
where 
keyClientesInternos='".$_GET['nT']."' 
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
 <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';

}




?>












<script type="text/javascript" src="/sima/js/despliegaRFC.js"></script>











<?php 




 $sSQL13= "Select * From RFC where
entidad='".$entidad."'
and
keyRFC='".$_GET['keyRFC']."'
";
$result13=mysql_db_query($basedatos,$sSQL13); 
$myrow13 = mysql_fetch_array($result13);

if($myrow13['RFC']){
$rfc=$myrow13['RFC'];
$domicilio=$myrow13['domicilio'];
$cp=$myrow13['cp'];
$telefono=$myrow13['telefono'];
} else if(!$_GET['limpiar']){

$rfc=$_GET['rfc'];
$domicilio=$_GET['domicilio'];
$cp=$_GET['cp'];
$telefono=$_GET['telefono'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>

<style type="text/css" media="screen">
			body {
				font: 11px arial;
			}
			.suggest_link {
				background-color: #FFFFFF;
				padding: 2px 6px 2px 6px;
			}
			.suggest_link_over {
				background-color: #3366CC;
				padding: 2px 6px 2px 6px;
			}
			#search_suggest {
	position: absolute;
	background-color: #FFFFFF;
	text-align: left;
	border: 1px solid #000000;
	left: 748px;
	top: 60px;
			}
			.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}		
		.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
</style>


<style type="text/css">
/* ---------------------------- */
/* CUSTOMIZE AUTOSUGGEST STYLE	*/
#search-wrap input{width:400px; font-size:16px; color:#999999; padding:6px; border:solid 1px #999999;}
#results{width:260px; border:solid 1px #DEDEDE; display:none;}
#results ul, #results li{padding:0; margin:0; border:0; list-style:none;}
#results li {border-top:solid 1px #DEDEDE;}
#results li a{display:block; padding:4px; text-decoration:none; color:#000000; font-weight:bold;}
#results li a small{display:block; text-decoration:none; color:#999999; font-weight:normal;}
#results li a:hover{background:#FFFFCC;}
#results ul {padding:6px;}
</style>
</head>

<body>
<form id="form1" name="form1" method="GET" action="" >
   <p>
     <label></label></p>
   <div align="center">
<?php echo $al?>
   </div>
   <table width="416" border="0" align="center">
     <tr>
       <th height="15" colspan="4" bgcolor="#660066" scope="col"><div align="left" class="style11">
         <div align="center">Datos de facturaci&oacute;n </div>
       </div>         </th>
     </tr>
     <tr>
       <td width="51" bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
       <td width="272" bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
       <td width="39" bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
       <td width="36" bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="<?php echo $color?>" class="Estilo24">RFC</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">
	   
	    <div id="search-wrap">
	   <input name="rfc" type="text" class="Estilo24" id="rfc" size="50"
	onKeyUp="javascript:autosuggest();" autocomplete="off"	 value="<?php echo $rfc;?>"/>
	</div>	</td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">
	     <div align="center">
		<div id="results" ></div>
		</div>	   
         </td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="<?php echo $color?>" class="Estilo24">Domicilio</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><textarea name="domicilio" cols="50" wrap="virtual" class="Estilo24" id="domicilio"><?php echo ltrim($domicilio);?></textarea></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="<?php echo $color?>" class="Estilo24">CP</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><label>
         <input name="cp" type="text" class="style7" id="cp" value="<?php echo $cp;?>" />
       </label></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="<?php echo $color?>" class="Estilo24">Tel&eacute;fono</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><input name="telefono" type="text" id="telefono" value="<?php echo $telefono;?>" /></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>

       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">&nbsp;</td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><label></label></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">
	     <label></label>
       </a>
       <label></label></td>
     </tr>
   
   </table>
   <p align="center">
 
     <input name="nT" type="hidden" id="nT" value="<?php echo $_GET['nT'];?>" />
     <input name="folioFactura" type="hidden" id="folioFactura" value="<?php echo $_GET['folioFactura'];?>" />
    
     <input name="ID_EJERCICIO" type="hidden" id="ID_EJERCICIO" value="<?php echo $ID_EJERCICIO;?>" />
	 
     <label>
     <input name="agrega" type="submit" class="Estilo24" id="agrega" value="Agregar" />
     </label>

     <label>
     <input name="limpiar" type="submit" class="style71" value="Limpiar Datos" />
     </label>
   </p>
</form>
</body>
</html>
