<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=800,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php
$requisicion=$_GET['id_requisicion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style17 {color: #000000; font-size: 10px; font-weight: bold; }
-->
</style>
</head>



<?php 
$sSQL7= "Select * From listaRequisiciones,almacenes WHERE listaRequisiciones.nRequisicion= '".$requisicion."' 
and
almacenes.almacen=listaRequisiciones.id_almacen
";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$id_almacen=$myrow7['almacen'];
?>

      <?php
$cmdstr3 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."'";
$parsed3 = ociparse($db_conn, $cmdstr3);
ociexecute($parsed3);	 
$nrows3 = ocifetchstatement($parsed3,$resulta3);
for ($i = 0; $i < $nrows3; $i++ ){
$nombre = $resulta3['NOMBRE'][$i];
$apaterno= $resulta3['AP_PATERNO'][$i];
}
?>

<h1 align="center">HOSPITAL LA CARLOTA</h1>
<p align="center"><em>Impresi&oacute;n de Recepciones  </em></p>
<table width="580" border="1" align="center" class="style7">
  <tr>
    <th width="199" scope="col"><div align="left"># de Traspaso</div></th>
    <th width="365" scope="col"><div align="left"><?php echo $_GET['traspaso'];?></div></th>
  </tr>
  <tr>
    <td><div align="left">Usuario Responsable:</div></td>
    <td><div align="left"><?php echo $usuario.":".$nombre." ".$apaterno; ?></div></td>
  </tr>
  <tr>
    <td><div align="left">Fecha:</div></td>
    <td><div align="left"><?php echo $fecha1;?></div></td>
  </tr>
  <tr>
    <td><div align="left">Hora:</div></td>
    <td><div align="left"><?php echo $hora1;?></div></td>
  </tr>
  <tr>
    <td><div align="left">Almac&eacute;n</div></td>
    <td><div align="left"><strong><?php echo $myrow7['descripcion'];?></strong></div></td>
  </tr>
  <tr>
    <td><div align="left"># de Requisici&oacute;n</div></td>
    <td><div align="left"><strong><?php echo $requisicion;?></strong></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<hr class="style17" />
<p align="center" ><em>SURTIDOS</em></p>
<form id="form1" name="form1" method="post" action="">
  <table width="527" border="0" align="center">
    <tr>
      <th width="59" scope="col"><span class="style17">C&oacute;digo</span></th>
      <th width="344" scope="col"><span class="style17">Descripci&oacute;n</span></th>
      <th width="37" scope="col"><span class="style17">UM</span></th>
      <th width="57" scope="col"><span class="style17">Cantidad</span></th>
    </tr>
    <tr>
<?php	
if($requisicion){
$sSQL18= "
SELECT 
*
FROM
requisiciones
WHERE 
id_requisicion='".$requisicion."'


order by codigo ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';
if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];
$descripcion=descripcion($code=$code1,$basedatos);

if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}



$sSQL7= "Select * From existencias WHERE codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL1= "Select * From tarjetaAlmacen WHERE codigo= '".$code1."' order by keyTA DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $descripcion; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['cantidad']){
	  echo $cantidadFaltante=$myrow18['cantidad'];
	  } else {
$surtido='surtido';
	  echo $myrow18['cantidadOriginal'];
	  }
	 
		?>
      </span></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  <p>&nbsp;</p>
  
  
  
  
  
  
    <?php if($surtido!='surtido'){ ?>

  
  
  
  <div align="center">
    <hr class="style17" />
  </div>
  <p align="center">
    <label></label>
    <em>FALTANTES  </em></p>
  <table width="527" border="0" align="center">
    <tr>
      <th width="59" scope="col"><span class="style17">C&oacute;digo</span></th>
      <th width="344" scope="col"><span class="style17">Descripci&oacute;n</span></th>
      <th width="37" scope="col"><span class="style17">UM</span></th>
      <th width="57" scope="col"><span class="style17">Cantidad</span></th>
    </tr>
    <tr>
      <?php	
if($requisicion){
$sSQL18= "
SELECT 
*
FROM
requisiciones
WHERE 
id_requisicion='".$requisicion."'

order by codigo ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';
if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];
$descripcion=descripcion($code=$code1,$basedatos);

if(!$descripcion){
$descripcion="No existen estos art&iacute;culos o est&aacute;n inactivos";
}



$sSQL7= "Select * From existencias WHERE codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL1= "Select * From tarjetaAlmacen WHERE codigo= '".$code1."' order by keyTA DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
      <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]2" type="hidden" id="codigoAlfa[]2" value="<?php echo $code1; ?>" />
        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $descripcion; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
        <?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
        <?php 
	 echo $myrow18['cantidadOriginal']-$myrow18['cantidad'];
	 
		?>
      </span></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  
      <?php } ?>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <table width="200" border="0" align="center">
    <tr>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td><hr /></td>
    </tr>
    <tr>
      <td><div align="center" class="style7">Firma de Recibido </div></td>
    </tr>
  </table>
  </form>
</body>
</html>