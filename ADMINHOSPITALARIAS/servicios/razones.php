<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php");?>

<?php
if($_POST['actualizar'] AND $_POST['codRazon']){
$sSQL1= "Select * From razones WHERE codRazon = '".$_POST['codRazon']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codRazon']){
if($_POST['codRazon']!=$myrow1['codRazon']){

$agrega = "INSERT INTO razones (
codRazon,descripcionRazon,cuentaContable,tipo,tipoCuenta,entidad
) values ('".$_POST['codRazon']."','".$_POST['descripcionRazon']."','".$_POST['cuentaContable']."','".$_POST['tipo']."','".$_POST['tipoCuenta']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">';?>
msgbox "SE AGREGO EL CODIGO DE RAZON <?php echo $_POST['descripcionRazon'];?>"
<?php echo '</script>';
}} else {
$q = "UPDATE razones set 
descripcionRazon='".$_POST['descripcionRazon']."', 
cuentaContable='".$_POST['cuentaContable']."',
tipoCuenta='".$_POST['tipoCuenta']."',
tipo='".$_POST['tipo']."'
WHERE 
entidad='".$entidad."' AND
codRazon='".$_POST['codRazon']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">';?>
msgbox "SE MODIFICO CODIGO DE RAZON <?php echo $_POST['descripcionRazon'];?>"
<?php echo '</script>';
}
}

if($_POST['borrar'] AND $_POST['codRazon']){
$borrame = "DELETE FROM razones WHERE entidad='".$entidad."' AND codRazon ='".$_POST['codRazon']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">';?>
msgbox "SE ELIMINO EL CODIGO DE RAZON <?php echo $_POST['codRazon'];?>"
<?php echo '</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codRazon'] = "";
}


if($_POST['almacen2']){
$sSQL2= "Select * From razones WHERE entidad='".$entidad."' and codRazon = '".$_POST['almacen2']."' ";
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
 <h1 align="center">Cat&aacute;logo de Razones </h1>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <label></label>
   </p>
   <table width="616" border="0" align="center" bordercolor="#000000">
     <tr>
       <th width="8" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <th width="119" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo de Raz&oacute;n : </div>         <label></label></th>
       <th width="419" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
         <input name="codRazon" type="text" class="style12" id="codRazon" value="<?php echo $myrow2['codRazon'] ?>" size="10"
		 <?php if($myrow2['codRazon']){ echo 'readonly=""';}?>
		 />
       </div></th>
     </tr>
     <tr>
       <th width="8" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n:</td>
       <td class="style12"><input name="descripcionRazon" type="text" class="style12" id="descripcionRazon" value ="<?php echo $myrow2['descripcionRazon'] ?>" size="60"/></td>
     </tr>
     <tr>
       <th bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Cta: Contable </span></td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <?php //*********
$cmdstr1 = "select distinct ID_CCOSTO,NOMBRE from MATEO.CONT_CCOSTO WHERE DETALLE ='S'
AND ID_CCOSTO LIKE '4.01%'
 ORDER BY ID_CCOSTO ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
?>
       </span>
         <select name="cuentaContable" class="Estilo24" id="cuentaContable"/>
     
         <?php if($_POST['cuentaContable']){ ?>
         <option value="<?php echo $_POST['cuentaContable']; ?>"><?php echo $_POST['cuentaContable']; ?></option>
         <?php } else if($myrow2['cuentaContable']){ ?>
         <option value="<?php echo $myrow2['cuentaContable']; ?>"><?php echo  $myrow2['cuentaContable']; ?></option>
         <?php } else {?>
         <option></option>
         <?php } ?>
         <option value="">---</option>
         <?php  	 		 
		    for ($i = 0; $i < $nrows1; $i++ ){
		    ?>
         <option value="<?php echo $results1['ID_CCOSTO'][$i]; ?>"><?php echo $results1['ID_CCOSTO'][$i]." || ".$results1['NOMBRE'][$i]; ?></option>
         <?php } 
		
		?>
       </select></td>
     </tr>
     <tr>
       <th width="8" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Concepto:</td>
       <td class="style12"><label>
         <select name="tipoCuenta" class="style7" id="tipoCuenta">
		 <?php if($_POST['tipoCuenta']){ ?>
		 <option value="<?php echo $_POST['tipoCuenta'];?>"><?php echo $_POST['tipoCuenta'];?></option>
	
		  <?php } else if($myrow2['tipoCuenta']){ ?>
         <option value="<?php echo $myrow2['tipoCuenta']; ?>"><?php echo  $myrow2['tipoCuenta']; ?></option>
		   <option>---</option>
         <?php } else {?>
         <option></option>
         <?php } ?>
           <option value="C">C</option>
           <option value="D">D</option>
        </select>
       </label></td>
     </tr>
     <tr>
       <th width="8" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Raz&oacute;n" />
       <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Raz&oacute;n" /></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From razones order by codRazon ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="547" border="0" align="center" bordercolor="0">
     <tr>
       <th width="123" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo Raz&oacute;n </span></th>
       <th width="269" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n de la Raz&oacute;n </span></th>
       <th width="64" bgcolor="#660066" scope="col"><span class="style11">Cta. Contable</span></th>
       <th width="63" bgcolor="#660066" scope="col"><span class="style11">Tipo Cuenta</span></th>
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
$R=$myrow['codRazon'];
?>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <label>
         <input name="almacen2" type="submit" class="style12" id="almacen2" value="<?php echo $R?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcionRazon'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['cuentaContable'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	   if($myrow['tipoCuenta']){
	   echo $myrow['tipoCuenta'];
	   } else {
	   echo "---";
	   }
	   ?></span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>