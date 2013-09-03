<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); 
require ('/configuracion/clases/beneficenciaxAlmacen.php'); 

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
<h1 align="center">Beneficencia
<?php   
$sSQL= "Select almacenPrincipal From reportesFinancieros where usuario='".$usuario."'
 and
 random='".$_GET['random']."' 
 and
 usuario='".$usuario."'
 and
 almacen!=''
 and
 beneficencia='si'
 group by almacenPrincipal ";
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
$dxA-> eACC($usuario,$_GET['random'],$entidad,$myrow['almacenPrincipal'],$basedatos);


}



?>
<p align="center">
<?php



$sSQL7d="SELECT  sum(efectivo) as totalEfectivo,sum(efectivo*porcentaje) as totalIVA

FROM
reportesFinancieros
WHERE
random='".$_GET['random']."'
and
usuario='".$usuario."'
and
beneficencia='si'
and
naturaleza='A'
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
<?php print '$'.number_format($myrow7d['totalEfectivo'],2);?></div></th>
  </tr>
  <tr>
    
  </tr>
  <tr>
    <th bgcolor="#FFFF00" scope="col"><div align="left">IVA</div></th>
    <th bgcolor="#FFFF00" scope="col"><div align="left">
	<?php 
	
	print '$'.number_format($myrow7d['totalIVA'],2);
	?></div></th>
  </tr>
  <tr>
    <td><div align="left">TOTAL</div></td>
    <td><div align="left">
      <?php 
	  
	  print '$'.number_format($myrow7d['totalEfectivo'],2);?>
    </div></td>
  </tr>
</table>
</body>
</html>