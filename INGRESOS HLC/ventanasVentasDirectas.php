<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');require("/configuracion/clases/generaFolioVenta.php");?>
<?php 

$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta'){ //*******************Comienzo la validaci�n*****************
?>


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=400,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") ;
   //if(parent.Windows){
     parent.Windows.close("dialog3", null);
   //}



} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>

<?php
$ALMACEN=$_GET['almacen'];












//************************ACTUALIZO **********************







//***************aplicar pago**********************

if($_POST['tipoPago'] AND $_POST['aplicarPago'] and $_POST['cantidadRecibida'] and $_POST['descripcion'] and $_POST['tipoTransaccion'] and $_POST['gpoProducto'] and $_POST['almacenDestino'] and $_POST['cantidad']>0){







//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numCorte=$myrowC['numCorte'];

$q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where
entidad='".$entidad."'
and
keyCatC='".$myrowC['keyCatC']."'
and
status='abierta'
order by keySTC DESC ";

mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);


//***************GENERAR FOLIO DE VENTA**********
$generaFolio=new folioVenta();
$FV=$generaFolio-> generarFolioVenta(NULL,$usuario,"externo",$entidad,$tipoFolio,$basedatos);
//***************************************


$ivaGrupo=new articulosDetalles();
$iva=$ivaGrupo-> ivaGPO($entidad,$_POST['cantidad'],$_POST['gpoProducto'],$_POST['cantidadRecibida'],$basedatos);







//***********************VERIFICO QUE NO SE DUPLIQUE EL FOLIO********************************
$sSQL3a= "Select folioVenta From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$FV."' order by keyClientesInternos DESC ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
if($myrow3a['folioVenta']==$FV){
echo '<script>
window.alert("Oops! hay un problema de cache! favor de reportarlo a sistemas");
window.close();
echo </script>';
}
//**********************************************************************************************



//*****************************************************************
$sSQL3171= "Select * From catTTCaja WHERE entidad='".$entidad."' and ventaDirectaCargo = 'si'";
$result3171=mysql_db_query($basedatos,$sSQL3171);
$myrow3171 = mysql_fetch_array($result3171);		

//********************************************************************
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$random=rand(1000,10000000000);






//*********************************ENCABEZADO**************************************
$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,statusCuenta,statusDeposito,almacenSolicitud,horaSolicitud,fechaSolicitud,expediente,clientePrincipal,nombreCliente,folioVenta,codigoCaja,numRecibo,numCorte,tipoPago,statusCaja
) values (

'','',
'".$_POST['medico']."',
'".$_POST['nombreCliente']."',
'".$_POST['seguro']."',
'".$usuario."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'cerrada',
'".$_POST['cita']."',
'".$_POST['almacenDestino']."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','cerrada','pagado','".$_POST['almacenDestino']."','".$hora1."','".$fecha1."','no','".$myrow455['clientePrincipal']."','".$_POST['nombreCliente']."','".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','ventasDirectas','pagado'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//**************************************************************





//*******************************INSERTAR CARGO***************************
$sSQL317= "Select * From catTTCaja WHERE entidad='".$entidad."' and ventaDirectaAbono = 'si'   ";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);		
$codigoTT=$myrow317['codigoTT'];
$naturaleza=$myrow317['naturaleza'];









$sSQL3= "Select * From clientesInternos WHERE entidad = '".$entidad."' and folioVenta='".$FV."'    ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//************************************CARGO***********************************************		




//*************************INSERTO ABONO*************************************************

//*****************************************************************************







if($_POST['devolucion']=='si'){
$s= "Select * From catTTCaja WHERE entidad='".$entidad."' and devolucionVentaDirecta='si'   ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$describe=$my['descripcion'];
$naturalezaTransaccion=$my['naturaleza'];
$codigoTT=$my['codigoTT'];
$tipoCuenta='D';
$statusDevolucion='si';
$descripcionTransaccion='devolucionVentaDirecta';
$myrow317['descripcion']=$my['descripcion'];
$codigoTT=$my['codigoTT'];


$_POST['tipoPago']='devolucionVentaDirecta';
if(!$my['codigoTT']){ ?>
<script>
window.alert("Se produjo un error de operacion");
window.close();
</script>
<?php 
}
}else{

$statusDevolucion='no';
$tipoCuenta='H';
$descripcionTransaccion='ventasDirectas';
$sSQL317= "Select * From catTTCaja WHERE entidad='".$entidad."' and ventaDirectaCargo = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);		
$naturalezaTransaccion=$myrow317['naturaleza'];
$codigoTT=$myrow317['codigoTT'];
}




