<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php");?>

<?php
if($_POST['actualizar'] AND $_POST['codigoUM2']){
$sSQL1= "Select * From umVentas WHERE keyUMV = '".$_POST['codigoUM2']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoUM']){
if($_POST['codigoUM']!=$myrow1['codigoUM']){

$agrega = "INSERT INTO umVentas (
codigoUM,descripcionUM,entidad
) values ('".$_POST['codigoUM']."','".$_POST['descripcionUM']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA AGREGADA"
</script>';
}} else {
$q = "UPDATE umVentas set 
descripcionUM='".$_POST['descripcionUM']."'
WHERE 
keyUMV = '".$_POST['codigoUM2']."' ";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA ACTUALIZADA"
</script>';

}
}

if($_POST['borrar'] AND $_POST['codigoUM']){
$borrame = "DELETE FROM umVentas WHERE entidad='".$entidad."' AND codigoUM ='".$_POST['codigoUM2']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "UNIDAD DE MEDIDA ELIMINADA"
</script>';

}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoUM2'] = "";
}


if($_POST['codigoUM2']){
$sSQL2= "Select * From umVentas WHERE keyUMV = '".$_POST['codigoUM2']."' ";
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
 <h1 align="center">Cat&aacute;logo de Unidades de Medida (VENTAS) </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label></p>
   <table width="559" border="0" align="center">
     <tr>
       <th width="1" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <th width="102" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo UM </div>         
       <label></label>       </th>
       <th width="434" bgcolor="#FFCCFF" class="style12" scope="col"><label>         </label>
         
         <label><div align="left">
           
           <?php //*********Unidades de Medida
	 


 $sSQL71= "Select distinct * From unidadMedida where entidad='".$entidad."' 
codigoUM <>'s'
 ORDER BY descripcionUM ASC ";
$result71=mysql_db_query($basedatos,$sSQL71); 


	  ?>
           <select name="um" class="style12" id="um">
             <?php 		if($myrow2['id_um']){ ?>
             <option value="<?php echo $myrow2['id_um']; ?>"><?php echo $myrow2['id_um']; ?></option>
             <option value="">---</option>
             <?php } ?>
             <?php  	 		 
		   while($myrow71 = mysql_fetch_array($result71)){ ?>
             <option value="<?php echo $myrow71['codigoUM']; ?>"><?php echo $myrow71['descripcionUM']." || ".$myrow71['codigoUM']; ?></option>
             <?php } ?>
           </select>
           </div>
       </label></th>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">UM Venta Pieza:</td>
       <td class="style12"><input name="descripcionUM" type="text" class="style12" id="descripcionUM" value ="<?php echo $myrow2['umVentas']; ?>" size="60"/></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">Venta x Caja:</td>
       <td bgcolor="#FFCCFF" class="style12"><select name="caja" class="style12" id="caja">
         <?php 
		 if($myrow2['caja']){ ?>
         <option value="<?php echo $myrow2['caja'];?>"><?php echo $myrow2['caja'];?></option>
         <option value="">---</option>
         <?php }
		 ?>
         <option value="Si">Si</option>
         <option value="No">No</option>
       </select></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">Unidades:</td>
       <td class="style12"><input name="unidades" type="text" class="style12" id="unidades" value ="<?php echo $myrow2['unidades']; ?>" size="60"/></td>
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
 $sSQL= "Select * From umVentas where entidad='".$entidad."' order by id_um ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="631" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo UM  </span></th>
       <th width="145" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo UM </span></th>
       <th width="109" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
       <th width="108" bgcolor="#660066" scope="col"><span class="style11">UM Ventas </span></th>
       <th width="56" bgcolor="#660066" scope="col"><span class="style11">Caja</span></th>
       <th width="88" bgcolor="#660066" scope="col"><span class="style11">Unidades</span></th>
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
$U=$myrow['keyUMV'];
$Ur=$myrow['id_um'];
$sSQL1= "Select * From unidadMedida where codigoUM = '".$Ur."'";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
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
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['id_um'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow1['descripcionUM'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['umVentas'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['caja'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['unidades'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>