<?php include("/configuracion/ventanasEmergentes.php"); ?>
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
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
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


<?php

if($_POST['numeroEx']==$_POST['expedienteOriginal']){
$e='si';
}

if($_POST['acepta'] and $_POST['paciente'] ){
$q = "UPDATE clientesInternos set 
numeroE='".$_POST['numeroEx']."',
peso='".$_POST['peso']."',
dx='".$_POST['dx']."',
medico='".$_POST['medico']."',
paciente='".$_POST['paciente']."',
expediente='si',
autoriza='".$usuario."',

cuarto='".$_POST['cuarto']."',
tipoResponsable='".$_POST['tipoResponsable']."',
medicoForaneo='".$_POST['medicoForaneo']."',
nombreResponsable='".$_POST['nombreResponsable']."',
apaternoResponsable='".$_POST['apaternoResponsable']."',
amaternoResponsable='".$_POST['amaternoResponsable']."',
direccionResponsable='".$_POST['direccionResponsable']."',
telefonoResponsable='".$_POST['telefonoResponsable']."',
ocupacionResponsable='".$_POST['ocupacionResponsable']."',
edad='".$_POST['edad']."',
parentescoResponsable='".$_POST['parentescoResponsable']."',

tipoAccidente='".$_POST['tipoAccidente']."',
fechaAccidente='".$_POST['fechaAccidente']."',
horaAccidente='".$_POST['horaAccidente']."',
lugarAccidente='".$_POST['lugarAccidente']."',
llegoHospital='".$_POST['llegoHospital']."',
ministerio='".$_POST['ministerio']."',
motivoConsulta='".$_POST['motivoConsulta']."',
alergiaT='".$_POST['alergiaT']."',
alergiaP='".$_POST['alergiaP']."',
alergiaR='".$_POST['alergiaR']."',
alergiaPA='".$_POST['alergiaPA']."',
tiposAlergias='".$_POST['tiposAlergias']."',
peso='".$_POST['peso']."',
dx='".$_POST['dx']."'
WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
?>
<script>
window.alert("PACIENTE ACTUALIZADO");
window.opener.document.forms["form1"].submit();

</script>
<?php 

}


$sSQL32= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />



</head>

<body>
<h1 align="center" >Actualizar Registro de Emergencia <?php echo $leyenda; ?>
</h1>
<form id="form1" name="form1" method="post" action="#" >
<table width="576" class="table-forma">
      <tr valign="middle"   >
        <th colspan="2" ><div align="center" >Datos del Paciente </div></th>
      </tr>
      <tr valign="middle"  >
        <td width="137"><div align="left" >Apellido Paterno,Materno </div></td>
        <td width="571"><label>
        
		<input name="paciente" type="text"  id="paciente" size="50" value="<?php echo $myrow32['paciente'];?>"/>
		
        </label>
		
<a href="javascript:ventanaSecundaria1(
		'/sima/cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="style1">Busqueda Avanzada </a>
-
		<a href="javascript:ventanaSecundaria1('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" class="style1">Create</a></td>
      </tr>
	  
	 
      <tr  >
        <td >Expediente</td>
        <td ><input name="numeroEx" type="text"  id="numeroEx" value="<?php echo $myrow32['numeroE']; ?>" readonly="" /></td>
      </tr>
      <tr  >
        <td >Edad   		  </td>
        <td ><input name="edad" type="text"  size="3" value="<?php echo $myrow32['edad'];?>"/></td>
      </tr>
      <tr >
        <td colspan="2"  ><div align="center" >M&eacute;dico Responsable del Internamiento </span></div></td>
      </tr>
      <tr  >
        <td ><label></label>
            </label>
            <label>
          
            <div align="left" >M&eacute;dico de Internamiento </div>
        </label></td>
        <td >
        <?php 
