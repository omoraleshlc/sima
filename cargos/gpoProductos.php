<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php");?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
<?php
if($_POST['actualizar'] AND $_POST['codigoGP']){
$sSQL1= "Select * From gpoProductos WHERE codigoGP = '".$_POST['codigoGP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoGP']){
if($_POST['codigoGP']!=$myrow1['codigoGP']){

$agrega = "INSERT INTO gpoProductos (
codigoGP,descripcionGP,ctaContableCostoGP,ctaContableIngresoGP,tasaGP,activo
) values ('".$_POST['codigoGP']."','".$_POST['descripcionGP']."',
'".$_POST['ctaContableCostoGP']."','".$_POST['ctaContableIngresoGP']."',
'".$_POST['tasaGP']."','activo')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL GRUPO DE PRODUCTO!"
</script>';
}} else {
 $q = "UPDATE gpoProductos set 
codigoGP= '".$_POST['codigoGP']."', 
descripcionGP='".$_POST['descripcionGP']."',
ctaContableCostoGP='".$_POST['ctaContableCostoGP']."',
ctaContableIngresoGP='".$_POST['ctaContableIngresoGP']."',
tasaGP='".$_POST['tasaGP']."',
activo='".$_POST['activo']."'
WHERE 
codigoGP='".$_POST['codigoGP']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO EL GRUPO DE PRODUCTO!"
</script>';

}
}

if($_POST['borrar'] AND $_POST['codigoGP']){
$borrame = "DELETE FROM gpoProductos WHERE codigoGP ='".$_POST['codigoGP']."'";
mysql_db_query($basedatos,$borrame);
$borrame = "DELETE FROM articulos WHERE gpoProducto ='".$_POST['codigoGP']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL GRUPO DE  PRODUCTO!"
</script>';

}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoGP'] = "";
}
 if($_POST['codigoGP1']){
$sSQL2= "Select * From gpoProductos WHERE codigoGP = '".$_POST['codigoGP1']."' ";
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
 <h1 align="center">Cat&aacute;logo de Grupo de Productos </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="678" border="0" align="center">
     <tr>
       <th width="1" rowspan="7" class="style12" scope="col">&nbsp;</th>
       <th width="120" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo GP : </div>         <label></label></th>
       <th width="535" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left">
           <input name="codigoGP" type="text" class="style12" id="codigoGP" value="<?php echo $myrow2['codigoGP'] ?>" size="10" maxlength="6"/>
           </div></th></tr>
     <tr>
       <td class="style12">Descripci&oacute;n de GP:</td>
       <td class="style12"><input name="descripcionGP" type="text" class="style12" id="descripcionGP" value ="<?php echo $myrow2['descripcionGP'] ?>" size="60"/></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Tasa: </td>
       <td bgcolor="#FFCCFF" class="style12"><label>
       <?php //*********TASA
	 
 $sSQL7= "Select * From TASA ORDER BY codTASA ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error(); ?>
       <select name="tasaGP" class="style12" id="tasaGP">
         <?php 		if($myrow2['tasaGP']!=null){ ?>
         <option value="<?php echo $myrow2['tasaGP']; ?>"><?php echo $myrow2['tasaGP']; ?></option>
         <?php } ?>
         <option></option>
         <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
         <option value="<?php echo $myrow7['valorTasa']; ?>"><?php echo $myrow7['codTasa']; ?></option>
         <?php } 
		
		?>
       </select>
       </label>
       </label></td>
     </tr>
     <tr>
       <td class="style12">Cta. Contable Costo: </td>
       <td class="style12"><label>
         <input name="ctaContableCostoGP" type="text" class="style12" id="ctaContableCostoGP" value="<?php echo $myrow2['ctaContableCostoGP']; ?>" />
       </label></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Cta. Contable Ingreso: </td>
       <td bgcolor="#FFCCFF" class="style12"><input name="ctaContableIngresoGP" type="text" class="style12" id="ctaContableIngresoGP" value="<?php echo $myrow2['ctaContableIngresoGP']; ?>" /></td>
     </tr>
     <tr>
       <td class="style12">Grupo Activo?</td>
       <td class="style12"><select name="activo" class="style12" id="activo">
     
         
           <option
		     <?php 		if($myrow2['activo']=='A'){ ?>
			 selected="selected"
			<?php } ?> 
		    value="activo">activo</option>
                    <option
					  <?php 		if($myrow2['activo']=='inactivo'){ ?>
			 selected="selected"
			<?php } ?> 
					 value="inactivo">inactivo</option>
		
		
         </select></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar gpoPrecio" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar gpoPrecio" /></td>
     </tr>
   </table>
</form>
 <p>
   <?php   
 $sSQL= "Select distinct * From gpoProductos ORDER BY activo DESC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="606" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo GP</span></th>
       <th width="332" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n de Productos </span></th>
       <th width="84" bgcolor="#660066" scope="col"><span class="style11">Cta. C. Ingreso </span></th>
       <th width="33" bgcolor="#660066" scope="col"><span class="style11">TASA</span></th>
       <th width="36" bgcolor="#660066" scope="col"><span class="style11">Activo?</span></th>
     </tr>
     <tr>
       <?php	
	   while($myrow = mysql_fetch_array($result)){
	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigoGP'];
?>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <label>
         <input name="codigoGP1" type="submit" class="style12" id="codigoGP1" value="<?php echo $C?>"/>
         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcionGP'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <?php if($myrow['ctaContableIngresoGP']){
	   echo $myrow['ctaContableIngresoGP']; } else {
	   echo "No Asignada";
	   }
	   ?>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <?php if($myrow['tasaGP']!=null){
	   echo $myrow['tasaGP']; } else {
	   echo "N/A";
	   }
	   ?>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
       <?php if($myrow['activo']){
	   echo $myrow['activo']; } else {
	   echo "inactivo";
	   }
	   ?>
       </span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>