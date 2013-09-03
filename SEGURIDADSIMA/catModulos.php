<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php
 $module = $_POST['modulo'];
if($_POST['actualizar'] AND $_POST['codModulo']){
$sSQL1= "Select * FROM modulos WHERE codModulo = '".$_POST['codModulo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();
if(!$myrow1['codModulo']){
if($_POST['codModulo']!=$myrow1['codModulo']){

$agrega = "INSERT INTO modulos (
codModulo,modulo
) values ('".$_POST['codModulo']."','".$module."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
modulo_insertado();

}} else {
$q = "UPDATE modulos set 
modulo='".$_POST['modulo']."'
WHERE 
codModulo='".$_POST['codModulo']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

modulo_actualizado();
}
}

if($_POST['borrar'] AND $_POST['codModulo']){
$borrame = "DELETE FROM modulos WHERE codModulo ='".$_POST['codModulo']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
borradoAlmacen();
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codModulo'] = "";
}


if($_POST['codModulo2']){
$sSQL2= "Select * From modulos WHERE codModulo = '".$_POST['codModulo2']."' ";
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
-->
</style>
</head>

<body>
 <p align="center">Cat&aacute;logo de m&oacute;dulos </p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="486" border="1" align="center">
     <tr>
       <th width="1" rowspan="4" class="style12" scope="col">&nbsp;</th>
       <th width="115" class="style12" scope="col"><div align="left">C&oacute;digo del M&oacute;dulo : </div>         <label></label></th>
       <th width="348" class="style12" scope="col"><div align="left">
         <input name="codModulo" type="text" class="style12" id="codModulo" value="<?php echo $myrow2['codModulo']; ?> " size="10"/>
       </div></th>
     </tr>
     <tr>
       <td class="style12">Nombre del M&oacute;dulo:</td>
       <td class="style12"><input name="modulo" type="text" class="style12" id="modulo" value ="<?php echo $myrow2['modulo']; ?>" size="60"/></td>
     </tr>
     <tr>
       <td colspan="2" class="style12">&nbsp;</td>
     </tr>
     <tr>
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
 $sSQL= "Select * From modulos order by modulo ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="465" border="1" align="center">
     <tr>
       <th width="173" bgcolor="#333333" scope="col"><span class="style11">C&oacute;digo del M&oacute;dulo </span></th>
       <th width="276" bgcolor="#333333" scope="col"><span class="style11">Nombre del M&oacute;dulo</span></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){

?>
       <td bgcolor="#FFFFFF" class="style12"><span class="style7">
         <label>
         <input name="codModulo2" type="submit" class="style12" id="codModulo2" value="<?php echo $myrow['codModulo'];?>" />
         </label>
       </span></td>
       <td bgcolor="#FFFFFF" class="style12"><span class="style7"><?php echo $myrow['modulo'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
