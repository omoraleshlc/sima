<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$descripcion =$_GET['descripcion'];



?>
<script type="text/javascript">
	function regresar(strCuenta){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = strCuenta;
				
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
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="650" class="table-forma">
    <tr>
      <td width="112"  scope="col"><div align="left"><span >Cargar Art&iacute;culos </span></div></td>
      <td width="378"  scope="col"><div align="left"><span >
          <input name="nomArticulo" type="text"  id="nomArticulo" size="60" value="<?php echo $_GET['nomArticulo']?>"/>
          </span>
              <input name="buscar" type="submit"  id="buscar" value="buscar" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="445" class="table table-striped">
    <tr>
      <th width="64" height="19"  scope="col"><div align="left"><span >C&oacute;digo</span></div></th>
      <th width="211"  scope="col"><span >Descripci&oacute;n</span></th>
      <th width="156"  scope="col"><span >Imagen</span></th>
    </tr>
    <tr>
      <?php 

	 $descripcion =$_POST['nomArticulo'];

if($descripcion){
$sSQL11= "Select distinct * From CB 
where
descripcion like
'%$descripcion%'

ORDER BY descripcion ASC ";



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
      <td height="24" bgcolor="<?php echo $color;?>" ><span >
        <label></label>
       <a href="javascript:regresar('<?php echo $myrow11['codigoCB'];  ?>','<?php echo $myrow11['descripcion']; ?>');"><?php echo $myrow11['codigoCB'];  ?></a></span></td>
      <td bgcolor="<?php echo $color;?>" ><span ><?php echo $myrow11['descripcion'];  ?></span></td>
      <td bgcolor="<?php echo $color;?>" ><img src="<?php  echo $myrow11['ruta']; ?>" width="156" height="43" /></td>
    </tr>
    <?php }}?>
  </table>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
