<?php include("/configuracion/ventanasEmergentes.php"); 
include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=400,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=900,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 

<?php

//echo $_POST['aplicarPaquete'].' '.$_POST['codigoPaquete'].' '.$_POST['paciente'];

if($_POST['aplicarPaquete'] and $_POST['codigoPaquete'] and $_POST['paciente']){ 

$sSQL311= "select MAX(nCuenta+1) as nCuentas from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroE']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);

if($myrow311['nCuentas']){
$nCuenta=$myrow311['nCuentas'];
} else {
$nCuenta=1;
}


$sSQL40= "
        SELECT
clientePrincipal
FROM
clientes
WHERE numCliente='".$_POST['seguro']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


//*********************************ENCABEZADO**************************************
$agregado = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,statusCuenta,statusDeposito,almacenSolicitud,horaSolicitud,fechaSolicitud,expediente,clientePrincipal,nombreCliente,numRecibo,paquete,codigoPaquete
) values (
'".$_POST['numeroE']."','".$nCuenta."',
'".$_POST['medico']."',
'".$_POST['paciente']."',
'".$_POST['seguro']."',
'".$usuario."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'standby',
'".$_POST['cita']."',
'".$_GET['almacen']."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','".$FV."','abierta','pagado','".$ALMACEN."','".$hora1."','".$fecha1."','no','".$myrow40['clientePrincipal']."','".$_POST['nombreCliente']."','".$myrowC['numRecibo']."','si',
'".$_POST['codigoPaquete']."')";
mysql_db_query($basedatos,$agregado);
echo mysql_error();

$q4 = "INSERT INTO contadorExternos (contador,usuario,entidad) values ('".$myrow333['conta']."','".$usuario."','".$entidad."')";
mysql_db_query($basedatos,$q4);
echo mysql_error();
//**************************************************************
$sSQL4= "Select * from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroE']."' order by keyClientesInternos DESC";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

$sSQL31= "select numeroE from paquetesPacientes where entidad='".$entidad."' AND codigoPaquete='".$_POST['codigoPaquete']."' and
numeroE='".$_POST['numeroE']."' 
and
status='standby'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$myrow31['numeroE']){
 $agrega = "INSERT INTO paquetesPacientes (
codigoPaquete,descripcionPaquete,numeroE,usuario,fecha,hora,entidad,id_almacen,paciente,status,keyClientesInternos) 
values ('".$_POST['codigoPaquete']."','".$_POST['descripcionPaquete']."','".$_POST['numeroE']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$ALMACEN."','".$_POST['paciente']."','standby','".$myrow4['keyClientesInternos']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//echo 'El Paquete Fue agregado al paciente';






?>

<script>
javascript:ventanaSecundaria2('/sima/cargos/escojerArticulosPaquetes.php?numeroE=<?php echo $_POST['numeroE']; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&codigoPaquete=<?php echo $_POST['codigoPaquete']; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow4['keyClientesInternos'];?>
&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>&folioVenta=<?php echo $FV;?>');
//window.alert("Se genero el folio de venta: <?php echo $FV;?>");
//window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 
} else {

echo 'Este paquete ya lo asignaste...';
}
}

?>


<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/

function Disable(cb,but){
 var cbs=document.getElementsByName(cb.name);
 but=cbs[0].form[but]
 but.setAttribute('disabled','disabled');
 for (var zxc0=0;zxc0<cbs.length;zxc0++){
  if (cbs[zxc0].checked){
   but.removeAttribute('disabled');
   break;
  }
 }

}
/*]]>*/
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.Estilo241 {font-size: 12px}
-->
</style>
<head>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>

<body>
<?php $sSQL1= "Select nombreCompleto From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$_GET['numeroE']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

?>
  <h1 align="center" class="">Asignar paquete al paciente </h1>
  <h1 align="center"> <?php echo $myrow1['nombreCompleto'];?></h1>
<form id="form1" name="form1" method="post" action="#">

  <table width="585" border="1" align="center" bordercolor="#660033" class="Estilo24">
    <tr>
      <td valign="top">Nombre(s)
        <input name="paciente" type="text" class="camposmid" id="paciente" value="<?php 
		if($_POST['paciente']){ 
		echo $_POST['paciente'];
		}
		?>" size="50" /></td>
      <td height="46" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Seguro
      <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      <td height="46" valign="top"><span class="negromid">
          <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
      </span></td>
    </tr>
    <tr>
      <td width="371" valign="top">
	    <p>Paquete</p>
	    <p>
	      <input name="descripcionPaquete"  disabled="disabled" type="text" class="camposmid" id="descripcionPaquete" value="<?php 
		if($_POST['descripcionPaquete']){ 
		echo $_POST['descripcionPaquete'];
		}
		?>" size="60" />		
      </p></td>
      <td width="110" height="46" valign="top"><label>
        <input name="agregarCargos3" type="button"  src="../../imagenes/btns/searcharticles.png" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarPaquetesPacientes.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "codigoPaquete"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="Asignar Paquete"   />
      <div align="left"></div></td>
    </tr>
    <tr>
      <td height="33" colspan="2"><div align="center">
          <input name="aplicarPaquete" type="Submit"  src="../../imagenes/btns/aplypaq.png" id="aplicarPaquete" value="Aplicar Paquete"   />
          <input name="codigoPaquete" type="hidden" class="Estilo241" id="codigoPaquete"   readonly=""
		value="" 
		 />
          
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		 value="<?php echo $_GET['numeroE'];?>">
      </div></td>
	  


	
<script>
//alert(" Hi"+document.getElementById("status"));
</script>
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
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
 </body>
</html>