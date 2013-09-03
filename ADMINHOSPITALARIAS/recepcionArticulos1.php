<?php require("menuOperaciones.php");?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=730,height=500,scrollbars=YES") 
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

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<?php

if($_POST['nRequisicion']){
$nRequisicion=$_POST['nRequisicion'];
} else {
$nRequisicion=$_GET['nRequisicion'];
}







if($_GET['actualizar']  ){

 $q1 = "UPDATE listaOC set 
id_factura='".$_GET['id_factura']."',
ivaFactura='".$_GET['ivaFactura']."',
importeFactura='".$_GET['importeFactura']."',
notaCredito='".$_GET['notaCredito']."',
remision='".$_GET['remision']."',
fechaFactura='".$_GET['fechaFactura']."'
WHERE entidad='".$entidad."' AND nRequisicion = '".$nRequisicion."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();

$cantidadRecibida=$_GET['cantidadRecibida'];
$cantidadFacturada=$_GET['cantidadFacturada'];

$obsequio=$_GET['obsequio'];

$code1=$_GET['codigoAlfa'];
$keyR=$_GET['keyR'];
$cost=$_GET['cost'];
for($i=0;$i<=$_GET['pasoBandera'];$i++){


$sSQL17= "Select * From OC WHERE  keyR = '".$keyR[$i]."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$id_requisicion=$myrow17['id_requisicion'];
$piden=$myrow17['cantidadComprar'];
$cantidadRecibe=$myrow17['cantidadRecibida'];

if(!$myrow17['banderaEnvio']){

$codec=$myrow17['codigo'];
$sSQL3= "Select * From OC WHERE entidad='".$entidad."' AND id_requisicion = '".$nRequisicion."' and statusCompras='comprar'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

if($myrow17['cantidadComprar'] ==$myrow17['cantidadRecibida']){
$q1 = "UPDATE listaOC set 
status='surtido'
WHERE nRequisicion = '".$nRequisicion."'
";
//mysql_db_query($basedatos,$q1);
}


if($cantidadRecibida[$i] ){



$q1 = "UPDATE OC set 
cantidadRecibida='".$cantidadRecibida[$i]."',
existenciaTemporal='".$cantidadRecibida[$i]."',
cantidadFacturada='".$cantidadFacturada[$i]."',

obsequio='".$obsequio[$i]."'
WHERE keyR = '".$keyR[$i]."'
";
mysql_db_query($basedatos,$q1);






//*************Actualizo Precios
$sSQL17= "Select * From precioArticulos WHERE entidad='".$entidad."' AND codigo= '".$code1[$i]."' ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

if($myrow17['codigo'] ){

 $q1 = "UPDATE precioArticulos set 
costo='".$cost[$i]."',
usuario='".$usuario."',
fecha='".$fecha1."'
WHERE 
entidad='".$entidad."' AND
codigo = '".$code1[$i]."'
";
mysql_db_query($basedatos,$q1);
} else {

$agregaSaldo = "INSERT INTO precioArticulos ( codigo,usuario,fecha,hora,ID_EJERCICIO,costo,entidad
) values ('".$code1[$i]."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cost[$i]."','".$entidad."')";
mysql_db_query($basedatos,$agregaSaldo);
}
$leyenda="";
//**********************************
} else {
//$leyenda="La cantidad que estás intentando actualizar es mayor a la cantidad requerida";
}
}

}//for
$_GET['existencias']=null;
}


if($_POST['quitar'] AND $_POST['remover']){
$codigo=$_POST['remover'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "DELETE From OC where entidad='".$entidad."' AND codigo='".$codigo[$i]."' and almacen ='".$_POST['almacen']."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();
}
}

$sSQL3= "Select * From listaOC WHERE entidad='".$entidad."' AND nRequisicion = '".$nRequisicion."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>


<?php


