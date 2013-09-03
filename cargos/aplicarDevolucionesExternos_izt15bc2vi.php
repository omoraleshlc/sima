<?php require('/configuracion/ventanasEmergentes.php');


include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?><script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script><script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
  
  
  
  
</script><SCRIPT LANGUAGE="JavaScript">
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
</SCRIPT><script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script><?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}
if(!$bali){
$bali=$_GET['almacenFuente'];
}

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$almacenCierreCuenta=$myrow3['almacen'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];



//***************aplicar pago**********************

if($_POST['aplicar']){
$keyCAP=$_POST['keyCAP'];
$cantidad=$_POST['cantidad'];



//**********************GENERAR FOLIO DE VENTA DEVOLUCION*************
$sSQL333= "SELECT 
MAX(contador)+1 as conta
FROM contadorExternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 


if(!$myrow333['conta']){
$myrow333['conta']=1;
}


$FV='E'.$myrow333['conta'];

$q4 = "UPDATE clientesInternos set 
statusCargoDevolucion='main',
folioDevolucion='".$FV."',
statusDevolucion='si',tipoCuenta='D'
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();


$q4 = "INSERT INTO contadorExternos (contador,usuario,entidad) values ('".$myrow333['conta']."','".$usuario."','".$entidad."')";
mysql_db_query($basedatos,$q4);
echo mysql_error();

$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,clientePrincipal,statusPaciente,
tipoAccidente,
fechaAccidente,
horaAccidente,
lugarAccidente,
llegoHospital,
ministerio,
motivoConsulta,
alergiaT,
alergiaP,
alergiaR,
alergiaPA,
tiposAlergias,
peso,dx,empleado,statusCuenta,statusCargoDevolucion,tipoCuenta,statusDevolucion,statusCaja
) values (
'".$myrow3['numeroE']."',
'".$myrow3['nCuenta']."',
'".$myrow3['medico']."',
'".$myrow3['paciente']."',
'".$myrow3['seguro']."',
'".$myrow3['autoriza']."',
'".$myrow3['credencial']."',
'".$fecha1."',
'".$hora1."',
'activa',
'".$myrow3['cita']."',
'".$myrow3['almacen']."',
'".$myrow3['usuario']."',
'".$ip."',
'".$fecha1."',
'".$myrow3['tipoConsulta']."',
'".$myrow3['medicoForaneo']."',
'".$myrow3['observaciones']."',
'".$myrow3['edad']."',
'".$myrow3['tipoPaciente']."',
'".$nOrden."',
'".$myrow3['statusExpediente']."',
'".$myrow3['dependencia']."',
'".$entidad."',
'".$myrow3['diagnostico']."',
'".$myrow3['telefono']."',
'".$FV."',
'".$myrow3['clientePrincipal']."',
'".$myrow3['statusPaciente']."',
'".$myrow3['tipoAccidente']."',
'".$myrow3['fechaAccidente']."',
'".$myrow3['horaAccidente']."',
'".$myrow3['lugarAccidente']."',
'".$myrow3['llegoHospital']."',
'".$myrow3['ministerio']."',
'".$myrow3['motivoConsulta']."',
'".$myrow3['alergiaT']."',
'".$myrow3['alergiaP']."',
'".$myrow3['alergiaR']."',
'".$myrow3['alergiaPA']."',
'".$myrow3['tipoAlergias']."',
'".$myrow3['peso']."',
'".$myrow3['dx']."',
'".$myrow3['empleado']."','caja','standby','H','si','standby'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$sSQL3a= "Select keyClientesInternos From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$FV."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
//****************************************************************************************************






$sSQL1= "Select * From cargosCuentaPaciente WHERE  entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and gpoProducto!=''  ";
$result1=mysql_db_query($basedatos,$sSQL1);

while($myrow1 = mysql_fetch_array($result1)){ //insertar


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,
almacenSolicitante,almacenDestino,keyClientesInternos,descripcion,statusFactura,horaSolicitud,fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,statusDevolucion,keyE,keyPA,numeroConfirmacion,
ivaParticular,ivaAseguradora,tipoVentaArticulos,usuarioFactura,
precioOriginal,ivaOriginal,usuarioDescuento,fechaDescuento,cargoModificable,gpoProducto,numSolicitud) 
values 
('".$myrow1['numeroE']."',
'".$myrow1['nCuenta']."',
'".$myrow1['status']." ',
'".$usuario."',
'".$fecha1."',
'".$dia1."',
'".$myrow1['cantidad']."',
'".$myrow1['tipoTransaccion']."',
'".$myrow1['codProcedimiento']."',
'".$hora1."',
'A',
'".$ID_EJERCICIOM."',
'',
'".$myrow1['almacen']."',
'".$usuario."',
'".$myrow1['precioVenta']."',
'".$myrow1['iva']."'
,'".$myrow1['seguro']."',
'".$myrow1['statusTraslado']."',
'".$myrow1['tipoCliente']."',
'".$myrow1['tipoPaciente']."',
'".$myrow1['cantidadParticular']."',
'".$myrow1['cantidadAseguradora']."',
'".$myrow1['entidad']."',
'".$myrow1['tipoCobro']."',
'".$myrow1['statusAuditoria']."'
,'".$myrow1['tipoPago']."',
'".$myrow1['statusCargo']."',
'".$myrow1['porcentajeVariable']."',
'".$myrow1['cargosHospitalarios']."',
'".$myrow1['almacenSolicitante']."',
'".$myrow1['almacenDestino']."',

'".$myrow3a['keyClientesInternos']."',


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
'".$FV."',
'".$myrow1['codigoCaja']."',
'".$myrow1['numRecibo']."',
'".$myrow1['numCorte']."',
'si',
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

'".$myrow333['NS']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************
} //cierra for
?><script>
window.alert("Se genero el folio de devolucion: <?php echo $FV;?>");
window.opener.document.forms["form1"].submit();
window.close();
</script><?php 
} //cierra actualizar






