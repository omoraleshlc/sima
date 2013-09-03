<?php require("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/clases/eCuentaGrafico.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.tipoTransaccion.value) == false ) {   
                alert("Escoje el Tipo de Transacción que desees hacer!")   
                return false   
        }  else if( vacio(F.cantidadRecibida.value) == false ) {   
                alert("Escribe la cantidad!")   
                return false   
        }                     
		
		
}   
  
</script> 
<?php 
$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$cargosParticulares=new  acumulados();	
$cargosCortesia=new acumulados();

if($_GET['almacen']){
$almacenFuente=$_GET['almacen'];
} else {
$almacenFuente=$_POST['almacenFuente'];
}




$TOTAL=$_GET['TOTAL'];
$iva=$_GET['iva'];
$numeroCuenta=$_GET['nCuenta'];
$descuento=$_GET['descuento'];
$depositos=$_GET['depositos'];
$devolucion=$_GET['cantidadRecibida']-$TOTAL;
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($numeroE=$myrow3['numeroE'] AND $nCuenta=$myrow3['nCuenta']){
$tipoPaciente=$myrow3['tipoPaciente'];
$tipoTrans=$myrow3['tipoTransaccion'];
$compania=$myrow3['seguro'];
?>


<?php //************************ACTUALIZO PRECIOS**********************


//*****************************Verificando caja abierta**************************
 $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numRecibo=$myrowC['numRecibo'];



if($myrowC['status']=='abierta' ){ //*******************Comienzo la validación*****************
$numCorte=$myrowC['numCorte'];
//********************Llenado de datos
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$seguro=$myrow3['seguro'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$tipoPaciente=$myrow3['tipoPaciente'];
//***************aplicar pago**********************



if($_GET['aplicarPago'] AND $_GET['cantidadRecibida'] AND $_GET['tipoTransaccion']){
$numeroConfirmacion=rand();
$q = "UPDATE clientesInternos set 
status='devolucion',
statusDeposito='pagado',
statusCuenta='abierta'
WHERE numeroE = '".$numeroE."' and nCuenta='".$nCuenta."'";
mysql_db_query($basedatos,$q);
echo mysql_error();


//*********************actualiza el status de la caja***********************/
if($tipoPaciente=='externo'){
$q1 = "UPDATE cargosCuentaPaciente set 
statusCaja='pagado',numCorte='".$numCorte."'
WHERE 
status!='transaccion'
and
numeroE = '".$numeroE."' and nCuenta='".$nCuenta."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
//**************************************************


$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$_GET['tipoTransaccion']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];

if($naturaleza=='Abono'){
$cantidadParticular=$_GET['cantidadRecibida'];
$naturaleza='A';
} else if($naturaleza=='Cargo'){
$cantidadAseguradora=$_GET['cantidadRecibida'];
$naturaleza='C';
} else if($naturaleza=='Credito'){
$naturaleza='A';
}

if($_GET['tipoCliente']=='aseguradora'){




$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."'
WHERE 
tipoCliente='".$_GET['tipoCliente']."'
And
numeroE='".$numeroE."' and nCuenta='".$nCuenta."'
and
entidad='".$entidad."' and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
} else if($_GET['tipoCliente']=='particular'){
$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."'
WHERE 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."'
and
tipoCliente='particular'
And
entidad='".$entidad."'  and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
} else if($_GET['tipoCliente']=='otros'){
$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."'
WHERE 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."'
and
tipoCliente='otros'
And
entidad='".$entidad."'  and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
} else if($_GET['tipoCliente']=='coaseguro'){






 $q1 = "UPDATE cargosCuentaPaciente set 
 statusFactura='standby',
statusTraslado='trasladado',
naturaleza='A',
usuarioTraslado='".$usuario."',
tipoCliente='coaseguro',
status='devolucion'
WHERE 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."'
and
tipoTransaccion='".$_GET['tipoTransaccion']."'
and
tipoCliente='coaseguro'
And
entidad='".$entidad."'  and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}


if($_GET['tipoPago']=='Credito'){
$cantidadAseguradora=$_GET['cantidadRecibida'];
$cantidadParticular='';
} else {
$cantidadAseguradora='';
$cantidadParticular=$_GET['cantidadRecibida'];
}


//*********************COMPRUEBO SI OTRO CAJERO YA METIO ALGUNA TRANSACCION********************************



//********************************************************************************************************

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja) 
values 
('".$numeroE."','".$nCuenta."','devolucion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_GET['tipoTransaccion']."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$ALMACEN."','".$usuario."',
'".$_GET['cantidadRecibida']."','".$seguro."','".$statusTraslado."','".$_GET['tipoCliente']."','".$tipoPaciente."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby'
,'".$_GET['tipoPago']."','".$ALMACEN."','".$numeroCuenta."','standby','cargado','standby','".$numRecibo."','".$myrow3['folioVenta']."','".$myrowC['keyCatC']."','pagado')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();









if($myrow3['tipoPaciente']=='externo'){
$q1 = "UPDATE cargosCuentaPaciente set 
naturaleza='".$naturaleza."',
tipoTransaccion='".$_GET['tipoTransaccion']."',

numCorte='".$numCorte."'
WHERE entidad='".$entidad."' AND numeroE = '".$numeroE."' and nCuenta='".$nCuenta."' and status='cargado'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}


//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************

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
echo '<script type="text/vbscript">
msgbox "SE HIZO UN MOVIMIENTO!"
</script>';
$leyenda='Se hizo un Movimiento';


?>

<?php 
if($myrow3['tipoPaciente']=='externo'){?>
<script>
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>

<?php } else { 

$sSQL333= "Select keyCAP From cargosCuentaPaciente WHERE status='transaccion' and usuario = '".$usuario."' order by keyCAP DESC";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333);

//aqui no imprimes todo, solamente la transacción que hizo
?>

<?php if($_GET['tipoMovimiento']=='transaccion'){ //imprimir solo la transaccion?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternos.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>');
  <!--
window.opener.document.forms["form1"].submit();
self.close();
</script>
<?php } else { //imprimir todo?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternosCC.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>');
  <!--
window.opener.document.forms["form1"].submit();
self.close();
</script>
<?php }}?>





<?php 
}
//*************************************************
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
.style8 {
	color: #0000FF;
	font-weight: bold;
}
.style12 {font-size: 10px}
.Estilo26 {color: #FFFFFF}
.Estilo27 {font-size: 10px; color: #FFFFFF; }
.Estilo29 {font-size: 10px; font-weight: bold; }
.Estilo33 {font-size: 10px; color: #000000; }
.style14 {font-size: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
</head>

<body>
<p>&nbsp;</p>













<form id="form1" name="form1" method="GET" action="" >
  <table width="442" height="337" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo24">
    <tr bgcolor="#990033" align="center">
      <td><b><font color="#FFFFFF">Totales</font></b></td>
    </tr>
    <tr bgcolor="#990033">
      <td><table width="99%" height="320" border="0" cellpadding="4" cellspacing="0">
          <tr bgcolor="#FFFFFF">
            <td width="20%" class="Estilo24">Tipo </td>
            <td width="80%" class="Estilo24">
			<?php 
			if( !$_GET['tipoPago']){
			$_GET['tipoPago']='Efectivo';      
			 } ?>
			<input name="tipoPago" type="text" class="style7"  value="Efectivo" readonly=""/></td>
          </tr>
          <tr bgcolor="#FFFFFF">
		  
		  
		  
		  
		  
		  
		  
		  
		  <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
            <td class="Estilo24">C&oacute;digo de Tarjeta</td>
            <td class="Estilo24"><input name="codigo" type="text" class="Estilo24" id="codigo" 
		 value="<?php 
		 if($_GET['nuevo']){
		 echo "0000000000";
		 } else if($myrow2['codigo']){
		 echo $myrow2['codigo']; 
		 }
		 ?>" size="10" readonly=""/>
              <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&descripcion=<?php echo "descripcion"; ?>&forma=<?php echo "form1"; ?>&comision=<?php echo "comision"; ?>&tipoPago=<?php echo $_GET['tipoPago'];?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></td>
         
		  <input name="comision" type="hidden" value="">
		  </tr>
          <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF" class="Estilo24">Banco Tarjeta</td>
            <td bgcolor="#FFFFFF" class="Estilo24"><input name="descripcion" type="text" class="style7" value="<?php echo $_GET['descripcion'];?>"  readonly=""/></td>
          </tr>
	
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">&Uacute;ltimos 4 D&iacute;gitos</td>
            <td class="Estilo24"><label>
              <input name="ultimosDigitos" type="text" class="style7" id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onKeyPress="return checkIt(event)"/>
            </label></td>
          </tr>	 
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">C&oacute;digo de Aut. </td>
            <td class="Estilo24"><label>
              <input name="codigoAutTC" type="text" class="style7" id="codigoAutTC" value="<?php echo $_GET['codigoAutTC']; ?>" />
            </label></td>
          </tr>
		    <?php } ?>
			
			
			
			
			
		<?php 
//VALIDACION DE MOVIMIENTOS DEFAULT

if($_GET['tipoPago']=='Efectivo' and $_GET['tipoVenta']=='externo' and ($_GET['seguro']==NULL or !$_GET['seguro'])){
$sSQL347= "Select codigoTT,descripcion From catTTCaja WHERE defaultExternos='si'";
$result347=mysql_db_query($basedatos,$sSQL347);
$myrow347 = mysql_fetch_array($result347);
if($myrow347['codigoTT']){
$codTT=$myrow347['codigoTT'];
$descDE= $myrow347['descripcion'];
}
} else {
$codTT=NULL;
$descDE=NULL;
}
?>	
			
			
			
			
			
			<?php $a=1;
			if($a==1){
			//if($tipoPaciente=='interno' or $tipoPaciente=='externo'){ ?>
			
			
			
			
			<?php if($_GET['tipoPago']=='Nomina'){?>
            <tr bgcolor="#FFFFFF">
			
			  <td class="Estilo24">Tipo de N&oacute;mina </td>
              <td class="Estilo24"><label>
			  
			  
			
			  
			  <?php



$sSQL31= "Select * From catTTCaja WHERE codigoTT = '".$tipoTrans."'
	";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


			  ?>
                <input name="campoDespliega" type="text" class="Estilo24" id="campoDespliega" size="50" 
	value="" readonly=""/>
              </label>
			  
			  

			  
                <label>
<?php 
if($_GET['tipoVenta']=='externo'){
$tipoVenta='externo';
}else{
$tipoVenta='interno';
}
?>



<?php if($_GET['tipoCliente']=='coaseguro'){ ?>
<a href="javascript:ventanaSecundaria1('ventanaCoaseguro.php?almacen=<?php echo $_GET['almacenFuente']; ?>&campoDespliega=<?php echo "campoDespliega"; ?>&campo1=<?php echo "cantidadRecibida"; ?>&forma=<?php echo "form1"; ?>&campoSeguro=<?php echo "tipoTransaccion"; ?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPago=<?php echo $_GET['tipoPago']; ?>&almacenFuente=<?php echo $_GET['almacenFuente']; ?>&campo=<?php echo "tipoTransaccion"; ?>&tipoCliente=<?php echo $_GET['tipoCliente'];?>&tipoVenta=<?php echo $tipoVenta;?>')">
<img src="/sima/imagenes/expandir.gif" alt="Tipo de Transacci&oacute;n" width="12" height="12" border="0" /></a>



<?php } else { ?>
<a href="javascript:ventanaSecundaria1('ventanaTT.php?almacen=<?php echo $_GET['almacenFuente']; ?>&campoDespliega=<?php echo "campoDespliega"; ?>&campo1=<?php echo "cantidadRecibida"; ?>&forma=<?php echo "form1"; ?>&campoSeguro=<?php echo "tipoTransaccion"; ?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPago=<?php echo $_GET['tipoPago']; ?>&almacenFuente=<?php echo $_GET['almacenFuente']; ?>&campo=<?php echo "tipoTransaccion"; ?>&tipoCliente=<?php echo $_GET['tipoCliente'];?>&tipoVenta=<?php echo $tipoVenta;?>')">
<img src="/sima/imagenes/expandir.gif" alt="Tipo de Transacci&oacute;n" width="12" height="12" border="0" /></a>
<?php } ?></a></label></td>
			  <?php } ?>
			  
			  
			  
			  
			  
			  <?php } else {?>
			
			  <?php }?>
            </tr>
			
			
			
			
			<?php 
			if(!$convenioParticular->convenioParticular($basedatos,$usuario,$numeroE,$nCuenta) and !$convenioAseguradora->convenioAseguradora($basedatos,$usuario,$numeroE,$nCuenta) and $tipoPaciente!='interno'){
			
			
			if($_GET['tipoPago']=='Credito'){   
			
			?>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo24">Compa&ntilde;&iacute;a</td>
              <td class="Estilo24"><span class="style12">
			  
                <?php 
		$cargosAseguradora=new acumulados();$company=$cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta),2)." ";?>
              </span></td>
            </tr>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo24">Otros</td>
              <td class="Estilo24"><span class="style12">
                <?php 
		$otros=new acumulados();
		echo "$".number_format($otros->otros($basedatos,$usuario,$numeroE,$nCuenta),2)." ";?>
              </span></td>
            </tr>
			<?php } ?>
		      <?php } ?>
		  
		  
		  
		  
		  
		  
		  
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24"><span class="style12">Cantidad </span></td>
            <td class="Estilo24"><span class="style12">
			
		
				
				
		<?php //tipo de paciente externo
				$sSQL3471= "Select codigoTT From catTTCaja WHERE banderaDevolucion='si'";
				$result3471=mysql_db_query($basedatos,$sSQL3471);
				$myrow3471 = mysql_fetch_array($result3471);
		        $transaccion=$myrow3471['codigoTT'];
		?>
			 
			 <?php 
		$totalAcumulado=new acumulados();
		$valor=$totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta);
		//echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);?>
<input name="cantidadRecibida" type="text" class="style7" id="cantidadRecibida" value="<?php echo round(-$valor,2);?>" autocomplete="off" readonly=""/>
  <input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value="<?php echo $transaccion;?>"   readonly="" />			 
			 
		 
			 
              <input name="TOTAL" type="hidden" class="style7" id="TOTAL" value="<?php echo $TOTAL;?>"/>
              <input name="numeroE" type="hidden" class="style7" id="numeroE" value="<?php echo $_GET['numeroE'];?>"/>
              <input name="naturaleza" type="hidden" class="style7" id="naturaleza" value="<?php echo $myrow31['naturaleza'];?>"/>
              <label>              </label>
        
            </span></td>
          </tr>

		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  

		  
		  
		  
		  
		  
		  
		  
		  
		  
		  


		  
		  
          <tr bgcolor="#0000FF" class="style7">
   		    
          </tr>
		  

		  
      </table></td>
    </tr>
  </table>
  <label>
    <div align="center">
  <span class="Estilo24">
      <input name="depositos" type="hidden" class="style7" id="depositos" value="<?php echo $depositos; ?>"/>
  </span>
      <span class="Estilo24">
      <input name="nCuenta" type="hidden" class="style7" id="nCuenta" value="<?php echo $numeroCuenta; ?>"/>
      <span class="style12">
      <input name="tipoCliente" type="hidden" class="style7" id="tipoCliente" value="<?php echo $_GET['tipoCliente']; ?>"/>
      </span> </span>
      <span class="style12">
      <input name="almacenFuente" type="hidden" class="style7" id="almacenFuente" value="<?php echo $_GET['almacenFuente']; ?>"/>
      </span>
      <span class="style12">
      <input name="almacen" type="hidden" class="style7" id="almacen" value="<?php echo $almacenFuente; ?>"/>
      </span>
      <div align="center">
        <p>
		<?php if(!$_GET['aplicarPago']){ ?>
		
		<?php 
			if($_GET['tipoPago']=='Credito' or $_GET['tipoPago']=='Nomina'){ ?>
          <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Trasladar Saldos"  />
	<?php } else { ?>
          <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Aplicar Pago" /> 
		  <?php } ?>
		  
		  <?php } ?>
		  
		  
		  
        </p>
        <p>
		<?php if($_GET['aplicarPago']){ ?>
          <label> <br />
          <br />
          <input name="Submit" type="submit" class="style7" value="Cerrar (X)" 	onclick="javascript:cerrar();" />
          </label>
</p>
        <?php } ?>
  </div>
  </label>
    <p align="center"><span class="style8">
      <?php if($_GET['cantidadRecibida'] and $myrow2['statusDeposito']=='pagado'){  //onclick="javascript:cerrar();"?>
    Devolver: </span><span class="style8"><?php echo "$ ".number_format($devolucion,2);?></span>
      <?php } ?>
    <span class="Estilo24">    </span><span class="style12">
    <input name="tipoVenta" type="hidden" class="style7" id="tipoVenta" value="<?php echo $_GET['tipoVenta']; ?>"/>
    </span><span class="style12">
    <input name="tipoMovimiento" type="hidden" class="style7" id="tipoMovimiento" value="<?php echo $_GET['tipoMovimiento']; ?>"/>
    </span></p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php 

} else {
echo 'La Caja está cerrada';
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>

  <?php } else {
echo 'La Caja está cerrada';
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>