$sSQL333a= "SELECT 
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a); 

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1*****************************

$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
) values (
'".$myrow333a['CVI']."','".$myrow3g['keyCAP']."','".$_POST['cantidad']."','".$_POST['descripcion']."','".$_POST['cantidadRecibida']."','".$iva."','".$_POST['cantidadRecibida']."',
'".$iva."','".$myrow3g['cantidadAseguradora']."','".$myrow3g['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow3['keyClientesInternos']."',
'".$FV."','".$myrow3g['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//***************************************************
//echo $naturalezaTransaccion;


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,
almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,bancoTC,telefono,clientePrincipal,
folioVenta,codigoCaja,numRecibo,numCorte,descripcionArticulo,tipoCuenta,random,descripcionTransaccion,
ivaParticular,numMovimiento,statusDevolucion,ventasDirectas,fechaCierre)
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','".$_POST['cantidad']."','".$codigoTT."','".$hora1."',
'".$hora1."','".$naturalezaTransaccion."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."' + '".$iva."','".$seguro."','standby','externo','externo',
'".$_POST['cantidadRecibida']."' + '".$iva."','".$cantidadAseguradora."','".$entidad."','".$_POST['tipoPago']."','standby',
'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$_POST['tipoPago']."','pagado','".$hora1."','".$fecha1."',
'".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."','".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','".$_POST['bancoTC']."','".$_POST['telefono']."','".$myrow455['clientePrincipal']."',
'".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$myrow317 ['descripcion']."','".$tipoCuenta."' ,
    '".$random."' ,'".$descripcionTransaccion."'  ,'0.00' ,'".$myrow333a['CVI']."','".$statusDevolucion."' ,'si','".$fecha1."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//**************************************************************************************






$sSQL333a= "SELECT 
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a); 

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1*****************************

$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
) values (
'".$myrow333a['CVI']."','".$myrow3g['keyCAP']."','".$_POST['cantidad']."','".$_POST['descripcion']."','".$_POST['cantidadRecibida']."','".$iva."','".$_POST['cantidadRecibida']."',
'".$iva."','".$myrow3g['cantidadAseguradora']."','".$myrow3g['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow3['keyClientesInternos']."',
'".$FV."','".$myrow3g['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//***************************************************

if($_POST['devolucion']=='si'){
$tipoCuenta='H';
$statusDevolucion='si';
$naturalezaCargos='A';
}else{
$tipoCuenta='D';
$statusDevolucion='no';
$naturalezaCargos='C';
}









//**************************************************************************************






$sSQL333a= "SELECT 
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a); 

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1*****************************

$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
) values (
'".$myrow333a['CVI']."','".$myrow3g['keyCAP']."','".$_POST['cantidad']."','".$_POST['descripcion']."','".$_POST['cantidadRecibida']."','".$iva."','".$_POST['cantidadRecibida']."',
'".$iva."','".$myrow3g['cantidadAseguradora']."','".$myrow3g['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow3['keyClientesInternos']."',
'".$FV."','".$myrow3g['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//***************************************************


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,statusCargo,
porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
folioVenta,descripcionArticulo,tipoCuenta,random,descripcionTransaccion,ivaParticular,gpoProducto,statusDevolucion,numMovimiento,fechaCargo,ventasDirectas,fechaCierre)
values 
('','','particular',
'".$usuario."','".$fecha1."','".$dia."','".$_POST['cantidad']."','0','".$hora1."',
'".$hora1."','".$naturalezaCargos."','".$ID_EJERCICIOM."','','".$_POST['almacenDestino']."','".$usuario."',
'".$_POST['cantidadRecibida']."','".$iva."', '".$seguro."','standby','externo','externo',
'".$_POST['cantidadRecibida']."','".$cantidadAseguradora."','".$entidad."','','standby',
'cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."','".$_POST['almacenDestino']."',
    '".$myrow3['keyClientesInternos']."','pagado','','pagado','".$hora1."','".$fecha1."',
'".$FV."','".$_POST['descripcion']."','".$tipoCuenta."' ,'".$random."' ,'','".$iva."' ,'".$_POST['gpoProducto']."'  ,'".$statusDevolucion."' ,
    '".$myrow333a['CVI']."' ,'".$fecha1."' ,'si',
    '".$fecha1."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error(); 






















//************************PARTIDA DOBLE***************************************
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,numeroTransferencia,bancoTC,telefono,clientePrincipal,
folioVenta,codigoCaja,numRecibo,numCorte,descripcionArticulo,tipoCuenta,random,descripcionTransaccion,ivaParticular,numMovimiento,statusDevolucion) 
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."' + '".$iva."','".$seguro."','standby','externo','externo',
'".$_POST['cantidadRecibida']."' + '".$iva."','".$cantidadAseguradora."','".$entidad."','".$_POST['tipoPago']."','standby',
'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$_POST['tipoPago']."','pagado','".$hora1."','".$fecha1."',
'".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."','".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','".$_POST['bancoTC']."','".$_POST['telefono']."','".$myrow455['clientePrincipal']."',
'".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$myrow317 ['descripcion']."','".$tipoCuenta."' ,'".$random."' ,'ventasDirectas'  ,'".$iva."' ,'".$myrow333['CVI']."' ,'".$statusDevolucion."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************


