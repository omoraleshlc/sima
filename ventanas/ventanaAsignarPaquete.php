<?php require("/configuracion/ventanasEmergentes.php"); 
require("/configuracion/funciones.php"); ?>

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
   window.open(URL,"ventana2","width=900,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=430,height=700,scrollbars=YES") 
} 
</script> 

<?php



if($_POST['aplicarPaquete'] and $_POST['codigoPaquete'] and ($_POST['paciente'] or $_POST['paciente1'])){
if(!$_POST['paciente']){
    $_POST['paciente']=$_POST['paciente1'];
}

if($_POST['nomSeguro']!=NULL AND !$_POST['seguro']){
    echo '<script>window.alert("ESCOJE BIEN EL SEGURO, TRANSACCION CANCELADA!");window.close();</script>';
}

//**************FACTURACION CONFIGURADA**************
$sSQL40= "
        SELECT
clientePrincipal,facturacionPreconfigurada
FROM
clientes
WHERE
entidad='".$entidad."'
    and
numCliente='".$_POST['seguro']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);

$sSQL31= "select * from paquetes where  entidad='".$entidad."' and codigoPaquete='".$_POST['codigoPaquete']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL40a= "
        SELECT
*
FROM
facturacionconfigurada
WHERE
entidad='".$entidad."'
    and
clienteprincipal='".$myrow40['clientePrincipal']."'
and
keypaq='".$myrow31['keyPAQ']."'
";
$result40a=mysql_db_query($basedatos,$sSQL40a);
$myrow40a = mysql_fetch_array($result40a);


if($myrow40['clientePrincipal']!=NULL){
    $fc='si';
}
//*************************************************************

//*********************************ENCABEZADO**************************************
$agregado = "INSERT INTO clientesInternos (
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,statusCuenta,statusDeposito,almacenSolicitud,horaSolicitud,
fechaSolicitud,expediente,clientePrincipal,nombreCliente,numRecibo,paquete,codigoPaquete,empleado,facturacionconfigurada,descripcionpaquete

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
'".$nOrden."','','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','".$FV."','abierta','pagado','".$ALMACEN."','".$hora1."','".$fecha1."','".$_POST['expediente']."',
'".$myrow40['clientePrincipal']."','".$_POST['nombreCliente']."','".$myrowC['numRecibo']."','si',
'".$_POST['codigoPaquete']."','".$_POST['empleado']."','".$fc."' ,'".$_POST['descripcionPaquete']."')";
mysql_db_query($basedatos,$agregado);
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


 $agrega = "INSERT INTO paquetesPacientes (
codigoPaquete,descripcionPaquete,numeroE,usuario,fecha,hora,entidad,id_almacen,paciente,status,keyClientesInternos) 
values ('".$_POST['codigoPaquete']."','".$_POST['descripcionPaquete']."','".$_POST['numeroE']."',
'".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$ALMACEN."','".$_POST['paciente']."','standby','".$myrow4['keyClientesInternos']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//echo 'El Paquete Fue agregado al paciente';






?>

<script>
javascript:ventanaSecundaria2('../cargos/escojerArticulosPaquetes.php?numeroE=<?php echo $_POST['numeroE']; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&codigoPaquete=<?php echo $_POST['codigoPaquete']; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow4['keyClientesInternos'];?>&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>&folioVenta=<?php echo $FV;?>&descripcionPaquete=<?php echo $_POST['descripcionPaquete'];?>');
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 

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



<script>

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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />

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


     <form id="form1" name="form1" method="post">
     
<div align="center" ><h1>Nombre del Paciente </h1>
        <p class="normalmid">
          <?php if($_GET['numeroE']!=NULL){ ?>
          <?php echo $myrow1['nombreCompleto'];?>
          <?php }else{ ?>
          <input name="paciente1" type="text"  id="paciente1" size="50" value="<?php echo $_POST['paciente1'];?>" />
          </input>
          <?php } ?>
        </p>
</div>
  
<p>&nbsp;</p>
 


    <table width="497" class="table-forma" >
      <tr>
        <td height="46" colspan="2" valign="top" ><span >Aseguradora (Opcional) 
            <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
          </span></td>
      </tr>


      <tr>
        <td height="33" colspan="2" valign="top" ><input name="nomSeguro" type="text"  id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      </tr>



          <tr>
        <td height="36" colspan="2" valign="top" >Empleado (Opcional)
        <input name="empleado" type="text"  id="textfield" value="<?php echo $_POST['empleado'];?>" size="35" />
</td>
          </tr>


        <tr>
        <td height="46" colspan="2" valign="top" >
Observaciones (Opcional)
 <textarea name="observaciones" cols="60" rows="3" wrap="virtual"  id="observaciones"><?php echo $_POST['observaciones'];?></textarea>
        </td>
        </tr>
   

      <tr>
        <td height="28" colspan="2" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td height="46" colspan="2" valign="top" ><p>Escribe el Nombre del Paquete </p>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td width="371" valign="top" >
		<input name="descripcionPaquete"   type="text"  id="descripcionPaquete" value="<?php 
		if($_POST['descripcionPaquete']){ 
		echo $_POST['descripcionPaquete'];
		}
		?>" size="60"  />		</td>
        <td width="110" height="46" valign="top" ><label>
<a  href="javascript:nueva('../cargos/agregarPaquetesPacientes.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "codigoPaquete"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>','ventanaSecundaria1','800','800','yes');"  />
Cargar Paq.
</a>
        <div align="left"></div></td>
      </tr>
      <tr>
        <td height="19" colspan="2" >&nbsp;</td>
      </tr>
      <tr>
        <td height="33" colspan="2" >Requerir Expediente Fisico 
          <label>
          <input name="expediente" type="checkbox" id="expediente" value="si" />
        </label></td>
      </tr>
      <tr>
        <td height="19" colspan="2" >&nbsp;</td>
      </tr>
      <tr>
        <td height="33" colspan="2" ><div align="center">
          <input name="aplicarPaquete" type="Submit"  src="../imagenes/btns/aplypaq.png" id="aplicarPaquete" value="Ver Cargos"   />
          <input name="codigoPaquete" type="hidden"  id="codigoPaquete"	value="" />
          
          <input name="numeroE" type="hidden"  id="numeroE" 
		 value="<?php echo $_GET['numeroE'];?>">
          
          <input name="paciente" type="hidden" class="Estilo24" id="paciente" 
		 value="<?php echo $myrow1['nombreCompleto'];?>" />          
        </div></td>
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
			return "../cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	
	
  <script>
		new Autocomplete("descripcionPaquete", function() {
			this.setValue = function( id ) {
				document.getElementsByName("codigoPaquete")[0].value = id;
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
			return "../cargos/paquetesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</body>
</html>