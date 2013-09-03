<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campoSeguro'];





?>
<script type="text/javascript">
	function regresar(strCuenta){
		self.opener.document.form1.<?php echo $campo;?>.value = strCuenta;
		close();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="404" border="0" align="center">
    <tr>
      <th width="71" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">ID_CCOSTO</span></div></th>
      <th width="317" bgcolor="#660066" scope="col"><span class="style11">Nombre / Raz&oacute;n Social </span></th>
    </tr>
    <tr>
  

	 
         <?php //*********
$cmdstr1 = "select * from MATEO.CONT_CCOSTO 
WHERE
ID_CCOSTO LIKE '4.01%' AND
ID_EJERCICIO ='".$ID_EJERCICIOM."' AND
DETALLE='S'


ORDER BY ID_CCOSTO ASC";
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






//***********traigo cuenta contable


//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
       <a href="javascript:regresar('<?php echo $results1['ID_CCOSTO'][$i];  ?>');"><?php echo $results1['ID_CCOSTO'][$i];  ?></a></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $results1['NOMBRE'][$i];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
