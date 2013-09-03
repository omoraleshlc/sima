<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
include("/configuracion/clases/eCuenta.php"); 

$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta'){ //*******************Comienzo la validac8n*****************
$ventana='/sima/cargos/cierraCuenta2.php';
?>


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=450,height=700,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.style20 {font-size: 10px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
<meta http-equiv="refresh" content="30" >
</head>

<body>
<?php 

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center" class="titulos"> <br />
  Abonos a Pacientes Internos</h1>
  <p align="center" class="codigos">(Para hacer un abono, Presiona en el nombre del Paciente)</p>
  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="3"><img src="../../imagenes/bordestablas/borde1.png" width="570" height="20" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="52" class="negromid">Folio V</td>
      <td width="249" class="negromid">Datos del Paciente</td>
      <td width="269" class="negromid">Aseguradora</td>
    </tr>
<?php	
	  
$cierreCuentaReporte=new articulosDetalles();
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
status='activa'
and
(statusCuenta = 'abierta' or statusCuenta='caja' or statusCuenta='revision')

ORDER BY paciente ASC";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 



if($myrow['seguro']){
$sSQL40= "SELECT nomCliente
FROM
clientes
where 
numCliente='".$myrow['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}else{
$myrow40['nomCliente']='Particular';
}
	  ?>    
    
    
   <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
      <td height="40"><span class="codigos"><?php echo $myrow['folioVenta'];
?></span></td>
      <td><a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/agregarAbonos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">
	  <span class="normalmid"><?php echo $myrow['paciente'];

	  ?></a></span>

        <br /><span class="negro">Departamento: 
      <?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>
      <td class="normalmid"><?php echo $myrow40['nomCliente'];?><br />
	<span class="negro">  Cuarto: 
	  <?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  echo '---';
	  }
?></span></td>    <?php  }}?>
    </tr>
    <tr>
      <td colspan="3"><img src="../../imagenes/bordestablas/borde2.png" width="570" height="20" /></td>
    </tr>
  </table>
  
</form>
</body>
</html>


<?php
} else { 
?>
<script>
window.alert('LA CAJA ESTA CERRADA');
</script>
<?php
}
?>