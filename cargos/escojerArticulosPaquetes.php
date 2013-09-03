<?php require("/configuracion/ventanasEmergentes.php");  require('/configuracion/funciones.php');require("/configuracion/clases/generaFolioVenta.php");?>


<?php 
if($_POST['update']){
$grupoProducto=new articulosDetalles();$descripcionGrupoProducto=new articulosDetalles();





//***************GENERAR FOLIO DE VENTA**********
$generaFolio=new folioVenta();
$FV=$generaFolio-> generarFolioVenta($_GET['keyClientesInternos'],$usuario,"paquete",$entidad,$tipoFolio,$basedatos);
echo '<script>';
echo 'window.alert("Se genero el folio de venta: '.$FV.'");';
echo '</script>';
//***************************************






$nCuenta=$_GET['nCuenta'];
$keyE=$_POST['keyE'];		
		$coder=$_POST['coder'];
for($i=0;$i<=$_POST['flag'];$i++){



if($keyE[$i]!=NULL){
$sSQL= "Select keyE from articulosPaquetesPacientes
WHERE 
keyE='".$keyE[$i]."'
and
entidad='".$entidad."'
and
numeroE='".$_POST['numeroE']."'
and
nCuenta='".$nCuenta."'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$codec=$myrow['codigo'];




if($myrow['keyE']){ 
$sSQL1= "Select * from articulosPaquetes
WHERE 
keyE='".$keyE[$i]."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




$sql="Update articulosPaquetesPacientes
set
codigo='".$myrow1['codigo']."',
codigoPaquete='".$myrow1['codigoPaquete']."',
usuario='".$usuario."',
fecha='".$fecha1."',
keyClientesInternos='".$_GET['keyClientesInternos']."',
hora='".$hora1."'
where 
keyE='".$keyE[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';
} else {
$sSQL1= "Select * from articulosPaquetes
WHERE 
keyE='".$keyE[$i]."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select gpoProducto from articulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

$codec=$myrow1['codigo'];
$id_almacen=$myrow1['almacen'];




$sSQL1a= "Select descripcion, gpoProducto from articulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);



//????????????????????????????????????????????????
$agrega = "INSERT INTO articulosPaquetesPacientes (
codigo,codigoPaquete,usuario,fecha,hora,entidad,keyE,numeroE,nCuenta,status,cantidad,keyClientesInternos) 
values ('".$myrow1['codigo']."','".$myrow1['codigoPaquete']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$keyE[$i]."','".$_POST['numeroE']."','".$_POST['nCuenta']."','standby','".$myrow1['cantidad']."','".$_GET['keyClientesInternos']."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
//********************************ES EN CARGOS CUENTA PACIENTE************************


//******************************GF*****************************************
$sSQL101= "Select id_almacen from almacenesPaquetes
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
id_almacen='".$myrow1['almacen']."'";
$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101 = mysql_fetch_array($result101);
//*****************SACA ALMACEN PRINCIPAL**********************

$sSQL52="SELECT almacenPadre
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow1['almacen']."'
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
if(!$myrow52['almacenPadre']){
$myrow52['almacenPadre']=$myrow1['almacen'];
}

//*************************************************************
//*************************************************************************************		
$sSQL4a= "Select * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result4a=mysql_db_query($basedatos,$sSQL4a);
$myrow4a = mysql_fetch_array($result4a);
$seguro=$myrow4a['seguro'];
$_GET['numeroE']=$myrow4a['numeroE'];


$iva=new articulosDetalles();
if($myrow4a['seguro'] and $myrow4a['seguro']!='0'){ 
$cantidadAseguradora=$myrow1['precioPaquete1'];
$ivaAseguradora=$myrow1['ivaPrecioPaquete1'];
$tipoCliente='aseguradora';
$ivaA=$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos);
} else{ 
$cantidadParticular=$myrow1['precioPaquete1'];
$ivaParticular=$myrow1['ivaPrecioPaquete1'];
$tipoCliente='particular';
$ivaP=$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos);
}


$aIngreso=new almacenesIngreso();
if( $aIngreso->almacenIngreso($myrow1a['gpoProducto'],$entidad,$basedatos)=='almacenSolicitante'){
$almacenIngreso=$myrow52['almacenPadre'];
}else if($aIngreso->almacenIngreso($myrow1a['gpoProducto'],$entidad,$basedatos)=='almacenDestino'){
$almacenIngreso=$myrow1['almacen'];
}

//****************
$sSQL6ab="SELECT almacenPadre,descripcion
FROM
almacenes
WHERE

entidad='".$entidad."'
and
almacen='".$almacenIngreso."'
  ";
  $result6ab=mysql_db_query($basedatos,$sSQL6ab);
  $myrow6ab = mysql_fetch_array($result6ab);
  $almacenIngreso=$myrow6ab['almacenPadre'];
  $descripcionAlmacen=$myrow6ab['descripcion'];
//****************


$gpoProducto=$grupoProducto->grupoProducto($entidad,$myrow1['codigo'],$basedatos);

$descripcionGP=$descripcionGrupoProducto->descripcionGrupoProducto($entidad,$gpoProducto,$basedatos);


//******************************************************
$dia=date("D");
$diaNumerico=date("d");
$year=date("Y");
$mes=date("m");
//******************************************************


//****************

$sSQL6abc="SELECT id_medico,medico,descripcion
FROM
almacenes
WHERE

entidad='".$entidad."'
and
almacen='".$myrow1['almacen']."'
  ";
  $result6abc=mysql_db_query($basedatos,$sSQL6abc);
  $myrow6abc = mysql_fetch_array($result6abc);


  $descripcionMedico=$myrow6abc['descripcion'];
  
//****************





//*****************************cargo clientePrincipal
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$myrow4a['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455a= "Select nomCliente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455a=mysql_db_query($basedatos,$sSQL455a);
$myrow455a = mysql_fetch_array($result455a);
//****************************************************************




$sSQL31e= "Select * from articulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'";
$result31e=mysql_db_query($basedatos,$sSQL31e);
$myrow31e = mysql_fetch_array($result31e);


if($myrow31e['codigo']){


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,
porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,iva,
horaSolicitud,fechaSolicitud,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,paquete,keyE,gpoProducto,ivaParticular,
ivaAseguradora,descripcionArticulo,numMovimiento,tipoCuenta,
almacenIngreso,descripcionAlmacen,descripcionGrupoProducto,diaNumerico,mes,year,descripcionClientePrincipal,descripcionMedico,codigoPaquete,
descripcionpaquete,
medico)
values 
('".$myrow4a['numeroE']."','".$myrow4a['nCuenta']."','paquete',
'".$usuario."','".$fecha1."','".$dia."','".$myrow1['cantidad']."','".$_POST['tipoTransaccion']."','".$myrow1['codigo']."',
'".$hora1."','C','".$ID_EJERCICIOM."','','".$myrow52['almacenPadre']."','".$usuario."',
'".$myrow1['precioPaquete1']."','".$myrow4a['seguro']."','standby','".$tipoCliente."','".$myrow4a['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','paquete','standby'
,'paquete','cargadoR','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$myrow52['almacenPadre']."','".$myrow1['almacen']."',
    '".$_GET['keyClientesInternos']."','pagado','".$_POST['descripcion']."','standby',
'".$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos)."','".$hora1."','".$fecha1."','".$myrow455['clientePrincipal']."',
'".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','si','".$keyE[$i]."','".trim($myrow1a['gpoProducto'])."',
'".$ivaP."','".$ivaA."','".$myrow1a['descripcion']."' ,'".$myrow333['CVI']."','D','".$almacenIngreso."',
'".$descripcionAlmacen."','".$descripcionGP."','".$diaNumerico."','".$mes."','".$year."','".$myrow455a['nomCliente']."',
    '".$descripcionMedico."','".$_GET['codigoPaquete']."','".$_GET['descripcionPaquete']."',
        '".$myrow6abc['id_medico']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//*********************************************TRANSACCIONES****************************************










/*   	keyVI  	bigint(254)  	 	  	No  	None  	AUTO_INCREMENT  	  Browse distinct values   	  Change   	  Drop   	  Primary   	  Unique   	  Index   	 Fulltext
	numTransaccion 	bigint(254) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	keyCAP 	bigint(254) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	cantidad 	int(10) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	descripcionArticulo 	varchar(254) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	precioVenta 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	iva 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	cantidadParticular 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	ivaParticular 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	cantidadAseguradora 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	ivaAseguradora 	decimal(20,2) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	usuario 	varchar(254) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	hora 	varchar(20) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	fecha 	varchar(20) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	entidad 	char(2) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	keyClientesInternos 	bigint(254) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	folioVenta 	varchar(254) 	utf8_general_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
 */ 


$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,
precioVenta,iva,
cantidadParticular,ivaParticular,
cantidadAseguradora,ivaAseguradora,
usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
) values (
'".$myrow333['CVI']."','".$myrow['keyCAP']."' , '".$myrow1['cantidad']."','".$myrow1a['descripcion']."',
'".$myrow1['precioPaquete1']."','".$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos)."',
'".$cantidadParticular."','".$ivaP."',
'".$cantidadAseguradora."','".$ivaA."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow3['keyClientesInternos']."',
'".$myrow3['folioVenta']."','".$_POST['almacenDestino']."','status'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
//******************************************CIERRA TRANSACCIONES*************************************










//*****************ACTUALIZO ENCABEZADOS PRIMERO********************
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($seguro){
  $q1 = "UPDATE clientesInternos set 

seguro='".$seguro."',
clientePrincipal='".trim($myrow455['clientePrincipal'])."',
tipoResponsable='Empresa'

WHERE 
 keyClientesInternos='".$_GET['keyClientesInternos']."'
";

mysql_db_query($basedatos,$q1);
echo mysql_error();
}else{

$q1 = "UPDATE clientesInternos set 

seguro='',
clientePrincipal='',
tipoResponsable='Familiar'

WHERE 
 keyClientesInternos='".$_GET['keyClientesInternos']."'
";



mysql_db_query($basedatos,$q1);
echo mysql_error();


}











if($seguro!=NULL and $_GET['numeroE']!=NULL){
//******************APLICAR DE ACUERDO AL CONVENIO SI TRAE SEGURO********************/
//trae todos los movimientos
//************DECLARAMOS CLASES*********
$iva=            new articulosDetalles();
$ivaParticular=  new ivaCierre();
$ivaAseguradora= new ivaCierre();
$formaVenta=     new ivaCierre();
$precioVenta=    new articulosDetalles();
$convenios=      new validaConvenios();
$global=         new validaConvenios();
$tipoConvenioS=  new validaConvenios();
$traeConvenio=   new validaConvenios();
$vConvenio=      new validaConvenios();
$verificaSaldos1=new verificaSeguro1();
$traeSeguro=     new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
$ivaAseguradora= new ivaCierre();
$ivaParticular=  new ivaCierre();
//**************************************
$sSQL1= "Select * From cargosCuentaPaciente WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."' and gpoProducto!='' and status!='transaccion'";

//$sSQL1="select * from cargosCuentaPaciente where keyCAP='52804'";

//$sSQL1= "Select * From cargosCuentaPaciente WHERE keyCAP='103586'";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

//******LISTADO DE BANDERAS*****************
$cLlave=new articulosDetalles();          //*
$keyPA=$cLlave->codigollave($entidad,$myrow1['codProcedimiento'],$basedatos);  //*  
$codigo=     $myrow1['codProcedimiento']; //*
$almacen=    $myrow1['almacen'];          //*
$cantidad=   $myrow1['cantidad'];         //*
//*******************************************
$sSQL40= "
SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL40b= "
SELECT descripcion
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'";
$result40b=mysql_db_query($basedatos,$sSQL40b);
$myrow40b = mysql_fetch_array($result40b);
$descripcionArticulo=$myrow40b['descripcion'];

$gpoProducto=$myrow40['gpoProducto'];

//***********actualiza******************
$priceLevel=$myrow1['precioVenta'];




$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);



// son jubilados y trae seguro?
if($seguro){ 
if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){

 $percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);
$percent*=0.01;

if($percent){
$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
}else{
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);

}
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else {

if($tipoConvenio=='cantidad'){  
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
$priceLevel=$acumulado;
 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){


$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadAseguradora=NULL;
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else { 
$cantidadParticular=NULL;
$ivaParticulart=NULL;
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
}

}
} else {//solamente abre cuando trae seguro
$cantidadParticular=$priceLevel;
$ivaParticulart=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}




if($acumuladoGlobal>$priceLevel){
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}





$formaVenta->formaVenta($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos);
if($myrow1['cargoModificable']!='si'){ 
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".trim($myrow455['clientePrincipal'])."',
descripcionArticulo='".$descripcionArticulo."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
descripcionArticulo='".$descripcionArticulo."',
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'

";
//echo '<br>'.$q;

}

















} else{//----------comparo el precio modificable
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".$myrow455['clientePrincipal']."'

WHERE 
keyCAP='".$myrow1['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'  ";

}

}
//***********ACTUALIZA SCRIPT CCP*************
mysql_db_query($basedatos,$q);
echo mysql_error();
//********************************************


}//cierra while
}//SI TRAE ASEGURADORA









