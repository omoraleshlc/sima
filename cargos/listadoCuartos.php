<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campoCuarto'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
if($_GET['almacenInternamiento']){
$ALMACEN=$_GET['almacenInternamiento'];
}

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

<form id="form1" name="form1" method="post" action="">
  <table width="192" border="0" align="center">
    <tr>
      <th width="71" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C Cuarto </span></div></th>
      <th width="317" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
    </tr>
    <tr>
<?php 
$sSQL11= "Select distinct * From cuartos
where entidad='".$entidad."' AND departamento='".$ALMACEN."'
order by codigoCuarto ASC";



$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}





$codCuarto=$myrow11['codigoCuarto'];
//***********traigo cuenta contable

$sSQL= "SELECT *
FROM
clientesInternos
Where entidad='".$entidad."' AND
cuarto='".$codCuarto."' 
and
(status='activa' or status='standby')

 ";

 
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
		
	 
      <a href="javascript:regresar('
	 <?php
	  echo $myrow11['codigoCuarto']; 
	  
	  ?>','<?php 
	  
	  echo $myrow11['descripcionCuarto']; 
	 
	  ?>');"><?php 
	
	  echo $myrow11['codigoCuarto']; 
	  
	   ?></a>
	
	
	  </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php 
	   if($myrow['cuarto']==$myrow11['codigoCuarto']){ 
	   echo $myrow11['descripcionCuarto'];
       } else {
	   echo $myrow11['descripcionCuarto'];
	   }
	  ?></span></td>
     
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
