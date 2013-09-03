<?php include("/configuracion/administracionhospitalaria/menufinancieros.php"); ?>
<?php
 $module = $_POST['modulo'];
if($_POST['actualizar'] AND $_POST['hora'] AND $_POST['keyHora']){
$sSQL1= "Select * FROM catCitas WHERE keyHora = '".$_POST['keyHora']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();
if(!$myrow1['keyHora']){
if($_POST['keyHora']!=$myrow1['keyHora']){

$agrega = "INSERT INTO catCitas (
keyHora,hora,comentario,usuario
) values ('".$_POST['keyHora']."','".$_POST['hora']."','".$_POST['comentario']."','".$usuario."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//modulo_insertado();

}} else {
$q = "UPDATE catCitas set 
hora='".$_POST['hora']."',
comentario='".$_POST['comentario']."'
WHERE 
keyHora='".$_POST['keyHora']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

//modulo_actualizado();
}
}

if($_POST['borrar'] AND $_POST['hora']){
$borrame = "DELETE FROM catCitas WHERE keyHora ='".$_POST['keyHora']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
//borradoAlmacen();
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['keyHora'] = "";
}


if($_POST['keyHora2']){
$sSQL2= "Select * From catCitas WHERE keyHora = '".$_POST['keyHora2']."' ";
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
 <p align="center">Cat&aacute;logo de Horas disponibles para citas </p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="486" border="0" align="center">
     <tr>
       <th width="1" rowspan="5" class="style12" scope="col">&nbsp;</th>
       <th bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo Hora: </div></th>
       <th bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
         <input name="keyHora" type="text" class="style12" id="keyHora" value="<?php echo $myrow2['keyHora']; ?>" size="10"/>
       Relaci&oacute;n 1-&gt;8:00 am </div></th>
     </tr>
     <tr>
       <th width="115" class="style12" scope="col"><div align="left">Hora: </div>         
         <label></label></th>
       <th width="348" class="style12" scope="col"><div align="left">
         <input name="hora" type="text" class="style12" id="hora" value="<?php echo $myrow2['hora']; ?>" size="10"/>
         Formato: 8:00 am 
       </div></th>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Comentario:</td>
       <td bgcolor="#FFCCFF" class="style12"><input name="comentario" type="text" class="style12" id="comentario" value ="<?php echo $myrow2['comentario']; ?>" size="60"/></td>
     </tr>
     <tr>
       <td colspan="2" class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Cita" />
       <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Cita" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select distinct * From catCitas order by keyHora ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="530" border="0" align="center">
     <tr>
       <th width="162" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo de la Cita </span></th>
       <th width="74" bgcolor="#660066" scope="col"><span class="style11">Hora</span></th>
       <th width="272" bgcolor="#660066" scope="col"><span class="style11">Comentario</span></th>
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
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
         <input name="keyHora2" type="submit" class="style12" id="keyHora2" value="<?php echo $myrow['keyHora'];?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <?php echo $myrow['hora'];
	 ?>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php 
	   if($myrow['comentario']){
	   echo $myrow['comentario'];
	   } else {
	   echo "N/A";
	   }
	   ?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>