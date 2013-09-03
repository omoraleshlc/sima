<?php require('/configuracion/ventanasEmergentes.php');?>





<?php
$fecha1=date("Y-m-d");


if($_POST['actualizar'] AND $_POST['codigo'] AND $_POST['um']  ){

$q1 = "UPDATE articulos set 

um='".$_POST['um']."',

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



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=600,scrollbars=YES") 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {font-size: 10px}
.style13 {font-size: 10px}
.Estilo24 {font-size: 10px}
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<h2 align="center">Cambiar de Unidad de Medida </h2>
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
echo $myrow['um'];

?>
&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="401" border="0" align="center">
    <tr>
      <td width="85" bgcolor="#FFCCFF" class="style12"><div align="center">UM</div></td>
      <td width="319" bgcolor="#FFCCFF" class="style12">        <label>
        <input name="um" type="text" class="Estilo24" id="um" 
		onchange="javascript:this.form.submit();"
		value="<?php echo $myrow['um']; ?>" size="4"   readonly="" />
        <span class="Estilo24"><a href="javascript:ventanaSecundaria2('/sima/cargos/ventanaEmergenteUM.php?campoDespliega=<?php echo "umDescripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;nombreCampo=<?php echo "um"; ?>&amp;usuario=<?php echo $usuario; ?>')"> <img src="/sima/imagenes/Save.png" alt="Unidad de Medida" width="20" height="20" border="0" /></a>
        <?php
	  $um=$myrow['um'];
	  $sSQL11= "SELECT 
 *
FROM
  unidadMedida
where entidad='".$entidad."' AND codigoUM = '".$um."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
	  ?>
        <input name="umDescripcion" type="text" class="Estilo24" id="umDescripcion" value="<?php echo $myrow11['descripcionUM'];?>" size="40" readonly="" />
        <a href="javascript:ventanaSecundaria('/sima/cargos/um.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a></span>
      </label></td>
    </tr>

    <tr>
      <td colspan="2" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="style12"><div align="left" class="style12">
        <div align="center">
		<input name="codigo" type="hidden" class="style12" id="nuevo" value="<?php echo $_GET['codigo'];?>" />
		<input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar UM" />
        </div>
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
