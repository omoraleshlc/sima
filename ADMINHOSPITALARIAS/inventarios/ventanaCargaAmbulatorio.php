<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">Servicios que ofrece el <?php echo $dr; ?></p>
<table width="668" border="1" align="center">
  <tr>
    <th width="76" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo Art&iacute;culo </span></div></th>
    <th width="359" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
    <th width="81" bgcolor="#660066" scope="col"><span class="style11">Cuenta Mayor. </span></th>
    <th width="76" bgcolor="#660066" scope="col"><span class="style11">
      <?php 
	  
	echo "Precio";
	  ?>
    </span></th>
    <th width="42" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
  </tr>
  <tr>
    <?php 
$bandera=0;
while($myrow11 = mysql_fetch_array($result11)){ 
$code= $myrow11['codProcedimiento'];
$gpoPro=$myrow11['gpoProducto'];
$bandera+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$cProced=$myrow11['codigo'];
$sSQL8= "
SELECT *
FROM
articulos
WHERE
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
echo mysql_error();


$sSQL15= "
SELECT *
FROM
conveniosGenerales,clientes
WHERE
conveniosGenerales.codigooGP='".$code."' and
conveniosGenerales.numCliente='".$_POST['seguro']."' and
conveniosGenerales.numCliente=clientes.numCliente
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15);

if($myrow15['codigooGP']){
//echo "trae seguro";

if($myrow15['cantidadoPorcentaje']=="yes"){

//es cantidad

$precioLevel=$myrow15['niveloCantidad'];
} else {
//es porcentaje
echo "es porcentaje";
$porcentaje=$myrow15['cantidadoPorcentaje'];
$sacoPor=($porcentaje/100)*$precio;
}
$tipoPrecio="Convenio";
	} else {
//echo "no es convenio seguro";

	$sSQL13= "
SELECT *
FROM
articulosPrecioNivel
WHERE
codigo='".$code."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
echo mysql_error();
if($_POST['seguro']){
	$precioLevel=$myrow13['nivel1'];
	$tipoPrecio="Particular";
	} else {
	$tipoPrecio="Aseguradora";
	$precioLevel=$myrow13['nivel3'];
	}
	}


?>
    <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
      <label></label>
      <?php echo $code; ?>
      <input name="codigoAlpha" type="hidden" id="codigoAlpha" value="<?php echo $code;?>" />
      <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php echo $code;?>" />
    </span></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow8['descripcion']; ?>
          <input name="descripcionProcedimientos[]" type="hidden" id="descripcionProcedimientos[]" 
	value="<?php echo $myrow11['descripcion']; ?>" />
    </span></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
      <?php 
	  if($myrow8['ctaContable']){
	  echo $myrow8['ctaContable']; 
	  } else {
	  echo "Asignar Cuenta";
	  }
	  ?>
      <input name="ctaContable[]" type="hidden" id="ctaContable[]" value="<?php echo $myrow8['ctaContable']; ?>" />
      <input name="ccosto[]" type="hidden" id="ccosto[]" value="<?php echo $centroCosto; ?>" />
    </span></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><label><span class="style7"> </span>
          <?php 
	  if($precioLevel){ ?>
          <?php  if($precioLevel==1){  ?>
          <input name="priceLevel[]" type="text" class="style12" id="priceLevel[]" size="8" maxlength="8" 
		  value="<?php 
		echo $precioLevel; 
		?>">
          <?php } else {?>
          <input name="priceLevel[]" type="text" class="style12" id="priceLevel[]" size="8" maxlength="8" 
		  value="<?php 
		echo $precioLevel; 
		?>"  readonly=""/>
          <?php } ?>
          <?php } else {
		echo $noPrice="Sin Precio";
		} ?>
          <span class="style7"> </span></label></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php if($myrow8['ctaContable'] AND $precioLevel){ ?>
        <input name="agregarP[]" type="checkbox" id="agregarP[]" value="<?php echo $code; ?>" />
        <?php } else { ?>
        <input name="agregarP[]" type="checkbox" id="agregarP[]" value="<?php echo $code; ?>"  disabled="disabled"/>
        <?php }
?></td>
  </tr>
  <?php }?>
</table>
<input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>" />
<input name="flag" type="hidden" id="flag" value="<?php echo $bandera; ?>" />
<?php } //cierro medico 
 
 
 
 }
 ?>
<p></p>
</body>
</html>