if($_GET['existencias']){
$cantidadRecibida=$_GET['cantidadRecibida'];
$cantidadFacturada=$_GET['cantidadFacturada'];
$obsequio=$_GET['obsequio'];

$code1=$_GET['codigoAlfa'];
$keyR=$_GET['keyR'];
$cost=$_GET['cost'];
for($i=0;$i<=$_GET['pasoBandera'];$i++){
$sSQL17= "Select * From OC WHERE  keyR = '".$keyR[$i]."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

if($myrow17['existenciaTemporal']){
$sSQL8= "Select * From existencias WHERE entidad='".$entidad."' AND codigo= '".$code1."' and almacen='HALM'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if($myrow8['codigo']){
$q4 = "UPDATE existencias set 
existencia=existencia+'".$cantidadRecibida[$i]."'+'".$obsequio[$i]."',
usuario='".$usuario."',
fechaA='".$fecha1."',
hora='".$hora1."',
ID_EJERCICIO='".$ID_EJERCICIOM."'
WHERE 
entidad='".$entidad."' AND
codigo = '".$code1[$i]."'
and
almacen='HALM'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

} else {
$suma=$cantidadRecibida[$i]+$obsequio[$i];
$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,existencia,entidad
) values (
'".$code1[$i]."',
'HALM',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."',
'".$suma."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

}
$q1 = "UPDATE OC set 
existenciaTemporal='0',
banderaEnvio='enviado',
statusCompras='facturado'
WHERE entidad='".$entidad."' AND id_requisicion = '".$nRequisicion."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$q1 = "UPDATE listaOC set 

status='facturado'
WHERE entidad='".$entidad."' AND nRequisicion = '".$nRequisicion."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
echo '<script type="text/vbscript">
msgbox "SE AGREGARON EXISTENCIAS!!"
</script>';
$_GET['existencias']="";
}

?>

<?php


if($_GET['cxp']){
$_GET['cxp']="";
}
?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

</head>
      <?php
$cmdstr3 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."'";
$parsed3 = ociparse($db_conn, $cmdstr3);
ociexecute($parsed3);	 
$nrows3 = ocifetchstatement($parsed3,$resulta3);
for ($i = 0; $i < $nrows3; $i++ ){
$nombre = $resulta3['NOMBRE'][$i];
$apaterno= $resulta3['AP_PATERNO'][$i];
}


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$nRequisicion."' 

";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
$id_proveedor=$myrow18['id_proveedor'];
$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
?>
<h1 align="center">Recepci&oacute;n OC <span class="style13"><strong><?php echo $nRequisicion;?></strong></span></h1>
<form id="form1" name="form1" method="GET" action="recepcionArticulos1.php">
  <table width="382" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="style7">
    <tr bgcolor="#FFFF99">
      <th width="121" scope="col"><div align="left" class="style13">Proveedor</div></th>
      <th width="243" scope="col"><div align="left" class="style13"><?php echo $myrow17['razonSocial'];?></div></th>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style13">Usuario Responsable:</div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $usuario.":".$nombre." ".$apaterno; ?></div></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td><div align="left" class="style13">Fecha:</div></td>
      <td><div align="left" class="style13"><?php echo $fecha1;?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style13">Hora:</div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $hora1;?></div></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td># Factura: </td>
      <td><label>
        <input name="id_factura" type="text" class="style7" id="id_factura" size="10" 
		value="<?php 
		if($myrow3['id_factura']){
		echo $myrow3['id_factura'];
		} else {
		echo "0";
		}
		?>"
		/>
      </label></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF">Remisi&oacute;n:</td>
      <td bgcolor="#FFFFFF"><input name="remision" type="text" class="style7" id="remision" size="10" 
		value="<?php 
		if(is_numeric($myrow3['remision'])){
		echo $myrow3['remision'];
		} else {
		echo "0";
		}
		?>"></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td height="20"># Nota de Cr&eacute;dito: </td>
      <td><div align="left" class="style7">
        <input name="notaCredito" type="text" class="style7" id="notaCredito" value="<?php echo $myrow3['notaCredito'];?>" size="10" />
      </div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF">IVA</td>
      <td bgcolor="#FFFFFF"><input name="ivaFactura" type="text" class="style7" id="ivaFactura" value="<?php echo $myrow3['ivaFactura'];?>" size="10" /></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td height="20">Importe de Factura: </td>
      <td><input name="importeFactura" type="text" class="style7" id="importeFactura" value="<?php echo $myrow3['importeFactura'];?>" size="10" /></td>
    </tr>
    <tr>
      <td height="20">Fecha de Factura </td>
      <td><div align="left" class="style7"><span class="Estilo24">
        <input name="fechaFactura" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php echo $myrow3['fechaFactura'];?>" size="10" readonly="" />
        <label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
        </label>
      </span></div>      </td>
    </tr>
  </table>
  <p align="center" class="style14">&nbsp;</p>
  <table width="821" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th colspan="4" scope="col"><span class="style11">Orden de Compra</span></th>
      <th scope="col">&nbsp;</th>
      <th colspan="8" scope="col"><span class="style11">Facturado</span></th>
    </tr>
    <tr>
      <th width="37" bgcolor="#FFFFFF" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="331" bgcolor="#FFFFFF" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="36" bgcolor="#FFFFFF" scope="col"><span class="style11">UM</span></th>
      <th width="40" bgcolor="#FFFFFF" scope="col"><span class="style11">C.Sol. </span></th>
      <th width="50" bgcolor="#FFFFFF" scope="col"><span class="style17"></span></th>
      <th width="25" bgcolor="#FFFFFF" scope="col"><span class="style11">C.Fac</span></th>
      <th width="25" bgcolor="#FFFFFF" scope="col"><span class="style11">C.Rec</span></th>
      <th width="31" bgcolor="#FFFFFF" scope="col"><span class="style11"> Faltan </span></th>
      <th width="40" bgcolor="#FFFFFF" scope="col"><span class="style11">Iva</span></th>
      <th width="38" bgcolor="#FFFFFF" scope="col"><span class="style11">Costo</span></th>
      <th width="46" bgcolor="#FFFFFF" scope="col"><span class="style11">T. Fact</span></th>
      <th width="47" bgcolor="#FFFFFF" scope="col"><span class="style11">NC </span></th>
      <th width="21" bgcolor="#FFFFFF" scope="col"><span class="style11">Obs.</span></th>
    </tr>
    <tr>
<?php	


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$nRequisicion."' and
statusCompras='comprar'
order by fechaCompras ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$cantidadComprar=$myrow18['cantidadComprar'];
$cantidadRecibida=$myrow18['cantidadRecibida'];
$b+='1';
$a+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


if($cantidadComprar==$cantidadRecibida){
$color = '#66FF00';
$col = "";
}
$code1=$myrow18['codigo'];
$keyR=$myrow18['keyR'];
$descripcion=descripcion($code=$code1,$basedatos);
$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE entidad='".$entidad."' AND codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL8= "Select * From existencias WHERE entidad='".$entidad."' AND codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

$sSQL12= "Select * From listaOC WHERE entidad='".$entidad."' AND nRequisicion= '".$nRequisicion."' ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12); 

$sSQL2= "Select * From precioArticulos WHERE entidad='".$entidad."' AND codigo= '".$code1."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); 
$sumaCosto[0]+=$myrow2['costo'];
$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow2['costo'],$basedatos);
$flagCR=$myrow18['cantidadRecibida'];
$tb=$myrow18['banderaEnvio'];
	   $t=$myrow18['cantidadFacturada']-$myrow18['cantidadRecibida']; 
	  ?>
      <td height="26" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow7['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7">
        <?php 
	  if($myrow18['cantidadComprar']){
	  echo $myrow18['cantidadComprar'];
	  } else {
	  echo "--";
	  }
	 
		?>
	
	  </span></label></td>
      <td bgcolor="#FFFFFF" class="style18">&nbsp;</td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="Estilo24">
        <input name="cantidadFacturada[]" type="text" class="style7" id="cantidadFacturada[]"  size="3"
		 value="<?php echo $myrow18['cantidadFacturada']; ?>"  <?php
	 
	  if($tb!=null  ){
	  echo 'disabled="disabled"';
	  }
	  ?>>
	  
	  <?php  $subt1=$myrow18['cantidadFacturada']*$myrow2['costo'];
	  $subt[0]=$myrow18['cantidadFacturada']*$myrow2['costo'];
	  //$subt[0]+=$subt[0];
	  ?>
      </span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
	 
        <input name="cantidadRecibida[]" type="text" class="style7" id="cantidadRecibida[]"  size="3"
		 value="<?php echo $myrow18['cantidadRecibida']; ?>"  <?php
	 
	  if($tb!=null ){
	  echo 'disabled="disabled"';
	  }
	  ?>
		/>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7">
	  <?php
	 $banderaT[0]+=$t;
	  if($t ){
	  echo $t;
	  } else if($t=='0'){
	  echo "0";
	  } else {
	  echo "Surtido";
	  }
	  
	  ?></span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php
		$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow18['cantidadFacturada'],$basedatos);
 echo "$".number_format($myrow18['cantidadFacturada']*$iva,2);
 $sumaIVA[0]+=$myrow18['cantidadFacturada']*$iva;

