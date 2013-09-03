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
 $sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['nT']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$statusAlta= $myrow3['statusAlta'];
?>

<form id="form1" name="form1" method="post" action="">
  <table width="298" border="0" align="center">
    <tr>
      <th width="72" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cuenta Mayor </span></div></th>
      <th width="216" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n</span></div></th>
    </tr>
    <tr>
  

   <?php   




if(!$statusAlta){
$sSQL= "Select * From catTTCaja where entidad='".$entidad."' and (almacen='".$_GET['almacenFuente']."' or almacen='".$_GET['ali']."') AND naturaleza!='Credito' 
AND tipoPago='".$tipoPago."'
order by codigoTT ASC";

} else {   
 $sSQL= "Select * From catTTCaja where 
 entidad='".$entidad."' and almacen='".$ALMACEN."' AND
  tipoPago='".$tipoPago."' order by codigoTT ASC";
}


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


?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>

	
<a href="javascript:regresar('<?php echo $myrow['codigoTT'];  ?>','<?php echo $myrow['descripcion'];  ?>','<?php echo $cargoxPagar;?>');">
	   <?php 
	
	   echo $myrow['codigoTT'];  ?>
	   </a>

	   </span></td>
      
	  
	  
	  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion'];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
