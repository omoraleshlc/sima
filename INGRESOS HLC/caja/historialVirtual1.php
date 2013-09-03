<?php include("/configuracion/conf.php"); ?>
<?php
$modulo = "cierreCuenta.adm";
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>


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
-->
</style>
</head>

<body>
<?php
$cmdstr2 = "

select DISTINCT
*
from MATEO.CONT_AUXILIAR where 
ID_EJERCICIO='".$ID_EJERCICIOM."' AND 
ID_AUXILIAR = '".$_POST['ctaAuxiliar']."' AND
DETALLE='S'

";
$parsed2 = ociparse($db_conn, $cmdstr2);
ociexecute($parsed2);	 
$nrows2 = ocifetchstatement($parsed1, $results2); 

 for ($i = 0; $i < $nrows2; $i++ ){
$nombre= $results2['NOMBRE'][$i];
 }
 ?>
<form id="form1" name="form1" method="post" action="">
  <h1 align="center">Movimientos de <?php echo $nombre; ?></h1>
  <label>
  <div align="center">






  </label>
</form>
<form id="form2" name="form2" method="post" action="historialVirtual1.php">
  <span class="style12"><span class="style7">
  
  </span></span>
  <table width="841" border="1" align="center">
    <tr>
      <th width="50" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Ejercicio</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Libro</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Folio</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">N.Movimiento</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Fecha</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Descripci&oacute;n</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Importe</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Naturaleza</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Concepto</span></th>
    </tr>
    <tr>
<?php	
$cmdstr1 = "

select DISTINCT
*
from MATEO.CONT_MOVIMIENTO where 
ID_EJERCICIO='".$ID_EJERCICIOM."' AND 
ID_AUXILIARM ='".$_POST['ctaAuxiliar']."' AND
DETALLE='S'
ORDER BY NUMMOVTO ASC
";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

 for ($i = 0; $i < $nrows1; $i++ ){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <label></label>
        <?php echo $results1['id_ejercicio'][$i];?></span></td>
      <td width="37" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['id_libro'][$i];?></span></td>
      <td width="36" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['folio'][$i];?></span></td>
      <td width="80" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['nummovto'][$i];?></span></td>
      <td width="71" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['fecha'][$i];?></span></td>
      <td width="362" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['descripcion'][$i];?></span></td>
      <td width="54" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['importe'][$i];?></span></td>
      <td width="45" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['naturaleza'][$i];?></span></td>
      <td width="48" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $results1['concepto'][$i];?></span></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
</form>
<p>&nbsp; </p>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>