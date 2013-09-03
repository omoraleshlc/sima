<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php');?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style13 {color: #FFFFFF}
.style17 {font-size: 9px; color: #FFFFFF; }

-->
</style>
</head>

<body>

<h3 align="center">Status Servicios</h3>
<?php 
$sSQL= "SELECT 
 paciente
FROM
clientesInternos

 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'
 ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
<h1 align="center"><strong>PACIENTE:  <?php echo $myrow['paciente'];?></strong></h1>
<form id="form" name="form" method="post" action="" >
  <table width="769" border="0" align="center">
      <tr>
        <th width="69" height="14" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">C&oacute;digo</span></div></th>
        <th width="340" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n </span></div></th>
        <th width="60" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Cantidad</span></div></th>
        <th width="60" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Pendiente</span></div></th>
        <th width="70" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Precio </span></div></th>
        <th width="70" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">IVA </span></div></th>
        <th width="70" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Status  </span></div></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
 *
FROM
 articulosPaquetesPacientes

 WHERE 
 keyClientesInternos='".$_GET['keyClientesInternos']."'
 
 AND codigoPaquete = '".$_GET['codigoPaquete']."'
 

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;


if($myrow['status']=='cargado'){
$color='#009900';
$col='';
} else {
if($col){
$color = '#FFCCFF';
$col = "";

} else{
$color = '#FFFFFF';
$col = 1;
}
}

$sSQL31= "Select existencias.almacen,articulos.descripcion,articulos.codigo as code From articulos,existencias 
WHERE 
articulos.entidad='".$entidad."'
and
articulos.codigo='".$myrow['codigo']."'
and
articulos.codigo=existencias.codigo

";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL313= "Select descripcion from almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow31['almacen']."'
";
$result313=mysql_db_query($basedatos,$sSQL313);
$myrow313 = mysql_fetch_array($result313);

$sSQL3134= "Select precioPaquete1,ivaPrecioPaquete1,cantidad from articulosPaquetes
WHERE 
entidad='".$entidad."'
and
codigoPaquete='".$myrow['codigoPaquete']."'
and
codigo='".$myrow['codigo']."'
";
$result3134=mysql_db_query($basedatos,$sSQL3134);
$myrow3134 = mysql_fetch_array($result3134);


$totalPrecio[0]+=($myrow3134['precioPaquete1']*$myrow3134['cantidad']);
$ivas[0]+=($myrow3134['ivaPrecioPaquete1']*$myrow3134['cantidad']);
  
?>
        <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php 
echo $myrow['codigo'];
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
echo $myrow31['descripcion'];
if($myrow['tipoArticulo']){
echo '<span class="style15">'.'  ['.$myrow['tipoArticulo'].']'.'<span>';
}
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><?php echo $myrow3134['cantidad'];?></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><?php echo $myrow3134['cantidad'];?></td>
		
		<?php //print $myrow['cantidad'].' '.$myrow['codigo'].' '.$myrow3134['precioPaquete1'].'</br>';?>
		
        <td bgcolor="<?php echo $color?>" class="Estilo24"><?php echo "$".number_format($myrow3134['precioPaquete1'],2);?></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><?php 

if($myrow3134['ivaPrecioPaquete1']){
echo "$".number_format($myrow3134['ivaPrecioPaquete1'],2); 
} else {
echo '$0.00';
}
?></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><?php 
echo $myrow['status'];
?>&nbsp;</td>
      </tr>
      <?php  
	  $bandera+=1;
	  } } //cierra while?>
  </table>

  <table width="774" border="0" align="center">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td bgcolor="#993333" class="style7">&nbsp;</td>
      <td bgcolor="#993333" class="style7">&nbsp;</td>
      <td width="66" bgcolor="#993333" class="style17"><?php echo "$".number_format($totalPrecio[0],2);?></td>
      <td width="70" bgcolor="#993333" class="style17">&nbsp;</td>
      <td width="68" bgcolor="#993333" class="style17"><?php echo "$".number_format($ivas[0],2);?></td>
    </tr>
    <tr>
      <td width="155"><span class="style13"></span></td>
      <td width="255"><span class="style13"></span></td>
      <td width="65" bgcolor="#993333" class="style7">&nbsp;</td>
      <td width="65" bgcolor="#993333" class="style7"><div align="right" class="style13">Total</div></td>
      <td colspan="3" bgcolor="#993333" class="style17">
	  <?php echo "$".number_format($totalPrecio[0]+$ivas[0],2);?>
	  &nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center">
    <label>
    <input name="flag" type="hidden" class="style7" id="update" value="<?php echo $bandera;?>" />
	<input name="numeroE" type="hidden" class="style7" id="numeroE" value="<?php echo $_GET['numeroE'];?>" />
	<input name="nCuenta" type="hidden" class="style7" id="nCuenta" value="<?php echo $_GET['nCuenta'];?>" />
    </label>
    <input name="codigoPaquete" type="hidden" id="codigoPaquete" value="<?php echo $_GET['codigoPaquete'];?>" />
  </p>
</form>
  <p></p>
  
  
</body>
</html>
