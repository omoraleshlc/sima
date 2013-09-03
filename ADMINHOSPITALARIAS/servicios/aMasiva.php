<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php
$por=$_POST['porcentaje'];
$porcentaje=$por/100;
if($_POST['actualizar'] AND $_POST['codigoGP'] AND $_POST['porcentaje']!=null AND $_POST['porcentaje']){
$sSQL6 = "select precioArticulos.codigo,precio * '".$porcentaje."' as porciento,descripcion,precio as precioArticulos
from precioArticulos,articulos 
WHERE 
precioArticulos.codigo=articulos.codigo and articulos.gpoProducto='".$_POST['codigoGP']."'";
$result6=mysql_db_query($basedatos,$sSQL6);
while($myrow6 = mysql_fetch_array($result6)){
$precio=$myrow6['precioArticulos'];
$codec=$myrow6['codigo'];
$porciento=$myrow6['porciento'];
$precio+=$porciento;
$q = "UPDATE precioArticulos set 
precio='".$precio."',
porcentaje='".$_POST['porcentaje']."',
fechaPrecio='".$fecha1."',
usuario='".$usuario."'
WHERE codigo = '".$codec."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
}
$q = "UPDATE gpoProductos set 
porcentaje= '".$_POST['porcentaje']."', 
usuario='".$usuario."',
fechaPrecio='".$fecha1."',
ip='".$ip."'

WHERE 
codigoGP='".$_POST['codigoGP']."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
gpoProcuto_actualizado();

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
 <h1 align="center">Actualizacion Masiva de Precios </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="678" border="0" align="center">
     <tr>
       <th width="1" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <th width="120" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo GP : </div>         <label></label></th>
       <th width="535" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left">
           <input name="codigoGP" type="text" class="style12" id="codigoGP" value="<?php echo $myrow2['codigoGP'] ?>" size="10" maxlength="6"/>
         </div></th>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n de GP:</td>
       <td class="style12"><input name="descripcionGP" type="text" class="style12" id="descripcionGP" value ="<?php echo $myrow2['descripcionGP'] ?>" size="60"/></td>
     </tr>
     <tr>
       <th width="1" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style12">Porcentaje: </td>
       <td bgcolor="#FFCCFF" class="style12"><label>
         <input name="porcentaje" type="text" class="style12" id="porcentaje" value ="<?php echo $myrow2['porcentaje'] ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
       </label></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">&nbsp;</td>
       <td class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar gpoPrecio" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar gpoPrecio" /></td>
     </tr>
   </table>
</form>
 <p>
   <?php   
 $sSQL= "Select distinct * From gpoProductos where activo='activo'
  ORDER BY descripcionGP ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="616" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo GP</span></th>
       <th width="321" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n de Productos </span></th>
       <th width="67" bgcolor="#660066" scope="col"><span class="style11">Porcentaje</span></th>
       <th width="111" bgcolor="#660066" scope="col"><span class="style11">Fecha de Modificaci&oacute;n </span></th>
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
         <input name="codigoGP1" type="submit" class="style12" id="codigoGP1" value="<?php echo $C?>" disabled="disabled" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcionGP'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <?php if($myrow['porcentaje']){
	   echo $myrow['porcentaje']; } else {
	   echo "No Asignado";
	   }
	   ?>
       </span></td>
<td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
  <?php if($myrow['fechaPrecio']){
	   echo $myrow['fechaPrecio']; } else {
	   echo "No Asignada";
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