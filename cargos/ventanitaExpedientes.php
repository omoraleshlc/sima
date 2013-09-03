<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campo'];
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
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
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
  <p>
  <label class="style7">
    <div align="center">
  <div align="center">
      <input name="nombres" type="text" class="style12" size="60" value="<?php echo $_POST['nombres']; ?>" />
      <label>
      <input name="buscar" type="submit" class="style7" id="buscar" value="Buscar" />
      </label>
      <a href="javascript:ventanaSecundaria1(
		'/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $_POST['numeroE']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" /></a></div>
  </label>
  <hr width="460" />
  <table width="404" border="0" align="center">
    <tr>
      <th width="71" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">n Expediente </span></div></th>
      <th width="317" bgcolor="#660066" scope="col"><span class="style11">Nombre(s) Apellidos. </span></th>
    </tr>
    <tr>
      <?php 
$nombres=$_POST['nombres'];


if($nombres){	 
$sSQL11= "
SELECT * FROM 
pacientes 
where 
(
CONCAT(nombre1) like '%$nombres%'
or
CONCAT(apellido1,' ',apellido2) like '%$nombres%'
or
CONCAT(apellido3) like '%$nombres%'
or
CONCAT(nombre1) like '%$nombres%'
)
order by
apellido1 asc
";



$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 
$numClient= $myrow11['numCliente'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}






//***********traigo cuenta contable
$sSQL= "SELECT *
FROM
clientesInternos
Where
numeroE='".$numClient."' 
and
(status='activa' or status='standby')
ORDER BY numeroE DESC
 ";

 
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>	<?php 
		if($myrow['numeroE']!=$myrow11['numCliente']){ ?>
       <a href="javascript:regresar('<?php echo $myrow11['numCliente'];  ?>',
	'<?php echo $myrow11['nombre1']." ".$myrow11['nombre2']." ".$myrow11['apellido1']." ".$myrow11['apellido2']." ".$myrow11['apellido3']; ?>');"><?php 


	echo $myrow11['numCliente'];  
	
	?>
	
	</a>
	<?php } else { 
	if($myrow['status']=='standby'){
	echo "Px en Proceso";
	} else {
	echo "Px Interno";
	}
	}
	?>
	
	</span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
<?php 

echo $myrow11['nombre1']." ".$myrow11['nombre2']." ".$myrow11['apellido1']." ".$myrow11['apellido2']." ".$myrow11['apellido3'];
if($myrow['status']=='standby'){
echo "  (Falta que pague en caja su depósito)";
}
?></span></td>
     
    </tr>
    <?php }}?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
