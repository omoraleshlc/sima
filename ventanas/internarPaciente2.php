<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/clases/generaFolioVenta.php"); ?>

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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=650,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=350,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php

if(!$_POST['S'] and !$_POST['M'] and !$_POST['C'] and $_POST['acepta'] AND $_POST['paciente']   ){

$_POST['cuarto']=trim($_POST['cuarto']);
$sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' and (tipoPaciente='interno' or tipoPaciente='urgencias') and numeroE = '".$_POST['numeroEx']."' and statusCuenta='abierta' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$myrow31['numeroE'] ){

if(!$_POST['paciente']){
$_POST['paciente']=$_POST['nombrePaciente1'];
}




$nCuenta=99999;


$S='activa';
$ST='standby';




//*****************************************************************



$sSQL455i= "Select especialidad from medicos where entidad='".$entidad."' and numMedico='".$_POST['medico']."'";
$result455i=mysql_db_query($basedatos,$sSQL455i);
$myrow455i = mysql_fetch_array($result455i);
if($myrow455i['especialidad']){
$_POST['especialidad']=$myrow455i['especialidad'];
}


if($_POST['numeroEx']){
$expediente='si';
}else{
$expediente='no';
}



//**************************************************
//VERIFICAR SI ES DE BENEFICENCIA
         $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_POST['numeroEx']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['numeroEx']."' ";
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                if($rowa['numeroE'] and $rowa['fecha']==$fecha){
                    $beneficencia='si';
                }else{
                    $beneficencia=NULL;
                }

//*************************************************


$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

//*****************************************************************
$agrega2 = "INSERT INTO clientesInternos (
numeroE,medico,paciente,seguro,autoriza,credencial,fecha,hora,nCuenta,numExtensiones,
deposito,cuarto,statusCuenta,almacen,status,
tipoResponsable,limiteCredito,medicoForaneo,especialidad,dx,
nombreResponsable,apaternoResponsable,amaternoResponsable,direccionResponsable,
telefonoResponsable,ocupacionResponsable,tipoTransaccion,parentescoResponsable,tipoPaciente,statusDeposito,entidad,usuario,fecha1,
enfermera,
quirurgico,
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
alergiaPA,folioVenta,edad,expediente,clientePrincipal,beneficencia
) values (
'".$_POST['numeroEx']."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$usuario."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$nCuenta."',
'".$_POST['numExtensiones']."',
'".$_POST['deposito']."',


'".$_POST['cuarto']."',
'abierta',
'".$_GET['almacen']."','activa',
'".$_POST['tipoResponsable']."','".$_POST['limiteCredito']."','".strtoupper($_POST['medicoForaneo'])."',
'".strtoupper($_POST['especialidad'])."','".strtoupper($_POST['dx'])."','".strtoupper($_POST['nombreResponsable'])."',
'".strtoupper($_POST['apaternoResponsable'])."','".strtoupper($_POST['amaternoResponsable'])."','".strtoupper($_POST['direccionResponsable'])."',
'".$_POST['telefonoResponsable']."','".strtoupper($_POST['ocupacionResponsable'])."','".$_POST['tipoTransaccion']."',
'".strtoupper($_POST['parentescoResponsable'])."','urgencias','urgencias','".$entidad."','".$usuario."','".$fecha1."',
'".$_POST['enfermera']."',
'".$_POST['quirurgico']."',
'".$_POST['tipoAccidente']."',
'".$_POST['fechaAccidente']."',
'".$_POST['horaAccidente']."',
'".$_POST['lugarAccidente']."',
'".$_POST['llegoHospital']."',
'".$_POST['ministerio']."',
'".$_POST['motivoConsulta']."',
'".$_POST['alergiaT']."',
'".$_POST['alergiaP']."',
'".$_POST['alergiaR']."',
'".$_POST['alergiaPA']."',
'".$myrow333['folioVentas']."','".$_POST['edad']."','si','".$myrow455['clientePrincipal']."','".$beneficencia."'


)";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();


if($_POST['numeroEx']!=NULL){
$sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' and numeroE = '".$_POST['numeroEx']."' order by keyClientesInternos DESC";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
}else{
   $sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' and usuario = '".$usuario."' order by keyClientesInternos DESC";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31); 
}

