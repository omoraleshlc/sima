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
           
        if( vacio(F.codigoTT.value) == false ) {   
                alert("Por Favor, escoje el codigoTT/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este codigoTT!")   
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


if($_POST['actualizar'] and $_POST['codigoTT'] and $_POST['descripcion'] ){
 $sSQL1= "Select * From catTTCaja WHERE entidad='".$entidad."' and codigoTT = '".$_POST['codigoTT']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoTT']){


$agrega = "INSERT INTO catTTCaja (
codigoTT,descripcion,naturaleza,entidad
) values ('".$_POST['codigoTT']."','".$_POST['descripcion']."',
'".$_POST['naturaleza']."',
'".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Transacción agregada';
echo '<script >
window.alert( "ESTE TIPO DE TRANSACCION HA SIDO AGREGADO EXITOSAMENTE! ");
</script>';
} else {
$q = "UPDATE catTTCaja set 
descripcion='".$_POST['descripcion']."', 
naturaleza='".$_POST['naturaleza']."'
WHERE 
entidad='".$entidad."'
and
codigoTT='".$_POST['codigoTT']."' 
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Transacción modificada';
echo '<script>
window.alert("ESTE TIPO DE TRANSACCION HA SIDO MODIFICADO! ");
</script>';

}
}










if($_POST['borrar'] AND $_POST['codigoTT']){
$borrame = "DELETE FROM catTTCaja WHERE codigoTT ='".$_POST['codigoTT']."'";
//mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo 'La transacción deberá ser removida manualmente!';
echo '<script >
window.alert( "ESTE TIPO DE TRANSACCION HA SIDO ELIMINADO! ");
</script>';
}


if($_GET['keyCTR']){
$sSQL2= "Select * From catTTCaja WHERE keyCTR = '".$_GET['keyCTR']."' ";
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
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
 <h1 align="center" class="titulos">Cat&aacute;logo de Tipo de Transacciones </h1>
 <form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <img src="../../imagenes/bordestablas/borde1.png" width="575" height="24" />
   <table width="575" border="0" align="center" bgcolor="#CCCCCC">
     <tr bgcolor="#FFFFFF">
       <th width="1" bgcolor="#CCCCCC" class="style12" scope="col">&nbsp;</th>
       <th width="117" bgcolor="#CCCCCC" class="none" scope="col"><div align="left">C&oacute;digo </div>         
         <label></label></th>
       <th width="443" class="style12" scope="col">
         <div align="left">
           <input name="codigoTT" type="text" class="campos" id="codigoTT" value="<?php echo $myrow2['codigoTT']?>" 
size="10" <?php if($myrow2['codigoTT']){ echo 'readonly=""';}?> autocomplete="off"/>
         </div></th></tr>
     <tr>
       <th class="style12" scope="col">&nbsp;</th>
       <td class="negro">Descripci&oacute;n</td>
       <td class="style12"><input name="descripcion" type="text" class="campos" id="descripcion" 
	   value="<?php echo $myrow2['descripcion']?>" size="60"/></td>
     </tr>
     <tr>
       <th class="style12" scope="col">&nbsp;</th>
       <td class="negro">Naturaleza</td>
       <td class="style12"><label>
         <select name="naturaleza" id="naturaleza">
           <option
		   <?php if($myrow2['naturaleza']=='C'){ echo 'selected=""';}?>
		    value="C">C</option>
           <option
		   		   <?php if($myrow2['naturaleza']=='A'){ echo 'selected=""';}?>
		    value="A">A</option>
         </select>
       </label></td>
     </tr>
     
     
     
      <?php //if($_POST['tipoCliente']=='coaseguro'){ ?>
     <?php //} ?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="575" height="24" />
<p>&nbsp;</p>
   <table width="38%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr align="center" valign="middle">
       <td><div align="center"><span class="Estilo24">
         <input name="actualizar" type="image" class="botones" id="actualizar" value="Alta/Modificar" src="../../imagenes/btns/modifybutton.png" alt="Modificar el Registro" />
       </span></div></td>
       <td><div align="center"><span class="Estilo24">
         <input name="borrar" type="image" class="botones" id="borrar" value="Eliminar" src="../../imagenes/btns/deletebutton.png" alt="Eliminar el Registro"/>
       </span></div></td>
       <td><div align="center"><span class="Estilo24">
         <input name="nuevo" type="image" class="botones" id="nuevo" value="Nuevo" src="../../imagenes/btns/newbutton.png"/>
       </span></div></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From catTTCaja order by descripcion  ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="410" border="0" align="center" cellpadding="3" cellspacing="0">
     <tr>
       <th width="84" bgcolor="#FFFF00" scope="col"><div align="left" class="none"><span class="style11">C&oacute;digo </span></div></th>
       <th width="316" bgcolor="#FFFF00" scope="col"><div align="left" class="none"><span class="style11">Descripci&oacute;n </span></div></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
	   $a+=1;
	   
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['codigoTT'];
$ventana='catalogoTT.php';
?>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="normal"><span class="style7">
	 
<a href="catalogoTT.php?keyCTR=<?php echo $myrow['keyCTR'];?>" onClick="javascript:document.form2.submit();"/>
<img src="/sima/imagenes/expandir.gif" width="12" height="12" border="0">
<?php echo $A?>
 </a>


       <input name="keyTT[]" type="hidden" id="keyTT[]"  value="<?php echo $myrow['keyTT'];?>" />
       </span></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="normal"><?php echo $myrow['descripcion'];?></span></td>
     </tr>

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