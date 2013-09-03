<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>
<?php


$keyC=$_POST['keyC'];


if($_POST['actualizar'] AND $_POST['codigoCampo'] and $_POST['descripcionCampo'] ){
$sSQL1= "Select * From campos WHERE codigoCampo = '".$_POST['codigoCampo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoCampo']){
if($_POST['codigoCampo']!=$myrow1['codigoCampo']){

$agrega = "INSERT INTO campos (
codigoCampo,descripcionCampo
) values ('".$_POST['codigoCampo']."','".$_POST['descripcionCampo']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO UN MODULO RAIZ"
</script>'; 
}} else {
$q = "UPDATE campos set 

descripcionCampo='".$_POST['descripcionCampo']."'

WHERE 
keyC='".$keyC."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE MODIFICO EL MODULO RAIZ"
</script>'; 
}
}

if($_POST['borrar'] AND $keyC){
$borrame = "DELETE FROM campos WHERE keyC ='".$keyC."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL MODULO RAIZ"
</script>'; 
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoCampo'] = "";
}


if($_POST['codigoCampo2']){
$sSQL2= "Select * From campos WHERE keyC = '".$_POST['codigoCampo2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
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
.Estilo24 {font-size: 10px}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de Campos - Almacenes </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="644" border="0" align="center">
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td width="83" bgcolor="#660066" class="style12"><div align="left" class="style13">C&oacute;digo Campo :</div></td>
       <td width="538" bgcolor="#660066" class="style12"><input name="codigoCampo" type="text" class="style12" id="codigoCampo" value ="<?php echo $myrow2['codigoCampo'] ?>" <?php if($myrow2['codigoCampo']){ echo " ".'readonly=""'; } ?> size="60"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n: </td>
       <td class="style12"><textarea name="descripcionCampo" cols="80" class="style12" id="descripcionCampo"><?php echo $myrow2['descripcionCampo'] ?></textarea></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#660066" class="style12">&nbsp;</td>
       <td bgcolor="#660066" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Campo" />
       <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Campo" /></td>
     </tr>
   </table>
   <p><span class="Estilo24"><span class="style7">
     <input name="keyC" type="hidden" id="keyC" value="<?php echo $myrow2['keyC'];?>" />
   </span></span></p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From campos order by keyC ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="617" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Clave del Campo </span></div></th>
       <th width="164" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo del Campo </span></div></th>
       <th width="340" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n </span></div></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['keyC'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
         <input name="codigoCampo2" type="submit" class="style12" id="codigoCampo2" value="<?php echo $C?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['codigoCampo'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionCampo'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