$generaFolio=new folioVenta();
$FV=$myrow333['folioVentas']=$generaFolio-> generarFolioVenta($myrow31['keyClientesInternos'],$usuario,"interno",$entidad,$tipoFolio,$basedatos);
$myrow333['folioVentas']=$FV;


/*
$qt = "UPDATE clientesInternos set
folioVenta='".$FV."'
WHERE
keyClientesInternos ='".$keyClientesInternos."'";
mysql_db_query($basedatos,$qt);
echo mysql_error();
*/

$leyenda="(SE ACTIVO LA CUENTA DEL PACIENTE #".$myrow333['folioVentas'].": ".$_POST['paciente']." )";



?>
<script >
window.alert("SE ACTIVO LA CUENTA DEL PACIENTE <?php echo  "#".$myrow333['folioVentas']." ".$_POST['paciente'];?> ");
window.close();
</script>
<?php 




$q = "UPDATE cuartos set 
status='ocupado' ,
numeroE='".$NUMEROE."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."'
WHERE entidad='".$entidad."' AND
codigoCuarto='".$_POST['cuarto']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}else{ ?>
<script >
window.alert( "EL PACIENTE <?php echo $_POST['paciente'];?> ESTA YA INTERNADO, NO SE PUEDE INTERNAR 2 VECES!");
window.close();
</script>
<?php 
}
}


$sSQL32= "Select * From pacientes WHERE numCliente = '".$_GET['numeroE']."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);
$nombrePaciente = $myrow32['nombre1']." ".$myrow32['nombre2']." ".$myrow32['apellido1']." ".
$myrow32['apellido2']." ".$myrow32['apellido3'];


?>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>


</head>

<body>
<h1 align="center" class="titulos">Registro de Emergencia <?php echo $leyenda; ?>
  </h1>
<form id="form1" name="form1" method="post" action="#" >
  <table width="666" class="table-forma">

<tr valign="middle"   >
        <th height="23" colspan="3" ><div align="center" >Datos del Paciente </div></th>
    </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td height="26" >Expediente</td>
        <td><span >
          <input name="numeroEx" type="text"  id="numeroEx"  readonly="" value="<?php echo $_POST['numeroEx'];?>" />
        </span></td>
      </tr>
      <tr valign="middle"  >
        <td width="6">&nbsp;</td>
        <td width="136" height="26"><div align="left" >Nombre del Paciente

        </div></td>
        <td width="522"><span >
          <span >
          <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60"   />
          </span></span><span >
		  
		  <?php echo '</br>';?>
		  <a href="javascript:ventanaSecundaria1(
		'/sima/cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')">Busqueda Avanzada </a></span></td>
    </tr>
	  
	 
      <tr  >
        <td >&nbsp;</td>
        <td height="28" >Nuevo Paciente </td>
        <td ><a href="javascript:ventanaSecundaria10('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&almacen=<?php echo $_GET['almacen'];?>')">
		 <span >
		Generar nuevo Numero de Expediente		</span>
		</a></td>
      </tr>
      <tr  >
        <td >&nbsp;</td>
        <td height="28" >Edad</td>
        <td ><input name="edad" type="text"  value="<?php echo $_POST['edad'];?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
          <input name="fechaNac" type="hidden"  id="fechaNac" size="10"  readonly="" value=""/></td>
      </tr>
      <tr >
        <td height="24" colspan="3"  ><div align="center" >Asignaci&oacute;n de Cuarto</span> y Responsable</div></td>
      </tr>
      <tr  >
        <td >&nbsp;</td>
        <td height="24" >Cuarto</td>
        <td height="24" ><?php 
        $aCombo= "Select distinct * From cuartos
where entidad='".$entidad."' AND 
 departamento='".$_GET['almacen']."'
