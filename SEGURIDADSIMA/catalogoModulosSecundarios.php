<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php
$keyModuloRaiz=$_POST['keyModuloRaiz'];
if($_POST['actualizar'] ){
$sSQL1= "Select * From modulosSecundarios WHERE keyModuloRaiz = '".$keyModuloRaiz."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoModuloRaiz']){
if($_POST['codigoModuloRaiz']!=$myrow1['codigoModuloRaiz']){

$agrega = "INSERT INTO modulosSecundarios (
codigoModuloRaiz,descripcionModuloRaiz
) values ('".$_POST['codigoModuloRaiz']."','".$_POST['descripcionModuloRaiz']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO UN MODULO RAIZ"
</script>'; 
}} else {
$q = "UPDATE modulosSecundarios set 

descripcionModuloRaiz='".$_POST['descripcionModuloRaiz']."'

WHERE 
keyModuloRaiz='".$_POST['$keyModuloRaiz']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE MODIFICO EL MODULO RAIZ"
</script>'; 
}
}

if($_POST['borrar'] AND $keyModuloRaiz){
$borrame = "DELETE FROM modulosSecundarios WHERE codigoModuloRaiz ='".$_POST['codigoModuloRaiz']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL MODULO RAIZ"
</script>'; 
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoModuloRaiz'] = "";
}


if($_POST['codigoModuloRaiz2']){
 $sSQL2= "Select * From modulosSecundarios WHERE keyModuloRaiz = '".$_POST['codigoModuloRaiz2']."' ";
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
-->
</style>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de M&oacute;dulos Secundarios (2do. Nivel) </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="644" border="0" align="center">
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td width="83" bgcolor="#660066" class="style12"><div align="left"><span class="style11">M&oacute;dulo</span>:</div></td>
       <td width="538" bgcolor="#660066" class="style12"><input name="codigoModuloRaiz" type="text" class="style12" id="codigoModuloRaiz" value ="<?php echo $myrow2['codigoModuloRaiz'] ?>" <?php if($myrow2['codigoModuloRaiz']){ echo " ".'readonly=""'; } ?> size="60"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n: </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="descripcionModuloRaiz" cols="120" rows="5" class="Estilo24" id="descripcionModuloRaiz"><?php echo $myrow2['descripcionModuloRaiz'] ?></textarea>
       </span></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#660066" class="style12">&nbsp;</td>
       <td bgcolor="#660066" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar M&oacute;dulo" />
       <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar M&oacute;dulo" />
       <input type="hidden" name="keyModuloRaiz" value="<?php echo $myrow2['keyModuloRaiz'];?>" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From modulosSecundarios order by keyModuloRaiz ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="676" border="0" align="center">
     <tr>
       <th width="94" bgcolor="#660066" scope="col"><span class="style11">Clave del M&oacute;dulo </span></th>
       <th width="110" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo del M&oacute;dulo </span></th>
       <th width="458" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n </span></th>
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
$C=$myrow['keyModuloRaiz'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
        </label>
         <label>
         <input name="codigoModuloRaiz2" type="submit" class="style7" id="codigoModuloRaiz2" value="<?php echo $C?> " />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['codigoModuloRaiz'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionModuloRaiz'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
