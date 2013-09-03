<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php
if($_POST['borrar'] AND $_POST['codigoAnaquel']){
$borrame = "DELETE FROM tipoAnaqueles WHERE codigoAnaquel ='".$_POST['codigoAnaquel']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
tipoanaquel_eliminado();
}


if($_POST['nuevo']){
$_POST['codigoAnaquel'] = "";
$_POST['codigoRazon'] ="";
}


if($_POST['actualizar'] AND $_POST['codigoAnaquel']){
$sSQL1= "Select * From tipoAnaqueles WHERE codigoAnaquel = '".$_POST['codigoAnaquel']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoAnaquel']){
if($_POST['codigoAnaquel']!=$myrow1['codigoAnaquel']){

$agrega = "INSERT INTO tipoAnaqueles (
codigoAnaquel,tipoAnaquel,entidad
) values ('".$_POST['codigoAnaquel']."','".$_POST['clasificaAnaquel']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
tipoanaquel_agregado();
}} else {
 $q = "UPDATE tipoAnaqueles set 
codigoAnaquel= '".$_POST['codigoAnaquel']."', 
tipoAnaquel='".$_POST['clasificaAnaquel']."'
WHERE 
codigoAnaquel='".$_POST['codigoAnaquel']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
anaquel_actualizado();
}
}




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #00000; font-size: 14px; font-weight: bold; }
.style12 {font-size: 14px}
.style7 {font-size: 14px}
.style13 {color: #00000; font-size: 14px;}
-->
</style>
</head>

<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <img src="/sima/imagenes/bordestablas/borde1.png" width="545" height="24" />
  <table width="545" height="189" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
      <td height="24" bgcolor="#CCCCCC">&nbsp;</td>
      <td colspan="2" align="center" bgcolor="#FFFF00">                        <strong>Tipos de Anaqueles</strong></td>
    </tr>
    <tr>
      <td width="1" height="28" bgcolor="#CCCCCC"><div align="left"></div></td>
      <td width="118" bgcolor="#CCCCCC"><div align="left">C&oacute;digo del Anaquel </div></td>
      <td width="412" bgcolor="#CCCCCC"><div align="left">
          <label>
		  <?php $aCombo= "Select * From tipoAnaqueles where codigoAnaquel = '".$_POST['tipoAnaquel1']."'";
$rCombo=mysql_db_query($basedatos,$aCombo); 
$imprimeTipo = mysql_fetch_array($rCombo);

?></select>
          </label>
          <label>
<input name="codigoAnaquel" type="text" id="codigoAnaquel" size="3" value="
<?php if($_POST['tipoAnaquel1'] AND $imprimeTipo['codigoAnaquel']){
		  
		  echo $imprimeTipo['codigoAnaquel'];
		  }
		  ?>" />
          </label>
</div></td>
    </tr>
    <tr>
	
      <td height="33" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">Anaquel</td>
      <td bgcolor="#CCCCCC"><input name="clasificaAnaquel" type="text" class="style12" id="clasificaAnaquel" value="<?php if($_POST['tipoAnaquel1'] AND $imprimeTipo['codigoAnaquel']){
		  echo "$paso";
		  echo $imprimeTipo['tipoAnaquel'];
		  }
		  ?>" size="60" /></td>
    </tr>
    <tr>
      <td height="74" bgcolor="#CCCCCC"><div align="left"></div></td>
      <td bgcolor="#CCCCCC"><div align="left"><span class="style13"></span></div></td>
      <td bgcolor="#CCCCCC"><div align="left">
          <label>
          <div align="right">
            <label>
            <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
            </label>
            <input name="actualizar" type="submit" class="style12" id="actualizar" value="Actualizar/Grabar" />
          </div>
        </label>
      </div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td colspan="3"><div align="center" class="style12">
          <label>
          <input name="atras" type="submit" class="style12" id="atras" value="&lt;&lt;" />
          </label>
          <label>
          <input name="siguiente" type="submit" class="style12" id="siguiente" value="&gt;&gt;"/>
          </label>
      </div></td>
    </tr>
  </table>
<img src="/sima/imagenes/bordestablas/borde2.png" width="545" height="24" />
<p align="center" class="style12"><a href="anaquel.php">Regresar a Anaqueles</a></p>
  <p>&nbsp;</p>
</form>
<p align="center">&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
  <img src="/sima/imagenes/bordestablas/borde1.png" width="384" height="24" />
<table width="384" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="130" bgcolor="#FFFF00" scope="col"><span class="style11"># Tipo de Anaquel </span></th>
      <th width="238" bgcolor="#FFFF00" scope="col"><span class="style11">Clasificaci&oacute;n de Anaquel </span></th>
    </tr>
    <tr>
      <?php	
	  


 $sSQL1= "Select * From tipoAnaqueles  ORDER BY (codigoAnaquel+0) ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 
echo mysql_error();
 

while($myrow1 = mysql_fetch_array($result1)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow1['codigoAnaquel'];
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="tipoAnaquel1" type="submit" class="style12" id="tipoAnaquel1" value="<?php echo $C?>" />
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow1['tipoAnaquel'];?></span></td>
    </tr>
    <?php }?>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="384" height="24" />
</form>
<p align="center">&nbsp;</p>
</body>
</html>
