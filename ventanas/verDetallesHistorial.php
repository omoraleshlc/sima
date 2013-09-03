<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");
$cargosCia=new acumulados();?>





<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>








<?php //************************ACTUALIZO **********************
//Llenado de datos

$sSQL3= "Select * From historialHeading WHERE 
entidad='".$entidad."'
    and
folioVenta = '".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'
";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************


?>



<?php 
$sSQL3ae= "
	SELECT 
imprimeTicket
FROM
almacenes
where
entidad='".$entidad."'
    and
almacen='".$_GET['almacenSolicitante']."'

";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);
?>




<?php if($_POST['imprimir']){ 



//********************verificar diferencia de centavos*************
$diferencia= number_format($_POST['totalAbono']-$_POST['totalCargo'],2);



if($diferencia>0){
$sSQL3c= "Select keyCAP,cantidadParticular,cantidadAseguradora,ivaParticular,ivaAseguradora From historialCuentas WHERE 
entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
    and
    numSolicitud='".$_GET['numSolicitud']."'
and
gpoProducto=''
and
naturaleza='A' order by keyCAP DESC

 ";
$result3c=mysql_db_query($basedatos,$sSQL3c);
$myrow3c = mysql_fetch_array($result3c);

if($myrow3c['cantidadParticular']>0){

$agrega4 = "UPDATE historialCuentas set 
cantidadParticular=cantidadParticular-'".$diferencia."',
precioVenta=cantidadParticular+cantidadAseguradora
where
keyCAP='".$myrow3c['keyCAP']."' ";
mysql_db_query($basedatos,$agrega4);
echo mysql_error();

}else if($myrow3c['cantidadAseguradora']>0){
$agrega4 = "UPDATE historialCuentas set 
cantidadAseguradora=cantidadAseguradora-'".$diferencia."',
precioVenta=cantidadParticular+cantidadAseguradora
where
keyCAP='".$myrow3c['keyCAP']."' and
numSolicitud='".$_GET['numSolicitud']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();

}
}
//*******************************************





//********************TODOS SUS MOVIMIENTOS DEBEN ESTAR PAGADOS***********************
$agrega4 = "UPDATE historialHeading set 
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' and
numSolicitud='".$_GET['numSolicitud']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();





if($myrow3['tipoPaciente']=='externo'){
$qd = "UPDATE transacciones
set
status='done'
where

status='standby'
and
usuario='".$usuario."' 
 ";

mysql_db_query($basedatos,$qd);
echo mysql_error();
}

//**************************cierro 

?>
<?php if($_GET['paquete']=='si'){ ?>
<script language="javascript">
nueva('/sima/cargos/imprimirReciboPaquetes.php?numeroE=<?php echo $myrow3['numeroE']; ?>&nCuenta=<?php echo $myrow3['nCuenta']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $myrow3['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $_POST['cantidadRecibida'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&fechaSolicitud=<?php print $_POST['variable_php'];?>','ventana7','800','600','yes');
window.opener.document.form10["form10"].submit();
//window.alert("sandra");
window.close();
</script>
<?php } else { ?>







<?php if($myrow3ae['imprimeTicket']=='si'){?>
<script>
nueva('imprimeTicket.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');
window.opener.document.form10["form"].submit();
	
window.close();
</script>
    <?php }else{ ?>
<script>
nueva('imprimirEstadoCuenta.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');
window.opener.document.form10["form"].submit();
	
window.close();
</script>


<?php 
    }
?>
    
    
    <?php }?>

<?php } ?>









<?php  
$sSQL3= "Select * From historialHeading WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and
numSolicitud='".$_GET['numSolicitud']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***************aplicar pago**********************  

if($myrow3['statusCuenta']=='cerrada' and $myrow3['status']=='cerrada'){ 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";

$agrega5 = "UPDATE porcentajeBeneficencias set
status='cargado'
where
entidad='".$entidad."'
and
numeroE='".$myrow3['numeroE']."'
and
status='standby'
and
departamento='".$myrow3['almacen']."'
";

mysql_db_query($basedatos,$agrega5);
echo mysql_error();
  ?>


<input name="print" type="button" class="normal" id="print" value="Imprimir EC" onClick="nueva('imprimirEstadoCuenta.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');">

 
   
   <?php 
    } else{
  ?>



<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
    <html>
<head>

</head>


<title></title>
<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>
  <style type="text/css">
    .popup_effect1 {
      background:#11455A;
      opacity: 0.2;
    }
    .popup_effect2 {
      background:#FF0041;
      border: 3px dashed #000;
    }
    
  </style>	
  
  <script languaje="JavaScript">
            
var reloj=new Date(); 

          varjs=  reloj.getHours()+":"+reloj.getMinutes(); 

</script>



<form id="form1" name="form1" method="post" >
    <?php 
   
    //require('/configuracion/clases/encabezado.php');
    //ABRE ENCABEZADO
    ?>

<?php if(!$folioVenta){
$folioVenta=$_GET['folioVenta'];
}
?>

<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>
	
  
  <script languaje="JavaScript">
            
var reloj=new Date(); 

          varjs=  reloj.getHours()+":"+reloj.getMinutes(); 

</script>



<form id="form1" name="form1" method="post" action="#">
<?php 


$sSQL= "SELECT *
FROM
historialHeading 
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
numSolicitud='".$_GET['numSolicitud']."'
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


$entidad=$myrow['entidad'];
$keyClientesInternos=$myrow['keyClientesInternos'];
$folioVENTA=$myrow['folioVenta'];
$tipoPACIENTE=$myrow['tipoPaciente'];
$limiteSEGURO=$myrow['limiteSeguro'];
$SEGURO=$myrow['seguro'];

?>

<h1>ESTADO DE CUENTA</h1>
<h2>Fecha: <?php echo cambia_a_normal($myrow['fecha']);?>, Solicitud: <?php echo $_GET['numSolicitud'];?></h2>
  <table width="993" style="border: 1px solid #CCC;">

    <tr >
      <td width="124" align="left" ><b>FOLIO N&deg;</b></td>
      <td width="655" align="center" > <b>PACIENTE: <span class="titulomedio"><?php echo $myrow['paciente']; ?></span></b></td>
      <td width="200" align="left" ><b>DEPTO - CUARTO</b></td>
    </tr>
	
	<?php if($myrow['statusCortesia']=='si'){ ?>
    <tr>
      <td colspan="3" style="text-align: center"><span class="codigos" style="size:14"><blink>*****EL PACIENTE ES DE CORTESIA****</blink></span></td>
    </tr>
    <?php } ?>
	
	<tr>
      <td align="left" style="text-align: center"><span ><?php echo $myrow['folioVenta']; ?></span></td>
      <td ><span  style="text-align: left">Seguro: <span class="normalmid">
        <?php 
		
	$segur= $myrow['seguro'];
	
	if ($segur!='') {
	$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$segur."';
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?>
        - <?php echo $myrow['credencial']; ?></span></span></td>
      <td><span >
        <?php $id_almacen=$myrow['almacen']; 
	  $sSQL1= "SELECT almacen,descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$id_almacen."'
 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
	  ?>
        - <?php echo $myrow['cuarto']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >Fecha/Hora de Inter.: <span class="normalmid"><?php echo $myrow['fecha']." / ".$myrow['hora']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >M&eacute;dico de Inter.: <span class="normalmid">
        <?php 

	if ($myrow['medico']) {
	 $medico1=$myrow['medico'];
	$sSQL3= "SELECT nombre1,apellido1,apellido2
	FROM
	medicos 
	where
	entidad='".$entidad."'
	and
	numMedico='".$medico1."'";
	
	$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	 echo $myrow3['nombre1']." ".$myrow3['apellido1']." ".$myrow3['apellido2']; 
     }
     else{
		 echo $myrow['medicoForaneo'];    
	 }
?>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >Diagn&oacute;stico: <span class="normalmid"><?php echo $myrow['dx']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" ><span  style="text-align: left">Fecha/Hora de Alta: <span class="normalmid"><?php echo $myrow['fechaCierre']." / ".$myrow['horaCierre']; ?></span></span></td>
      <td>&nbsp;</td>
    </tr>
	
	<?php if($myrow['numeroFactura']){ ?>
    <tr>
      <td colspan="2" style="text-align: left" ><span  style="text-align: left">Numero Factura:  <span class="normalmid"><?php echo $myrow['numeroFactura']; ?></span></span></td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
  </table>
  <p align="center">
  <?php 
  
 	$sSQLnc= "SELECT *
	FROM
	historialHeading 
	where
	entidad='".$entidad."'
	and
	folioVenta='".$myrow['folioDevolucion']."' 
            and
            numSolicitud='".$_GET['numSolicitud']."'
and statusCuenta='cerrada' ";
	
	$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
//echo $myrow3i['folioVenta'];
    ?>
	
	
	<?php if($myrownc['folioVenta']){ ?>
<h1 align="center" class="titulos"> 
   <a href="javascript:nueva('/sima/cargos/despliegaCargos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow['folioDevolucion'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucion';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;devolucion=<?php echo $_GET['devolucion'];?>&tipoPago=Efectivo','ventana7','800','600','yes');">
NOTA DE CREDITO
</a>
<?php } ?>
	
  </p>

    
<?php
//CIERRA ENCABEZADO
?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    

  <?php 
  //require('/configuracion/clases/operacionesGlobales.php');
  
  ?>
  
<?php 
//*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES CARGOS
if($myrow['naturaleza']=='C' and $myrow['statusDevolucion']=='si'){
$devolucionCargos[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}



//REGRESOS
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}
//*******************************************************************************







//CARGOS PARTICULARES 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}
//******************************************************************************************







//CARGOS ASEGURADORA
//ES BENEFICENCIA



// if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==NULL){//devolucion transacciones
// $abonosBeneficencia[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
// }elseif($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){//cargos al paciente
//  $devolucionBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);//devolucion articulos
// }else if($myrow['naturaleza']=='C' ){//cargos al paciente
// $cargosBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
// }else if($myrow['naturaleza']=='C' and $myrow['gpoProducto']==''){//cargos al paciente
// $pagoDevBeneficencia[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
// }
 

if($myrow['naturaleza']=='C' and $myrow['gpoProducto']!=''){//cargos al paciente
   $cargosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){//devolucion de cargo beneficencia
$devolucionBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['tipoTransaccion']=='DEVXB'){ 
$dtBeneficencia[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}






if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){//abonos
$abonosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}




//IVA
if($myrow['naturaleza']=='C'){
$ivaCargos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}elseif($myrow['naturaleza']=='A'){
$ivaAbonos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}
//******************************************************************************************
?>















<?php

//****************************COASEGURO / DEDUCIBLE **********************************


$s1= "Select codigoTT From catTTCaja WHERE  coaseguro1='si'  ";
$rs1=mysql_db_query($basedatos,$s1);
$my1 = mysql_fetch_array($rs1);

$s2= "Select codigoTT From catTTCaja WHERE  coaseguro2='si'  ";
$rs2=mysql_db_query($basedatos,$s2);
$my2 = mysql_fetch_array($rs2);

$s3= "Select codigoTT From catTTCaja WHERE  deducible1='si'  ";
$rs3=mysql_db_query($basedatos,$s3);
$my3 = mysql_fetch_array($rs3);

$s4= "Select codigoTT From catTTCaja WHERE  deducible2='si'  ";
$rs4=mysql_db_query($basedatos,$s4);
$my4 = mysql_fetch_array($rs4);

$s5= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoParticulares='si'  ";
$rs5=mysql_db_query($basedatos,$s5);
$my5 = mysql_fetch_array($rs5);

$s5a= "Select codigoTT From catTTCaja WHERE  descuentoParticulares='si'  ";
$rs5a=mysql_db_query($basedatos,$s5a);
$my5a = mysql_fetch_array($rs5a);

$s6= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoAseguradoras='si'  ";
$rs6=mysql_db_query($basedatos,$s6);
$my6 = mysql_fetch_array($rs6);

$s6a= "Select codigoTT From catTTCaja WHERE  descuentoAseguradoras='si'  ";
$rs6a=mysql_db_query($basedatos,$s6a);
$my6a = mysql_fetch_array($rs6a);

$s7= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'  ";
$rs7=mysql_db_query($basedatos,$s7);
$my7 = mysql_fetch_array($rs7);
//*************************************************************************************



if($myrow['tipoTransaccion']==$my1['codigoTT']){ 
$coaseguro1=$my1['codigoTT'];
if($myrow['naturaleza']=='-'){ 
$totalCargoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my2['codigoTT']){
$coaseguro2=$my2['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 


if($myrow['tipoTransaccion']==$my3['codigoTT']){
$deducible1=$my3['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 

if($myrow['tipoTransaccion']==$my4['codigoTT']){
$deducible2=$my4['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}

//*******************CIERRO COASEGURO Y DEDUCIBLE


//****************APlicar descuentos**********
if($myrow['tipoTransaccion']==$my5['codigoTT'] || $myrow['tipoTransaccion']==$my5a['codigoTT']){ 
$descuentoParticular=$my5a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoParticularAplicado[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}else{
$descuentosParticulares[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my6['codigoTT'] || $myrow['tipoTransaccion']==$my6a['codigoTT']){
$descuentoAseguradora=$my6a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoAseguradoraAplicado[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}else{
$descuentosAseguradoras[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}
}



if($myrow['tipoTransaccion']==$my7['codigoTT'] || $myrow['tipoTransaccion']==$my7a['codigoTT']){
$transB=$my7['codigoTT'];
}
//*********************************************
?>  
    
  <?php
  //CIERRA OPERACIONES GLOBALES
  ?>
    
    
    
    
    
    
    
    
    
    
  <?php 
  
  //require('/configuracion/clases/mostrarDatosCuenta.php');
  //MOSTRAR DATOS CUENTA
  ?>
  
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<div align="center">
<span >Opciones de Grupo de Producto: </br></span>
      <?php   $sSQL7= "Select gpoProducto From historialCuentas
          where entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
                 and
                 gpoProducto!=''
                 and
    numSolicitud='".$_GET['numSolicitud']."'
      group by gpoProducto";

$result7=mysql_db_query($basedatos,$sSQL7);
echo mysql_error();
	  ?>
          <select name="gpoProducto1"  id="gpoProducto1" onChange="this.form.submit();" >
		  <option value="">Todos</option>
            <?php
		   while($myrow7 = mysql_fetch_array($result7)){

                       $sSQL78="SELECT *
                            FROM
                                gpoProductos
                                WHERE
                                    entidad = '".$entidad."'
                                    and
                                codigoGP='".$myrow7['gpoProducto']."'
                                ";
                            $result78=mysql_db_query($basedatos,$sSQL78);
                            $myrow78 = mysql_fetch_array($result78);
                       ?>

            <option
		    <?php 		if($_POST['gpoProducto1']==$myrow7['gpoProducto'])echo 'selected'; ?>
		   value="<?php echo $myrow7['gpoProducto']; ?>"><?php echo $myrow78['descripcionGP'] ?></option>
            <?php }

		?>
          </select>
<p></p>
    <table width="817" class="table table-striped" style="border: 1px solid #CCC;">

    <tr >
      <th width="19"   scope="col"><div align="center">#</div></th>
      <th width= "56"   scope="col"><div align="center"># Reg</div></th>
      <th width= "45"   scope="col"><div align="center">Fecha</div></th>
      <th width= "23"   scope="col"><div align="center">C</div></th>
      <th width= "431"   scope="col"><div align="center">Descripcion</div></th>
      <th width= "52"   scope="col"><div align="center">Totales</div></th>
      <th width= "25"   scope="col"><div align="center">N</div></th>
      <th width= "59"   scope="col">Part</th>
      <th width= "59"   scope="col">Benef</th>
	  <th  width= "69"  scope="col"><div align="center">Aseg</div></th>
	  </tr>
    <tr>



<?php	

$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();

if ($_POST['gpoProducto1']==null){
 $sSQL= "SELECT *
FROM
historialCuentas
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
    numSolicitud='".$_GET['numSolicitud']."'

";}

else {
$sSQL= "SELECT *
FROM
historialCuentas
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    gpoProducto='".$_POST['gpoProducto1']."'
and
    numSolicitud='".$_GET['numSolicitud']."'

";
}


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}



//   
?>


 <tr  >
      <td height="24"  ><?php print $a;?></td>
      <td width="56"   align="center"><?php
	echo $myrow['keyCAP'];
	   ?></td>
      <td width="45"  ><?php
	echo cambia_a_normal($myrow['fecha1']);
	   ?></td>
      <td width="23"  ><div align="center">
        <?php
	echo round($myrow['cantidad'],3);
	//echo $myrow['cantidad'];
        ?>
      </div></td>
      <td width="431"  ><?php
		
		echo '<span >';
       echo $myrow['descripcionArticulo'];
	   echo '</span>';
	   if($myrow['tipoPaciente']!='externo'){
	   if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){
echo '</br><div >'.'Devolucion, folio: '.$myrow['folioDevolucion'].'</div>';

}
}

if($myrow['gpoProducto']!=''){
	   if($myrow['statusCargo']=='cargado' ){
echo '</br><div >'.'[ '.$myrow['statusCargo'].']'.' a las '.'[ '.$myrow['horaCargo'].']'.' </div>Solicitado por: '.'[ '.$myrow['usuario'].']';
	}else{
	echo '</br><div ><blink>'.'*************** FAVOR DE SURTIR ********'.'</blink></div>';
	}
	}else{
	echo '</br><div >'.'[ Transaccion]'.'</div>';
	}
	
			   $sSQL341c= "Select descripcionGP From gpoProductos WHERE  entidad='".$entidad."' and codigoGP='".$myrow['gpoProducto']."'";
$result341c=mysql_db_query($basedatos,$sSQL341c);
$myrow341c = mysql_fetch_array($result341c);   
echo '</br>';
	   echo '- '.$myrow341c['descripcionGP'].' -';
echo '</br>';	
	
if($myrow['statusDescuentoGlobal']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionDescuentoGlobal'].']'.'</span>';
}

if($myrow['facturacionEspecial']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionSeguroFacturacion'].']'.'</span>';
}



//***********************************ALMACENES**********************************
$sSQL341cs= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenSolicitante']."'";
$result341cs=mysql_db_query($basedatos,$sSQL341cs);
$myrow341cs = mysql_fetch_array($result341cs);  


$sSQL341ca= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenDestino']."'";
$result341ca=mysql_db_query($basedatos,$sSQL341ca);
$myrow341ca = mysql_fetch_array($result341ca);  

if($myrow['gpoProducto']!=''){
echo '</br><span >'.' ['.$myrow341cs['descripcion'].'  >  '.$myrow341ca['descripcion'].'] '.'</span>';
}
//********************************************************************************************



if($myrow['numRecibo']){ ?>
</br><span > Recibo: </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	
	

if($myrow['naturaleza']=='-'){ ?>
</br><span > Cancelar </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	



	
	
	
	
	
if($myrow['gpoProducto']!=''  and $usuario){
$sSQLa= "
SELECT *
FROM
reportesTemporales
WHERE 
entidad='".$entidad."' 
and
usuario='".$usuario."'  
and
codigoGP='".$myrow['gpoProducto']."'   ";
 
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);



  $agrega = "INSERT INTO reportesTemporales (
gpoProducto,importe,entidad,usuario,random,codigoGP,naturaleza,folioVenta
) values (
'".$myrow341c['descripcionGP']."',
'".$myrow['precioVenta']*$myrow['cantidad']."',
'".$entidad."','".$usuario."','".$random."','".$myrow['gpoProducto']."','".$myrow['naturaleza']."','".$_GET['folioVenta']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

}	
	   ?>



<?php if($myrow['naturaleza']=='-'){ ?>
</br><span > 
	  <a href="javascript:ventanaSecundaria10('/sima/cargos/ventanaEditar.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','500','200','yes');">
Editar</a>
<?php } ?>

</span>
	   <hr />
      </td>

      <td width="52"  ><div align="center">
<?php
echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);
?>
      </div></td>
      <td width="25"  ><div align="center">
        <?php
echo $myrow['naturaleza'];

?>
      </div></td>
      
      
      
      
      <td width="59"  ><div align="center">

  <span >
<?php

$triggerParticular=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?>
</span>
      </div></td>
      
      
           <td width="59"  ><div align="center">

  <span >
<?php

$triggerBeneficencia=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']),2);

?>
</span>
      </div></td> 
      
      
      
      

<td width="69"  ><div align="center">
  <span >
  <?php
$triggerAseguradora=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);  
  
echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
?>
</span>


</div></td>
</tr> 

<?php //require('/configuracion/clases/operacionesGlobales.php');
//ABRE OPERACIONES GLOBALES
?>


<?php 
//*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES CARGOS
if($myrow['naturaleza']=='C' and $myrow['statusDevolucion']=='si'){
$devolucionCargos[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}



//REGRESOS
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}
//*******************************************************************************







//CARGOS PARTICULARES 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}
//******************************************************************************************







//CARGOS ASEGURADORA
//ES BENEFICENCIA



// if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==NULL){//devolucion transacciones
// $abonosBeneficencia[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
// }elseif($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){//cargos al paciente
//  $devolucionBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);//devolucion articulos
// }else if($myrow['naturaleza']=='C' ){//cargos al paciente
// $cargosBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
// }else if($myrow['naturaleza']=='C' and $myrow['gpoProducto']==''){//cargos al paciente
// $pagoDevBeneficencia[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
// }
 

if($myrow['naturaleza']=='C' and $myrow['gpoProducto']!=''){//cargos al paciente
   $cargosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){//devolucion de cargo beneficencia
$devolucionBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['tipoTransaccion']=='DEVXB'){ 
$dtBeneficencia[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}






if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){//abonos
$abonosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}




//IVA
if($myrow['naturaleza']=='C'){
$ivaCargos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}elseif($myrow['naturaleza']=='A'){
$ivaAbonos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}
//******************************************************************************************
?>















<?php

//****************************COASEGURO / DEDUCIBLE **********************************


$s1= "Select codigoTT From catTTCaja WHERE  coaseguro1='si'  ";
$rs1=mysql_db_query($basedatos,$s1);
$my1 = mysql_fetch_array($rs1);

$s2= "Select codigoTT From catTTCaja WHERE  coaseguro2='si'  ";
$rs2=mysql_db_query($basedatos,$s2);
$my2 = mysql_fetch_array($rs2);

$s3= "Select codigoTT From catTTCaja WHERE  deducible1='si'  ";
$rs3=mysql_db_query($basedatos,$s3);
$my3 = mysql_fetch_array($rs3);

$s4= "Select codigoTT From catTTCaja WHERE  deducible2='si'  ";
$rs4=mysql_db_query($basedatos,$s4);
$my4 = mysql_fetch_array($rs4);

$s5= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoParticulares='si'  ";
$rs5=mysql_db_query($basedatos,$s5);
$my5 = mysql_fetch_array($rs5);

$s5a= "Select codigoTT From catTTCaja WHERE  descuentoParticulares='si'  ";
$rs5a=mysql_db_query($basedatos,$s5a);
$my5a = mysql_fetch_array($rs5a);

$s6= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoAseguradoras='si'  ";
$rs6=mysql_db_query($basedatos,$s6);
$my6 = mysql_fetch_array($rs6);

$s6a= "Select codigoTT From catTTCaja WHERE  descuentoAseguradoras='si'  ";
$rs6a=mysql_db_query($basedatos,$s6a);
$my6a = mysql_fetch_array($rs6a);

$s7= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'  ";
$rs7=mysql_db_query($basedatos,$s7);
$my7 = mysql_fetch_array($rs7);
//*************************************************************************************



if($myrow['tipoTransaccion']==$my1['codigoTT']){ 
$coaseguro1=$my1['codigoTT'];
if($myrow['naturaleza']=='-'){ 
$totalCargoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my2['codigoTT']){
$coaseguro2=$my2['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 


if($myrow['tipoTransaccion']==$my3['codigoTT']){
$deducible1=$my3['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 

if($myrow['tipoTransaccion']==$my4['codigoTT']){
$deducible2=$my4['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}

//*******************CIERRO COASEGURO Y DEDUCIBLE


//****************APlicar descuentos**********
if($myrow['tipoTransaccion']==$my5['codigoTT'] || $myrow['tipoTransaccion']==$my5a['codigoTT']){ 
$descuentoParticular=$my5a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoParticularAplicado[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}else{
$descuentosParticulares[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my6['codigoTT'] || $myrow['tipoTransaccion']==$my6a['codigoTT']){
$descuentoAseguradora=$my6a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoAseguradoraAplicado[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}else{
$descuentosAseguradoras[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}
}



if($myrow['tipoTransaccion']==$my7['codigoTT'] || $myrow['tipoTransaccion']==$my7a['codigoTT']){
$transB=$my7['codigoTT'];
}
//*********************************************
?>

<?php //CIERRA OPERACIONES GLOBALES=?>



    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
	</p>	
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>
 <?php 
 //require('/configuracion/clases/mostrarTotalesEC.php');
 
 //MOSTRAR TOTALES EC
 ?> 
      
      
      
<?php 
  //OPERACIONES GLOBALES


  $totalCargo=(float) ($cargo[0]-$devolucion[0]);
  $totalAbono=(float) ($abono[0]-$regreso[0]+$descuentos[0]);
  
  $totalParticular=(float) ($cargoParticular[0]-$abonoParticular[0])-($devolucionParticular[0]-$regresoParticular[0]);
   $totalBeneficencia=(float) ($cargosBeneficencia[0]-($abonosBeneficencia[0]-$dtBeneficencia[0]))-($devolucionBeneficencia[0]-$regresoBeneficencia[0]);
  $totalAseguradora=(float) ($cargoAseguradora[0]-$abonoAseguradora[0])-($devolucionAseguradora[0]-$regresoAseguradora[0]);

//echo $cargosBeneficencia[0].'-1- '.$abonosBeneficencia[0].'-2- '.$devolucionBeneficencia[0].' -3- '.$regresoBeneficencia[0];
  //REDONDEO GLOBALES****/
  $TOTAL=(float) ($totalCargo-$totalAbono);
  if($TOTAL>-1 and $TOTAL<1){
  $TOTAL='0.00';
  }
  //**************************
  
  //******TOTAL PARTICULAR
  $totalParticular= (float) $totalParticular;

  
  if($totalParticular>-1 and $totalParticular<1){
   $totalParticular='0.00';
  }
  //*********************
  
  //****************TOTAL IVA
  $ivaTotal=(float) ($ivaCargos[0]-$ivaAbonos[0]);
  //**************************
  
  
    //******TOTAL ASEGURADORA
  if($totalAseguradora>-1 and $totalAseguradora<1){
  $totalAseguradora='0.00';
  }
  //*********************
  
  
  //**********COASEGUROS DEDUCIBLES**************
  $totalCoaseguro1=(float) ($totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0]);
  $totalCoaseguro2=(float) ($totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0]);
  $totalDeducible1=(float) ($totalCargoDeducible1[0]-$totalAbonoDeducible1[0]);
  $totalDeducible2=(float) ($totalCargoDeducible2[0]-$totalAbonoDeducible2[0]);
  //***************************************************
  
  //*****************DESCUENTOS*********
$descuentoP=(float) ($descuentoParticularAplicado[0]-$descuentosParticulares[0]);
$descuentoA=(float) ($descuentoAseguradoraAplicado[0]-$descuentosAseguradoras[0]);  
  //***************************************



//****************BENEFICENCIAS********
$ben=(float) ($cargosBeneficencia[0]-$devolucionBeneficencia[0])-(($abonosBeneficencia[0]-$dtBeneficencia[0])-$pagoDevBeneficencia[0]);
//*************************************
?>      
      
      
      
<?php
//CIERRA TOTALES EC
?>
      
  </p>
  
  
  <table width="312"   style="border: 1px solid #CCC;">
    <tr>
      <th width="212"   scope="col"><div align="left">Descripci&oacute;n</div></th>
      <th width="62"   scope="col"><div align="left">Importe</div></th>

    </tr>
    <tr>
<?php





$sSQL= "
SELECT gpoProducto
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    numSolicitud='".$_GET['numSolicitud']."'
and gpoProducto!=''
group by gpoProducto
 ";





if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];
$i+=1;



$sSQLac= "
SELECT sum(importe) as cargo
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='C'

  ";

$resultac=mysql_db_query($basedatos,$sSQLac);
$myrowac = mysql_fetch_array($resultac);
$sSQLaa= "
SELECT sum(importe) as abono
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='A'
 ";

$resultaa=mysql_db_query($basedatos,$sSQLaa);
$myrowaa = mysql_fetch_array($resultaa);

$sSQLaa1= "
SELECT *
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and codigoGP='".$myrow['gpoProducto']."'
order by descripcionGP ASC
 ";

$resultaa1=mysql_db_query($basedatos,$sSQLaa1);
$myrowaa1 = mysql_fetch_array($resultaa1);
?>
      <td   ><div align="left"><span > <?php echo $myrowaa1['descripcionGP']; ?></span></div></td>
      <td   align="right" ><?php

          echo "$".number_format($myrowac['cargo']-$myrowaa['abono'],2);
           ?></td>
    </tr>
    <?php }}?>

            <td  align="right" >
                IVA:
                <?php
                  echo "$".number_format($ivaTotal,2);
           ?></td>
  </table>


  






    <p align="center">





 <input type="hidden" name="variable_php" id="variable_php" />

</form>

<p align="center">&nbsp;</p>
<script languaje="JavaScript">            
              document.form1.variable_php.value=varjs;
</script>
<?php
//***************SOLO MOSTRAR

$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
 ?>
  <?php //MOSSTRAR DATOS CUENTA
  ?>


   
    
    </table>

</div>
  

  
  




   <?php 
//MOSTRAR DATOS EC
//   require('/configuracion/clases/mostrarDatosEC.php');
//
?>

<?php 
//*******************REFERENCIA*******************

/* //*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}
//******************************************************************************* */

//*************************************************

/* 
//*************CARGOS*************
$sc="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as cargos
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rc=mysql_db_query($basedatos,$sc);
$mc = mysql_fetch_array($rc);
//**************************************

//****************ABONOS************

$sa="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as abonos
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$ra=mysql_db_query($basedatos,$sa);
$ma = mysql_fetch_array($ra);
//*************************************


//*******************DEVOLUCIONES**************
$sd="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as devolucion
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rd=mysql_db_query($basedatos,$sd);
$md = mysql_fetch_array($rd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sr="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as regreso
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rr=mysql_db_query($basedatos,$sr);
$mr = mysql_fetch_array($rr);
//**************************************************


//*****************REGRESO*********************  
$sdes="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as descuento
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rdes=mysql_db_query($basedatos,$sdes);
$mdes = mysql_fetch_array($rdes);
//**************************************************

  
$totalCargo= $mc['cargos']-$md['devolucion']-$mr['regreso']-$mdes['descuento'];
$totalAbono=$ma['abonos']; */
?>
<table width="380" border="0" align="center"  cellspacing="0" style="border: 1px solid #CCC;">
    <tr >
      <td width="25" height="25" >&nbsp;</td>
      <td width="113" >Cargos</td>
      <td width="36"  >
	  <?php 

	  echo '$'.number_format($totalCargo,2);
	  
	  ?>
	  </td>
    </tr>
    <tr >
      <td height="26">&nbsp;</td>
      <td >Abonos</td>
      <td ><?php echo '$'.number_format($totalAbono,2);?></td>
    </tr>
	
	
	
    <tr >
      <td height="26" >&nbsp;</td>
      <td  >Total</td>
      <td  ><?php echo '$'.number_format($TOTAL,2);?></td>    </tr>
	


  </table>



<?php 
//
//
//CIERRA MOSTRAR DATOS EC   
   ?> 















<?php 




 $saldos=new acumulados();








 if( $limiteSEGURO>0 and $SEGURO!=NULL){
//doble if
$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$SEGURO."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

$acumulado=$myrow7ab['cantidad']-$saldos-> verificarSaldos($myrow3['seguro'],$entidad,$fecha1,$basedatos,$myrow3['numeroE'],$matricula);



if($TOTAL<=$acumulado){
//MOSTRAR EFECTUAR TRANSACCIONES    ?>

<?php 
$descripcionTransaccion=$_GET['descripcionTransaccion'];
//******ULTIMO TIRON**************

if($_GET['descripcionTransaccion']=='altaPacientes'){
$sSQL3= "Select * From historialHeading WHERE entidad='".$entidad."'
    and
folioVenta = '".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}else{
$sSQL3= "Select * From historialHeading WHEREentidad='".$entidad."'
    and
folioVenta = '".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}
//***********************************

?>
<p>&nbsp;</p>

<a name="final">
    </a>

<table width="590" border="0" align="center" cellpadding="4" cellspacing="0" class="table table-striped" style="border: 1px solid #CCC;">
  <tr>
    <th colspan="2" ><b >Particular</b></th>
    <th width="75" >&nbsp;</th>
     <th colspan="2" ><b >Beneficencia</b></th>
    <th width="75" >&nbsp;</th>
    <th colspan="2" ><b >Aseguradora</b></th>
  </tr>
  <tr>
    <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLpartc= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultpartc=mysql_db_query($basedatos,$sSQLpartc);
$myrowpartc = mysql_fetch_array($resultpartc);	  
	  
	  
$sSQLparta= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultparta=mysql_db_query($basedatos,$sSQLparta);
$myrowparta = mysql_fetch_array($resultparta);


echo  '$'.number_format($myrowpartc['totalParticular']-$myrowparta['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
        <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLbenec= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultbenec=mysql_db_query($basedatos,$sSQLbenec);
$myrowbenec = mysql_fetch_array($resultbenec);	  
	  
	  
$sSQLbenea= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultbenea=mysql_db_query($basedatos,$sSQLbenea);
$myrowbenea = mysql_fetch_array($resultbenea);



echo  '$'.number_format($myrowbenec['totalParticular']-$myrowbenea['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
    
    
    
    
    
    
    
    
    
    
    <td width="116"><span >Cargos</span></td>
    <td width="153"><span >
      <?php 
	  
$sSQLasegc= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultasegc=mysql_db_query($basedatos,$sSQLasegc);
$myrowasegc = mysql_fetch_array($resultasegc);	  
	  
$sSQLasega= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA 
    From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultasega=mysql_db_query($basedatos,$sSQLasega);
$myrowasega = mysql_fetch_array($resultasega);



echo  '$'.number_format($myrowasegc['totalAseguradora']-$myrowasega['totalAseguradora'],2);
?>
    </span></td>
    
    
    
    
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowpartc['totalIVA']-$myrowparta['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowbenec['totalIVA']-$myrowbenea['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowasegc['totalIVA']-$myrowasega['totalIVA'],2);?></span></td>
  </tr>
  
  
  
  
  
  <tr>
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowpartc['totalParticular']+$myrowpartc['totalIVA'])-($myrowparta['totalParticular']+$myrowparta['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowbenec['totalParticular']+$myrowbenec['totalIVA'])-($myrowbenea['totalParticular']+$myrowbenea['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowasegc['totalAseguradora']+$myrowasegc['totalIVA'])-($myrowasega['totalAseguradora']+$myrowasega['totalIVA']),2);?></span></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="900" class="table table-striped" style="border: 1px solid #CCC;">

  <tr >
    <th width="76"  ><div align="center">Part</div></th>
    <th width="76"  ><div align="center">Aseg</div></th>
    <th width="111"  ><div align="center">Regreso Aseg</div></th>
    <th width="104"  ><div align="center">Regreso Part </div></th>
    <th width="89"  ><div align="center">C1</div></th>
    <th width="100"  ><div align="center">C2</div></th>
    <th width="95"  ><div align="center">D1</div></th>
    <th width="88"  ><div align="center">D2</div></th>
    <th width="77"  ><div align="center">Desc Part </div></th>
    <th width="84"  ><div align="center">Desc Aseg </div></th>
    <th width="84"  ><div align="center">Beneficencia</div></th>
  </tr>
  <tr  >
    <td height="48"  ><div align="center"><span >
<?php  





//************************PARTICULARES**********************************************************************
//CARGOS PARTICULARES REFERENCIAS 
/* if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
} */
//******************************************************************************************

/* //*************CARGOS*************
$sPc="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as cargoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rPc=mysql_db_query($basedatos,$sPc);
$mPc = mysql_fetch_array($rPc);
//**************************************

//****************ABONOS************

$sPa="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as abonoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rPa=mysql_db_query($basedatos,$sPa);
$mPa = mysql_fetch_array($rPa);
//*************************************


//*******************DEVOLUCIONES**************
$sPd="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as devolucionParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rPd=mysql_db_query($basedatos,$sPd);
$mPd = mysql_fetch_array($rPd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sPr="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as regresoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rPr=mysql_db_query($basedatos,$sPr);
$mPr = mysql_fetch_array($rPr);
//**************************************************


//*****************REGRESO*********************  
$sPdes="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as descuentoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ****************************************************************************** */
  
  
  
  
  

  

  
  

  
  
  
if( $totalParticular>1 ||  ($myrow3['statusDevolucion']=='si' and  $descuentoP<1 and $descuentoA<1 )){ 




if($myrow3['statusCortesia']=='si'){

$tipoPago='Cortesia';


}else{	
if($myrow3['tipoPaciente']=='externo' or (($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias') and $myrow3['statusDevolucion']=='si')){ 
if($devolucionParticular[0]>0 and $myrow3['statusDevolucion']=='si'){	
$tipoDevolucion='';
$tipoPago='';
if($totalParticular<0){ 
$totalParticular*=-1;
}
}else{
$s= "Select codigoTT From catTTCaja WHERE  pagoEfectivo='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}


}elseif($myrow3['activaBeneficencia']=='si'){
 $s= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Beneficencia';
$caso=1;
}else{
$s= "Select codigoTT From catTTCaja WHERE  gastosParticulares='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}
}



?>
      <?php if($mostrar==TRUE){ ?>


<?php if($totalParticular>0 and $totalParticular>-1){ ?>
<a  href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionParticular';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;tipoPago=<?php echo $tipoPago;?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>&statusCortesia=<?php echo $myrow3['statusCortesia'];?>&tipoDevolucion=<?php echo $tipoDevolucion;?>&beneficencia=<?php
if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&statusBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&activaBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&caso=<?php echo $caso;?>','ventana7','680','380','yes');">
<?php 
echo '$'.number_format($totalParticular,2);
?>
</a>
<?php } else{       
echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>



      <?php } else { echo '$'.number_format($totalParticular,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    <td  ><div align="center"><span >






<?php 
//********************************cANTIDAD ASEGURADORA****************************************

//*********************REFERENCIA*****************/
/* //CARGOS ASEGURADORA 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}
 */


/* 
//*************CARGOS*************
$sAc="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as cargoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rAc=mysql_db_query($basedatos,$sAc);
$mAc = mysql_fetch_array($rAc);
//**************************************

//****************ABONOS************

$sAa="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as abonoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rAa=mysql_db_query($basedatos,$sAa);
$mAa = mysql_fetch_array($rAa);
//*************************************


//*******************DEVOLUCIONES**************
$sAd="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as devolucionAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rAd=mysql_db_query($basedatos,$sAd);
$mAd = mysql_fetch_array($rAd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sAr="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as regresoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rAr=mysql_db_query($basedatos,$sAr);
$mAr = mysql_fetch_array($rAr);
//**************************************************


//*****************REGRESO*********************  
$sdes="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as descuentoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ******************************************************************************
 */


//**************************************************************************************************



if( $totalAseguradora>1 || $myrow3['statusDevolucion']=='si'){ 

if($devolucionAseguradora[0]>0 and $myrow3['statusDevolucion']=='si'){ 
$s= "Select codigoTT From catTTCaja WHERE  devolucionAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

if($totalAseguradora<0){ 
$totalAseguradora*=-1;
}
$tipoPago='';

}else{
$s= "Select codigoTT From catTTCaja WHERE  trasladoAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Cuentas por Cobrar';
}
?>







      <?php  if($totalCoaseguro1<1 and $totalCoaseguro2<1 and $totalDeducible1<1 and $totalDeducible2<1 and $descuentoP<1 and $descuentoA<1){ ?>
      <?php if($mostrar==TRUE){ ?>
	  
	  
	  
	  <?php if($totalAseguradora>-1 and $totalAseguradora>0){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionAseguradora';}else{ echo 'cxc';} ?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;tipoTransaccion=aseguradora&amp;tipoPago=<?php echo $tipoPago;?>&amp;devolucion=<?php echo $_GET['devolucion'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','800','380','yes');"> <?php echo '$'.number_format($totalAseguradora,2);?></a>
      <?php } else { echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>





      <?php } else { echo '$'.number_format($totalAseguradora,2);}?>
      <?php } else{?>
      <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } ?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>

















  
<td  >
<div align="center"><span >
<?php 
if($totalAseguradora<-1  and $devolucionAseguradora[0]<1){ 
$tA=$totalAseguradora*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"> </a></span></div>      <span ><a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink> 
      <div align="center"><?php echo '$'.number_format($tA,2);?> </div>
      </blink></a>
      <div align="center">
        <?php } else { echo '$'.number_format($tA,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
</span>
</td>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <td  ><div align="center"><span >
      <?php
 if($totalParticular<-1){  
$tP=$totalParticular*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"></a></span></div>     
        <span >
            
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink>
     <div align="center">
     <?php echo '$'.number_format($tP,2);?>
     </div>
      </blink></a>
            
            
      <div align="center">
        <?php } else { echo '$'.number_format($tP,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
    </span></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro1>1){ 	?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro1;?>&amp;precioVenta=<?php echo $totalCoaseguro1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro1,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro2>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro2;?>&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible1>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible1;?>&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible2>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible2;?>&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  >
        <div align="center">
            <span >
      <?php if($descuentoP>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoParticular;?>&amp;precioVenta=<?php echo $descuentoP;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=particular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoP,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoP,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($descuentoA>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoAseguradora;?>&amp;precioVenta=<?php echo $descuentoA;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=aseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoA,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoA,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>




    
    
    
    
<?php 
//*******************BENEFICENCIA
if($ben!=NULL and $ben<0){ 
$mp='devolucionBeneficencia';
$ben=$ben*-1;
$tpb='devolucionBeneficencia';

}else{$mp='Beneficencia';$tpb='Beneficencia';}?>



     <td  ><div align="center"><span >
      <?php if($ben!=NULL){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $transB;?>&amp;precioVenta=<?php echo $ben;?>&amp;modoPago=<?php echo $mp;?>&amp;tipoPago=<?php echo $tpb;?>&descripcionTransaccion=beneficencia&status=<?php echo $myrow3['status'];?>&beneficencia=si&statusBeneficencia=si','ventana7','480','380','yes');"> <?php echo '$'.number_format($ben,2);?></a>
      <?php } else { echo '$'.number_format($ben,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
  </tr>

</table>
<p>&nbsp;</p>

 
 
 <?php
 //CIERRA MOSTRAR EFECTUAR TRANSACCIONES
   }else{
echo '<br>';
   echo '<span class="codigos">ERROR: <blink>'.'Imposible hacer movimientos en esta cuenta, ya supero su limite de credito!'.'</blink>'.' tienes cargos por: '. '$'.number_format($saldos-> verificarSaldos($myrow3['seguro'],$entidad,$fecha1,$basedatos,$myrow3['numeroE'],$matricula),2).'!!'.'</span>';
   }

}else{ //no tiene limites?>

<?php 
//MOSTRAR EFECTUAR TRANSACCIONES
$descripcionTransaccion=$_GET['descripcionTransaccion'];
//******ULTIMO TIRON**************

if($_GET['descripcionTransaccion']=='altaPacientes'){
$sSQL3= "Select * From historialHeading WHERE entidad='".$entidad."'
    and
folioVenta = '".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}else{
$sSQL3= "Select * From historialHeading WHERE entidad='".$entidad."'
    and
folioVenta = '".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}
//***********************************

?>
<p>&nbsp;</p>

<a name="final">
    </a>

<table width="590" border="0" align="center" cellpadding="4" cellspacing="0" class="table table-striped" style="border: 1px solid #CCC;">
  <tr>
    <th colspan="2" ><b >Particular</b></th>
    <th width="75" >&nbsp;</th>
     <th colspan="2" ><b >Beneficencia</b></th>
    <th width="75" >&nbsp;</th>
    <th colspan="2" ><b >Aseguradora</b></th>
  </tr>
  <tr>
    <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLpartc= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultpartc=mysql_db_query($basedatos,$sSQLpartc);
$myrowpartc = mysql_fetch_array($resultpartc);	  
	  
	  
$sSQLparta= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultparta=mysql_db_query($basedatos,$sSQLparta);
$myrowparta = mysql_fetch_array($resultparta);


echo  '$'.number_format($myrowpartc['totalParticular']-$myrowparta['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
        <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLbenec= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultbenec=mysql_db_query($basedatos,$sSQLbenec);
$myrowbenec = mysql_fetch_array($resultbenec);	  
	  
	  
$sSQLbenea= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultbenea=mysql_db_query($basedatos,$sSQLbenea);
$myrowbenea = mysql_fetch_array($resultbenea);



echo  '$'.number_format($myrowbenec['totalParticular']-$myrowbenea['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
    
    
    
    
    
    
    
    
    
    
    <td width="116"><span >Cargos</span></td>
    <td width="153"><span >
      <?php 
	  
$sSQLasegc= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultasegc=mysql_db_query($basedatos,$sSQLasegc);
$myrowasegc = mysql_fetch_array($resultasegc);	  
	  
$sSQLasega= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA 
    From historialCuentas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
and
    numSolicitud='".$_GET['numSolicitud']."'
 ";
$resultasega=mysql_db_query($basedatos,$sSQLasega);
$myrowasega = mysql_fetch_array($resultasega);



echo  '$'.number_format($myrowasegc['totalAseguradora']-$myrowasega['totalAseguradora'],2);
?>
    </span></td>
    
    
    
    
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowpartc['totalIVA']-$myrowparta['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowbenec['totalIVA']-$myrowbenea['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowasegc['totalIVA']-$myrowasega['totalIVA'],2);?></span></td>
  </tr>
  
  
  
  
  
  <tr>
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowpartc['totalParticular']+$myrowpartc['totalIVA'])-($myrowparta['totalParticular']+$myrowparta['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowbenec['totalParticular']+$myrowbenec['totalIVA'])-($myrowbenea['totalParticular']+$myrowbenea['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowasegc['totalAseguradora']+$myrowasegc['totalIVA'])-($myrowasega['totalAseguradora']+$myrowasega['totalIVA']),2);?></span></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="900" class="table table-striped" style="border: 1px solid #CCC;">

  <tr >
    <th width="76"  ><div align="center">Part</div></th>
    <th width="76"  ><div align="center">Aseg</div></th>
    <th width="111"  ><div align="center">Regreso Aseg</div></th>
    <th width="104"  ><div align="center">Regreso Part </div></th>
    <th width="89"  ><div align="center">C1</div></th>
    <th width="100"  ><div align="center">C2</div></th>
    <th width="95"  ><div align="center">D1</div></th>
    <th width="88"  ><div align="center">D2</div></th>
    <th width="77"  ><div align="center">Desc Part </div></th>
    <th width="84"  ><div align="center">Desc Aseg </div></th>
    <th width="84"  ><div align="center">Beneficencia</div></th>
  </tr>
  <tr  >
    <td height="48"  ><div align="center"><span >
<?php  





//************************PARTICULARES**********************************************************************
//CARGOS PARTICULARES REFERENCIAS 
/* if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
} */
//******************************************************************************************

/* //*************CARGOS*************
$sPc="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as cargoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rPc=mysql_db_query($basedatos,$sPc);
$mPc = mysql_fetch_array($rPc);
//**************************************

//****************ABONOS************

$sPa="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as abonoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rPa=mysql_db_query($basedatos,$sPa);
$mPa = mysql_fetch_array($rPa);
//*************************************


//*******************DEVOLUCIONES**************
$sPd="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as devolucionParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rPd=mysql_db_query($basedatos,$sPd);
$mPd = mysql_fetch_array($rPd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sPr="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as regresoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rPr=mysql_db_query($basedatos,$sPr);
$mPr = mysql_fetch_array($rPr);
//**************************************************


//*****************REGRESO*********************  
$sPdes="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as descuentoParticular
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ****************************************************************************** */
  
  
  
  
  

  

  
  

  
  
  
if( $totalParticular>1 ||  ($myrow3['statusDevolucion']=='si' and  $descuentoP<1 and $descuentoA<1 )){ 




if($myrow3['statusCortesia']=='si'){

$tipoPago='Cortesia';


}else{	
if($myrow3['tipoPaciente']=='externo' or (($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias') and $myrow3['statusDevolucion']=='si')){ 
if($devolucionParticular[0]>0 and $myrow3['statusDevolucion']=='si'){	
$tipoDevolucion='';
$tipoPago='';
if($totalParticular<0){ 
$totalParticular*=-1;
}
}else{
$s= "Select codigoTT From catTTCaja WHERE  pagoEfectivo='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}


}elseif($myrow3['activaBeneficencia']=='si'){
 $s= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Beneficencia';
$caso=1;
}else{
$s= "Select codigoTT From catTTCaja WHERE  gastosParticulares='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}
}



?>
      <?php if($mostrar==TRUE){ ?>


<?php if($totalParticular>0 and $totalParticular>-1){ ?>
<a  href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionParticular';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;tipoPago=<?php echo $tipoPago;?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>&statusCortesia=<?php echo $myrow3['statusCortesia'];?>&tipoDevolucion=<?php echo $tipoDevolucion;?>&beneficencia=<?php
if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&statusBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&activaBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&caso=<?php echo $caso;?>','ventana7','680','380','yes');">
<?php 
echo '$'.number_format($totalParticular,2);
?>
</a>
<?php } else{       
echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>



      <?php } else { echo '$'.number_format($totalParticular,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    <td  ><div align="center"><span >






<?php 
//********************************cANTIDAD ASEGURADORA****************************************

//*********************REFERENCIA*****************/
/* //CARGOS ASEGURADORA 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}
 */


/* 
//*************CARGOS*************
$sAc="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as cargoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rAc=mysql_db_query($basedatos,$sAc);
$mAc = mysql_fetch_array($rAc);
//**************************************

//****************ABONOS************

$sAa="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as abonoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rAa=mysql_db_query($basedatos,$sAa);
$mAa = mysql_fetch_array($rAa);
//*************************************


//*******************DEVOLUCIONES**************
$sAd="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as devolucionAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rAd=mysql_db_query($basedatos,$sAd);
$mAd = mysql_fetch_array($rAd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sAr="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as regresoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rAr=mysql_db_query($basedatos,$sAr);
$mAr = mysql_fetch_array($rAr);
//**************************************************


//*****************REGRESO*********************  
$sdes="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as descuentoAseguradora
FROM
historialCuentas
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ******************************************************************************
 */


//**************************************************************************************************



if( $totalAseguradora>1 || $myrow3['statusDevolucion']=='si'){ 

if($devolucionAseguradora[0]>0 and $myrow3['statusDevolucion']=='si'){ 
$s= "Select codigoTT From catTTCaja WHERE  devolucionAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

if($totalAseguradora<0){ 
$totalAseguradora*=-1;
}
$tipoPago='';

}else{
$s= "Select codigoTT From catTTCaja WHERE  trasladoAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Cuentas por Cobrar';
}
?>







      <?php  if($totalCoaseguro1<1 and $totalCoaseguro2<1 and $totalDeducible1<1 and $totalDeducible2<1 and $descuentoP<1 and $descuentoA<1){ ?>
      <?php if($mostrar==TRUE){ ?>
	  
	  
	  
	  <?php if($totalAseguradora>-1 and $totalAseguradora>0){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionAseguradora';}else{ echo 'cxc';} ?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;tipoTransaccion=aseguradora&amp;tipoPago=<?php echo $tipoPago;?>&amp;devolucion=<?php echo $_GET['devolucion'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','800','380','yes');"> <?php echo '$'.number_format($totalAseguradora,2);?></a>
      <?php } else { echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>





      <?php } else { echo '$'.number_format($totalAseguradora,2);}?>
      <?php } else{?>
      <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } ?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>

















  
<td  >
<div align="center"><span >
<?php 
if($totalAseguradora<-1  and $devolucionAseguradora[0]<1){ 
$tA=$totalAseguradora*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"> </a></span></div>      <span ><a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink> 
      <div align="center"><?php echo '$'.number_format($tA,2);?> </div>
      </blink></a>
      <div align="center">
        <?php } else { echo '$'.number_format($tA,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
</span>
</td>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <td  ><div align="center"><span >
      <?php
 if($totalParticular<-1){  
$tP=$totalParticular*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"></a></span></div>     
        <span >
            
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink>
     <div align="center">
     <?php echo '$'.number_format($tP,2);?>
     </div>
      </blink></a>
            
            
      <div align="center">
        <?php } else { echo '$'.number_format($tP,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
    </span></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro1>1){ 	?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro1;?>&amp;precioVenta=<?php echo $totalCoaseguro1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro1,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro2>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro2;?>&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible1>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible1;?>&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible2>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible2;?>&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  >
        <div align="center">
            <span >
      <?php if($descuentoP>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoParticular;?>&amp;precioVenta=<?php echo $descuentoP;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=particular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoP,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoP,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($descuentoA>1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoAseguradora;?>&amp;precioVenta=<?php echo $descuentoA;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=aseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoA,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoA,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>




    
    
    
    
<?php 
//*******************BENEFICENCIA
if($ben!=NULL and $ben<0){ 
$mp='devolucionBeneficencia';
$ben=$ben*-1;
$tpb='devolucionBeneficencia';

}else{$mp='Beneficencia';$tpb='Beneficencia';}?>



     <td  ><div align="center"><span >
      <?php if($ben!=NULL){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $transB;?>&amp;precioVenta=<?php echo $ben;?>&amp;modoPago=<?php echo $mp;?>&amp;tipoPago=<?php echo $tpb;?>&descripcionTransaccion=beneficencia&status=<?php echo $myrow3['status'];?>&beneficencia=si&statusBeneficencia=si','ventana7','480','380','yes');"> <?php echo '$'.number_format($ben,2);?></a>
      <?php } else { echo '$'.number_format($ben,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
  </tr>

</table>
<p>&nbsp;</p>
    
    
    
    
<?php     
//CIERRA MOSTRAR EFECTUAR TRANSACCIONES

}



   ?>
  <p align="center">&nbsp;</p>
  <p align="center">

	
	
	

<script languaje="JavaScript">            
              document.form1.folioVenta.value=<?php echo $_GET['folioVenta'];?>
			                document.form1.keyClientesInternos.value=<?php echo $_GET['nT'];?>
							    document.form1.nT.value=<?php echo $_GET['nT'];?>
    </script>
    <br>
</body>
</html>
      <?php  }?>