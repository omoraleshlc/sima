<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php
$ALMACEN=$_GET['almacen'];
if(!$_GET['nT']){
$_GET['nT']=$_POST['nT'];
}
require("/configuracion/funciones.php"); 
//************************ACTUALIZO **********************

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['nT']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];



//***************aplicar pago**********************

if($_POST['aplicar'] and $_POST['cantidadRecibida'] and $_POST['tipoPago'] ){













if($_POST['tipoPago']=='Aseguradora' ){

$cantidadAseguradora=$_POST['cantidadRecibida'];
$s= "Select * From catTTCaja WHERE aplicarDescuentoAseguradoras='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

}else{

$cantidadParticular=$_POST['cantidadRecibida'];
$s= "Select * From catTTCaja WHERE aplicarDescuentoParticulares='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

}

$codigoTT=$my['codigoTT'];
$descripcionArticulo=$my['descripcion'];




if(!$codigoTT){
echo '<script>
  <!--
    window.opener.document.forms["form1"].submit();
	window.alert("IMPOSIBLE APLICAR DESCUENTOS, FAVOR DE CONTACTAR A SISTEMAS");
   window.close();
  // -->
</script>'; 
}









$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,keyClientesInternos,folioVenta,descripcionArticulo) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$_POST['cantidadRecibida']."','".$seguro."','standby','coaseguro','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."', '".$numCorte."','".$entidad."','".$tp."','standby'
,'".$_GET['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$ALMACEN."','".$myrow3['keyClientesInternos']."','".$_GET['folioVenta']."','".$descripcionArticulo."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$agrega = "UPDATE clientesInternos set 
descuento='si',

usuarioDescuento='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();




echo '<script>
  <!--
    window.opener.document.forms["form1"].submit();
	window.alert("Descuento Aplicado");
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
  <p align="center" class="titulos">Aplicar Descuento por Cantidad </p>
  <div align="center">
  
  
  
 
    <table width="300" class="table-forma">
      <tr >
        <td width="95"><div align="right" >Tipo</div></td>
        
        <td width="159"><label>
          <select name="tipoPago" id="tipoPago">
		  <option value="">Escoje</option>
		<?php 
		if($_GET['triggerParticular']>0){
        echo '<option value="Particular">Particular</option>';
		}
		 if($_GET['triggerAseguradora']>0){ 
        echo '<option value="Aseguradora">Aseguradora</option>';
		}
		?>
          </select>
        </label></td>
         <td width="42">&nbsp;</td>
      </tr>
      <tr >
        <td><div align="right" >Importe $</div></td>
        <td><input name="cantidadRecibida" type="text"  id="cantidadRecibida" /></td>
        <td>&nbsp;</td>
      </tr>



    </table>
    <br />
       <div align="center">
          <input name="aplicar" type="submit" class="boton1"  id="aplicar" value="Aplicar" <?php echo $statusD?> />      
        </div>
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
