<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$campo=$_GET['campoSeguro'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$tipoPago=$_GET['tipoPago'];
$campo1=$_GET['campo1'];
$ALMACEN=$_GET['almacen'];
$tipoCliente=$_GET['tipoCliente'];
?>
<script type="text/javascript">
	function regresar(strCuenta,campoDespliega,campo1){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = strCuenta;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = campoDespliega;
				self.opener.document.<?php echo $forma;?>.<?php echo $campo1;?>.value = campo1;
						close();
	}
</script>
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
<p align="center">&nbsp;</p>
<?php 
$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$statusAlta= $myrow3['statusAlta'];



$sSQL34= "Select * From cargosCuentaPaciente WHERE entidad='".$entidad."' and numeroE = '".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);
?>

<form id="form1" name="form1" method="post" action="">
  <table width="298" border="0" align="center">
    <tr>
      <th width="72" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
      <th width="216" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
    </tr>
    <tr>
  

   <?php   

$sSQL= "Select precioVenta,tipoTransaccion From cargosCuentaPaciente
where
entidad='".$entidad."'
and
numeroE='".$_GET['numeroE']."'
and
nCuenta='".$_GET['nCuenta']."'
and
statusTraslado='standby'
and
status='transaccion'
and
naturaleza='-'";




$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['codigoTT'];

$sSQL44= "Select codigoTT,descripcion From catTTCaja where 
 entidad='".$entidad."' and 
 codigoTT='".$myrow['tipoTransaccion']."'
 ";

$result44=mysql_db_query($basedatos,$sSQL44); 
$myrow44 = mysql_fetch_array($result44);


?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
	
	
<a href="javascript:regresar('<?php echo $myrow44['codigoTT'];  ?>','<?php echo $myrow44['descripcion'];  ?>','<?php echo $myrow['precioVenta'];?>');">
	   <?php 
	
	   echo $myrow44['codigoTT'];  ?>
	   </a>

	   </span></td>
      
	  
	  
	  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow44['descripcion'];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
