<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=movimientos.xls"); 
?> 
<?php include("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style13 {color: #FFFFFF}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="736" border="1" align="center">
  <tr>
    <th bgcolor="#660066" class="style11" scope="col"><span class="style11 style13">No.</span></th>
    <th bgcolor="#660066" class="style11" scope="col"><span class="style11 style13">C&oacute;digo</span></th>
    <th bgcolor="#660066" class="style11" scope="col"><span class="style11 style13">Descripci&oacute;n</span></th>
    <th bgcolor="#660066" class="style11" scope="col"><span class="style11 style13">Fecha</span></th>
    <th bgcolor="#660066" class="style11" scope="col"><span class="style11 style13">Importe</span></th>
  </tr>
  <tr>
    <?php	

$sSQL2= "Select * From aperturaCaja ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$poliza = $myrow2['numeroPoliza'];
$fechac= $myrow2['fecha'];

$sSQL= "SELECT *
  FROM
cargosCuentaPaciente 
WHERE numPoliza='".$poliza."' and
ejercicio='".$ID_EJERCICIOM."'
ORDER BY fecha1 ASC
";


 
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$codigo=$myrow['codProcedimiento'];
$sSQL141= "
	SELECT 
  *
FROM
articulos
WHERE 
codigo = '".$codigo."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
    <td width="44" height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow['numeroE'];?>
          <input name="libro" type="hidden" id="libro" value="<?php echo $myrow['ID_LIBRO']; ?>" />
    </span></td>
    <td width="92" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow['codProcedimiento'];?></span></td>
    <td width="443" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow141['descripcion'];?>
          <input name="DESCRIPCION" type="hidden" id="DESCRIPCION" value="<?php echo $myrow141['descripcion']; ?>" />
    </span></td>
    <td width="64" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow['fecha1'];?>
          <input name="FECHA" type="hidden" id="FECHA" value="<?php echo $myrow['fecha1']; ?>" />
    </span></td>
    <td width="59" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"> <?php echo "$".number_format($import=$myrow['costo'],2);?></span></td>
  </tr>
  <?php  
	 $importe[0]+=$myrow['IMPORTE'];
	}}?>
  <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
</table>
<p>&nbsp;</p>
</body>
</html>
