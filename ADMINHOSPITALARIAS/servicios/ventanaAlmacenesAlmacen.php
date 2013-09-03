<?php require("/configuracion/ventanasEmergentes.php");?>
   <?php if($_POST['almacen']){
   $al=$_POST['almacen'];
   } else {
   $al=$_GET['almacen'];
   }

   ?>
<?php


if($_POST['agrega'] AND $_POST['almacen']){
$agregar=$_POST['agregar'];
$almacen=$_POST['almacen'];
for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL1= "Select * From almacenAlmacenes where
codigo='".$almacen."'
and
codigoAlmacenes='".$agregar[$i]."'
and
entidad='".$entidad."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['codigo'] and $agregar[$i]!=NULL){
$agrega = "INSERT INTO almacenAlmacenes (
codigo,codigoAlmacenes,entidad
) values ('".$almacen."','".$agregar[$i]."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}



if($_POST['borrar'] AND $_POST['almacen']){
$quitar=$_POST['quitar'];
$almacen=$_POST['almacen'];
for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL1= "Select * From almacenAlmacenes where
keyAV='".$quitar[$i]."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if($myrow1['codigo'] and $quitar[$i]!=NULL){
 $borrame = "DELETE FROM almacenAlmacenes WHERE keyAV ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
}
}
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
</head>

<body>
<form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label></p>
   <div align="center">
<?php echo $al?>
   </div>
   <table width="416" border="0" align="center">
     <tr>
       <th width="51" height="15" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
       <th width="272" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Almac&eacute;n</span></div></th>
       <th width="39" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"></div></th>
       <th width="36" bgcolor="#660066" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From almacenes 
WHERE
entidad='".$entidad."'
AND
(miniAlmacen='' or miniAlmacen='No')
order by descripcion ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$keyAlmacenes=$myrow['keyAlmacenes'];
$A=$myrow['almacen'];

 $sSQL1= "Select * From almacenAlmacenes where
codigo='".$al."'
and
codigoAlmacenes='".$A."'
and
entidad='".$entidad."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
$B=$myrow1['keyAV'];
?>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"> <?php echo $A?> </span></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"><?php echo $myrow['descripcion'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
         <input type="checkbox" name="agregar[]" value="<?php echo $A;?>"
	   <?php 
	   if($myrow1['keyAV']){
	   echo 'disabled';
	   }
	   ?> />
       </label></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24">
	     <label></label>
       </a>
       <label>
       <input type="checkbox" name="quitar[]" value="<?php echo $B;?>" 
	   <?php 
	   if(!$myrow1['keyAV']){
	   echo 'disabled';
	   }
	   ?>
	    />
       </label></td>
     </tr>
     <?php }}?>
   </table>
   <p align="center">
     <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
     <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" />
	 
     <label>
     <input name="agrega" type="submit" class="Estilo24" id="agrega" value="Agregar" />
     </label>
     <label>
     <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Quitar" />
     </label>
   </p>
</form>
</body>
</html>
