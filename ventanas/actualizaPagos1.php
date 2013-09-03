<?php require("/configuracion/ventanasEmergentes.php");?>
<?php require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=600,height=600,scrollbars=YES") 
} 
</script> 



<?php






//************CASO 1 **********************

$sSQL1s= "Select folioVenta,tipoPaciente From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result1s=mysql_db_query($basedatos,$sSQL1s);
$myrow1s = mysql_fetch_array($result1s);

$sSQL1t= "Select status,usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and folioVenta='".$myrow1s['folioVenta']."' ";
$result1t=mysql_db_query($basedatos,$sSQL1t);
$myrow1t = mysql_fetch_array($result1t);
echo mysql_error();
//echo $_GET['folioVenta'];

//echo $myrow1t['status'].' '.$myrow1t['folioVenta'];
if($myrow1s['tipoPaciente']=='externo'){
if($myrow1t['status']=='standby' ){ 
//echo "Debes terminar de  completar la transaccion: ".$myrow1t['folioVenta'];
$disabled='disabled=""';
?>
<script>
window.alert("Estimado: <?php echo $myrow1t['usuario'];?>, imposible modificar datos, ya tiene movimientos!");
window.close();
</script>
<?php }  
}






if($_POST['cambiar']   ){
if(!$_GET['keyClientesInternos']){
$_GET['keyClientesInternos']=$_POST['keyClientesInternos'];
}

$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();


//***********PRIMERAS BANDERAS*********
$numeroE=       $myrow1['numeroE'];
$nCuenta=		$myrow1['nCuenta'];
//*************************************



//***********CLAVE PRINCIPAL
if($_POST['tipoPago']=='particular'){
$seguro=     '';
} else {
$seguro=		$_POST['seguro'];
}
//**************************

//************DECLARAMOS CLASES*********
$iva=new articulosDetalles();
$ivaParticular=new ivaCierre();
$ivaAseguradora=new ivaCierre();
$formaVenta=new ivaCierre();
$precioVenta=new articulosDetalles();
$convenios=      new validaConvenios();
$global=         new validaConvenios();
$tipoConvenioS=  new validaConvenios();
$traeConvenio=   new validaConvenios();
$vConvenio=      new validaConvenios();
$verificaSaldos1=new verificaSeguro1();
$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
$ivaAseguradora=new ivaCierre();
$ivaParticular=new ivaCierre();
//**************************************

//*****************ACTUALIZO ENCABEZADOS PRIMERO********************
$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455f= "Select fechaFinal from convenios where entidad='".$entidad."' and numCliente='".$seguro."' ";
$result455f=mysql_db_query($basedatos,$sSQL455f);
$myrow455f = mysql_fetch_array($result455f);
    
//echo $fecha1.' - '.$myrow455f['fechaFinal'];
if($seguro!=NULL AND ($myrow455f['fechaFinal']!=NULL and $myrow455f['fechaFinal']<$fecha1)){


$tipoMensaje='error';
$encabezado='Error';
$texto='Convenio Vencido...!';


}else{
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

//******************************************************************



//trae todos los movimientos
$sSQL1= "Select * From cargosCuentaPaciente WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."' and gpoProducto!='' ";

//$sSQL1="select * from cargosCuentaPaciente where keyCAP='52804'";

//$sSQL1= "Select * From cargosCuentaPaciente WHERE keyCAP='103586'";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

    
    
//*******GRABA EN HISTORIAL DE MOVIMIENTOS*******
    
$agrega = "INSERT INTO historialCuentas (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,
tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,
almacenSolicitante,almacenDestino,keyClientesInternos,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,numeroTransferencia,
banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,statusDevolucion,keyE,keyPA,numeroConfirmacion,
ivaParticular,ivaAseguradora,tipoVentaArticulos,usuarioFactura,
precioOriginal,ivaOriginal,usuarioDescuento,fechaDescuento,cargoModificable,gpoProducto,numSolicitud,
folioDevolucion,descripcionArticulo,tipoCuenta,notaCredito,fechaCargo,usuarioCargo,
descripcionGrupoProducto,descripcionAlmacen,almacenIngreso,

statusBeneficencia,

diaNumerico,year,mes,

descripcionClientePrincipal,descripcionMedico,primeraVez,statusDescuento
)
values 
('".$myrow1['numeroE']."',
'".$myrow1['nCuenta']."',
'".$myrow1['status']." ',
'".$usuario."',
'".$fecha1."',
'".$dia1."',
'".$myrow1['cantidad']."',
'".$tipoTransaccion."',
'".$myrow1['codProcedimiento']."',
'".$hora1."',
'".$naturaleza."',
'".$ID_EJERCICIOM."',
'',
'".$myrow1['almacen']."',
'".$usuario."',
'".$myrow1['precioVenta']."',
'".$myrow1['iva']."'
,'".$myrow1['seguro']."',
'".$myrow1['statusTraslado']."',
'',
'".$myrow1['tipoPaciente']."',
'".$myrow1['cantidadParticular']."',
'".$myrow1['cantidadAseguradora']."',
'".$myrow1['entidad']."',
'".$myrow1['tipoCobro']."',
'".$myrow1['statusAuditoria']."'
,'".$myrow1['tipoPago']."',
'cargado',
'".$myrow1['porcentajeVariable']."',
'".$myrow1['cargosHospitalarios']."',
'".$myrow1['almacenSolicitante']."',
'".$myrow1['almacenDestino']."',

'".$myrow1['keyClientesInternos']."',


'".$myrow1['descripcion']."',
'',
'".$hora1."',
'".$fecha1."',
'".$fecha1."',
'".$myrow1['codigoTarjeta']."',
'".$myrow1['codigoAutorizacion']."',
'".$myrow1['numeroCheque']."',
'".$myrow1['bancoTransferencia']."',
'".$myrow1['bancoCheque']."',
'".$myrow1['numeroTransferencia']."',
'".$myrow1['banderaPC']."',
'".$myrow1['statusPC']."',
'".$myrow1['clientePrincipal']."',
'".$myrow1['folioVenta']."',
'".$myrow1['codigoCaja']."',
'".$myrow1['numRecibo']."',
'".$myrow1['numCorte']."',
'',
'".$myrow1['keyE']."',
'".$myrow1['keyPA']."',
'".$myrow1['numeroConfirmacion']."',
'".$myrow1['ivaParticular']."',
'".$myrow1['ivaAseguradora']."',
'".$myrow1['tipoVentaArticulos']."',
'".$myrow1['usuarioFactura']."',
'".$myrow1['precioOriginal']."',
'".$myrow1['ivaOriginal']."',
'".$myrow1['usuarioDescuento']."',
'".$myrow1['fechaDescuento']."',
'".$myrow1['cargoModificable']."',
'".$myrow1['gpoProducto']."',

'".$myrow333['NS']."','".$myrow1['keyCAP']."' ,'".$myrow1['descripcionArticulo']."','".$tipoCuenta."' ,'si','".$fecha1."',
'".$usuario."',
'".$myrow1['descripcionGrupoProducto']."','".$myrow1['descripcionAlmacen']."','".$myrow1['almacenIngreso']."',

'".$myrow1['statusBeneficencia']."','".$myrow1['diaNumerico']."','".$myrow1['year']."','".$myrow1['mes']."',

'".$myrow1['descripcionClientePrincipal']."','".$myrow1['descripcionMedico']."','".$myrow1['primeraVez']."','".$myrow1['statusDescuento']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();    
    
//***********************************************    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//******LISTADO DE BANDERAS*****************
$cLlave=new articulosDetalles();          //*
$keyPA=$cLlave->codigollave($entidad,$myrow1['codProcedimiento'],$basedatos);  //*  
$codigo=     $myrow1['codProcedimiento']; //*
        //*
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


$sSQL13ab= "
SELECT precioPorAlmacen
FROM
gpoProductos
WHERE
codigoGP='".$myrow1['gpoProducto']."'

";
$result13ab=mysql_db_query($basedatos,$sSQL13ab);
$myrow13ab = mysql_fetch_array($result13ab);


if($myrow13ab['precioPorAlmacen']=='si'){
$almacen=    $myrow1['almacenDestino'];     
}else{
$almacen=    $myrow1['almacen'];  
}


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



if($myrow1['fechaCargo']==$fecha1){
    if($myrow1['cargoModificable']!='si'){
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($entidad,$paquete,$_POST['generico'],$cantidad[$i],$numeroE,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);
    }else{
     $priceLevel=$myrow1['precioVenta'];   
    }
}else{
//no debes de cambiar precios si no es la fecha
$priceLevel=$myrow1['precioVenta'];
}





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
echo '<script>';
echo 'window.alert("SE ACTUALIZO LA CUENTA ");';
echo 'window.opener.document.forms["form1"].submit();';
echo '</script>';
}



}//*******Cierra actualizar*******
?>




















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="/sima/js/jquery.js" type="text/javascript"></script>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<?php   
$sSQL2= "Select * From clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result2=mysql_db_query($basedatos,$sSQL2); 
$myrow2 = mysql_fetch_array($result2);
$paciente=$myrow2['paciente'];
?>
<form id="form1" name="form1" method="post" action="">
   <p>
     <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label> 
   </p>
   <h1 align="center" >Responsable de Cuenta</h1><br />
  <table width="473" border="0" align="center" >

     <tr>
       <td colspan="3"  scope="col"><label></label>         
       <div align="center" class="negromid">Paciente: <?php echo $paciente;?></div></td>
     </tr>
     <tr>
       <td width="5"  scope="col">&nbsp;</td>
       <td colspan="2"  ><div align="left" class="normalmid">Escoje</div></td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td width="54" class="Estilo24" scope="col"><label>
       
       <input name="tipoPago" type="radio" value="particular" <?php if(!$myrow2['seguro'] or $_POST['tipoPago']=='particular')echo 'checked=""';?> />
       </label></td>
       <td width="400" class="Estilo24" scope="col"><div align="left" class="negromid">Particular</span></div>       </td>
    </tr>
     
	 
	 
	 <tr>
	 
       <td  scope="col">&nbsp;</td>
       
       <td  class="Estilo24" scope="col">
       
       <label>
         <input name="tipoPago" type="radio" value="aseguradora" <?php if($myrow2['seguro'] and $_POST['tipoPago']!='particular')echo 'checked=""';?>/>
       </label></td>
       <td valign="top"  class="Estilo24" scope="col"><div align="left" id="mostrar"><strong> </strong>
	  
               <label></label>
               <p>
                 <?php   
