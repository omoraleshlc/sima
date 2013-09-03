<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php
if($_POST['actualizar'] AND $_POST['usuario'] AND $_POST['ip']){
$sSQL1= "Select * From usuariosIP WHERE usuario = '".$_POST['usuario']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['usuario']){
if($_POST['usuario']!=$myrow1['usuario']){

$agrega = "INSERT INTO usuariosIP (
usuario,ip,mac
) values ('".$_POST['usuario']."','".$_POST['ip']."','".$_POST['mac']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
ip_agregada();
}} else {
$q = "UPDATE usuariosIP set 
usuario='".$_POST['usuario']."', 
ip='".$_POST['ip']."',
mac='".$_POST['mac']."'
WHERE 
usuario='".$_POST['usuario']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
ip_modificada();
}
}

if($_POST['borrar'] AND $_POST['usuario']){
$borrame = "DELETE FROM usuariosIP WHERE usuario ='".$_POST['usuario']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
ip_borrada();
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['usuario'] = "";
}


if($_POST['usuario2']){
$sSQL2= "Select * From usuariosIP WHERE usuario = '".$_POST['usuario2']."' ";
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
 <p align="center">Cat&aacute;logo de Direcciones IP </p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="644" border="1" align="center">
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <th width="83" class="style12" scope="col"><div align="left">Usuario: </div>         <label></label></th>
       <th width="538" class="style12" scope="col"><div align="left">
         <?php //*********seguros
$cmdstr1 = "select * from PEDRO.USUARIO ORDER BY NOMBRE ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
?>
         <select name="usuario" class="Estilo24" id="tipoUsuario" onchange="javascript:this.form.submit();">
           <?php if($_POST['usuario1']){ ?>
           <option value="<?php echo $_POST['usuario']; ?>"><?php echo  $_POST['usuario']; ?></option>
           <?php } else {?>
           <option></option>
           <?php } ?>
           <option value="">---</option>
           <?php  	 		 
		    for ($i = 0; $i < $nrows1; $i++ ){
		    ?>
           <option value="<?php echo $results1['LOGIN'][$i]; ?>"><?php echo $results1['NOMBRE'][$i]." ".$results1['AP_PATERNO'][$i]." ".$results1['AP_MATERNO'][$i]; ?></option>
           <?php } 
		
		?>
         </select>
</div></th>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12"><div align="left">Direcci&oacute;n IP:</div></td>
       <td class="style12"><input name="ip" type="text" class="style12" id="ip" value ="<?php echo $myrow2['ip'] ?>" size="60"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Mac Address: </td>
       <td class="style12"><input name="mac" type="text" class="style12" id="mac" value ="<?php echo $myrow2['mac'] ?>" size="60"/> 
         Formato: 00:0B:CB:78:22:65</td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">&nbsp;</td>
       <td class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Direcci&oacute;n IP" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Direcci&oacute;n IP-MAC" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From usuariosIP order by usuario ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="591" border="1" align="center">
     <tr>
       <th width="155" bgcolor="#660066" scope="col"><span class="style11">Usuarios </span></th>
       <th width="207" bgcolor="#660066" scope="col"><span class="style11">Direcci&oacute;n IP </span></th>
       <th width="207" bgcolor="#660066" scope="col"><span class="style11">Mac Address</span></th>
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
         <input name="usuario2" type="submit" class="style12" id="usuario2" value="<?php echo $myrow['usuario'];?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['ip'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['mac'];?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
