<?php require("/configuracion/ventanasEmergentes.php");?>

<?php


if($_POST['agrega'] AND $_GET['folio']){

}




?>










<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 

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
.style122 {font-size: 9px}
.style122 {font-size: 9px}
</style>
</head>

<body>
<form id="form1" name="form1" method="POST" action="" >
   <p>
     <label></label></p>
   <div align="center">
<?php echo $al?>
   </div>
   <table width="223" border="0" align="center">
     <tr>
       <th height="15" colspan="2" bgcolor="#660066" scope="col"><div align="left" class="style11">
         <div align="center">Datos de facturaci&oacute;n </div>
       </div>         </th>
     </tr>
     <tr>
       <td width="51" height="28" bgcolor="<?php echo $color?>" class="Estilo24"><div align="center"># Folio </div></td>
       <td width="162" bgcolor="<?php echo $color?>" class="Estilo24"><div align="center">
         <input name="folio" type="text" class="style122" value="<?php echo $_GET['folio'];?>" />
       </div></td>
     </tr>
   </table>
   <p align="center">
     <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
     <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" />
	 
     <label>
     <input name="agrega" type="submit" class="Estilo24" id="agrega" value="Agregar" />
     </label>
     <label></label>
   </p>
</form>
</body>
</html>
