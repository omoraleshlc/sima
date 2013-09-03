<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


<SCRIPT language="javascript">
function imprimir()
{ if ((navigator.appName == "Netscape")) { window.print() ;
}
else
{ var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = "";
}
}
</SCRIPT> 


<?php
if($_POST['print']){
$q = "UPDATE cargosCuentaPaciente set 
statusImpresion='impreso'

WHERE 
entidad='".$entidad."'
and

numeroE='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
and
almacenDestino='".$_GET['almacen']."'
and
statusImpresion='standby' and usuarioImpresion='".$usuario."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
?>


<?php if(!$_POST['print']){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<style type="text/css">
.Estilo10 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style>
</head>
<BODY >


<h1 align="center" class="Estilo1">HOSPITAL LA CARLOTA</h1>
<h4 align="center" class="Estilo2">Ordenes de cargo </h4>
<p align="center"><span class="style7 Estilo3">
  <?php 
	 $sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."';
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	  echo $myrow1['paciente']."-".$myrow1['cuarto'];
	  	 		?>
</span></p>
<p align="center" class="Estilo4">Surte: <?php echo $usuario;?></p>
<form id="form1" name="form1" method="post" action="">
  <table width="1028" border="0" align="center">
    <tr>
      <th width="104" scope="col"><div align="left" class="Estilo4"><span class="style17"># Solicitud</span></div></th>
      <th width="104" scope="col"><div align="left" class="Estilo4"><span class="style17">Fecha Solicitud</span></div></th>
      <th width="104" scope="col"><div align="left" class="Estilo4">
        <div align="center"><span class="style17">Fecha Levanta</span>miento de muestra</div>
      </div></th>
      <th width="349" scope="col"><div align="left" class="Estilo4"><span class="style17">Descripci&oacute;n</span></div></th>
      <th width="128" scope="col"><div align="left" class="Estilo4"><span class="style17">Depto.</span></div></th>
      <th width="117" scope="col"><div align="left" class="Estilo4"><span class="style17">Usuario-Solicita</span></div></th>
      <th width="34" scope="col"><div align="left" class="Estilo4">
        <div align="center"><span class="style17">Cant.</span></div>
      </div></th>
      <th width="54" scope="col"><div align="left" class="Estilo4">
        <div align="center"><span class="style17">Status</span></div>
      </div></th>
    </tr>
    <tr>
      
<?php	
if($_GET['folioVenta'] ){



$sSQL18= "
SELECT 
*
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
 and
folioVenta='".$_GET['folioVenta']."'
and
almacenDestino='".$_GET['almacen']."'
and
random='".$_GET['rand']."'
order by codProcedimiento ASC
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

$codigo=$code1=$myrow18['codProcedimiento'];

if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL7a= "Select almacen From almacenes WHERE entidad='".$entidad."' and centroDistribucion='si' ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);


$sSQL7= "Select * From existencias WHERE entidad='".$entidad."' and codigo= '".$code1."' and almacen='".$myrow7a['almacen']."'   ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);




?>

<td bgcolor="<?php echo $color?>">

<div align="left" class="Estilo4">
<?php echo $myrow18['keyCAP'];?></div></td>


      <td bgcolor="<?php echo $color?>"><span class="Estilo4">
        <?php 
	 
	  echo $myrow18['horaSolicitud']."</br>".cambia_a_normal($myrow18['fechaSolicitud']);
	  	 		?>
      </span></td>
      <td height="24" bgcolor="<?php echo $color?>"><div align="left" class="Estilo4">
          <?php 
	 
	  echo $myrow18['horaCargo']."</br>".cambia_a_normal($myrow18['fechaCargo']);
	  	 		?>
        </span></div>
        <span class="style7"><label></label>
        <div align="center"></div>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo4">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        <span class="Estilo24">
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        </span></span>
        
            <span class="Estilo10">
      <?php 
	  if($myrow18['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Este articulo es una devolucion]';
	  }
	  ?>
      </span>        </td>
                     

      <td bgcolor="<?php echo $color?>" class="Estilo4">
  <?php    $sSQL8ab= "
SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow18['almacenSolicitante']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);
echo $myrow8ab['descripcion'];
?>      </td>
      <td bgcolor="<?php echo $color?>" class="Estilo4">
        <div align="center">
          <?php 
	 
	  echo $myrow18['usuario'];
	  	 		?>      
        </div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="Estilo4">
        <?php 
	  if($myrow18['cantidad']){
	  echo $myrow18['cantidad'];
	  } else {
	  echo "---";
	  }
	 
		?>
      </div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="Estilo4">
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
    <?php  
	

	}}} //cierra while 
	

	
	?>
  </table>
  <div align="center">
    <label><br />
    <input name="print" type="image" src="../imagenes/btns/printbutton.png" id="print" value="Imprimir"  onclick="imprimir();"/>
    </label>
</div>
  <p align="center">&nbsp;</p>
</form>
</body>

</html>
<?php } else { echo 'Datos ya impresos';
echo '<script>';
echo 'close();';
echo '</script>';
} ?>