$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();
?><!--MMDW 27 -->




























<!-Hoja de estilos del calendario --> 
  <link mmdw="0"  rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
<!--MMDW 28 --><script type="text/javascript" src="/sima/calendario/calendar.js"></script><!--MMDW 29 --> 

 <!-- librería para cargar el lenguaje deseado --> 
<!--MMDW 30 --><script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script><!--MMDW 31 --> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<!--MMDW 32 --><script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script><!--MMDW 33 --> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta mmdw="1"  http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html mmdw="2"  xmlns="http://www.w3.org/1999/xhtml">



<!--MMDW 34 --><style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style><!--MMDW 35 -->
<head>
<!--MMDW 36 --><?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?><!--MMDW 37 -->
</head>



<BODY  >
<!--MMDW 38 --><?php //ventanasPrototype::links();?><!--MMDW 39 -->
<h1 mmdw="3"  align="center" class="titulos">Devoluciones</h1>
<h1 mmdw="4"  align="center" class="titulos">&nbsp;</h1>
<p mmdw="5"  align="center" class="codigos">*Si esta deshabilitada la cantidad es porque el almacen no permite tener stock.</p>
<form mmdw="6"  id="form1" name="form1" method="post" action="">
  <table mmdw="7"  width="412" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr mmdw="8"  bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <th mmdw="9"  bgcolor="#330099" class="blanco" scope="col"><div mmdw="10"  align="left">Transacci&oacute;n</div></th>
      <th mmdw="11"  class="normal" scope="col"><div mmdw="12"  align="left"><!--MMDW 40 --><?php echo $_GET['folioVenta'];

		  ?><!--MMDW 41 -->
          <input mmdw="13"  name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr mmdw="14"  bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <th mmdw="15"  width="157" bgcolor="#330099" scope="col"><div mmdw="16"  align="left" class="blanco"><strong>Paciente</strong></div></th>
      <th mmdw="17"  width="385" class="normal" scope="col"><div mmdw="18"  align="left"><strong>
          <label> </label>
      </strong> <!--MMDW 42 --><?php echo $myrow3['paciente']; ?><!--MMDW 43 --> </div></th>
    </tr>
    <tr mmdw="19"  bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td mmdw="20"  bgcolor="#330099" class="blanco"><div mmdw="21"  align="left">Compa&ntilde;&iacute;a</div></td>