//	
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <input name="keyR[]" type="hidden" id="keyR[]" value="<?php echo $myrow18['keyR']; ?>" />
        <input name="cost[]" type="text" class="style7" id="cost[]" size="6" value="<?php echo $myrow2['costo']; ?>"
		<?php
	 
	  if($tb!=null){
	  echo 'disabled="disabled"';
	  }
	  ?>/>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <?php 
$subTotal[0]=$subt[0];
			echo "$".number_format($subTotal[0],2);

	  $subtotal[0]+=$subTotal[0];
	  
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
      <?php 
$notaCredito[0]=$t*$myrow2['costo'];

		
		$gpoProducto=gpoProducto($code1,$basedatos);
$ivas=iva($gpoProducto,$notaCredito[0],$basedatos);
$totalNC[0]=$notaCredito[0]+$ivas;
	  	echo "$".number_format($totalNC[0],2);
	  $totalNC1[0]+=$totalNC[0];
	  if($iva){ echo " c/ Iva";}?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <input name="obsequio[]2" type="text" class="style7" id="obsequio[]2"  size="3"
		 value="<?php echo $myrow18['obsequio']; ?>"  <?php
	 
	  if($tb!=null){
	  echo 'disabled="disabled"';
	  }
	  ?> />
      </span></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <div align="center">
    <p>&nbsp;</p>
    <table width="299" border="0" align="center" class="style7">
      <tr bgcolor="#FFFF00">
        <th width="82" class="style7" scope="col"><div align="center" class="style16 style19">Subtotal</div></th>
        <th width="74" class="style7" scope="col"><div align="center" class="style20">IVA</div></th>
        <th width="68" class="style7" scope="col"><div align="center" class="style20"><strong>Total</strong></div></th>
        <th width="57" class="style7" scope="col"><div align="center" class="style20"><strong>N. C </strong></div></th>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><span class="Estilo24">
          <?php 

			echo "$".number_format($subtotal[0],2);

	  
	  
	  ?>
        </span></div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center">
          <?php 
		

			echo "$".number_format($sumaIVA[0],2);

	  
	  
	  ?>
        </div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><strong>
          <?php 
