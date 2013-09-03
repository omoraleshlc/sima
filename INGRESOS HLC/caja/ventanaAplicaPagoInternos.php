<?php require("/configuracion/ventanasEmergentes.php"); ?><?php require("/configuracion/clases/eCuentaGrafico.php"); ?>
<?php require("/configuracion/funciones.php"); ?>
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
        status = "Este campo solo acepta numeros."
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
                alert("Escoje el Tipo de Transaccion que desees hacer!")
                return false
        }  else if( vacio(F.cantidadRecibida.value) == false ) {
                alert("Escribe la cantidad!")
                return false
        }


}

</script>
<?php





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


if(($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias') and $myrow3['statusCuenta']!='caja'){
  
    if($_GET['abono']!='si' and $_GET['modoPago']!=devolucionParticular and $_GET['modoPago']!=devolucionAseguradora){
    echo '<script>';
    echo 'window.alert("LO SENTIMOS, LA CUENTA YA NO ESTA EN CAJA!, IMPOSIBLE HACER TRANSACCIONES");';
    echo 'window.close();';
    echo '</script>';
    }
}














$typePx=$myrow3['tipoPaciente'];

if($numeroCuenta){


$tipoPaciente=$myrow3['tipoPaciente'];
$tipoTrans=$myrow3['tipoTransaccion'];
$compania=$myrow3['seguro'];


//*****************************Verificando caja abierta**************************
  $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta' ){ //*******************Comienzo la validaci�n*****************




















$numCorte=$myrowC['numCorte'];

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nCuenta']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$ass=$myrow3['seguro'];

if($_GET['tipoPago']=='Cuentas por Cobrar'){
$seguro=$myrow3['seguro'];
}else if($_GET['modoPago']=='devolucionAseguradora'){
$seguro=$myrow3['seguro'];    
}




$package=$myrow3['paquete'];







$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$tipoPaciente=$myrow3['tipoPaciente'];
//***************aplicar pago**********************








if($_GET['transaccion']!='' and $_GET['aplicarPago'] ){ ////////////////////////EFECTUAR TRANSACCION



//**************************ABONO SOLAMENTE REGISTRA LA TRANSACCION********************************









//*************************GENERAR NUMERO DE TRANSACCION***********************
if($_GET['abono']=='si' or $tipoPaciente='interno' or $tipoPaciente='urgencias'){
// $sSQL333a= "SELECT
//MAX(keyCVI)+1 as CVI
//FROM contadorVentasInternas
//WHERE entidad='".$entidad."'   ";
//
//$result333a=mysql_db_query($basedatos,$sSQL333a);
//$myrow333a = mysql_fetch_array($result333a);
//
//if(!$myrow333a['CVI']){
//$myrow333a['CVI']=1;
//}

//********************************SE INCREMENTA EN 1*****************************

//$agrega = "INSERT INTO contadorVentasInternas (
//usuario,entidad
//) values (
//'".$usuario."','".$entidad."'
//)";
//mysql_db_query($basedatos,$agrega);
//echo mysql_error();
//
//$agrega1 = "INSERT INTO transaccionesVentas (
//numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
//) values (
//'".$myrow333a['CVI']."','".$myrow['keyCAP']."','".$myrow['cantidad']."','Abono a Cuenta','".$myrow['precioVenta']."','".$myrow['iva']."','".$myrow['cantidadParticular']."',
//'".$myrow['ivaParticular']."','".$myrow['cantidadAseguradora']."','".$myrow['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$_GET['nCuenta']."',
//'".$myrow3['folioVenta']."','".$myrow['almacen']."','standby'
//)";
//mysql_db_query($basedatos,$agrega1);
//echo mysql_error();

//***************************************************
}

//*********************************************************************************************************
















if($_GET['cantidadRecibida']>0){





//**************************************************
if($myrow3['tipoPaciente']=='externo'){
$agrega = "INSERT INTO transacciones (
folioVenta,usuario,fecha,hora,keyCatC,entidad,status)
values ('".$myrow3['folioVenta']."','".$usuario."','".$fecha1."','".$hora1."','".$myrowC['keyCatC']."' ,'".$entidad."' ,'standby' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//******************************************************








if($_GET['descuento'] or $_GET['statusDescuento']=='si'){
$statusDescuento='si';
}



//**********************TIPO CLIENTE**********************
if($_GET['tipoPago']=='Nomina' or $_GET['tipoPago']=='Cuentas por Cobrar'){
$_GET['tipoCliente']='aseguradora';
}


//********************************************************














//********************solo 1 transaccion***
if(!$_GET['random']){
$_GET['random']=$_GET['rand'];
}
































$sSQLCaR= "Select random From cargosCuentaPaciente where keyClientesInternos='".$_GET['nCuenta']."' and random='".$_GET['random']."'";
$resultCaR=mysql_db_query($basedatos,$sSQLCaR);
$myrowCaR = mysql_fetch_array($resultCaR);

if(!$myrowCaR['random'] or $_GET['abono']=='si'){
//**************NECESITO INCREMENTAR RECIBO AL HACER PAGO**************





















if(($myrow3['tipoPaciente']=='externo' and !$myrow3['numRecibo']) or $myrow3['tipoPaciente']!='externo'){
 $q = "UPDATE statusCaja set
numRecibo= numRecibo+1
where

keySTC='".$myrowC['keySTC']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();
}






//***********************ASIGNARA NUMERO DE RECIBO
$sSQLCa= "Select numRecibo From statusCaja where keySTC='".$myrowC['keySTC']."'";
$resultCa=mysql_db_query($basedatos,$sSQLCa);
$myrowCa = mysql_fetch_array($resultCa);
if($myrow3['tipoPaciente']=='externo' and $myrow3['numRecibo']){
$RECIBO=$myrow3['numRecibo'];
}else{
$RECIBO=$myrowCa['numRecibo'];
}
//****************************************************************


if($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias' ){


$q4 = "UPDATE clientesInternos set beneficencia='".$_GET['beneficencia']."',statusDeposito='pagado',usuario='".$usuario."',fecha1='".$fecha1."',numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."'
WHERE keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();

}




//********************TRASLADO A OTROS****
if($_GET['tipoPago']=='Otros'){

$q4 = "UPDATE clientesInternos set numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',
autoriza='".$usuario."',statusOtros='standby',responsableCuenta='".$_GET['responsableCuenta']."',
fechaVencimiento='".$_GET['fechaVencimiento']."',
statusDeposito='pagado',usuario='".$usuario."',fecha1='".$fecha1."'
WHERE keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();
}
//*******************


//**************************************************


$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$_GET['tt']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];
$describe=$myrow341['descripcion'];


if($myrow341['coaseguro1']=='si' or  $myrow341['coaseguro2'] or $myrow341['deducible1']	or $myrow341['deducible2']){
$coa='si';
$myrow341['tipoCliente']='coaseguro';
}else{
$coa=NULL;
}




//*************************MOVIMIENTOS SOLAMENTE***************************
if($_GET['tipoPago']=='Cuentas por Cobrar' or $_GET['tipoPago']=='Nomina' or $_GET['tipoPago']=='Otros'){
$natMov='C';

}else{

$natMov='';
}


if($_GET['modoPago']=='devolucionAseguradora' || $_GET['modoPago']=='regresoAseguradora' or $_GET['modoPago']=='regresoAseguradora'){
$natMov='A';
$tipoCuenta='H';
}else{
$tipoCuenta='D';
}
//*******************************************************************************1





if($_GET['seguro']){
    $seguro=$_GET['seguro'];
$seguroFacturacion=$_GET['seguro'];
$_GET['descripcionSeguroFacturacion']=$_GET['nomSeguro'];
$_GET['facturacionEspecial']='si';
$facturacionEspecial='si';
$naturaleza='A';

$q4 = "UPDATE clientesInternos set facturacionEspecial='si'
WHERE keyClientesInternos='".$_GET['nCuenta']."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();

}




if($_GET['statusBeneficencia']!='si'){
if(($_GET['tipoPago']=='Cuentas por Cobrar' || $_GET['tipoPago']=='devolucionAseguradora' || $_GET['modoPago']=='regresoAseguradora')  or ($coa!=NULL) ){
//echo '<script>
//window.alert("BRAKE");
//</script>';
$cantidadAseguradora=$_GET['cantidadRecibida'];
$cantidadParticular='';

} else {

$cantidadAseguradora='';
$cantidadParticular=$_GET['cantidadRecibida'];
}
}
















//*********************COMPRUEBO EL CLIENTE PRINCIPAL*********************************************************
if($_GET['tipoPago']=='Otros'){

$myrow455['clientePrincipal']=$_GET['seguro'];
}else{
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
}
//************************************************************************************************************



//******************solo descuentos****
if($_GET['descuento']){
if($_GET['descuento']=='particular'){
$cantidadParticular=$_GET['cantidadRecibida'];
$cantidadAseguradora='';
}else{
$cantidadAseguradora=$_GET['cantidadRecibida'];
$cantidadParticular='';
}
}
//*************************






//*************TIPOPAGO TRANSFERNCIA**************

if($_GET['tipoPago']=='Transferencia'){
$_GET['tipoPago']='Transferencia Electronica';
}

//*****************************************************


    if($_GET['activaBeneficencia']=='si' || $_GET['statusBeneficencia']=='si'){
        $q4a = "UPDATE clientesInternos set
        activarBeneficencia=''
        WHERE keyClientesInternos='".$numeroCuenta."'";
mysql_db_query($basedatos,$q4a);
echo mysql_error();

        if($_GET['caso']==1){
        $cantidadParticular=$_GET['cantidadRecibida'];  
        
        }else{
        $cantidadBeneficencia=$_GET['cantidadRecibida'];
        }}




//**********************ES UN PAQUETE*******************
if($myrow3['paquete']=='si'){

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['nCuenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$package=$myrow3['paquete'];




//***************************************
$sSQL317= "Select * From catTTCaja WHERE

banderaPaquete = 'si'   ";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,
statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcionArticulo,
tipoCuenta,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,
fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento,cantidadBeneficencia,ivaBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby',
'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."' ,'".$describe."','".$tipoCuenta."'  ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."'   ,'".$seguroFacturacion."'   ,
    '".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."','".$_GET['statusBeneficencia']."',
        '".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ,'".$cantidadBeneficencia."','".$ivaBeneficencia."') ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();







//**************************************PARTIDA DOBLE EN MOVIMIENTOS******************************************
//DEBE SER UN CARGO A LA CAJA CON CREDITO AL ALMACEN







if($natMov){

$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,
statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcionArticulo,
tipoCuenta,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,
descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento,cantidadBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby',
'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."' ,'".$describe."','".$tipoCuenta."' ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//***************************************************************************************************************







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


 $actualiza3 = "UPDATE clientesInternos
set
status='activa',numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',
statusCaja='request',statusPaquete='standby'

WHERE
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();


/* $actualiza3 = "UPDATE clientesInternos
set
status='activa',numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',
statusCaja='pagado'

WHERE
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error(); */




} else { //no es un paquete










//***********************ENTRA SI TRAE ABONOS PARA LA PARTIDA DOBLE****
if($_GET['abono']=='si'){

if($myrow3['statusDeposito']=='pendiente'){ //SI NO SE HA DADO UN DEPOSITO AQUI ENTRA
$s= "Select codigoTT From catTTCaja WHERE banderaPxAC='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);



if(!$my['naturaleza']){
//$my['naturaleza']='-';
}



$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTCdescripcion,descripcionArticulo,
tipoCuenta,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,
beneficencia,statusBeneficencia,statusCortesia,numMovimiento,cantidadBeneficencia,ivaBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','operacionCaja',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."'','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."',
'".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."',
'".$_GET['bancoTC']."','".$describe."','".$describe."','".$tipoCuenta."'  ,'".$statusDescuento."'  ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,
    '".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,
        '".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ,'".$cantidadBeneficencia."','".$ivaBeneficencia."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();





//****************************************PARTIDA DOBLE*************************************
if($natMov){
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,
random,codigoAutorizacion,ultimosDigitos,bancoTCdescripcion,descripcionArticulo,tipoCuenta,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransacccion,beneficencia,statusBeneficencia,statusCortesia,
numMovimiento)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."'','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."',
'".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."',
'".$_GET['bancoTC']."','".$describe."','".$describe."','".$tipoCuenta."'  ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'   ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."','".$myrow333a['CVI']."'   )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//*************************************************


} else { //SI NOO UN ABONO AQUI ENTRA



//******************************SOLAMENTE DEBE FUNCIONAR CON LA PARTIDA DOBLE****************************


if($natMov){
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,
keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,
bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,
numMovimiento,tipoCuenta)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']." ','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby','".$_GET['tipoPago']."',
'".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."',
'".$myrow455['clientePrincipal']."','".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."',
'".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."' ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ,
'".$tipoCuenta."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//*********************************************************************************************************


}
}//cierra abono

//************************CIERRA ABONOS******************************************











if(($_GET['modoPago']=='devolucionParticular' or $_GET['modoPago']=='devolucionAseguradora') || ($_GET['modoPago']=='regresoParticular' or $_GET['modoPago']=='regresoAseguradora')){
//




if($_GET['modoPago']=='regresoParticular' or $_GET['modoPago']=='regresoAseguradora'){ //REGRESO EFECTIVO


 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,
tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,
statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,
bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,
descripcionArticulo,tipoCuenta,statusRegreso,statusDescuento,facturacionEspecial,responsableCuenta,
descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,
beneficencia,statusBeneficencia,statusCortesia,numMovimiento,cantidadBeneficencia,ivaBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby',
    '".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."',
    'pagado','".$_GET['telefono']."','".$cP."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."',
    '".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."' ,
        'si','".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,
    '".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,
        '".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ,'".$cantidadBeneficencia."','".$ivaBeneficencia."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//******************************PARTIDA DOBLE**********************************


if($natMov){
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,
ultimosDigitos,bancoTC,descripcionArticulo,tipoCuenta,statusRegreso,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby','".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."'  ,'si' ,'".$statusDescuento."'  ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."'  ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ) ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}


}else{
 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,
descripcionArticulo,tipoCuenta,statusDevolucion,statusDescuento,facturacionEspecial,
responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento,
cantidadBeneficencia,ivaBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby','".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."' ,'si' ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,
    '".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,
        '".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."','".$cantidadBeneficencia."','".$ivaBeneficencia."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//******************************PARTIDA DOBLE**********************************


if($natMov){
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcionArticulo,tipoCuenta,statusDevolucion,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby','".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."'  ,'si' ,'".$statusDescuento."','".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."'  ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ) ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}




}else{




$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,
numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,
keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,
telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,
random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcionArticulo,tipoCuenta,statusDescuento,
facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,
descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,
numMovimiento,cantidadBeneficencia,ivaBeneficencia)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."',
    'standby','".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."',
    'pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."',
    '".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."'  ,
        '".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."'  ,
    '".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."'  ,'".$_GET['beneficencia']."' ,
        '".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."' ,'".$cantidadBeneficencia."','".$ivaBeneficencia."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//******************************PARTIDA DOBLE**********************************


if($natMov){
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,
descripcionArticulo,tipoCuenta,statusDescuento,facturacionEspecial,responsableCuenta,descripcionSeguroFacturacion,seguroFacturacion,fechaVencimiento,descripcionTransaccion,beneficencia,statusBeneficencia,statusCortesia,numMovimiento)
values
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tt']."','operacionCaja',
'".$hora1."','".$natMov."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$seguro."','".$statusTraslado."','".$myrow341['tipoCliente']."','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby','".$_GET['tipoPago']."','".$ALMACEN."',
'".$numeroCuenta."','standby','cargado','standby','".$RECIBO."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."','".$myrow455['clientePrincipal']."',
'".$_GET['cantidadRecibida']."','".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."','".$_GET['bancoTC']."','".$describe."' ,'".$tipoCuenta."' ,'".$statusDescuento."' ,'".$_GET['facturacionEspecial']."',
'".$_GET['responsableCuenta']."', '".$_GET['descripcionSeguroFacturacion']."' ,'".$seguroFacturacion."' ,'".$_GET['fechaVencimiento']."' ,'".$_GET['descripcionTransaccion']."' ,'".$_GET['beneficencia']."' ,'".$_GET['statusBeneficencia']."','".$_GET['statusCortesia']."' ,'".$myrow333a['CVI']."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}
//******************************************************************



//************************************************************************
//ESTE MODULO ACTUALIZA EL CODIGO DE LA CAJA, NUMERO DE RECIBO, NUMERO DE CORTE



if($_GET['empleado'] and $_GET['numeroNomina']){
$actualiza3 = "UPDATE clientesInternos
set
status='activa',numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',

empleado='".$_GET['empleado']."',
numeroNomina='".$_GET['numeroNomina']."'


WHERE
keyClientesInternos='".$_GET['nCuenta']."'";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();

}else{


$actualiza3 = "UPDATE clientesInternos
set
status='activa',numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."'
WHERE
keyClientesInternos='".$_GET['nCuenta']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();

}
















?>

























<script>






<?php if( !$_GET['descuento'] and (($myrow3 ['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias') or ($_GET['tipoTransaccion']=='coaseguro' or $_GET['tipoVenta']=='interno' or $_GET['abono']=='si' or $_GET['devolucion']=='si'))){ ?>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternos.php?folioVenta=<?php echo $myrow3['folioVenta']; ?>&entidad=<?php echo $entidad; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>');
window.opener.document.forms["form1"].submit();


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
window.alert("Solo se permite una transaccion por vez...!");
</script>
<?php
}?>






<?php
} else {

//cierra random
//echo 'No se permite refrescar pantalla..!';
?>
<script>
window.alert("LA CANTIDAD DEBE SER MAYOR QUE CERO, INTENTA DE NUEVO POR FAVOR!");
window.close();
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
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
<p align="center" ><?php print 'Paciente: '.$myrow3['paciente'];?></p>


<form id="form1" name="form1" method="GET"  >

 <?php

 //*********************COMPRUEBO EL CLIENTE PRINCIPAL*********************************************************
$sSQL455= "Select clientePrincipal ,nomCliente from clientes where entidad='".$entidad."' and numCliente='".$ass."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$sSQL455= "Select clientePrincipal ,nomCliente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$desc=$myrow455['nomCliente'];
$cP=$myrow455['clientePrincipal'];
$sSQL455= "Select cargoNomina from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
//************************************************************************************************************
?>



<label>
 
  <table width="432" class="table-forma">

      <tr >
        <td width="149"  align="right">Tipo de Pago/Cr&eacute;dito</td>
        <td width="16">&nbsp;</td>
        <td width="267">




             <?php
             if($_GET['modoPago']=='devolucionBeneficencia' or $_GET['modoPago']=='Beneficencia' or $myrow3['activaBeneficencia']=='si'){ ?>
	     <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>
                
             
             

             
             <?php if($_GET['tipoPago']=='devolucionBeneficencia'){?>
                <option
				 <?php if($_GET['tipoPago']=='devolucionBeneficencia' || $myrow3['activaBeneficencia']=='si'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionBeneficencia">devolucionBeneficencia</option>
<?php }else{ ?>
             <option
				 <?php if($_GET['tipoPago']=='Beneficencia' || $myrow3['activaBeneficencia']=='si'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Beneficencia">Beneficencia</option>
             <?php } ?>
                
                
                

            </select>


	         <?php }else if($_GET['modoPago']=='descuentos'){ ?>




         			<select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>



				 <?php if($_GET['descuento']=='particular'){ ?>
			     <option value="">Escoje...</option>

                <option
				 <?php if($_GET['tipoPago']=='descuentoParticular'  || $_GET['descuento']=='particular' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="descuentoParticular">Aplicar Descuento a Particulares</option>
				 </select>

<?php }else {?>

				<option value="">Escoje...</option>
                <option
				 <?php if($_GET['tipoPago']=='descuentoAseguradora'  || $_GET['descuento']=='aseguradora'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="descuentoAseguradora">Aplicar Descuento a Aseguradoras</option>
						            </select>
						<?php } ?>





             <?php }elseif($_GET['status']=='cortesia'){ ?>


         			<select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>
                <option
				 <?php if($_GET['tipoPago']=='Cortesia' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cortesia">Cortesia</option>




            </select>



             <?php }elseif($_GET['modoPago']=='efectivo' ){  ?>


         			<select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
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
				<?php if($_GET['tipoPago']=='Transferencia'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Transferencia">Transferencia</option>


                







				

                                <?php if($_GET['abono']!='si'){?>
				<option  style="border: 1px solid #000000;"
				<?php if($_GET['tipoPago']=='Otros'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Otros">Otros</option><?php }?>

            </select>


		<?php }else if($_GET['modoPago']=='regresoParticular' or $_GET['modoPago']=='regresoAseguradora'){?>

            <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>

<?php if($_GET['modoPago']=='regresoParticular'){  ?>
				<option
				<?php if($_GET['tipoPago']=='regresoParticular' or $_GET['modoPago']=='regresoParticular'){ ?>
				 selected="selected"
				 <?php } ?>
				value="regresoParticular">Regreso Particular</option>

<?php } else { ?>
				<option
				<?php if($_GET['tipoPago']=='regresoAseguradora' or $_GET['modoPago']=='regresoAseguradora'){ ?>
				 selected="selected"
				 <?php } ?>
				value="regresoAseguradora">Regreso Aseguradora</option>



				<?php } ?>

            </select>
                <?php }else if($_GET['modoPago']=='cxc'){ ?>

            <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" <?php if($_GET['tipoCliente']!=NULL) //echo 'disabled=""';?>>
             <option value="">Escoje...</option>


				<option
				<?php if($_GET['tipoPago']=='Cuentas por Cobrar' ){ ?>
				 selected="selected"
				 <?php } ?>
				value="Cuentas por Cobrar">Cuentas por Cobrar</option>


            </select>


			    <?php }else if($_GET['modoPago']=='devolucionParticular' or $_GET['modoPago']=='devolucionAseguradora'){ ?>

            <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" >
			             <option value="">Escoje el tipo de Devolucion...</option>


				<?php if($_GET['modoPago']!='devolucionAseguradora'){ ?>
                <option
				 <?php if($_GET['tipoPago']=='devolucionEfectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionEfectivo">Efectivo</option>



				 <option
				<?php if($_GET['tipoPago']=='devolucionNomina'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionNomina">Nomina</option>

				 				 <option
				<?php if($_GET['tipoPago']=='devolucionBeneficencia'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionBeneficencia">Beneficencia</option>


                                <option
				 <?php if($_GET['tipoPago']=='devolucionCortesia' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionCortesia">Cortesia</option>

                                                                <option
				 <?php if($_GET['tipoPago']=='devolucionTotros' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionTotros">Otros</option>



				<?php }else{ ?>





				 				 <option
				<?php if($_GET['tipoPago']=='devolucionAseguradora' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="devolucionAseguradora">Devolucion Aseguradora</option>
				<?php } ?>

            </select>


			<?php
			if($_GET['tipoPago']=='Cuentas por Cobrar'){

			}else{
			$_GET['tipoTransaccion']='particular';
			}
			 }?>

        </td>
      </tr>

      <?php if($_GET['transaccion']){ ?>

<input name="transaccion" type="hidden"  id="transaccion" value="<?php echo $_GET['transaccion'];?>" />
<?php } else { ?>
<script>
window.alert("Oops! no podemos continuar.. hay un problema en caja, favor de reportarse a sistemas!");
window.close();
</script>
<?php } ?>







<?php if($_GET['tipoPago']=='Cuentas por Cobrar' ){ ?>

      <tr>
        <td   align="right">Aseguradora</td>
        <td ><span >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php echo $seguro;?>"
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td ><input name="nomSeguro" type="text"  id="nomSeguro"
		value="<?php echo $desc;	?>" size="60"/></td>
      </tr>
	  <?php } ?>















<?php if($_GET['tipoPago']=='Otros' ){ ?>

      <tr>
        <td   align="right">Se factura a:  (opcional) </td>
        <td ><span >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php echo $seguro;?>"
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td ><input name="nomSeguro" type="text"  id="nomSeguro"
		value="<?php echo $desc;	?>" size="60"/></td>
      </tr>
	  <?php } ?>


      
       <?php if($_GET['tipoPago']=='Cheque'){ ?>
      <tr>
        <td   align="right">Numero de Cheque</td>
        <td >&nbsp;</td>
        <td ><input name="numeroCheque" type="text"  id="numeroCheque" value="" /></td>
      </tr>
      <tr>
        <td  align="right" >Banco Cheque</td>
        <td >&nbsp;</td>
        <td ><span >
          <input name="bancoCheque" type="text"  id="bancoCheque" value="" size="30" />
        </span></td><?php } ?>
      </tr>
      <tr>
      <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
        <td   align="right">Banco Tarjeta</td>
        <td >&nbsp;</td>
        <td ><span >
          <input name="bancoTC" type="text"  value="<?php echo $_GET['bancoTC'];?>"  />
        </span></td>
      </tr>
      <tr>
        <td   align="right">Telefono</td>
        <td >&nbsp;</td>
        <td >
          <input name="telefono" type="text"  value="<?php echo $_GET['telefono'];?>" />
        </span></td>
      </tr>
      <tr>
        <td   align="right">Ultimos 4 Digitos</td>
        <td >&nbsp;</td>
        <td >
        <label>
              <input name="ultimosDigitos" type="text"  id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onKeyPress="return checkIt(event)"/>
              </label>

        </td>
      </tr>
      <tr>
        <td   align="right">Codigo de Autorizaci&oacute;n</td>
        <td >&nbsp;</td>
        <td ><input name="codigoAutTC" type="text"  id="codigoAutTC" value="<?php echo $_GET['codigoAutTC']; ?>" /></td>
        <?php } ?>
      </tr>
      <tr>
      <?php


		    if($_GET['tipoPago']=='Nomina'){ //solamente se da de alta?>
        <td   align="right">Nombre del Empleado</td>
        <td >&nbsp;</td>
        <td ><input name="empleado" type="text"  id="textfield" value="<?php echo $myrow3['empleado'];?>" size="35" /></td>
      </tr>
      <tr>
        <td   align="right">N&deg; N&oacute;mina</td>
        <td >&nbsp;</td>
        <td ><span >
          <input name="numeroNomina" type="text"  id="numeroNomina" value="<?php echo $myrow3['credencial'];?>" />
        </span></td>
        <?php } ?>
      </tr>
      <tr>
      <?php if($_GET['tipoPago']=='Otros'){ ?>

        <td   align="right">Titular (Responsable)</td>
        <td >&nbsp;</td>
        <td ><input name="responsableCuenta" type="text"  id="responsableCuenta" size="35" /></td>
      </tr>
      <tr>
        <td   align="right">Fecha de Vencimiento</td>
        <td >&nbsp;</td>
        <td ><span class="titulo">
          <label>
            <input name="fechaVencimiento" type="text"  id="campo_fecha" size="10" maxlength="10" readonly="readonly"
		value="<?php
		 echo $date;
		 ?>"/>
          </label>
          <input name="button" type="button"  id="lanzador" value="..." />
        </span></td>
        <?php  } else { ?>
        <input name="fechaVencimiento" type="hidden"  id="campo_fecha" size="10" maxlength="10" readonly="readonly"/>
         <?php  } ?>
		 <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
    </script>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>







<?php

//TIPOS DE PAGO

if($_GET['activaBeneficencia']){//solo casos donde ya no se aplica
    $_GET['tipoPago']='activaBeneficencia';
}


if(($_GET['tipoTransaccion']!='coaseguro' and $_GET['abono']!='si' ) or $_GET['activaBeneficencia']=='si'){
switch ($_GET['tipoPago']) {

    case "activaBeneficencia" :
 	$s= "Select codigoTT From catTTCaja WHERE trasladoBeneficencia='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='TrasladoBeneficencia';
   break;





   case "descuentos" :

     if($_GET['descuento']=='aseguradora'){
    $cantidadAseguradora=$_POST['cantidadRecibida'];
	$s= "Select * From catTTCaja WHERE  descuentoAseguradoras='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
	$descripcionTitulo='Aplicar Descuento Aseguradora';
	}else{

	$cantidadParticular=$_POST['cantidadRecibida'];
	$s= "Select * From catTTCaja WHERE descuentoParticulares='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $descripcionTitulo='Aplicar Descuento Particular';
    }
	$transaccion=$my['codigoTT'];
   break;



   case "Nomina" :
   //echo "The value equals Nomina.";
  $s= "Select codigoTT From catTTCaja WHERE trasladoNomina='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Trasladar a Nomina';
   break;

   case "Efectivo" :
   //TIPO DE PACIENTE SI ES INTERNO O URGENCIAS
   if($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias'){
  $s= "Select codigoTT From catTTCaja WHERE  gastosParticulares='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Total a Pagar';
  }else{
  $s= "Select codigoTT From catTTCaja WHERE  pagoEfectivo='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
 $descripcionTitulo='Total a Pagar Efectivo';
   }
   break;

   case "Cheque" :
   $s= "Select codigoTT From catTTCaja WHERE pagoCheque='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Pago con cheque';
   break;

   case "Otros" :
   $s= "Select codigoTT From catTTCaja WHERE trasladoOtros='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Trasladar Otros';
   break;

   case "Tarjeta de Credito" :
   $s= "Select codigoTT From catTTCaja WHERE pagoTarjeta='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Pagar con Tarjeta de Credito';
   break;

   case "Transferencia" :
   $s= "Select codigoTT From catTTCaja WHERE  pagoTransferencia='si'";
  $rs=mysql_db_query($basedatos,$s);
  $my = mysql_fetch_array($rs);
  $transaccion=$my['codigoTT'];
  $descripcionTitulo='Pagar con Transferencia';
   break;


   case "regresoParticular" :
	$s= "Select codigoTT From catTTCaja WHERE  regresoEfectivo='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
   $descripcionTitulo='Regresar Efectivo';
   break;


   case "regresoAseguradora" :
	$s= "Select codigoTT From catTTCaja WHERE  regresoAseguradora='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Regresar CxC';
   break;


   case "devolucionCortesia" :
	$s= "Select codigoTT From catTTCaja WHERE  devolucionCortesia='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
  $descripcionTitulo='Devolver Cortesia';
   break;



   case "devolucionEfectivo" :
	$s= "Select codigoTT From catTTCaja WHERE  devolucionEfectivo='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
  $descripcionTitulo='Devolver Efectivo';
   break;

   case "devolucionTC" :
	$s= "Select codigoTT From catTTCaja WHERE devolucionTC='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
  $descripcionTitulo='Devolucion Tarjeta de Credito';
   break;


   case "devolucionTE" :
	$s= "Select codigoTT From catTTCaja WHERE devolucionTE='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
  $descripcionTitulo='Devolucion Transferencia Electronica';
   break;

   case "devolucionCH" :
	$s= "Select codigoTT From catTTCaja WHERE devolucionCH='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
   $descripcionTitulo='Devolucion Cheques';
   break;

   case "devolucionAseguradora" :
	$s= "Select codigoTT From catTTCaja WHERE  devolucionAseguradora='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Devolver Aseguradora';
   break;

   case "devolucionBeneficencia" :
	$s= "Select codigoTT From catTTCaja WHERE  devolucionBeneficencia='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Devolver Beneficencia';
   break;


   case "devolucionNomina" :
	$s= "Select codigoTT From catTTCaja WHERE  devolucionNomina='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Devolver a Nomina';
   break;


   case "devolucionTotros" :
 	$s= "Select codigoTT From catTTCaja WHERE  devolucionTotros='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Devolver Traslado Otros';
   break;






   case "Cortesia" :
 	$s= "Select codigoTT From catTTCaja WHERE  cortesia='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Enviar a Cortesia';
   break;

    case "Beneficencia" :
 	$s= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='TrasladoBeneficencia';
   break;


    case "devolucionTotros" :
 	$s= "Select codigoTT From catTTCaja WHERE  devolucionTotros='si'  ";
	$rs=mysql_db_query($basedatos,$s);
	$my = mysql_fetch_array($rs);
    $transaccion=$my['codigoTT'];
    $descripcionTitulo='Devolver Traslado Otros';
   break;





  default :
  $transaccion=$_GET['transaccion'];
  $descripcionTitulo='Total a Pagar';
   break;

 }
 }else{
 //YA TRAE COASEGURO
 $transaccion=$_GET['transaccion'];
 $descripcionTitulo='Total a Pagar';
 }




?>







  <p><span >
      <input name="depositos" type="hidden"  id="depositos" value="<?php echo $depositos; ?>"/>
    </span>
      <span >
      <input name="nCuenta" type="hidden"  id="nCuenta" value="<?php echo $numeroCuenta; ?>"/>
      <span >
      <input name="tipoCliente" type="hidden"  id="tipoCliente" value="<?php echo $_GET['tipoCliente']; ?>"/>
      </span> </span>
      <span >
      <input name="almacenFuente" type="hidden"  id="almacenFuente" value="<?php echo $_GET['almacenFuente']; ?>"/>
      </span>
      <span >
      <input name="almacen" type="hidden"  id="almacen" value="<?php echo $almacenFuente; ?>"/>
      </span>
          <span >    </span><span >
	<input name="devolucion" type="hidden"  id="tipoVenta" value="<?php echo $_GET['devolucion']; ?>"/>
    <input name="statusCortesia" type="hidden"  id="statusCortesia" value="<?php echo $_GET['statusCortesia']; ?>"/>
	<input name="statusBeneficencia" type="hidden"  id="statusBeneficencia" value="<?php echo $_GET['statusBeneficencia']; ?>"/>
	<input name="statusDescuento" type="hidden"  id="tipoVenta" value="<?php echo $_GET['statusDescuento']; ?>"/>


    <input name="tipoVenta" type="hidden"  id="tipoVenta" value="<?php echo $_GET['tipoVenta']; ?>"/>
    </span><span >
    <input name="tipoMovimiento" type="hidden"  id="tipoMovimiento" value="<?php echo $_GET['tipoMovimiento']; ?>"/>
    </span><span >
    <input name="paqueteria" type="hidden"  id="paqueteria" value="<?php echo $_GET['paquete']; ?>"/>
    </span></p>




              <input name="TOTAL" type="hidden"  id="TOTAL" value="<?php echo $TOTAL;?>"/>
              <input name="numeroE" type="hidden"  id="numeroE" value="<?php echo $_GET['numeroE'];?>"/>
              <input name="naturaleza" type="hidden"  id="naturaleza" value="<?php echo $myrow31['naturaleza'];?>"/>





<?php	   if( $_GET['tipoPago']!='' and $transaccion){ ?>
      <tr >
        <td align="right" >
		<?php echo $descripcionTitulo; ?>

			  <input name="tipoTransaccion" type="hidden"  id="tipoTransaccion"
				value="<?php echo $transaccion;?>"   readonly="" />
		</td>
        <td>&nbsp;</td>
        <td>







<input name="cantidadRecibida" type="text"  id="cantidadRecibida"  value="<?php echo $_GET['precioVenta'];?>" size="10" autocomplete="off"/>



              <label>              </label>

            </span></td>






      </tr>
  
  </table>
  <p>&nbsp;</p>











  </p>
    <div align="center">
      <p>
	<?php if(!$_GET['aplicarPago']){ ?>

	<?php
			if($_GET['tipoPago']=='Cuentas por Cobrar' or $_GET['tipoPago']=='Nomina'){ ?>
          <input name="aplicarPago" type="submit" src="../../imagenes/btns/new_traslado.png"  id="aplicarPago" value="Trasladar Saldos"  />
	<?php } else { ?>
          <input name="aplicarPago" type="submit" src="../../imagenes/btns/new_aplicapago.png" id="aplicarPago" value="Aplicar Pago" />
	<?php } ?>

	<?php } ?>



      </p>
        <p>
		<?php if($_GET['aplicarPago']){ ?>
          <label> <br />
          <br />
          <input name="Submit" type="submit"  src="../../imagenes/btns/close.png" value="Cerrar (X)" 	onclick="javascript:cerrar();" />
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



  <?php if( $_GET['rand']){ ?>
    <input name="random" type="hidden"  id="random" value="<?php echo $_GET['rand']; ?>"/>
    <?php } else if($_GET['random']){ ?>
    <input name="random" type="hidden"  id="random" value="<?php echo $_GET['random']; ?>"/>
    <?php } ?>

      <?php if( $_GET['tipoTransaccion']){ ?>
    <input name="tipoTransaccion" type="hidden"  id="tipoTransaccion" value="<?php echo $_GET['tipoTransaccion']; ?>"/>
    <?php }  ?>



    <input name="tt" type="hidden"  id="tipoTransaccion" value="<?php echo $transaccion; ?>"/>

<?php if($_GET['abono']=='si'){ ?>
    <input name="abono" type="hidden"  id="random" value="si"/>
<?php } ?>
<input name="status" type="hidden"  id="status" value="<?php echo $_GET['status'];?>"/>
		<input name="beneficencia" type="hidden"  id="beneficencia" value="<?php echo $beneficencia;?>"/>
                <input name="caso" type="hidden"  id="beneficencia" value="<?php echo $_GET['caso'];?>"/>
                <input name="activaBeneficencia" type="hidden"  id="activaBeneficencia" value="<?php echo $_GET['activaBeneficencia'];?>"/>
		<input name="descripcionTransaccion" type="hidden"  id="descripcionTransaccion" value="<?php echo $_GET['descripcionTransaccion'];?>"/>
		<input name="numCoaseguro" type="hidden"  id="precioVenta" value="<?php echo $_GET['numCoaseguro'];?>"/>
			<input name="descuento" type="hidden"  id="precioVenta" value="<?php echo $_GET['descuento'];?>"/>
	<input name="precioVenta" type="hidden"  id="precioVenta" value="<?php echo $_GET['precioVenta'];?>"/>
		<input name="modoPago" type="hidden"  id="precioVenta" value="<?php echo $_GET['modoPago'];?>"/>
</form>

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
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</body>
</html>
<?php

} else {
echo 'La Caja esta cerrada';
echo '<script >
window.alert( "LA CAJA ESTA CERRADA!");
</script>';
}
?>

<?php } else {
echo 'La Caja esta cerrada';
echo '<script >
window.alert( "LA CAJA ESTA CERRADA!");
</script>';
}
?>
