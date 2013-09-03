<?php require("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/clases/eCuentaGrafico.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<?php
$cargosAseguradora=new acumulados();
function redondear_dos_decimal($valor) {
   $float_redondeado=round($valor * 100) / 100;
   return $float_redondeado;
} 


$cargosParticularesCC=new  cierraCuenta();	
$cargosAseguradoraCC=new cierraCuenta();
$convenioParticularCC=new cierraCuenta();
$otros=new acumulados();
$coaseguro=new acumulados();
?>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.tipoTransaccion.value) == false ) {   
                alert("Escoje el Tipo de Transacción que desees hacer!")   
                return false   
        }  else if( vacio(F.cantidadRecibida.value) == false ) {   
                alert("Escribe la cantidad!")   
                return false   
        }                     
		
		
}   
  
</script> 
<?php 



$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$cargosParticulares=new  acumulados();	
$cargosCortesia=new acumulados();
$dev=new acumulados();


if($_GET['almacen']){
$almacenFuente=$_GET['almacen'];
} else {
$almacenFuente=$_POST['almacenFuente'];
}




$TOTAL=$_GET['TOTAL'];
$iva=$_GET['iva'];
$numeroCuenta=$_GET['nCuenta'];
$descuento=$_GET['descuento'];
$depositos=$_GET['depositos'];
$devolucion=$_GET['cantidadRecibida']-$TOTAL;
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($numeroCuenta){















$tipoPaciente=$myrow3['tipoPaciente'];
$tipoTrans=$myrow3['tipoTransaccion'];
$compania=$myrow3['seguro'];
?>


<?php 


//*****************************Verificando caja abierta**************************
 $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta' ){ //*******************Comienzo la validación*****************





















$numCorte=$myrowC['numCorte'];
//********************Llenado de datos
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$package=$myrow3['paquete'];




$seguro=$myrow3['seguro'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$tipoPaciente=$myrow3['tipoPaciente'];
//***************aplicar pago**********************




if(($_GET['tipoPago']=='Otros' and $_GET['responsableCuenta'] and $_GET['fechaVencimiento']) OR ($_GET['aplicarPago'] AND $_GET['cantidadRecibida'] AND $_GET['tt'] or ($_GET['devolucion']=='si' and $_GET['aplicarPago']))){






//**********************TIPO CLIENTE**********************
if($_GET['tipoPago']=='Nomina' or $_GET['tipoPago']=='Cuentas por Cobrar'){
$_GET['tipoCliente']='aseguradora';
}


//********************************************************














//********************solo 1 transaccion***
if(!$_GET['random']){
$_GET['random']=$_GET['rand'];
}


if($_GET['paqueteria'] or $_GET['paquete']){
$q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where

keySTC='".$myrowC['keySTC']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();
}





$sSQLCaR= "Select random From cargosCuentaPaciente where keyClientesInternos='".$_GET['nCuenta']."' and random='".$_GET['random']."'";
$resultCaR=mysql_db_query($basedatos,$sSQLCaR);
$myrowCaR = mysql_fetch_array($resultCaR);

if(!$myrowCaR['random']){ 
//**************NECESITO INCREMENTAR RECIBO AL HACER PAGO**************


if(!$myrow3['numRecibo']){
 $q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where

keySTC='".$myrowC['keySTC']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();
}




$sSQLCa= "Select numRecibo From statusCaja where keySTC='".$myrowC['keySTC']."'";
$resultCa=mysql_db_query($basedatos,$sSQLCa);
$myrowCa = mysql_fetch_array($resultCa);
$RECIBO=$myrowCa['numRecibo'];
//****************************************************************

if($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias'){

if($_GET['tipoPago']=='Otros'){

$q4 = "UPDATE clientesInternos set 
autoriza='".$usuario."',statusOtros='standby',responsableCuenta='".$_GET['responsableCuenta']."',
fechaVencimiento='".$_GET['fechaVencimiento']."',
numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',
statusDeposito='pagado',usuario='".$usuario."',fecha1='".$fecha1."'
WHERE keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();


$actualiza4 = "UPDATE cargosCuentaPaciente
set
status='otros',naturalezaCxC='C'
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and
status='particular'
";
mysql_db_query($basedatos,$actualiza4);
echo mysql_error();

echo '<script>';
echo 'window.alert("Se traslado el saldo a otros...");';
echo '</script>';
}else{
$q4 = "UPDATE clientesInternos set 
numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',statusDeposito='pagado',usuario='".$usuario."',fecha1='".$fecha1."'
WHERE keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();
}
}




//*********************actualiza el status de la caja***********************/
if($tipoPaciente=='externo'){
$q1 = "UPDATE cargosCuentaPaciente set 
statusCaja='pagado',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."'
WHERE 
status!='transaccion'
and
keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
//**************************************************

if($_GET['devolucion']=='si'){ 
$_GET['tipoPago']='Efectivo';
$sSQL341= "Select * From catTTCaja WHERE banderaDevolucionAbono = 'si'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];
$_GET['tt']=$myrow341['codigoTT'];
$_GET['devolucion']='no';//la devolucion de efectivo debe ser no es la devolucion en sala
$describe='Devolucion';
} else {
$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$_GET['tt']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];
}


if($naturaleza=='Abono'){
$cantidadParticular=$_GET['cantidadRecibida'];
$naturaleza='A';
} else if($naturaleza=='Cargo'){
$cantidadAseguradora=$_GET['cantidadRecibida'];
$naturaleza='C';
} else if($naturaleza=='Cuentas por Cobrar'){
$naturaleza='A';
}



if($_GET['tipoPago']=='Cuentas por Cobrar'){
$cantidadAseguradora=$_GET['cantidadRecibida'];
$cantidadParticular='';
} else {
$cantidadAseguradora='';
$cantidadParticular=$_GET['cantidadRecibida'];
}




//*********************COMPRUEBO EL CLIENTE PRINCIPAL*********************************************************
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
//************************************************************************************************************







//************************************ES UN PAQUETE*******************
if($myrow3['paquete']=='si'){

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['nCuenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$package=$myrow3['paquete'];




//***************************************
$sSQL317= "Select * From catTTCaja WHERE banderaPaquete = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,
tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,descripcion,almacenSolicitante,statusCaja,numRecibo,keyClientesInternos,folioVenta,codigoCaja,
ultimosDigitos,
telefono,bancoTC,bancoTransferencia,numeroTransferencia,numeroCheque,bancoCheque,precioVenta,random,codigoAutorizacion

) 
values 
('".$myrow3['numeroE']."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$myrow317['codigoTT']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$almacen."','".$usuario."',
'".$_GET['seguro']."','trasladado','particular','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$myrowC['numCorte']."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','cargado','".$_GET['porcentaje']."','".$_GET['cargosHospitalarios']."','".$almacen."','".$_GET['descripcion']."','".$almacen."','pagado','".$RECIBO."','".$myrow3['keyClientesInternos']."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."',
'".$_GET['ultimosDigitos']."','".$_GET['telefono']."','".$_GET['bancoTC']."','".$_GET['bancoTransferencia']."','".$_GET['numeroTransferencia']."','".$_GET['numeroCheque']."','".$_POST['bancoCheque']."','".$_GET['cantidadRecibida']."','".$_GET['random']."','".$_GET['codigoAutTC']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


//*****************************ACTUALIZA STATUS DE PAQUETE***********************
$actualiza = "UPDATE articulosPaquetesPacientes
set
folioVenta='".$myrow3['folioVenta']."',
status='standby',
keyClientesInternos='".$myrow3['keyClientesInternos']."'

WHERE 
entidad='".$entidad."'
and
numeroE='".$numeroE."'
and
status='request'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();


$actualiza = "UPDATE paquetesPacientes
set
status='activo',folioVenta='".$myrow3['folioVenta']."',
keyClientesInternos='".$myrow3['keyClientesInternos']."'

WHERE 
entidad='".$entidad."'
and
numeroE='".$numeroE."'
and
status='standby'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

$actualiza2 = "UPDATE almacenesPaquetes
set
status='standby'


WHERE 
keyClientesInternos='".$myrow3['keyClientesInternos']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();







//*******************SOLO SI NO ESTA PAGADO COMPLETAMENTE EL PAQUETE IMPRIMIR ESTO
$sSQLu= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE 
folioVenta='".$myrow3['folioVenta']."'
and
naturaleza='A'
";


$resultu=mysql_db_query($basedatos,$sSQLu);
$myrowu = mysql_fetch_array($resultu);

$sSQLus= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE 
folioVenta='".$myrow3['folioVenta']."'
and
naturaleza='C'
";


$resultus=mysql_db_query($basedatos,$sSQLus);
$myrowus = mysql_fetch_array($resultus);
$diferencia=$myrowus['acumulado']-$myrowu['acumulado'];


if($diferencia>0){
 $actualiza3 = "UPDATE clientesInternos
set
status='activa',
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."',
statusCaja='request',statusPaquete='standby'

WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();
?><script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosPAK.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>&folioVenta=<?php echo $myrow3['folioVenta'];?>');
window.opener.document.forms["form1"].submit();
</script>
<?php 
}else{
//*********************pagaron de 1 solo todo
$actualiza3 = "UPDATE clientesInternos
set
status='activa',
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."',
statusCaja='pagado'

WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();

}


} else { //no es un paquete











//***********************ENTRA SI TRAE ABONOS PARA LA PARTIDA DOBLE****
if($_GET['abono']=='si'){

if($myrow3['statusDeposito']=='pendiente'){ //SI NO SE HA DADO UN DEPOSITO AQUI ENTRA
$s= "Select codigoTT From catTTCaja WHERE banderaPxAC='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);



if(!$my['naturaleza']){
$my['naturaleza']='-';
}



$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTCdescripcion,descripcionArticulo) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','operacionCaja',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$_GET['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."','".$describe."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$actualiza4 = "UPDATE cargosCuentaPaciente
set
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."'



WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza4);
echo mysql_error();
} else { //SI ES UN ABONO AQUI ENTRA

$s= "Select codigoTT From catTTCaja WHERE banderaAPAb='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

if(!$my['naturaleza']){
$my['naturaleza']='-';
}

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','operacionCaja',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$_GET['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}//cierra abono

//************************CIERRA ABONOS******************************************


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$_GET['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}




//************************************************************************
//ESTE MODULO ACTUALIZA EL CODIGO DE LA CAJA, NUMERO DE RECIBO, NUMERO DE CORTE
if($_GET['tipoVenta']!='interno' and !$_GET['paqueteria'] and !$_GET['paquete']){



if($_GET['empleado'] and $_GET['numeroNomina']){ 
$actualiza3 = "UPDATE clientesInternos
set
status='activa',
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."',
statusCaja='pagado',
empleado='".$_GET['empleado']."',
numeroNomina='".$_GET['numeroNomina']."'


WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();
}else{
$actualiza3 = "UPDATE clientesInternos
set
status='activa',
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."',
statusCaja='pagado'
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();

}


$actualiza4 = "UPDATE cargosCuentaPaciente
set
codigoCaja='".$myrowC['keyCatC']."',
numRecibo='".$RECIBO."',
numCorte='".$myrowC['numCorte']."'
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza4);
echo mysql_error();
}
//**************************cierro actualizar recibos















if($_GET['devolucion']=='si'){
$sSQL333= "SELECT 
MAX(folioVenta)+1 as folioVentas
FROM clientesInternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 

$actualiza3s = "UPDATE clientesInternos
set
folioVenta='".$myrow333['folioVentas']."'

WHERE 
keyClientesInternos='".$_GET['nCuenta']."'

";
//mysql_db_query($basedatos,$actualiza3s);
echo mysql_error();

$q1 = "UPDATE cargosCuentaPaciente set 
folioVenta='".$myrow333['folioVentas']."'


WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
";
//mysql_db_query($basedatos,$q1);
echo mysql_error();

$q1a = "UPDATE cargosCuentaPaciente set 
folioDevolucion=1


WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and
naturaleza='A'
";
//mysql_db_query($basedatos,$q1a);
echo mysql_error();

}
?>

























<script>






<?php if($_GET['abono']=='si' or $_GET['tipoCliente']=='coaseguro'){ ?>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternos.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>');
window.opener.document.forms["form1"].submit();

<?php } else if($_GET['tipoVenta']=='interno'){ ?>



<?php }else { ?>

window.opener.document.forms["form1"].submit();

<?php } ?>
//window.alert("AQUI");
window.close();
</script>






<?php 
} else {
//cierra random 
//echo 'No se permite refrescar pantalla..!'; 
?>
<script>
window.alert("Sólo se permite una transacción por vez...!");
</script>
<?php 
}

}
//*************************************************
?>








<?php

if($_GET['tipoTransaccion'] and $_GET['aplicarPago']){  ?>
<script>
window.opener.document.forms["form1"].submit();
</script>
<?php 
}
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
.style8 {
	color: #0000FF;
	font-weight: bold;
}
.style12 {font-size: 10px}
.Estilo26 {color: #FFFFFF}
.Estilo27 {font-size: 10px; color: #FFFFFF; }
.Estilo29 {font-size: 10px; font-weight: bold; }
.Estilo33 {font-size: 10px; color: #000000; }
.style15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.style16 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style17 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style18 {font-size: 10px; color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style19 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style20 {font-size: 10px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style22 {font-size: 12px; font-weight: bold; }
-->
</style>
</head>

<body>
<p align="center"><?php print 'Paciente: '.$myrow3['paciente'];?></p>











<form id="form1" name="form1" method="GET"  >
  <table width="469" height="415" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo24">
    <tr bgcolor="#990033" align="center">
      <td width="465" height="23"><p class="style15"><font color="#FFFFFF">Totales</font></p>
      </td>
    </tr>
    
    <?php 
//*********************COMPRUEBO EL CLIENTE PRINCIPAL*********************************************************
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$sSQL455= "Select cargoNomina from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
//************************************************************************************************************
?>
    
    
    <tr bgcolor="#990033">
      <td bgcolor="#FFFFFF">
      
      
      <table width="99%" height="394" border="0" cellpadding="4" cellspacing="0">
          <tr bgcolor="#FFFFFF">
            <td width="25%" class="style16">Tipo Pago/Cr&eacute;dito </td>
            <td width="75%" class="style16">
		

        
        
		<?php if($_GET['modoPago']=='efectivo'){ ?>


         			<select name="tipoPago" class="style20" id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>
                <option
				 <?php if($_GET['tipoPago']=='Efectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
				<option
				 <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta de Credito">Tarjeta de Credito</option>
				<option
				<?php if($_GET['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
                        <option 
                 
				<?php if($_GET['tipoPago']=='Nomina'){ ?>
				 selected="selected"
				 <?php } ?>
				value="Nomina">Nomina</option>		
            </select>  
             <?php }else if($_GET['modoPago']=='cxc'){ ?>
            
            <select name="tipoPago" class="style20" id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>


				<option 
				<?php if($_GET['tipoPago']=='Cuentas por Cobrar' ){ ?>
				 selected="selected"
				 <?php } ?>
				value="Cuentas por Cobrar">Cuentas por Cobrar</option>
                
				
        
                 <option 
                 
				<?php if($_GET['tipoPago']=='Nomina'){ ?>
				 selected="selected"
				 <?php } ?>
				value="Nomina">Nomina</option>				

            </select>   
            
             
			<?php }?>			</td>
          </tr>
          
          
          
          
          
          
          
          
<?php if($_GET['tipoPago'] AND $_GET['tipoVenta']=='interno' and !$_GET['abono']){ //SOLO ALTA DE PACIENTES INTERNOS?>
<?php 
$sSQL3a= "SELECT 
count(*) as tt
FROM catTTCaja
WHERE 
tipoCliente='".$_GET['tipoTransaccion']."'
";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a); 

?>
		  
          
          <?php if($myrow3a['tt']>1){ $TP=1;?>
          <tr class="Estilo24">
            <td bgcolor="#FFFFFF" class="cargos">Tipo Transacci&oacute;n</td>
            <td bgcolor="#FFFFFF"><?php 

		
$sqlNombre11 = "SELECT * from catTTCaja 
where 
tipoCliente='".$_GET['tipoTransaccion']."'
and
tipoPago='".$_GET['tipoPago']."'


";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);
?>
  <select name="transaccion" class="Estilo24" id="transaccion" onChange="javascript:form.submit();" />  
<option value="">Escoje el Tipo de Transacción</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($_GET['transaccion']==$rNombre11["codigoTT"])echo 'selected'; ?>
   value="<?php echo $rNombre11["codigoTT"];?>"> <?php echo $rNombre11["descripcion"];?></option>
  <?php } ?>
</select></td>
          </tr>
            <?php }else{
	$sSQL3ac1= "SELECT 
codigoTT
FROM catTTCaja
WHERE 
tipoCliente='".$_GET['tipoTransaccion']."'
";
$result3ac1=mysql_db_query($basedatos,$sSQL3ac1);
$myrow3ac1 = mysql_fetch_array($result3ac1); 
		$_GET['transaccion']=$myrow3ac1['codigoTT'];
			$TP=NULL;}} ?>
          
          
          
          
          
          
          
          <?php if($_GET['tipoPago']=='Cheque'){ ?>
          <tr class="Estilo24">
            <td bgcolor="#FFFFFF" class="cargos"> N&uacute;mero Cheque </td>
            <td bgcolor="#FFFFFF"><input name="numeroCheque" type="text" class="style7" id="numeroCheque" value="" /></td>
          </tr>
          <tr class="Estilo24">
            <td class="cargos">Banco Cheque</td>
            <td class="Estilo24"><span class="style12">
              <input name="bancoCheque" type="text" class="style7" id="bancoCheque" value="" size="50" />
            </span></td>
          </tr>
		  <?php } ?>
		  
		  				 <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
          <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF" class="style16">Banco Tarjeta</td>
            <td bgcolor="#FFFFFF" class="Estilo24"><input name="bancoTC" type="text" class="style7" value="<?php echo $_GET['bancoTC'];?>"  /></td>
          </tr>
	
		  
          <tr bgcolor="#FFFFFF">
            <td class="style16">Tel&eacute;fono</td>
            <td class="Estilo24"><input name="telefono" type="text" class="style7" value="<?php echo $_GET['telefono'];?>" /></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td class="style16">&Uacute;ltimos 4 D&iacute;gitos</td>
            <td class="Estilo24"><span class="style19">
              <label>
              <input name="ultimosDigitos" type="text" class="style7" id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onKeyPress="return checkIt(event)"/>
              </label>
            </span></td>
          </tr>	 
		  
          <tr bgcolor="#FFFFFF">
            <td class="style16">C&oacute;digo de Aut. </td>
            <td class="Estilo24"><span class="style19">
              <label>
              <input name="codigoAutTC" type="text" class="style7" id="codigoAutTC" value="<?php echo $_GET['codigoAutTC']; ?>" />
              </label>
            </span></td>
          </tr>
		    <?php } ?>
			
			
			
			

			
			
           <?php if($myrow455['cargoNomina']=='si' and $_GET['tipoPago']=='Nomina'){ //solamente se da de alta?>
           <tr bgcolor="#FFFFFF">
              <td class="Estilo29">Nombre del Empleado: </td>
              <td class="Estilo24"><label>
                <input name="empleado" type="text" class="Estilo24" id="textfield" value="<?php echo $myrow3['empleado'];?>" size="50" />
              </label></td>
            </tr>
            
            <tr bgcolor="#FFFFFF">
              <td class="Estilo29"># N&oacute;mina:</td>
              <td class="Estilo24"><input name="numeroNomina" type="text" class="Estilo24" id="numeroNomina" value="<?php echo $myrow3['credencial'];?>" /></td>
            </tr>
            <?php } ?>
            
            
            
            
            
            <?php if($_GET['tipoPago']=='Otros'){ ?>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo29">&nbsp;</td>
              <td class="Estilo24">&nbsp;</td>
            </tr>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo29">Titular (Responsable)</td>
              <td class="Estilo24"><label>
                <input name="responsableCuenta" type="text" class="Estilo24" id="responsableCuenta" size="50" />
              </label></td>
            </tr>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo29">Fecha Vencimiento</td>
              <td class="Estilo24"><span class="titulo">
                <label>
                <input name="fechaVencimiento" type="text" class="style12" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
                </label>
                <input name="button" type="button" class="style12" id="lanzador" value="..." />
              </span></td>
            </tr>
            
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
    </script> 
            <tr bgcolor="#FFFFFF">
              <td class="Estilo29">&nbsp;</td>
              <td class="Estilo24">&nbsp;</td>
            </tr>
            <?php } ?>
            
            
            
            
            
            
            
            
            
   

		    
		  
		  
		  
		  
		  
		  
		  
		  
          <tr bgcolor="#FFFFFF">

            <td height="27" class="Estilo24">&nbsp;</td>
      
            <td bgcolor="#FFFFFF" class="Estilo24"><span class="style16">
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			

			
		
				
				
<?php 

	
if($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias'){
//DEPOSITO x APERTURA







if($_GET['abono']=='si'){ 
$sSQL31a= "Select deposito From clientesInternos WHERE keyClientesInternos = '".$_GET['nCuenta']."' and statusDeposito='pendiente'";
$result31a=mysql_db_query($basedatos,$sSQL31a);
$myrow31a =mysql_fetch_array($result31a);
$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaEfectivo='si'";




} else { 



//pESTE SOLO ES para AlTa de PaCientEs
     
		$sSQL3471= "Select codigoTT From catTTCaja WHERE codigoTT='".$_GET['transaccion']."'";
        if($_GET['tipoTransaccion']=='particular'){ 
		
		if($_GET['tipoPago']=='Otros'){
		$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaPagoCxC='si'";
//		$valor=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$_GET['nCuenta']);

		} else{
//		$valor=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$_GET['nCuenta']);

		}
		
		} else if($_GET['tipoTransaccion']=='coaseguro'){ 
		//$valor=$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nCuenta']);

		} else if($_GET['tipoTransaccion']=='aseguradora'){ 
//		$valor=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nCuenta']);
		
		}
		
		
		
		
		
		
		}
//cierra alli
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

		
} else {		 //tipo de paciente externo
		

if($myrow3['paquete']=='si'){

$sSQL3471="Select * From catTTCaja WHERE banderaPaquete = 'si'";
//***************EFECTUO VARIOS PASOS*******************

$sSQL17u= "
	SELECT 
seguro

FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
";
$result17u=mysql_db_query($basedatos,$sSQL17u);
$myrow17u = mysql_fetch_array($result17u);


//**************************PUEDE TENER SEGURO
/* if($myrow17u['seguro'] and $myrow17['seguro']!='0'){
$sSQL17= "
	SELECT 
SUM((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and
naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


$sSQL17a= "
	SELECT 
SUM((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and 
naturaleza='A'

";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
}else{

$sSQL17= "
	SELECT 
SUM((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and
naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


$sSQL17a= "
	SELECT 
SUM((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['nCuenta']."'
and 
naturaleza='A'

";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);


}
//*********************************************************
 */



//$valor=round($myrow17['sumaAcumulado']-$myrow17a['sumaAcumulado'],2);


 
 

//*******************************************************
} else { //NO ES PAQUETE		


//****************ESTE CONVENIO SOLO SE PAGA EN EFECTIVO?************
$sSQL31ab= "Select pagoEfectivo From clientes WHERE numCliente='".$seguro."'";
$result31ab=mysql_db_query($basedatos,$sSQL31ab);
$myrow31ab =mysql_fetch_array($result31ab);

//******************************************************************


	
if($seguro and $myrow31ab['pagoEfectivo']==''){ 

		
				 if($_GET['tipoPago']=='Cuentas por Cobrar'){  
				
				 $sSQL3471= "Select codigoTT From catTTCaja WHERE banderaCredito='si'";
				 
				 

				 //trae convenio?*************
					if($convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['nCuenta'])){ 
					//				    $valor=$convenioAseguradora->convenioAseguradora($basedatos,$usuario,$_GET['nCuenta']);
							
				    } else  { 
					//*********si trae seguro pero no convenioe
					
					//$valor=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nCuenta']);
					//NO TRAE CONVENIO
							
					}
					
					
					
					
				  
				 //****************************
				 
				 
				 
				
 } else if( $_GET['tipoPago']=='Efectivo' or $_GET['tipoPago']=='Nomina' or  $_GET['tipoPago']=='Cheque' or $_GET['tipoPago']=='Tarjeta de Credito'){ 
				 	//si
				 $sSQL3471= "Select codigoTT FROM catTTCaja WHERE banderaEfectivo='si'";
				 //$valor=$convenioParticularCC->convenioParticularCC($basedatos,$usuario,$_GET['nCuenta']);
						
				 }
	
		
		} else { //NO TRAE SEGURO
		  
				if($_GET['devolucion']=='si'){ //es por devolución  
				$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaDevolucionAbono='si'";
				//$valor=$dev->devoluciones($basedatos,$_GET['nCuenta']); 
						
		} else { 
				

				if($_GET['tipoPago']=='Cortesia'){
				$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaCortesia='si'";
				//$valor=$cargosCortesia->cargosCortesia($basedatos,$usuario,$_GET['nCuenta']);
				
						$valor=$_GET['precioVenta'];
				} else { //no es una nota de devolución
				
				if($myrow31ab['pagoEfectivo']=='si'){ 
				//tiene convenio pero paga en efectivo 
				
				$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaEfectivo='si'";
				
					if($_GET['tipoPago']=='Efectivo'){ //trae un convenio especial
					
					//$valor=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
						
					}	else{
					//$valor=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nCuenta']);
							
					}
				//$valor=$cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta);
				} else { 
				//$valor=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nCuenta']);
				//hay q configurar para credencial
				
				$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaEfectivo='si'";				
				//$valor=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
					
				}
				
				}
				
				
				
				}
		}//termina validacion de devolución	
		
		}//CIERRA VALIDACION DE PAQUETE	
        
				
				
				
				}//es externo				//cierra externo
				
				
				if(($_GET['precioVenta'] and $_GET['tipoPago']) or ($myrow3['tipoPaciente']=='interno') or $_GET['devolucion']=='si'){
				
				$result3471=mysql_db_query($basedatos,$sSQL3471);
				$myrow3471 = mysql_fetch_array($result3471);
				 $transaccion=$myrow3471['codigoTT'];
				}
				

				
				
				?>
			 
<?php //ESTA ES LA CANTIDAD 


if($_GET['tipoPago']) {  ?>
               
               
        <?php 
		if($_GET['devolucion']=='si'){
		//echo '<blink>'.'Debe llevar el signo negativo la cantidad'.'</blink>';
		if($valor<0){
		$valor*=-1;
		}
		}
		?>

<input name="cantidadRecibida" type="text" class="style15" id="cantidadRecibida" value="<?php echo $_GET['precioVenta'];?>" autocomplete="off"  style="background-color:#FFFF00"/>


  <input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value="<?php echo $transaccion;?>"   readonly="" />			 
			 
		 
			 
              <input name="TOTAL" type="hidden" class="style7" id="TOTAL" value="<?php echo $TOTAL;?>"/>
              <input name="numeroE" type="hidden" class="style7" id="numeroE" value="<?php echo $_GET['numeroE'];?>"/>
              <input name="naturaleza" type="hidden" class="style7" id="naturaleza" value="<?php echo $myrow31['naturaleza'];?>"/>
              <label>              </label>
        
            </span></td>
            
            <?php } ?>
          </tr>

		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  

		  
		  
		  
		  
		  
		  
		  
		  
		  
		  

		  
      </table>
      
      </td>
    </tr>
  </table>
  
<label>
    <div align="center">
  <span class="Estilo24">
      <input name="depositos" type="hidden" class="style7" id="depositos" value="<?php echo $depositos; ?>"/>
  </span>
      <span class="Estilo24">
      <input name="nCuenta" type="hidden" class="style7" id="nCuenta" value="<?php echo $numeroCuenta; ?>"/>
      <span class="style12">
      <input name="tipoCliente" type="hidden" class="style7" id="tipoCliente" value="<?php echo $_GET['tipoCliente']; ?>"/>
      </span> </span>
      <span class="style12">
      <input name="almacenFuente" type="hidden" class="style7" id="almacenFuente" value="<?php echo $_GET['almacenFuente']; ?>"/>
      </span>
      <span class="style12">
      <input name="almacen" type="hidden" class="style7" id="almacen" value="<?php echo $almacenFuente; ?>"/>
      </span>
      
      
      
      
      
      
      
      
     <?php if( $_GET['tipoPago']){ ?>
      
      
      <div align="center">
      <p>
	<?php if(!$_GET['aplicarPago']){ ?>
		
	<?php 
			if($_GET['tipoPago']=='Cuentas por Cobrar' or $_GET['tipoPago']=='Nomina'){ ?>
          <input name="aplicarPago" type="image" src="../../imagenes/btns/traslatebtn.png"  id="aplicarPago" value="Trasladar Saldos"  />
	<?php } else { ?>
          <input name="aplicarPago" type="image" src="../../imagenes/btns/aplicapay.png" id="aplicarPago" value="Aplicar Pago" /> 
	<?php } ?>
		  
	<?php } ?>
		  
		  
		  
        </p>
        <p>
		<?php if($_GET['aplicarPago']){ ?>
          <label> <br />
          <br />
          <input name="Submit" type="image"  src="../../imagenes/btns/close.png" value="Cerrar (X)" 	onclick="javascript:cerrar();" />
          </label>
</p>
        <?php } ?>
  </div>
        <?php } ?>
  
  </label>
    <p align="center"><span class="style8">
      <?php if($_GET['cantidadRecibida'] and $myrow2['statusDeposito']=='pagado'){  //onclick="javascript:cerrar();"?>
    Devolver: </span><span class="style8"><?php echo "$ ".number_format($devolucion,2);?></span>
      <?php } ?>
    <span class="Estilo24">    </span><span class="style12">
	<input name="devolucion" type="hidden" class="style7" id="tipoVenta" value="<?php echo $_GET['devolucion']; ?>"/>
    
    <input name="tipoVenta" type="hidden" class="style7" id="tipoVenta" value="<?php echo $_GET['tipoVenta']; ?>"/>
    </span><span class="style12">
    <input name="tipoMovimiento" type="hidden" class="style7" id="tipoMovimiento" value="<?php echo $_GET['tipoMovimiento']; ?>"/>
    </span><span class="style12">
    <input name="paqueteria" type="hidden" class="style7" id="paqueteria" value="<?php echo $_GET['paquete']; ?>"/>
    </span></p>
  
  
  <?php if( $_GET['rand']){ ?>
    <input name="random" type="hidden" class="style7" id="random" value="<?php echo $_GET['rand']; ?>"/>
    <?php } else if($_GET['random']){ ?>
    <input name="random" type="hidden" class="style7" id="random" value="<?php echo $_GET['random']; ?>"/>
    <?php } ?>
    
      <?php if( $_GET['tipoTransaccion']){ ?>
    <input name="tipoTransaccion" type="hidden" class="style7" id="tipoTransaccion" value="<?php echo $_GET['tipoTransaccion']; ?>"/>
    <?php }  ?>
    

    
    <input name="tt" type="hidden" class="style7" id="tipoTransaccion" value="<?php echo $transaccion; ?>"/>

         <?php if( $_GET['abono']){ ?>
    <input name="abono" type="hidden" class="style7" id="random" value="si"/>
    <?php }  ?>
    
	
	<input name="precioVenta" type="hidden" class="style7" id="precioVenta" value="<?php echo $_GET['precioVenta'];?>"/>
		<input name="modoPago" type="hidden" class="style7" id="precioVenta" value="<?php echo $_GET['modoPago'];?>"/>
		<input name="transaccion" type="hidden" class="style7" id="precioVenta" value="<?php echo $_GET['transaccion'];?>"/>
</form>
<p>&nbsp;</p>

</body>
</html>
<?php 

} else {
echo 'La Caja está cerrada';
echo '<script >
window.alert( "LA CAJA ESTA CERRADA!");
</script>';
}
?>

  <?php } else {
echo 'La Caja está cerrada';
echo '<script >
window.alert( "LA CAJA ESTA CERRADA!");
</script>';
}
?>