<td mmdw="22"  class="normal"><label> <!--MMDW 44 --><?php echo $traeSeguro=$myrow3['seguro']; ?><!--MMDW 45 -->
            <!--MMDW 46 --><?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?><!--MMDW 47 -->
            <input mmdw="23"  name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr mmdw="24"  bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <td mmdw="25"  bgcolor="#330099" class="blanco"><div mmdw="26"  align="left">N&deg; Credencial</div></td>
      <td mmdw="27"  class="normal"><!--MMDW 48 --><?php echo $myrow3['credencial']; ?><!--MMDW 49 --> </td>
    </tr>
    <tr mmdw="28"  bordercolor="#FFFFFF" bgcolor="#FFFFFF">
      <th mmdw="29"  bgcolor="#330099" class="normal" scope="col"><div mmdw="30"  align="left" class="blanco">
        <div mmdw="31"  align="left"><strong>M&eacute;dico</strong></div>
      </div></th>
      <th mmdw="32"  class="normal" scope="col"><div mmdw="33"  align="left">
          <label> <!--MMDW 50 --><?php echo $medico=$myrow3['medico']; ?><!--MMDW 51 --> </label>
          <label> </label>
          <!--MMDW 52 --><?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?><!--MMDW 53 -->
          <!--MMDW 54 --><?php  $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?><!--MMDW 55 --> </div></th>
    </tr>
  </table>
  <p mmdw="34"  align="center" class="error"><em>*Introduce la cantidad que deseas devolver...</em> <br />
    <input mmdw="35"  type="image" src='../imagenes/btns/cargadevolucion.png' name="aplicar" id="button" value="Aplicar Cambios"  />
  </p>
  
  
  
  
  
  
  
  
  
  
  <table mmdw="36"  width="776" border="0" align="center">
    <tr mmdw="37"  bgcolor="#330099">
      <th mmdw="38"  width="40" class="blanco" scope="col"><div mmdw="39"  align="center"><span mmdw="40"  class="blanco ">Ref</span></div></th>
     
      <th mmdw="41"  width="82" height="14" class="blanco" scope="col"><div mmdw="42"  align="center"><span mmdw="43"  class="blanco ">Fecha/Hora </span></div></th>
      <th mmdw="44"  width="264"  scope="col"><div mmdw="45"  align="center"><span mmdw="46"  class="blanco ">Descripci&oacute;n/Concepto</span></div></th>
      <th mmdw="47"  width="68"  scope="col"><div mmdw="48"  align="center"><span mmdw="49"  class="blanco ">Almacen</span></div></th>
      <th mmdw="50"  width="42"  scope="col"><div mmdw="51"  align="center"><span mmdw="52"  class="blanco ">Status</span></div></th>
      <th mmdw="53"  width="28"  scope="col"><div mmdw="54"  align="center"><span mmdw="55"  class="blanco ">N </span></div></th>
      <th mmdw="56"  width="51"  scope="col"><div mmdw="57"  align="center"><span mmdw="58"  class="blanco ">Tipo P </span></div></th>
      <th mmdw="59"  width="21"  scope="col" class="blanco"><div mmdw="60"  align="center">C</div></th>
      <th mmdw="61"  width="66"  scope="col"><div mmdw="62"  align="center"><span mmdw="63"  class="blanco ">P.Unit</span></div></th>
      <th mmdw="64"  width="57"  scope="col"><div mmdw="65"  align="center"><span mmdw="66"  class="blanco ">CargosP</span></div></th>
      <th mmdw="67"  width="59"  scope="col"><div mmdw="68"  align="center"><span mmdw="69"  class="blanco ">CargosA</span></div></th>
      <th mmdw="70"  width="52"  scope="col"><div mmdw="71"  align="center"><span mmdw="72"  class="blanco ">IVA</span></div></th>
      <th mmdw="73"  width="50"  scope="col"><div mmdw="74"  align="center"><span mmdw="75"  class="blanco ">Abonos</span></div></th>
    </tr>
	
      <!--MMDW 56 --><?php //traigo agregados
	  

$sSQL81= "
SELECT 
*,cargosCuentaPaciente.descripcion as descripcionGeneral
FROM
cargosCuentaPaciente
 WHERE 
cargosCuentaPaciente.folioVenta='".$_GET['folioVenta']."'
and 
cargosCuentaPaciente.status!='cancelado'
and
status!='transaccion'
order by fecha1 DESC
 ";

$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 



$a+=1;
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];



$style='normal';







?><!--MMDW 57 -->	
	
	
	

      
      <tr mmdw="76"  bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td mmdw="77"  bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><!--MMDW 58 --><?php echo $myrow81['keyCAP'];?><!--MMDW 59 -->
      <input mmdw="78"  type="hidden" name="keyCAP[]" id="keyCAP[]" value="<?php echo $myrow81['keyCAP'];?>"/>      </td>






      <td mmdw="79"  height="21" bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div mmdw="80"  align="center"><span mmdw="81"  class="<?php echo $estilo;?>">
        <!--MMDW 60 --><?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?><!--MMDW 61 --></span></div></td>
	

	
	
      <td mmdw="82"  bgcolor="<?php echo $color;?>">
	  <div mmdw="83"  align="left">
	  
	  <span mmdw="84"  class="<?php echo $style;?>">
        <!--MMDW 62 --><?php 
