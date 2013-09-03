<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$numeroE=$_GET['numeroE'];


?>
<script type="text/javascript">
	function regresar(strCuenta,horaDespliega){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = strCuenta;
				self.opener.document.<?php echo $campoDespliega;?>.<?php echo $campoDespliega;?>.value = horaDespliega;
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
  <table width="104" border="0" align="center">
    <tr>
      <th width="45" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo  </span></div></th>
      <th width="49" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Hora </span></div></th>
    </tr>
    <tr>
<?php 

	 
$sSQL11= "Select distinct * From citasLaboratorio order by keyH ASC";



$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 
$horaSolicitud=$myrow11['keyH'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

 $sSQL12= "
SELECT *
FROM
cargosCuentaPaciente
WHERE 
numeroE='".$numeroE."' 
and
horaSolicitud='".$horaSolicitud."'
and
(status='pagado' or status='cxc' or statusUrgencias='ontransfer'
or 
status='solicita'
)

";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

if($myrow12['tipoPaciente']=='interno'){
 $sSQL12= "
SELECT *
FROM
clientesInternos
WHERE 
numeroE='".$numeroE."' 
and
statusCuenta='abierta'

";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
 $sSQL121= "
SELECT *
FROM
pacientes
WHERE 
numCliente='".$numeroE."' 
";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
$paciente=$myrow121['nombre1']." ".$myrow121['nombre2']." ".$myrow121['apellido1']." ".$myrow121['apellido2']." ".$myrow121['apellido3'];
} else if($myrow12['tipoPaciente']=='externo'){
 $sSQL12= "
SELECT *
FROM
clientesAmbulatorios
WHERE 
numeroE='".$numeroE."' 
and
(status='pagado' or status='cxc')
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$paciente=$myrow12['paciente'];
} else {
$paciente="";
}

//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
		<?php if(!$paciente){ ?>
       <a href="javascript:regresar('<?php echo $myrow11['keyH'];  ?>','<?php echo $myrow12['horaSolicitud']; ?>');"><?php echo $myrow11['keyH'];  ?></a>
	   <?php } else {?>
	   <?php echo $myrow11['keyH']; ?>
	   <?php } ?>
	   </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php echo $myrow11['hora']; ?>
      </span></td>
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
