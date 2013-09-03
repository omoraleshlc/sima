<?php require("menuOperaciones.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 12px; font-weight: bold; }
.style12 {font-size: 12px}
.style7 {font-size: 12px}
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 12px}
.style14 {color: #0000FF}
.style16 {color: #339933}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h1 align="center">Impresi&oacute;n de Cr&eacute;ditos Vencidos </h1>
  <p align="center"><span class="none">Escoje el seguro/Cliente: 
    <?php 
	 
$sSQL1= "Select distinct * From clientes 

ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
    <select name="seguro" class="none" id="seguro" onchange="javascript:this.form.submit();"/>

    <option value="0">PARTICULAR SIN DESCUENTO</option>
    <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
    <option 
	<?php if($_POST['seguro']==$myrow1['numCliente'])echo 'selected'; ?>
	value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['nomCliente']; ?></option>
    <?php } ?>
    </select>
  </span></p>
  <p align="center" class="none">&nbsp;</p>
  <p align="center" class="none">La b&uacute;squeda puede demorar unos minutos!! </p>
  <label>
  <div align="center">
  </label>
</form>
<form id="form2" name="form2" method="post" action="antecedentesPatologicos.php">
<img src="../imagenes/bordestablas/borde1.png" alt="bo1" width="600" height="24" />
<table width="600" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="140" bgcolor="#FFFF00" class="none" scope="col"><span class="none">N. Credencial </span></th>
      <th bgcolor="#FFFF00" class="none" scope="col"><span class="none">Estado del seguro -&gt;cliente :</span><span class="none"><span class="none">
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
      </span></span></th>
      <th bgcolor="#FFFF00" class="none" scope="col"><span class="none">Fecha</span></th>
    </tr>
    <tr>
<?php	

$sSQL39= "SELECT distinct *
FROM
segurosLimites where seguro='".$_POST['seguro']."' 

";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$creditoTope=$myrow39['cantidad'];

if($creditoTope){
$sSQL= "
SELECT distinct *
FROM
cargosCuentaPaciente
where 
seguro='".$_POST['seguro']."' 
order by credencial asc 
 ";

 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
  $N=$myrow['credencial'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 

$sSQL12= "SELECT sum(precioVenta) as totales
FROM
cargosCuentaPaciente
WHERE 
seguro='".$_POST['seguro']."' and credencial ='".$N."'
 ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

if($myrow12['totales'] > $creditoTope){
$creditoLeyenda="Crédito Agotado";
$estilo='#FF0000';
} else {
$creditoLeyenda="Crédito disponible";
$estilo='#339933';
}
//echo '<input name="numPaciente" type="submit" class="style12" id="numPaciente" 
//		value="<?php echo $N

?>

      <td height="24" bgcolor="<?php echo $color;?>" class="none"><span class="none">
        <label>
        <?php echo $N?>
        </label>
      </span></td>
      <td width="359" bgcolor="<?php echo $estilo;?>" class="<?php echo $estilo;?>"><span class="style7"><?php echo $myrow21['nombre1']." ".$myrow21['nombre2']
	  ." ".$myrow21['apellido1']." ".$myrow21['apellido2']." ".$myrow21['apellido3'];
	  echo $creditoLeyenda." "."$".number_format($myrow12['totales'],2)." de "."$".number_format($creditoTope,2);
	  ?></span></td>
      <td width="87" bgcolor="<?php echo $color;?>" class="none"><div align="center"><span class="style7">
	  <?php echo $myrow['fecha1'];
	  ?></span></div></td>
    </tr>
    <?php } }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
<img src="../imagenes/bordestablas/borde2.png" alt="bo2" width="600" height="24" />
<p>&nbsp;</p>
</form>
<p>&nbsp; </p>
</body>
</html>
