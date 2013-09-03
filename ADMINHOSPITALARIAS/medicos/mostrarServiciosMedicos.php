<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="">
  <h1 align="center"><strong>LISTADO DE SERVICIOS </strong></h1>
  <p>
<label>
  <div align="center">
  </label>
</form>
<form id="form1" name="form1" method="post" action="modificaMedicos.php">
  <table width="575" border="0" align="center">
    <tr>
      <th width="91" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">C&oacute;digo</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Descripci&oacute;n</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">PV1</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">PV3</span></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
articulos 
WHERE
entidad='".$entidad."' AND
medico='".$_GET['numMedico']."'
order by descripcion
ASC
";
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

	  $N=$myrow['codigo'];
	  
	  
$sSQL1= "SELECT *
FROM
articulosPrecioNivel
WHERE
entidad='".$entidad."' AND
codigo='".$N."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	  ?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">

<?php echo $N?>

 
     </span></td>
      <td width="331" bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php 
	  if($myrow['descripcion']){
	  echo $myrow['descripcion'];
	  } else {
	  echo "---";
	  }
	  ?></span></td>
      <td width="62" bgcolor="<?php echo $color;?>" class="style12"><?php 
	echo "$".number_format($myrow1['nivel1'],2);
	  ?></td>
      <td width="73" bgcolor="<?php echo $color;?>" class="style12"><?php 
	 echo "$".number_format($myrow1['nivel3'],2);
	  ?>&nbsp;</td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
</form>
<p>&nbsp; </p>
</body>
</html>