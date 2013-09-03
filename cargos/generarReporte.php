<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); 


function redondeado ($numero, $decimales) {
   $factor = pow(10, $decimales);
   return (round($numero*$factor)/$factor); } 
   
   
   
   

$q = "DELETE FROM reportesFinancieros 
WHERE
usuario='".$usuario."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

?>

<body>
<span class="informativo">
<blink>
GENERANDO REPORTE.... favor de no cerrar esta ventana, se cerrar&aacute; autom&aacute;ticamente
</blink>
</span>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES"); 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />







<h1 align="center">Folios de Venta
<?php   // (fechaCierre between '".$_GET['fechaInicial']."' and '".$_GET['fechaFinal']."')
$date1=$_GET['year'].'-'.$_GET['mes'].'-01';
$date2=$_GET['year'].'-'.$_GET['mes'].'-31';

$sSQL= "Select * From clientesInternos where entidad='".$entidad."' 
and
( fechaSolicitud between '".$date1."' and '".$date2."')
and
statusCaja='pagado'
and
tipoPaciente='externo'
and
statusDevolucion!='si'


";
 
// $sSQL= "Select * From clientesInternos where folioVenta='I19205' ";
  
$result=mysql_db_query($basedatos,$sSQL); 

?>
</h1>
<p align="center">

</p>
<p align="center">
<?php	
while($myrow = mysql_fetch_array($result)){





 $sSQL2= "Select * From cargosCuentaPaciente where 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto!=''
 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){


switch ($myrow2['dia']) {

   case "Sunday" :
   $dia="Dom";
   break;

   case "Monday" :
   $dia="Lun";
   break;

   case "Tuesday" :
   $dia="Mar";
   break;

   case "Wednesday" :
   $dia="Mie";
   break;

   case "Thursday" :
   $dia="Jue";
   break;

   case "Friday" :
   $dia="Vie";
   break;

   case "Saturday" :
   $dia="Sab";
   break;

default :
$dia=$myrow2['dia'];
break;

   }
   


   
$diaNumerico=substr($myrow2['fecha1'],8,9);
//****sacar tipo reporte
$sSQL6= "Select * From gpoProductos where entidad='".$entidad."' and codigoGP='".$myrow2['gpoProducto']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);





if($myrow6['tipoReporte']=='almacenDestino'){
$sSQL7="SELECT 
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA,
sum(cantidad) as cc
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow2['keyCAP']."'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$despliega='detallesCargosMCCDestino';











$almacen=$myrow2['almacenDestino'];








} else if($myrow6['tipoReporte']=='almacenSolicitante'){

$almacen=$myrow2['almacenSolicitante'];




$sSQL7="SELECT 
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA,
sum(cantidad) as cc
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow2['keyCAP']."'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$despliega='detallesCargosMCCDestino';

}else if($myrow2['beneficencia']=='si'){




$myrow7['cP']=$myrow2['precioVenta'];








} else{
echo 'NADA'.'</br>';
}


//*************************************
//ALMACEN PRINCIPAL
$sSQL6d= "Select almacenPadre From almacenes where entidad='".$entidad."' and almacen='".$almacen."'";
$result6d=mysql_db_query($basedatos,$sSQL6d); 
$myrow6d = mysql_fetch_array($result6d);


$sSQL6dd= "Select descripcion From almacenes where entidad='".$entidad."' and almacen='".$myrow2['almacenDestino']."'";
$result6dd=mysql_db_query($basedatos,$sSQL6dd); 
$myrow6dd = mysql_fetch_array($result6dd);

//************************************


//*************************
if($myrow2['iva']>0){
$porcentaje='0.16';
$iva=round($efectivo*$porcentaje,2);
}else{
$iva=0;
$porcentaje=0;
}
//$devoluciones=$myrow7s['cashDev']+$myrow7s['taxDev'];

$q = "insert into reportesFinancieros 
(
folioVenta,gpoProducto,random,usuario,fecha,entidad,tipoReporte,almacen,keyCAP,efectivo,iva,devolucion,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,naturaleza,statusDevolucion,porcentaje,almacenPrincipal,descripcionArticulo,honorarios,folioDevolucion,beneficencia,
dia,diaNumerico,mes,year,clientePrincipal,cantidad,primeraVez,almacenSolicitud,almacenDestino,descripcionAlmacen,statusCortesia)
values
('".$myrow['folioVenta']."','".$myrow2['gpoProducto']."','".$_GET['random']."','".$usuario."','".$fecha."',
'".$entidad."',
'".$myrow6['tipoReporte']."','".$almacen."',
'".$myrow2['keyCAP']."','".($myrow7['cP']+$myrow7['cA'])."','".(($myrow7['cP']*$porcentaje)+($myrow7['cA']*$porcentaje))."','".$devs."','".$myrow7['cP']."','".$myrow7['cP']*$porcentaje."','".$myrow7['cA']."','".$myrow7['cA']*$porcentaje."','".$myrow2['naturaleza']."','".$myrow2['statusDevolucion']."','".$porcentaje."','".$myrow2['almacenPrincipal']."','".$myrow2['descripcionArticulo']."','".$myrow6['honorarios']."','".$myrow2['folioDevolucion']."'  ,'".$myrow2['beneficencia']."' ,
'".$dia."','".$diaNumerico."','".$_GET['mes']."','".$_GET['year']."' ,
'".$myrow['clientePrincipal']."','".$myrow2['cantidad']."','".$myrow['primeraVez']."','".$myrow2['almacenSolicitante']."','".$myrow2['almacenDestino']."','".$myrow6dd['descripcion']."','".$myrow['statusCortesia']."'

)";
mysql_db_query($basedatos,$q);
echo mysql_error();

}

//$fV=new desplegarFV();
//$fV->eFV($myrow['folioVenta'],$_GET['random'],$usuario,$entidad,$basedatos);
}




//$dD=new desplegarDepartamentos();
//$dD->eFinanciero($gpoProducto,$myrow['folioVenta'],$entidad,$_GET['fechaInicial'],$_GET['fechaFinal'],
//$myrow['almacen'],$basedatos);
?>
<script>
</script>
<br />

<p align="center">

</p>

  <script>window.close();
  </script>
  
  
  
</body>
</html>