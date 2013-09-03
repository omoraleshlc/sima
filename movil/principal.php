<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php 
/* if(!$MEDICO and $usuario=='omorales'){
$url='http://hlc.um.edu.mx/sima/movil/menu.php/';
	return header("location: $url");
exit();	
} */
$url='http://hlc.um.edu.mx/sima/movil/menu.php/';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
-->
</style>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<body>
<?php 
//$MEDICO='HLC030';
$almacenPadre='HCEX';

$sSQL11= "SELECT almacen
FROM
almacenes
WHERE 

id_medico = '".$MEDICO."'  
and
almacenPadre='".$almacenPadre."'
 ";

$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

$sSQL1= "SELECT apellido1,numMedico
FROM
medicos
WHERE 

numMedico = '".$MEDICO."'  

 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL= "SELECT count(*) as citasT
FROM
clientesInternos
WHERE 
status='pendiente' 
and
almacenSolicitud = '".$myrow11['almacen']."'  
AND 
fechaSolicitud='".$fecha1."'
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);






?>
<h1 align="center">Hospital La Carlota </h1>
<p align="center">Bienvenido al sistema M&oacute;vil </p>
<p align="center"><?php if($myrow['citasT']>0){ 
echo 'Dr. '.$myrow1['apellido1'].' '.$myrow['citasT'].' citas para hoy';
} else {
echo 'Dr. '.$myrow1['apellido1'].', ud. no tiene ninguna cita para hoy';
;}?></p>
<div align="center"></div>
<form name="form1" method="post" action="listaCitas">
  <table width="291" height="69" border="0" align="center" class="style7">
    <tr>
      <td width="149">
	    <div align="center"><a href="/sima/movil/listaCitas.php">Px </a></div></td>
      <td width="160"><div align="center">Px Atendidos </div></td>
    </tr>
    <tr>
      <td><div align="center"><a href="/sima/movil/buscarExpediente.php">Buscar Expediente </a></div></td>
      <td><div align="center"></div></td>
    </tr>
    <tr>
      <td><div align="center"></div></td>
      <td><div align="center"><a href="../salir.php">Salir</a></div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
