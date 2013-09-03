<?php require("/configuracion/ventanasEmergentes.php");  require('/configuracion/funciones.php');require("/configuracion/clases/generaFolioVenta.php");?>


<?php 
if($_POST['update']){
$grupoProducto=new articulosDetalles();$descripcionGrupoProducto=new articulosDetalles();





//***************GENERAR FOLIO DE VENTA**********
//$generaFolio=new folioVenta();
//$FV=$generaFolio-> generarFolioVenta($_GET['keyClientesInternos'],$usuario,"paquete",$entidad,$tipoFolio,$basedatos);
//echo '<script>';
//echo 'window.alert("Se genero el folio de venta: '.$FV.'");';
//echo '</script>';
//***************************************
$FV=$_GET['folioVenta'];


//********************
 $borrame = "DELETE FROM facturaGrupos WHERE
entidad='".$entidad."'
    and
keyCAPMov='".$_GET['keyMOV']."'

";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

//********************EN CUANTO DEBE FACTURARSE************************
$sSQLd= "SELECT
*
FROM paquetes
WHERE
entidad='".$entidad."'
and
keypaq='".$_GET['keypaq']."'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


//*********************************************************************


//*************************
//$sSQL1d= "Select sum(precioPaquete1+ivaPrecioPaquete1) as importe
//    from articulosPaquetes
//WHERE
//entidad='".$entidad."'
//    and
//codigoPaquete='".$myrowd['codigoPaquete']."'
//    ";
//$result1d=mysql_db_query($basedatos,$sSQL1d);
//$myrow1d = mysql_fetch_array($result1d);


//******PORCENTAJE*********
//$porcentaje=$myrow1d['importe']/$myrowc['importe'];

//**************************


$codigo=$_POST['codigo'];
$keyCAP=$_POST['keyCAP'];
$nCuenta=$_GET['nCuenta'];
$keyE=$_POST['keyE'];		
		$coder=$_POST['coder'];
for($i=0;$i<=$_POST['flag'];$i++){
$iva=new articulosDetalles();


if($keyE[$i]){
  $sSQL= "Select keyE from articulosPaquetesPacientes
WHERE
entidad='".$entidad."'
    and
keyE='".$keyE[$i]."'

";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$codec=$myrow['codigo'];




$sSQL1= "Select * from articulosPaquetes
WHERE
entidad='".$entidad."'
    and
keyE='".$keyE[$i]."'";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




$tt=$myrow1['precioPaquete1'];

$it=$myrow1['ivaprecioPaquete1'];



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

$sSQL6abc="SELECT medico,descripcion
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


//$agrega = "INSERT INTO cargosCuentaPaciente (
//numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
//naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
//statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,
//porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,iva,
//horaSolicitud,fechaSolicitud,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,paquete,keyE,gpoProducto,ivaParticular,
//ivaAseguradora,descripcionArticulo,numMovimiento,tipoCuenta,
//almacenIngreso,descripcionAlmacen,descripcionGrupoProducto,diaNumerico,mes,year,descripcionClientePrincipal,descripcionMedico)
//values
//('".$myrow4a['numeroE']."','".$myrow4a['nCuenta']."','paquete',
//'".$usuario."','".$fecha1."','".$dia."','".$myrow1['cantidad']."','".$_POST['tipoTransaccion']."','".$myrow1['codigo']."',
//'".$hora1."','C','".$ID_EJERCICIOM."','','".$myrow52['almacenPadre']."','".$usuario."',
//'".$myrow1['precioPaquete1']."','".$myrow4a['seguro']."','standby','".$tipoCliente."','".$myrow4a['tipoPaciente']."',
//'".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','paquete','standby'
//,'paquete','cargadoR','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$myrow52['almacenPadre']."','".$myrow1['almacen']."',
//    '".$_GET['keyClientesInternos']."','pagado','".$_POST['descripcion']."','standby',
//'".$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos)."','".$hora1."','".$fecha1."','".$myrow455['clientePrincipal']."',
//'".$FV."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','si','".$keyE[$i]."','".trim($myrow1a['gpoProducto'])."',
//'".$ivaP."','".$ivaA."','".$myrow1a['descripcion']."' ,'".$myrow333['CVI']."','D','".$almacenIngreso."',
//'".$descripcionAlmacen."','".$descripcionGP."','".$diaNumerico."','".$mes."','".$year."','".$myrow455a['nomCliente']."',
//    '".$descripcionMedico."')";
//mysql_db_query($basedatos,$agrega);
//echo mysql_error();


$agrega = "INSERT INTO facturaGrupos (
entidad,numFactura,gpoProducto,extension,folioVenta,status,importe,iva,tipoTransaccion,keyCAP,naturaleza,keyCAPMov,codigo,porcentaje,keyE)
values ('".$entidad."','".$_GET['folioFactura']."','".$myrow1a['gpoProducto']."',1,'".$_GET['folioVenta']."',
    'request' ,'".$tt."' ,'".$it."',        '".$myrow5a['tipoPago']."' , '".$keyCAP[$i]."'  ,'C',
        '".$_GET['keyMOV']."','".$myrow1['codigo']."','".$porcentaje."' ,'".$keyE[$i]."')";
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


//$agrega1 = "INSERT INTO transaccionesVentas (
//numTransaccion,keyCAP,cantidad,descripcionArticulo,
//precioVenta,iva,
//cantidadParticular,ivaParticular,
//cantidadAseguradora,ivaAseguradora,
//usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
//) values (
//'".$myrow333['CVI']."','".$myrow['keyCAP']."' , '".$myrow1['cantidad']."','".$myrow1a['descripcion']."',
//'".$myrow1['precioPaquete1']."','".$iva->iva($entidad,$cantidad,$myrow1['codigo'],$myrow1['precioPaquete1'],$basedatos)."',
//'".$cantidadParticular."','".$ivaP."',
//'".$cantidadAseguradora."','".$ivaA."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow3['keyClientesInternos']."',
//'".$myrow3['folioVenta']."','".$_POST['almacenDestino']."','status'
//)";
//mysql_db_query($basedatos,$agrega1);
//echo mysql_error();
//******************************************CIERRA TRANSACCIONES*************************************



//**************************************************************************************





if(!$myrow101['id_almacen']){
$agregaAP = "INSERT INTO almacenesPaquetes (
codigoPaquete,keyClientesInternos,id_almacen,status,almacenPrincipal) 
values ('".$myrow1['codigoPaquete']."','".$_GET['keyClientesInternos']."','".$myrow52['almacenPadre']."','request','".$myrow52['almacenPadre']."')";
mysql_db_query($basedatos,$agregaAP);
echo mysql_error();
}
//**************************************************************************


}
}//cierra if

