<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php



//***************aplicar pago**********************

if($_POST['aplicar'] and (is_numeric($_POST['numPoliza']) and $_POST['descripcion']) ){


    
    
    
    
    
    
    
    
    
    

$agrega = "INSERT INTO headingPolicies ( 
numPoliza,usuario,hora,fecha,descripcion,entidad
) values (
'".$_POST['numPoliza']."',
'".$usuario."',
'".$hora1."',
'".$_GET['fecha']."',
'".$_POST['descripcion']."',
'".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();    
    
    
    
    
    
//trae todos los movimientos
$sSQL1= "Select * From cargosCuentaPaciente WHERE entidad='".$entidad."'
and
fechaCargo='".$_GET['fecha']."'
    and
gpoProducto!=''";



$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

    
    
//*******GRABA EN HISTORIAL DE MOVIMIENTOS*******
    
$agrega = "INSERT INTO polizas (
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

descripcionClientePrincipal,descripcionMedico,primeraVez,statusDescuento,numPoliza
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

'".$myrow1['descripcionClientePrincipal']."','".$myrow1['descripcionMedico']."','".$myrow1['primeraVez']."','".$myrow1['statusDescuento']."',
    '".$myrow1['numPoliza']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();    
}    
//***********************************************    
    
    
    
    
       
    
    
echo '<script>
  <!--
    
    window.opener.document.forms["form1"].submit();
   window.close();
  // -->
</script>'; 
}

?>

<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

<form name="form1" method="post" action="">
  <p align="center" class="titulos">Aplicar Coaseguro</p>
  <div align="center">
  
  
  

    <table width="300" class="table-forma" >


      <tr >
        <td><div align="right" ># Poliza</div></td>
        <td><input name="numPoliza" type="text"  id="numPoliza" size="11" /></td>
      </tr>
      <tr >
        <td><div align="right" >Descripcion</div></td>
        <td><textarea name="descripcion" rows="2" cols="20"></textarea>
        
        </td>
      </tr>
      <tr >
        <td colspan="3">        <div align="center">
          <input name="aplicar" type="submit" src="../imagenes/btns/continuebtn.png"  id="aplicar" value="Aplicar" onClick="if(confirm('Este proceso puede tardar varios minutos, deseas continuar? <?php echo $paciente;?>?') == false){return false;}"/>      
        </div></td>
      </tr>

    </table>
  </div>
  <p align="center" ><?php echo $leyenda;?>
    <label>
    <input name="totalCargos" type="hidden"  id="totalCargos" value="<?php echo $acumulado;?>" />
    <input name="keyCAP" type="hidden"  id="totalCargos" value="<?php echo $keyCAP;?>" />
    <input name="nT" type="hidden"  id="totalCargos" value="<?php echo $_GET['nT']?>" />
    </label>
    <label></label>
    <input name="almacen" type="hidden"  id="almacen" value="<?php echo $_GET['almacen'];?>" />
  </p>
  <p align="center"><span > </span>

  </p>
</form>
<p>&nbsp;</p>
