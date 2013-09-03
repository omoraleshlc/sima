<?php require("menuOperaciones.php"); ?>

<?php
if($_POST['actualizar'] AND $_POST['codigoSala']){
$sSQL1= "Select * From salas WHERE entidad='".$entidad."' AND codigoSala = '".$_POST['codigoSala']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoSala']){
if($_POST['codigoSala']!=$myrow1['codigoSala']){

$agrega = "INSERT INTO salas (
codigoSala,descripcionSala,entidad
) values ('".$_POST['codigoSala']."','".$_POST['descripcionSala']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
sala_agregada();
}} else {
$q = "UPDATE salas set 
descripcionSala='".$_POST['descripcionSala']."'
WHERE entidad='".$entidad."' AND
codigoSala='".$_POST['codigoSala']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
sala_actualizada();
}
}

if($_POST['borrar'] AND $_POST['codigoSala']){
$borrame = "DELETE FROM salas WHERE entidad='".$entidad."' AND codigoSala ='".$_POST['codigoSala']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
sala_eliminada();
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoSala'] = "";
}
if($_POST['codigoSala2']){
$sSQL2= "Select * From salas WHERE codigoSala = '".$_POST['codigoSala2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>
<body>
 <p align="center"><strong>Cat&aacute;logo de Salas</strong></p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>

   <table width="600" class="table-forma">
     <tr>
       <td width="79" height="40"  scope="col">C&oacute;digo Sala:</td>
       <td width="435"   scope="col"><div align="left">
         <input name="codigoSala" type="text" id="codigoSala" 
		 value="<?php echo $myrow2['codigoSala']; ?>" size="10" maxlength="6"/>
       </div></td>
     </tr>
     <tr>
       <td height="36" >Descripci&oacute;n de la Sala:</td>
       <td  ><input name="descripcionSala" type="text" id="descripcionSala" value ="<?php echo $myrow2['descripcionSala']; ?>" size="60"/></td>
     </tr>
     <tr>
       <td height="40"  >&nbsp;</td>
       <td  ><input name="agregar" type="submit" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" id="borrar" value="Eliminar Sala" />
         <input name="actualizar" type="submit" id="actualizar" value="Modificar/Grabar Sala" /></td>
     </tr>
   </table>

   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From salas where entidad='".$entidad."' order by descripcionSala ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="421" class="table table-striped">
     <tr>
       <th width="232"  scope="col"><span >C&oacute;digo Sala </span></th>
       <th width="155"  scope="col"><span >Descripci&oacute;n de la Sala</span></th>
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
       <td bgcolor="<?php echo $color?>" ><span class="style7">
         <label>
         <input name="codigoSala2" type="submit" id="codigoSala2" value="<?php echo $myrow['codigoSala'];?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" ><span class="style7"><?php echo $myrow['descripcionSala'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
