<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php");  ?>

<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, Escoje el Almacen!.")   
                return false   
        } else if(vacio(F.anaquel.value) == false ) {   
                alert("Por Favor, Escoje un Anaquel!.")   
                return false   
                 }   
           
}   
</script>
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
if($_GET['edit']=='si' and $_GET['keyANA']!=NULL){
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
<h1 align="center" class="titulos">&nbsp;</h1>
<form id="form1" name="form1" method="post" >
  <img src="/sima/imagenes/bordestablas/borde1.png" width="647" height="24" />
  <table width="648" height="229" border="0" align="center" cellpadding="0" cellspacing="0" class="none">

    <tr>
      <td width="1" rowspan="5" bgcolor="#CCCCCC"><div align="left"></div>        
      <div align="left"></div>        <div align="left"></div></td>
        <td colspan="3" align="center" bgcolor="#FFFF00"><span class="none"><strong>Anaqueles</strong></span></td>
    </tr>
    <tr>
      <td width="121" height="42" bgcolor="#CCCCCC"><div align="left">Almacen</div></td>
      <td colspan="2" bgcolor="#CCCCCC"><div align="left">
          <label><span class="style7">
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

      <td height="36" bgcolor="#CCCCCC"><span class="none">Anaquel</span></td>
      <td colspan="2" bgcolor="#CCCCCC"><input name="anaquel" type="text" class="campos" id="anaquel" value="<?php 
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
      <td height="51" bgcolor="#CCCCCC"><div align="left" class="none">Tipo de Anaquel </div></td>
      <td width="393" bgcolor="#CCCCCC"><div align="left">

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
          <select name="tipoAnaquel" class="combos" id="tipoAnaquel" />          
       
			<option value="1">ESCOJE EL TIPO DE ANAQUEL</option>
           <?php while($resCombo3 = mysql_fetch_array($rCombo3)){ ?>
		    <option
			<?php 
                        
                        if($myrow12['codigoAnaquel']==$resCombo3['codigoAnaquel']) { ?>
			selected="selected"
			<?php } ?>
			 value="<?php echo $resCombo3['codigoAnaquel']; ?>">
	<?php echo $resCombo3['tipoAnaquel']." || ".$resCombo3['codigoAnaquel']; ?></option>
          <?php } ?>
          </select>
	  
	  </div></td>
      <td width="133" bgcolor="#CCCCCC"><a href="tipoAnaquel.php">Editar Anaquel </a></td>
    </tr>
    <tr>
      <td height="14" colspan="3" bgcolor="#CCCCCC"><div align="left">
        <p>&nbsp;          </p>
          <p align="center">
            <input name="actualizar" type="submit" class="none" id="actualizar" value="Grabar/Actualizar" />
            <input name="buscar" type="submit" class="none" id="buscar" value="Buscar" />
            <input name="nuevo" type="submit" class="none" id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit" class="none" id="borrar" value="Borrar" />
            </p>
      </div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td height="14" colspan="4">&nbsp;</td>
    </tr>
  </table>
<img src="/sima/imagenes/bordestablas/borde2.png" width="647" height="24" />
<p>&nbsp;</p>
</form>








<form id="form2" name="form2" method="post" >
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  <img src="/sima/imagenes/bordestablas/borde1.png" width="360" height="24" />
  <table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="99" height="23" bgcolor="#FFFF00" scope="col"><span class="normal"># Anaquel </span></th>
      <th width="188" bgcolor="#FFFF00" scope="col"><span class="normal">Tipo de Anaquel </span></th>
      <th width="42" bgcolor="#FFFF00" scope="col"><span class="normal">Activo</span></th>
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
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="normal">
        <label>
        <?php 
	  
	  echo $myrow1['anaquel'];
	  
	  ?>
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="normal">
      
      <a href="anaquel.php?keyANA=<?php echo $myrow1['keyANA'];?>&edit=si&almacen=<?php echo $_POST['almacenDestino'];?>">
      <?php 
	  if($myrow12['tipoAnaquel']){
	  echo $myrow12['tipoAnaquel'];
	  } else {
	  echo "---";
	  }
	  ?>
      </a>
          </span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="normal">
        <label></label>
        <?php echo $myrow1['activo'];?></span></td>
    </tr>
    <?php }?>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="360" height="24" />
</form>
<p align="center">&nbsp;</p>
</body>
</html>