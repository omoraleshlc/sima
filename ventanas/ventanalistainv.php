<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php

if($_POST['almacenDestino']!=NULL){
    $ALMACEN=$_POST['almacenDestino'];
}elseif($_GET['almacen']!=NULL){
    $ALMACEN=$_GET['almacen'];
}else{
    $_GET['almacen']=NULL;
    $_POST['almacenDestino']=NULL;
}



if($_POST['actualizar'] and $_POST['almacenDestino'] and $_POST['anaquel']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

if($_GET['keylistas']!=NULL){
$sSQL3= "Select * From listas WHERE keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);   
}else{
$sSQL3= "Select * From listas WHERE  entidad='".$entidad."' and almacen='".$_POST['almacenDestino']."' and anaquel='".$_POST['anaquel']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}


if(!$myrow3['keylistas'] ){

$agrega = "INSERT INTO listas (
almacen,anaquel,descripcion,usuario,fecha,entidad,status
) values (
'".$_POST['almacenDestino']."',
    '".$_POST['anaquel']."',
'".$_POST['descripcion']."',
'".$usuario."',
    '".$fecha1."',
'".$entidad."',
    'open'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
window.alert( "LISTA AGREGADA");
   window.opener.document.forms["form2"].submit();
    self.close();
</script>';

} else {



$q = "UPDATE listas set 
almacen='".$_POST['almacenDestino']."',
anaquel='".$_POST['anaquel']."',
descripcion='".$_POST['descripcion']."', 
usuario='".$usuario."'
WHERE 
keylistas='".$_GET['keylistas']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  window.alert( "ANAQUEL ACTUALIZADO!");
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}


}








//if($_POST['borrar'] AND $_POST['almacen']){
//
//
//
//
//$borrame = "DELETE FROM reportesAutomaticos WHERE keylista='".$_POST['keylista']."' ";
//mysql_db_query($basedatos,$borrame);
//echo mysql_error();
//
//
//echo '<script language="JavaScript" type="text/javascript">
//  <!--
//  window.alert( "REPORTE ACTUALIZADO ");
//   window.opener.document.forms["form2"].submit();
//    self.close();
//  // -->
//</script>';
//}



$sSQL3= "Select * From listas WHERE   keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form  name="form3" method="post"  >
   <p>
     <label></label></p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <div align="center">
     <p>Crear Lista Inventarios</p>
     <p>&nbsp;</p>
   </div>

   
   
   
   
   
   
   
   
   
   
   <div id="divContainer">
   <table width="442" border="1" align="center" class="formatHTML5">
       
       
 <tr >
      <td scope="col"><div align="right" >Almac&eacute;n</font></div></td>
      <td scope="col"> <div align="left">
      <?php     $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
	 if($_POST['almacenDestino'] ==$resCombo['almacen'] or $myrow3['almacen'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
      </div></td>
    </tr>
      
      
      
          
      
      
      
      
      
      
      
      
      
      
      
      		
      
            
      <tr >
      <td scope="col"><div align="right" >Anaquel</div></td>
      <td scope="col"> <div align="left">
<font size="1" >
          <?php 
     
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$ALMACEN."'  order  by anaquel ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel"   onChange="this.form.submit();"/>        
       <option value="" >---</option>
  <option value="*" <?php 
 if($_GET['anaquel']=='*' or $_POST['anaquel']=='*' or !$_POST['anaquel']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>>Todos</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        
       
       
       <option 
		<?php 
 if($_POST['anaquel']==$resCombo['anaquel'] or $myrow3['anaquel']==$resCombo['anaquel']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
       
        <?php } ?>
       
        </select>
</font>
      </div></td>
    </tr>       
       
       
       
       
       
       
       
       
       
       
       
     
  </table>
       
       
       
       
       
       
       
       
       
       
       
       
       
   <p>&nbsp;</p>
   <table width="320" align="center">
     <tr>
       <td width="156" align="center"><span class="style12"><span class="Estilo24">
         <input name="actualizar" type="submit" src="../../imagenes/btns/modialma.png"  id="actualizar" value="Crear/Actualizar Lista" />
       </span></span></td>

     </tr>
   </table>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>
</body>
</html>
