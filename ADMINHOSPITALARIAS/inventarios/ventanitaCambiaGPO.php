<?php require('/configuracion/ventanasEmergentes.php');?>





<?php
$fecha1=date("Y-m-d");


if($_POST['actualizar'] AND $_POST['codigo'] AND $_POST['gpoProducto']  ){

$q1 = "UPDATE articulos set 

gpoProducto='".$_POST['gpoProducto']."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."',
usuario='".$usuario."'

WHERE codigo='".$_POST['codigo']."' and entidad='".$entidad."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>
<?php 
}


?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {font-size: 10px}
.style13 {font-size: 10px}
-->
</style>
</head>

<body>
<h2 align="center">Cambiar de Grupo </h2>
<p align="center">
 <?php 
 $sSQL= "SELECT 
 *
FROM
  articulos
where entidad='".$entidad."' AND
  codigo='".$_GET['codigo']."'

  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
echo $myrow['descripcion'];

?>
&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="385" border="0" align="center">
    <tr>
      <td width="103" bgcolor="#FFCCFF" class="style12"><div align="center">Grupo de Producto </div></td>
      <td width="231" bgcolor="#FFCCFF" class="style12">        <label>
        <div align="center">
          <?php //*********ANAQUELES
	 
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
$gpoProducto=$myrow['gpoProducto'];
$sSQL11= "SELECT 
 *
FROM
  gpoProductos
where entidad='".$entidad."' AND codigoGP = '".$gpoProducto."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

	  ?>
          <select name="gpoProducto" class="style13" id="gpoProducto">
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
            <option 
		    <?php 		if($myrow['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
            <?php } 
		
		?>
          </select>
        </div>
        </label></td>
    </tr>

    <tr>
      <td colspan="2" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="style12"><div align="left" class="style12">
        <div align="center">
		<input name="codigo" type="hidden" class="style12" id="nuevo" value="<?php echo $_GET['codigo'];?>" />
		<input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar Grupo" />
        </div>
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
