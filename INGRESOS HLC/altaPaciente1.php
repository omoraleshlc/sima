<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 


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

<head>


<meta http-equiv="refresh" content="30" >

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<?php 

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center" > <br />
  Abonos a Pacientes Internos</h1>
  <p align="center" >(Para hacer un abono, Presiona en el nombre del Paciente)</p>
  <table width="570" class="table table-striped">

    <tr >
      <th width="52" >Folio V</th>
      <th width="249" >Datos del Paciente</th>
      <th width="269" >Aseguradora</th>
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
    
    
   <tr  > 
      <td height="40"><span ><?php echo $myrow['folioVenta'];
?></span></td>
      <td><a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/agregarAbonos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">
	  <span ><?php echo $myrow['paciente'];

	  ?></a></span>

        <br /><span >Departamento: 
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
      <td ><?php echo $myrow40['nomCliente'];?><br />
	<span >  Cuarto: 
	  <?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  echo '---';
	  }
?></span></td>    <?php  }}?>
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