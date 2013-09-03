<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
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
<h1 align="center">HOSPITAL LA CARLOTA</h1>
<h4 align="center">Ordenes de cargo </h4>
<p align="center"><span class="style7">
  <?php 
	 $sSQL1= "Select * From clientesInternos WHERE numeroE= '".$_GET['numeroE']."' 
and
nCuenta='".$_GET['nCuenta']."'
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	  echo $myrow1['paciente']."-".$myrow1['cuarto'];
	  	 		?>
</span></p>
<p align="center">Surte: <?php echo $usuario;?></p>
<form id="form1" name="form1" method="post" action="">
  <table width="456" border="0" align="center">
    <tr>
      <th width="92" scope="col"><div align="left"><span class="style17">Hora/Fecha</span></div></th>
      <th width="263" scope="col"><div align="left"><span class="style17">Descripci&oacute;n</span></div></th>
      <th width="89" scope="col"><span class="style17">Solicita</span></th>
      <th width="24" scope="col"><div align="left"><span class="style17">Cant.</span></div></th>
      <th width="48" scope="col"><div align="left"><span class="style17">Status</span></div></th>
    </tr>
    <tr>
<?php	
if($_GET['keyClientesInternos']){
$sSQL18= "
SELECT 
*
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
statusImpresion='standby'
order by codProcedimiento ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){

$q = "UPDATE cargosCuentaPaciente set 
statusImpresion='impreso'
WHERE keyCap = '".$myrow18['keyCAP']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

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

$codigo=$code1=$myrow18['codProcedimiento'];

if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL7= "Select * From existencias WHERE codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);



?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7">
      </span><span class="style7">
      <?php 
	 
	  echo $myrow18['hora1']."-".cambia_a_normal($myrow18['fecha1']);
	  	 		?>
      </span></div>        
        <span class="style7"><label></label>
        <div align="center"></div>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        <span class="Estilo24">
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	 
	  echo $myrow18['usuario'];
	  	 		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7">
        <?php 
	  if($myrow18['cantidad']){
	  echo $myrow18['cantidad'];
	  } else {
	  echo "---";
	  }
	 
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7">
        <?php 
	  if($myrow18['statusCargo']=='standby'){
	  $faltantes=$myrow18['faltantes']-$myrow18['cantidad'];
	  if(faltantes){
	  $f=$faltantes;
	  } else {
	  $f='';
	  }
	  echo 'Faltaron '.$faltantes;
	  } else if($myrow18['statusCargo']=='cargado'){
	  echo 'Completados';
	  } else {
	  echo "---";
	  }
	 
		?>
      </span></div></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  <div align="center">  </div>
  <p align="center">&nbsp;</p>
</form>
</body>
</html>