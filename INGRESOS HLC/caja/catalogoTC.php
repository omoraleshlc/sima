<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); 
include("/configuracion/funciones.php");
//valida('CAJA','CatTCCaja',$usuario,$basedatos); ?>

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
           
        if( vacio(F.codigo.value) == false ) {   
                alert("Por Favor, escoje el codigo/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este codigo!")   
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

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=500,scrollbars=YES") 
} 
</script> 


<?php

if(!$_POST['variable']){
$_POST['variable']='no';
}

if($_POST['defaultExternos']){
$defaultE='si';
} else {
$defaultE='no';
}


if($_POST['actualizar'] AND $_POST['codigo'] ){
if(!$_POST['permisoEspecial']){
$_POST['permisoEspecial']='no';
}

$sSQL1= "Select * From tarjetasCredito WHERE codigo = '".$_POST['codigo']."' or codigo='".$_GET['codigo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigo']){
if($_POST['codigo']!=$myrow1['codigo']){

$agrega = "INSERT INTO tarjetasCredito (
codigo,descripcion,status,entidad,porcentajeComisino
) values ('".$_POST['codigo']."','".$_POST['descripcion']."','A','".$entidad."','".$_POST['porcentajeComision']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Transacción agregada';
echo '<script type="text/vbscript">
msgbox "ESTE TIPO DE TRANSACCION HA SIDO AGREGADO EXITOSAMENTE! "
</script>';
}} else {
$q = "UPDATE tarjetasCredito set 
descripcion='".$_POST['descripcion']."', 
porcentajeComision='".$_POST['porcentajeComision']."',
status='".$_POST['status']."'
WHERE 
codigo='".$_POST['codigo']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Transacción modificada';
echo '<script type="text/vbscript">
msgbox "ESTA CAJA HA SIDO MODIFICADA! "
</script>';

}
}

if($_POST['borrar'] AND $_POST['codigo']){
$borrame = "DELETE FROM tarjetasCredito WHERE codigo ='".$_POST['codigo']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo 'La transacción deberá ser removida manualmente!';
echo '<script type="text/vbscript">
msgbox "ESTE CAJA HA SIDO ELIMINADA! "
</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigo'] = "";
}


if(!$_POST['codigo2']){
$_POST['codigo2']=$_GET['codigo2'];
}


$sSQL2= "Select * From tarjetasCredito WHERE codigo = '".$_GET['codigo']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo24 {font-size: 10px}
.style16 {
	font-size: 16px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000066;
}
.style17 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style18 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>
 <h1 align="center" class="style16">Cat&aacute;logo de Cajas </h1>
 <form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <table width="616" border="0" align="center">
     <tr>
       <th colspan="3" bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
     </tr>
     <tr>
       <th width="9" bgcolor="#FFCCFF" class="style17" scope="col">&nbsp;</th>
       <th width="191" bgcolor="#FFCCFF" class="style17" scope="col"><div align="left">C&oacute;digo Tarjeta </div>         
       <label></label></th>
       <th width="402" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left" class="style18">
           <input name="codigo" type="text" class="style17" id="codigo" value="<?php echo $myrow2['codigo'];?>" 
size="10" <?php if($myrow2['codigo']){ echo 'readonly=""';}?> autocomplete="off"/>
       </div></th>
     </tr>
     <tr>
       <th width="9" class="style17" scope="col">&nbsp;</th>
       <td class="style17">Descripci&oacute;n</td>
       <td class="style12"><input name="descripcion" type="text" class="style17" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="60"/></td>
     </tr>
     <tr>
       <th bgcolor="#FFCCFF" class="style17" scope="col">&nbsp;</th>
       <td bgcolor="#FFCCFF" class="style17"><p>Porcentaje, Comisi&oacute;n </p>
       </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="style18">
         <label></label>
         <input name="porcentajeComision" type="text" class="style17" id="porcentajeComision" value="<?php echo $myrow2['porcentajeComision']?>" 
size="10" autocomplete="off"/>
       </span></td>
     </tr>
     <tr>
       <th width="9" class="style12" scope="col">&nbsp;</th>
       <td class="style12">&nbsp;</td>
       <td class="style12"><span class="Estilo24">
       <input name="actualizar" type="submit" class="style18" id="actualizar" value="Alta/Modificar" />
         <input name="borrar" type="submit" class="style18" id="borrar" value="Eliminar" />
         <input name="nuevo" type="submit" class="style18" id="nuevo" value="Nuevo" />
       </span></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From tarjetasCredito order by codigo ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="307" border="0" align="center">
     <tr>
       <th width="77" bgcolor="#660066" scope="col"><div align="left" class="style18"><span class="style11">C&oacute;digo </span></div></th>
       <th width="171" bgcolor="#660066" scope="col"><div align="left" class="style18"><span class="style11">Descripci&oacute;n </span></div></th>
       <th width="45" bgcolor="#660066" scope="col"><div align="left" class="style18"><span class="style11">Status</span></div></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
	   $a+=1;
	   
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['codigo'];
$ventana='catalogoTT.php';
?>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style18">
	 
  <a href="catalogoTC.php?codigo=<?php echo $A; ?>&descripcion=<?php echo "descripcion"; ?>&forma=<?php echo "form1"; ?>&comision=<?php echo "comision"; ?>&tipoPago=<?php echo $_GET['tipoPago'];?>">
<img src="/sima/imagenes/expandir.gif" width="12" height="12" border="0">
<?php echo $A?>
 </a>


       <input name="keyTT[]" type="hidden" id="keyTT[]"  value="<?php echo $myrow['keyTT'];?>" />
       </span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style17"><?php echo $myrow['descripcion'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style17">
         <label>
         <?php if($myrow['status']){
echo $myrow['status'];
} else {
echo "I";
}?>
         </label>
       </span></td>
     </tr>
	 <?php if($myrow['defaultExternos']=='si'){
echo 'checked'.$myrow['keyTT'];
} ?>
	 
     <?php }?>
   </table>
   <p align="center">
     <label>
     <input name="bandera" type="hidden"  value="<?php echo $a;?>" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>