//**************************************************************************************





if(!$myrow101['id_almacen']){
$agregaAP = "INSERT INTO almacenesPaquetes (
codigoPaquete,keyClientesInternos,id_almacen,status,almacenPrincipal) 
values ('".$myrow1['codigoPaquete']."','".$_GET['keyClientesInternos']."','".$myrow52['almacenPadre']."','request','".$myrow52['almacenPadre']."')";
mysql_db_query($basedatos,$agregaAP);
echo mysql_error();
}
//**************************************************************************

}else{//validacion de codigo
    echo '<div class="error">NO EXISTE EL ARTICULO...</div>';
}
}//insertalo cierra validacion
}
}//cierra if
?>
<script>
window.close();
</script>
<?php 
}//cierra for

?>







<?php 
 if($usuario AND $entidad AND $_POST['keyPPaq']!=NULL){
 $borrame = "DELETE FROM paquetesPacientes WHERE 
keyPPaq ='".$_GET['keyPPaq']."'

";
//mysql_db_query($basedatos,$borrame);
echo mysql_error();
$yes='si';
}else{
$yes='no';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos;
$estilos->styles();

?>
</head>

<body>

<h3 align="center" >Escoje los art&iacute;culos o servicios que quieres cargar al paquete </h3>
<p align="center" >Px: <?php echo $_GET['paciente'];?></p>
<form id="form" name="form" method="post" action="" >
  <p>&nbsp;</p>
  <table width="537" class="table table-striped">

    <tr >
         <th width="10" >#</th>
      <th width="74" >Ref</th>
      <th width="292"  >Descripcion</th>
      <th width="26" >C</th>
      <th width="72" >Precio </th>
      <th width="44" >IVA</th>
      <th width="32" >Edit</th>
      <th width="100" >Tipo Servicio</th>
    </tr>
<?php	
$sSQL= "SELECT
 *
FROM
 articulosPaquetes

 WHERE entidad='".$entidad."' AND (codigoPaquete = '".$_GET['codigoPaquete']."' or codigoPaquete='".$_POST['codigoPaquete']."')

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL31= "Select existencias.almacen,articulos.descripcion,articulos.codigo as code From articulos,existencias
WHERE 
articulos.entidad='".$entidad."'
and
articulos.codigo='".$myrow['codigo']."'
and
articulos.codigo=existencias.codigo

";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL313= "Select descripcion from almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'
";
$result313=mysql_db_query($basedatos,$sSQL313);
$myrow313 = mysql_fetch_array($result313);

$totalPrecio[0]+=$myrow['precioPaquete1'];




?>
    <tr >
        
        
         <td ><?php echo $a;?></td>
      <td height="48" ><span >
        <input name="coder[]" type="hidden"  id="flag" value="<?php echo $myrow['codigo'];?>" />
        <?php 
echo $myrow['keyE'];

	  ?>
      </span></span></td>
      <td ><span >
        <?php 
		if($myrow31['descripcion']){
echo $myrow31['descripcion'];
}else{

echo '<div class="error">ESTE SERVICIO/ARTICULO YA NO EXISTE EN EL SISTEMA</div>';
}
?></br>
    <?php
    echo $myrow313['descripcion'];

?>

      </span></td>
      <td ><?php echo $myrow['cantidad'];?></td>
      <td ><span ><?php echo "$".number_format($myrow['precioPaquete1'],2);?></span></td>
      <td ><span ><?php echo "$".number_format($myrow['ivaPrecioPaquete1'],2);?></span></td>
      <td >
          
          
          
          <?php 
          if($myrow31['descripcion']!=NULL or ($myrow['tipoArticulo']=='opcional' and $myrow31['descripcion']!=NULL)){ ?>
          
          
        <?php if($myrow['tipoArticulo']=='opcional'){?>  
       <input name="keyE[]" type="checkbox" value="<?php echo $myrow['keyE'];?>"  />
        <?php } else { ?>
          <input name="keyE[]" type="hidden"  value="<?php echo $myrow['keyE'];?>" />
         
         <?php } ?>
         
         
         
         <?php }else{ ?>
        <img src="../imagenes/candado.png" width="16" height="16" />
        <?php } ?>
        </td>
      
      <td>
          <div align="left">
              <?php  
              if($myrow['tipoArticulo']=='opcional'){
              print 'Opcional';
              }else{
              print 'Obligatorio';
              }?>
          </div>    
          
      </td>
      
      
    </tr>
<?php  

    
    }//cierra while
}//cierra validacion de arreglo
    ?>

  </table>
  <p align="center">
      
 </p>
  <p>&nbsp;</p>
  <p align="center">
    <label>
    <input name="update" type="submit"  id="update" value="Activar Paquete" />
	<input name="flag" type="hidden"  id="update" value="<?php echo $a;?>" />
	<input name="numeroE" type="hidden"  id="numeroE" value="<?php echo $_GET['numeroE'];?>" />
	<input name="nCuenta" type="hidden"  id="nCuenta" value="<?php echo $_GET['nCuenta'];?>" />
    </label>
    <input name="codigoPaquete" type="hidden" id="codigoPaquete" value="<?php echo $_GET['codigoPaquete'];?>" />
  </p>
</form>
  <p></p>
  
  
</body>
</html>
