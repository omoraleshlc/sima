<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campoProveedor'];
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
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

<form id="form1" name="form1" method="post" action="">

  <table width="464" class="table table-striped">
    <tr>
      <th width="88" height="19"  scope="col"><div align="left"><span >Cod. Proveedor </span></div></th>
      <th width="323"  scope="col"><span >Nombre / Raz&oacute;n Social </span></th>
    </tr>
    <tr>
      <?php 

	 
$sSQL11= "Select distinct * From proveedores where entidad='".$entidad."' ORDER BY razonSocial ASC ";



$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 


if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}






//***********traigo cuenta contable


//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" ><span >
        <label></label>
       <a href="javascript:regresar('<?php echo $myrow11['id_proveedor'];  ?>','<?php echo $myrow11['razonSocial']; ?>');"><?php echo $myrow11['id_proveedor'];  ?></a></span></td>
      <td bgcolor="<?php echo $color;?>" ><span ><?php echo $myrow11['razonSocial'];  ?></span></td>
     
    </tr>
    <?php }?>
  </table>


    
</form>
<p>&nbsp; </p>
</body>
</html>
