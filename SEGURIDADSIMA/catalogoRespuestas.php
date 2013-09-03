<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php
if($_POST['actualizar'] AND $_POST['codigoLR'] ){
$sSQL1= "Select * From listaRespuestas WHERE codigoLR = '".$_POST['codigoLR']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoLR']){
if($_POST['codigoLR']!=$myrow1['codigoLR']){

$agrega = "INSERT INTO listaRespuestas (
codigoLR,descripcionLR
) values ('".$_POST['codigoLR']."','".$_POST['descripcionLR']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO UNA RESPUESTA"
</script>'; 
}} else {
$q = "UPDATE listaRespuestas set 

descripcionLR='".$_POST['descripcionLR']."'

WHERE 
codigoLR='".$_POST['codigoLR']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE MODIFICO LA RESPUESTA"
</script>'; 
}
}

if($_POST['borrar'] AND $_POST['codigoLR']){
$borrame = "DELETE FROM listaRespuestas WHERE codigoLR ='".$_POST['codigoLR']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO UNA RESPUESTA"
</script>'; 
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoLR'] = "";
}


if($_POST['codigoLR2']){
 $sSQL2= "Select * From listaRespuestas WHERE codigoLR = '".$_POST['codigoLR2']."' ";
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
 <h1 align="center">Cat&aacute;logo de Respuestas </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="644" border="1" align="center">
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td width="83" class="style12"><div align="left">C&oacute;digo:</div></td>
       <td width="538" class="style12">
	   
	   <input name="codigoLR" type="text" class="style12" id="codigoLR" value ="<?php echo $myrow2['codigoLR'] ?>" <?php if($myrow2['codigoLR']){ echo " ".'readonly=""'; } ?> size="60"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n: </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="descripcionLR" cols="120" rows="5" class="Estilo24" id="descripcionLR"><?php echo $myrow2['descripcionLR'] ?></textarea>
       </span></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">&nbsp;</td>
       <td class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar M&oacute;dulo" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar M&oacute;dulo" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From listaRespuestas order by codigoLR ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="646" border="1" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
       <th width="531" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n </span></th>
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
$C=$myrow['codigoLR'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
         <input name="codigoLR2" type="submit" class="style12" id="codigoLR2" value="<?php echo $C?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionLR'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
