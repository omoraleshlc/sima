<?php require('/configuracion/ventanasEmergentes.php');?>





<?php
$fecha1=date("Y-m-d");


if($_POST['actualizar'] AND $_POST['keyPA'] AND $_POST['descripcion']  ){

$q1 = "UPDATE articulos set 

descripcion='".$_POST['descripcion']."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."',
usuario='".$usuario."'

WHERE keyPA='".$_POST['keyPA']."'";
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
<h2 align="center">
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


?>
</h2>
<form id="form1" name="form1" method="post" action="">
  <table width="385" border="0" align="center">
    <tr>
      <td width="103" bgcolor="#FFCCFF" class="style12"><div align="center">Descripci&oacute;n</div></td>
      <td width="231" bgcolor="#FFCCFF" class="style12">        <label>
        <label>
        <textarea name="descripcion" cols="50" rows="5" wrap="virtual" class="style12" id="descripcion"><?php echo $myrow['descripcion'];?></textarea>
        </label>
        <div align="center"></div>
        </label></td>
    </tr>

    <tr>
      <td colspan="2" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="style12"><div align="left" class="style12">
        <div align="center">
		<input name="keyPA" type="hidden" class="style12" id="keyPA" value="<?php echo $_GET['keyPA'];?>" />
		<input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar Grupo" />
        </div>
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