//***********PRORRATEO FINAL*************
$sSQLc= "SELECT
*
FROM facturacionconfigurada
WHERE
entidad='".$entidad."'
and
keypaq='".$_GET['keypaq']."'

";


$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);

$sql5= "
SELECT sum(importe+iva) as ia
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
numFactura='".$_GET['folioFactura']."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

if($myrow5['ia']>0){
$porcentaje=$myrowc['importe']/$myrow5['ia'];
}


$sql5= "
SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
numFactura='".$_GET['folioFactura']."'

";
$result5=mysql_db_query($basedatos,$sql5);
while($myrow5= mysql_fetch_array($result5)){
$importes=$myrow5['importe']*$porcentaje;
$isa=$myrow5['iva']*$porcentaje;


$sql3= "UPDATE facturaGrupos set

importe='".$importes."',iva='".$isa."'
where
entidad='".$entidad."'
    and
    keyE='".$myrow5['keyE']."'
    and
numFactura='".$_GET['folioFactura']."'

";

mysql_db_query($basedatos,$sql3);
echo mysql_error();
}
//************************************

?>
<script>
//window.close();
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

<h3 align="center" class="titulos">Escoje los articulos a facturar </h3>
<p align="center" class="negro"><?php //echo //$_GET['paciente'];?></p>
<form id="form" name="form" method="post" action="" >
  <p>&nbsp;</p>
  <table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="7"><img src="../imagenes/bordestablas/borde1.png" width="550" height="16" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="4" class="negromid">#</td>
      <td width="100" bgcolor="#FFFF00" class="negromid">Descripcion</td>
      <td width="26" class="negromid">C</td>
      <td width="50" class="negromid">Precio </td>
      <td width="40" class="negromid">IVA</td>
      <td width="50" class="negromid">Precio F </td>
      <td width="40" class="negromid">IVAF </td>


      <td width="32" class="negromid">Edit</td>
    </tr>





      
<?php	
$sSQL= "SELECT
*, articulosPaquetes.keyE as k
FROM
paquetes,articulosPaquetes
WHERE paquetes.keyPAQ = '".$_GET['keypaq']."'
    and
    articulosPaquetes.codigoPaquete=paquetes.codigoPaquete
    
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