echo $myrow81['descripcionArticulo'];
		?><!--MMDW 63 -->
		
  
          
          <!--MMDW 64 --><?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 		  
		?><!--MMDW 65 -->
	  </span>       <span mmdw="85"  class="Estilo1">
	  <!--MMDW 66 --><?php //echo $myrow81['statusCargo'];
	  if($myrow81['statusDevolucion'] and $myrow81['statusDevolucion']!=''){
	  echo '</br>';
	  if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='C'){
	  echo '   [Hizo el cargo: '.$myrow81['usuario'].']';
	  }else if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='A'){
	  echo '   [Solicito Devolucion: '.$myrow81['usuario'].', Transaccion: '.$myrow81['folioDevolucion'] .']';
	  }
	  
	  }
	  ?><!--MMDW 67 -->
	  </span> </div></td>
	   
	   
      <td mmdw="86"  bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div mmdw="87"  align="center"><!--MMDW 68 --><?php echo $myrow81['almacenDestino'];?><!--MMDW 69 --></div></td>
      <td mmdw="88"  bgcolor="<?php echo $color;?>" class="<?php echo $style;?>">
        
        
        
    
        <div mmdw="89"  align="center">
          <!--MMDW 70 --><?php 
if($myrow81['statusCargo']=='standbyR'){
echo 'Sin enviar';
}else if($myrow81['statusCargo']=='standby'){
echo 'pendiente surtir';
} else if($myrow81['statusCargo']=='cargado'){
echo $myrow81['statusCargo'];
}
	?><!--MMDW 71 -->
        </div></td>
		
      <td mmdw="90"  bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"> <div mmdw="91"  align="center"><!--MMDW 72 --><?php echo $myrow81['naturaleza'];
	?><!--MMDW 73 --></div></td>
      <td mmdw="92"  bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div mmdw="93"  align="center"><!--MMDW 74 --><?php echo $myrow81['tipoCliente'];
	?><!--MMDW 75 --></div></td>
<td mmdw="94"  class="<?php echo $style;?>"><div mmdw="95"  align="center"><!--MMDW 76 --><?php print $myrow81['cantidad']; ?><!--MMDW 77 --></div></td>
      <td mmdw="96"  class="precionormal2" align="right" ><!--MMDW 78 --><?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['precioVenta'],2);
	  } else {
	  echo '*';
	  }
	  ?><!--MMDW 79 --></td>
      <td mmdw="97"  class="precionormal1" align="right">
	  <!--MMDW 80 --><?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['cantidadParticular']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?><!--MMDW 81 --></td>
      <td mmdw="98"  class="precionormal1" align="right" ><!--MMDW 82 --><?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['cantidadAseguradora']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?><!--MMDW 83 --></td>
      <td mmdw="99"  class="normal" align="right">
          <!--MMDW 84 --><?php 
		  if($myrow81['naturaleza']=='C'){
		  $sumaIVAS[0]+=($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'];
		echo '$'.number_format(($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'],2);
		}else{
   	    echo '*';
		}
		?><!--MMDW 85 -->
      </span></div></td>
      <td mmdw="100"  class="precionormal2" >
        <div mmdw="101"  align="right">
          <!--MMDW 86 --><?php
	  if($myrow81['naturaleza']=='A'){
	  echo '$'.number_format($myrow81['precioVenta']*$myrow81['cantidad'],2);
	  }
	  ?><!--MMDW 87 -->
        </div></td>
      </tr>
 
	
	
    <!--MMDW 88 --><?php }?><!--MMDW 89 -->
  </table>


  <p>
    <label></label>
    <input mmdw="102"  name="bandera" type="hidden" id="recibo" value="<?php echo $a;?>" />
  </p>
<div mmdw="103"  align="center">
            <div mmdw="104"  align="left">
              <p>&nbsp;</p>
            </div>
  </div>
          <p mmdw="105"  align="center">
    <input mmdw="106"  name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
  </p>
</form>

</body>
</html>


<!-- MMDW:success -->