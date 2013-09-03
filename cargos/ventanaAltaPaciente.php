<?php require("/configuracion/ventanasEmergentes.php"); 
$TOTAL=$_GET['TOTAL'];
$iva=$_GET['iva'];
$numeroCuenta=$_GET['nCuenta'];
$descuento=$_GET['descuento'];
$depositos=$_GET['depositos'];
$devolucion=$_GET['cantidadRecibida']-$TOTAL;

?>
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=350,height=300,scrollbars=YES") 
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
<?php //************************ACTUALIZO PRECIOS**********************
$ID_LIBROM='20';
//***********************************************************************



//***********************************Bajar variables
$hoy = date("Y-m-d");
$hora = date("H:i a");
$nPaciente=$_GET['numeroE'];



if($_GET['almacen']){
$al = $_GET['almacen'];
} else if($_GET['almacen1']){
$al = $_GET['almacen1'];
} else if($_GET['almacen2']){
 $al = $_GET['almacen2'];
} else if($_GET['almacen3']){
$al = $_GET['almacen3'];
} 
//***********************Cierro validaciones de almacén************************

//*********************************CREAR FUNCIONES******************************************
function saca_por($can,$por){
$can=($can/100)*$por;
$tPor=$can+$cant;
return $can;
}
function saca_pormas($can,$por){
$can=($can/100)*$por;
$tPor=$can-$cant;
return $can;
}
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}
//****************************Cierro funciones************************************
//********************************VERIFICA EL ULTIMO MOVIMIENTO*******************
//********traigo centro de costos y libro*********
//$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' ";
$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' 
AND ID_EJERCICIO='".$ID_EJERCICIOM."'
AND
ID_LIBRO='".$ID_LIBROM."'
";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

for ($i = 0; $i < $nrows1; $i++ ){
$ID_LIBRO = $results1['ID_LIBRO'][$i];
$ID_EJERCICIO = $results1['ID_EJERCICIO'][$i];
} 
//***********************************************************************************

