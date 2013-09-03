<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['nombreCampo'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];



?>
<script type="text/javascript">
	function regresar(strCuenta,seguro){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = strCuenta;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = seguro;
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
  <table width="204" border="1" align="center">
    <tr>
      <th width="71" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cod Pieza </span></div></th>
      <th width="117" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n de la Pieza </span></th>
    </tr>
    <tr>
      <?php 

	 
$sSQL11= "Select distinct * From unidadMedida  ORDER BY descripcionUM ASC ";



$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 


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
       <a href="javascript:regresar('<?php echo $myrow11['codigoUM'];  ?>','<?php echo $myrow11['descripcionUM']; ?>');"><?php echo $myrow11['codigoUM'];  ?></a></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow11['descripcionUM'];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
