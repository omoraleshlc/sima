<?PHP require('/configuracion/ventanasEmergentes.php'); ?>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>



<script language="javascript" type="text/javascript">

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

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=500,height=500,scrollbars=YES") 
} 
</script> 


<?php
$ALMACEN=$_GET['almacen'];




require("/configuracion/funciones.php"); 






if($_POST['aplicarPago'] and $_POST['cantidadRecibida'] and $_POST['seguro']){
$random=rand(100000,1000000000000);

//**********************************SACO EL CLIENTE PRINCIPAL***************************

$sSQL3= "Select * From clientes WHERE entidad='".$entidad."' and numCliente = '".$_POST['seguro']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);





$s= "Select * From catTTCaja WHERE codigoTT='DESCXCCIAS'   ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$describe=$my['descripcion'];
$naturaleza=$my['naturaleza'];
$codigoTT=$my['codigoTT'];

if(!$codigoTT){
echo '<script>
window.alert("Hay un problema en la caja, favor de reportarse a sistemas. Error: 2019");
window.close();
</script>';
}

//**********************************SACO MI FOLIO DE VENTA*************************




$sSQL311= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_POST['folioVenta']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);





//**********************************CIERRO FOLIO DE VENTA***********************






























//***********************************SOLO CUANDO ES DEVOLUCION************************************
if($_POST['devolucion']=='si'){
$s= "Select * From catTTCaja WHERE codigoTT='DEVCXCCIAS'   ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$describe=$my['descripcion'];
$naturaleza=$my['naturaleza'];
$codigoTT=$my['codigoTT'];
$tipoCuenta='D';
$statusDevolucion='si';
$_POST['tipoPago']='devolucionAseguradora';
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
}
//******************************************************************************************************


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
'".$myrow333a['CVI']."','".$myrow3g['keyCAP']."','1','pagosCxC','".$_POST['cantidadRecibida']."','".$iva."','".$_POST['cantidadRecibida']."',
'".$iva."','".$myrow3g['cantidadAseguradora']."','".$myrow3g['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow311['keyClientesInternos']."',
'".$_POST['folioVenta']."','".$myrow3g['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//***************************************************




if($_POST['observaciones']!=NULL){
    $describe=$_POST['observaciones'];
}

//*****************************************************************************
$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,
tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,
almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,
fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,
statusDevolucion,tipoCuenta,descripcionArticulo,random,descripcionTransaccion,abonosCxC,
numMovimiento,fechaCierre)
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$myrow3['seguro']."','standby','','',
'".$_POST['cantidadRecibida']."'+'".$iva."',
'0.00','".$entidad."','".$_POST['tipoPago']."','cargado'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$_POST['observaciones']."','sinAplicar','".$hora1."',
'".$fecha1."','".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."',
    '".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','si','standby','".$_POST['seguro']."',
    '".$myrow333a['CVI']."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."',
'".$numCorte."','".$statusDevolucion." ' ,'".$tipoCuenta."' ,'".$describe."','".$random."' ,'pagosCxC','si', '".$myrow333a['CVI']."','".$fecha1."') ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//******************PARTIDA DOBLE*********************




$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,statusDevolucion,tipoCuenta,descripcionArticulo,random,descripcionTransaccion,abonosCxC,numMovimiento) 
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$myrow3['seguro']."','standby','','',
'".$_POST['cantidadRecibida']."'+'".$iva."',
'0.00','".$entidad."','".$_POST['tipoPago']."','cargado'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$myrow317['descripcion']."','sinAplicar','".$hora1."',
'".$fecha1."','".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."','".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','si','standby','".$_POST['seguro']."','".$myrow333a['CVI']."' ,'".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$statusDevolucion."'   ,'".$tipoCuenta."' ,'".$describe."','".$random."' ,'pagosCxC','si', '".$myrow333a['CVI']."') ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************



?>
<script language="JavaScript" type="text/javascript">
  


    nueva('/sima/cargos/imprimirAbonosOtros.php?entidad=<?php echo $entidad; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $myrow311['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&seguro=<?php echo $_POST['seguro'];?>&cajero=<?php echo $usuario;?>&random=<?php echo $random;?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&numCorte=<?php echo $myrowC['numCorte'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&cliente=<?php echo $_POST['nomSeguro'];?>&codigoCaja=<?php echo $myrowC['keyCatC'];?>&numMovimiento=<?php echo $myrow333a['CVI'];?>','ventanaSecundaria2','630','500','yes');

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
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" /> 
    </head>
    
    
    

<body><br />
<h1 align="center" >

</h1>

  <form id="form1" name="form1" method="post" action="">
    <table width="630" class="table-forma" >
    <tr>
      <th colspan="3"  scope="col"><p align="center">Aplicar Descuento a Companias</p></th>
    
    </tr>
	


     <tr>
       <td  scope="col">&nbsp;</td>
       <td>Es Devolucion?</td>
       <td><label>
         <input name="devolucion" type="checkbox" id="devolucion" value="si" />
       </label></td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td><div align="left" >Seguro
         <input name="seguro" type="hidden" class="Estilo24" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
       </div></td>
       <td><input name="nomSeguro" type="text"  id="nomSeguro" size="60" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        

         </td>
     </tr>




     <tr>
       <td  scope="col">&nbsp;</td>
       <td colspan="2" >&nbsp;</td>
      </tr>


     <tr>
      <td width="1"  scope="col">&nbsp;</td>
      <td >Observaciones </td>
      <td ><label>
       <textarea name="observaciones" rows="2" cols="20" value="<?php

		echo $_POST['observaciones'];?>"></textarea>
      </label></td>
    </tr>


     <tr>
      <td width="1"  scope="col">&nbsp;</td>
      <td >Importe </td>
      <td ><label>
        <input name="cantidadRecibida" type="text"  id="cantidadRecibida" value="<?php 
		if(!$_POST['nuevo']){
		echo $_POST['cantidadRecibida'];}?>">
      </label></td>
    </tr>
	
	
	

    <tr>
	     <td height="33" colspan="3"><label>
	       <div align="center">
	         <label><br />

            </label>
	         <input name="aplicarPago" type="submit"  id="aplicarPago" value="Efectuar Pago" 
			<?php echo $disabled?>
			  />
            <label></label>
            <input name="almacen" type="hidden"  id="almacen" 
				value="<?php echo $ALMACEN;?>"   readonly="" />
          </div>
        </label></td>
    </tr>
    
    
    
    
  </table>
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
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
        <br>
</body>
</html>