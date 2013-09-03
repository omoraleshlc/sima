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

$sSQLC = mysql_real_escape_string($sSQLC); 
 $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numCorte=$myrowC['numCorte'];


if($myrowC['status']=='abierta'){ //*******************Comienzo la validaci�n*****************

require("/configuracion/funciones.php"); 






if($_POST['aplicarPago'] and $_POST['cantidadRecibida'] and $_POST['seguro']){
$random=rand(100000,1000000000000);

//**********************************SACO EL CLIENTE PRINCIPAL***************************
$sSQL3 = mysql_real_escape_string($sSQL3); 
$sSQL3= "Select * From clientes WHERE entidad='".$entidad."' and numCliente = '".$_POST['seguro']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);




$s = mysql_real_escape_string($s); 
$s= "Select * From catTTCaja WHERE abonosAseguradoras='si'   ";
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
$q= mysql_real_escape_string($q); 
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


$sSQL311= mysql_real_escape_string($sSQL311); 
$sSQL311= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_POST['folioVenta']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);





//**********************************CIERRO FOLIO DE VENTA***********************

//**************************NUMERO DE RECIBO********************
$sSQLC = mysql_real_escape_string($sSQLC); 
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
//*******************************************************************





























//***********************************SOLO CUANDO ES DEVOLUCION************************************
if($_POST['devolucion']=='si'){
$s = mysql_real_escape_string($s);     
$s= "Select * From catTTCaja WHERE devolucionAbonoAseguradora='si'   ";
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
$statusDevolucion='';
$tipoCuenta='H';
}
//******************************************************************************************************

$sSQL333a = mysql_real_escape_string($sSQL333a); 
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
$agrega = mysql_real_escape_string($agrega); 
$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$agrega1 = mysql_real_escape_string($agrega1); 
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
















//**********************************************************
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}


$agrega = mysql_real_escape_string($agrega); 
$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//************************************




//*****************************************************************************
$agrega = mysql_real_escape_string($agrega); 
$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,
tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,
almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,
fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,
statusDevolucion,tipoCuenta,descripcionArticulo,random,descripcionTransaccion,abonosCxC,
numMovimiento,fechaCierre,numSolicitud,bancoTC)
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
'".$numCorte."','".$statusDevolucion." ' ,'".$tipoCuenta."' ,'".$describe."','".$random."' ,'pagosCxC','si', '".$myrow333a['CVI']."','".$fecha1."','".$n."',
    '".$_POST['bancoTC']."') ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//******************PARTIDA DOBLE******************************



//**************************NUMERO DE RECIBO********************
$sSQLCk = mysql_real_escape_string($sSQLCk); 
$sSQLCk= "Select keyCAP From cargosCuentaPaciente where entidad='".$entidad."' and numSolicitud='".$n."' and gpoProducto='' ";
$resultCk=mysql_db_query($basedatos,$sSQLCk);
$myrowCk = mysql_fetch_array($resultCk);
//*******************************************************************





$t=$_POST['cantidadRecibida']+$iva;
$agrega = mysql_real_escape_string($agrega); 
 $agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,descripcionGrupo,
entidad,status,fecha,hora,numFactura,codigo,naturaleza,seguro,clientePrincipal,
keyCAP,codPaquete,transaccion,numRecibo,statusPago,usuario,statusDevolucion

)
values 
(

'".$n."','".$myrow333a['CVI']."',1,
'".$t."','',
    '".$myrow6['gpoProducto']."',
    '".$describe."','".$myrow38['descripcionGP']."',
        '".$entidad."','pagado','".$fecha1."','".$hora1."','',
            '".$codigoTT."','A','".$_POST['seguro']."',
                '".$_POST['seguro']."','".$myrowCk['keyCAP']."',
                '".$rNombre23['codigoPaquete']."','si','".$myrowC['numRecibo']."',
                    '','".$usuario."','".$statusDevolucion."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//******************************************************************************


$agrega = mysql_real_escape_string($agrega); 
$agrega = "INSERT INTO movimientos (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,
almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,
statusDevolucion,tipoCuenta,descripcionArticulo,random,descripcionTransaccion,abonosCxC,numMovimiento) 
values 
('','','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."'+'".$iva."','".$myrow3['seguro']."','standby','','',
'".$_POST['cantidadRecibida']."'+'".$iva."',
'0.00','".$entidad."','".$_POST['tipoPago']."','cargado'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$myrow317['descripcion']."','sinAplicar','".$hora1."',
'".$fecha1."','".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."','".$_POST['numeroCheque']."',
    '".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','si','standby','".$_POST['seguro']."',
    '".$myrow333a['CVI']."' ,'".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','".$statusDevolucion."',
        '".$tipoCuenta."' ,'".$describe."','".$random."' ,'pagosCxC','si', '".$myrow333a['CVI']."') ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************



?>
<script language="JavaScript" type="text/javascript">
  


nueva('/sima/cargos/imprimirAbonosOtros.php?entidad=<?php echo $entidad; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $myrow311['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&seguro=<?php echo $_POST['seguro'];?>&cajero=<?php echo $usuario;?>&random=<?php echo $random;?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&numCorte=<?php echo $myrowC['numCorte'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&codigoCaja=<?php echo $myrowC['keyCatC'];?>&numMovimiento=<?php echo $myrow333a['CVI'];?>','ventanaSecundaria2','630','500','yes');

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
	<?php /*

    
	*/
	?>
<body>
<!--h1 align="center" >
 Pagos Cuentas Convenios
</h1-->
<br />
  <form id="form1" name="form1" method="post" action="">
    <table width="530" class="table-forma">
    <tr>
   
      <th colspan="3"   scope="col"><p align="center">Pagos Cuentas Convenios</p></th>
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
         </select></td>
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
        <td ><input name="codigoAutorizacion" type="text"  id="codigoAutTC" value="<?php echo $_GET['codigoAutorizacion']; ?>" /></td>
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
       <td><div align="left" >Seguro
         <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
       </div></td>
       <td><input name="nomSeguro" type="text"  id="nomSeguro" size="60" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
         

         <br /></td>
     </tr>




     <tr>
       <td  scope="col">&nbsp;</td>
       <td colspan="2"  >&nbsp;</td>
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
      <td >Devolucion?</td>
      <td ><label>
        <input name="devolucion" type="checkbox"  id="devolucion" value="si">
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
</html><?php } else {
print 'La Caja esta cerrada...!';
}
?>