$sSQL31a= "Select *
    From cargosCuentaPaciente
WHERE
keyCAP='".$myrow['keyCAP']."'


";
$result31a=mysql_db_query($basedatos,$sSQL31a);
$myrow31a = mysql_fetch_array($result31a);



$sSQL31= "Select existencias.almacen,articulos.descripcion,articulos.codigo as code,articulos.keyPA as kp From articulos,existencias
WHERE 
articulos.entidad='".$entidad."'
and
articulos.codigo='".$myrow['codigo']."'
and
articulos.codigo=existencias.codigo";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);





$sSQL313= "Select descripcion,medico from almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'
";
$result313=mysql_db_query($basedatos,$sSQL313);
$myrow313 = mysql_fetch_array($result313);

$totalPrecio[0]+=$myrow['precioPaquete1'];



$sql5= "
SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
numFactura='".$_GET['folioFactura']."'
    and
keyE='".$myrow['keyE']."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
?>
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
      <td height="4" class="codigos"><span class="normal">
        <input name="coder[]" type="hidden" class="codigos" id="flag" value="<?php echo $myrow['keyPA'];?>" />
        <?php echo $a; ?>
      </span></td>
      <td class="normalmid"><span class="normal">
  
		
    <?php   
    if($myrow313['medico']=='si'){
        echo $myrow313['descripcion'];
    }else{
    echo $myrow['descripcionArticulo'];
    }
    ?>

              </br>

              <?php //echo $myrow['keyE'];?>
      </span></td>
      <td class="normal"><?php echo '1';?></td>





      <td class="normal"><span class="cargos"><?php
      $importe[0]+=$myrow['precioPaquete1'];
      echo "$".number_format($myrow['precioPaquete1'],2);?></span></td>
      
      <td class="normal">
          <span class="negro">
      <?php
      $ivas[0]+=$myrow['ivaPaquete1'];
      echo "$".number_format($myrow['ivaPaquete1'],2);?>
          </span>
      </td>

















      
            <td class="normal"><span class="cargos"><?php
            if($myrow5['importe']>0){
      $importeF[0]+=$myrow5['importe'];
      echo "$".number_format($myrow5['importe'],2);
            }else{
          echo '$0.00';
      }
      ?></span></td>


      <td class="normal"><span class="negro">
      <?php
      if($myrow5['iva']>0){
      $ivasF[0]+=$myrow5['iva'];
      echo "$".number_format($myrow5['iva'],2);
      }else{
          echo '$0.00';
      }
      ?></span></td>


   <input name="codigo[]" type="hidden" id="keyE[]" value="<?php echo $myrow['codigo'];?>" />
   <input name="keyCAP[]" type="hidden" id="keyE[]" value="<?php echo $myrow['keyCAP'];?>" />





      <td class="normal"><?php if($myrow['tipoArticulo']){ ?>
        <input name="keyE[]" type="checkbox" id="keyE[]" value="<?php echo $myrow['k'];?>"  <?php if(!$myrow['tipoArticulo']) echo 'disabled=""';?>/>
        <?php } else { ?>
        <img src="../imagenes/btns/checkbtn.png" width="16" height="16" />
         <input name="keyE[]" type="hidden" id="keyE[]" value="<?php echo $myrow['k'];?>" />
        <?php } ?></td>
    </tr>

      
    <?php  }}?>

          <tr>
      <td colspan="7" >

          <div class="precio1" align="center">Total: <?php echo '$'.number_format($importe[0]+$ivas[0],2);?>   (iva incluido)  ---
          <?php echo '$'.number_format($importeF[0]+$ivasF[0],2);?>
          </div>

    
      </td>
    </tr>

    <tr>
      <td colspan="7"><img src="../imagenes/bordestablas/borde2.png" width="550" height="16" /></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center">
    <label>
    <input name="update" type="submit" class="boton1" id="update" value="Actualizar Cambios" />
	<input name="flag" type="hidden" class="style7" id="update" value="<?php echo $a;?>" />

    </label>
    <input name="codigoPaquete" type="hidden" id="codigoPaquete" value="<?php echo $_GET['codigoPaquete'];?>" />

      <input name="total" type="hidden" class="style7" id="numeroE" value="<?php echo $importe[0]+$ivas[0];?>" />
  </p>
</form>
  <p></p>
  
  <?php //echo $importe[0]+$ivas[0];?>
</body>
</html>
