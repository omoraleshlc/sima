<?PHP include("/configuracion/administracionhospitalaria/medicos/medicosmenu.php"); ?>
<?php
if($_POST['actualizar'] AND $_POST['tipoMedicos']){
$sSQL1= "Select * From tipoMedico WHERE entidad='".$entidad."' AND tipoMedicos = '".$_POST['tipoMedicos']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['tipoMedicos']){
if($_POST['tipoMedicos']!=$myrow1['tipoMedicos']){
$agrega = "INSERT INTO tipoMedico (
tipoMedicos,descripcionTipoMedico,ctaContable,usuario,fecha1
) values ('".$_POST['tipoMedicos']."','".$_POST['descripcionTipoMedico']."',
'".$_POST['ctaContable']."','".$usuario."','".$fecha1."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO AL REGISTRO EL PROCEDIMIENTO"
</script>';
}} else {
$q = "UPDATE tipoMedico set 
descripcionTipoMedico='".$_POST['descripcionTipoMedico']."',
ctaContable='".$_POST['ctaContable']."',
fecha1='".$fecha1."',
usuario='".$usuario."'

WHERE entidad='".$entidad."' AND
tipoMedicos='".$_POST['tipoMedicos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO EL PROCEDIMIENTO!"
</script>';
}
}
if($_POST['borrar'] AND $_POST['auto2']){
$borrame = "DELETE FROM tipoMedico WHERE entidad='".$entidad."' AND  auto ='".$_POST['auto2']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "EL PROCEDIMIENTO SE ELIMINO !"
</script>';
}
if($_POST['agregar']){
/** checo si existe**/
$_POST['tipoMedico'] = "";
}
if($_POST['auto']){
$sSQL2= "Select * From tipoMedico WHERE entidad='".$entidad."' AND auto = '".$_POST['auto']."'";
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
body {
font-family: Arial, Helvetica, sans-serif;
font-size: 10pt;
margin: 0px;
padding:20px 0px;
text-align: center;
}
#nav {
padding: 0px;
width: 515px;
margin:0px auto;
}
#mainnav {
margin: 0px;
padding: 0px;
list-style-image: none;
list-style-type: none;
}
#mainnav li {
padding: 0px;
float: left;
margin:0px 3px 0px 0px;
}
#mainnav li a:link, #mainnav li a:visited, #mainnav li a:active {
color: #333;
text-decoration: none;
margin: 0px;
display: block;
float: left;
border-bottom:solid 5px #dadada;
padding: 0px;
width: 100px;
height: 20px;
text-align: center;
}
#mainnav li a:hover {
text-decoration: none;
border-bottom:solid 5px #333;
}
#mainnav li a.active:link, #mainnav li a.active:visited, #mainnav li a.active:active, #mainnav li a.active:hover {
text-decoration: none;
border-bottom:solid 5px #990000;
} 
</style>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de Tipo de M&eacute;dico </h1>
<form id="form1" name="form1" method="post" action="">
<p>
     <label></label></p>
   <table width="813" border="1" align="center">
     <tr>
       <th class="style12" scope="col">&nbsp;</th>
       <th class="style12" scope="col">N&deg; Identificaci&oacute;n </th>
       <th class="style12" scope="col"><div align="left">
         <input name="auto2" type="text" class="Estilo24" id="auto2" 
		 value="<?php if(!$myrow2['auto']){ echo 'id';} else {echo $myrow2['auto'];}?>" size="3" maxlength="3" 
		  readonly=""/>
       </div></th>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <th width="186" class="style12" scope="col"><div align="left">Tipo de M&eacute;dico</div>         
         <label></label></th>
       <th width="604" class="style12" scope="col"><div align="left">
         <input name="tipoMedicos" type="text" class="style12" id="tipoMedicos" 
		 value="<?php echo $myrow2['tipoMedicos']; ?>" size="50" <?php if($myrow2['codigo']){ echo ' '.'readonly="readonly"';}?>/>
       </div></th>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12"><div align="left">Descripci&oacute;n del Tipo de M&eacute;dico </div></td>
       <td class="style12"><input name="descripcionTipoMedico" type="text" class="style12" id="descripcionTipoMedico" value ="<?php echo $myrow2['descripcionTipoMedico']; ?>" size="120"/></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Cuenta Contable: </td>
       <td class="style12"><span class="Estilo24">
         <?php //*********
$cmdstr1 = "select * from MATEO.CONT_CTAMAYOR WHERE TIPO_CUENTA='R'
AND ID_EJERCICIO ='".$ID_EJERCICIOM."' 
ORDER BY NOMBRE ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
?>
        <select name="ctaContable" class="Estilo24" id="ctaContable"/>                  
       <?php 		if($myrow2['ctaContable']!=null){ 
		 
		   ?>
           <option value="<?php echo $myrow2['ctaContable']; ?>"><?php echo $myrow2['ctaContable']; ?></option>
           <?php } ?>
		      <option value="">Escojer Cuenta Contable</option>
         <?php  	 		 
		    for ($i = 0; $i < $nrows1; $i++ ){
		    ?>
         <option value="<?php echo $results1['ID_CTAMAYOR'][$i]; ?>"><?php echo $results1['NOMBRE'][$i]." || ".$results1['ID_CTAMAYOR'][$i]; ?></option>
         <?php } 
		
		?>
         </select>
       </span></td>
     </tr>
     <tr>
       <th width="1" class="style12" scope="col">&nbsp;</th>
       <td class="style12"><div align="left"></div></td>
       <td class="style12"><input name="agregar" type="submit" class="style12" id="agregar" value="Nuevo" />
         <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Servicio" />
         <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Servicio" /></td>
     </tr>
   </table>
  <?php   
 $sSQL= "Select * From tipoMedico where entidad='".$entidad."' order by descripcionTipoMedico ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </form>
 <form id="form2" name="form2" method="post" action="">
   <table width="505" border="1" align="center">
     <tr>
       <th width="98" bgcolor="#660066" scope="col"><p class="style11">N. M&eacute;dico</p>       </th>
       <th width="97" bgcolor="#660066" scope="col"><span class="style11">Tipo de M&eacute;dico</span></th>
       <th width="236" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n del tipo de M&eacute;dico </span></th>
       <th width="46" bgcolor="#660066" scope="col"><span class="style11">Cuenta C </span></th>
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
$c=$myrow['auto'];
?>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
         <label>
         <input name="auto" type="submit" class="style12" id="codigoProcedimiento2" 
value="<?php echo $c?>" />
         </label>
       </span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['tipoMedicos'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcionTipoMedico'];?></span></td>
       <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php 
	   if($myrow['ctaContable']){
	   echo $myrow['ctaContable'];
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