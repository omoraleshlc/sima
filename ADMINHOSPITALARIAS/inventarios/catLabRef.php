<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.id_LF.value) == false ) {   
                alert("Por Favor, escoje el id_LF/departamento!")   
                return false   
        } else if( vacio(F.descripcionLF.value) == false ) {   
                alert("Por Favor, escribe la descripción de este id_LF!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 

<?php
if($_POST['actualizar'] AND $_POST['id_LF'] ){
$sSQL1= "Select * From catLabRef WHERE id_LF = '".$_POST['id_LF']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['id_LF']){
if($_POST['id_LF']!=$myrow1['id_LF']){

$agrega = "INSERT INTO catLabRef (
id_LF,descripcionLF,usuario,fecha,activo,observaciones,entidad
) values ('".$_POST['id_LF']."','".$_POST['descripcionLF']."',
'".$usuario."','".$fecha1."','".$_POST['activo']."','".$_POST['observaciones']."','".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO AGREGADO EXITOSAMENTE! "
</script>';
}} else {
$q = "UPDATE catLabRef set 
descripcionLF='".$_POST['descripcionLF']."', 

usuario='".$usuario."',
fecha='".$fecha1."',
activo='".$_POST['activo']."', 
observaciones='".$_POST['observaciones']."'
WHERE 
id_LF='".$_POST['id_LF']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO MODIFICADO! "
</script>';

}
}

if($_POST['borrar'] AND $_POST['id_LF']){
$borrame = "DELETE FROM catLabRef WHERE id_LF ='".$_POST['id_LF']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO ELIMINADO! "
</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['id_LF'] = "";
}


if($_POST['id_LF2']){
$sSQL2= "Select * From catLabRef WHERE id_LF = '".$_POST['id_LF2']."' ";
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
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de Laboratorio Referido </h1>
 <form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <table width="616" border="0" align="center">
     <tr>
       <th colspan="3" bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <th width="8" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <th width="119" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">C&oacute;digo </div>         
         <label></label></th>
       <th width="419" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left">
           <input name="id_LF" type="text" class="style12" id="id_LF" value="<?php echo $myrow2['id_LF']?>" 
size="10" <?php if($myrow2['id_LF']){ echo 'readonly=""';}?> autocomplete="off"/>
         </div></th></tr>
     <tr>
       <th width="8" class="style12" scope="col">&nbsp;</th>
       <td class="style12">Descripci&oacute;n</td>
       <td class="style12"><input name="descripcionLF" type="text" class="style12" id="descripcionLF" 
	   value ="<?php echo $myrow2['descripcionLF']?>" size="60"/></td>
     </tr>
     <tr>
       <th bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style12">Activo</td>
       <td bgcolor="#FFCCFF" class="style12"><label>
         <input name="activo" type="checkbox" id="activo" value="activo" 
 <?php 
 if($myrow2['activo']){
 echo 'checked=""';
 }
 ?>
		 />
       </label></td>
     </tr>
     <tr>
       <th class="style12" scope="col">&nbsp;</th>
       <td class="style12">Observaciones</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="observaciones" cols="80" rows="4" class="Estilo24" id="observaciones"><?php echo $myrow2['observaciones']?></textarea>
       </span></td>
     </tr>
     <tr>
       <th width="8" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
       <input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Alta/Modificar Laboratorio" />
         <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Eliminar Laboratorio" />
         <input name="nuevo" type="submit" class="Estilo24" id="nuevo" value="Nuevo" />
       </span></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From catLabRef where entidad='".$entidad."' order by id_LF ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="368" border="0" align="center">
     <tr>
       <th width="99" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo Lab. </span></th>
       <th width="211" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n del Laboratorio </span></th>
       <th width="44" bgcolor="#660066" scope="col"><span class="style11">&iquest;Activo?</span></th>
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
$A=$myrow['id_LF'];
?>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
         <input name="id_LF2" type="submit" class="Estilo24" id="id_LF2" value="<?php echo $A?>" />
       </span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcionLF'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <?php if($myrow['activo']){
echo $myrow['activo'];
} else {
echo "N/A";
}?>
       </span></td>
     </tr>
     <?php }?>
   </table>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>