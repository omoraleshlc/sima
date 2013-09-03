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

if($_POST['aplicar'] and (is_numeric($_POST['porcentaje']) or $_POST['tipoTransaccion']) ){


if($_POST['porcentaje']){
if($_POST['cargosHospitalarios']=='si'){
$banderaPM=new acumulados();
$_POST['cantidadRecibida']=$banderaPM->banderaPorcentajeMedicamentos($entidad,$basedatos,$usuario,$numeroE,$nCuenta);
$_POST['cantidadRecibida']=porcentaje($_POST['cantidadRecibida'],$_POST['porcentaje'],$decimales);
} else {
$_POST['cargosHospitalarios']='no';
$cargosGlobales=new acumulados();
$_POST['cantidadRecibida']=$cargosGlobales->cargosGlobalesCoaseguro($entidad,$basedatos,$usuario,$numeroE,$nCuenta);	
$_POST['cantidadRecibida']=porcentaje($_POST['cantidadRecibida'],$_POST['porcentaje'],$decimales);
}
}
$cantidadRecibida=$_POST['cantidadRecibida'];


$naturaleza='-';







if($myrow3['seguro'] and $myrow3['seguro']!='0'){
$cantidadAseguradora=$_POST['cantidadRecibida'];

}else{
$cantidadParticular=$_POST['cantidadRecibida'];

}



//********************COMPRUEBO SI EL COASEGURO YA ESTA DEFINIDO*************************
$sSQL317= "Select tipoTransaccion From cargosCuentaPaciente WHERE 
keyClientesInternos='".$myrow3['keyClientesInternos']."'
and
tipoTransaccion = '".$_POST['tipoTransaccion']."'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);	
//***************************************************************************************




if($_POST['tipoTransaccion']=='coaseguro1' or $_POST['tipoTransaccion']=='coaseguro2'){
$tp='coaseguro';
if($_POST['tipoTransaccion']=='coaseguro1'){
$descripcionArticulo='Aplicacion de Coaseguro 1';
$s= "Select codigoTT From catTTCaja WHERE coaseguro1='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$codigoTT=$my['codigoTT'];
}else{
$descripcionArticulo='Aplicacion de Coaseguro 2';
$s= "Select codigoTT From catTTCaja WHERE coaseguro2='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$codigoTT=$my['codigoTT'];

}
}else{

$tp='deducible';
if($_POST['tipoTransaccion']=='deducible1'){
$descripcionArticulo='Aplicacion de Deducible 1';
$s= "Select codigoTT From catTTCaja WHERE deducible1='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$codigoTT=$my['codigoTT'];

}else{
$descripcionArticulo='Aplicacion de Deducible 2';
$s= "Select codigoTT From catTTCaja WHERE deducible2='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$codigoTT=$my['codigoTT'];

}
}






if($myrow317['tipoTransaccion']){

print '<span class="style1">'.'<blink>'.'Error: Ya aplicacaste ese movimiento!'.'</blink>'.'</span>';

} else {
$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,keyClientesInternos,folioVenta,descripcionArticulo) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','-','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$cantidadRecibida."','".$seguro."','standby','coaseguro','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$numCorte."','".$entidad."','".$tp."','standby'
,'".$_GET['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$ALMACEN."','".$myrow3['keyClientesInternos']."','".$_GET['folioVenta']."','".$descripcionArticulo."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$leyenda= "Se actualizaron registros";

}
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
  
  
  
    <table width="300" border="0" class="style7" cellspacing="0">
      <tr>
        <td colspan="3"><img src="../imagenes/bordestablas/borde1.png" width="300" height="21" /></td>
      </tr>
    </table>
    <table width="300" border="0" class="style7" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <td width="95"><div align="right" class="negromid">Tipo</div></td>
        <td width="159"><label>
          <select name="tipoTransaccion" class="normalmid" id="tipoTransaccion">
            <option value="coaseguro1">coaseguro1</option>
            <option value="coaseguro2">coaseguro2</option>
            <option value="deducible1">deducible1</option>
            <option value="deducible2">deducible2</option>
            </select>
        </label></td>
        <td width="42">&nbsp;</td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td>&nbsp;</td>
        
        <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td><div align="right" class="negromid">Importe $</div></td>
        <td><input name="cantidadRecibida" type="text" class="style7" id="cantidadRecibida" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CCCCCC">
        <td colspan="3">        <div align="center">
          <input name="aplicar" type="submit" src="../imagenes/btns/continuebtn.png"  id="aplicar" value="Aplicar" <?php echo $statusD?> />      
        </div></td>
      </tr>
      <tr>
        <td colspan="3"><img src="../imagenes/bordestablas/borde2.png" width="300" height="21" /></td>
      </tr>
    </table>
  </div>
  <p align="center" class="style7"><?php echo $leyenda;?>
    <label>
    <input name="totalCargos" type="hidden" class="style7" id="totalCargos" value="<?php echo $acumulado;?>" />
    <input name="keyCAP" type="hidden" class="style7" id="totalCargos" value="<?php echo $keyCAP;?>" />
    <input name="nT" type="hidden" class="style7" id="totalCargos" value="<?php echo $_GET['nT']?>" />
    </label>
    <label></label>
    <input name="almacen" type="hidden" class="style7" id="almacen" value="<?php echo $_GET['almacen'];?>" />
  </p>
  <p align="center"><span class="style7"> </span>

  </p>
</form>
<p>&nbsp;</p>