print "Se hizo una venta";






//***************************************SACO NUMERO DE RECIBOS******************

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);



$sSQL3= "Select * From clientesInternos WHERE entidad = '".$entidad."' and folioVenta='".$FV."'    ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***********************************************************************************
?>
<script language="JavaScript" type="text/javascript">
  
//window.opener.document.forms["form1"].submit();
  
javascript:ventanaSecundaria2('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?folioVenta=<?php echo $FV; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&entidad=<?php echo $entidad;?>&codigoCaja=<?php echo $myrowC['keyCatC'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&numCorte=<?php echo $numCorte;?>');



</script>
<?php
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje("Se genero el folio de venta: ".$FV);
?>
<script>

window.close();

</script>
<?php
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>
<body>
<h1 align="center" >Tipo de Pago o Transaccion</h1>
  <form id="form1" name="form1" method="post" action="">
    <table width="400" class="table-forma">
    <tr>
      <th width="1"  scope="col">&nbsp;</th>
      <th colspan="2"   scope="col"><p align="center">Datos de la Transacci&oacute;n</p></th>
    </tr>
	
	
	
	
     <tr>
       <td  scope="col">&nbsp;</td>
       <td width="116" >Transacci&oacute;n </td>
       <td width="278" >
	   <?php 
	   
	   

	   
	   
  $sSQL3171= "Select * From catTTCaja WHERE ventaDirectaCargo = 'si'";
