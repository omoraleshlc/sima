<?php require('/configuracion/ventanasEmergentes.php');?>

<?php

if($_POST['borrar'] AND $_POST['anaquel']){
$borrame = "DELETE FROM anaqueles WHERE
entidad='".$entidad."' AND
anaquel ='".$_POST['anaquel']."' AND almacen = '".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE Elimino EL ANAQUEL..");
</script>';
}




if($_POST['nuevo']){
$_POST['anaquel'] = "";
$_POST['codigoRazon'] ="";
}





if($_POST['actualizar'] AND $_POST['almacen']){
$sSQL1= "Select * From anaqueles WHERE entidad='".$entidad."' AND anaquel = '".$_POST['anaquel']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['anaquel']){
if($_POST['anaquel']!=$myrow1['anaquel']){
$agrega = "INSERT INTO anaqueles (
almacen,anaquel,tipoAnaquel,activo,entidad
) values ('".$_POST['almacen']."','".$_POST['anaquel']."','".$_POST['tipoAnaquel']."',
'".$_POST['activo']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script >
window.alert( "SE AGREGO EL ANAQUEL..");
</script>';
}} else {
 $q = "UPDATE anaqueles set
almacen= '".$_POST['almacen']."',
anaquel='".$_POST['anaquel']."',
tipoAnaquel='".$_POST['tipoAnaquel']."'

WHERE entidad='".$entidad."'  AND
anaquel='".$_POST['anaquel']."' AND almacen= '".$_POST['almacen']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script >
window.alert( "SE Actualizo EL ANAQUEL..");
</script>';
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos"><br />
Ajuste a existencias <br />

	<?php

	$sSQL= "SELECT
*
FROM
  `anaqueles`

 WHERE keyANA='".$_GET['keyANA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);




	?>
<form id="form1" name="form1" method="post" >
<table width="647" height="104" border="0" align="center" class="normal">

    <tr>
      <td width="1" rowspan="4" ><div align="left"></div>        
      <div align="left"></div>        <div align="left"></div></td>
      <td width="102" ><div align="left" class="normal">Almacen</div></td>
      <td colspan="2" ><div align="left">
          <label>
              
              
              <span class="normal">
                  <?php
          $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and
stock='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select class="normal" name="almacen"  id="almacen" onChange="javascript:this.form.submit();"/>
     <option value="">---</option>

        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($myrow['almacen']==$resCombo['almacen'] ){

		echo 'selected="selected"';
		} else if($_POST['almacen'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
          </span>
          </label>

      </div></td>

    </tr>







    
    <tr>
	

      <td ><span class="normal">Anaquel</span></td>
      <td colspan="2"><input name="anaquel" type="text" class="campos" id="anaquel" value="<?php 
	
	  
	  echo $myrow['anaquel']; 
	  
	  ?>" />        <a href="tipoAnaquel.php"></a></td>
    </tr>
    <tr>
      <td ><div align="left" class="normal">Tipo de Anaquel </div></td>
      <td width="431"><div align="left">

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
			<?php if($myrow['tipoAnaquel']==$resCombo3['codigoAnaquel']) { ?>
			selected="selected"
			<?php } ?>
			 value="<?php echo $resCombo3['codigoAnaquel']; ?>">
	<?php echo $resCombo3['tipoAnaquel']." || ".$resCombo3['codigoAnaquel']; ?></option>
          <?php } ?>
          </select>
	  
	  </div></td>
      <td width="85" class="normal" >
          <a href="javascript:ventanaSecundaria2('tipoAnaquel.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>&folioVenta=<?php echo $FV;?>&nT=<?php echo $_GET['keyClientesInternos'];?>');" >
          Nuevo Anaquel
          </a>

      </td>
    </tr>
    <tr>
      <td height="14" colspan="3"><div align="left">
        <p>&nbsp;          </p>
          <p align="center">
            <input name="actualizar" type="submit" class="botones" id="actualizar" value="Grabar/Actualizar" />
            <input name="buscar" type="submit" class="botones" id="buscar" value="Buscar" />
            <input name="nuevo" type="submit" class="botones" id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit" class="botones" id="borrar" value="Borrar" />
            </p>
      </div></td>
    </tr>
    <tr>
      <td height="14" colspan="4" >&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>