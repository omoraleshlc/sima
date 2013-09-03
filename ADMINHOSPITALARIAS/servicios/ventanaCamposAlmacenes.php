<?php require("/configuracion/ventanasEmergentes.php");?>
   <?php if($_POST['almacen']){
   $al=$_POST['almacen'];
   } else {
   $al=$_GET['almacen'];
   }

   ?>
<?php


if($_POST['agrega'] AND $al){
$agregar=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){


if(!$myrow1['codigo'] and $agregar[$i]!=NULL){


if($agregar[$i]){ 
$sSQL1= "Select keyC From camposAlmacenes where keyC='".$agregar[$i]."'
and id_almacen='".$al."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['keyC']){
$agrega = "INSERT INTO camposAlmacenes (
id_almacen,keyC
) values ('".$al."','".$agregar[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}


}
}
$leyenda='Se Agregaron Registros';
}



if($_POST['borrar'] AND $al){
$quitar=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i] and $al){
 $borrame = "DELETE FROM camposAlmacenes WHERE keyCAL ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
}
$leyenda='Se eliminaron registros';
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
.style7 {font-size: 14px}
.style11 {color: #00000; font-size: 14px; font-weight: bold; }
.style12 {font-size: 14px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="" >

   <p align="center">   Relacionar Campos con Almacenes </p>
   <div align="center">
<?php echo $leyenda.' del almacén:'.$al;?>
   </div>
   <img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="416" height="21" />
   <table width="416" height="53" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <th width="51" height="26" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
       <th width="272" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">Almac&eacute;n</span></div></th>
       <th width="39" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left"></div></th>
       <th width="36" bgcolor="#FFFF00" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From campos


order by descripcionCampo ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$keyAlmacenes=$myrow['keyAlmacenes'];
$A=$myrow['keyC'];

 $sSQL1= "Select keyCAL,id_almacen From camposAlmacenes where
keyC='".$myrow['keyC']."' and id_almacen='".$al."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 
$B=$myrow1['keyCAL'];
?>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"> <?php echo $myrow['codigoCampo']?> </span></td>
       <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"><?php echo $myrow['descripcionCampo']?></span></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
         <input type="checkbox" name="agregar[]" value="<?php echo $A;?>"
	   <?php 
	   if($myrow1['id_almacen']){
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
	   if(!$myrow1['id_almacen']){
	   echo 'disabled';
	   }
	   ?>
	    />
       </label></td>
     </tr>
     <?php }}?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" alt="bo2" width="416" height="21" />
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
