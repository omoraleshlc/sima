<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');require("/configuracion/clases/generaFolioVenta.php");?>




<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventanaSecundaria6","width=400,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") ;
   //if(parent.Windows){
     //parent.Windows.close("dialog3", null);
   //}



} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=500,height=500,scrollbars=YES") 
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

if( $_POST['aplicarPago'] AND $_POST['seguro']!=NULL){
       
        if($_POST['descripcion']!=NULL AND $_POST['cantidadRecibida']>0 and $_POST['almacenDestino'] and $_POST['folioVenta']){
//***************GENERAR FOLIO DE VENTA**********
$generaFolio=new folioVenta();
$FV=$generaFolio-> generarFolioVenta("0",$usuario,"notaCredito",$entidad,$tipoFolio,$basedatos);
//***************************************




$cantidadRecibida=$_POST['cantidadRecibida'];
if($_POST['iva']=='si'){

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




$_POST['cantidadRecibida']= round(($_POST['cantidadRecibida']/$iva),2);

$iva=$cantidadRecibida-$_POST['cantidadRecibida'];
$iva=round($iva,2);

}



if($_POST['seguro']!=NULL){
    $cantidadAseguradora=$_POST['cantidadRecibida'];
    $ivaAseguradora=$iva;
    $cantidadParticular=NULL;
    $ivaParticular=NULL;
}else{
    $cantidadParticular=$_POST['cantidadRecibida'];
    $ivaParticular=$iva;
    $cantidadAseguradora=NULL;
    $ivaAseguradora=NULL;
}





		

//********************************************************************
$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$random=rand(1000,10000000000);




$sSQL3= "Select * From clientesInternos WHERE entidad = '".$entidad."' and folioVenta='".$_POST['folioVenta']."'    ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


//*********************************ENCABEZADO**************************************
$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,statusCuenta,statusDeposito,
almacenSolicitud,horaSolicitud,fechaSolicitud,expediente,clientePrincipal,nombreCliente,folioVenta,codigoCaja,numRecibo,numCorte,tipoPago,statusCaja
) values (

'','',
'".$myrow3['medico']."',
'".$myrow3['paciente']."',
'".$_POST['seguro']."',
'".$usuario."',
'".$myrow3['credencial']."',
'".$fecha1."',
'".$hora1."',
'notaCredito',
'".$myrow3['cita']."',
'".$_POST['almacenDestino']."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$myrow3['medicoForaneo']."','".strtoupper($myrow3['observaciones'])."','".$myrow3['edad']."','".$myrow3['tipoPaciente']."',
'".$nOrden."','','".$myrow3['dependencia']."','".$myrow3['entidad']."','".$myrow3['diagnostico']."',
    '".$myrow3['telefono']."','notaCredito','','".$myrow3['almacen']."','".$hora1."','".$fecha1."',
        'no','".$_POST['seguro']."','".$_POST['nombreCliente']."','".$FV."',
            '".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','notaCredito',''

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();











$total=$_POST['cantidadRecibida']+$iva;
$totalParticular=$cantidadParticular+$ivaParticular;
$totalAseguradora=$cantidadAseguradora+$ivaAseguradora;

//CARGO AL DEPARTAMENTO
$sSQL3= "Select * From clientesInternos WHERE entidad = '".$entidad."' and folioVenta='".$FV."'    ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,
almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,bancoTC,telefono,clientePrincipal,
folioVenta,codigoCaja,numRecibo,numCorte,descripcionArticulo,tipoCuenta,random,descripcionTransaccion,
ivaParticular,numMovimiento,statusDevolucion,ventasDirectas,fechaCierre,notaCredito,descripcionClientePrincipal,statusCuenta)
values 
('','','notaCredito',
'".$usuario."','".$fecha1."','".$dia."','1','','".$hora1."',
'".$hora1."','A','".$ID_EJERCICIOM."','','".$ALMACEN."','".$usuario."',
'".$total."','".$seguro."','standby','externo','externo',
'".$totalParticular."','".$totalAseguradora."','".$entidad."','".$_POST['tipoPago']."','standby',
'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."',
'".$_POST['almacenDestino1']."','".$myrow3['keyClientesInternos']."','pagado','".$_POST['tipoPago']."','pagado','".$hora1."','".$fecha1."',
'".$_POST['codigoTarjeta']."','".$_POST['ultimosDigitos']."','".$_POST['codigoAutorizacion']."',
    '".$_POST['numeroCheque']."','".$_POST['bancoTransferencia']."',
'".$_POST['bancoCheque']."','".$_POST['numeroTransferencia']."','".$_POST['bancoTC']."','".$_POST['telefono']."','".$_POST['seguro']."',
'".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','CARGO AL DEPARTAMENTO','D' 
    '".$random."' ,'".$descripcionTransaccion."','','', '".$myrow333a['CVI']."','".$statusDevolucion."',
        '','".$fecha1."' ,'si','".$myrow455['nomCliente']."','notaCredito')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//**************************************************************************************






//PARTIDA DOBLE o DOBLE PARTIDA
//ACREDITAR A LA CUENTA DEL PACIENTE


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,statusCargo,
porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,fechaSolicitud,
folioVenta,descripcionArticulo,tipoCuenta,random,descripcionTransaccion,ivaParticular,ivaAseguradora,gpoProducto,statusDevolucion,numMovimiento,
fechaCargo,ventasDirectas,fechaCierre,notaCredito,descripcionClientePrincipal,statusCuenta,clientePrincipal)
values 
('','','notaCredito',
'".$usuario."','".$fecha1."','".$dia."','1','','".$hora1."',
'".$hora1."','C','".$ID_EJERCICIOM."','','".$_POST['almacenDestino']."','".$usuario."',
'".$_POST['cantidadRecibida']."','".$iva."', '".$seguro."','standby','externo','externo',
'".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','','standby',
'cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."','".$_POST['almacenDestino']."',
    '".$myrow3['keyClientesInternos']."','pagado','','pagado','".$hora1."','".$fecha1."',
'".$FV."','".$_POST['descripcion']."','H' ,'".$random."' ,'','".$ivaParticular."' ,'".$ivaAseguradora."','-','".$statusDevolucion."',
    '".$myrow333a['CVI']."' ,'".$fecha1."' ,'',
    '".$fecha1."','si','".$myrow455['nomCliente']."','notaCredito','".$_POST['seguro']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error(); 
























print "Se hizo una venta";
?>

<?php
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje("Se genero el folio de venta: ".$FV);
?>

<script>
javascript:ventanaSecundaria6('../ventanas/imprimirReciboNC.php?folioVenta=<?php echo $FV; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&entidad=<?php echo $entidad;?>&codigoCaja=<?php echo $myrowC['keyCatC'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&numCorte=<?php echo $numCorte;?>');
window.close();
</script>


<?php 

        }else{

$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje("TE FALTAN CAMPOS POR LLENAR!");
     
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
<h1 align="center" ></h1>
  <form id="form1" name="form1" method="post" action="">
    <table width="400" class="table-forma">
    <tr>
      <th width="1"  scope="col">&nbsp;</th>
    <th colspan="2"   scope="col">
    <p align="center"></p>
    </th>
    </tr>
	
	
	
	
<tr >
        <td height="45" >&nbsp;</td>
        <td >Aseguradora
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td colspan="4"><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span >(Exclusivo Aseguradoras)</span></td>
      </tr>
      
      
      
      
     
	 
	 
     <tr>
       <td  scope="col">&nbsp;</td>
       <td colspan="2"  ><div align="center" >Datos del Cliente e Importe</div></td>
      </tr>
<tr>
       <td  scope="col">&nbsp;</td>
       <td><div align="left" >**FolioVenta**
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
      <td >Descripci&oacute;n</td>
      <td >
	  <textarea name="descripcion" cols="50"  id="descripcion"><?php echo $_POST['descripcion'];?></textarea></td>
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
       <td >IVA </td>
       <td ><input name="iva" type="checkbox" id="iva" value="si" <?php if($_POST['iva']!=NULL){echo 'checked=""';}?> /></td>
     </tr>
     <tr>
      <td width="1"  scope="col">&nbsp;</td>
      <td >Importe</td>
      <td >
      <label>
      <input name="cantidadRecibida" type="text"  id="cantidadRecibida" value="<?php echo $_POST['cantidadRecibida'];?>" autocomplete="off">
      </label>
      </td>
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
			return "/sima/cargos/foliosVentax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
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
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>

</body>
</html>