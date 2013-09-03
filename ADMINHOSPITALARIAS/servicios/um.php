<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php");?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
<?php
if($_POST['actualizar'] AND $_POST['codigoUM']){
$sSQL1= "Select * From unidadMedida WHERE codigoUM = '".$_POST['codigoUM']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoUM']){
if($_POST['codigoUM']!=$myrow1['codigoUM']){

$agrega = "INSERT INTO unidadMedida (
codigoUM,descripcionUM,entidad
) values ('".$_POST['codigoUM']."','".$_POST['descripcionUM']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA AGREGADA"
</script>';
}} else {
$q = "UPDATE unidadMedida set 
descripcionUM='".$_POST['descripcionUM']."'
WHERE 
codigoUM='".$_POST['codiguUM']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA ACTUALIZADA"
</script>';

}
}

if($_POST['borrar'] AND $_POST['codigoUM']){
$borrame = "DELETE FROM unidadMedida WHERE entidad='".$entidad."' AND codigoUM ='".$_POST['codigoUM']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA ELIMINADA"
</script>';

}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoUM'] = "";
}


if($_POST['codigoUM2']){
$sSQL2= "Select * From unidadMedida WHERE entidad='".$entidad."' AND codigoUM = '".$_POST['codigoUM2']."' ";
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
 <h1 align="center">Cat&aacute;logo de Unidades de Medida </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="559" border="0" align="center">
     <tr>
       <th width="1" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <th width="50" bgcolor="#FFCCFF" class="style12" scope="col">C&oacute;digo UM
       <label></label></th>
       <th width="486" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
         <input name="codigoUM" type="text" class="style12" id="codigoUM" 
		 value="<?php echo $myrow2['codigoUM']; ?>" size="10" maxlength="6" 
		 <?php if($myrow2['codigoUM']){ echo 'readonly=""';}?>
		 />
       </div></th>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">Descripci&oacute;n:</td>
       <td class="style12"><input name="descripcionUM" type="text" class="style12" id="descripcionUM" value ="<?php echo $myrow2['descripcionUM']; ?>" size="60"/></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar UM" />
       <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar UM" /></td>
     </tr>
   </table>
</form>
 <p>
   <?php   
 $sSQL= "Select * From unidadMedida order by descripcionUM ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="222" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo U de Medida </span></th>
       <th width="113" bgcolor="#660066" scope="col"><span class="style11">Unidad de Medida</span></th>
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
$U=$myrow['codigoUM'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
		 <?php if($U!='s'){ ?>
         <input name="codigoUM2" type="submit" class="style12" id="codigoUM2" value="<?php echo $U?>"/>
         <?php } else {	 echo "Servicio/Procedimiento";
		 }
		 ?>
		 </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionUM'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>