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
$random=rand(100000,1000000000);

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numCorte=$myrowC['numCorte'];


if($myrowC['status']=='abierta'){ //*******************Comienzo la validaci�n*****************

require("/configuracion/funciones.php"); 
//************************ACTUALIZO **********************




if($_POST['iva']){
$sSQL8= "
SELECT *
FROM
TASA
WHERE
codTasa>0
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= ($myrow8['valorTasa']+100)/100;
$cantidadRecibida=$_POST['cantidadRecibida'];



$_POST['cantidadRecibida']= round(($_POST['cantidadRecibida']/$iva),2);

$iva=$cantidadRecibida-$_POST['cantidadRecibida'];
$iva=round($iva,2);
}















//***************aplicar pago**********************

if($_POST['aplicarPago'] and $_POST['cantidadRecibida']  and $_POST['paciente']){


$sSQL311a= "Select  folioVenta From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_POST['folioVenta']."' ";
$result311a=mysql_db_query($basedatos,$sSQL311a);
$myrow311a = mysql_fetch_array($result311a);



if($myrow311a['folioVenta']){

$random=rand(100,100000000);
//**********************************SACO EL CLIENTE PRINCIPAL***************************

$sSQL3= "Select * From clientes WHERE entidad='".$entidad."' and numCliente = '".$_POST['seguro']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$s= "Select * From catTTCaja WHERE abonosOtros='si'   ";
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


$sSQL311= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_POST['folioVenta']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);






//**********************************CIERRO FOLIO DE VENTA***********************

//**************************NUMERO DE RECIBO********************
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
//*******************************************************************








//***********************************SOLO CUANDO ES DEVOLUCION************************************
if($_POST['devolucion']=='si'){
$s= "Select * From catTTCaja WHERE devolucionOtros='si'   ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$describe=$my['descripcion'];
$naturaleza=$my['naturaleza'];
$codigoTT=$my['codigoTT'];
$tipoCuenta='D';
$statusDevolucion='si';

$_POST['tipoPago']='devolucionAbonoOtros';
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
'".$myrow333a['CVI']."','".$myrow3g['keyCAP']."','1','pagosOtros','".$_POST['cantidadRecibida']."','".$iva."','".$_POST['cantidadRecibida']."',
'".$iva."','".$myrow3g['cantidadAseguradora']."','".$myrow3g['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow311['keyClientesInternos']."',
'".$_POST['folioVenta']."','".$myrow3g['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

//***************************************************




//*************************************************************************************
$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,
keyClientesInternos,statusCaja,descripcion,statusFactura,iva,horaSolicitud,fechaSolicitud,clientePrincipal,
folioVentaOtros,codigoCaja,numRecibo,numCorte,statusDevolucion,naturalezaCxC,random,tipoCuenta,descripcionArticulo,descripcionTransaccion,folioVenta,numMovimiento,
fechaCierre,
bancoTC,
codigoAutorizacion,
ultimosDigitos,
bancoCheque,
numeroCheque,
telefono,
numeroTransferencia,
bancoTransferencia
)
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','operacionCaja',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."'+'".$iva."','','standby','Otros','',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$cantidadAseguradora."','".$entidad."','".$_POST['tipoPago']."','cargado'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."',
'".$_POST['almacenDestino']."','".$_POST['almacenDestino1']."','".$myrow311['keyClientesInternos']."',
'pagado','".$myrow317z['descripcion']."','sinAplicar',
'".$iva."','".$hora1."','".$fecha1."','".$_POST['seguro']."','".$_POST['folioVenta']."',
'".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$statusDevolucion."','A','".$random."' ,'".$tipoCuenta."','".$my['descripcion']."' ,'pagosOtros' ,'".$myrow333a['CVI']."' ,'".$myrow333a['CVI']."',
    '".$fecha1."',
'".$_POST['bancoTC']."',        
'".$_POST['codigoAutTC']."',
    '".$_POST['ultimosDigitos']."',
        '".$_POST['bancoCheque']."',
            '".$_POST['numeroCheque']."',
                '".$_POST['telefono']."',
                    '".$_POST['numeroTransferencia']."',
                        '".$_POST['bancoTransferencia']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();










//*********************************************TRANSACCIONES****************************************












$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVentaOtros,codigoCaja,numRecibo,numCorte,statusDevolucion,tipoCuenta,descripcionArticulo,descripcionTransaccion,folioVenta,numMovimiento) 
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','A','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$myrow311['seguro']."','standby','compania','',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$cantidadAseguradora."','".$entidad."','".$_POST['tipoPago']."','cargado'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."','".$_POST['almacenDestino1']."',
'".$myrow311['keyClientesInternos']."','pagado','".$myrow317['descripcion']."','sinAplicar','".$hora1."','".$fecha1."','".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."',
'".$_POST['codigoAutorizacion']."','".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."','".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','si','standby',
'".$_POST['seguro']."','".$_POST['folioVenta']."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$statusDevolucion."' ,'".$tipoCuenta."' ,'".$describe."' ,'pagosOtros' ,'".$myrow333a['CVI']."' ,'".$myrow333a['CVI']."'  ) ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//**************************************************************************************
//print "Se hizo una venta";
?>





<script language="JavaScript" type="text/javascript">
  
//window.opener.document.forms["form1"].submit();
  
