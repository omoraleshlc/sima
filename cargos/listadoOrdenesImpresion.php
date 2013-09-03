<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=730,height=500,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<h1 align="center">Requisición: #<?php echo $_GET['id_requisicion'];?> </h1>

<?php 
$sSQL8= "Select * From OC WHERE keyR='".$_GET['keyR']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$sSQL8a= "Select * From proveedores WHERE id_proveedor='".$myrow8['id_proveedor']."'";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);
?>
<table width="580" border="0" align="center" class="style7">
  <tr>
    <th width="199" bgcolor="#CCCCCC" scope="col"><div align="left">Proveedor</div></th>
    <th width="365" bgcolor="#CCCCCC" scope="col"><div align="left"><?php 
	if($myrow8['proveedor1']){
	echo $mywo8['proveedor1'];
	} else {
	echo $myrow8a['razonSocial'];}?></div></th>
  </tr>
  <tr>
    <td><div align="left">Persona que solicita</div></td>
    <td><div align="left"><?php echo $myrow8['usuario']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Departamento</td>
    <td bgcolor="#CCCCCC"><?php echo $myrow8['id_almacen']; ?></td>
  </tr>
  <tr>
    <td><div align="left">Fecha:</div></td>
    <td><div align="left"><?php echo $fecha1;?></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="left">Hora:</div></td>
    <td bgcolor="#CCCCCC"><div align="left"><?php echo $hora1;?></div></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="578" border="0" align="center">
    <tr>
      <th width="59" bgcolor="#CCCCCC" scope="col"><div align="left" class="negro">Cantidad</span></div></th>
      <th width="359" bgcolor="#CCCCCC" scope="col"><div align="left"class="negro">Descripci&oacute;n</span></div></th>
      <th width="72" bgcolor="#CCCCCC" scope="col"><div align="left" class="negro">PrecioUnitario</span></div></th>
      <th width="70" bgcolor="#CCCCCC" scope="col"><div align="left" class="negro">Importe</span></div></th>
    </tr>
    <tr>
<?php	


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
keyR='".$_GET['keyR']."'
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$b+='1';
$a+='1';
if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];

$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$sSQL8= "Select * From precioArticulos WHERE codigo= '".$code1."' ";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $myrow18['cantidad']?></label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7"><?php echo '$'.number_format($myrow18['precioUnitario'],2); ?></span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	  $total=$myrow18['precioUnitario']*$myrow18['cantidad'];
	  echo '$'.number_format($total,2);
	$subTotal[0]+=$total;
			

	  
	  
	  ?></span></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <p align="center" class="style7">&nbsp;</p>
  <table width="200" border="0" align="center">
    <tr>
      <td width="88" bgcolor="#CCCCCC" class="style7"><div align="left"><strong>Total</strong></div></td>
      <td width="96" bgcolor="#CCCCCC" class="style7"><div align="left"><strong>
        <?php 
$Total=$subTotal[0]+$iva;
			echo "$".number_format($Total,2);

	  
	  
	  ?>
      </strong></div></td>
    </tr>
  </table>
  <p align="center">&nbsp; </p>
  <div align="center"></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="id_almacen" type="hidden" id="id_almacen" value="<?php echo $_POST['id_almacen']; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <p align="center">&nbsp;</p>
</form>
</body>
</html>