$sqlNombre11 = "SELECT * from medicos 
WHERE
entidad='".$entidad."' AND
status='A'
ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="medico"  id="medico" />
<option value="">---</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($medico==$rNombre11["numMedico"] or $myrow32['medico']==$rNombre11["numMedico"])echo 'selected'; ?>
   value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]
	  ." ".$rNombre11["apellido3"]." ".$rNombre11["nombre1"]." ".$rNombre11["nombre2"];?></option>
  <?php } ?>

        
          <div align="left"></div>        </td>
      </tr>
      <tr valign="middle"  >
        <td ><div align="left"><span >
        </span></div>          <span ><label></label>
          </label>
          <label> 
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
        <td >Tipo de Accidente</td>
        <td><label>
          <input name="tipoAccidente" type="text"  id="tipoAccidente"
		   value="<?php echo $myrow32['tipoAccidente']; ?>" size="60" />
        </label></td>
      </tr>
      <tr valign="middle"  >
	  
	 
        <td >Fecha Accidente </td>
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
        <td >Hora Accidente </td>
        <td><label>
          <input name="horaAccidente" type="text"  id="horaAccidente" value="<?php echo $myrow32['horaAccidente'];?>" />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td >Lugar Accidente </td>
        <td><label>
          <textarea name="lugarAccidente" cols="40" wrap="virtual"  id="lugarAccidente"><?php echo $myrow32['lugarAccidente'];?></textarea>
        </label></td>
      </tr>
	
      <tr valign="middle"  >
        <td >&iquest;C&oacute;mo lleg&oacute; al Hospital? </td>
        <td><textarea name="llegoHospital" cols="40" wrap="virtual"  id="llegoHospital"><?php echo ltrim($myrow32['llegoHospital']);?></textarea></td>
      </tr>
      <tr valign="middle"  >
        <td >&iquest;Avis&oacute; al Ministerio? </td>
        <td><label>
          <input name="ministerio" type="checkbox" id="ministerio" value="si" <?php 
		  if($myrow32['ministerio'])echo 'checked=""';
		  ?> />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="middle"  >
        <td >Alergias (Si Tiene) </td>
        <td><textarea name="tiposAlergias" cols="60" wrap="virtual"  id="tiposAlergias"><?php echo $myrow32['tiposAlergias'];?></textarea></td>
      </tr>
      <tr valign="middle"  >
        <td><div align="center" >T</div></td>
        <td><label>
          <input name="alergiaT" type="checkbox" id="alergiaT" value="si" <?php 
		  if($myrow32['alergiaT'])echo 'checked=""';
		  ?>  />
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td><div align="center" >P</div></td>
        <td><input name="alergiaP" type="checkbox" id="alergiaP" value="si" <?php 
		  if($myrow32['alergiaP'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td><div align="center" >R</div></td>
        <td><input name="alergiaR" type="checkbox" id="alergiaR" value="si" <?php 
		  if($myrow32['alergiaR'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td><div align="center" >PA</div></td>
        <td><input name="alergiaPA" type="checkbox" id="alergiaPA" value="si" <?php 
		  if($myrow32['alergiaPA'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle"  >
        <td >Peso</td>
        <td><label>
          <input name="peso" type="text"  id="peso" value="<?php echo $myrow32['peso'];?>"/>
        </label></td>
      </tr>
      <tr valign="middle"  >
        <td><div align="left" >Diagn&oacute;stico Paciente </div></td>
        <td><div align="left">
          <textarea name="dx" cols="60" wrap="virtual"  id="dx"><?php echo $myrow32['dx']; ?></textarea>
        </div></td>
      </tr>
      <tr valign="middle" >
        <td colspan="2" ><div align="center" >Asignaci&oacute;n de Cuarto</div></td>
      </tr>
      <tr valign="middle" >
        <td >Cuarto (si est&aacute; internado)</td>
        <td><input name="cuarto" type="text"  id="cuarto" size="4" 
		value="<?php echo $myrow32['cuarto'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td colspan="2" ><div align="center" >Responsables </div></td>
      </tr>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <?php if($_POST['tipoResponsable']=='Familiar' or $myrow32['tipoResponsable']=='Familiar'){ ?>
      <tr valign="middle" >
        <td colspan="2" ><div align="center" >Persona F&iacute;sica </div></td>
      </tr>
      <tr valign="middle"  >
        <td >Parentesco </td>
        <td><input name="parentescoResponsable" type="text"  id="parentescoResponsable" size="60" 
		value="<?php echo $myrow32['parentescoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td >Nombre</td>
        <td><input name="nombreResponsable" type="text"  id="nombreResponsable" size="60" 
		value="<?php echo $myrow32['nombreResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td >Apellido Paterno</td>
        <td><input name="apaternoResponsable" type="text"  id="apaternoResponsable" size="60" 
		value="<?php echo $myrow32['apaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td >Apellido Materno</td>
        <td><input name="amaternoResponsable" type="text"  id="amaternoResponsable" size="60" 
		value="<?php echo $myrow32['amaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td >Direcci&oacute;n</td>
        <td><textarea name="direccionResponsable" cols="50"   id="direccionResponsable"><?php echo $myrow32['direccionResponsable'];?></textarea></td>
      </tr>
      <tr valign="middle"  >
        <td >Tel&eacute;fono</td>
        <td><input name="telefonoResponsable" type="text"  id="telefonoResponsable" size="60" 
		value="<?php echo $myrow32['telefonoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle"  >
        <td >Ocupaci&oacute;n</td>
        <td><input name="ocupacionResponsable" type="text"  id="ocupacionResponsable" size="60" 
		value="<?php echo $myrow32['ocupacionResponsable'];?>"/></td>
      </tr>
	  <?php } ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  

  </table><br />
	
<label>
          <input name="expedienteOriginal" type="hidden"  id="flag2" size="60" readonly="" 
		value="<?php echo $myrow32['numeroE'];?>" />
          <div align="center">
          <input name="acepta" type="submit"  id="acepta" value="Actualizar Datos" />
          <br />
          <?php if($_POST['acepta']){ ?>
          <?php } ?>
          <br />
        </div>
        </label><br />
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
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>