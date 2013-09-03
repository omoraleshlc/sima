<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php
if($_POST['actualizar'] AND $_POST['codigoLP'] ){
$sSQL1= "Select * From listaPreguntas WHERE codigoLP = '".$_POST['codigoLP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoLP']){
if($_POST['codigoLP']!=$myrow1['codigoLP']){

$agrega = "INSERT INTO listaPreguntas (
codigoLP,descripcionLP
) values ('".$_POST['codigoLP']."','".$_POST['descripcionLP']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO UNA PREGUNTA"
</script>'; 
}} else {
$q = "UPDATE listaPreguntas set 

descripcionLP='".$_POST['descripcionLP']."'

WHERE 
codigoLP='".$_POST['codigoLP']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE MODIFICO LA PREGUNTA"
</script>'; 
}
}

if($_POST['borrar'] AND $_POST['codigoLP']){
$borrame = "DELETE FROM listaPreguntas WHERE codigoLP ='".$_POST['codigoLP']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO ESA PREGUNTA"
</script>'; 
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoLP'] = "";
}


if($_POST['codigoLP2']){
 $sSQL2= "Select * From listaPreguntas WHERE codigoLP = '".$_POST['codigoLP2']."' ";
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
 <h1 align="center">Cat&aacute;logo de Preguntas </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="644" border="1" align="center">
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td width="83" class="style12"><div align="left">C&oacute;digo:</div></td>
       <td width="538" class="style12"><input name="codigoLP" type="text" class="style12" id="codigoLP" value ="<?php echo $myrow2['codigoLP'] ?>" <?php if($myrow2['codigoLP']){ echo " ".'readonly=""'; } ?> size="60"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n: </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="descripcionLP" cols="120" rows="5" class="Estilo24" id="descripcionLP"><?php echo $myrow2['descripcionLP'] ?></textarea>
       </span></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">&nbsp;</td>
       <td class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Pregunta" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Pregunta" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From listaPreguntas order by codigoLP ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="646" border="1" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo </span></th>
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
$C=$myrow['codigoLP'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
         <input name="codigoLP2" type="submit" class="style12" id="codigoLP2" value="<?php echo $C?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionLP'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