$Total=$subtotal[0]+$sumaIVA[0];
			echo "$".number_format($Total,2);

	  
	  
	  ?>
        </strong></div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><?php echo $TOTAL= "$".number_format($totalNC1[0],2);?>&nbsp;</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
      </tr>
    </table>
  </div>
  <p align="center">
    <label>
    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="nRequisicion" type="hidden" id="nRequisicion" value="<?php echo $nRequisicion; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <table width="200" border="0" align="center">
    <tr>
      <th class="style7" scope="col"><div align="left"><span class="Estilo24"> </span> <span class="style21">Diferencia en Importe Total: </span></div></th>
      <th class="style7" scope="col"><div align="left">
        <?php 
  $banderaFactura=$myrow3['importeFactura']-$Total;
  echo "$".number_format($myrow3['importeFactura']-$Total,2);?>
      </div></th>
    </tr>
    <tr>
      <td class="style7"><div align="left"><strong><span class="style21">Diferencia en IVA: </span></strong></div></td>
      <td class="style7"><div align="left"><strong>
        <?php 
  $banderaIVA=$myrow3['ivaFactura']-$sumaIVA[0];
  echo "$".number_format($myrow3['ivaFactura']-$sumaIVA[0],2);?>
      </strong></div></td>
    </tr>
    <tr>
      <td class="style7"><div align="left"></div></td>
      <td class="style7"><div align="left"></div></td>
    </tr>
  </table>
  <p align="center"><label></label></p>
  <table width="200" border="0" align="center">
    <tr>
      <th scope="col">
	  
	  <input name="actualizar" type="submit" class="style7" id="actualizar" value="Actualizar Cambios" 
	  <?php 
	
	if($myrow12['nRequisicion']){
//echo "Cantidad a 0";
	} else {
		echo 'disabled="disabled"';
	}
	?>
	  /></th>
      <th scope="col"><input name="existencias" type="submit" class="style7" id="existencias" value="Enviar Existencias a CENDIS"
	<?php 
	
	if(($banderaFactura =='0' and $banderaIVA=='0') and !$tb and $myrow3['id_factura'] and $flagCR ){
//echo "Cantidad a 0";
	} else {
		echo 'disabled="disabled"';
	}
	?> onClick="if(confirm('Esta seguro de enviar al cendis estos artículos? La operación es irreversible...') == false){return false;}"></th>
<?php //echo $banderaFactura." ".$banderaIVA." ".$tb." ".$myrow3['id_factura']." ".$flagCR.'<br>';?>
      <th scope="col">
	  
	  <input name="cxp" type="submit" class="style7" id="cxp" value="Generar CxP"   <?php 
	if($tb=="enviado" and $myrow3['notaCredito']!='0' and ($banderaFactura =='0' and $banderaIVA=='0')){
	
	} else {
	echo " ".'disabled="disabled"';
	}
	?> onClick="if(confirm('Esta seguro de enviar a CXP esta factura?') == false){return false;}"></th>
    </tr>
  </table>
  <p align="center"><label></label>
  </p>
  <p align="center"><a href="javascript:ventanaSecundaria('notaCredito.php?id_proveedor=<?php echo $id_proveedor; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
  <p align="center"><a href="javascript:ventanaSecundaria('notaCredito.php?id_proveedor=<?php echo $id_proveedor; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
</form>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>