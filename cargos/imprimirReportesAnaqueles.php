<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); ?>


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

<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>
<BODY >


<h1 align="center" >HOSPITAL LA CARLOTA</h1>
<h4 align="center" >Ordenes de cargo <span >
  <?php 
	 $sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."';
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);?>
  <br />
</span></h4>
<table width="580" class="table-forma">
  <tr>
    <td width="95" align="left">&nbsp;</td>
    <td width="415" align="left" ><span >Folio de Venta: <?php echo $myrow1['folioVenta'];

?></span></td>
    <td width="70" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" ><span >Paciente: <?php echo $myrow1['paciente'];

?></span></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" >Seguro:
      <?php 
		
	$segur= $myrow1['seguro'];
	
	if ($segur!='') {
	$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$segur."';
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" ><span >Departamento:
      <?php $stock= $myrow1['almacen'];
	$sSQL2= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$stock."';
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
	 
	echo $myrow2['descripcion'];

?>
    </span></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>

<?php 
	$sSQL23= "Select descripcionCuarto From cuartos WHERE entidad='".$entidad."' and codigoCuarto='".$myrow1['cuarto']."';
";
$result23=mysql_db_query($basedatos,$sSQL23);
$myrow23 = mysql_fetch_array($result23);

?>

    <td align="left" ><span >Cuarto:<?php echo $myrow23['descripcionCuarto'];

?></span></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="left" >Medico Internamiento:
    <?php 
	 $sSQL3= "Select * From medicos WHERE entidad='".$entidad."' and numMedico='".$myrow1['medico']."';
";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	echo $myrow3['nombre1']." ".$myrow3['apellido1']." ".$myrow3['apellido2'];

?></td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
<p align="center" >Surte: <?php echo $usuario;?></p>
<form id="form1" name="form1" method="post" action="">
<table width="600" class="table table-striped">
    <tr>
      <th width="50" scope="col"><div align="left" ><span ># Solicitud</span></div></th>
      <th width="30" scope="col"><div align="left" ><span >Hora/Fecha</span></div></th>
      <th width="100" scope="col"><div align="left" ><span >Descripcion</span></div></th>
      <th width="50" scope="col"><div align="left" ><span >Solicita</span></div></th>
      <th width="10" scope="col"><div align="left" >
        <div align="left"><span >Cant.</span></div>
      </div></th>
      
            <th width="30" scope="col"><div align="left" >
        <div align="left"><span >Costo</span></div>
      </div></th>
      
      <th width="30" scope="col"><div align="left" >
        <div align="left"><span >Status</span></div>
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
$descripcion="No existen estos articulos o esten inactivos";
}

$sSQL7= "Select * From existencias WHERE entidad='".$entidad."' and codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


   $sSQL3ac="SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow18['codProcedimiento']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
?>

<td bgcolor="<?php echo $color?>">

<div align="left" >
<?php 

echo $myrow18['keyCAP'];?>
</div>
</td>


      <td height="24" bgcolor="<?php echo $color?>"><div align="left" >
          <?php 
	 
	  echo $myrow18['horaSolicitud']."</br>".cambia_a_normal($myrow18['fechaSolicitud']);
	  	 		?>
        </span></div>
        <span ><label></label>
        <div align="left"></div>
      </span></td>
      <td bgcolor="<?php echo $color?>" ><span >
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        <?php 
	  if($myrow18['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Este articulo es una devolucion]';
	  }
	  ?>      
        </span></span></td>
                     
      <td bgcolor="<?php echo $color?>" >
        <div align="left" >
          <?php 
	 
	  echo $myrow18['usuario'];
	  	 		?>      
        </div></td>
      
      
      
      <td bgcolor="<?php echo $color?>" ><div align="left" >
        <?php 
	  if($myrow18['cantidad']){
	  echo $myrow18['cantidad'];
	  } else {
	  echo "---";
	  }
	 
		?>
      </div></td>
     
     
     
      <td bgcolor="<?php echo $color?>" ><div align="left" >
      <?php 
	  if($myrow3ac['costo']>0){
	  echo '$'.number_format($myrow3ac['costo'],2);
	  } else {
	  echo "---";
	  }
	 
		?>
      </div></td>
     
     
     
     
      <td bgcolor="<?php echo $color?>" ><div align="left" >
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
    <input name="print" type="submit" class="boton1" id="print" value="Imprimir"  onclick="imprimir();"/>
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