<?php require("/configuracion/ventanasEmergentes.php"); ?>



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

$sSQL1= "SELECT almacen
FROM
almacenes
WHERE 

id_medico = '".$MEDICO."'  

 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL= "SELECT count(*) as citasT
FROM
clienteInternos
WHERE 
statusCargo='cargado' 
and
almacenSolicitud = '".$myrow1['almacen']."'  
AND 
fecha1='".$fecha1."'
and
medico!=''

 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);



?>
<h4 align="center">Hospital La Carlota </h4>
<p align="center">Bienvenido al sistema M&oacute;vil </p>
<form name="form1" method="post" action="listaCitas">
  <table width="291" height="69" border="0" align="center" class="style7">
    <tr>
      <td colspan="2"><div align="center">Operaciones</div></td>
    </tr>
    <tr>
      <td width="149">
	    <div align="center"><a href="/sima/movil/sistemas/menuIndex.php">Sistemas</a></div></td>
      <td width="160"><div align="center">Admisiones</div></td>
    </tr>
    <tr>
      <td><div align="center">Administraci&oacute;n</div></td>
      <td><div align="center">Compras</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><a href="../salir.php">Salir</a></div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
