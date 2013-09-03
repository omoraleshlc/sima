<?php require("/configuracion/seguridadsima/seguridadmenu.php"); 


if($_POST['actualizar']!=NULL AND $_POST['name']!=NULL and $_POST['keyc']!=NULL ){
$sSQL1= "Select * From secondarymodules WHERE entidad='".$entidad."' and keyc='".$_POST['keyc']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select * From primarymodules WHERE  keyc='".$_POST['keyc']."' ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);


if(!$myrow1['keyc']){


$agrega = "INSERT INTO secondarymodules (keyc,
name,entidad,mainmodule,mainmodulename
) values ('".$_POST['keyc']."','".$_POST['name']."','".$entidad."','si','".$myrow1a['menuname']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu agregado...';
} else {
$q = "UPDATE secondarymodules set 

name='".$_POST['name']."'

WHERE 
entidad='".$entidad."'
    and
keyc='".$_POST['keyc']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu modificado...';
}
}






if($_POST['borrar'] AND $_POST['keySM']){
$borrame = "DELETE FROM secondarymodules WHERE keySM ='".$_POST['keySM']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL SUBMODULO");
</script>'; 
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['keySM'] = "";
}


if($_GET['keySM']){
$sSQL2= "Select * From secondarymodules WHERE  keySM = '".$_GET['keySM']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=630,height=800,scrollbars=YES")
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
 <h1 align="center">Catalogo Modulos Primarios </h1>
 <br></br>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     
     
         <p>

    <span class="normalmid">
    <?php
    if(!$_POST['entidades']) {$_POST['entidades']=$_GET['entidades'];}
    require("/configuracion/componentes/comboEntidades.php");
	   $entidades=new despliegaEntidades();$entidades->listaEntidades($usuario,$basedatos);
	   ?>
  </span>
  </p>
     
   <p>
     <label></label>
   </p>
   <img src="/sima/imagenes/bordestablas/borde1.png" width="644" height="24" />
   <table width="644" border="0" align="center" cellpadding="4" cellspacing="0">

     <tr bgcolor="#CCCCCC">
       <th class="normal" scope="col">&nbsp;</th>
       <td class="normal">Modulo</td>
       <td class="normal"><label><strong>
         <?php	 	
if(!$_POST['keyc'])         {$_POST['keyc']=$_GET['keyc'];}
         
$sqlNombre11 = "SELECT * from primarymodules
where
entidad='".$_POST['entidades']."'
    and
    submenu='si'
ORDER BY menuname ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
         <select name="keyc" class="normal"  onchange="javascript:this.form.submit();"/>         
        
         
         <option value="">---</option>
         <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ $a+=1;
  echo mysql_error();?>
         <option 
		 <?php if($_POST['keyc']== $rNombre11["keyc"]){?>
		 selected="selected"
		  <?php } ?>
		  value="<?php echo $rNombre11["keyc"];?>"> <?php echo $rNombre11["menuname"];?></option>
         <?php } ?>
         </select>
       </strong></label>
         <label></label></td>
       
       
     </tr>
       
       
       
            <tr bgcolor="#CCCCCC">
       <th width="1" class="normal" scope="col">&nbsp;</th>
       <td class="normal"><strong>Nombre SubModulo</strong></td>
       <td class="normal"><span class="normal">
         <input name="name" type="text" class="normal" id="subModulo" value="<?php echo $myrow2['name'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       

       
       
       
       
     <tr bgcolor="#CCCCCC">
       <th width="1" class="normal" scope="col">&nbsp;</th>
       <td class="normal">&nbsp;</td>
       <td class="normal"><input name="nuevo" type="submit" class="normal" id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit" class="normal" id="borrar" value="Eliminar SubM&oacute;dulo" />
         <input name="actualizar" type="submit" class="normal" id="actualizar" value="Modificar/Grabar Sub M&oacute;dulo" />
         <span class="normal">
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" />
         </span></td>
     </tr>
   </table>
   <img src="/sima/imagenes/bordestablas/borde2.png" width="644" height="24" />
<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From secondarymodules 
 where
 entidad='".$entidad."'
     and
 keyc='".$_POST['keyc']."'
 order by name ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <img src="/sima/imagenes/bordestablas/borde1.png" width="519" height="24" />
   <table width="519" border="0" align="center" cellpadding="4" cellspacing="0">
      
      <tr bgcolor="#FFFF00">
          <td width="5" align="left" class="negromid">#</td>
      <td width="50" align="left" class="negromid">Descripcion</td>
      <td width="10" align="left" class="negromid">---</td>
      <td width="10" align="left" class="negromid">---</td>
    </tr>
     
       <?php	while($myrow = mysql_fetch_array($result)){$b+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['keySM'];
?>
       <tr>

             <td bgcolor="<?php echo $color;?>" class="normal"><span class="normal">
         <label>
       <?php echo $b;?>
         </label>
       </span></td>
           
           
   
       

       <td bgcolor="<?php echo $color;?>" class="normal">
           <span class="normal">
       <?php echo $myrow['name'];?>         
       </span>
       </td>
       
              <td bgcolor="<?php echo $color;?>" class="normal">
           <span class="normal">
                    <a href="catalogoSubModulos.php?entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $_POST['keyc']; ?>&amp;usuario=<?php echo $E; ?>" class="normal" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
              <td bgcolor="<?php echo $color;?>" class="normal">
           <span class="normal">
                    <a href="javascript:ventanaSecundaria('extensionmodules.php?entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Add
                    </a>
        
       </span>
       </td>           
           
        
     </tr>
     <?php }?>
   </table>
   
   
   
   
   
   <img src="/sima/imagenes/bordestablas/borde2.png" width="519" height="24" />
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