$sSQL21= "Select * From clientes where entidad='".$entidad."' and numCliente='".$myrow2['seguro']."'";
$result21=mysql_db_query($basedatos,$sSQL21); 
$myrow21 = mysql_fetch_array($result21);

?>
               <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="70"
		value="<?php echo $myrow21['nomCliente'];?>"/>
        </p>
             
                 <!-- div que mostrara la lista de coincidencias --><span >
                   
                 <input name="seguro" type="hidden" class="Estilo24" id="seguro"   readonly=""
		value="<?php echo $myrow2['seguro'];?>"/>
                 </span>
         
       </div></td>
     </tr>

	 
	 

     <tr>
       <td width="5"  scope="col">&nbsp;</td>
       <td colspan="2"  >
         <div align="center">
           <input name="cambiar" class="boton1" type="submit" src="../../imagenes/btns/refresh.png" id="cambiar" value="Cambiar" onClick="if(confirm('Estas seguro que deseas Cambiar el status de pago del paciente: <?php echo $paciente;?>?') == false){return false;}"/>
       </div></td>
     </tr>
   </table>

<p>&nbsp;</p>
</form>
    
<script type="text/javascript">
<!--
jQuery(function($) {
$("#contentArea").load("updatePayments.php?almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&fecha2=<?php echo $fecha2;?>&fecha1=<?php echo $date;?>&almacen=<?php echo $ALMACEN;?>&tipoOrden=<?php echo $_GET['tipoOrden'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&warehouse=<?php echo $_GET['warehouse'];?>");
});

$().ajaxSend(function(r,s){
$("#contentLoading").show();
});

$().ajaxStop(function(r,s){
$("#contentLoading").fadeOut("fast");
});

//-->
</script>    
    
    
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
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
