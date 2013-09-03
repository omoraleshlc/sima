<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); 
require ('/configuracion/clases/ventasPacientesInternos.php'); 

//$_GET['random']='429928957';



?>




<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES"); 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

</head>

<body>
<h1 align="center">Folios de Venta Px Internos
<?php   
$sSQL= "Select almacenDestino From cargosCuentaPaciente where entidad='".$entidad."'
and
(fechaCargo >='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
gpoProducto!=''
and
almacenDestino!='HALM'
and
statusCargo='cargado'
and
gpoProducto!='HONMED'
and
ventasDirectas!='si'
group by almacenDestino
";
$result=mysql_db_query($basedatos,$sSQL); 

?>
</h1>
<p align="center">
<?php print 'De la Fecha: '.cambia_a_normal($_GET['fechaInicial']).' a '.cambia_a_normal($_GET['fechaFinal']);?>
</p>
<p align="center">
<?php	
while($myrow = mysql_fetch_array($result)){


$dxA=new desplegarACC();
$dxA-> eACC($_GET['fechaInicial'],$_GET['fechaFinal'],$entidad,$myrow['almacenDestino'],$basedatos);


}



?>
<p align="center">
<?php
 //**************************EFECTIVO*******************
$sSQL7="SELECT  sum(precioVenta*cantidad) as totalEfectivo,sum(iva*cantidad) as totalIVA

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')
and

(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCargo='cargado'
and
naturaleza='C' 
and
almacenDestino!='HALM'
and
gpoProducto!='HONMED'
and
ventasDirectas!='si'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);



$sSQL7d="SELECT  sum(precioVenta*cantidad) as totalEfectivo,sum(iva*cantidad) as totalIVA

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCargo='cargado'
and
naturaleza='A' 
and
almacenDestino!='HALM'
and
gpoProducto!='HONMED'
and
ventasDirectas!='si'
";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);

?>
<p align="center">
<hr/>
<table width="200" border="1" align="center">
  <tr>
    <th colspan="2" bgcolor="#00FF00" scope="col">GLOBALES</th>
  </tr>
  <tr>
    <th width="97" scope="col"><div align="left">SubTotal</div></th>
    <th width="87" scope="col"><div align="left">
<?php print '$'.number_format($myrow7['totalEfectivo']-$myrow7d['totalEfectivo'],2);?></div></th>
  </tr>
  <tr>
    
  </tr>
  <tr>
    <th bgcolor="#FFFF00" scope="col"><div align="left">IVA</div></th>
    <th bgcolor="#FFFF00" scope="col"><div align="left">
	<?php 
	
	print '$'.number_format($myrow7['totalIVA']-$myrow7d['totalIVA'],2);
	?></div></th>
  </tr>
  <tr>
    <td><div align="left">TOTAL</div></td>
    <td><div align="left">
      <?php 
	  
	  print '$'.number_format(($myrow7['totalEfectivo']+$myrow7['totalIVA'])-($myrow7d['totalEfectivo']+$myrow7d['totalIVA']),2);?>
    </div></td>
  </tr>
</table>
</body>
</html>