and
departamento!=''
order by codigoCuarto ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="cuarto"  id="cuarto" />
          
          <option value="">Escoje</option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
          <option 
		<?php 
		if($_POST['cuarto']==$resCombo['codigoCuarto']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['codigoCuarto']; ?>"><?php echo $resCombo['descripcionCuarto'].' ['.$resCombo['status'].']'; ?></option>
          <?php } ?></td>
      </tr>
      <tr  >
        <td >&nbsp;</td>
        <td height="24" >Responsable</td>
        <td height="24" >
        <label>
          <select name="tipoResponsable"  id="tipoResponsable" onChange="javascript:submit();">
		 <option value="">Escoje</option>
		    <option 
			<?php if($_POST['tipoResponsable']=='Familiar'){ ?>
			selected="selected" 
			<?php } ?>
			 value="Familiar">Familiar</option>
            <option 
			<?php if($_POST['tipoResponsable']=='Empresa'){ ?>
			selected="selected" 
			 <?php } ?>
			value="Empresa">Empresa</option>
        </select>
        </label>        </td>
      </tr>
        <?php if($_POST['tipoResponsable']=='Familiar'){ ?>
      <tr bgcolor="#CC0033" >
        <td height="24" colspan="3" bgcolor="#3E4095" ><div align="center"><span >Persona F&iacute;sica</span></div></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Parentesco</td>
        <td><input name="parentescoResponsable" type="text"  id="parentescoResponsable" size="60" 
		value="<?php echo $_POST['parentescoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Nombre(s),Apellidos</td>
        <td><input name="nombreResponsable" type="text"  id="nombreResponsable" size="60" 
		value="<?php echo $_POST['nombreResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Direcci&oacute;n</td>
        <td><textarea name="direccionResponsable" cols="50"   id="direccionResponsable"><?php echo $_POST['direccionResponsable'];?></textarea></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Tel&eacute;fono</td>
        <td><input name="telefonoResponsable" type="text"  id="telefonoResponsable" size="60" 
		value="<?php echo $_POST['telefonoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Ocupaci&oacute;n</td>
        <td><input name="ocupacionResponsable" type="text"  id="ocupacionResponsable" size="60" 
		value="<?php echo $_POST['ocupacionResponsable'];?>"/></td>
      </tr>
	  <?php } ?>
      
      <?php if($_POST['tipoResponsable']=='Empresa'){ ?>
      <tr bgcolor="#CC0000" >
        <td height="24" colspan="3" bgcolor="#3E4095" ><div align="center"><span >Empresa</span></div></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td valign="middle" >Empresa</td>
        <td valign="middle"><p>
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        <input name="nomSeguro" type="text"  id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        
            
            
          <a href="javascript:ventanaSecundaria3('../cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></p>        </td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Credencial</td>
        <td><input name="credencial" type="text"  id="credencial" size="20" 
		value="<?php echo $_POST['credencial'];?>"/></td>
      </tr>
	    <?php } ?>
      <tr >
        <td height="24" colspan="3"  ><div align="center" >M&eacute;dico Responsable del Internamiento </span></div></td>
    </tr>
      <tr  >
        <td valign="middle" >&nbsp;</td>
        <td height="38" valign="middle" >M&eacute;dico de Internamiento</label></td>
    <td valign="bottom" ><label>
          <input name="medico" type="hidden"  id="medico"  value="<?php echo $_POST['medico'];?>" readonly=""/>
        <input name="despliegaMedico" type="text"   size="60" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaMedico']){ echo $_POST['despliegaMedico'];} else { echo "";}?>"/>
          <a href="javascript:ventanaSecundaria2(
		'../cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>')"></a><a href="javascript:ventanaSecundaria2(
		'../cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>&almacen=<?php echo $_GET['almacen'];?>')"><input name="acepta" type="button" id="acepta" value="M&eacute;dico de Internamiento" /></a>
        </label>
                    </span></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td ><div align="left"><span >
        </span></div>          <span ><label></label>
          </label>
          <label> <span >
          <div align="left" >M&eacute;dico For&aacute;neo </div>
        </label>
        </span></td>
        <td><div align="left">
          <input name="medicoForaneo" type="text"  id="medicoForaneo"
		   value="<?php 
		  if($_POST['medicoForaneo']){
		  echo $_POST['medicoForaneo'];
		  } else if($myrow3['medicoForaneo']){
		  echo $myrow3['medicoForaneo']; 
		  }
		  ?>" size="60" />
        </div></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >Tipo de Accidente</td>
        <td><label>
          <input name="tipoAccidente" type="text"  id="tipoAccidente"
		   value="<?php 
		  if($_POST['tipoAccidente']){
		  echo $_POST['tipoAccidente'];
		  } else if($myrow3['tipoAccidente']){
		  echo $myrow3['tipoAccidente']; 
		  }
		  ?>" size="60" />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
	  
	  <?php if($_POST['tipoAccidente']=='automovilistico'){?>
        <td>Fecha Accidente </td>
        <td><label>
          <input name="fechaAccidente" type="text"  id="fechaAccidente" value="<?php 
		  if($_POST['fechaAccidente']){
		  echo $_POST['fechaAccidente'];
		  } else {
		  echo $fecha1;
		  }
		  ?>" />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >Hora Accidente </td>
        <td><label>
          <input name="horaAccidente" type="text"  id="horaAccidente" value="<?php 
		  if($_POST['horaAccidente']){
		  echo $_POST['horaAccidente'];
		  } else {
		  echo $hora1;
		  }
		  ?>" />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td>Lugar Accidente </td>
        <td><label>
          <textarea name="lugarAccidente" cols="40"  id="lugarAccidente"><?php if($_POST['lugarAccidente']) echo $_POST['lugarAccidente'];?></textarea>
        </label></td>
      </tr>
	  <?php } ?>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >&iquest;C&oacute;mo lleg&oacute; al Hospital? </td>
        <td><textarea name="llegoHospital" cols="40" rows="4" wrap="physical"  id="llegoHospital"><?php if($_POST['llegoHospital']) echo $_POST['llegoHospital'];?>
        </textarea></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >&iquest;Avis&oacute; al Ministerio? </td>
        <td><label>
          <input name="ministerio" type="checkbox" id="ministerio" value="si" <?php 
		  if($_POST['ministerio'])echo 'checked=""';
		  ?> />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >Motivo Consulta </td>
        <td><label>
          <textarea name="motivoConsulta" cols="40"  id="motivoConsulta"><?php if($_POST['motivoConsulta']) echo $_POST['motivoConsulta'];?></textarea>
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td >Alergias (Si Tiene) </td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td><div align="center" >
          <div align="right">T </div>
        </div></td>
        <td><label>
          <input name="alergiaT" type="checkbox" id="alergiaT" value="si" <?php 
		  if($_POST['alergiaT'])echo 'checked=""';
		  ?>  />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td><div align="center" >
          <div align="right">P</div>
        </div></td>
        <td><input name="alergiaP" type="checkbox" id="alergiaP" value="si" <?php 
		  if($_POST['alergiaP'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td><div align="center" >
          <div align="right">R</div>
        </div></td>
        <td><input name="alergiaR" type="checkbox" id="alergiaR" value="si" <?php 
		  if($_POST['alergiaR'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td><div align="center" >
          <div align="right">PA</div>
        </div></td>
        <td><input name="alergiaPA" type="checkbox" id="alergiaPA" value="si" <?php 
		  if($_POST['alergiaPA'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td >Peso</td>
        <td><label>
          <input name="peso" type="text"  id="peso" value="<?php if($_POST['peso'])echo $_POST['peso'];?>"/>
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td><div align="left" >Diagn&oacute;stico Paciente </div></td>
        <td><div align="left">
          <input name="dx" type="text" class="combosmid" id="dx" value="<?php echo $_POST['dx']; ?>" size="50" rows="4" />
        </div></td>
      </tr>

  </table>
<br />
<label>
        <div align="center">
          <input name="acepta" type="submit" src="../imagenes/btns/interpatient.png" class="boton1" id="acepta" value="Internar Paciente" />
          <br />
          <?php if($_POST['acepta']){ ?>
          <?php } ?>
        </div>
          </label>
          
          <br />
<input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    <input name="nombrePaciente2" type="hidden"  id="nombrePaciente2" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>" />
    <input name="flag" type="hidden"  id="flag" size="60" readonly="" 
		value="<?php 
		if($_POST['acepta']){
		echo 'enabled';
		} else {
		echo 'disabled';
		}
		?>" />
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
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
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
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $_GET['datawarehouse'];?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
