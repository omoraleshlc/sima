<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campoSeguro'];
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
<?php 
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="442" class="table table-striped">
    <tr>
      <th width="436" height="19"  scope="col"><div align="left" >
        <div align="center">Descripcion del Paquete</div>
      </div></th>
    </tr>

      <?php 

	 
$sSQL11= "Select * from paquetes where entidad='".$entidad."' ORDER BY descripcionPaquete ASC ";



$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 




//***********traigo cuenta contable


//****************************Terminan las validaciones
?>
<tr  >
      <td height="24" bgcolor="<?php echo $color;?>" >
        <label></label>
       <a href="javascript:regresar('<?php echo $myrow11['codigoPaquete'];  ?>','<?php echo $myrow11['descripcionPaquete']; ?>');"><?php echo $myrow11['descripcionPaquete'];  ?></a></td>
    </tr>
    <?php }?>
  </table>
  <tr>
    <td>
</form>
<p>&nbsp; </p>
</body>
</html>