//*****************************Verificando caja abierta**************************
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($poliza=$myrowC['numeroPoliza']){ //*******************Comienzo la validación*****************
//********************Llenado de datos
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE1=$myrow3['numeroE'];
$nCuenta1=$myrow3['nCuenta'];
//***************aplicar pago**********************



if($_GET['aplicarPago'] ){

 $q = "UPDATE clientesInternos set 
status='activa',
statusDeposito='pagado'

WHERE numeroE = '".$numeroE1."' and nCuenta='".$nCuenta1."'";
mysql_db_query($basedatos,$q);
echo mysql_error();


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,cantidadRecibida,cantidad,tipoTransaccion,codProcedimiento,hora1
) values ('".$numeroE1."','".$nCuenta1."','pagado',
'".$usuario."','".$fecha1."','".$_GET['cantidadRecibida']."','1','".$_GET['tipoTransaccion']."','".$hora1."','".$hora1."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$q1 = "UPDATE cargosCuentaPaciente set 
status='pagado',
tipoTransaccion='".$_POST['tipoTransaccion']."',

numPoliza='".$poliza."'
WHERE numeroE = '".$_GET['numeroE']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$q1 = "UPDATE descuentos set 
status='usado'
WHERE numeroE = '".$_GET['numeroE']."' and status='activo'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();
//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQL2= "Select max(consecutivo) as tope From aperturaCaja ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$numMovto=$myrow2['tope']+'1';
$q = "UPDATE aperturaCaja set 
consecutivo = '".$numMovto."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE HIZO UN MOVIMIENTO!"
</script>';
$leyenda='Se hizo un Movimiento';
}
//*************************************************
?>
<script type="text/javascript">
	function cerrar(){

		close();
	}
</script>


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
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<form id="form1" name="form1" method="get" action="">
  <table width="442" height="337" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo24">
    <tr bgcolor="#990033" align="center">
      <td><b><font color="#FFFFFF">Totales</font></b></td>
    </tr>
    <tr bgcolor="#990033">
      <td><table width="100%" height="320" border="0" cellpadding="4" cellspacing="0">
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Tipo de Pago: </td>
            <td class="Estilo24">
			<select name="tipoPago" class="style7" id="tipoPago" onChange="javascript:form.submit();">
             
                <option
				 <?php if($_GET['tipoPago']=='Efectivo'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
				 
                <option
				 <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta de Credito">Tarjeta de Credito</option>
				 
				<option
				<?php if($_GET['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
				 
				 <option
				 <?php if($_GET['tipoPago']=='Compania'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Compania">Compania</option>
            </select></td>
          </tr>
          <tr bgcolor="#FFFFFF">
		  
		  
		  <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
            <td class="Estilo24">C&oacute;digo de Tarjeta: </td>
            <td class="Estilo24"><input name="codigo" type="text" class="Estilo24" id="codigo" 
		 value="<?php 
		 if($_GET['nuevo']){
		 echo "0000000000";
		 } else if($myrow2['codigo']){
		 echo $myrow2['codigo']; 
		 }
		 ?>" size="10" readonly=""/>
              <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&amp;descripcion=<?php echo "descripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;comision=<?php echo "comision"; ?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></td>
         
		  <input name="comision" type="hidden" value="">
		  </tr>
          <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF" class="Estilo24">Banco Tarjeta :</td>
            <td bgcolor="#FFFFFF" class="Estilo24"><input name="descripcion" type="text" class="style7" value="<?php echo $_GET['descripcion'];?>"  readonly=""/></td>
          </tr>
	
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">&Uacute;ltimos 4 D&iacute;gitos: </td>
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
            <tr bgcolor="#FFFFFF">
              <td class="Estilo24">Tipo de Transacci&oacute;n </td>
              <td class="Estilo24"><label>
			  
			  <?php
	$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."' and statusDeposito='pendiente' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE1=$myrow3['numeroE'];
$nCuenta1=$myrow3['nCuenta'];
$tipoTrans=$myrow3['tipoTransaccion'];


$sSQL31= "Select * From catTTCaja WHERE codigoTT = '".$tipoTrans."'
	";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


			  ?>
                <input name="campoDespliega" type="text" class="Estilo24" id="campoDespliega" size="50" 
	value="<?php if($myrow31['descripcion']){ echo $myrow31['descripcion'];}?>"
		   readonly=""/>
              </label>
                <label>
				<a href="javascript:ventanaSecundaria1(
		'ventanaTC.php?campo=<?php echo "tipoTransaccion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;descripcion=<?php echo "campoDespliega"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Tipo de Transacci&oacute;n" width="20" height="20" border="0" /></a><a href="javascript:ventanaSecundaria1(
		'ventanaTC.php?campo=<?php echo "tipoTransaccion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;descripcion=<?php echo "campoDespliega"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
                <input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value="<?php 
				if($tipoTrans){ 
				echo $tipoTrans;
				} else if($_GET['tipoTransaccion']){
				echo $_GET['tipoTransaccion']; 
				}
				?>"   readonly="" />
              </a></label></td>
            </tr>
          <tr bgcolor="#FFFFFF">
            <td width="22%" class="Estilo24">SubTotal: </td>
            <td width="78%" class="Estilo24"><?php 
			if($TOTAL){
echo "$".number_format($TOTAL,2);
} else {
echo "---";
}
	?></td>
          </tr>
          <?php 
//descuentos pacientes internos
$sSQL18= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' AND nCuenta ='".$nCuenta."' and nCuenta <>null
and 
status='activo' and
fechaFinal <= '".$fecha1."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18= mysql_fetch_array($result18);
echo mysql_error();
//descuentos pacientes ambulatorios
$sSQL19= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' 
and status='activo' and
fechaFinal <= '".$fecha1."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19= mysql_fetch_array($result19);
//******************
if($myrow19['cantidad']){

$descuento=$myrow19['cantidad'];
} else if($myrow19['descuento']){

		$TOTAL1=($myrow19['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}
		
		
if($myrow18['cantidad']){
$descuento=$myrow18['cantidad'];
} else if($myrow18['descuento']) { 
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}	
		
	$TOTAL-=$descuento;
		?>
          <?php 
		if($descuento){ ?>
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Descuento: </td>
            <td class="Estilo24"><?php
		echo "$".number_format($descuento,2); 
		 
		?>            </td>
          </tr>
          <?php } ?>
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">IVA:</td>
            <td class="Estilo24"><span class="style7">
              <?php 
		  $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente."'
 
 and status='pendiente'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];
		  if($iva){
		echo "$".number_format($iva,2);
		} else {
		echo "---";
		}
?>
            </span></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Total a Pagar: </td>
            <td class="Estilo24"><?php 
			if($TOTAL+$iva){
			echo "$".number_format($TOTAL+$iva,2);
			} else {
			echo "---";
			}
			?></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Cantidad Recibida </td>
            <td class="Estilo24"><input name="cantidadRecibida" type="text" class="style7" id="cantidadRecibida" value="<?php
			if($myrow3['deposito']){ 
			 echo $myrow3['deposito'];
				}
			 
			 ?>" autocomplete="off"/>
			<input name="TOTAL" type="hidden" class="style7" id="cantidadRecibida" value="<?php echo $TOTAL;?>"/>			</td>
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
      </span>
      <div align="center">
        <p>
		<?php if(!$_GET['aplicarPago']){ ?>
          <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Aplicar Pago" 
		
	/> <?php } ?>
        </p>
        <p>
		<?php if($_GET['aplicarPago']){ ?>
          <label> <br />
          <a href="javascript:ventanaSecundaria4(
		'imprimeCaja1.php?descripcion=<?php echo $descripcion; ?>&amp;forma=<?php echo "form1"; ?>&amp;numeroE=<?php echo $nPaciente; ?>')" class="Estilo24">Vista de Impr esi&oacute;n </a> <br />
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
      <span class="Estilo24">
      <input name="numeroE" type="hidden" class="style7" id="TOTAL" value="<?php echo $nPaciente;?>"/>
    </span></p>
</form>
<p>&nbsp;</p>
</body>
</html>
  <?php } else {
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>