$result3171=mysql_db_query($basedatos,$sSQL3171);
$myrow3171 = mysql_fetch_array($result3171);
	   if(!$myrow3171['codigoTT']){
	 echo '<script>
	 window.alert("Oops! hay un problema en la caja, favor de comunicarlo a sistemas!");
	 window.close();
	 </script>';
	   } 
	   ?>
	   
         <input name="campoDespliega" type="text"  id="campoDespliega" size="50" 
	value="<?php echo $myrow3171['descripcion'];?>"
		   readonly=""/>
         <a href="javascript:ventanaSecundaria6(
		'/sima/INGRESOS%20HLC/caja/ventanaTT.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;campo1=<?php echo "cantidadRecibida"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;tipoPago=<?php echo 'Efectivo'; ?>&amp;almacenFuente=<?php echo $_GET['almacen']; ?>')"></a>
         <input name="tipoTransaccion" type="hidden"  id="tipoTransaccion" 
				value="<?php echo $myrow3171['codigoTT'];?>"   readonly="" />
         </a>       </td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td width="116"  >Tipo Pago/Cr&eacute;dito </td>
       <td width="278"  ><?php 
		 ?>
           <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" >
             <option
				 <?php if($_POST['tipoPago']=='Efectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo" >Efectivo</option>
           
             <option
				 <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Transferencia Electronica" >Transferencia Electronica</option>
             <option
				<?php if($_POST['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
				 
				 <option
				<?php if($_POST['tipoPago']=='Tarjeta de Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta de Credito">Tarjeta de Credito</option>
         </select></td>
     </tr>
	 
	 
	  <?php if($_POST['tipoPago']=='Tarjeta de Credito'){ ?>
      <tr>
        <td  scope="col">&nbsp;</td>
        <td  >Ultimos 4 d&iacute;gitos </td>
        <td >
          <input name="ultimosDigitos" type="text"  id="ultimosDigitos" 
		 value="" size="4" maxlength="4" />
          <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&amp;descripcion=<?php echo "descripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;comision=<?php echo "comision"; ?>&amp;tipoPago=<?php echo $_GET['tipoPago'];?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></span></td>
      </tr>
      <tr>
        <td  scope="col">&nbsp;</td>
        <td  >Tel&eacute;fono</td>
        <td ><input name="telefono" type="text"  value="" size="50"></td>
      </tr>
	  
	  
	  
      <tr>
        <td  scope="col">&nbsp;</td>
        <td  >Banco Tarjeta</td>
        <td ><input name="bancoTC" type="text"  value="" size="50"  /></td>
      </tr>
	  <?php } ?>
	  
	  
	  
	  <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
      <tr>
	        <td  scope="col">&nbsp;</td>
	 	
       <td  >Banco Transferencia </td>
       <td ><input name="bancoTransferencia" type="text"  value="" size="50"  /></td>
     </tr>
	 <?php } ?>
	
	
	
		    <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
           <tr>
             <td  scope="col">&nbsp;</td>
             <td  ># Transferencia </td>
             <td >
			 <input name="numeroTransferencia" type="text"  id="numeroTransferencia" value="" size="50">			 </td>
           </tr>
 <?php } ?>		   
		   
<?php if($_POST['tipoPago']=='Cheque'){ ?>		   
      <tr>
       <td  scope="col">&nbsp;</td>
	   <td  > N&uacute;mero Cheque </td>
       <td ><input name="numeroCheque" type="text"  id="numeroCheque" value="" /></td>
     </tr>
 <?php } ?>
	
	
	
	<?php if($_POST['tipoPago']=='Cheque'){ ?> 
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Banco Cheque</td>
       <td ><input name="bancoCheque" type="text"  id="bancoCheque" value="" size="50" /></td>
     </tr>
	  <?php } ?>
	 
	 
     <tr>
       <td  scope="col">&nbsp;</td>
       <td colspan="2"  ><div align="center" >Datos del Cliente e Importe</div></td>
      </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Nombre del Cliente </td>
       <td ><input name="nombreCliente" type="text"  id="nombreCliente" value="" size="50" /></td>
     </tr>
     <tr>
      <td  scope="col">&nbsp;</td>
      <td >Descripci&oacute;n</td>
      <td >
	  <textarea name="descripcion" cols="50"  id="descripcion"></textarea></td>
    </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Departamento Cargo </td>
       <td >

<?php
	   $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') 
 
 order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>	   </td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Cantidad</td>
       <td ><label>
         <input name="cantidad" type="text" id="cantidad" size="9" value="1" />
       *Cantidad de articulos,servicios,etc. </label></td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Grupo de Producto </td>
       <td ><span class="normal">
         <?php //*********gpoProductos
	 
 $sSQL7= "Select  * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
         <select name="gpoProducto"  id="gpoProducto[]">
           <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
           <option 
		   <?php if($myrow7['codigoGP']==$myrow['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
           <?php } 
		
		?>
         </select>
       </span></td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Devolucion?</td>
       <td ><input name="devolucion" type="checkbox" id="devolucion" value="si" /></td>
     </tr>
     <tr>
      <td width="1"  scope="col">&nbsp;</td>
      <td >Importe</td>
      <td ><label>
        <input name="cantidadRecibida" type="text"  id="cantidadRecibida" value="" autocomplete="off">
      </label></td>
    </tr>


	

    <tr>
	     <td height="33" colspan="3"><label>
	        <br />
            <br />
           <div align="center">
            <label></label>
            <input name="aplicarPago" type="submit"  id="aplicarPago" value="Efectuar Pago"  />
			
            <label></label>
            <input name="almacen" type="hidden"  id="almacen" 
				value="<?php echo $ALMACEN;?>"   readonly="" />
          </div>
        </label></td>
    </tr>
  </table>
</form>
<h1 align="center">&nbsp;</h1>
</body>
</html>
<?php
} else { 
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('LA CAJA ESTA CERRADA');
}
?>