nueva('/sima/cargos/imprimirAbonosOtros.php?codigoCaja=<?php echo $myrowC['keyCatC'];?>&entidad=<?php echo $entidad; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $myrow311['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&cliente=<?php echo $_POST['responsableCuenta'];?>&cajero=<?php echo $usuario;?>&random=<?php echo $random;?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&numCorte=<?php echo $myrowC['numCorte'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&numMovimiento=<?php echo $myrow333a['CVI'];?>','ventanaSecundaria2','630','500','yes');
window.alert("Se hizo un abono a otros");
window.close();
</script>




<?php 
}else{
    //no existe ese folio de venta
    echo '<script>';
    echo 'window.alert("Verifica bien tus datos, no existe esa cuenta!");';
    echo '</script>';
}
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
    
    
<body>
<br />

<form id="form1" name="form1" method="post" >
    <table width="630" class="table-forma">
    <tr>

      <th colspan="3"   scope="col"><p align="center">Pagos Otras Cuentas</p></th>
    </tr>
	
	
	

	
     <tr>
       <td  scope="col">&nbsp;</td>
       <td width="135" >Tipo Pago/Cr&eacute;dito </td>
       <td width="480" >
	   
	   
	   <select name="tipoPago"  id="tipoPago" onChange="javascript:form.submit();" >
         <option
				 <?php if($_POST['tipoPago']=='Efectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
         <option
				 <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Transferencia Electronica">Transferencia Electronica</option>
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
       </select>
	   
	   
	   </td>
     </tr>
	 
	 
	 
	       <?php if($_POST['tipoPago']=='Tarjeta de Credito'){ ?>
	        <tr>
        <td   align="right">&nbsp;</td>
        <td ><span >Banco Tarjeta</span></td>
        <td ><span >
          <input name="bancoTC" type="text"  value="<?php echo $_GET['bancoTC'];?>"  />
        </span></td>
      </tr>
      <tr>
        <td   align="right">&nbsp;</td>
        <td ><span >Telefono</span></td>
        <td >
          <input name="telefono" type="text"  value="<?php echo $_GET['telefono'];?>" />
        </span></td>
      </tr>
      <tr>
        <td   align="right">&nbsp;</td>
        <td ><span >Ultimos 4 Digitos</span></td>
        <td >
        <label>
              <input name="ultimosDigitos" type="text"  id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onKeyPress="return checkIt(event)"/>
          </label>        </td>
      </tr>
      <tr>
        <td   align="right">&nbsp;</td>
        <td ><span >Codigo de Autorizaci&oacute;n</span></td>
        <td ><input name="codigoAutTC" type="text"  id="codigoAutTC" value="<?php echo $_GET['codigoAutTC']; ?>" /></td>
      </tr>
        <?php } ?>
	 
	 
	 
	 
	 
	  <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
     <tr>
	        <td  scope="col">&nbsp;</td>
	 	
       <td ># Transferencia</td>
       <td ><input name="numeroTransferencia" type="text"  id="numeroTransferencia" value="<?php echo $_GET['numeroTransferencia'];?>" size="50" /></td>
     </tr>
	 <?php } ?>
	
	
	
		    <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
           <tr>
             <td  scope="col">&nbsp;</td>
             <td > Banco Transferencia </td>
             <td ><input name="bancoTransferencia" type="text"  value="<?php echo $_GET['bancoTransferencia'];?>" size="50"  /></td>
           </tr>
 <?php } ?>		   
		   
<?php if($_POST['tipoPago']=='Cheque'){ ?>		   
      <tr>
       <td  scope="col">&nbsp;</td>
	   <td > N&uacute;mero Cheque </td>
       <td ><input name="numeroCheque" type="text"  id="numeroCheque" value="<?php echo $_POST['numeroCheque'];?>" /></td>
     </tr>
 <?php } ?>
	
	
	
	<?php if($_POST['tipoPago']=='Cheque'){ ?> 
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Banco Cheque</td>
       <td ><input name="bancoCheque" type="text"  id="bancoCheque" value="<?php echo $_GET['bancoCheque'];?>" size="50" /></td>
     </tr>
	 <?php } ?>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td><div align="left" >Responsable
           <input name="folioVenta" type="hidden"  id="folioVenta"   
		value="<?php if($_POST['folioVenta'] and !$_POST['nuevo']){ echo $_POST['folioVenta'];} ?>"  />
       </div></td>
       <td><input name="paciente" type="text"  id="responsableCuenta" size="60"
		value="<?php 
		 if($_POST['paciente'] and !$_POST['nuevo']){
		echo $_POST['paciente'];
		}
		?>"/>
         <span >         </span>
         <input name="tipoTransaccion" type="hidden"  id="tipoTransaccion" 
				value="<?php echo $myrow31['codigoTT'];?>" readonly=""/>
         <br /></td>
     </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td colspan="2"  class="style20">&nbsp;</td>
      </tr>
     <tr>
       <td  scope="col">&nbsp;</td>
       <td >Es Devolucion? </td>
       <td ><input name="devolucion" type="checkbox" id="devolucion" value="si" /></td>
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
	
	
	


  </table>
<label>
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
        </label>  
</form>
  <script>
		new Autocomplete("paciente", function() {
			this.setValue = function( id ) {
				document.getElementsByName("folioVenta")[0].value = id;
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
			return "/sima/cargos/responsablesOtrosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html><?php } else {
print 'La Caja esta cerrada...!';
}
?>