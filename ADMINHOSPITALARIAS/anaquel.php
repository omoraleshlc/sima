<?PHP require("menuOperaciones.php");  ?>

<?php

if($_POST['borrar'] AND $_POST['anaquel']){
$borrame = "DELETE FROM anaqueles WHERE keyANA='".$_GET['keyANA']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL ANAQUEL..");
</script>';
}
if($_POST['nuevo']){
$_POST['anaquel'] = "";
$_POST['codigoRazon'] ="";
}





if($_POST['actualizar'] AND $_POST['almacenDestino'] and $_POST['tipoAnaquel']){
 $sSQL1= "Select * From anaqueles WHERE entidad='".$entidad."' and almacen='".$_POST['almacenDestino']."' AND anaquel = '".$_POST['anaquel']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);





if(!$myrow1['anaquel']){

$agrega = "INSERT INTO anaqueles (
almacen,anaquel,tipoAnaquel,activo,entidad
) values ('".$_POST['almacenDestino']."','".$_POST['anaquel']."','".$_POST['tipoAnaquel']."',
'A','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script >
window.alert( "SE AGREGO EL ANAQUEL..");
</script>';


} else {
 $q = "UPDATE anaqueles set 
almacen= '".$_POST['almacenDestino']."', 
anaquel='".$_POST['anaquel']."', 
tipoAnaquel='".$_POST['tipoAnaquel']."'

WHERE entidad='".$entidad."'  AND
anaquel='".$_POST['anaquel']."' AND almacen= '".$_POST['almacenDestino']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script >
window.alert( "SE ACTUALIZO EL ANAQUEL..");
</script>';
}
}
?>






<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>



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
	
	<?php 
if(!$_POST['nuevo'] and $_GET['edit']=='si' and $_GET['keyANA']!=NULL){
	$sSQL= "SELECT 
*
FROM
  `anaqueles`
  
 WHERE keyANA='".$_GET['keyANA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$_GET['edit']=NULL;
}
	
	

	?>
<h1 align="center" >&nbsp;</h1>
<form id="form1" name="form1" method="post" >

  <table width="648"  class="table-forma">

               <tr>
        <th align="center" ><p align="center">Anaqueles</strong></p></th>
    </tr>
    <tr>
      <td width="121"  ><div align="left">Almacen</div></td>
      <td colspan="2" ><div align="left">
          <label><span >
          <?php $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
                if($myrow['almacen']==$resCombo['almacen']){echo 'selected=""';
                }elseif($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
          </span></label>
      </div></td>
    </tr>
    <tr>

      <td height="36" ><span >Anaquel</span></td>
      <td colspan="2" ><input name="anaquel" type="text"  id="anaquel" value="<?php 
	  if(!$_POST['borrar']){
	  if($myrow['anaquel']){
	  echo $myrow['anaquel']; 
	  } else {
	  echo $_POST['anaquel'];
	  }}else{
	  echo "";
	  }
	  ?>" />        <a href="tipoAnaquel.php"></a></td>
    </tr>
    <tr>
      <td height="51" ><div align="left" >Tipo de Anaquel </div></td>
      <td width="393" ><div align="left">

	  <?php
$aCombo3= "Select * From tipoAnaqueles where entidad='".$entidad."' ORDER BY tipoAnaquel ASC ";
$rCombo3=mysql_db_query($basedatos,$aCombo3); 
$anaquel=$myrow['anaquel'];
$sSQL11= "SELECT 
 *
FROM
  anaqueles
  WHERE 
  entidad='".$entidad."' 
  AND
  anaquel='".$anaquel."'
  ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$tipoAnaquel=$myrow11['tipoAnaquel'];
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


?>
          <select name="tipoAnaquel"  id="tipoAnaquel" />          
       
			<option value="1">ESCOJE EL TIPO DE ANAQUEL</option>
           <?php while($resCombo3 = mysql_fetch_array($rCombo3)){ ?>
		    <option
			<?php 
                        
                        if($myrow12['codigoAnaquel']==$resCombo3['codigoAnaquel']) { ?>
			selected="selected"
			<?php } ?>
			 value="<?php echo $resCombo3['codigoAnaquel']; ?>">
	<?php echo $resCombo3['tipoAnaquel']; ?></option>
          <?php } ?>
          </select>
	  
	  </div></td>
      <td width="133" ><a href="tipoAnaquel.php?&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">Editar Anaquel </a></td>
    </tr>
    <tr>
      <td height="14" colspan="3" ><div align="left">
        <p>&nbsp;          </p>
          <p align="center">
            <input name="actualizar" type="submit"  id="actualizar" value="Grabar/Actualizar" />
            <input name="buscar" type="submit"  id="buscar" value="Buscar" />
            <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit"  id="borrar" value="Eliminar" />
            </p>
      </div></td>
    </tr>
    <tr >
      <td height="14" colspan="4">&nbsp;</td>
    </tr>
  </table>

<p>&nbsp;</p>
</form>








<form id="form2" name="form2" method="post" >
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />

  <table width="360" class="table table-striped">
    <tr>
      <th width="4" ><span >#</span></th>
      <th width="188" ><span >Tipo de Anaquel </span></th>
      <th width="42" ><span >Activo</span></th>
    </tr>
    <tr>
      <?php	
if(!$_POST['almacenDestino']){
    $_POST['almacenDestino']=$_GET['almacen'];
}	  


$sSQL1= "Select * From anaqueles WHERE entidad='".$entidad."' and almacen = '".$_POST['almacenDestino']."' order by almacen ASC";
$result1=mysql_db_query($basedatos,$sSQL1); 
echo mysql_error();
 

while($myrow1 = mysql_fetch_array($result1)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow1['anaquel'];
$tipoAnaquel=$myrow1['tipoAnaquel'];
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  entidad='".$entidad."'
      and
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>
      <td bgcolor="<?php echo $color?>" ><span >
        <label>
        <?php 
	  
	  echo $myrow1['anaquel'];
	  
	  ?>
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" ><span >
      
      <a href="anaquel.php?keyANA=<?php echo $myrow1['keyANA'];?>&edit=si&almacen=<?php echo $_POST['almacenDestino'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
      <?php 
	  if($myrow12['tipoAnaquel']){
	  echo $myrow12['tipoAnaquel'];
	  } else {
	  echo "---";
	  }
	  ?>
      </a>
          </span></td>
      <td bgcolor="<?php echo $color?>" ><span >
        <label></label>
        <?php echo $myrow1['activo'];?></span></td>
    </tr>
    <?php }?>
  </table>

</form>
<p align="center">&nbsp;</p>
</body>
</html>