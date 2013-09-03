<?php include("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>






<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select numFactura From facturasAplicadas WHERE numFactura = '".$_POST['folioFactura']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
?>






<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>






<?php //************************ACTUALIZO **********************
//********************Llenado de datos


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************
?>












<?php //FACTURAR DEFINITIVO
if($_POST['aplicarFactura'] and $_POST['folioFactura'] and $_GET['folioVenta']){


$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

$sqld = "UPDATE facturasAplicadas set 
numFactura='".$_POST['folioFactura']."',
status='facturado'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();

$sql = "UPDATE cargosCuentaPaciente set 
statusFactura='facturado',
folioFactura='".$_POST['folioFactura']."'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

$sqlci = "UPDATE clientesInternos set 
statusFactura='facturado'
where
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$sqlci);
echo mysql_error();
?>
<script>
javascript:ventanaSecundaria5('/sima/cargos/printDetailsGroupFGxE.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 

javascript:ventanaSecundaria2('/sima/cargos/printDetailsInvoiceFGxE.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $$myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 


</script>






<?php 
echo 'se actualizaron datos';
}
?>



















<?php
if($_POST['previzualizar'] and $_POST['folioFactura'] and $_GET['folioVenta']){


$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

$sqld = "UPDATE facturasAplicadas set 
numFactura='".$_POST['folioFactura']."',
status='standby'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();


?>
<script>
javascript:ventanaSecundaria5('/sima/cargos/printDetailsGroupFGxE.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 

javascript:ventanaSecundaria2('/sima/cargos/printDetailsInvoiceFGxE.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $$myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 


</script>






<?php 
echo 'se actualizaron datos';
}
?>











<?php
if($_POST['quitars'] and $_POST['extension']>0){
 $sqld = "DELETE FROM facturasAplicadas 
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>';
echo 'window.alert("Extension eliminada");';
echo '</script>';
}
?>










<?php if($_POST['total'] and $_POST['importe'] and $_POST['asignar']){

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

//*********************INSERT OR UPDATE

if($_POST['gpoProducto']){

$sSQL3ad= "Select sum(importe) as io From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' and gpoProducto='".$_POST['gpoProducto']."' and status='extension'";
$result3ad=mysql_db_query($basedatos,$sSQL3ad);
$myrow3ad = mysql_fetch_array($result3ad);

$sSQL7="SELECT sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto='".$_POST['gpoProducto']."'
and
naturaleza='C'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto='".$_POST['gpoProducto']."'
and
naturaleza='A'";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);

$cargos=($myrow7['efectivos']-$myrow7d['efectivos'])+($myrow7['ivar']-$myrow7d['ivar']);
$diff=$cargos-$myrow3ad['io'];


}else{


$iva=new acumulados();
$ivaD=new acumulados();
$iva=$iva->ivaAcumulado($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos'])-$ivaD->ivaAcumuladoD($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);
	
		//echo "$".number_format($iva,2);

		$coaseguroN=new acumulados();
		$coa=$coaseguroN->cargosCoaseguroN($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);	
		$totalAcumulado=new acumulados();
		$totalDevoluciones=new acumulados();


$cargos=(($totalAcumulado->totalAcumulado($basedatos,$usuario,$myrow3['keyClientesInternos'])-$totalDevoluciones->dev($entidad,$basedatos,		$usuario,$_GET['folioVenta']))+$iva);

$sSQL3ad= "Select sum(importe) as io From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' and status='extension'";
$result3ad=mysql_db_query($basedatos,$sSQL3ad);
$myrow3ad = mysql_fetch_array($result3ad);
$diff=$cargos-$myrow3ad['io'];


}


$porcentajeFacturacion=$_POST['importe']/$cargos;
//echo $_POST['importe'].' '.$diff;

if($diff>=$_POST['importe']){

$sSQL3a= "Select * From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='".$_POST['extension']."'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);







if($myrow3a['folioVenta']){
 $sqld = "UPDATE facturasAplicadas set 
status='extension',
gpoProducto='".$_POST['gpoProducto']."',
importe='".$_POST['importe']."',
porcentajeFacturacion='".$_POST['importe']/$_POST['total']."'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
$leyenda= 'Se actualizo la extension';

$sqldd = "UPDATE clientesInternos set 

statusFactura='extension'
where
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$sqldd);
echo mysql_error();
}else{
 $sqld = "INSERT INTO facturasAplicadas 
(entidad, 	numFactura ,	nT, 	usuario, 	fecha, 	hora, 	keyMov, 	keyCF, 	importe, 	seguro, 	folioVenta, 	status, 	porcentajeFacturacion, 	extension, 	RFC, gpoProducto)
values
('".$entidad."',0,0,'".$usuario."','".$fecha1."','".$hora1."',0,0,'".$_POST['importe']."','".$myrow3['seguro']."','".$_GET['folioVenta']."','extension','".$porcentajeFacturacion."','".$_POST['extension']."',0,'".$_POST['gpoProducto']."')";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
$leyenda= 'Se agregaron $'.$_POST['importe'].' a la extension';

 $sqld = "UPDATE clientesInternos set 

statusFactura='extension'
where
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
}


}else{
echo '<script>';
echo 'window.alert("NO SE PUEDE FACTURAR POR ESA CANTIDAD, DEBE SER MENOR");';
echo '</script>';

}//es mayor compara 


}//cierra funcion


?>





<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  


  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
    
    
</head>



<BODY  >
<?php 
$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<h1 align="center" class="titulos">Facturaci&oacute;n por Extensiones</h1>
<p align="center" class="negro">
<?php echo '<blink>'.$leyenda.'</blink>';?>
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left">Folio de Venta</div></th>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left">
        <label>
      <?php print $_GET['folioVenta'];?>
        </label>
        </label>
      </div>      </th>
    </tr>
    
    
    

    <tr>
      <th width="168" bgcolor="#330099" class="normal" scope="col"><div align="left" class="blancomid"><strong>Paciente</strong></div></th>
      <th width="407" bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Compa&ntilde;&iacute;a</td>
<td bgcolor="#FFFFFF" class="normalmid"><label> 
        <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">N&deg; Credencial</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left"><strong>M&eacute;dico</strong></div></th>
      <th bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left">
          <label></label>
          
          <?php 
$sSQL18= "Select descripcion From almacenes WHERE almacen='".$myrow3['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".$rNombre18['descripcion'];?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Fecha Internamiento</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print cambia_a_normal($myrow3['fecha']);?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Dx Entrada</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print $myrow3['dx'];?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Seguro</td>
      <td bgcolor="#FFFFFF" class="normalmid"><label><?php print $myrow3['seguro'];?></label></td>
    </tr>
  </table>
  <p align="center">Extensi&oacute;n
    <select name="extension" id="extension" onChange="this.form.submit();">
      <option
      <?php if($_POST['extension']=='0')print 'selected="selected"';?>
       value="0">0</option>
      <option
      <?php if($_POST['extension']=='1')print 'selected="selected"';?>
       value="1">1</option>
      <option
      <?php if($_POST['extension']=='2')print 'selected="selected"';?>
       value="2">2</option>
      <option
      <?php if($_POST['extension']=='3')print 'selected="selected"';?>
       value="3">3</option>
      <option
      <?php if($_POST['extension']=='4')print 'selected="selected"';?>
       value="4">4</option>
      <option
      <?php if($_POST['extension']=='5')print 'selected="selected"';?>
       value="5">5</option>
      <option
      <?php if($_POST['extension']=='6')print 'selected="selected"';?>
       value="6">6</option>
      <option
      <?php if($_POST['extension']=='7')print 'selected="selected"';?>
       value="7">7</option>
    </select>
  <a href="javascript:ventanaSecundaria5('ventanaAjustarExtensiones.php?entidad=<?php echo $entidad;?>&extension=<?php echo $_POST['extension'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');"></a></p>

<?php 

$iva=new acumulados();
$ivaD=new acumulados();
$iva=$iva->ivaAcumulado($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos'])-$ivaD->ivaAcumuladoD($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);
	
		//echo "$".number_format($iva,2);

		$coaseguroN=new acumulados();
		$coa=$coaseguroN->cargosCoaseguroN($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);	
		$totalAcumulado=new acumulados();
		$totalDevoluciones=new acumulados();


$cargos=(($totalAcumulado->totalAcumulado($basedatos,$usuario,$myrow3['keyClientesInternos'])-$totalDevoluciones->dev($entidad,$basedatos,		$usuario,$_GET['folioVenta']))+$iva);

?>



<?php if($_POST['extension']==0){ ?>
<p align="center">

  
  </p>
<table width="440" height="53" border="1" align="center" bordercolor="#FF0000">
    <tr bgcolor="#330099">
      <th width="142" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Ext</div>
      </div></th>

      <th width="297" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
        <div align="left">Grupo</div>
      </div></th>
      <th width="114" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Importe</div>
      </div></th>
    </tr>
    
       
      
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">0</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  ---
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 
		

		

		echo "$".number_format($cargos,2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">1</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  <?php
$sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='1'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);	  

if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>      
      <td bgcolor="<?php echo $color;?>" class="normalmid">
<?php 
echo "$".number_format($myrow3ab['imp'],2);?>	      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">2</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='2'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);


if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">3</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	 <?php
	 $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='3'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	 ?>      
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">4</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">    
	  <?php
	  
	  $sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='4'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);


if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
?>  
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">5</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">      
	  <?php
	  
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='5'";
	  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
	  $myrow3ab = mysql_fetch_array($result3ab);
	  
	  
	  if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">6</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">    
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='6'";
	  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
	  $myrow3ab = mysql_fetch_array($result3ab);
	  
if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 

echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">7</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">      
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='7'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);
	  
if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos">&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="right">Disponible:
      </div>
      <td bgcolor="<?php echo $color;?>" class="normalmid"><span class="codigos">
        <?php 

$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

echo "$".number_format($cargos-$myrow3ab['imp'],2);?>
    </span>    </tr>
  </table>

<p>
  <?php } else{?>
</p>


    <?php 

$sSQL3abf= "Select gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' and extension='".$_POST['extension']."' ";
$result3abf=mysql_db_query($basedatos,$sSQL3abf);
$myrow3abf = mysql_fetch_array($result3abf);

 $sSQL1= "Select * From gpoProductos where entidad='".$entidad."' AND activo='activo'
ORDER BY descripcionGP ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 
?>
    <select name="gpoProducto" class="Estilo24" id="gpoProducto" onChange="this.form.submit();" />


    <option value="">Facturar Total</option>
    <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
    <option
	<?php if(($myrow3abf['gpoProducto'] ==$myrow1['codigoGP']) or ($_POST['gpoProducto']==$myrow1['codigoGP'] )){ echo 'selected=""';}?>
	 value="<?php echo $myrow1['codigoGP']; ?>"> <?php echo $myrow1['descripcionGP']." || ".$myrow1['codigoGP']; ?> </option>
    <?php } 
		
		?>
    </select>


<p align="center">Disponible: 		
<?php 




if($_POST['gpoProducto']){

$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and gpoProducto='".$_POST['gpoProducto']."'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

$sSQL7="SELECT sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto='".$_POST['gpoProducto']."'
and
naturaleza='C'
";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto='".$_POST['gpoProducto']."'
and
naturaleza='A'
";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);

$cargos=($myrow7['efectivos']-$myrow7d['efectivos'])+($myrow7['ivar']-$myrow7d['ivar']);
$b=$cargos-$myrow3ab['imp'];
echo "$".number_format(($myrow7['efectivos']-$myrow7d['efectivos'])+($myrow7['ivar']-$myrow7d['ivar']),2);



} else {



$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);
$b=$cargos-$myrow3ab['imp'];

echo "$".number_format($cargos-$myrow3ab['imp'],2);
}
?>
</p>
<p align="center">Cantidad para esta extensi&oacute;n: 
    <label>
<?php
if($_POST['gpoProducto']){
$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and gpoProducto='".$_POST['gpoProducto']."' and extension='".$_POST['extension']."'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);
}else{	
$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='".$_POST['extension']."'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);
}
?>
    <input name="importe" type="text" id="importe" value="<?php echo number_format($myrow3ab['imp'],2);?>" <?php if($b==0){ echo 'readonly=""';}?> />
    </label>
  (incluye iva) </p>
  <p align="center">
    <label></label>
    <input type="submit" name="asignar" id="asignar" value="Asignar a Extension"/>
    <input type="submit" name="quitars" id="quitars" value="Quitar Extension" <?php if($myrow3ab['imp']==0){ echo 'disabled=""';}?>/>
  </p>
  
<?php } ?>



  <p align="center"><input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />
    <input name="total" type="hidden" id="porcentaje" value="<?php echo $cargos; ?>" />
  </p>
</form>

<p align="center">
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
      <script>
		new Autocomplete("razonSocial", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/rfcx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>



